<?php 
session_start();
require_once('ConnessionDB.php');
$checkin = $_SESSION['checkin'];
$checkout = $_SESSION['checkout'];
$prezzo = $_SESSION['Prezzo'];
$idappartamenti = $_SESSION['Appartamenti'];
$IDCLIENTE = 'CaccaPupu';

$sql = "INSERT INTO `affitti`(`Checkin`, `Checkout`, `Import`, `idAppartamento`, `usernameCliente`) 
VALUES ('$checkin','$checkout',$prezzo,$idappartamenti,'$IDCLIENTE')";
 
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
 
mysqli_close($conn);

?>