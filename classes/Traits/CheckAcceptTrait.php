<?php
/**
 * This file is from Slimworks and developed by Cyberbyte Studios
 */

namespace Slimworks\Traits;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Trait to
 */
trait CheckAcceptTrait
{
    /**
     * Known handled content types
     *
     * @var array
     */
    protected $knownContentTypes = [
        'application/json',
        'text/html',
    ];

    /**
     * Determine which content type we know about is wanted using Accept header
     *
     * @param Psr\Http\Message\ServerRequestInterface $request
     *
     * @return string
     */
    private function determineContentType(Request $request)
    {
        $acceptHeader = $request->getHeaderLine('Accept');
        $selectedContentTypes = array_intersect(explode(',', $acceptHeader), $this->knownContentTypes);

        if (count($selectedContentTypes)) {
            return $selectedContentTypes[0];
        }

        return 'text/html';
    }
}
