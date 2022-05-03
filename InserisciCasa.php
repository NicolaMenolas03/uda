<?php
      require_once('header.php'); 
      require_once("ConnessionDB.php");
      session_start();  
?>
<html>
      <body>
            <?php if (!isset($_SESSION["Controllo"])){
            ?>
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
                                    <input type="text" class="form-control" name="telefono" minlength="10" maxlength="10" min="3333333333" max="3999999999" placeholder="Telefono" required>
                              </div>  
                              
                              <div class="col-lg-6 col-12">
                                    <input type="text" class="form-control" name="mail" placeholder="Mail" required>
                              </div>  

                              <div class="col-lg-5 mx-auto col-7">
                                    <input type="submit" class="form-control" name="invia" value="Invia" class="form-control" id="submit-button" >  	
                              </div>

                        </div>
                  </form>
            </div>
            <?php
                  }
                  function controllamail($mail){
                        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
                        return true;
                        }
                        else {
                        return false;
                        }
                  }

                  if (isset($_POST["invia"])){
                        $mail = filter_var($_POST["mail"], FILTER_SANITIZE_EMAIL);
                              
                        $controllo = controllamail($mail);
                        if ($controllo==true){
                              $_SESSION["Controllo"]=1;
                              $sql = "INSERT INTO Proprietari(Nome, Cognome, Telefono, Email) VALUES ('".$_POST["nome"]."','".$_POST["cognome"]."','".$_POST["telefono"]."','".$mail."')";

                              if ($conn->query($sql) === TRUE) {
                                    if (isset($_GET['error'])): ?>
                                          <p><?php echo $_GET['error']; ?></p>
                                    <?php endif ;
                                          if (isset($_SESSION["Controllo"])){
                                    ?>
                                                <form action="upload.php" class="contact-form" data-aos="fade-up" data-aos-delay="300" role="form" method="post" enctype="multipart/form-data">
                                                <div class="col-lg-6 col-12">
                                                      <input type="text" class="form-control" name="Toponiomo" placeholder="Toponiomo" required>
                                                </div>      

                                                <div class="col-lg-6 col-12">
                                                      <input type="text" class="form-control" name="NomeVia" placeholder="Nome Via" required>
                                                </div>  

                                                <div class="col-lg-6 col-12">
                                                      <input type="text" class="form-control" name="Civico"  placeholder="Civico" required>
                                                </div>  
                                                <!-- IDCOMUNE -->
                                                <div class="col-lg-6 col-12">
                                                      <input type="number" class="form-control" name="Prezzo" placeholder="Prezzo" required>
                                                </div>  

                                                <div class="col-lg-6 col-12">
                                                      <input type="text" class="form-control" name="Descrizione" placeholder="Descrizione" required>  	
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                      <input type="text" class="form-control" name="Posizione" placeholder="Posizione" required>  	
                                                </div>

                                                      <input type="file" name="my_image">
                                                      <input type="submit" name="submit" value="Upload">  	
                                                </form>
                                                
                                    <?php
                                          }
                                    if (isset($_POST["submit"])){
                                          
                                    }
                              }
                              else{
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                              }
                        }
                  }

            ?>

            
      </body>
      <?php 
            require_once("footer.php");    
      ?>
</html>