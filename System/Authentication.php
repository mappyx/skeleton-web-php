<?php
namespace System;

use Exception;

class Authentication
{
    protected $authorized = null;

    public function __construct()
    {
        
    }

    public function __destruct()
    {
        
    }

    protected function getCurrentUser()
    {
        try {
            $userName = $_SERVER['PHP_AUTH_USER'] ?? '';
            $userPW = $_SERVER['PHP_AUTH_PW'] ?? '';

            if ($_SESSION['auth']) {
                if ((!empty($userName)) && (!empty($userPW))) {
                    return json_encode(
                        [
                            'userName' => $_SERVER['PHP_AUTH_USER'],
                            'userPW' => $_SERVER['PHP_AUTH_PW'],
                        ]
                    );
                }
                return null;
            }
            return null;
        } catch (Exception $e) {

        }
    }

    protected function setSession(): bool
    {
        if (!$this->authorized) {
            header('WWW-Authenticate: Basic Realm="Login please"');
            header('HTTP/1.0 401 Unauthorized');
            $_SESSION['auth'] = true;
            $_SESSION['reauth'] = true;
            return true;
        }
        $_SESSION['reauth'] = null;
        return false;
    }

    protected function destroySession()
    {
        if ($this->authorized) {
            $_SESSION = array();
            unset($_COOKIE[session_name()]);
            session_destroy();
            return true;
        }
        return false;
    }

    protected function checkUser(string $user, string $pw): bool
    {
        try {
            $user = $this->getCurrentUser();
            if (($user->userName == $user) && ($user->userPW == $pw)) {
                $this->authorized = true;
                $this->createSession([]);
            } else {
                $this->authorized = false;
            }
            return $this->authorized;
        } catch (Exception $e) {
            return false;
        }
    }

    protected function createSession(array $param = []): void
    {
        session_start($param);
    }
}