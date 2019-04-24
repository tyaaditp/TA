<?php
 session_start();
 $nama = filter_input(INPUT_POST, 'nama');
 $email = filter_input(INPUT_POST, 'email');
 $username = filter_input(INPUT_POST, 'username');
 $password = filter_input(INPUT_POST, 'password');
 $role = filter_input(INPUT_POST, 'role');
 $parent_id = $_SESSION['id'];
 
 if (!empty($nama)) {
     if (!empty($email)) {
         if (!empty($username)) {
            if (!empty($password)) {
                if (!empty($role)){
                    require('./config.php');
                    // Create connection
                    //$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
                    if (mysqli_connect_error()){
                    die('Connect Error ('. mysqli_connect_errno() .') '
                    . mysqli_connect_error());
                    }
                    else{
                    $sql = "INSERT INTO user (nama, email, username , parent_id, password, role)
                    values ('$nama','$email','$username','$parent_id','$password','$role')";
                    if ($link->query($sql)){
                        $link_address = 'admin.php';
                        header('Location: /admin.php');
                        //echo "<a href='$link_address'>Click here for back to admin page</a>";
                    // echo "New record is inserted sucessfully";
                    }
                    else{
                    echo "Error: ". $sql ."
                    ". $link->error;
                    }
                    $link->close();
                    }
                    }
                    else{
                    // echo "Role should not be empty";
                    echo "<script type='text/javascript'>
                            alert('Role should not be empty!'); 
                            window.location = '/admin.php';
                        </script>";
                    die();
                    }
            } else {
                // echo "Password should not be empty";
                echo "<script type='text/javascript'>
                            alert('Password should not be empty!'); 
                            window.location = '/admin.php';
                        </script>";
                die();
            }
         } else {
            // echo "Username should not be empty";
            echo "<script type='text/javascript'>
                            alert('Username should not be empty!'); 
                            window.location = '/admin.php';
                        </script>";
            die();
         }
     } else {
        // echo "Email should not be empty";
        echo "<script type='text/javascript'>
                            alert('Email should not be empty!'); 
                            window.location = '/admin.php';
                        </script>";
        die();
     }

} else {
// echo "name should not be empty";
echo "<script type='text/javascript'>
        alert('Name should not be empty!'); 
        window.location = '/admin.php';
    </script>";
die();
}
?>