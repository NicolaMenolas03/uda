<?php
session_start();
error_reporting(0);
    require_once('ConnessionDB.php');

    echo "
    <form action='StampaAppartamenti.php' method='POST'>
    <input type='text' name='search' placeholder='es. Bari'>
    <input type='submit' name='submit' value='Cerca'>
    </form>";

    if($_POST['search'])
    {
        $SH = $_POST['search'];
        $sql = "SELECT * FROM appartamenti WHERE Toponimo LIKE '$SH%'";
    }
    else
    {
        $sql = "SELECT * FROM appartamenti";
    }
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $i=0;
        while($row = mysqli_fetch_assoc($result)) {
            $IdAppartamento[$i] = $row['IdAppartamento'];
            $Nome[$i] = $row['Descrizione'];
            $Prezzo[$i] = $row['Prezzo'];
            $Via[$i] = $row['Toponimo'] . ": " . $row['Nomevia'];
            $i++;
        }
    } else {
        echo "0 results";
    }
    
    mysqli_close($conn);
    
   

    $i--;
        
        for($x=-1; $x<$i; $i--)
        {
            $z = $IdAppartamento[$i];
            echo"    <form action='SceltaDate.php' method='POST'>
            ". "<br><hr><br><b>" . $Nome[$i] . "</b> <br>" . $Via[$i]  . "<br>Prezzo a notte:" . $Prezzo[$i] . "<br>" . "<input type='radio' name='Appartamenti' value='$z'>";
        }
        echo "<hr>";
        echo "<br><br><input type='submit' value='avanti'>
        </form>";
    

?>
