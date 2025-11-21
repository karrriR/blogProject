<?php
// Сервис аутентификации пользователей через cookie.


namespace Models\Users;

use Models\Users\User;


class UsersAuthService
{
    // Создание токена и установка cookie
    public static function createToken(User $user): void
    {
        $token = $user->getId() . ':' . $user->getAuthToken();
        setcookie('token', $token, 0, '/', '', false, true);
    }


    // Получение пользователя по токену
    public static function getUserByToken(): ?User
    {
        // Получение токена
        $token = $_COOKIE['token'] ?? '';
        if (empty($token)) {
            return null;
        }

        // Токен разбивается на части
        [$userId, $authToken] = explode(':', $token, 2);

        // Поиск юзера в бд
        $user = User::getById((int) $userId);
        if (!$user instanceof User) {
            return null;
        }

        // Проверка на совпадение токена
        if ($user->getAuthToken() !== $authToken) {
            return null;
        }

        return $user;
    }
}