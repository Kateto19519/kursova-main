<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Description</title>
    <link rel="icon" href="images\legere-low-resolution-logo-color-on-transparent-background.png">
    <style>
        body {
            display: flex;
            justify-content: center;
            font-family: Arial, sans-serif;
            background-color: rgb(235, 225, 160);
        }
        .container {
            #display: flex;
            justify-content: center;
            align-items: center;
        }
        h1 {
            margin: 20px;
            padding-top: 20px;
            align-self: flex-start;
        }
        .book {
            margin-top: 130px;
            width: 300px;
            height: 400px;
        }
        .description {
            #width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgb(250, 247, 230);
            margin-left: 20px;
        }
        button {
            
            margin-top: 25px;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
        <?php
        session_start();
        include 'parts/dbConnection.php';
        $id = $_GET['id'];
        $sql = "SELECT * FROM books where id=$id ";

        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
        }
        mysqli_close($conn);
        ?>


<style>
.a {
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: rgb(250, 247, 230);
}
.b {

    margin:20px;
    margin-top:0;
}
</style>

<div class="a">
<h1><?= $row['author'] ?></h1>
<img class="b" src="<?php echo $row["url_address"]; ?>" alt="PPPPP" style="float:left;">    
<?php echo $row["description"]; ?></a>
<br>
<button onclick="window.location.href='home_page.php'">Go back</button>
</div>


</body>
</html>
