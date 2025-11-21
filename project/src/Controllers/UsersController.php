<?php

namespace Controllers;

use Models\Users\User;
use Models\Users\UsersAuthService;
use Exceptions\InvalidArgumentException;

 
class UsersController extends AbstractController
{
    public function signUp()
    {
        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
                return;
            }
            if ($user instanceof User) {
                $this->view->renderHtml('users/signUpSuccessful.php');
                return;
            }
        }
        $this->view->renderHtml('users/signUp.php');
    }

    public function login()
    {
        if (!empty($_POST)) {
            try {
                $user = User::login($_POST);
                UsersAuthService::createToken($user);
                header('Location: /back_end_development/project/www');
                exit();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/login.php', ['error' => $e->getMessage()]);
                return;
            }
        }

        $this->view->renderHtml('users/login.php');
    }

    public function logout()
    {
        if ($this->user !== null) {
            $this->user->refreshAuthToken(); // Генерируем новый токен
            $this->user->save();
        }
        
        // Удаляем cookie с токеном
        setcookie('authToken', '', [
            'expires' => time() - 3600,
            'path' => '/',
            'secure' => false,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
        
        // Редирект на главную
        header('Location: /back_end_development/project/users/login');
        exit;
    }
}