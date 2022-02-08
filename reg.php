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