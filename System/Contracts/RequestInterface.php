<?php

namespace System\Contracts;

interface RequestInterface {
    
    /**
     * Obtiene la URL actual de la solicitud.
     *
     * @return string
     */
    public function getUri(): string;
    
    /**
     * Obtiene los parámetros de la solicitud.
     *
     * @return array
     */
    public function getParams(): array;
    
    /**
     * Obtiene el método HTTP de la solicitud (GET, POST, PUT, etc.).
     *
     * @return string
     */
    public function getMethod(): string;
    
    /**
     * Obtiene la información del encabezado HTTP especificado.
     *
     * @param string $header_name
     * @return string|null
     */
    public function getHeader(string $header_name): ?string;
    
    /**
     * Obtiene la información del cuerpo de la solicitud.
     *
     * @return string
     */
    public function getBody(): string;
}