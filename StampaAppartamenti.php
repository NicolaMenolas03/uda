<style>
		.alb {
			width: 200px;
			height: 200px;
			padding: 5px;
		}
		.alb img {
			width: 100%;
			height: 100%;
		}
		a {
			text-decoration: none;
			color: black;
		}
</style>
<?php require_once('header.php');
session_start();

//GESTIONE IMMAGINI
?>
<a href="InserisciCasa.php">&#8592;</a>
     <?php 
     require_once('ConnessionDB.php');
          $sql = "SELECT * FROM appartamenti ORDER BY IdAppartamento DESC";
          $res = mysqli_query($conn,  $sql);
          if (mysqli_num_rows($res) > 0) {
          	while ($images = mysqli_fetch_assoc($res)) {  ?>
                             
                 <?php 
                 $m = $images['IdAppartamento'];
                 $link[$m]=$images['image'];


          		 } }

//FINE GESTIONE IMMAGINI

    
    $lpl = $_SESSION['search'];
    echo "
    <form action='StampaAppartamenti.php' method='POST'>
    <input type='text' name='search' placeholder='$lpl'>
    <input type='submit' name='submit' value='Cerca'>
    </form>";

    $start = strtotime($_SESSION['checkin']);
    $end = strtotime($_SESSION['checkout']);
    $days_between = ceil(abs($end - $start) / 86400);
    echo "Le date sono: " . $days_between . "<br>";
    if(isset($_POST['search']))
    {
        $_SESSION['search'] = $_POST['search'];
        $SH = $_POST['search'];
        $sql = "SELECT * FROM appartamenti WHERE Toponimo LIKE '$SH%'";
        echo "<script>window.location.href='StampaAppartamenti.php';</script>";
    }
    else if($_SESSION['search'])
    {
        $SH = $_SESSION['search'];
        $sql = "SELECT * FROM appartamenti WHERE Toponimo LIKE '$SH%'";
    }
    else
    {
        $sql = "SELECT * FROM appartamenti";
    }
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $p=0;
        while($row = mysqli_fetch_assoc($result)) {
            $IdAppartamento[$p] = $row['IdAppartamento'];
            $Nome[$p] = $row['Descrizione'];
            $Prezzo[$p] = $row['Prezzo'];
            $Via[$p] = $row['Toponimo'] . ": " . $row['Nomevia'];
            $PrezzoF[$p] = $Prezzo[$p] * $days_between;
            $p++;
        }
    } else {
        echo "0 results";
    }
    $_SESSION['days_between'] = $days_between;
   
    


    $sql = "SELECT * FROM `affitti`";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $u=0;
        while($row = mysqli_fetch_assoc($result)) {
            $idAppartamento = $row['idAppartamento'];
            $u = count($checkin[$idAppartamento]);
            $checkin[$idAppartamento][$u] = $row['Checkin'];
            $checkout[$idAppartamento][$u] = $row['Checkout'];
            $u++;
        }
    } else {
    }
        
        for($i=0; $i<$p;$i++)
        {
            $t=true;
            $z = $IdAppartamento[$i];  
            //echo "z: ".$z;  
            $u = count($checkin[$z]);
            //echo "u: ".$u;
            if($u==0)
            {

            }
            else
            {
                for($y=0; $y<$u; $y++)
                {  
                    //echo "///".$u." ".$z."///";  
                    if($checkin[$z][$y]<=$_SESSION['checkin'] && $checkout[$z][$y]>=$_SESSION['checkin'] || $checkout[$z][$y]>=$_SESSION['checkout'] && $checkin[$z][$y]<=$_SESSION['checkout'])
                    {
                        $t = false;
                    }        
                }
            }
            
            if($t==true)
            {
                echo"    <form action='paga.php' method='POST'>
                ". "<br><hr><br><b><b><font color='green'>LIBERO</font></b> <br>" . $Nome[$i] . "</b> <br>" . $Via[$i]  . "<br>Prezzo a notte:" . $Prezzo[$i] . "<br>Prezzo totale:" . $PrezzoF[$i] . "<br>" . "<input type='radio' name='Appartamenti' value='$z'>";
            }
            else
            {
                echo"    <form action='paga.php' method='POST'>
                ". "<br><hr><br><b><b><font color='red'>OCCUPATO</font></b> <br>" . $Nome[$i] . "</b> <br>" . $Via[$i]  . "<br>Prezzo a notte:" . $Prezzo[$i] . "<br>Prezzo totale:" . $PrezzoF[$i] . "<br>" . "<input type='radio' name='Appartamenti' value='$z' disabled>";
            }
            ?>
            <div class="alb">
             	<img src="uploads/<?=$link[$z]?>">
            </div>
            <?php
        }
        echo "<hr>";
        echo "<br><br><input type='submit' value='avanti'>
        </form>";
    
/*
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
        */

    require_once("footer.php");
?>
