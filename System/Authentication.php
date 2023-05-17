<?php

namespace System;

use Exception;

class Authentication
{
    protected $authorized = false;

    public function __construct()
    {
        session_start();
    }

    public function __destruct()
    {
        session_write_close();
    }

    protected function getCurrentUser(): ?array
    {
        $userName = $_SERVER['PHP_AUTH_USER'] ?? '';
        $userPW = $_SERVER['PHP_AUTH_PW'] ?? '';

        if (isset($_SESSION['auth'])) {
            if (!empty($userName) && !empty($userPW)) {
                return [
                    'userName' => $userName,
                    'userPW' => $userPW,
                ];
            }
            return null;
        }
        return null;
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

    protected function destroySession(): bool
    {
        if ($this->authorized) {
            session_unset();
            session_destroy();
            return true;
        }
        return false;
    }

    protected function checkUser(string $user, string $pw): bool
    {
        try {
            $currentUser = $this->getCurrentUser();
            if ($currentUser && $currentUser['userName'] == $user && $currentUser['userPW'] == $pw) {
                $this->authorized = true;
                $this->createSession();
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
