<?php
      require_once('header.php'); 
      require_once("ConnessionDB.php");
?>
<html>
      <body>
            <div class="col-lg-8 mx-auto col-md-10 col-12">
                  <form method="post" class="contact-form" data-aos="fade-up" data-aos-delay="300" role="form">
                        
                        <div class="col-lg-6 col-12">
                              <input type="text" name="nome" placeholder="Nome" required>
                        </div>      

                        <div class="col-lg-6 col-12">
                              <input type="text" name="cognome" placeholder="Cognome" required>
                        </div>  

                        <div class="col-lg-6 col-12">
                              <input type="text" name="telefono" minlength="10" maxlength="10" min="3333333333" max="3999999999" placeholder="Telefono" required>
                        </div>  
                        
                        <div class="col-lg-6 col-12">
                              <input type="text" name="mail" placeholder="Mail" required>
                        </div>  

                        <div class="col-lg-5 mx-auto col-7">
                              <input type="submit" name="invia" value="Invia" class="form-control" id="submit-button" >  	
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

                  if (isset($_POST["invia"])){
                        $mail = filter_var($_POST["mail"], FILTER_SANITIZE_EMAIL);
                              
                        $controllo = controllamail($mail);
                        if ($controllo==true){
                              $sql = "INSERT INTO Proprietari(Nome, Cognome, Telefono, Email) VALUES ('".$_POST["nome"]."','".$_POST["cognome"]."','".$_POST["telefono"]."','".$mail."')";

                              if ($conn->query($sql) === TRUE) {
                                    if (isset($_GET['error'])): ?>
                                          <p><?php echo $_GET['error']; ?></p>
                                    <?php endif ?>
                                    <form action="upload.php" method="post" enctype="multipart/form-data">
                                          <input type="file" name="my_image">
                                          <input type="submit" name="submit" value="Upload">  	
                                    </form>
                                    <?php
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