<!DOCTYPE html>
<html lang="en" dir="ltr">
  <?php
session_start();
?>



<head>
  <meta charset="utf-8">
  <title>Malanday Database and Information System</title>
  <link rel="stylesheet" href="css/master.css">
  <link rel="stylesheet" href="css/style.css">


  
</head>

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

  

  <h1>Hello there, <?php echo $_SESSION['u'];?></h1>
</body>

<footer class="footer-position-fixed">
  <div class="footer_content">
    <ul>
      <li><a href="news.html">News</a></li>
      <li><a href="services.html">Benefits</a></li>
      <li><a href="contacts.html">Contacts</a></li>
      <li class="footer_year">2021</li>
      

      
    </ul>

  </div>

</footer>

</html>
