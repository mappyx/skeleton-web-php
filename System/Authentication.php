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
            if ($currentUser && $currentUser['userName'] == $user) {
                // In a real application, fetch hashed password from database
                // For now, this is a placeholder - you should store hashed passwords
                // Example: $hashedPassword = getUserPasswordFromDB($user);
                // if (password_verify($pw, $hashedPassword)) { ... }
                
                // Temporary: Using timing-safe comparison
                if (hash_equals($currentUser['userPW'], $pw)) {
                    $this->authorized = true;
                    $this->createSession();
                } else {
                    $this->authorized = false;
                }
            } else {
                $this->authorized = false;
            }
            return $this->authorized;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Hash a password securely
     */
    public static function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }

    /**
     * Verify a password against a hash
     */
    public static function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    protected function createSession(array $param = []): void
    {
        // Regenerate session ID to prevent session fixation
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
        } else {
            session_start($param);
            session_regenerate_id(true);
        }
    }
}
