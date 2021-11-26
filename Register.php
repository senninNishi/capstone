<?php
$error = NULL;
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
  $check = $mysqli2->query("SELECT username FROM logininfo where username = '$UserID' or email = '$Email'");
  $count2 = mysqli_num_rows($check);

  if ($count2 == 1) {
    echo ("Username or Password has been used.");
    die();
  }

  else
  {
  if (strlen($UserID) < 5) {
    $error = "Your username must be at least 5 characters";
  }
  elseif ($cpassword != $Password) {
    $error .="<p>Your passwords do not match</p>";
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
  
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign Up</p>
  
                  <form class="mx-1 mx-md-4" method="POST">
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="text" id="username" class="form-control" name ="UserID" required />
                        <label class="form-label" for="username">Username</label>
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="email" id="email" class="form-control" name="Email" required/>
                        <label class="form-label" for="email">Your Email</label>
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" id="password" class="form-control" name="Password" required />
                        <label class="form-label" for="password">Password</label>
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" id="repeat" class="form-control" name="cpassword" required />
                        <label class="form-label" for="repeat">Repeat your password</label>
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
                        <button type="button" class="btn btn-primary btn-lg btn-block" onClick="location.href='login.html'">Login</button>
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
</body>

</html>