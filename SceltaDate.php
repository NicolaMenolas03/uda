<?php
/* Questo sarà il nostro controller */

require __DIR__ . '/vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;


$loader = new FilesystemLoader('templates');
$loader = new FilesystemLoader('templates');
$twig = new Environment($loader, [
  'debug' => true,
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$template = $twig->load('sceltadate.html.twig');
echo $template->render([
     // Array associativo:
     'menu' => [
          [ 'href'=> "SceltaDate.php", "text"=>"Prenota", "active" => true ],
          [ 'href'=> "InserisciCasa.php", "text"=>"Affitta", "active" => false ],
          [ 'href'=> "#footer", "text"=>"Contattaci", "active" => false ]
     ]
]);

?>