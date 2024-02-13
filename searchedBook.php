<!DOCTYPE html>
<html lang="en">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
function doLike(id) {
    $.ajax({
        url: "like.php?id=" + id,
        success: function(result) {
            $("#like-" + id).html(result);
        }
    });
}
function unlike(id) {
    $.ajax({
        url: "unlike.php?id=" + id,
        success: function(result) {
            $("#like-" + id).html(result);
        }
    });
}
</script>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Searched result</title>
    <link rel="icon" href="images\legere-low-resolution-logo-color-on-transparent-background.png">
</head>
<body>
<?php

session_start();
include 'parts/dbConnection.php';

if (isset($_GET['searchName'])) {
    $searchName = $_GET['searchName'];
    $user_id = $_SESSION['id'];

    $searchName = mysqli_real_escape_string($conn, $searchName);
    $query = "SELECT * FROM books WHERE name LIKE '%$searchName%' OR author LIKE '%$searchName%'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) <= 0){
    echo "Няма съвпадения. Моля опитайте пак.";
    echo '<button style="margin: 20px; background-color: #244BE8; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="window.location.href=\'home_page.php\'">Go back</button>';
}else{
    while ($row = mysqli_fetch_assoc($result)) {
        
        echo '<div class="grid-item">'; 
        echo '<p>' . $row["author"] . '</p>';
        $liked = false;
        $liked_sql = "SELECT * FROM book_user WHERE user_id = $user_id AND book_id = " . $row['id'];
        $liked_result = mysqli_query($conn, $liked_sql);
        
        if (mysqli_num_rows($liked_result) > 0) {
            $liked = true;
        }

        // Update heart icon based on whether the book is liked or not
        if ($liked) {
            echo '<span id="like-' . $row['id'] . '"><a style="color:red;" href="#." onclick="unlike(' . $row['id'] . ')">&hearts; like</a></span>';
        } else {
            echo '<span id="like-' . $row['id'] . '"><a style="color:gray;" href="#." onclick="doLike(' . $row['id'] . ')">&hearts; like</a></span>';
        }
        echo '<img  class="book" src="' . $row["url_address"] . '" alt="PPPPP" style="width: 150px; height: 200px;">';
        echo '<a href="description_book.php?id=' . $row["id"] . '">' . $row["name"] . '</a>';
        echo '<span id="heart"><i class="fa fa-heart-o" aria-hidden="true"></i> </span>';
        echo '</div>';
    }
}
}  
?>
</body>
</html>
