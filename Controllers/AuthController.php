<?php

/**
 * Class AuthController
 */
class AuthController extends BaseController
{
    /**
     * login
     */
    public static function login()
    {
        $user = null;
        $res = false;

        $_SESSION['flash'] = [];

        if (!empty($_REQUEST['login']) && !empty($_REQUEST['password'])) {

            $user = UserModel::getUserByLoginAndPass($_REQUEST['login'], md5($_REQUEST['password']));

            if (!empty($user)) {
                $_SESSION['user'] = $user;
                parent::redirect('/');
            } else {
                $_SESSION['flash']['errors'][] = 'Wrong login or password!';
            }

        } else {
            $_SESSION['flash']['errors'][] = 'You must specify both login and password!';
        }

        parent::redirect('/login');
    }

    /**
     * showLogin
     */
    public static function showLoginForm()
    {
        $loggedUser = self::getAuthenticatedUser();

        if (empty($loggedUser)) {
            return parent::createView('Login');
        } else {
            parent::redirect('/', 301);
        }
    }

    /**
     * @return mixed|null
     */
    public static function getAuthenticatedUser()
    {
        return $_SESSION['user'] ?? null;
    }

    /**
     * logout
     */
    public static function logout()
    {
        $_SESSION['user'] = null;
        parent::redirect('/login');
    }

}