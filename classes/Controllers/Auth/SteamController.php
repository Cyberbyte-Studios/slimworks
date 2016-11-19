<?php
/**
 * This file is from Slimworks and developed by Cyberbyte Studios
 */


namespace Slimworks\Controllers\Auth;

use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;
use Slimworks\Interfaces\Helpers\FlashInterface;
use Slimworks\Interfaces\Helpers\SessionInterface;
use Slimworks\Services\Auth\Social\Steam\SteamService;

class SteamController
{
    public function __invoke(
        Response $response,
        SessionInterface $session,
        RouterInterface $router,
        FlashInterface $flash
    ) {
        if ($session->exists('userId')) {
            $flash->addMessage('loggedIn', 'You are already logged in');
            return $response->withRedirect($router->pathFor('dashboard'));
        }

        $steamService = new SteamService();

        if ($steamService->attemptLogin()) {
            $user = $steamService->getUser();
            $session->set('userId', $user->getId());

            $flash->addMessage('steamLogin', 'You have just logged in with steam');
            return $response->withRedirect($router->pathFor('dashboard'));
        }

        return $response->withRedirect($steamService->getLoginUrl());
    }
}
