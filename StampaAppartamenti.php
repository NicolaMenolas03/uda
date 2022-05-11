<?php
/* Questo sarà il nostro controller */

require __DIR__ . '/vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;


$loader = new FilesystemLoader('templates');
$twig = new Environment($loader, [
  'debug' => true,
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

session_start();
$twig->addGlobal('session', $_SESSION);
if(isset($_POST['submit']))
{
    $start = strtotime($_POST['checkin']);
    $end = strtotime($_POST['checkout']);
    $oggi = date('Y-m-d');
    $startcontrol = $_POST['checkin'];
    
    if($start<$end && $startcontrol > $oggi)
    {
        $_SESSION['checkin']=$_POST['checkin'];
        $_SESSION['checkout']=$_POST['checkout'];
        $_SESSION['search']=$_POST['comune'];
    }
    else{
        $_SESSION['checkin']="";
        $_SESSION['checkout']="";
    }
}
else
{
    header("location: index.php");
}


$template = $twig->load('stampaappartamenti.html.twig');

echo $template->render([
     // Array associativo:
     'available'     => [],
     'not_available' => [],
     'menu' => [
          [ 'href'=> "SceltaDate.php", "text"=>"Prenota", "active" => true ],
          [ 'href'=> "InserisciCasa.php", "text"=>"Affitta", "active" => false ],
          [ 'href'=> "#footer", "text"=>"Contattaci", "active" => false ]
     ]
]);

?>