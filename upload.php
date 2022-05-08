<?php 
session_start();

if (isset($_POST['submit']) && isset($_FILES['file_1'])) {
	require_once('ConnessionDB.php');

	echo "<pre>";
	print_r($_FILES['file_1']);
	echo "</pre>";

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
				echo "Toponimo".$_POST["Toponimo"]."<br>";
				echo "Nomevia".$_POST["Nomevia"]."<br>";
				echo "Civico".$_POST["Civico"]."<br>";
				echo "idComuneApp".$_POST["idComuneApp"]."<br>";
				echo "Prezzo".$_POST["Prezzo"]."<br>";
				echo "Descrizione".$_POST["Descrizione"]."<br>";
				echo "idProprietario".$_POST["idProprietario"]."<br>";
				echo "Posizione".$_POST["Posizione"]."<br>";
				echo "image".$_POST["image"]."<br>";
				$sql = "INSERT INTO appartamenti(Toponimo, Nomevia, Civico, idComuneApp, Prezzo, Descrizione, idProprietario, Posizione, image) 
				        VALUES('".$_POST["Toponimo"]."',".$_POST["Nomevia"]."',".$_POST["Civico"]."',".$_POST["comune"]."',".$_POST["Prezzo"]."',".$_POST["Descrizione"]."',".$_POST["idProprietario"].",".$_POST["Posizione"]."','$new_img_name')";
				mysqli_query($conn, $sql);
				session_destroy();
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