<?php
/* Questo sarà il nostro controller */


require __DIR__ . '/vendor/autoload.php';
require_once("ConnessionDB.php");


use Twig\Environment;
use Twig\Loader\FilesystemLoader;


$loader = new FilesystemLoader('templates');
$twig = new Environment($loader, [
  'debug' => true,
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

session_start();
$twig->addGlobal('session', $_SESSION);


$template = $twig->load('inseriscicasa.html.twig');
$houses = [];
// Estraggo i dati dal db e li metto in una variabile $houses

$redirect = false;
$comuni = array(); 

function controlla($conn, $mail, $telefono){
  if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    $sql = "SELECT Email, Telefono FROM Proprietari";
    $result = mysqli_query($conn, $sql);
    $c=0;
    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        if ($row["Email"]==$mail || $row["Telefono"]==$telefono){
          $c=1;
        }
      }
    }
    if ($c==1){
      return false;
    }else{
      return true;
    }
  } else {
    return false;
  }
}



if (isset($_POST["invia"])) {
      $mail = filter_var($_POST["mail"], FILTER_SANITIZE_EMAIL);
      $telefono = $_POST["telefono"];
      $controllo = controlla($conn,$mail,$telefono);
      if ($controllo == true) {
            $_SESSION["Controllo"] = 1;
            $sql = "INSERT INTO Proprietari(Nome, Cognome, Telefono, Email) VALUES ('" . $_POST["nome"] . "','" . $_POST["cognome"] . "','" . $_POST["telefono"] . "','" . $mail . "')";
            if ($conn->query($sql) === TRUE) {
                  if (isset($_GET['error'])) :
                        echo $_GET['error'];
                  endif;
                  $redirect = "InserisciCasa.php";
            } else {
                  echo "Error: " . $sql . "<br>" . $conn->error;
            }
      }

      $Cognome = $_POST['cognome'];
      $sql = "SELECT IdProprietario FROM Proprietari WHERE Email='$mail' or telefono='$telefono'";
      $result = mysqli_query($conn, $sql);
      
      if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                  $_SESSION['IdProprietario'] = $row["IdProprietario"];
                  $_SESSION["Controllo"] = 1;
                  $redirect = "InserisciCasa.php";

            }
      } else {
            echo "0 results";
      }
}

if (isset($_SESSION["Controllo"])) {
  $_SESSION["Controllo"] = 1;
  $sql = "SELECT IdComune,CAP,Comune FROM comuni";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_array($result)) {
    array_push($comuni, [
      'id'    => $row['IdComune'],
      'cap'   => $row['CAP'],
      'name'  => $row['Comune']
    ]);
  }
}

echo $template->render([
     // Array associativo:
    'redirect' => $redirect,
    'comuni' => $comuni,
    'menu' => [
      [ 'href'=> "SceltaDate.php", "text"=>"Prenota", "active" => false ],
      [ 'href'=> "InserisciCasa.php", "text"=>"Affitta", "active" => true ],
      [ 'href'=> "#footer", "text"=>"Contattaci", "active" => false ]
    ],
]);

?>