<?php

namespace App\Controller;

use App\Authentication\Authentication;
use App\Repository\UserRepository;
use App\View\View;

class UserController
{
    private $UserRepo;

    function __construct()
    {
        $this->UserRepo = new UserRepository();
    }

    public function index()
    {
        $this->home();
    }

    public function login()
    {
        $view = new View('user/login');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }

    public function register()
    {
        $view = new View('user/register');
        $view->title = 'Register';
        $view->heading = 'Register';
        $view->display();
    }

    public function home()
    {
        Authentication::restrictAuthenticated();

        $view = new View('user/home');
        $view->title = 'Home';
        $view->heading = 'Hey ' . htmlentities($this->UserRepo->readById($_SESSION['userID'])->username) . '!';
        $view->display();
    }

    public function profile()
    {
        Authentication::restrictAuthenticated();

        $view = new View('user/profile');
        $view->title = 'Userprofile';
        $view->heading = 'Userprofile';
        $view->user = $this->UserRepo->readById($_SESSION['userID']);
        $view->display();
    }

    /* Functions */
    public function doLogin()
    {
        if (is_string($_POST['usernameInput']) && is_string($_POST['passwordInput'])) {
            if (Authentication::login($_POST['usernameInput'], $_POST['passwordInput'])) {
                header('Location: /');
            } else {
                header('Location: /default/error?errorid=1&target=/user/login');
            }
        } else {
            header('Location: /default/error?errorid=2&target=/user/login');
        }
    }

    public function doLogout()
    {
        Authentication::logout();
        header('Location: /');
    }

    public function doCreate()
    {
        if (is_string($_POST['usernameInput']) && is_string($_POST['emailInput']) && is_string($_POST['passwordInput'])) {
            if (preg_match("/[^\' \']+/m", $_POST['usernameInput'])) {
                $userBase = $this->UserRepo->readByUsername($_POST['usernameInput']);
                if ($userBase == null) {
                    if (filter_var($_POST['emailInput'], FILTER_VALIDATE_EMAIL)) {
                        if (preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}/m', $_POST['passwordInput'])) {
                            if ($_POST['passwordInput'] === $_POST['passwordRepeatInput']) {
                                $apiKey = bin2hex(random_bytes(32));
                                while($this->UserRepo->readByApiKey($apiKey) != null) {
                                    $apiKey = bin2hex(random_bytes(32));
                                }

                                $this->UserRepo->create($_POST['usernameInput'], $_POST['emailInput'], $_POST['passwordInput'], $apiKey);
                                header('Location: /');
                            } else {
                                header('Location: /default/error?errorid=1&target=/user/register');
                            }
                        } else {
                            header('Location: /default/error?errorid=1&target=/user/register');
                        }
                    } else {
                        header('Location: /default/error?errorid=1&target=/user/register');
                    }
                } else {
                    header('Location: /default/error?errorid=1&target=/user/register');
                }
            } else {
                header('Location: /default/error?errorid=1&target=/user/register');
            }
        } else {
            header('Location: /default/error?errorid=2&target=/user/register');
        }
    }

    public function doDelete()
    {
        Authentication::restrictAuthenticated();

        if (is_string($_POST['passwordInput'])) {
            $user = $this->UserRepo->readById($_SESSION['userID']);
            if (Authentication::login($user->username, $_POST['passwordInput'])) {
                $this->UserRepo->deleteById($_SESSION['userID']);
                Authentication::logout();
                header('Location: /');
            } else {
                header('Location: /default/error?errorid=1&target=/user/profile');
            }
        } else {
            header('Location: /default/error?errorid=2&target=/user/profile');
        }
    }

    public function doChangeMail()
    {
        Authentication::restrictAuthenticated();

        if (is_string($_POST['passwordInput']) && is_string($_POST['emailInput'])) {
            $user = $this->UserRepo->readById($_SESSION['userID']);
            if (Authentication::login($user->username, $_POST['passwordInput'])) {
                if (filter_var($_POST['emailInput'], FILTER_VALIDATE_EMAIL)) {
                    $this->UserRepo->updateMail($_SESSION['userID'], $_POST['emailInput']);
                    header('Location: /user/profile');
                } else {
                    header('Location: /default/error?errorid=1&target=/user/profile');
                }
            } else {
                header('Location: /default/error?errorid=1&target=/user/profile');
            }
        } else {
            header('Location: /default/error?errorid=2&target=/user/profile');
        }
    }

    public function doChangePassword()
    {
        Authentication::restrictAuthenticated();

        if (is_string($_POST['passwordInput']) && is_string($_POST['passwordInput']) && is_string($_POST['passwordRepeatInput'])) {
            $user = $this->UserRepo->readById($_SESSION['userID']);
            if (Authentication::login($user->username, $_POST['passwordInput'])) {
                if (preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}/m', $_POST['passwordInput'])) {
                    if ($_POST['passwordInputNew'] == $_POST['passwordRepeatInput']) {
                        $this->UserRepo->updatePassword($_SESSION['userID'], $_POST['passwordInputNew']);
                        Authentication::logout();
                        header('Location: /');
                    } else {
                        header('Location: /default/error?errorid=1&target=/user/profile');
                    }
                } else {
                    header('Location: /default/error?errorid=1&target=/user/profile');
                }
            } else {
                header('Location: /default/error?errorid=1&target=/user/profile');
            }
        } else {
            header('Location: /default/error?errorid=2&target=/user/profile');
        }
    }


    public function doGetApiKey() {
        if (is_string($_POST['username']) && is_string($_POST['password'])) {
            if (Authentication::login($_POST['username'], $_POST['password'])) {
                $apiKey = $this->UserRepo->readById($_SESSION['userID'])->apiKey;

                Authentication::logout();
                echo json_encode($apiKey);
            } else {
                echo json_encode(false);
            }
        } else {
            echo json_encode(false);
        }
    }

    public function doRotateApiKey() {
        Authentication::restrictAuthenticated();
        
        $apiKey = substr(bin2hex(random_bytes(32)), 5, 25);
        while($this->UserRepo->readByApiKey($apiKey) != null) {
            $apiKey = substr(bin2hex(random_bytes(32)), 5, 25);
        }

        $this->UserRepo->updateApiKey($_SESSION['userID'], $apiKey);

        header('Location: /user/profile');
    }

    public function doCheckUsernameAvailable()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $name = $this->UserRepo->readByUsername($data->Username);
        if ($name == null) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }
}
