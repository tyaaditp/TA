<?php
	require('../config.php');
	session_start();
	$email = $_POST['email'];
	$pass = $_POST['password'];

	$sql = "SELECT * from user WHERE email='$email' AND password='$pass'";
	$execute  = mysqli_query($link, $sql);
	if(mysqli_num_rows($execute) == 1) {
		$row = mysqli_fetch_array($execute);
        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = $row['role'];
        if(($_SESSION['role']) == 'SUPERADMIN' ) {
            header('Location: /TA/super.php');
        } else if(($_SESSION['role']) == 'ADMIN' ) {
            header('Location: /TA/index.php');
        } else
		    header('Location: /TA/index.php');
        }
    else {
		header('Location: /TA/login.php');
	}
?>