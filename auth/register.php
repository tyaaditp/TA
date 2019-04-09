<?php
	require('../config.php');
	session_start();
	$email = $_POST['email'];
	$pass = $_POST['password'];
	$username = $_POST['username'];
    $name = $_POST['name'];
    $role = 'admin';
	
	$sql = "INSERT INTO user(nama, email, username, password, role) VALUES (
				'$name','$email','$username','$pass','$role')";

	$execute  = mysqli_query($link, $sql);
	
	header('Location: /TA/login.php');
?>