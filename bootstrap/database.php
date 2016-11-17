<?php
/**
 * This file is from Slimworks and developed by Cyberbyte Studios
 */

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => $config->get('db.driver'),
    'host' => $config->get('db.host'),
    'database' => $config->get('db.database'),
    'username' => $config->get('db.username'),
    'password' => $config->get('db.password'),
    'charset' => $config->get('db.charset'),
    'collation' => $config->get('db.collation'),
    'prefix' => $config->get('db.prefix'),
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();

$capsule->getConnection()->enableQueryLog();
