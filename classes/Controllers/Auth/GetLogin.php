<?php
/**
 * This file is from Slimworks and developed by Cyberbyte Studios
 */

namespace Slimworks\Controllers\Auth;

use Slimworks\Helpers\RenderView;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slimworks\Interfaces\ViewInterface as View;
use Slimworks\Interfaces\Helpers\FlashInterface as Flash;

class GetLogin
{
    public function __invoke(
        Request $request,
        Response $response,
        View $view,
        Flash $flash
    ) {
        $flash->addMessage('loggedIn', 'You are already logged in');
        return new RenderView($request, $response, $view, 'core/login', [
            'someParam' => 'nothing was returned from the db.',
        ]);
    }
}
