<?php

namespace System\Contracts;

interface ResponseInterface {
    
    /**
     * Establece el código de estado HTTP de la respuesta.
     *
     * @param int $status_code
     * @return void
     */
    public function setStatusCode(int $status_code): void;
    
    /**
     * Establece el encabezado HTTP especificado con el valor especificado.
     *
     * @param string $header_name
     * @param string $header_value
     * @return void
     */
    public function setHeader(string $header_name, string $header_value): void;
    
    /**
     * Agrega una cookie HTTP a la respuesta.
     *
     * @param string $name
     * @param string $value
     * @param int $expires
     * @param string $path
     * @param string $domain
     * @param bool $secure
     * @param bool $httponly
     * @return void
     */
    public function setCookie(string $name, string $value, int $expires = 0, string $path = '/', string $domain = '', bool $secure = false, bool $httponly = false): void;
    
    /**
     * Envía el cuerpo de la respuesta al cliente.
     *
     * @param string $body
     * @return void
     */
    public function send(string $body): void;
}