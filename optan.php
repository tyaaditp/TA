<?php
	session_start();
	if(isset($_SESSION['username'])) {
		header('Location: /TA/');
		die;
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>OPTAN Annotator</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>

		<!-- Home -->
		<div id="home" class="hero-area">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax" style="background-image:url(./img/03_h.jpg)"></div>
			<!-- /Backgound Image -->

			<div class="home-wrapper">
				<div class="container text-center">
					<!-- <div class="row"> -->
						<!-- <div class="col-md-8"> -->
                            <!-- <h1 class="white-text">Edusite Free Online Training Courses</h1> -->
                            <img src="logooptan.png" alt="Logo Optan" width="25%">
							<p class="lead white-text">Online Annotation Tools</p>
							<a class="main-button icon-button" data-target="#loginForm" data-toggle="modal" href="#">Login</a>
						<!-- </div> -->
					<!-- </div> -->
				</div>
			</div>

		</div>
		<!-- /Home -->

		<!-- About -->
		<div id="about" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<!-- <div class="row"> -->
						<div class="section-header text-center">
							<h2>Welcome to Optan</h2>
							<p class="lead">An online annotation tools for education purposes.</p>
						</div>
					<div class="row">
						<!-- feature -->
						<div class="feature col-md-6 border-right">
							<i class="feature-icon fa fa-low-vision"></i>
							<div class="feature-content">
								<h4>Simple Use Annotation Tools </h4>
								<p>Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.</p>
							</div>
						</div>
						<!-- /feature -->

						<!-- feature -->
						<div class="feature col-md-6">
							<i class="feature-icon fa fa-percent"></i>
							<div class="feature-content">
								<h4>Compare to Expert Teachers</h4>
								<p>Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.</p>
							</div>
						</div>
						<!-- /feature -->
					</div>
				<!-- </div> -->
				<!-- row -->

			</div>
			<!-- container -->
		</div>
		<!-- /About -->

		<!-- /Courses -->

		<!-- Contact CTA -->
		<div id="contact-cta" class="section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url(./img/03_h.jpg)"></div>
			<!-- Backgound Image -->

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<div class="col-md col-md-offset-2 text-center">
            <h2 class="white-text">Contact Us</h2>
						<p class="lead white-text">Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.</p>
						<a class="main-button icon-button" data-target="#registerForm" data-toggle="modal" href="#">Register Now !</a>
					</div>

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
        <!-- /Contact CTA -->
        
        <!-- form login -->

    <div class="modal" id="loginForm" tabindex="-1" data-backdrop="static">
        <div class="modal-dialog modal-sm">
          <center>
          <div class="modal-content bg-dark">
            <div class="modal-header">
              <h4 class="modal-title" style="color:beige;">OPTAN LOGIN FORM</h4>
              <button class="close pull-right" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <form action="/TA/auth/login.php" method="POST">
                <input type="text" name="username" class="text text-center" autocomplete="off" required placeholder="username"><br><br>
                <input type="password" name="password" class="text text-center" required placeholder="password"><br><br>
								<a href="#" data-target="#registerForm" data-toggle="modal" style="color:beige; font-size:10px;">Don't have an account?</a><br><br>
                <input type="Submit" name="submit" id="submit">
                <input type="button" name="cancel" value="Cancel" data-dismiss="modal"/>
              </form>
            </div>
          </div>
          </center>
        </div>
    </div>
			
		<!-- login failed alert -->
		<!-- <div class="modal" id="loginFailed" tabindex="-1" data-backdrop="static">
        <div class="modal-dialog modal-sm">
					<div class="modal-content bg-light">
						<div class="modal-body">
						
							<p>Your username or password may wrong !</p>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
						</div>
					</div>
				</div>
		</div> -->


    <!-- form register admin -->
    <div class="modal" id="registerForm" tabindex="-1" data-backdrop="static">
        <div class="modal-dialog">
          <center>
          <div class="modal-content bg-dark">
            <div class="modal-header">
              <h4 class="modal-title" style="color:beige;">OPTAN REGISTER FORM</h4>
              <button class="close pull-right" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <form action="/TA/auth/register.php" method="POST" class="text-center">
                <input type="text" name="name" class="text text-center" autocomplete="off" required placeholder="Name"><br><br>
                <input type="text" name="username" class="text text-center" autocomplete="off" required placeholder="Username"><br><br>
                <input type="password" name="password" class="text text-center" required placeholder="Password"><br><br>
                <input type="email" class="text text-center" id="inputEmail" name="email" required placeholder="Email Address"><br><br>
                <input type="Submit" name="submit" id="submit">
                <input type="button" name="cancel" value="Cancel" data-dismiss="modal"/>
              </form>
            </div>
          </div>
          </center>
        </div>
    </div>

		<!-- Footer -->
		<footer id="footer" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- footer logo -->
					<!-- <div class="col-md-6"> -->
						<div class="footer-logo">
							<a class="logo" href="index.html">
								<img src="logooptan.png" style="width:150px; height:150px;" alt="logo">
							</a>
						</div>
					<!-- </div> -->
					<!-- footer logo -->

				</div>
				<!-- /row -->

				<!-- row -->
				<div id="bottom-footer" class="row">

					<!-- copyright -->
					<div class="col-md-8 col-md-pull-4">
							<div class="footer-copyright">
								<span>&copy; Copyright 2019. All Rights Reserved. | TA.1819.1.1.L BME ITB</a></span>
							</div>
						</div>
						<!-- /copyright -->

					<!-- social -->
					<div class="col-md-4 col-md-push-8 pull-right">
						<ul class="footer-social">
							<li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
							<!-- <li><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li> -->
							<!-- <li><a href="#" class="youtube"><i class="fa fa-youtube"></i></a></li> -->
							<li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
						</ul>
					</div>
					<!-- /social -->

				</div>
				<!-- row -->

			</div>
			<!-- /container -->

		</footer>
		<!-- /Footer -->

		<!-- preloader -->
		<div id='preloader'><div class='preloader'></div></div>
		<!-- /preloader -->


		<!-- jQuery Plugins -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
		<!-- <script>
				$.ajax({  
                     url:"login.php",  
                     method:"POST",  
                     data: {username:username, password:password},  
                     success:function(data)  
                     {  
                          //alert(data);  
                          if(data == 'No')  
                          {  
                               alert("Wrong Data");  
                          }    
                     }  
                }); 
		</script> -->


	</body>
</html>
