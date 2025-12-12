<?php

namespace System;

use System\Contracts\RequestInterface;

class Request implements RequestInterface
{
    private $uri;
    private $params;
    private $method;
    private $headers;
    private $body;

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        
        // Use explicit $_GET and $_POST instead of $_REQUEST
        if ($this->method === 'GET') {
            $this->params = $_GET;
        } elseif (in_array($this->method, ['POST', 'PUT', 'DELETE', 'PATCH'])) {
            $this->params = $_POST;
        } else {
            $this->params = [];
        }
        
        $this->headers = getallheaders();
        $this->body = file_get_contents('php://input');
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getHeader(string $header_name): ?string
    {
        return isset($this->headers[$header_name]) ? $this->headers[$header_name] : null;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
