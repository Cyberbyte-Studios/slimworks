<?php
/**
 * This file is from Slimworks and developed by Cyberbyte Studios
 */

namespace Slimworks\Interfaces\Helpers;

/**
 * SessionInterface
 *
 * For PHP-DI Autowiring
 *
 */
interface SessionInterface
{
    public function __construct();

    public function exists($variable);

    public function get($variable);

    public function set($variable, $value = null);

    public function remove($variable);

    public function regenerate();

    public function destroy();
}
