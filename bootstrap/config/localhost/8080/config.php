<?php
/**
 * This file is from Slimworks and developed by Cyberbyte Studios
 */

// read credentials from dev_secrets.json
$creds = json_decode(file_get_contents(INC_ROOT . '/secrets/dev_secrets.json'), true);

return [
    'slimConfig' => [
        'settings' => [
            'httpVersion' => '1.1',
            'responseChunkSize' => 4096,
            'outputBuffering' => 'append',
            'determineRouteBeforeAppMiddleware' => false,
            'displayErrorDetails' => true,
        ],
    ],
    'app' => [
        'host' => 'http://localhost:' . $_SERVER['SERVER_PORT'],
        'base_path' => '/',
        'hash' => [
            'algo' => PASSWORD_BCRYPT,
            'cost' => 10
        ],
        'cdn' => 'http://localhost:' . $_SERVER['SERVER_PORT'],
        'css' => $creds['DEV']['app.css'],
        'js' => $creds['DEV']['app.js'],
        'images' => $creds['DEV']['app.images'],
        'tmp' => '/tmp',
        'timezone' => 'Europe/London',
    ],
    'armaDb' => [
        'driver' => 'mysql',
        'dsn' => $creds['ARMADB']['dsn'],
        'user' => $creds['ARMADB']['user'],
        'password' => $creds['ARMADB']['password'],
    ],
    'appDb' => [
        'driver' => 'sqlite',
        'dsn' => $creds['APPDB']['dsn'],
        'user' => $creds['APPDB']['user'],
        'password' => $creds['APPDB']['password'],
    ],
    'twig' => [
        'path' => '../resources/views/html',
        'debug' => true,
        'cache' => false,
    ],
    'csrf' => [
        'key' => 'csrf_token',
    ],
    'logger' => [
        'enabled' => true,
        'name' => $creds['DEV']['logger.name'],
        'path' => $creds['DEV']['logger.path'],
    ],
];
