<?php
namespace App\Controllers;

class HomeController extends Controller
{
    public function __construct()
    {
        // No dependencies needed for static landing page
    }

    public function __destruct()
    {
        // Cleanup if needed
    }

    /**
     * Display the yogurt shop landing page
     */
    public function index()
    {
        // Static data for the yogurt shop landing page
        $data = [
            'title' => 'Dulce Cremoso - Yogurt Artesanal',
            'products' => [
                [
                    'name' => 'Yogurt Natural',
                    'description' => 'Cremoso y suave, hecho con leche fresca y cultivos probióticos naturales.',
                    'price' => '$3.50'
                ],
                [
                    'name' => 'Yogurt de Fresa',
                    'description' => 'Delicioso yogurt con fresas frescas y un toque de miel natural.',
                    'price' => '$4.00'
                ],
                [
                    'name' => 'Yogurt Miel & Vainilla',
                    'description' => 'Endulzado naturalmente con miel pura y extracto de vainilla.',
                    'price' => '$4.50'
                ]
            ],
            'features' => [
                [
                    'icon' => '🥛',
                    'title' => '100% Natural',
                    'description' => 'Sin conservantes ni aditivos artificiales'
                ],
                [
                    'icon' => '🌱',
                    'title' => 'Probióticos Vivos',
                    'description' => 'Cultivos activos para tu salud digestiva'
                ],
                [
                    'icon' => '❤️',
                    'title' => 'Hecho con Amor',
                    'description' => 'Cada lote preparado artesanalmente'
                ],
                [
                    'icon' => '🏡',
                    'title' => 'Producción Local',
                    'description' => 'Apoyamos a productores locales'
                ]
            ],
            'process' => [
                [
                    'number' => '1',
                    'title' => 'Selección',
                    'description' => 'Elegimos la mejor leche fresca local'
                ],
                [
                    'number' => '2',
                    'title' => 'Cultivo',
                    'description' => 'Agregamos cultivos probióticos naturales'
                ],
                [
                    'number' => '3',
                    'title' => 'Fermentación',
                    'description' => 'Dejamos fermentar a temperatura perfecta'
                ],
                [
                    'number' => '4',
                    'title' => 'Empaque',
                    'description' => 'Envasamos con cuidado para ti'
                ]
            ]
        ];
        
        return $data;
    }
}