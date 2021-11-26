<?php

$UserID = $_POST['UserID'];
$Address = $_POST['Address'];
$Purok = $_POST['Purok'];
$Line2 = "Malanday, Marikina City";


if ($_POST['Password'] === $_POST['cpassword']) {
if (!empty($UserID) || !empty($Email) || !empty($Password))

{
	
	$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbname = "capstone";

	//create connection
	$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
	if (mysqli_connect_error()) {
		die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
	}

	else
	{	
		$SELECT = "SELECT UserID from logininfo Where UserID = ? Limit 1";
		$INSERT = "INSERT Into logininfo(UserID, Email, Password) values (?,?,?)";

		$stmt = $conn->prepare($SELECT);
		$stmt -> bind_param("s", $UserID);
		$stmt -> execute();
		$stmt -> bind_result($UserID);
		$stmt -> store_result();
		$rnum = $stmt -> num_rows;

		if ($rnum == 0)

		{
			$stmt -> close();

			$stmt = $conn->prepare($INSERT);
			$stmt->bind_param("sss", $UserID, $Email, $Password);
			$stmt->execute();
			echo "Registration Successful!";
		} else {
			echo "UserID is already registered.";
		}
		$stmt -> close();
		$conn->close();
}
}

else
{
	echo "All fields are quired";
	die();
}
}
else
{
	header("location: Register.php");
	echo '<script>alert("Password not matched.")</script>';
}

?>


