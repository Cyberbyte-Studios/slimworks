<?php
/**
 * This file is from Slimworks and developed by Cyberbyte Studios
 */

namespace Slimworks\Auth;

use Slim\Csrf\Guard;
use Slimworks\Interfaces\Auth\CsrfGuardInterface;

/**
 * CsrfGuard
 *
 * For PHP-DI Autowiring
 *
 */
class CsrfGuard extends Guard implements CsrfGuardInterface
{
    // TO_DO: have injected $this->session, to use own session object
}
