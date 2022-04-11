<html>
    <form method="POST">
        Numero Carta di Credito<input type="text" name="numcred" maxlength="16" min="0" max="9999999999999999" required><br>
        Scegli tipo di carta:<select name="carta" id="carta" required>
            <option value="visa" name="cartadicredito">Visa</option>
            <option value="maestro" name="cartadicredito">Maestro/MasterCard</option>
        </select>
        CVV:<input type="number" name="cvv" maxlength="3" min="0" max="999" required><br>
        Mail per ricevere ricevuta:<input type="text" name="mail" required>
        <input type="submit" name="invio">
    </form>
</html>

<?php
    if (isset($_POST["invio"])){
        
    }
?>
