<?php
	session_start();
    unset($_SESSION['email']);
    unset($_SESSION['role']);
    unset($_SESSION['id']);
    unset($_SESSION['username']);
	header("location:index.php");
?>