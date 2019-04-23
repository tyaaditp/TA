<?php
	session_start();
	if(isset($_SESSION['username'])) {
		header('Location: /TA/');
		die;
	}
?>
<!-- <?php include("template/header.php"); ?> -->
<!-- <h2>Login Form</h2>
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
</form> -->
<!-- <?php include("template/footer.php"); ?> -->
<!DOCTYPE html>
<html>
    <head>
        <title>LOGIN</title>
        <style type="text/css">
            #main{
                background-color: #333;
                width: 600px;
                height: 300px;
                border-radius: 30px;
            }
            h1{
                color: white;
                background-color: black;
                border-top-right-radius: 30px;
                border-top-left-radius: 30px;
            }
            .text{
                background-color: #333;
                color: white;
                width: 250px;
                font-weight: bold;
                font-size: 20px;
                border: none;
                text-align: center;
            }
            .text:focus{
                outline: none;
            }
            #submit{
                width: 250px;
                height: 30px;
                background-color: #ffdb58;
                border: none;
            }
            hr{
                width: 250px;
                margin-top: 0px !important;
            }
        </style>
    </head>
    <body>
        <center>
            <div id="main">
                <h1>OPTAN LOGIN FORM</h1>
                <form action="/TA/auth/login.php" method="POST">
                    <input type="text" name="username" class="text" autocomplete="off" required placeholder="username"><br><hr><br>
                    <input type="password" name="password" class="text" required placeholder="password"><br><hr><br>
                    <input type="Submit" name="submit" id="submit">
                </form>
            </div>
        </center>
    </body>

</html>