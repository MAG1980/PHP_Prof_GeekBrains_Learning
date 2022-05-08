<?php

namespace app\engine;

class Session
{

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

//    public function __construct(string $login = null)
//    {
//        if (!is_null($login)) {
//            $_SESSION['login'] = $login;
//        }
//    }


    /**
     * Возвращает login
     * @return string
     */
    public function getLogin(): ?string
    {
        return $_SESSION['login'];
    }

    /**
     * Возвращает id сессии
     * @return false|string
     */
    public function getId(): string
    {
        return session_id();
    }

    public function regenerate_id()
    {
        session_regenerate_id();
    }

    public function destroy()
    {
        session_destroy();
    }
}