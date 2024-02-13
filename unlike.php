<?php
include 'parts/dbConnection.php';




$id = (int) $_GET['id'];

$query ="DELETE FROM book_user WHERE book_id = ".$id." AND user_id = ".$user_id;
$result = mysqli_query($conn, $query);


if ( $result ) {
?>
<a style="color:gray;" href="#." onclick="doLike(<?= $id ?>)">&hearts; like</a>

<?php
}
?>