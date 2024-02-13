<?php 
// стартиране на сесия ( ще трябва по-долу )
session_start();


if ( !$_SESSION['user'] ) {
	
	// ако няма логнат потребител се прави пренасочване към login.php
	
	header("location: admin-login.php");
	exit;
}


$servername = "localhost";
$username = "root";
$password = "";
$database = "kursovadb";

try {
  $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

$delete = @$_GET['delete'];

if ( $delete ) {
	
	$connection->query("DELETE FROM books WHERE id = '$delete'");
}

$books = $connection->query("SELECT * FROM books")->fetchAll();

?>	

<html>
<head></head>
<body>

<a href="admin-add.php">добави книга</a>

<table border=1>
<?php
foreach( $books as $book ) {
?>
	<tr>
		<td><?= $book['name'] ?></td>
		<td><?= $book['genere'] ?></td>
		<td><?= $book['author'] ?></td>
		<td><a href="admin-books.php?delete=<?= $book['id'] ?>" style="color:Red">delete</a></td>
	</tr>
<?php
}
?>
</table>


</body>
</html>
