<?php
$host = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "kursovadb";
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
  }
if (isset($_POST['signup'])) {


    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeatedpass=$_POST['repeatedpass'];
    $email=$_POST['email'];
    $check_sql = "SELECT * FROM users WHERE username='$username'";
    $check_result = mysqli_query($conn, $check_sql);
    if (mysqli_num_rows($check_result) > 0) {
      $suggested_username = $username . rand(1, 1000);
      echo "<p style='color: red; font-weight: bold;'>The username '$username' is already taken. Please try '$suggested_username'.</p>";
    } else {
      // Username does not exist, insert the user into the database
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      if ($password == $repeatedpass) {
        $insert_sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
        if (mysqli_query($conn, $insert_sql)) {
          echo "User created successfully";
          header("Location: signin.php");
          exit;
        } else {
          echo "Error: " . $insert_sql . "<br>" . mysqli_error($conn);
        }
      } else {
        echo '<p style="color: red; font-weight: bold;">Error: Passwords do not match!</p>';
      }
    }
  }
    mysqli_close($conn);
    ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
      body {
        background-image: url('images/wallpaper 6.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        font-family: Arial, sans-serif;
        background-attachment: fixed;
      }
      form {
        max-width: 300px;
        margin: 50px auto;
        padding: 20px;
        background-color: rgba(0,0,0,0.3);
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
      }
      input[type="text"], input[type="password"] , input[type="email"] {
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
        transition: background-color 0.3s ease-in-out;
        margin-top: 20px;
        margin-left: 10px;
      }
      input[type="submit"]:hover {
        background-color: #3e8e41;
      }
      .field-block {
        width: 270px;
      }
      .field-block svg {
            float: left; 
      }
      .field-block input {
            width: 210px; 
            float: right;
      }
      .field-block-svg1 {
            margin-top: 11px;
      }
      .field-block-svg2 {
            margin-top: 67px;
      }
      .field-block-svg3 {
            margin-top: 67px;
      }
      .field-block-svg4 {
            margin-top: 36px;
      }
      p {
        text-align: center;
        margin-top: 20px;
        font-size: 15px;
        color: #fff;
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

    <form action="signup.php" method="post">

      <div class="field-block">
      <svg class="field-block-svg1" xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512"><path d="M399 384.2C376.9 345.8 335.4 320 288 320H224c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z"/></svg>
      <input type="text" id="username" name="username" required placeholder="Username">
      </div>
      
      <div class="field-block">
      <svg class="field-block-svg3" style="position:relative; left:-24px;" xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
      <input type="email" id="email" name="email" required placeholder="Email">
      </div>

      <div class="field-block">
      <svg class="field-block-svg4" xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512"><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg>
      <input type="password" id="password" name="password" required placeholder="Password">
      </div>

      <div class="field-block">
      <svg class="field-block-svg2" style="position:relative; left:-20px;" xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512"><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg>
      <input type="password" id="repeatedpass" name="repeatedpass" required placeholder="Repeat Password">
      </div>

      <input type="submit" value="Sign Up" name="signup" style="width: 90%;">
    </form>

    <p>Already have an account? <a href="signin.php">Login now</a></p>

  </body>
</html>

