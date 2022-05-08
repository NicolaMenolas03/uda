<?php 
session_start();

if (isset($_POST['submit']) && isset($_FILES['file_1'])) {
	require_once('ConnessionDB.php');


	$img_name = $_FILES['file_1']['name'];
	$img_size = $_FILES['file_1']['size'];
	$tmp_name = $_FILES['file_1']['tmp_name'];
	$error = $_FILES['file_1']['error'];

	if ($error === 0) {
		if ($img_size > 125000) {
			$em = "Sorry, your file is too large.";
		    header("Location: InserisciCasa.php?error=$em");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'uploads/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

				// Insert into Database
				$Toponimo = $_POST["Toponimo"];
				$NomeVia = $_POST["NomeVia"];
				$Civico = $_POST["Civico"];
				$idComuneApp = $_POST["comune"];
				$Prezzo = $_POST["Prezzo"];
				$Descrizione = $_POST["Descrizione"];
				$IDPROP = $_SESSION['IdProprietario'];
				$Posizione = $_POST["Posizione"];
				$sql = "INSERT INTO appartamenti(Toponimo, NomeVia, Civico, idComuneApp, Prezzo, Descrizione, IdProprietario, Posizione, image) 
				        VALUES('$Toponimo', '$NomeVia', $Civico, $idComuneApp, '$Prezzo', '$Descrizione', $IDPROP, '$Posizione', '$new_img_name')";
				
				if (mysqli_query($conn, $sql)) {
					echo "New record created successfully";
					header("Location: index.php");
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
				
				mysqli_close($conn);

				
				
			}else {
				$em = "You can't upload files of this type";
		        header("Location: InserisciCasa.php?error=$em");
			}
		}
	}else {
		$em = "unknown error occurred!";
		header("Location: InserisciCasa.php?error=$em");
	}

}else {
	//header("Location: InserisciCasa.php");
}