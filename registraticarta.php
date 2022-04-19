<html>
<?php require_once('header.php') ?>

    <form method="POST">
        Numero Carta di Credito<input type="text" name="numcred" minlength="16" maxlength="16" min="0" max="9999999999999999" required><br>
        Scegli tipo di carta:<select name="carta" id="carta" required>
            <option value="visa" name="cartadicredito">Visa</option>
            <option value="maestro" name="cartadicredito">Maestro/MasterCard</option>
        </select>
        CVV:<input type="number" name="cvv" maxlength="3" minlength="3" min="1" max="999" required><br>
        Mail per ricevere ricevuta:<input type="text" name="mail" required>
        <input type="submit" name="invio">
    </form>
</html>

<?php

    function controllamail($mail){
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        else {
            return false;
        }
    }

    if (isset($_POST["invio"])){
        $mail = filter_var($_POST["mail"], FILTER_SANITIZE_EMAIL);
        $controllo = controllamail($mail);
        if ($controllo==true){
        
        }

    }
?>
