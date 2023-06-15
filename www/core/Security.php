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
            if (!self::isUserActiveAndVerified($user)) {
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

    public static function isUserActiveAndVerified(User $user): bool
    {
        return $user->getStatus() == User::STATUS_ACTIVE && $user->getIsVerified() == 1;
    }

    public static function createToken(): string
    {
        $token = md5(uniqid()."jq2à,?".time());
        $token = substr($token, 0, rand(10,20));
        $token = str_shuffle($token);
        return $token;
    }
}