<?php require_once('header.php');error_reporting(0);?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
<body>
    
<div class="container" style="padding: 0 0 15 0; width:900px;" data-aos="fade-up" data-aos-delay="30"><br>
    <form action='SceltaDate.php' method='POST' class="row g-3 needs-validation" novalidate>
        <div class="col-md-1">
        </div>
        <div class="col-md-3">
            <label for="validationCustom03" class="form-label">Città</label>
            <input type="text" class="form-control" id="validationCustom03"  placeholder="Dove vuoi andare?" name="comune" required>
                <div class="invalid-feedback">
                    Inserisci una destinazione per iniziare la ricerca
                </div>
        </div>
        <div class="col-md-3">
            <label for="validationCustom01" class="form-label">Check-in</label>
            <input type="date" class="form-control" id="validationCustom01" value="Mark" name="checkin" required>
                <div class="invalid-feedback">
                    Inserire una data valida
                </div>
        </div>
        <div class="col-md-3">
            <label for="validationCustom02" class="form-label">Check-out</label>
            <input type="date" class="form-control" id="validationCustom02" value="Otto" name="checkout" required>
                <div class="invalid-feedback">
                    Inserire una data valida
                </div>
        </div>
        <div class="col-md-1">
            <label for="validationCustom04" class="form-label" style="color:transparent;">.</label>
            <button class="btn button_date" id="validationCustom04" name="submit" type="submit">Cerca</button>
        </div>
    </form>
</div>


<!-- Modal -->
<div class="modal fade" id="gallery-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <img src="img/1.jpg" class="modal-img" alt="modal img">
      </div>
    </div>
  </div>
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