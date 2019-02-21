<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>OPTAN</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="/sample-app">Sample APP</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse float-right" id="navbarNav">
			<ul class="navbar-nav ml-auto">
				<?php 
					if(!(isset($_SESSION['email']))) { 
				?>
					<li class="nav-item ">
						<a class="nav-link" href="/TA/register.php">Register</a>
					</li>
					<li class="nav-item">
							<a class="nav-link" href="/TA/login.php">Login</a>
					</li>
				<?php } else { ?>
					<li class="nav-item">
						<a class="nav-link" href="/TA/logout.php">Logout</a>
					</li>
				<?php } ?>

			</ul>
		</div>
	</nav>
	<div class="container-fluid">