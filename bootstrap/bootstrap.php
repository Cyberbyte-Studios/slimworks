<?php
/**
 * This file is from Slimworks and developed by Cyberbyte Studios
 */

use Slimworks\App;
use Slimworks\Middleware\CsrfGuardMiddleware;
use Psr7Middlewares\Middleware\TrailingSlash;

error_reporting(0);
ini_set('display_errors', 'Off');
ini_set('display_startup_errors', 'Off');
ini_set('log_errors', 'Off');



/* TEMP FOR DEVELOPMENT */
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
        ini_set('display_startup_errors', 'On');
        ini_set('log_errors', 'On');
/* / TEMP FOR DEVELOPMENT */



define('INC_ROOT', dirname(__DIR__));

require INC_ROOT . '/vendor/autoload.php';

\Patchwork\Utf8\Bootup::initAll();
// Enables the portablity layer and configures PHP for UTF-8
\Patchwork\Utf8\Bootup::filterRequestUri();
// Redirects to an UTF-8 encoded URL if it's not already the case
\Patchwork\Utf8\Bootup::filterRequestInputs();
// Normalizes HTTP inputs to UTF-8 NFC

mb_internal_encoding("UTF-8");
mb_http_output("UTF-8");

$configPath = file_get_contents(INC_ROOT . '/mode.php') . '.php';



/* TEMP FOR DEVELOPMENT */
        $dev = true;

        if ($dev) {
            $configPath = 'localhost/';
            if (isset($_SERVER['SERVER_NAME'])) {
                $configPath = $_SERVER['SERVER_NAME'] . '/';
                if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != 80) {
                    $configPath .= $_SERVER['SERVER_PORT'] . '/';
                }
            }
            $configPath .= 'config.php';
        }
/* / TEMP FOR DEVELOPMENT */



$config = new Noodlehaus\Config([
    INC_ROOT . '/bootstrap/config/' . $configPath,
]);

date_default_timezone_set($config->get('app.timezone'));
if (extension_loaded('intl')) {
    Locale::setDefault('gb-GB');
} else {
    die('intl extension needs to be installed!');
}

$app = new App($config);

$container = $app->getContainer();

require INC_ROOT . '/database/config.php';
require 'routes.php';

$app
    ->add(new CsrfGuardMiddleware(
        $container->get('csrf'),
        $container->get('view')
    ))
    ->add($container->get('csrf'))
    ->add(new TrailingSlash(false))
;
