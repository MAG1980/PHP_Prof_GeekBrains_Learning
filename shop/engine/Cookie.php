<?php

namespace app\engine;

class Cookie
{

//    public function __construct(string $hash = null)
//    {
//        if (!is_null($hash)) {
//            setcookie('hash', $hash, time() + 3600, '/');
//        }
//    }
    public function set($key, $value)
    {
        if ($key === 'hash') {
            setcookie('hash', $value, time() + 3600, '/');
        }
    }

    public function getCookieHash()
    {
        return $_COOKIE['hash'];
    }

    public function setCookieOverdue(string $hash = 'hash')
    {
        setcookie($hash, '', time() - 3600, '/');
    }
}