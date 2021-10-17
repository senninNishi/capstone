<?php
include ("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $UserID1 = mysqli_real_escape_string($db,$_POST['UserID1']);
      $Password1 = mysqli_real_escape_string($db,$_POST['Password1']); 
      
      $sql = "SELECT UserID FROM logininfo WHERE UserID = '$UserID1' and Password = '$Password1' Limit 1";
      $result = mysqli_query($db,$sql) or die( mysqli_error($db));
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    
      if($count == 1) {
         $_SESSION['UserID1']=$UserID1;
         
         header("location: news.php");
      }else {
         echo "Login credentials is invalid.";;
      }
   }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">



<head>
  <meta charset="utf-8">
  <title>Malanday Database and Information System</title>
  <link rel="stylesheet" href="css/master.css">
  <link rel="stylesheet" href="css/style-login.css">
</head>

<body>
  <header class="text-align-center">
    <h1 style="margin: 0; padding: 10px;">WELCOME TO BARANGAY MALANDAY INFORMATION SYSTEM</h1>
  </header>
  
  <div class="bg">
    <div class="form-box">
      <div class="button-box">
        <div id="btn"></div>
        <button type="button" class="toggle-btn" onclick="login()">Login</button>
        <button type="button" class="toggle-btn" onclick="register()">Register</button>
      </div>
      <form id="login" class="input-group" method="POST">
        <input type="text" class="input-field" placeholder="User ID" name = "UserID1" required>
        <input type="password" class="input-field" placeholder="Enter Password" name = "Password1" required><br>
        <input type="checkbox" class="check-box" id="check-box">
        <label for="check-box">Remember Password</label>
        <div class="btn-holder"><button type="submit" class="submit-btn">Login</button></div>
      </form>

      <form id="register" class="input-group" action="insert.php" method="POST">
        <input type="text" class="input-field" placeholder="User ID" name="UserID" required>
        <input type="email" class="input-field" placeholder="Email" name="Email" required>
        <input type="password" class="input-field" placeholder="Enter Password" name="Password" id ="pword"required>
        <input type="password" class="input-field" placeholder="Re-type Password" name="cpassword" id ="cpword" required><br>
        <input type="checkbox" class="check-box" id="check-box" required>
        <label for="check-box">I accept the terms and conditions</label>
        <div class="btn-holder"><button type="submit" class="submit-btn">Register</button></div>
      </form>
    </div>
  </div>

  <script>
    var x = document.getElementById("login");
    var y = document.getElementById("register");
    var z = document.getElementById("btn");

    function register() {
      x.style.left = "-400px";
      y.style.left = "50px";
      z.style.left = "110px";
    }

    function login() {
      x.style.left = "50px";
      y.style.left = "450px";
      z.style.left = "0";
    }

    function validate(){

            var a = document.getElementById("pword").value;
            var b = document.getElementById("cpword").value;
            if (a!=b) {
               alert("Passwords do no match");
               return false;
            }
        }

    
  </script>
</body>

</html>