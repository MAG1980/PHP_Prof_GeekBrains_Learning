<?php

namespace app\engine;

class Session
{
    protected string $login;
    /**
     * id сессии
     * @param  string  $id
     */
    protected string $id;


    public function __construct()
    {
        $this->id = session_id();
    }


    /**
     * Устанавливает login
     * @param  string  $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * Возвращает login
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * Возвращает id
     * @return false|string
     */
    public function getId(): string
    {
        return $this->id;
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