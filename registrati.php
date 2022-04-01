<html>
    <form method="POST">
        Mail<input type="text" name="mail">
        Password<input type="password" name="password">
       <input type="submit" name="invio">
    </form>

    <?php
        function controllamail($mail)
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
        }

        if (isset("invio")){
            if (!empty("mail")||!empty("password")){
                $mail= filter_var($mail, FILTER_SANITIZE_EMAIL);
                controllamail($mail);
            }
        }
    ?>
</html>