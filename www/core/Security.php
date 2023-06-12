<?php

namespace App\core;

use App\models\User;

class Security{
    static $user;

    public static function isConnected(): bool
    {
        $userEntity = new User();
        if(!empty($_SESSION['id'])) {
            $user = $userEntity->getOneBy("id", $_SESSION['id']);
            return $user->getToken() === $_SESSION['token'];
        }
        return false;
    }

    public static function hasRoleAdmin(): bool
    {
        if (self::isConnected()) {
            return $_SESSION['role'] === User::ROLE_ADMIN;
        }
    }

    public static function hasRoleSuscriber(): bool
    {
        if (self::isConnected()) {
            return $_SESSION['role'] === User::ROLE_SUSCRIBER;
        }
    }

    public static function hasRoleGuest(): bool
    {
        if (self::isConnected()) {
            return $_SESSION['role'] === User::ROLE_GUEST;
        }
    }

    public static function hasRole(string $role): bool
    {
        if (!self::isConnected()) {
            die('nope');
        }

        return $_SESSION['role'] === $role;
    }
}