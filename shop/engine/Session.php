<?php

namespace app\engine;

class Session
{
    protected string $login;
    protected string $id;

    /**
     * @param  string  $id
     */
    public function __construct()
    {
        $this->id = session_id();
    }


    /**
     * @param  mixed  $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getLogin(): string
    {
        return $this->login;
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