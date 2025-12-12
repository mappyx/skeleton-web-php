<?php

namespace Resources\Views;

use System\Helpers;

class Template
{
    public function __construct()
    {
        // Security Headers
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://fonts.googleapis.com /public/js/; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data:;");

        // HSTS (Only if HTTPS/Production)
        if (getenv('APP_ENV') === 'production') {
            header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
        }
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title><?= htmlspecialchars(Helpers::config('name_app') ?? 'Dulce Cremoso', ENT_QUOTES, 'UTF-8'); ?></title>
            
            <!-- Google Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
            
            <!-- Custom Styles -->
            <link rel="stylesheet" href="/public/css/yogurt.css">
        </head>
        <body>
            <!-- Header -->
            <header class="header">
                <nav class="nav">
                    <a href="/" class="logo">
                        <img src="/public/images/logo.png" alt="<?= htmlspecialchars(Helpers::config('name_app') ?? 'Dulce Cremoso', ENT_QUOTES, 'UTF-8'); ?> Logo">
                        <span class="logo-text"><?= htmlspecialchars(Helpers::config('name_app') ?? 'Dulce Cremoso', ENT_QUOTES, 'UTF-8'); ?></span>
                    </a>
                    <ul class="nav-links">
                        <li><a href="#productos">Productos</a></li>
                        <li><a href="#proceso">Proceso</a></li>
                        <li><a href="#contacto">Contacto</a></li>
                    </ul>
                </nav>
            </header>

            <!-- Main Content Area -->
            <main class="main-content">
        <?php
    }

    public function __destruct()
    {
        ?>
            </main>

            <!-- Footer -->
            <footer class="footer">
                <div class="footer-content">
                    <div class="footer-section">
                        <h3 class="footer-title"><?= htmlspecialchars(Helpers::config('name_app') ?? 'Dulce Cremoso', ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="footer-description">Yogurt artesanal hecho con amor y los mejores ingredientes naturales.</p>
                    </div>
                    
                    <div class="footer-section">
                        <h4 class="footer-subtitle">Contacto</h4>
                        <ul class="footer-list">
                            <li>📞 +1 (555) 123-4567</li>
                            <li>📧 hola@dulcecremoso.com</li>
                            <li>📍 Calle Principal 123, Ciudad</li>
                        </ul>
                    </div>
                    
                    <div class="footer-section">
                        <h4 class="footer-subtitle">Síguenos</h4>
                        <div class="footer-social">
                            <a href="#" class="social-link" aria-label="Facebook">📘</a>
                            <a href="#" class="social-link" aria-label="Instagram">📷</a>
                            <a href="#" class="social-link" aria-label="Twitter">🐦</a>
                        </div>
                    </div>
                </div>
                
                <div class="footer-bottom">
                    <p>&copy; <?= date('Y') ?> <?= htmlspecialchars(Helpers::config('name_app') ?? 'Dulce Cremoso', ENT_QUOTES, 'UTF-8'); ?>. Todos los derechos reservados. Hecho con ❤️</p>
                </div>
            </footer>
            
            <!-- Smooth Scroll Script -->
            <script src="/public/js/smooth-scroll.js"></script>
        </body>
        </html>
        <?php
    }
}
