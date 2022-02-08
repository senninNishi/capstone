<?php
session_start();

if(isset($_SESSION['u'])) {
  $name = $_SESSION['u'];
  echo ("Welcome,$name");

} 
else
{
  echo "Please log in first.";
  header ("location: login.php");
}


if (isset($_POST['submit']))
{
  $fname = $_POST['fname'];
  $mname = $_POST['mname'];
  $lname = $_POST['lname'];
  $address = $_POST['address'];
  $age = $_POST['age'];
  $birthday = date('Y-m-d', strtotime($_POST['birthday']));
  $gender = $_POST['gender'];
  $types = $_POST['Type'];
  $allCheckboxes = implode(", ", $types);

  $mysqli = NEW MySQLi('localhost', 'root', '', 'capstone1');

  $insert = $mysqli->query("INSERT INTO beneinfo (fname, mname, lname, address1, age, birthday, gender, benetype) VALUES ('$fname','$mname','$lname','$address','$age','$birthday','$gender','$allCheckboxes')");
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">


<html>

    <head>
    <meta charset="utf-8">
  <link rel="stylesheet" href="css/master.css">
  <link rel="stylesheet" href="css/style.css">
        <title>Beneficiary registration</title>
    <body>

    
    <header>
    <nav>
      <div class="container-flex">
        <div class="nav-1 nav"><h3>Brgy. Malanday Information System</h3></div>
        <div class="nav-2 nav">
          <ul class="navigation">
            <li><a href="guest.html">Home</a></li>
            <li><a href="news.html">News</a></li>
            <li><a href="services.html">Benefits</a></li>
            <li><a href="contacts.html">Contacts</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div>
      </div>

    </nav>
  </header>
        

        <div class="fields">
        <center>
        <form method ="POST">
        <p>Beneficiary First Name</p>
        <input type ="text" name="fname" id="fname" placeholder="Beneficiary's First name" required></input>

        <p>Beneficiary Middle Name</p>
        <input type ="text" name="mname" id="mname" placeholder="Beneficiary's Middle name"  required></input>

        <p>Beneficiary Last Name</p>
        <input type ="text" name="lname" id="lname" placeholder="Beneficiary's Last name"  required></input>

        <p>Beneficiary Address</p>
        <input type ="text" name="address" id="address" placeholder="Beneficiary's Address"  required></input>

        <p>Beneficiary Age</p>
        <input type ="text" name="age" id="age" placeholder="Beneficiary's Age"  required></input>

        <p>Beneficiary Birthday</p>
        <input type = "date" name = "birthday" id = "birthday"></input>

        <p>Beneficiary Gender</p>
        <input type="radio" id="gender" name="gender" value="Male" checked>Male
        <input type="radio" id="gender" name="gender" value="Female">Female

        <p>Beneficiary type</p>
        <input type="checkbox" name="Type[]" value="PWD">PWD</input>
        <input type="checkbox" name="Type[]" value="Infant">Infant</input>
        <input type="checkbox" name="Type[]" value="Senior">Senior</input>
        <input type="checkbox" name="Type[]" value="Pregnant">Pregnant</input>
        <br>
        <input type="submit" name="submit"> Enroll beneficiary</input>

</center>
</div>


</body>


</html>