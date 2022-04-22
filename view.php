
<?php require_once('ConnessionDB.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>View</title>
	<style>
		.alb {
			width: 200px;
			height: 200px;
			padding: 5px;
		}
		.alb img {
			width: 100%;
			height: 100%;
		}
		a {
			text-decoration: none;
			color: black;
		}
	</style>
</head>
<body>
     <a href="InserisciCasa.php">&#8592;</a>
     <?php 
          $sql = "SELECT * FROM appartamenti ORDER BY IdAppartamento DESC";
          $res = mysqli_query($conn,  $sql);

          if (mysqli_num_rows($res) > 0) {
          	while ($images = mysqli_fetch_assoc($res)) {  ?>
             
             <div class="alb">
             	<img src="uploads/<?=$images['image']?>">
             </div>
          		
    <?php } }?>
</body>
</html>