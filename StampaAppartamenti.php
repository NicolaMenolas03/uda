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
error_reporting(0);
//GESTIONE IMMAGINI
?>

<div style='display:flex;flex-direction:row;padding:1em;padding: bottom 0em;'>
<a href="InserisciCasa.php"><i class='bx bx-left-arrow-alt' style='font-size:5em;'></i></a>
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
    <form action='StampaAppartamenti.php' class='contact-form' style='display: flex;width: 80%' method='POST'>
    <input type='text' class='form-control' style='width:20%;padding:auto;margin-left:2em' name='search' placeholder='$lpl'>
    <input type='submit' class='form-control' name='submit' id='submit-button' style='width:10%;margin-left:2em' value='Cerca'>
    <h2 style='text-align: center; padding:20px;margin-left:4em' class='text-black aos-init aos-animate' data-aos='fade-up'>Seleziona il tuo B&B</h2>
    </form>
    </div>
    ";

    $start = strtotime($_SESSION['checkin']);
    $end = strtotime($_SESSION['checkout']);
    $days_between = ceil(abs($end - $start) / 86400);
    echo "<div class='' style='margin-left:13em'>Le date sono: " . $days_between . "</div><br>";
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
                        $oc = $checkin[$z][$y]." AL ".$checkout[$z][$y];
                    }        
                }
            }
            
            if($t==true)
            {?>
                <div class="cards">
                <div class="alb">
             	<img src="uploads/<?=$link[$z]?>" style="border-radius: 8px;padding: right 2em;">
            </div>
            
            
                <form action='StampaAppartamenti.php' class="contact-form" method='POST' style="padding-left: 2em;">
                <font color='green'>LIBERO</font></p><?php echo "<strong class='title'>".$Nome[$i]."</strong>" ?> </b> <br> <?php echo $Via[$i]  ?> <br>Prezzo a notte:<?php echo $Prezzo[$i] ?> <br>Prezzo totale:<?php echo $PrezzoF[$i] ?> <br> <input type='submit' class="form-control" name='<?php echo $z ?>' value='Apri'>
                </form>
                
                <?php
            }
            else
            {?>
                <form action='StampaAppartamenti.php' class="contact-form" method='POST'>
                <b><font color='red'>OCCUPATO DAL <?php echo $oc ?></font></b> <br><?php echo $Nome[$i] ?> </b> <br> <?php echo $Via[$i]  ?> <br>Prezzo a notte:<?php echo $Prezzo[$i] ?> <br>Prezzo totale:<?php echo $PrezzoF[$i] ?> <br> <input type='submit' class="form-control" name='<?php echo $z ?>' value='Apri' disabled>
                </form>
                <?php
            }

            ?>
            <!-- IMMAGINE -->
            
            
            
            <!-- FINE IMMAGINE -->
            </div>
            <br>
            <?php
            
        }

        for($i=1; $i<($z+1); $i++)
        {
            if(isset($_POST[$i]))
            {
                $_SESSION['Appartamento']=$i;
                $_SESSION['PrezzoFinAppartamento']=$PrezzoF[$i];
                echo "<script>window.location.href='index_copy.php';</script>";
            }
        }


    require_once("footer.php");
?>
