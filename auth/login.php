<?php
	require('../config.php');
	session_start();
	$username = $_POST['username'];
	$pass = $_POST['password'];

	$sql = "SELECT * from user WHERE username='$username' AND password='$pass' AND akses = 1";
	$execute  = mysqli_query($link, $sql);
	if(mysqli_num_rows($execute) == 1) {
		$row = mysqli_fetch_array($execute);
		$_SESSION['email'] = $row['email'];
		$_SESSION['id'] = $row['id'];
		$_SESSION['role'] = $row['role'];
		$_SESSION['username'] = $row['username'];
		$_SESSION['parent_id'] = $row['parent_id'];

        if(($_SESSION['role']) == 'admin' ) {
            header('Location: /admin.php');
        } else if(($_SESSION['role']) == 'Expert' ) {
            header('Location: /trialz.php');
        } else if(($_SESSION['role'])== 'Doctor')
			header('Location: /trialzUser.php');
		else if(($_SESSION['role'])== 'SUPERADMIN')
		header('Location: /super.php');
			
        }
    else {	
		echo "<script type='text/javascript'>
				alert('Your username or password may wrong!'); 
				window.location = '/index.php';
			</script>";
		// echo "<script type='text/javascript'>
		// 	setInterval(function() {
		// 		if (confirm('Your username or password may wrong !')) {
		// 			window.location.href = "/index.php";
		// 		}
		// 	}, 3000);
		// 	</script>";
		// echo "<script type='text/javascript'>confirm('Your username or password may wrong!')</script>";
		// header('Location: /index.php');
		// echo "<script type='text/javascript'>$('#loginFailed').modal('show');</script>";
		// 	echo "<script type='text/javascript'>
		// 	$.ajax({  
				
		// 		data: {username:username, password:password},  
		// 		success:function(data)  
		// 		{  
					
		// 				  alert('Wrong Data');  
						
		// 		}  
		//    }); 
		// 	</script>";
		
	}
?>