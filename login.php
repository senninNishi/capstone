<?php
$error = NULL;
session_start();

if(isset($_SESSION['u'])) {
    header ("location: services.php");
} 

if (isset($_POST['submit']))
{
  $mysqli = NEW MySQLi ('localhost', 'root', '', 'capstone1');

  $_SESSION['u'] = $mysqli -> real_escape_string($_POST['UserID1']);
  $_SESSION['p'] = $mysqli -> real_escape_string($_POST['Password1']);
  $_SESSION['p'] = md5($_SESSION['p']);

  $resultSet = $mysqli -> query ("SELECT * FROM logininfo WHERE username = '$_SESSION[u]' AND password = '$_SESSION[p]' LIMIT 1");
  $count = mysqli_num_rows($resultSet);
 

  if ($count == 1) 
  {
    $row = $resultSet->fetch_assoc();
      $verified1 = $row['verified'];
      $email = $row['email'];
      $date = $row['createdate'];

    if ($verified1 == 1)
    {
      //continue

      header("location: services.php");
    }
    else
    {
      echo "This account has not yet verified. An email has been sent to $email on $date. Please check your inbox.";
    }
  }
  else
  {
    echo "The username or password is incorrect.";
  }
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Malanday Database and Information System</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
  
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Login</p>
  
                  <form class="mx-1 mx-md-4" method="POST">
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="text"  id="form3Example1c" class="form-control" name="UserID1" required>
                        <label class="form-label" for="form3Example1c">Username</label>
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" id="form3Example4c" class="form-control" name="Password1" required>
                        <label class="form-label" for="form3Example4c">Password</label>
                      </div>
                    </div>
  
                    <div class="form-check d-flex justify-content-center mb-5">
                      <input
                        class="form-check-input me-2"
                        type="checkbox"
                        value=""
                        id="form2Example3c"
                      />
                      <label class="form-check-label" for="form2Example3">
                       Remember Me
                      </label>
                    </div>
                    
                  
  
                   
                      <div class="d-flex justify-content-around mx-4">
                        <button type="button" class="btn btn-primary btn-lg btn-block" onClick="location.href='register.php'">Register</button>
                        <button type="submit" name = "submit"; class="btn btn-primary btn-lg btn-block">Login</button>
                        <button type="button" class="btn btn-primary btn-lg btn-block" onClick="location.href='guest.html'">Guest</button>
                      </div>

                      <div class="d-flex justify-content-center m-5 mb-3 mb-lg-4">
                        <a href="">Forgot Password?</a>
                      </div>
                      </form>
  
                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
  
                  <img src="images/register.png" class="img-fluid" alt="Sample image">
  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>