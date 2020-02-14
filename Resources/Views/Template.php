<?php
namespace Resources\Views;

use System\Helpers;

class Template
{
    public function __construct()
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title><?php echo Helpers::config('name_app'); ?></title>
            <link rel="stylesheet" type="text/css" href="<?php Helpers::getResourceCss('bootstrap.min'); ?>">
            <link rel="stylesheet" type="text/css" href="<?php Helpers::getResourceCss('font-awesome.min'); ?>">
            <link rel="stylesheet" type="text/css" href="<?php Helpers::getResourceCss('style'); ?>">
            <script src="<?php Helpers::getResourceJS('bootstrap.min'); ?>" type="text/javascript" defer></script>
            <script src="<?php Helpers::getResourceJS('jquery-1.11.3.min'); ?>" type="text/javascript" defer></script>
        </head>
        <body>
        <nav class="navbar navbar-light bg-light justify-content-between">
        <a class="navbar-brand"><?php echo Helpers::config('name_app'); ?></a>
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        </nav>
        <?php
    }

    public function __destruct()
    {
        ?>
        <footer class="footer">
            <div class="container">
                <div class="copyright float-center">
                    Todos los derechos reservados, Rafael Paez
                </div>
            </div>
        </footer>
        </body>
        </html>
        <?php
    }
}