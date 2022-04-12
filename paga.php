<?php 
session_start();
require_once('ConnessionDB.php');
$checkin = $_SESSION['checkin'];
$checkout = $_SESSION['checkout'];
$prezzo = $_SESSION['Prezzo'];
$idappartamenti = $_POST['Appartamenti'];
$IDCLIENTE = 'CaccaPupu';


$sql = "INSERT INTO `affitti`(`Checkin`, `Checkout`, `Import`, `idAppartamento`, `usernameCliente`) 
VALUES ('$checkin','$checkout',$prezzo,$idappartamenti,'$IDCLIENTE')";
 
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
/*
$sql = "SELECT * FROM appartamenti";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $i=0;
    while($row = mysqli_fetch_assoc($result)) 
    {
        if($row['IdAppartamento'] == $Appartamenti)
        {
            $Prezzo = $row['Prezzo'];
            $IDAPP = $row['IdAppartamento'];
            $Descrizione = $row['Descrizione'];
        }
        
    }
} else {
    echo "0 results";
}
echo "Descrizione: " . $Descrizione . "<br>";
$PrezzoF = $Prezzo * $days_between;

$sql = "SELECT * FROM appartamenti, Proprietari WHERE appartamenti.idProprietario = Proprietari.IdProprietario and appartamenti.idAppartamento = $IDAPP";
$result = mysqli_query($conn, $sql);
 
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) 
    {
        $IdProprietario = $row["IdProprietario"];
        $Nome = $row["Nome"];
        $Cognome = $row["Cognome"];
        $Telefono = $row["Telefono"];
        $Email = $row["Email"];
	}
} else {
    echo "0 results";
}
echo "Dati del propietario<br><br>";
echo "Nome: ".$Nome;
echo "<br>Cognome: ".$Cognome;
echo "<br>Telefono: ".$Telefono;
echo "<br>Email: ".$Email."<br>";*/
mysqli_close($conn);

?>