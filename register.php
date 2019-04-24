

<?php include("template/header.php"); ?>

<h2>Register haha</h2>
<form action="/auth/register.php" method='post'>
	<div class="form-group">
		<label for="inputEmail">Email address</label>
		<input type="email" class="form-control" id="inputEmail" name="email">
	</div>
	<div class="form-group">
		<label for="inputUsername">Username</label>
		<input type="text" class="form-control" id="inputUsername" name="username">
	</div>
	<div class="form-group">
		<label for="inputName">Name</label>
		<input type="text" class="form-control" id="inputName" name="name">
	</div>
	<div class="form-group">
		<label for="inputPassword">Password</label>
		<input type="password" class="form-control" id="inputPassword" name="password">
	</div>
    <div class="form-group">
		<label for="inputRole">Role</label>
		<input type="text" class="form-control" id="inputRole" name="role">
	</div>
	<button type="submit" class="btn btn-primary">Register</button>
</form>
<?php include("template/footer.php"); ?>
