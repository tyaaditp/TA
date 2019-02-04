<?php
session_start();
if(($_SESSION['role']) != 'SUPERADMIN' ) {
	header('Location: index.php');
	die;
}
?>

khusus super admin