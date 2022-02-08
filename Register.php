<?php
$error = NULL;
session_start();
use PHPMailer\PHPMailer\PHPMailer;

require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';

$mail = new PHPMailer(true);

if (isset($_POST['submit']))
{
  
  //kinukuha yung form
  $UserID = $_POST['UserID'];
  $Password = $_POST['Password'];
  $cpassword = $_POST['cpassword'];
  $Email = $_POST['Email'];

  $mysqli2 = NEW MySQLi('localhost', 'root', '', 'capstone1');
  $resultSet = $mysqli2 -> query ("SELECT * FROM logininfo WHERE username = '$UserID' OR email = '$Email'");
  $count2 = mysqli_num_rows($resultSet);

  if ($count2 == 1 ) {
    echo ("Username or email has been used.");
    die();
  }
  
  if (strlen($UserID) < 5) {
    echo ("Username must be less than 5 characters.");
    die();
    
  }
  if ($cpassword != $Password) {
    echo ("Your passwords do not match");
    die();
  }
  else
  {
    // Pag walang error

    // Connect na sa db

    $mysqli = NEW MySQLi('localhost', 'root','','capstone1');

    //Sanitize the form data
    $UserID = $mysqli->real_escape_string($UserID);
    $Password = $mysqli->real_escape_string($Password);
    $cpassword= $mysqli->real_escape_string($cpassword);
    $Email = $mysqli->real_escape_string($Email);

    //Generate Vkey
    $vkey = md5(time() .$UserID);

    //Insert account into the database

    $Password = md5($Password);
    $insert = $mysqli->query("INSERT INTO logininfo (username, password, email, vkey) VALUES ('$UserID','$Password','$Email','$vkey')");
    try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      //Send na ng email
      $from = 'rockytotoy1@gmail.com';

      $to = $Email;
      
       
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPDebug  = 1;
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        $mail->Host       = "smtp.gmail.com";//using smtp server
        $mail->Username   = "rockytotoy1@gmail.com";//the email which will send the email 
        $mail->Password   = "zqvccjcbqxnepnez";//the password

        $mail->IsHTML(true);
        $mail->AddAddress($to, "The Server");
        $mail->SetFrom($from, "The Server");
        $mail->AddReplyTo($Email, $UserID);
        $mail->Subject = "Email Verification";
        $mail->MsgHTML("<a href='http://localhost/Capstone/postverification.php?vkey=$vkey'>Register Account</a>");

        if (!$mail->Send()) {
            echo "Error while sending Email.";
            var_dump($mail);
        } else {
            echo "Email sent successfully";
            header("location: verified.php");
            die();
        }


    }
  }
   catch (Exception $Email) {
    echo $Email->getMessage();
}
}
    

}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Malanday Database and Information System</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
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
  
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign Up</p>
  
                  <form class="mx-1 mx-md-4" method="POST" id ="registration_form">
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="email">Username</label>
                        <input type="text" id="username" class="form-control" name ="UserID" required />
                        <span class="error_form" id="username_error_message"></span>
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="email">Your Email</label>
                        <input type="email" id="email" class="form-control" name="Email" required/>
                        <span class="error_form" id="email_error_message"></span>
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="email">Password</label>
                        <input type="password" id="password" class="form-control" name="Password" required />
                        <span class="error_form" id="password_error_message"></span>
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="email">Confirm</label>
                        <input type="password" id="cpassword" class="form-control" name="cpassword" required />
                        <span class="error_form" id="retype_password_error_message"></span>
                      </div>
                    </div>
  
                    <div class="form-check d-flex justify-content-center mb-5">
                      <input
                        class="form-check-input me-2"
                        type="checkbox"
                        value=""
                        id="form2Example3c" required
                      />
                      <label class="form-check-label" for="form2Example3">
                        I agree all statements in <a href="#!">Terms of service</a>
                      </label>
                    </div>
  
                   
                      <div class="d-flex justify-content-around mx-4">
                        <button type="submit" name ="submit" value="register" class="btn btn-primary btn-lg btn-block">Submit</button>
                        <button type="button" class="btn btn-primary btn-lg btn-block" onClick="location.href='login.php'">Login</button>
                        <button type="button" class="btn btn-primary btn-lg btn-block" onClick="location.href='guest.html'">Guest</button>
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

  <script type="text/javascript">
      $(function() {

         $("#username_error_message").hide();
         $("#email_error_message").hide();
         $("#password_error_message").hide();
         $("#retype_password_error_message").hide();

         var error_username = false;
         var error_email = false;
         var error_password = false;
         var error_retype_password = false;

         $("#username").focusout(function(){
            check_username();
         });
         $("#email").focusout(function() {
            check_email();
         });
         $("#password").focusout(function() {
            check_password();
         });
         $("#cpassword").focusout(function() {
            check_retype_password();
         });

         function check_username() {
          var username_length = $("#username").val().length;
            if (username_length > 6) {
               $("#username_error_message").hide();
               $("#username").css("border-bottom","2px solid #34F458");
            } else {
               $("#username_error_message").html("Username should be more than 6 characters.");
               $("#username_error_message").show();
               $("#username").css("border-bottom","2px solid #F90A0A");
               error_username = true;
            }
         }


         function check_password() {
          var pattern = /^[a-zA-Z0-9!@#\$%\^\&*\)\(+=._-]{6,}$/g;
            var password = $("#password").val();

            if (pattern.test(password) && password !== ''){
               $("#password_error_message").hide();
               $("#password").css("border-bottom","2px solid #34F458");
            } else {
               $("#password_error_message").html("Password must contain at least one number, one lowercase and uppercase letter, and must have at least six characters.");
               $("#password_error_message").show();
               $("#password").css("border-bottom","2px solid #F90A0A");
               error_password = true;
            }
         }

         function check_retype_password() {
            var password = $("#password").val();
            var retype_password = $("#cpassword").val();
            if (password !== retype_password) {
               $("#retype_password_error_message").html("Passwords do not match");
               $("#retype_password_error_message").show();
               $("#cpassword").css("border-bottom","2px solid #F90A0A");
               error_retype_password = true;
            } else {
               $("#retype_password_error_message").hide();
               $("#cpassword").css("border-bottom","2px solid #34F458");
            }
         }

         function check_email() {
            var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var email = $("#email").val();
            if (pattern.test(email) && email !== '') {
               $("#email_error_message").hide();
               $("#email").css("border-bottom","2px solid #34F458");
            } else {
               $("#email_error_message").html("Invalid Email");
               $("#email_error_message").show();
               $("#email").css("border-bottom","2px solid #F90A0A");
               error_email = true;
            }
         }

         $("#registration_form").submit(function() {
            error_username = false;
            error_email = false;
            error_password = false;
            error_retype_password = false;

            check_username();
            check_email();
            check_password();
            check_retype_password();

            if (error_username === false && error_sname === false && error_email === false && error_password === false && error_retype_password === false) {
               alert("Registration Successfull");
               return true;
            } else {
               alert("Please Fill the form Correctly");
               return false;
            }


         });
      });
   </script>
</body>

</html>