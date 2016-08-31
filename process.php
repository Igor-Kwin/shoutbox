<?php
include 'database.php';

// Check if the form was submitted.
if(isset($_POST['submit'])){
	$user = mysqli_real_escape_string($con, $_POST['user']);
	$message = mysqli_real_escape_string($con, $_POST['message']);

	//Set the timezone.
	date_default_timezone_set('America/New_York');
	$time = date(date_rfc2822,time());

	//Validate the input.
	if(!isset($user) || $user == '' || !isset($message) || $message == ''){
		$error = "Please fill in your name and a message";
		header("Location: index.php?error=".urlencode($error));
		exit();
	}
	else {
		$query = "INSERT INTO shouts (user, message, time)
					VALUES ('$user', '$message', '$time')";
					if(!mysqli_query($con, $query)){
						die('Error: ' .mysqli_error($con));
					}
					else{
						header("Location: index.php");
						exit();
					}
	}
}