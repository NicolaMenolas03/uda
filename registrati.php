<html>
    <form method="POST">
        Nome<input type="text" name="nome"><br>
        Cognome<input type="text" name="cognome"><br>
        Telefono<input type="text" name="telefono"><br>
        Città<input type="text" name="telefono"><br>
        Comune  <select id="comuni">
                    <?php
                    
                        require_once('open_php.php');

                        $sql="SELECT IdComune,Comune FROM comuni"; 
                        $result=mysqli_query($conn,$sql);
                        while($row=mysqli_fetch_array($result))
                        {
                            echo "<option name='comune' value='".$row['IdComune']."'>".$row['Comune']."</option>";
                        } 
                        
                    ?>
                </select>
        
        Via<input type="text" name="via"><br>
        Civico<input type="text" name="civico"><br>
        Username<input type="text" name="username"><br>
        <!--

        Numero Carta di Credito<input type="text" name="numcred"><br>
        S<select name="cars" id="cars">
        <option value="visa" name="cartadicredito">Visa</option>
        <option value="maestro" name="cartadicredito">Maestro</option>
        </select>-->
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
            if (!empty($_POST["nome"])&&!empty($_POST["cognome"])&&!empty($_POST["telefono"])&&!empty($_POST["username"]))    
                if (!empty("mail")||!empty("password")){
                    $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
                    $controllo = controllamail($mail);
                    if ($controllo==true){
                        
                        if (is_numeric($_POST["telefono"])&&$_POST["telefono"]>3000000000){

                        }
                        else{

                        }

                    }
                    else{

                    }
                }
        }
    ?>
</html>