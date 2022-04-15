<?php require_once('header.php');?>
<html>
<body>
<div class="container">

        <form action='SceltaDate.php' method='POST' class="row g-3 needs-validation">
            <div class="col-md-1">
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-2">
                <label for="validationCustom03" class="form-label">Città</label>
                <input type="text" class="form-control" id="validationCustom03"  placeholder="Città" name="comune" required>
                    <div class="invalid-feedback">
                        Inserire una città valida
                    </div>
            </div>
            <div class="col-md-2">
                <label for="validationCustom01" class="form-label">Check-in</label>
                <input type="date" class="form-control" id="validationCustom01" value="Mark" name="checkin" required>
                    <div class="invalid-feedback">
                        Inserire una data valida
                    </div>
            </div>
            <div class="col-md-2">
                <label for="validationCustom02" class="form-label">Check-out</label>
                <input type="date" class="form-control" id="validationCustom02" value="Otto" name="checkout" required>
                    <div class="invalid-feedback">
                        Inserire una data valida
                    </div>
            </div>
            <div class="col-md-1">
                <label for="validationCustom04" class="form-label">.</label>
                <button class="btn btn-primary" id="validationCustom01" name="submit" type="submit">Cerca</button>
            </div>
        </form>
    </div>

<?php
session_start();
require_once('ConnessionDB.php');






if(isset($_POST['submit']))
{
    $start = strtotime($_POST['checkin']);
    $end = strtotime($_POST['checkout']);

    $oggi = date('Y-m-d');
    $startcontrol = $_POST['checkin'];
    
    if($start<$end && $startcontrol > $oggi)
    {
        $_SESSION['checkin']=$_POST['checkin'];
        $_SESSION['checkout']=$_POST['checkout'];
        $_SESSION['search']=$_POST['comune'];
        echo "<script>window.location.href='StampaAppartamenti.php';</script>";
    }
    else{
        echo "Errore nelle date<br>";
        $_SESSION['checkin']="";
        $_SESSION['checkout']="";      
    }
}
else
{
    $_SESSION['checkin']="";
    $_SESSION['checkout']="";
}
?>
    <!--<div class="container">
        <div class="row">
            <form action="SceltaDate.php" method='POST'>
                <div class="col-lg-6 col-12">
                    <input type='text' name='comune' required>
                </div>
                <div class="col-lg-6 col-8">
                <input type='date' name='checkin' required>
                </div>
                <div class="col-lg-6 col-12">
                <input type='date' name='checkout' required>
                </div>
                <div class="col-lg-6 col-12">
                <input type='submit' name='submit' value='Avanti'>
                </div>
                </form>
        </div>
    </div>-->

    
    

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>
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
    <br><br><br><br><br><br><br><br>
   
    
    
    
</body>
<?php 
    require_once("footer.php");
?>
</html>