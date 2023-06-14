<?php

namespace App\core;

use App\models\User;

class Security{
    static $user;

    public static function isConnected(): bool
    {
        $userEntity = new User();
        if(!empty($_SESSION['id'])) {
            $user = $userEntity::getOneBy(["id"=>$_SESSION['id']]);
            if (!self::isUserActive($user)) {
                die('Vous devez vérifier votre compte');
            }
            return $user->getToken() === $_SESSION['token'];
        }
        return false;
    }

    public static function hasRole(array $roles): bool
    {
        if (!self::isConnected()) {
            die('nope');
        }

        return in_array($_SESSION['role'], $roles);
    }

    public static function isUserActive(User $user): bool
    {
        return $user->getStatus() == User::STATUS_ACTIVE;
    }
}