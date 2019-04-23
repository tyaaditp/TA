<?php
	require('../config.php');
	session_start();
	$username = $_POST['username'];
	$pass = $_POST['password'];

	$sql = "SELECT * from user WHERE username='$username' AND password='$pass'";
	$execute  = mysqli_query($link, $sql);
	if(mysqli_num_rows($execute) == 1) {
		$row = mysqli_fetch_array($execute);
		$_SESSION['email'] = $row['email'];
		$_SESSION['id'] = $row['id'];
		$_SESSION['role'] = $row['role'];
		$_SESSION['username'] = $row['username'];
		$_SESSION['parent_id'] = $row['parent_id'];

        if(($_SESSION['role']) == 'admin' ) {
            header('Location: /TA/admin.php');
        } else if(($_SESSION['role']) == 'Expert' ) {
            header('Location: /TA/trialz.php');
        } else if(($_SESSION['role'])== 'Doctor')
		    header('Location: /TA/trialzUser.php');
        }
    else {	
		// echo "<script type='text/javascript'>alert('Your username or password may wrong!')</script>";
		// echo "<script type='text/javascript'>confirm('Your username or password may wrong!')</script>";
		// header('Location: /TA/optan.php');
		$('#loginFailed').modal('show');
	}
?>
