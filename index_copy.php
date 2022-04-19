<!DOCTYPE html>
<html lang="en">
<?php require_once('header.php'); ?>

<body>

     <div class="col-lg-8 mx-auto col-md-10 col-12">
                    
                      <form method="post" class="contact-form" data-aos="fade-up" data-aos-delay="300" role="form">
                        <div class="row">
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
                            <select id="comuni" class="custo-select">
                              <?php
                              
                                  require_once('ConnessionDB.php');

                                  $sql="SELECT IdComune,CAP,Comune FROM comuni"; 
                                  $result=mysqli_query($conn,$sql); ?>
                                  <option name="comune" value="-1">-Seleziona Comune-</option>
                                  <?php
                                  while($row=mysqli_fetch_array($result)){
                                      echo "<option name='comune' value='".$row['IdComune']."'>".$row['CAP']." | ".$row['Comune']."</option>";
                                  } 
                                  
                              ?>
                            </select>
                        </div>
                        <div class="col-lg-6 col-12" style="display:flex;justify-content: space-between; margin-top:-3px;">
                            <input type="text" class="form-control" name="via" placeholder="Via" style="width:80%">   
                            <input type="text" class="form-control" name="civico" placeholder="N°" style="width:15%">
                          </div>
                          <div class="col-lg-6 col-12">
                            <input type="text" class="form-control" name="username" placeholder="Username">
                          </div>
                          <div class="col-lg-6 col-12">
                            <input type="mail" class="form-control" name="mail" placeholder="E-mail">
                    </div>
                          <div class="col-lg-6 col-12">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                          </div>
                          <div class="col-lg-6 col-12">
                            
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

                      function controllousername($username){
                          
                          $sql="SELECT UsernameCliente FROM clienti"; 
                          $result=mysqli_query($conn,$sql);
                          if (mysqli_num_rows($result) > 0){
                              while($row=mysqli_fetch_array($result)){
                                  if ($username!=$row["UsernameCliente"]){
                                      return true;
                                  }
                                  else{
                                      return false;
                                  }
                              } 
                          }
                          
                          mysqli_close($conn);

                      }

                      if (isset($_POST["invio"])){
                              
                          $mail = filter_var($_POST["mail"], FILTER_SANITIZE_EMAIL);
                          $controllo = controllamail($mail);
                          if ($controllo==true){
                              
                              $controllo = controllonumero($_POST["telefono"]);
                              if ($controllo==true){
                                  
                                  $controllo = controllousername($_POST["username"]);
                                  if ($controllo==true){
                                      echo "<script>window.location.href='registraticarta.php';</script>";
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
                              
                      }
                  ?>

     <!-- ABOUT -->
     <section class="about section-padding pb-0" id="about">
          <div class="container">
               <div class="row">

                    <div class="col-lg-7 mx-auto col-md-10 col-12">
                         <div class="about-info">

                              <h2 class="mb-4" data-aos="fade-up">the best <strong>Digital Marketing agency</strong> in Rio de Janeiro</h2>

                              <p class="mb-0" data-aos="fade-up">Total 5 HTML pages are included in this template from TemplateMo website. Please check 2 <a href="blog.html">blog</a> pages, <a href="project-detail.html">project</a> page, and <a href="contact.html">contact</a> page. 
                              <br><br>You are <strong>allowed</strong> to use this template for commercial or non-commercial purpose. You are NOT allowed to redistribute the template ZIP file on template collection websites.</p>
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