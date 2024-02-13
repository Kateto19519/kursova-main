<?php

    if (isset($_POST['Login'])) {
    // Get the form data

   include 'parts/dbConnection.php';
    $email =( $_POST['email']);
    $password = ( $_POST['password']);
    $query = "SELECT * FROM kursovadb.users where email like '$email'";
    $result = mysqli_query($conn, $query);

    // Check if the query returned a result
    if (mysqli_num_rows($result) == 1) {
        // Fetch the row
        $row = mysqli_fetch_assoc($result);
        
      
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Login successful

            // Set the session variables
            session_start();
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];

            // Redirect to the dashboard page
            header("Location: home_page.php");
            exit();
        } else {
            // Login failed
            echo "Invalid password.";
        }
    }
    // Close the connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <style>
        body {
            background-image: url('images/wallpaper 7.jpg');
            font-family: Arial, sans-serif;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
        }
        form {
            max-width: 400px;
            margin: 100px 100px 50px 550px;
            padding: 20px;
            background-color: rgba(0,0,0,0.3);
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 30px;
            font-size: 16px;
            margin-bottom: 20px;
            margin-left: -10px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s ease-in-out;
            transition: background-color 0.3s ease-in-out;
            margin-top: 20px;
            margin-left: 10px;
        }
        input[type="submit"]:hover {
            background-color: #3e8e41;
        }
        .field-block {
            width:270px;
        }
        .field-block svg {
            float:left; 
        }
        .field-block input {
            width:210px; 
            float:right;
        }
        .field-block-svg1 {
            margin-top:11px;
        }
        .field-block-svg2 {
            margin-top:64px;
        }
        p {
            color: rgb(16, 16, 16);
            margin: 50px;
            text-align: center; 
        }
        p a {
            color: #4CAF50;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }
        p a:hover {
            color: #3e8e41;
        }
        @media screen and (max-width: 768px) {
            label {
                font-size: 16px;
            }
            input[type="text"],
            input[type="password"],
            input[type="submit"] {
                font-size: 16px;
            }
            p {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    <form action="signin.php" method="post" style="margin-left:auto; margin-right:auto; width:284px">

      <div class="field-block">
      <svg class="field-block-svg1" xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512"><path d="M399 384.2C376.9 345.8 335.4 320 288 320H224c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z"/></svg>
      <input type="text" id="username" name="username" required placeholder="Username">
      </div>
        
        <div class="field-block">
        <svg class="field-block-svg2" xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512"><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg>
        <input type="password" id="password" name="password" required placeholder="Password">
        </div>

        <input type="submit" value="Login" name="Login" style="width: 90%;">

        <div style="clear:both;"></div>
    </form>

    <p>Don't have an account?  <a href="signup.php"> Register now</a></p>
</body>
</html>