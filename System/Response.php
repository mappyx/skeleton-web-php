<?php

namespace System;

use System\Contracts\ResponseInterface;

class Response implements ResponseInterface
{
    private $headers = [];
    private $cookies = [];

    public function setStatusCode(int $status_code): void
    {
        http_response_code($status_code);
    }

    public function setHeader(string $header_name, string $header_value): void
    {
        $this->headers[$header_name] = $header_value;
        header("$header_name: $header_value");
    }

    public function setCookie(string $name, string $value, int $expires = 0, string $path = '/', string $domain = '', bool $secure = false, bool $httponly = false): void
    {
        $this->cookies[] = compact('name', 'value', 'expires', 'path', 'domain', 'secure', 'httponly');
        setcookie($name, $value, $expires, $path, $domain, $secure, $httponly);
    }

    public function send(string $body): void
    {
        foreach ($this->cookies as $cookie) {
            setcookie(
                $cookie['name'],
                $cookie['value'],
                $cookie['expires'],
                $cookie['path'],
                $cookie['domain'],
                $cookie['secure'],
                $cookie['httponly']
            );
        }

        echo $body;
    }
}
