<?php

if(isset($_GET['vkey'])) {
	$vkey = $_GET['vkey'];

	$mysqli = NEW MySQLi('localhost', 'root', '', 'capstone1');

	$verified = $mysqli->query("SELECT verified, vkey FROM logininfo where verified = 0 AND vkey = '$vkey' LIMIT 1");

	if ($verified -> num_rows == 1 ) {
		$update = $mysqli->query("UPDATE logininfo SET verified = 1 where vkey = '$vkey' LIMIT 1");
		if($update)
		{
			echo "Your account has been verified. Please log in";
		}
		else
		{
			echo $mysqli->error;
		}
	}
	else
	{
		echo "This account is already verified";
	}

}
else{
	die('Something went wrong!');
}

?>