<?php
/**
 * This file is from Slimworks and developed by Cyberbyte Studios
 */

namespace Slimworks\Helpers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slimworks\Interfaces\ViewInterface as View;
use Slimworks\Interfaces\Helpers\RenderViewInterface;
use Slimworks\Traits\CheckAcceptTrait;

/**
 * RenderView
 *
 *
 *
 */
class RenderView implements RenderViewInterface
{
    use CheckAcceptTrait;

    public function __construct(
        Request $request,
        Response $response,
        View $view,
        $template = 'home',
        $data = []
    ) {
        $contentType = $this->determineContentType($request);
        switch ($contentType) {
            case 'text/html':
                $data = $this->viewGlobals($data);
                return $view->render($response, $template . '.html.twig', $data);
                break;
        }
    }

    private function viewGlobals(array $data)
    {
        $session = new Session();
        $data['user'] = $session->getUser();
        return $data;
    }
}
