<?php
/**
 * This file is from Slimworks and developed by Cyberbyte Studios
 */

namespace Slimworks\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
// use Slim\Interfaces\RouterInterface as Router;
use Slimworks\Interfaces\ViewInterface as View;
use Slimworks\Helpers\RenderView;
// use Noodlehaus\ConfigInterface as Config;
// use Slimworks\Interfaces\Helpers\SessionInterface as Session;
// use Slimworks\Interfaces\Database\DatabaseInterface as DB;
use Slimworks\Interfaces\Helpers\FlashInterface as Flash;
// use Psr\Log\LoggerInterface as Logger;

/**
 * GetTestCsrf Controller
 *
 * @param  \Psr\Http\Message\ServerRequestInterface $request    PSR7 request
 * @param  \Psr\Http\Message\ResponseInterface      $response   PSR7 response
 * @param  App\Interfaces\ViewInterface             $view       e.g. Slim\Views\Twig
 * @param  App\Interfaces\FlashInterface            $flash      e.g. Slim\Flash\Messages
 *
 * @return HTTP response message
 *
 */
class GetTestCsrf
{
    public function __invoke(
        Request $request,
        Response $response,
        View $view,
        Flash $flash
    ) {
        /* get input */

        /* do action */

        /* route away */
        return new RenderView($request, $response, $view, 'test/csrf', [
        ]);
    }
}
