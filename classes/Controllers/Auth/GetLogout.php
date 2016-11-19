<?php
/**
 * This file is from Slimworks and developed by Cyberbyte Studios
 */

/**
 * This file is from Slimworks and developed by Cyberbyte Studios
 */

namespace Slimworks\Controllers\Auth;

use Slim\Interfaces\RouterInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Slimworks\Interfaces\Helpers\FlashInterface;
use Slimworks\Interfaces\Helpers\SessionInterface;

class GetLogout
{
    public function __invoke(
        Response $response,
        SessionInterface $session,
        RouterInterface $router,
        FlashInterface $flash
    ) {
        $session->destroy();
        $flash->addMessage('logout', 'You have been logged out');
        return $response->withRedirect($router->pathFor('dashboard'));
    }
}
