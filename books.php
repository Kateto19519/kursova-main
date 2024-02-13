<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved books</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/cssAll.css">
    <link rel="icon" href="images\legere-low-resolution-logo-color-on-transparent-background.png">
</head>

<style>
    body {
        background-color: #ECF78B;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    .grid-item {
        display: inline-block;
        float: left;
        display: grid;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 20px;
    }
    .grid-item p {
        margin: 0;
        text-align: center;
    }
    .grid-item img {
        height: 150px;
        width: 150px;
        text-align: center;
    }
    /* Responsive Styles */
    @media only screen and (max-width: 700px) {
        .grid-item {
            padding: 10px;
        }

        .grid-item img {
            height: 100px;
            width: 100px;
        }
    }
    button{
    background-color: #f0f0f0;
    padding: 10px;
    text-align: center;
    background-color: #244BE8;
    color: white;
    border-radius: 5px; cursor: pointer;
}
</style>

<body>
<header>
    <div class="logo">
        <img src="images\legere-low-resolution-logo-color-on-transparent-background.png" alt="Online Library Logo">
    </div>
    <nav>
        <ul>
            <li><a href="home_page.php">Home</a></li>
            <li><a href="books.php"  style="color: #189FD6;">Books</a></li>
            <li><a href="aboutus.php">About us</a></li>
            <li><a href="contactus.php">Contact us</a></li>
            <li><a href="logout.php">Exit</a></li>
        </ul>
    </nav>
</header>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
function doLike(id) {
    $.ajax({
        url: "like.php?id=" + id,
        success: function(result) {
            $(".like-" + id).html(result);
        }
    });
}
function unlike(id) {
    $.ajax({
        url: "unlike.php?id=" + id,
        success: function(result) {
            $(".like-" + id).html(result);
        }
    });
}
</script>

<?php
session_start();

include 'parts/dbConnection.php';

$user_id = $_SESSION['id'];

$sql = "SELECT * FROM books JOIN book_user ON id = book_id WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);

echo '<div id="main">';
echo '<h1 style="text-align: center;">Харесани от вас</h1>';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="grid-item">'; 
    echo '<p style="text-align: center;">' . $row["author"] . '</p>';
    // Check if the book is liked by the user
    $liked = false;
    $liked_sql = "SELECT * FROM book_user WHERE user_id = $user_id AND book_id = " . $row['id'];
    $liked_result = mysqli_query($conn, $liked_sql);
    if (mysqli_num_rows($liked_result) > 0) {
        $liked = true;
    }

    // Update heart icon based on whether the book is liked or not
    if ($liked) {
        echo '<span class="like-' . $row['id'] . '" ><a style="text-align: center; color:red;" href="#." onclick="unlike(' . $row['id'] . ')">&hearts; like</a></span>';
    } else {
        echo '<span class="like-' . $row['id'] . '" ><a style="color:gray;" href="#." onclick="doLike(' . $row['id'] . ')">&hearts; like</a></span>';
    }
    echo '<img class="book" src="' . $row["url_address"] . '" alt="PPPPP" style=" text-align: center;width: 150px; height: 200px;">';
    echo '<a  href="description_book.php?id=' . $row["id"] . '" >' . $row["name"] . '</a>';
    echo '<span id="heart"><i class="fa fa-heart-o" aria-hidden="true"></i> </span>';
    echo '</div>';
}
echo '<div style="clear:both;"></div>';
echo '<button onclick="window.location.href=\'home_page.php\'">Go back</button>';
echo '</div>';

mysqli_close($conn);
?>
