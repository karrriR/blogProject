<?php

namespace Models\Users;

class User
{
    private $id;
    private $nickname;
    private $email;

    public function getNickname(): string
    {
        return $this->nickname;
    }
}