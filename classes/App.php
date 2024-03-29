<?php
/**
 * This file is from Slimworks and developed by Cyberbyte Studios
 */

namespace Slimworks;

use DI\ContainerBuilder;
use Interop\Container\ContainerInterface;
use Slimworks\Database\PropelDatabase;
use Slimworks\Interfaces\ViewInterface;
use Slim\Views\TwigExtension;
use Noodlehaus\ConfigInterface;
use Psr\Log\LoggerInterface;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Monolog\Handler\StreamHandler;
use Slimworks\Interfaces\Helpers\FlashInterface;
use Slimworks\Helpers\Flash;
use Slimworks\Interfaces\Helpers\SessionInterface;
use Slimworks\Helpers\Session;
use Slimworks\Interfaces\Auth\CsrfGuardInterface;
use Slimworks\Handlers\ErrorCustom;
use Slimworks\Handlers\NotFoundCustom;
use Slim\Interfaces\RouterInterface;
use Slimworks\Interfaces\Database\DatabaseInterface;

/**
 * App
 *
 * @param Noodlehaus\ConfigInterface    $config
 * @param integer                       $authId     taken from $_SESSION[user_id]
 * @param integer                       $csrfToken  taken from $_SESSION[csrfToken]
 *
 */
class App extends \DI\Bridge\Slim\App
{
    private $config;

    private $session;

    public function __construct(
        ConfigInterface $config
    ) {
        $this->config = $config;

        $this->session = new Session;

        if (!$this->session->exists('csrfToken')) {
            $this->session->set('csrfToken', password_hash(time(), PASSWORD_BCRYPT));
        }

        $containerBuilder = new ContainerBuilder;
        $this->configureContainer($containerBuilder);
        $container = $containerBuilder->build();

        parent::__construct($container);
    }

    protected function configureContainer(ContainerBuilder $builder)
    {
        $definitions = [

            'settings.httpVersion' => $this->config
                ->get('slimConfig.settings.httpVersion'),
            'settings.responseChunkSize' => $this->config
                ->get('slimConfig.settings.responseChunkSize'),
            'settings.outputBuffering' => $this->config
                ->get('slimConfig.settings.outputBuffering'),
            'settings.determineRouteBeforeAppMiddleware' => $this->config
                ->get('slimConfig.settings.determineRouteBeforeAppMiddleware'),
            'settings.displayErrorDetails' => $this->config
                ->get('slimConfig.settings.displayErrorDetails'),

            ViewInterface::class => function (ContainerInterface $container) {
                $view = new View($container->get('config')->get('twig.path'), [
                    'cache' => $container->get('config')->get('twig.cache'),
                    'debug' => $container->get('config')->get('twig.debug'),
                ]);

                $view->addExtension(new TwigExtension(
                    $container->get('router'),
                    $container->get('request')->getUri()
                ));

                $view->addExtension(new \Twig_Extension_Debug());
                $view->addExtension(new \Twig_Extensions_Extension_Intl());

                $thisHost = $container->get('request')->getUri()->getScheme() . '://' .
                            $container->get('request')->getUri()->getHost();
                $thisBasePath = $container->get('request')->getUri()->getBasePath();
                $thisPath = $container->get('request')->getUri()->getPath();
                $thisUri = (string)$container->get('request')->getUri();

                $view->getEnvironment()->addGlobal(
                    'globals',
                    [
                        'host' => $thisHost,
                        'basePath' => $thisBasePath,
                        'path' => $thisPath,
                        'thisUri' => $thisUri,
                        'cdn' => $container->get('config')
                            ->get('app.cdn'),
                        'css' => $container->get('config')
                            ->get('app.css'),
                        'js' => $container->get('config')
                            ->get('app.js'),
                        'images' => $container->get('config')
                            ->get('app.images'),
                        'csrfToken' => $this->session->get('csrfToken'),
                    ]
                );

                $view->getEnvironment()->addGlobal('flash', $container->get('flash'));

                return $view;
            },
            'view' => \DI\get(ViewInterface::class),

            'errorHandler' => function (
                ViewInterface $view,
                ContainerInterface $container,
                LoggerInterface $logger
            ) {
                return new ErrorCustom(
                    $container->get('config'),
                    $view,
                    $logger
                );
            },

            'notFoundHandler' => function (
                ViewInterface $view,
                ContainerInterface $container,
                LoggerInterface $logger
            ) {
                return new NotFoundCustom(
                    $container->get('config'),
                    $view,
                    $logger
                );
            },

            LoggerInterface::class => function (ContainerInterface $container) {
                $logger = new Logger(
                    $container->get('config')->get('logger.name')
                );
                $logger->pushProcessor(new UidProcessor());

                $streamHandler = new StreamHandler(
                    $container->get('config')->get('logger.path'),
                    Logger::DEBUG
                );

                $logger->pushHandler($streamHandler);

                return $logger;
            },
            'logger' => \DI\get(LoggerInterface::class),

            RouterInterface::class => function (ContainerInterface $container) {
                return $container->get('router');
            },

            // FlashInterface::class => \DI\object(Flash::class),
            FlashInterface::class => function () {
                return new Flash();
            },
            'flash' => \DI\get(FlashInterface::class),

            ConfigInterface::class => function () {
                return $this->config;
            },
            'config' => \DI\get(ConfigInterface::class),

            SessionInterface::class => function () {
                return $this->session;
            },
            'session' => \DI\get(SessionInterface::class),

            CsrfGuardInterface::class => function () {
                $null = null;
                return new \Slimworks\Auth\CsrfGuard('csrf',
                    $null,
                    function ($request, $response, $next) {
                        $route = $request->getUri()->getPath();
                        $parsedBody = $request->getParsedBody();
                        if (
                            isset($parsedBody['csrfToken'])
                            && $parsedBody['csrfToken'] === $this->session->get('csrfToken')
                            && in_array($route, [
                                    'ajax/receive', //  a route that receives ajax
                                    ]
                                )
                        ) {
                            return $next($request, $response);
                        }
                        throw new \Exception('CSRF Problems on route: ' . $route);
                    }
                );
            },
            'csrf' => \DI\get(CsrfGuardInterface::class),

        ];

        $builder->addDefinitions($definitions);
    }
}
