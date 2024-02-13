<?php
session_start();
$host = "localhost";
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

<?php
    
    if (isset($_POST['Login'])) {
    // Get the form data

    // Connect to the database
    $host = "localhost"; // or your database host
    $user = "root"; // your database username
    $pass = ""; // your database password
    $db = "kursovadb"; // your database name
    $conn = mysqli_connect($host, $user, $pass, $db);

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare the query
    $query = "SELECT * FROM kursovadb.users WHERE username='$username'";
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
    } else {
        // Login failed
        echo "Invalid username.";
    }

    // Close the connection
    mysqli_close($conn);
}
?>