<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/cssAbout.css">
    <link rel="icon" href="images\legere-low-resolution-logo-color-on-transparent-background.png">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images\legere-low-resolution-logo-color-on-transparent-background.png" alt="Online Library Logo">
        </div>
        <nav>
            <ul>
                <li><a href="home_page.php">Home</a></li>
                <li><a href="books.php">Books</a></li>
                <li><a href="#" style="color: #189FD6;">About us</a></li>
                <li><a href="contactus.php">Contact us</a></li>
                <li><a href="logout.php">Exit</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
            <h2>Здравей, <?php session_start(); $my_name = $_SESSION['username']; echo $my_name ?> !</h2>
            <p>Този сайт е създаден за Ваше удобство през 2023г. Тук можете да намерите най-новите, интересни, разнообразни, наскоро издадени книги по цял свят, преведени на български език. Ние Ви предлагаме да използвате напълно безплатно и неограничено нашите услуги, в която и точка на света да се намирате, каквото и да правите, при наличие на интернет нашия сайт е на ваше разположение.</p>
            <p>При възникване на проблем можете да се свържете с нас на <a href="contactus.php">Contact us</a>.</p>
        </div>
    </main>
</body>
</html>
