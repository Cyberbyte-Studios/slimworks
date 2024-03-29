<?php
/**
 * This file is from Slimworks and developed by Cyberbyte Studios
 */

namespace Slimworks\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slimworks\Interfaces\Auth\CsrfGuardInterface as Csrf;
use Slimworks\Auth\CsrfGuard;
use Slimworks\Interfaces\ViewInterface as View;

/**
 * CsrfGuardMiddleware Middleware
 *
 * @param  \Psr\Http\Message\ServerRequestInterface $request    PSR7 request
 * @param  \Psr\Http\Message\ResponseInterface      $response   PSR7 response
 * @param  Callable                                 $next
 *
 * @return HTTP response message
 *
 */
class CsrfGuardMiddleware
{
    protected $csrf;
    protected $view;

    public function __construct(
        Csrf $csrf,
        View $view
    )
    {
        $this->csrf = $csrf;
        $this->view = $view;
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        $csrfNameKey = $this->csrf->getTokenNameKey();
        $csrfValueKey = $this->csrf->getTokenValueKey();
        $csrfName = $this->csrf->getTokenName();
        $csrfValue = $this->csrf->getTokenValue();

        // dd($this->csrf->getTokenName(), $name);

        $this->view->getEnvironment()->addGlobal('csrf', [
            'html' => '
                <input type="hidden" name="' . $csrfNameKey . '" value="' . $csrfName . '">
                <input type="hidden" name="' . $csrfValueKey . '" value="' . $csrfValue . '">
            ',
            'csrfNameKey' => $csrfNameKey,
            'csrfName' => $csrfName,
            'csrfValueKey' => $csrfValueKey,
            'csrfValue' => $csrfValue,
        ]);

        $response = $next($request, $response);

        return $response;
    }
}
