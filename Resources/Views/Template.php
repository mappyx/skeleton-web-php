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
        header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://code.jquery.com https://stackpath.bootstrapcdn.com; style-src 'self' 'unsafe-inline' https://stackpath.bootstrapcdn.com; font-src 'self' https://stackpath.bootstrapcdn.com;");

        // HSTS (Only if HTTPS/Production)
        if (getenv('APP_ENV') === 'production') {
            header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
        }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title><?= htmlspecialchars(Helpers::config('name_app') ?? '', ENT_QUOTES, 'UTF-8'); ?></title>
            <link rel="stylesheet" type="text/css" href="<?= Helpers::getResourceCss('bootstrap.min'); ?>">
            <link rel="stylesheet" type="text/css" href="<?= Helpers::getResourceCss('font-awesome.min'); ?>">
            <link rel="stylesheet" type="text/css" href="<?= Helpers::getResourceCss('style'); ?>">
            <script src="<?= Helpers::getResourceJS('jquery-1.11.3.min'); ?>" type="text/javascript" defer></script>
            <script src="<?= Helpers::getResourceJS('bootstrap.min'); ?>" type="text/javascript" defer></script>
        </head>
        <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"><?= htmlspecialchars(Helpers::config('name_app') ?? '', ENT_QUOTES, 'UTF-8'); ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li>
                </ul>
                <form class="form-inline ml-auto">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <?php
    }

    public function __destruct()
    {
        ?>
        <footer class="footer mt-auto py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center text-muted mb-0">&copy; <?= date('Y') ?> <?= htmlspecialchars(Helpers::config('name_app') ?? '', ENT_QUOTES, 'UTF-8'); ?>. Todos los derechos reservados.</p>
                    </div>
                </div>
            </div>
        </footer>
        </body>
        </html>
        <?php
    }
}
