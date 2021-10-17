<?php

session_start();
$error = '';

if (isset($_POST['submit'])) {
	if (empty($_POST['UserID']) || empty($_POST['Password'])) {
		$error = "Username or Password is Invalid";
	}

	else
	{
		$UserID = $_POST['UserID'];
		$Password = $_POST['Password'];

		$conn = mysqli_connect("localhost", "root", "", "capstone");

		$query = "SELECT UserID, Password from logininfo Where UserID = ? AND Password = ? LIMIT 1";

		$stmt = $conn->prepare($query);
		$stmt->bind_param("ss", $UserID, $Password);
		$stmt->execute();
		$stmt->bind_result($UserID, $Password);
		$stmt->store_results();

		if ($stmt->fetch()) {

			$_SESSION['login_user'] = $UserID;
			echo "login succesfully";
		}
		else{
			$error = "Username or Password is Invalid!";
		}
		mysqli_close($conn);

	}
}
?>