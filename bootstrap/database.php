<?php
/**
 * This file is from Slimworks and developed by Cyberbyte Studios
 */

$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('armaDb', $config->get('armaDb.driver'));
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
    'classname' => 'Propel\\Runtime\\Connection\\DebugPDO',
    'dsn' => $config->get('armaDb.dsn'),
    'user' => $config->get('armaDb.user'),
    'password' => $config->get('armaDb.password'),
    'attributes' =>
        array (
            'ATTR_EMULATE_PREPARES' => false,
            'ATTR_TIMEOUT' => 30,
        ),
    'model_paths' =>
        array (
            0 => 'classes',
            1 => 'vendor',
        ),
));
$manager->setName('armaDb');
$serviceContainer->setConnectionManager('armaDb', $manager);
$serviceContainer->setAdapterClass('appDb', $config->get('appDb.driver'));
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
    'classname' => 'Propel\\Runtime\\Connection\\DebugPDO',
    'dsn' => $config->get('appDb.dsn'),
    'user' => $config->get('appDb.user'),
    'password' => $config->get('appDb.password'),
    'attributes' =>
        array (
            'ATTR_EMULATE_PREPARES' => false,
            'ATTR_TIMEOUT' => 30,
        ),
    'model_paths' =>
        array (
            0 => 'classes',
            1 => 'vendor',
        ),
));
$manager->setName('appDb');
$serviceContainer->setConnectionManager('appDb', $manager);
$serviceContainer->setDefaultDatasource('armaDb');
