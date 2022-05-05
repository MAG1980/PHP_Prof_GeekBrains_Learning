<?php

namespace app\engine;

class Cookie
{

    public function __construct(string $hash = null)
    {
        if (!is_null($hash)) {
            setcookie('hash', $hash, time() + 3600, '/');
        }
    }

    public function getCookieHash()
    {
        return $_COOKIE['hash'];
    }
}