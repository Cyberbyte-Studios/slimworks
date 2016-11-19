<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('slimworks', 'sqlite');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'dsn' => 'sqlite:/home/scollins/projects/cyberbyte/lite/database/slimworks.sqlite3',
  'user' => 'armalife',
  'password' => 'armalife',
  'settings' =>
  array (
    'charset' => 'utf8',
    'queries' =>
    array (
    ),
  ),
  'classname' => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
  'model_paths' =>
  array (
    0 => 'src',
    1 => 'vendor',
  ),
));
$manager->setName('slimworks');
$serviceContainer->setConnectionManager('slimworks', $manager);
$serviceContainer->setAdapterClass('armalife', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'dsn' => 'mysql:host=172.22.0.2;port=3306;dbname=armalife',
  'user' => 'armalife',
  'password' => 'armalife',
  'settings' =>
  array (
    'charset' => 'utf8',
    'queries' =>
    array (
    ),
  ),
  'classname' => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
  'model_paths' =>
  array (
    0 => 'src',
    1 => 'vendor',
  ),
));
$manager->setName('armalife');
$serviceContainer->setConnectionManager('armalife', $manager);
$serviceContainer->setAdapterClass('exile', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'dsn' => 'mysql:host=172.22.0.2;port=3306;dbname=armalife',
  'user' => 'armalife',
  'password' => 'armalife',
  'settings' =>
  array (
    'charset' => 'utf8',
    'queries' =>
    array (
    ),
  ),
  'classname' => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
  'model_paths' =>
  array (
    0 => 'src',
    1 => 'vendor',
  ),
));
$manager->setName('exile');
$serviceContainer->setConnectionManager('exile', $manager);
$serviceContainer->setDefaultDatasource('slimworks');
$serviceContainer->setLoggerConfiguration('defaultLogger', array (
  'type' => 'stream',
  'path' => 'logs/propel.log',
  'level' => 300,
));