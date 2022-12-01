<?php

namespace App\Authentication;

use App\Repository\UserRepository;

class Authentication
{
    private static $UserRepo;

    public static function login($username, $password)
    {
        self::checkUserRepo();
        $user = Authentication::$UserRepo->readByUsername($username);
        if ($user != null) {
            if (password_verify($password, $user->password)) {
                $_SESSION['userID'] = $user->id;
                if ($user->admin === 1) {
                    $_SESSION['admin'] = true;
                }
                return true;
            }
        }
        return false;
    }

    public static function logout()
    {
        session_destroy();

        session_unset();
    }

    public static function getAuthenticatedUser()
    {
        self::checkUserRepo();
        $user = Authentication::$UserRepo->readById($_SESSION['userID']);

        return $user;
    }

    public static function restrictAuthenticated()
    {
        if (!self::isAuthenticated()) {
            header('Location: /user/login');
            error_log("Not authenticated User!");
            exit();
        }
    }

    public static function authenticateApiKey($apiKey) {
        $user = Authentication::$UserRepo->readByApiKey($apiKey);
        return $user != null;
    }

    public static function restrictAdmin()
    {
        if (!self::isAdmin()) {
            header('Location: /default/error?errorid=3&target=/');
            error_log("No Admin permission!");
            exit();
        }
    }

    public static function isAuthenticated()
    {
        return isset($_SESSION['userID']);
    }

    public static function isAdmin()
    {
        return isset($_SESSION['admin']) && self::isAuthenticated();
    }

    private static function checkUserRepo()
    {
        if (Authentication::$UserRepo === null) {
            Authentication::$UserRepo = new UserRepository();
        }
    }
}