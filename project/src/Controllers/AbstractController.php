<?php

namespace Controllers;

use Models\Users\User;
use Models\Users\UsersAuthService;
use Views\View;

 

abstract class AbstractController
{
    /** @var View */
    protected $view;

    /** @var User|null */
    protected $user;

    public function __construct()
    {
        $this->user = UsersAuthService::getUserByToken();
        $this->view = new View(dirname(dirname(__DIR__)) . '/templates');
        $this->view->setVar('user', $this->user);
    }
}