
<form action='SceltaDate.php' method='POST'>
<input type='date' name='checkin'>
<input type='date' name='checkout'>
<input type='submit' name='submit' value='Conferma date'>
</form>

<?php
session_start();
$Appartamenti = $_SESSION['ok'];
echo "Descrizione: " . $Appartamenti . "<br>";

if(isset($_POST['submit']))
{
    $start = strtotime($_POST['checkin']);
    $end = strtotime($_POST['checkout']);
    
    $days_between = ceil(abs($end - $start) / 86400);
    echo "Le date sono: " . $days_between . "<br>";
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
        if($row['Descrizione'] == $Appartamenti)
        {
            $Prezzo = $row['Prezzo'];
        }
        
    }
} else {
    echo "0 results";
}
$PrezzoF = $Prezzo * $days_between;

echo "Il prezzo e': " . $PrezzoF . "<br>";


?>