<?php
require_once('header.php');
require_once("ConnessionDB.php");
session_start();
?>
<html class="no-js">
      <head>
      <script>
      (function(e, t, n) {var r = e.querySelectorAll("html")[0];r.className = r.className.replace(/(^|\s)no-js(\s|$)/, "$1js$2")})(document, window, 0);
</script>
      </head>


<body>
      <?php if (!isset($_SESSION["Controllo"])) {
      ?>
            <div class="col-lg-8 mx-auto col-md-10 col-12">
                  <form method="post" class="contact-form" data-aos="fade-up" data-aos-delay="300" role="form">

                        <div class="row">
                              <div class="col-lg-6 col-12">
                                    <input type="text" class="form-control" name="nome" placeholder="Nome" required>
                              </div>

                              <div class="col-lg-6 col-12">
                                    <input type="text" class="form-control" name="cognome" placeholder="Cognome" required>
                              </div>

                              <div class="col-lg-6 col-12">
                                    <input type="text" class="form-control" name="telefono" minlength="10" maxlength="10" min="3333333333" max="3999999999" placeholder="Telefono" required>
                              </div>

                              <div class="col-lg-6 col-12">
                                    <input type="text" class="form-control" name="mail" placeholder="Mail" required>
                              </div>

                              <div class="col-lg-5 mx-auto col-7">
                                    <input type="submit" class="form-control" name="invia" value="Invia" class="form-control" id="submit-button">
                              </div>

                        </div>
                  </form>
            </div>
      <?php
      }
      function controllamail($mail)
      {
            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                  return true;
            } else {
                  return false;
            }
      }

      if (isset($_POST["invia"])) {
            $mail = filter_var($_POST["mail"], FILTER_SANITIZE_EMAIL);

            $controllo = controllamail($mail);
            if ($controllo == true) {
                  $_SESSION["Controllo"] = 1;
                  $sql = "INSERT INTO Proprietari(Nome, Cognome, Telefono, Email) VALUES ('" . $_POST["nome"] . "','" . $_POST["cognome"] . "','" . $_POST["telefono"] . "','" . $mail . "')";

                  if ($conn->query($sql) === TRUE) {
                        if (isset($_GET['error'])) :
                              echo $_GET['error'];
                        endif;
                        echo "<Script>window.location.href='InserisciCasa.php';</Script>";
                  } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                  }
            }
      }


      if (isset($_SESSION["Controllo"])) { ?>

            <div class="col-lg-8 mx-auto col-md-10 col-12">

                  <form action="upload.php" class="contact-form" data-aos="fade-up" data-aos-delay="300" role="form" method="post" enctype="multipart/form-data">
                        <div class="row">
                              <div class="col-lg-6 col-12">
                                    <input type="text" class="form-control" name="Toponimo" placeholder="Toponimo" required>
                              </div>

                              <div class="col-lg-6 col-12">
                                    <input type="text" class="form-control" name="NomeVia" placeholder="Nome Via" required>
                              </div>

                              <div class="col-lg-6 col-12">
                                    <input type="text" class="form-control" name="Civico" placeholder="Civico" required>
                              </div>
                              <div class="col-lg-6 col-12" style="margin-top:11px;">
                                    <select name="comune" id="comuni" class="custo-select" required>
                                          <?php


                                          $sql = "SELECT IdComune,CAP,Comune FROM comuni";
                                          $result = mysqli_query($conn, $sql); ?>
                                          <option>-Seleziona Comune-</option>
                                          <?php
                                          while ($row = mysqli_fetch_array($result)) {
                                                echo "<option value='" . $row['IdComune'] . "'>" . $row['CAP'] . " | " . $row['Comune'] . "</option>";
                                          }

                                          ?>
                                    </select>
                              </div>
                              <div class="col-lg-6 col-12">
                                    <input type="number" class="form-control" name="Prezzo" placeholder="Prezzo" required>
                              </div>

                              <div class="col-lg-6 col-12">
                                    <input type="text" class="form-control" name="Descrizione" placeholder="Descrizione" required>
                              </div>
                              <div class="col-lg-6 col-12">
                                    <input type="text" class="form-control" name="Posizione" placeholder="Posizione" required>
                              </div>
                              <div class="col-lg-6 col-12" style="margin-top:11px;">
                              <input type="file" name="file_1" id="file_1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple required />
					<label for="file_1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Scegli un file&hellip;</span></label>
                              </div>
                              <div class="col-lg-5 mx-auto col-7">
                                    <input type="submit" class="form-control" name="submit" value="Invia" id="submit-button">
                              </div>
                              

                        </div>
                  </form>
            </div>

      <?php
      
      }

      ?>

 <script src="js/custom-file-input.js"></script>
</body>

<?php
require_once("footer.php");
?>

</html>