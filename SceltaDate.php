
<form action='SceltaDate.php' method='POST'>
<input type='text' name='comune'>
<input type='date' name='checkin'>
<input type='date' name='checkout'>
<input type='submit' name='submit' value='Conferma date'>
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
        echo "ok";
        $_SESSION['checkin']=$_POST['checkin'];
        $_SESSION['checkout']=$_POST['checkout'];
        $_SESSION['search']=$_POST['comune'];
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
echo "<br><br><br>";


echo "<button><a href='StampaAppartamenti.php'>Avanti</a></button>";

?>
