<?php

session_start();

if ( !$_SESSION['user'] ) {
	
	// ако няма логнат потребител се прави пренасочване към login.php
	
	header("location: admin-login.php");
	exit;
}





if ( isset( $_POST['submit'] ) ) {

	// записване на данните от полетата в променливи за по-удобно

	$url_address = $_POST['url_address'];
	$author = $_POST['author'];
	$genere = $_POST['genere'];
	$name = $_POST['name'];
	$description = $_POST['description'];


	$error = false;

	if ( !$url_address ) {
		echo "<center style='color:red;'>Попълнете url_address</center>";
		$error = true;
	}

	if ( !$author ) {
		echo "<center style='color:red;'>Попълнете author</center>";
		$error = true;
	}
	
	if ( !$genere ) {
		echo "<center style='color:red;'>Попълнете genere</center>";
		$error = true;
	}

	if ( !$name ) {
		echo "<center style='color:red;'>Попълнете name</center>";
		$error = true;
	}

	if ( !$description ) {
		echo "<center style='color:red;'>Попълнете description</center>";
		$error = true;
	}


	if ( !$error ) {

		// INSERT заявка към базата, с която се записват полетата

		$sql = "INSERT INTO books ( url_address, author, genere, name, description ) VALUES (?,?,?,?,?)";
		$result = $connection->prepare($sql)->execute([$url_address, $author, $genere, $name, $description]);
		
		// изписва съобщение, че всичко е минало успешно
		
		if ( $result ) {
			echo "<center style='color:green;'>Книгата е добавена успешно</center>";
		}
	}
	
	
	// htmlspecialchars служи да предотврятяване на грешки при въведени "специални" символи в базата..
	// Просто запомнете, че вашите полетата трябва да бъдат така направени преди да се отпечатат в сайта, за да няма проблеми с данните
	
	//$model = htmlspecialchars( $model, ENT_QUOTES );
	//$description = htmlspecialchars( $description, ENT_QUOTES );
	//$price = htmlspecialchars( $price, ENT_QUOTES );
	
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

	<link href="../../fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="../../fontawesome/css/brands.css" rel="stylesheet">
	<link href="../../fontawesome/css/solid.css" rel="stylesheet">
	  
  </head>
  <body>

	<a href="admin-books.php">назад</a>


	<div class="container">
		<div class="row">
			<div class="col-3"></div>
			<div class="col-md-6 col-12">

				<form method="post" enctype="multipart/form-data">
					<br>
					<label class="form-label">url_address:</label>
					<input type="text" name="url_address" class="form-control" value="<?= @$url_address ?>">
					<br>
					
					<label class="form-label">author:</label>
					<input type="text" name="author" class="form-control" value="<?= @$author ?>">
					<br>

					<label class="form-label">genere:</label>
					<input type="text" name="genere" class="form-control" value="<?= @$genere ?>">
					<br>

					<label class="form-label">name:</label>
					<input type="text" name="name" class="form-control" value="<?= @$name ?>">
					<br>

					<label class="form-label">description:</label>
					<textarea name="description" class="form-control"><?= @$description ?></textarea>
					<br>
					
					<button name="submit" class="btn btn-primary w-100" type="submit" value="submit">Submit</button>
				</form>
	 
			</div>
		</div>
	</div>

  </body>
</html>
