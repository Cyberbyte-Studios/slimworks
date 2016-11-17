<?php
/**
 * This file is from Slimworks and developed by Cyberbyte Studios
 */

$app->get('/', \App\Controllers\GetHome::class)->setName('home');

$app->get('/test/csrf', \App\Controllers\GetTestCsrf::class)->setName('test.csrf');
$app->post('/test/csrf', \App\Controllers\PostTestCsrf::class)->setName('test.csrf.post');

