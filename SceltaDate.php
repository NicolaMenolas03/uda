
<form action='SceltaDate.php' method='POST'>
<input type='date' name='checkin'>
<input type='date' name='checkout'>
<input type='submit' name='submit' value='Conferma date'>
</form>


<?php
session_start();
require_once('ConnessionDB.php');
if(!(isset($_POST['Appartamenti'])))
{
    $Appartamenti = $_SESSION['Appartamenti'];
}
else
{
    $Appartamenti = $_POST['Appartamenti'];
    $_SESSION['Appartamenti'] = $Appartamenti;
}

$sql = "SELECT * FROM `affitti` WHERE IdAppartamento=$Appartamenti";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $i=0;
    while($row = mysqli_fetch_assoc($result)) {
        $checkin[$i] = $row['Checkin'];
        $checkout[$i] = $row['Checkout'];
        $i++;
    }
} else {
}

if(isset($_POST['submit']))
{
    $start = strtotime($_POST['checkin']);
    $end = strtotime($_POST['checkout']);

    $oggi = date('Y-m-d');
    $startcontrol = $_POST['checkin'];
    $_SESSION['checkin']=$_POST['checkin'];
    $_SESSION['checkout']=$_POST['checkout'];
    if($start<$end && $startcontrol > $oggi)
    {
        $t=true;
        $x = count($checkin)-1;
        
        for($i=-1; $i<$x; $x--)
        {    
            if($checkin[$x]<=$_SESSION['checkin'] && $checkout[$x]>=$_SESSION['checkin'] || $checkout[$x]>=$_SESSION['checkout'] && $checkin[$x]<=$_SESSION['checkout'])
            {
                $t = false;
            }        
        }
        if($t==true)
        {
            $days_between = ceil(abs($end - $start) / 86400);
            echo "Le date sono: " . $days_between . "<br>";
        }
        else
        {
            echo"<b>
                    <font color='red'>L?APPARTAMENTO E' GIA' OCCUPATO<br></font>
               </b>";
            $days_between = 0;
        }
    }
    else{
        echo "Errore nelle date<br>";
        $days_between = 0;
    }
}
else
{
    $days_between = 0;
}

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
$_SESSION['Prezzo']=$PrezzoF;
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

if( $days_between != 0)
{
    echo "<button><a href='paga.php'>Avanti</a></button>";
}
?>
