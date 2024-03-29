<?php
/**
 * This file is from Slimworks and developed by Cyberbyte Studios
 */

$app->get('/', \Slimworks\Controllers\GetHome::class)->setName('home');
$app->get('/dash', \Slimworks\Controllers\Dashboard::class)->setName('dashboard');
$app->get('/login', \Slimworks\Controllers\Auth::class)->setName('login');


$app->get('/test/csrf', \Slimworks\Controllers\GetTestCsrf::class)->setName('test.csrf');
$app->post('/test/csrf', \Slimworks\Controllers\PostTestCsrf::class)->setName('test.csrf.post');

