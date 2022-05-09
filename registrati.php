<!DOCTYPE html>
<html lang="en">
<?php 
  error_reporting(0);
  require_once('header.php'); 
  require_once('ConnessionDB.php');
  session_start();
  if (!$_SESSION['IdAppartamenti'] || !$_SESSION['PrezzoF']){
    $_SESSION['IdAppartamenti']=$_GET['Id'];
    $_SESSION['PrezzoF']=$_GET['CF'];
  }
  if(!($_SESSION['checkin']) || !($_SESSION['checkout']) || !($_SESSION['IdAppartamenti']) || !($_SESSION['PrezzoF'])){
      echo "<Script>window.location.href='SceltaDate.php';</Script>";
  }
?>

<body>
<h2 style="text-align: center; padding:20px" class="text-black aos-init aos-animate" data-aos="fade-up">Inserisci i tuoi dati</h2>

     <div class="col-lg-8 mx-auto col-md-10 col-12">
                    
      <form method="post" class="contact-form" data-aos="fade-up" data-aos-delay="300" role="form">
        <div class="row">
          <div class="col-lg-6 col-12">
            <input type="text" class="form-control" name="username" placeholder="Username">
          </div>
          <div class="col-lg-6 col-12">
            <input type="mail" class="form-control" name="mail" placeholder="E-mail">
          </div>
          <div class="col-lg-6 col-12">
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>
          <?php if (isset($_SESSION["Registrati"])){?>
          <div class="col-lg-6 col-12">
            <input type="text" class="form-control" name="nome" placeholder="Nome">
          </div>
          <div class="col-lg-6 col-12">
            <input type="text" class="form-control" name="cognome" placeholder="Cognome">
          </div>
          <div class="col-lg-6 col-12">
            <input type="text" class="form-control" name="telefono" placeholder="Numero di Telefono">
          </div>
          <div class="col-lg-6 col-12">
            <input type="text" class="form-control" name="citta" placeholder="Città">
          </div>
          <div class="col-lg-6 col-12" style="margin-top:11px;">
            <select name="comune" id="comuni" class="custo-select">
              <?php
              

                  $sql="SELECT IdComune,CAP,Comune FROM comuni"; 
                  $result=mysqli_query($conn,$sql); ?>
                  <option>-Seleziona Comune-</option>
                  <?php
                  while($row=mysqli_fetch_array($result)){
                      echo "<option value='".$row['IdComune']."'>".$row['CAP']." | ".$row['Comune']."</option>";
                  } 

              ?>
            </select>
        </div>
        <div class="col-lg-6 col-12" style="display:flex;justify-content: space-between; margin-top:-3px;">
            <input type="text" class="form-control" name="via" placeholder="Via" style="width:80%" >   
            <input type="text" class="form-control" name="civico" placeholder="N°" style="width:15%">
          </div>
          <div class="col-lg-6 col-12">
            <input type="text" class="form-control"   name="numcred" minlength="16" maxlength="16" min="1111111111111111" max="9999999999999999" placeholder="Numero della Carta" ><br>
          </div>

          <div class="col-lg-6 col-12">
            <select name="carta" class="custo-select" id="carta" >
                <option>-Scegli tipo carta-</option>
                <option value="visa">Visa</option>
                <option value="maestro">Maestro/MasterCard</option>
            </select>
          </div>
          <?php } ?>
          <!-- <div class="col-lg-5 mx-auto col-7">
            <input type="submit" class="form-control" id="submit-button" name="submit" value="Paga">
          </div> -->
          <div class="col-lg-5 mx-auto col-7">
          <button type="submit" class="form-control" name="Login" id="submit-button">Accedi</button>
            <center><button type="submit" class="input" name="Registrati" id="submit-button2" value="">Non sei ancora registrato? Registrati ora!</button></center>
          </div>
          <div class="col-lg-5 mx-auto col-7">
            
          </div>
        </div>

      </form>
    </div>
<!--POPUP -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Some text in the Modal..</p>
  </div>

</div>
<?php
          function controllamail($mail, $conn){
              if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
                $sql="SELECT Email FROM clienti"; 
                $result=mysqli_query($conn,$sql);
                $x=0;
                if (mysqli_num_rows($result) > 0){
                    while($row=mysqli_fetch_array($result)){
                        if ($mail==$row["Email"]){
                          return false;
                        }
                    } 
                }  
                if ($x==0){
                  return true;
                }
                
                
              }
          }

          function controllonumero($numero){
              if (is_numeric($_POST["telefono"])&&$_POST["telefono"]>3000000000){
                  return true;
              }
              else{
                  return false;
              }
          }

          function controllousername($username, $conn){
            
              $sql="SELECT UsernameCliente FROM clienti"; 
              $result=mysqli_query($conn,$sql);
              $x=0;
              if (mysqli_num_rows($result) > 0){
                  while($row=mysqli_fetch_array($result)){
                      if ($username==$row["UsernameCliente"]){
                          $x++;
                      }
                  } 
              }
              if ($x>0){
                return false;
              }
              else{
                return true;
              }
              

          }

          if (isset($_POST["Registrati"])||isset($_POST["Login"])){
            if (isset($_POST["Registrati"])){
              $_SESSION["Registrati"]=1;
              echo "<script>window.location.href='registrati.php';</script>";
            }
            if (isset($_POST["Login"])){
              unset($_SESSION["Registrati"]);
              echo "<script>window.location.href='registrati.php';</script>";

            }

              $mail = filter_var($_POST["mail"], FILTER_SANITIZE_EMAIL);
              
              $controllo = controllamail($mail, $conn);
              if ($controllo==true){
                  $controllo = controllonumero($_POST["telefono"]);
                  if ($controllo==true){
                      
                      $controllo = controllousername($_POST["username"], $conn);
                      if ($controllo==true){
                        if (!empty($_POST['nome'])&&!empty($_POST['cognome'])&&!empty($_POST['password'])&&!empty($_POST['citta'])&&!empty($_POST['via'])&&!empty($_POST['civico'])&&!empty($_POST['comune'])&&!empty($_POST['numcred'])&&!empty($_POST['carta'])){
                          $sql = "INSERT INTO clienti(UsernameCliente, Nome, Cognome, Telefono, Email, Password, Toponimo, Nomevia, Civico, idComuneCli, NumCreditCard, TipoCreditCard) VALUES ('".$_POST['username']."','".$_POST['nome']."','".$_POST['cognome']."','".$_POST['telefono']."','".$mail."','".$_POST['password']."','".$_POST['citta']."','".$_POST['via']."','".$_POST['civico']."','".$_POST['comune']."','".$_POST['numcred']."','".$_POST['carta']."' )";

                          if (mysqli_query($conn, $sql)) {
                            
                          } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                          }
                          $Checkin = $_SESSION['checkin'];
                          $Checkout = $_SESSION['checkout'];
                          $Prezz = $_SESSION['PrezzoF'];
                          $IdA = $_SESSION['IdAppartamenti'];
                          echo "Checkin ".$Checkin."<br>";
                          echo "Checkin ".$Checkout."<br>";
                          echo "Prezz ".$Prezz."<br>";
                          echo "IdA ".$IdA."<br>";
                          echo "Username ".$US."<br>";
                          $sql = "INSERT INTO `affitti`(`Checkin`, `Checkout`, `Import`, `idAppartamento`, `usernameCliente`) VALUES ('$Checkin','$Checkout',$Prezz,$IdA,'".$_POST["username"]."')";
                          if (mysqli_query($conn, $sql)) {
                            
                            echo "<Script>window.location.href='index.php';</Script>";
                          } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                          }
                        }
                      }
                        else
                        {
                        echo "<Script>alert('Errore nei dati inseriti')</Script>";
                        }
                      
                      }
                      else{
                        echo "<Script>alert('Errore nei dati inseriti')</Script>";
                      }
                  }
                  else{
                      $x=false;
                      $sql="SELECT UsernameCliente, Email, Password FROM clienti"; 
                      $result=mysqli_query($conn,$sql);
                      $x=0;
                      if (mysqli_num_rows($result) > 0){
                        
                          while($row=mysqli_fetch_array($result)){
                            
                              if ($_POST['password']==$row["Password"]&&$_POST['username']==$row["UsernameCliente"]&&$mail==$row["Email"]){
                                
                                $Checkin = $_SESSION['checkin'];
                                $Checkout = $_SESSION['checkout'];
                                $Prezz = $_SESSION['PrezzoF'];
                                $IdA = $_SESSION['IdAppartamenti'];
                                echo "Checkin ".$Checkin."<br>";
                                echo "Checkin ".$Checkout."<br>";
                                echo "Prezz ".$Prezz."<br>";
                                echo "IdA ".$IdA."<br>";
                                echo "Username ".$_POST["username"]."<br>";
                                
                                $sql = "INSERT INTO `affitti`(`Checkin`, `Checkout`, `Import`, `idAppartamento`, `usernameCliente`) VALUES ('$Checkin','$Checkout',$Prezz,$IdA,'".$_POST["username"]."')";
                                
                                if (mysqli_query($conn,$sql)) {
                                  $x=true;
                                  echo "<Script>window.location.href='index.php';</Script>";
                                } else {
                                  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                }
                              }
                          } 
                      }
                      if ($x==false){
                        echo "<Script>alert('Errore nei dati inseriti')</Script>";
                      }
                    
                  }

              
              }
              
      ?>

     <!-- ABOUT -->
     <section class="about section-padding pb-0" id="about">
          <div class="container">
               <div class="row">

                    <div class="col-lg-7 mx-auto col-md-10 col-12">
                         <div class="about-info">

                              <h2 class="mb-4" data-aos="fade-up">Scegli un bed e breakfast <strong>senza impegno e senza sforzo</strong> in Puglia</h2>

                              <p class="mb-0" data-aos="fade-up">A Bari siamo conosciuti per essere i Bed & Breakfast più affidabili, sicuri e smart della città. 
                         </div>

                         <div class="about-image" data-aos="fade-up" data-aos-delay="200">

                          <img src="images/office.png" class="img-fluid" alt="office">
                        </div>
                    </div>

               </div>
          </div>
     </section>



     <!-- TESTIMONIAL -->
     <section class="testimonial section-padding" id="footer">
</section>

     </body>
     <script>
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("submit-button");
        var span = document.getElementsByClassName("close")[0];
        btn.onclick = function() {
          modal.style.display = "block";
        }
        span.onclick = function() {
          modal.style.display = "none";
        }
        window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
      </script>

    <?php 
        require_once("footer.php");
    
    ?>

</html>