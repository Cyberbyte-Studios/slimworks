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

class Dashboard
{
    public function __invoke(
        Request $request,
        Response $response,
        View $view,
        Flash $flash
    ) {
        return new RenderView($request, $response, $view, 'life/dashboard/content', [
            'someParam' => 'nothing was returned from the db.',
        ]);
    }
}
