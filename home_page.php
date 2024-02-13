<!DOCTYPE html>
<html lang="en">
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
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/heart.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/searchBar.css">
    <link rel="icon" href="images\legere-low-resolution-logo-color-on-transparent-background.png">
</head>
<body>
<header>
    <div class="logo">
        <img src="images\legere-low-resolution-logo-color-on-transparent-background.png" alt="Online Library Logo">
    </div>
    <nav>
        <ul>
            <li>
            <form action="home_page.php" method="post">
                <div style="width:372px">
                <input type="text" class="search-input" name="search" placeholder="Search...">
                <button style="float:right;" class="search-button"><i class="fa fa-search"></i></button>
                </div>
           </form>
            </li>
            <li><a href="#" style="color: #189FD6;">Home</a></li>
            <li><a href="books.php">Books</a></li>
            <li><a href="aboutus.php">About us</a></li>
            <li><a href="contactus.php">Contact us</a></li>
            <li><a href="logout.php">Exit</a></li>
        </ul>
    </nav>
</header>
<main>
    <div class="genres">
        <h2>Genres</h2>
        <ul>
        <li><a href="genres/drama.php">Драма</a></li>
            <li><a href="genres/comedy.php">Комедия</a></li>
            <li><a href="genres/mistery.php">Мистерия</a></li>
            <li><a href="genres/romance.php">Романтика</a></li>
            <li><a href="genres/action.php">Екшън</a></li>
            <li><a href="genres/fantasy.php">Фантастика</a></li>
            <li><a href="genres/biografi.php">Биография</a></li>
            <li><a href="genres/children.php">Детски</a></li>
            <li><a href="genres/classic.php">Класика</a></li>
            <li><a href="genres/adventurous.php">Приключенски</a></li>
        </ul>
    </div>

    <div class="grid-container" >
        <?php
        session_start();

        include 'parts/dbConnection.php';

        if (isset($_POST['search'])) {
	    $searchName=$_POST['search'];

        header("Location: searchedBook.php?searchName=".urldecode($searchName));

   }
        $user_id = $_SESSION['id'];
        $sql = "SELECT * FROM books ORDER BY id DESC LIMIT 5";

        $result = mysqli_query($conn, $sql);
         
        echo '<h1>New:</h1>' ;
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="grid-item ">'; 
            echo '<p>' . $row["author"] . '</p>';
            // Check if the book is liked by the user
            $liked = false;
            $liked_sql = "SELECT * FROM book_user WHERE user_id = $user_id AND book_id = " . $row['id'];
            $liked_result = mysqli_query($conn, $liked_sql);
            if (mysqli_num_rows($liked_result) > 0) {
                $liked = true;
            }

            // Update heart icon based on whether the book is liked or not
            if ($liked) {
                echo '<span  class="like-' . $row['id'] . '"><a style="color:red;" href="#" onclick="unlike(' . $row['id'] . ')">&hearts;like</a></span>';
            } else {
                echo '<span class="like-' . $row['id'] . '"><a style="color:gray;" href="#" onclick="doLike(' . $row['id'] . ')">&hearts;like </a></span>';
            }
            
            echo '<img class="book" src="' . $row["url_address"] . '" alt="PPPPP" style="width: 150px; height: 200px;">';
            echo '<a href="description_book.php?id=' . $row["id"] . '">' . $row["name"] . '</a>';
            echo '<span id="heart"><i class="fa fa-heart-o" aria-hidden="true"></i> </span>';
            echo '</div>';
        
        }
        $sql = "SELECT b.author, b.url_address, b.name, b.id, COUNT(bu.book_id) FROM book_user as bu
        JOIN books as b ON b.id=bu.book_id
        GROUP BY(book_id) Order by  COUNT(book_id) desc Limit 5";

        $result = mysqli_query($conn, $sql);
        echo '<br>';
        echo '<h1>Popular:</h1>' ;
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="grid-item">'; 
            echo '<p>' . $row["author"] . '</p>';
            // Check if the book is liked by the user
            $liked = false;
            $liked_sql = "SELECT * FROM book_user WHERE user_id = $user_id AND book_id = " . $row['id'];
            $liked_result = mysqli_query($conn, $liked_sql);
            if (mysqli_num_rows($liked_result) > 0) {
                $liked = true;
            }

            // Update heart icon based on whether the book is liked or not
            if ($liked) {
                echo '<span  class="like-' . $row['id'] . '"><a style="color:red;" href="#" onclick="unlike(' . $row['id'] . ')">&hearts;like</a></span>';
            } else {
                echo '<span  class="like-' . $row['id'] . '"><a style="color:gray;" href="#" onclick="doLike(' . $row['id'] . ')">&hearts;like </a></span>';
            }
            echo '<img class="book" src="' . $row["url_address"] . '" alt="PPPPP" style="width: 150px; height: 200px;">';
            echo '<a href="description_book.php?id=' . $row["id"] . '">' . $row["name"] . '</a>';
            echo '<span id="heart"><i class="fa fa-heart-o" aria-hidden="true"></i> </span>';
            echo '</div>';
        
        }

        mysqli_close($conn);
        ?>
    </div>
        
<!-- end  -->
    <div style="clear:both;"></div>
    <header>
    <div class="logo" style="min-height:100px;">
        
    </div>
    <nav>
        <ul>
            <li><a href="#">Copyright &copy; 19519 - Катерина </a></li>
        </ul>
    </nav>
    </header>
</main>
</body>
</html>