<html>
    <form method="POST">
        Nome<input type="text" name="nome" required><br>
        Cognome<input type="text" name="cognome" required><br>
        Telefono<input type="text" name="telefono" required><br>
        Città<input type="text" name="citta" required><br>
        Comune  <select id="comuni" required>
                    <?php
                    
                        require_once('ConnessionDB.php');

                        $sql="SELECT IdComune,Comune FROM comuni"; 
                        $result=mysqli_query($conn,$sql);
                        while($row=mysqli_fetch_array($result)){
                            echo "<option name='comune' value='".$row['IdComune']."'>".$row['Comune']."</option>";
                        } 
                        mysqli_close($conn);
                        
                    ?>
                </select>
        
        Via<input type="text" name="via" required><br>
        Civico<input type="text" name="civico" required><br>
        Username<input type="text" name="username" required><br>
        <!--

        Numero Carta di Credito<input type="text" name="numcred"><br>
        S<select name="cars" id="cars">
        <option value="visa" name="cartadicredito">Visa</option>
        <option value="maestro" name="cartadicredito">Maestro</option>
        </select>-->
        Mail<input type="text" name="mail" required><br>
        Password<input type="password" name="password" autocomplete="on" required><br>
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

        function controllonumero($numero){
            if (is_numeric($_POST["telefono"])&&$_POST["telefono"]>3000000000){
                return true;
            }
            else{
                return false;
            }
        }

        function controllousername($username){
            
            require_once('ConnessionDB.php');

            $sql="SELECT UsernameCliente FROM clienti"; 
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($result)){
                if ($username!=$row["UsernameCliente"]){
                    return true;
                }
                else{
                    return false;
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
                        //reindirizzamento pagina per inserire dati carta di credito
                    }
                    else{

                    }
                }
                else{
                }

            }
            else{

            }
                
        }
    ?>
</html>