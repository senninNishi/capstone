<?php
session_start();
session_destroy();
echo '<script language="javascript">';
echo 'alert("Logged out successfully.")';
echo '</script>';
header('Location: login.php');
exit;
?>