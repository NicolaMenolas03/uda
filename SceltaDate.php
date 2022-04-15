<h1>Inserire luogo e date di prenotazione</h1>
<form action='SceltaDate.php' method='POST'>
<input type='text' name='comune' required>
<input type='date' name='checkin' required>
<input type='date' name='checkout' required>
<input type='submit' name='submit' value='Avanti'>
</form>


<?php
session_start();
require_once('ConnessionDB.php');




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
        echo "<script>window.location.href='StampaAppartamenti.php';</script>";
    }
    else{
        echo "Errore nelle date<br>";
        $_SESSION['checkin']="";
        $_SESSION['checkout']="";      
    }
}
else
{
    $_SESSION['checkin']="";
    $_SESSION['checkout']="";
}


?>
