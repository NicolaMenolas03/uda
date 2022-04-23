<!DOCTYPE html>
<html lang="en">
<?php 
  //error_reporting(0);
  require_once('header.php'); 
  require_once('ConnessionDB.php');
  error_reporting(0);
?>

<body>
<h2 style="text-align: center; padding:20px" class="text-black aos-init aos-animate" data-aos="fade-up">Inserisci i tuoi dati</h2>

     <div class="col-lg-8 mx-auto col-md-10 col-12">
                    
      <form method="post" class="contact-form" data-aos="fade-up" data-aos-delay="300" role="form">
        <div class="row">
          <div class="col-lg-6 col-12">
            <input type="text" class="form-control" name="nome" placeholder="Nome" required>
          </div>
          <div class="col-lg-6 col-12">
            <input type="text" class="form-control" name="cognome" placeholder="Cognome" required>
          </div>
          <div class="col-lg-6 col-12">
            <input type="text" class="form-control" name="telefono" placeholder="Numero di Telefono" required>
          </div>
          <div class="col-lg-6 col-12">
            <input type="text" class="form-control" name="citta" placeholder="Città" required>
          </div>
          <div class="col-lg-6 col-12" style="margin-top:11px;">
            <select name="comune" id="comuni" class="custo-select" required>
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
            <input type="text" class="form-control" name="via" placeholder="Via" style="width:80%" required>   
            <input type="text" class="form-control" name="civico" placeholder="N°" style="width:15%" required-+>
          </div>
          <div class="col-lg-6 col-12">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
          </div>
          <div class="col-lg-6 col-12">
            <input type="mail" class="form-control" name="mail" placeholder="E-mail" required>
          </div>
          <div class="col-lg-6 col-12">
            <input type="password" class="form-control" name="password" placeholder="Password" required >
          </div>
          <div class="col-lg-6 col-12">
            <input type="text" class="form-control"   name="numcred" minlength="16" maxlength="16" min="1111111111111111" max="9999999999999999" placeholder="Numero della Carta" required><br>
          </div>

          <div class="col-lg-6 col-12">
            <select name="carta" class="custo-select" id="carta" required>
                <option>-Scegli tipo carta-</option>
                <option value="visa">Visa</option>
                <option value="maestro">Maestro/MasterCard</option>
            </select>
          </div>
          <div class="col-lg-5 mx-auto col-7">
            <button type="submit" class="form-control" id="submit-button" name="submit">Invio</button>
          </div>
        </div>

      </form>
    </div>

                  <?php
                      function controllamail($mail){
                          if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
                              return true;
                          }
                          else {
                              return false;
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

                      if (isset($_POST["submit"])){
                        

                          $mail = filter_var($_POST["mail"], FILTER_SANITIZE_EMAIL);
                          
                          $controllo = controllamail($mail);
                          if ($controllo==true){
                              $controllo = controllonumero($_POST["telefono"]);
                              if ($controllo==true){
                                  
                                  $controllo = controllousername($_POST["username"], $conn);
                                  if ($controllo==true){

                                   $sql = "INSERT INTO clienti(UsernameCliente, Nome, Cognome, Telefono, Email, Password, Toponimo, Nomevia, Civico, idComuneCli, NumCreditCard, TipoCreditCard) VALUES ('".$_POST['username']."','".$_POST['nome']."','".$_POST['cognome']."','".$_POST['telefono']."','".$mail."','".$_POST['password']."','".$_POST['citta']."','".$_POST['via']."','".$_POST['civico']."','".$_POST['comune']."','".$_POST['numcred']."','".$_POST['carta']."' )";

                                   if ($conn->query($sql) === TRUE) {
                                    echo "<Script>alert('Dati salvati')</Script>";
                                   }
                                  }
                                  }
                                  else{
                                    header("Refresh: 2");
                                  }
                              }
                              else{
                                header("Refresh: 2");
                              }

                          }
                          else{
                            header("Refresh: 2");
                          }
                         
                  ?>

     <!-- ABOUT -->
     <section class="about section-padding pb-0" id="about">
          <div class="container">
               <div class="row">

                    <div class="col-lg-7 mx-auto col-md-10 col-12">
                         <div class="about-info">

                              <h2 class="mb-4" data-aos="fade-up">Scegli un bed e breakfast <strong>senza impegno e senza sforzo</strong> a Bari</h2>

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
    <?php 
        require_once("footer.php");
    
    ?>

</html>