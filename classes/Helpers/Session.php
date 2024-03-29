<?php
/**
 * This file is from Slimworks and developed by Cyberbyte Studios
 */

namespace Slimworks\Helpers;

use Slimworks\Interfaces\Helpers\SessionInterface;
use Noodlehaus\ConfigInterface;

/**
 * Session
 *
 * @param Noodlehaus\ConfigInterface $config
 *
 */
class Session implements SessionInterface
{
    public function __construct()
    {
        ini_set('session.cookie_httponly','1');
        ini_set('session.cookie_lifetime','7200');
        ini_set('session.entropy_length','128');
        ini_set('session.hash_bits_per_character','6');
        ini_set('session.hash_function','sha256');
        ini_set('session.lazy_write','1');
        ini_set('session.use_cookies','1');
        ini_set('session.use_only_cookies','1');
        ini_set('session.use_strict_mode','1');

        session_cache_limiter(false);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        foreach ($_SESSION as $key => $value) {
            $this->$key = $value;
        }
    }

    public function exists($variable)
    {
        if (isset($this->$variable)) {
            return true;
        }
        return false;
    }

    public function get($variable)
    {
        if ($this->exists($variable)) {
            return $this->$variable;
        }
        return null;
    }

    public function set($variable, $value = null)
    {
        $this->$variable = $value;
        $_SESSION[$variable] = $value;
    }

    public function remove($variable)
    {
        if (isset($this->$variable)) {
            unset($_SESSION[$variable]);
            return true;
        }
        return false;
    }

    public function regenerate()
    {
        session_regenerate_id(true);
    }

    public function destroy()
    {
        session_destroy();
    }
}
