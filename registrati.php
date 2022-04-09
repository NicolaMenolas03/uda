<html>
    <form method="POST">
        Nome<input type="text" name="nome"><br>
        Cognome<input type="text" name="cognome"><br>
        Telefono<input type="text" name="telefono"><br>
        Città<input type="text" name="citta"><br>
        Comune  <select id="comuni">
                    <?php
                    
                        require_once('ConnessionDB.php');

                        $sql="SELECT IdComune,Comune FROM comuni"; 
                        $result=mysqli_query($conn,$sql);
                        while($row=mysqli_fetch_array($result)){
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
        Password<input type="password" name="password" autocomplete="on"><br>
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

        }

        if (isset($_POST["invio"])){
            if (!empty($_POST["nome"])&&!empty($_POST["cognome"])&&!empty($_POST["telefono"])&&!empty($_POST["citta"])&&!empty($_POST["comune"])&&!empty($_POST["via"])&&!empty($_POST["civico"])&&!empty($_POST["username"])){ 
                if (!empty($_POST["mail"])||!empty($_POST["password"])){
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
            }
            else{
                echo "<h1>Riempire tutti i campi</h1>";
            }
        }
    ?>
</html>