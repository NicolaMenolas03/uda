<?php 
<<<<<<< Updated upstream
     error_reporting(0);
     session_destroy(); 
?>
=======
session_start();
session_destroy(); ?>
>>>>>>> Stashed changes
<!DOCTYPE html>
<html lang="en">
<?php require_once('header.php'); ?>
<body>
     <!-- HERO -->
     <section class="hero hero-bg d-flex justify-content-center align-items-center">
               <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-md-10 col-12 d-flex flex-column justify-content-center align-items-center">
                              <div class="hero-text">

                                   <h1 class="text-white" data-aos="fade-up">I tuoi alloggi da sogno</h1>

                                   <a href="index_copy.php" class="custom-btn btn-bg btn mt-3" data-aos="fade-up" data-aos-delay="100">Prenota ora</a>
                                   <a href="InserisciCasa.php" class="custom-btn btn-bg btn mt-3" data-aos="fade-up" data-aos-delay="100">Affitta ora</a>
                              </div>
                        </div>

                        <div class="col-lg-6 col-12">
                          <div class="hero-image" data-aos="fade-up" data-aos-delay="300">

                            <img src="images/undraw_sleep_analysis_o5.png" class="img-fluid" alt="working girl">
                          </div>
                        </div>

                    </div>
               </div>
     </section>


     <!-- ABOUT -->
     <section class="about section-padding pb-0" id="about">
          <div class="container">
               <div class="row">

                    <div class="col-lg-7 mx-auto col-md-10 col-12">
                         <div class="about-info">

                              <h2 class="mb-4" data-aos="fade-up">>Scegli un bed e breakfast <strong>senza impegno e senza sforzo</strong> in Puglia</h2>

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
    require_once("footer.php"); ?>

</html>