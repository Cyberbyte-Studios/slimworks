<?php
/**
 * This file is part of a Slim PHP-DI Starter Project
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 *
 * @license   https://github.com/nisbeti/slim-phpdi-starter/blob/master/LICENCE.md MIT
 * @link      https://github.com/nisbeti/slim-phpdi-starter
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
