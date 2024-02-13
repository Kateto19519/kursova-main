<?php
include 'parts/dbConnection.php';

session_start();
$user_id = $_SESSION['id'];

$id = (int) $_GET['id'];

$query ="INSERT into book_user SET book_id = ".$id.", user_id = ".$user_id;
$result = mysqli_query($conn, $query);


if ( $result ) {
?>


<a style=" color:red;" href="#." onclick="unlike(<?= $id ?>)">&hearts; like</a>

<?php
}
?>