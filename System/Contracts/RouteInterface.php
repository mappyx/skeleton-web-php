<?php

namespace System\Contracts;

use System\Contracts\RequestInterface;

interface RouteInterface {
    
    /**
     * Obtiene la ruta actual como una cadena de texto.
     *
     * @return string
     */
    public function parseStringRoute(RequestInterface $request): string;
    
    /**
     * Obtiene los parámetros de la URL de la ruta actual.
     *
     * @return array
     */
    public function getParamsFromUrl(RequestInterface $request): array;
    
    /**
     * Obtiene los segmentos de la ruta actual.
     *
     * @return array
     */
    public function getRoutes(RequestInterface $request): array;
}