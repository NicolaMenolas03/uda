<!DOCTYPE html>
<html lang="en">
<?php require_once('header.php'); ?>

<body>
<h2 style="text-align: center; padding:20px" class="text-black aos-init aos-animate" data-aos="fade-up">Inserisci i dati della carta</h2>
    <div class="col-lg-8 mx-auto col-md-10 col-12">

        <form method="POST" class="contact-form" data-aos="fade-up" data-aos-delay="300" role="form">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <input type="text" class="form-control" name="numcred" minlength="16" maxlength="16" min="0" max="9999999999999999" placeholder="Nome" required>
                </div>
                <div class="col-lg-6 col-12" style="display:flex;justify-content: space-between;">
                    <select name="carta" id="carta" class="custo-select" required style="margin-top:15px;width:80%;">
                        <option value="visa" name="cartadicredito">Visa</option>
                        <option value="maestro" name="cartadicredito">Maestro/MasterCard</option>
                    </select>
                    <input type="text" class="form-control" name="cvv" maxlength="3" minlength="3" min="1" max="999" placeholder="CVV" style="margin-top:15px; width:15%;" required><br>
                </div>
                <div class="col-lg-12 col-12">
                    <input type="text" class="form-control" name="mail" placeholder="E-mail" required>
                </div>
                <div class="col-lg-5 mx-auto col-7">
                    <button type="submit" class="form-control" id="submit-button" name="submit">Invio</button>
                </div>
            </div>

        </form>
    </div>
</body>

<section class="testimonial section-padding" id="footer">
</section>

</body>
<?php
require_once("footer.php");

?>

</html>

<?php

function controllamail($mail)
{
    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST["invio"])) {
    $mail = filter_var($_POST["mail"], FILTER_SANITIZE_EMAIL);
    $controllo = controllamail($mail);
    if ($controllo == true) {
    }
}
?>