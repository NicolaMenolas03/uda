<?php
require_once('header.php');
require_once("ConnessionDB.php");
session_start();
$_SESSION['IdProprietario']=3;
$IdProp = $_SESSION['IdProprietario'];
$sql = "SELECT * FROM appartamenti WHERE IdProprietario=$IdProp"; 
$result = mysqli_query($conn, $sql); 

if (mysqli_num_rows($result) > 0) {
      ?>
      <div style="padding:1.5em">
      <center><button  class="secondary" onclick="window.location.href='InserisciCasa.php'">Torna a vendere</button></center>
      </div>
      <?php
    while ($row = mysqli_fetch_assoc($result)) {
          ?>
          <div style="padding:1.5em">
      <div class="cards-prop">
      <div class="alb">
          <img src="uploads/<?= $row['image'] ?>" style="border-radius: 8px;padding: right 2em;">
      </div>


      <form action='StampaAppartamenti.php' class="contact-form" method='POST' style="padding-left: 2em;">
          </p><?php echo "<strong class='title'>" . $row['Descrizione'] . "</strong>" ?> </b> <br> <?php $row['Nomevia']  ?> <br><br>
      </form>
      <div class="prices">Prezzo a <br>notte:<?php echo "<div class='prices2'>" . $row['Prezzo'] . "€</div><br>" ?><br></div><br>
      </div>
      
      </div>
      
      
      <?php
    }
} else {
    echo "0 results";
}
echo "<br><br><br><br><br><br><br><br><br>";

require_once("footer.php");
?>



</html>