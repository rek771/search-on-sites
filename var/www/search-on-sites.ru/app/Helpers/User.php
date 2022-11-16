<?php
namespace App\Helpers;

class User
{
    /**
     * @return mixed Возвращает ID пользователя из кук
     */
    public static function id()
    {
        if (!isset($_COOKIE["user_uniqid"])) {
            setcookie("user_uniqid", uniqid());
        }

        return $_COOKIE["user_uniqid"];
    }
}