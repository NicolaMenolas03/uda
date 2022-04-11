
<form action='SceltaDate.php' method='POST'>
<input type='date' name='checkin'>
<input type='date' name='checkout'>
<input type='submit' name='submit' value='Conferma date'>
</form>


<?php
session_start();
if(!($_SESSION['Appartamenti']))
{
    $Appartamenti = $_POST['Appartamenti'];
    $_SESSION['Appartamenti']=$Appartamenti;
}
else
{
    $Appartamenti = $_SESSION['Appartamenti'];
}



if(isset($_POST['submit']))
{
    $start = strtotime($_POST['checkin']);
    $end = strtotime($_POST['checkout']);
    $oggi = date('Y-m-d');
    $startcontrol = $_POST['checkin'];
    if($start<$end && $startcontrol > $oggi)
    {
        $days_between = ceil(abs($end - $start) / 86400);
        echo "Le date sono: " . $days_between . "<br>";
    }
    else{
        echo "Errore nelle date";
        $days_between = 0;
    }
}
else
{
    $days_between = 0;
}
require_once('ConnessionDB.php');
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

echo "<br><br>Il prezzo e': " . $PrezzoF . "<br>";
echo "<br><br><br>";

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
echo "<br>Email: ".$Email."<br>";
mysqli_close($conn);

?>
<button><a href="paga.php">Avanti</a></button>