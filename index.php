<?php
/* Questo sarà il nostro controller */

require __DIR__ . '/vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;


$loader = new FilesystemLoader('templates');
$twig = new Environment($loader, []);
$template = $twig->load('home.html.twig');
$houses = [];
// Estraggo i dati dal db e li metto in una variabile $houses



echo $template->render([
     // Array associativo:
     'menu' => [
          [ 'href'=> "SceltaDate.php", "text"=>"Prenota", "active" => false ],
          [ 'href'=> "InserisciCasa.php", "text"=>"Affitta", "active" => false ],
          [ 'href'=> "#footer", "text"=>"Contattaci", "active" => false ]
     ]
]);

?>