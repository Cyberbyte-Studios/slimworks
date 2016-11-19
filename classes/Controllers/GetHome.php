<?php
/**
 * This file is from Slimworks and developed by Cyberbyte Studios
 */

namespace Slimworks\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slimworks\Interfaces\ViewInterface as View;
use Slimworks\Helpers\RenderView;
use Slimworks\Interfaces\Helpers\FlashInterface as Flash;

class GetHome
{
    public function __invoke(
        Request $request,
        Response $response,
        View $view,
        Flash $flash
    ) {
        /* get input */

        /* do action */
//        $user = $db->table('users')->first();
//        $username = $user->username;
//
//        $flash->addMessage('global', 'This is a flash message.');
//
        /* route away */
        return new RenderView($request, $response, $view, 'home', [
            'someParam' => 'nothing was returned from the db.',
        ]);
    }
}
