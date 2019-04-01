<?php
	session_start();
	if(isset($_SESSION['username'])) {
		header('Location: /TA/');
		die;
	}
?>
<?php include("template/header.php"); ?>
<h2>Login form</h2>
<form action="/TA/auth/login.php" method='POST'>
	<div class="form-group">
		<label for="inputEmail">Email address</label>
		<input type="email" class="form-control" id="inputEmail" name="email">
	</div>
	<div class="form-group">
		<label for="inputPassword">Password</label>
		<input type="password" class="form-control" id="inputPassword" name="password">
	</div>
	<button type="submit" class="btn btn-primary">Login</button>
</form>
<?php include("template/footer.php"); ?>
