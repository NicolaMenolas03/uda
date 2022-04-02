<html>
    <form method="POST">
        Nome<input type="text" name="nome"><br>
        Cognome<input type="text" name="cognome"><br>
        Telefono<input type="text" name="telefono"><br>
    
        Username<input type="text" name="username"><br>
        Mail<input type="text" name="mail"><br>
        Password<input type="password" name="password"><br>
       <input type="submit" name="invio">
    </form>

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
            if (!empty("mail")||!empty("password")){
                $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
                $controllo = controllamail($mail);
                if ($controllo==true){
                    
                }
                else{

                }
            }
        }
    ?>
</html>