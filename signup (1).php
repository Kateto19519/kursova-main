
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login Form | CodingLab</title> 
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>
  <style>@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
 
  box-sizing: border-box;
  font-family: 'Poppins',sans-serif;
}
body{
  background-image: url('images/wallpaper 7.jpg');
            font-family: Arial, sans-serif;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
  overflow: hidden;
}
::selection{
  background: rgba(26,188,156,0.3);
}
.container{
  max-width: 440px;
  padding: 0 20px;
  margin: 150px auto;
}
.wrapper{
  width: 100%;
  background: #fff;
  border-radius: 5px;
  box-shadow: 0px 4px 10px 1px rgba(0,0,0,0.1);
}
.wrapper .title{
  height: 90px;
  background: #4CAF50;
  border-radius: 5px 5px 0 0;
  color: #fff;
  font-size: 30px;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
}
.wrapper form{
  padding: 30px 25px 25px 25px;
}
.wrapper form .row{
  height: 45px;
  margin-bottom: 15px;
  position: relative;
}
.wrapper form .row input{
  height: 100%;
  width: 100%;
  outline: none;
  padding-left: 60px;
  border-radius: 5px;
  border: 1px solid lightgrey;
  font-size: 16px;
  transition: all 0.3s ease;
}
form .row input:focus{
  border-color: #4CAF50;
  box-shadow: inset 0px 0px 2px 2px rgba(26,188,156,0.25);
}
form .row input::placeholder{
  color: #999;
}
.wrapper form .row i{
  position: absolute;
  width: 47px;
  height: 100%;
  color: #fff;
  font-size: 18px;
  background: #4CAF50;
  border: 1px solid #4CAF50;
  border-radius: 5px 0 0 5px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.wrapper form .pass{
  margin: -8px 0 20px 0;
}
.wrapper form .pass a{
  color: #4CAF50;
  font-size: 17px;
  text-decoration: none;
}
.wrapper form .pass a:hover{
  text-decoration: underline;
}
.wrapper form .button input{
  color: #fff;
  font-size: 20px;
  font-weight: 500;
  padding-left: 0px;
  background: #4CAF50;
  border: 1px solid #4CAF50;
  cursor: pointer;
}
form .button input:hover{
  background: #12876f;
}
.wrapper form .signup-link{
  text-align: center;
  margin-top: 20px;
  font-size: 17px;
}
.wrapper form .signup-link a{
  color: #4CAF50;
  text-decoration: none;
}
form .signup-link a:hover{
  text-decoration: underline;
}
p {
        text-align: center;
        margin-top: 20px;
        font-size: 15px;
        color: #000;
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

</style>

  <body>
    <div class="container">
      <div class="wrapper">

        <div class="title"><span>Register</span></div>
        <form method="post" action="registerValidation.php">
        <?php 
            session_start();
            if(isset($_SESSION['errors']))
            {
                $errors = $_SESSION['errors'];
                for($i = 0; $i < count($errors); $i++)
                {
                    echo '<p style="color: red">' . $errors[$i] . '</p>';
                }
            }
            unset($_SESSION['errors']);
        ?>
          <div class="row">
            <i class="fas fa-user"></i>
            <input type="text" id="username" name="username" placeholder="Username" required>
          </div>
          
          <div class="row">
             <i class="fas fa-envelope"></i>
            <input type="email" id="email" name="email" placeholder="Email" required>
          </div>

          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" name="password" placeholder="Password" required>
          </div>

          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="password" id="repeadpassword" name="repeadpassword" placeholder="Repead password" required>
          </div>
          
          <div class="row button">
            <input type="submit" name="submit" value="Register">
          </div>
          
          <p>Already have an account? <a href="signin.php">Login now</a></p>
        </form>
      </div>
    </div>

  </body>
</html>