<?php
 $nama = filter_input(INPUT_POST, 'nama');
 $email = filter_input(INPUT_POST, 'email');
 $username = filter_input(INPUT_POST, 'username');
 $password = filter_input(INPUT_POST, 'password');
 $role = filter_input(INPUT_POST, 'role');
 if (!empty($nama)) {
     if (!empty($email)) {
         if (!empty($username)) {
            if (!empty($password)) {
                if (!empty($role)){
                    $host = "localhost";
                    $dbusername = "root";
                    $dbpassword = "";
                    $dbname = "ta_anotasi";
                    // Create connection
                    $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
                    if (mysqli_connect_error()){
                    die('Connect Error ('. mysqli_connect_errno() .') '
                    . mysqli_connect_error());
                    }
                    else{
                    $sql = "INSERT INTO user (nama, email, username, password, role)
                    values ('$nama','$email','$username','$password','$role')";
                    if ($conn->query($sql)){
                        $link_address = 'Admin.php';
                        echo "<a href='$link_address'>Click here for back to admin page</a>";
                    // echo "New record is inserted sucessfully";
                    }
                    else{
                    echo "Error: ". $sql ."
                    ". $conn->error;
                    }
                    $conn->close();
                    }
                    }
                    else{
                    echo "Role should not be empty";
                    die();
                    }
            } else {
                echo "Password should not be empty";
                die();
            }
         } else {
            echo "Username should not be empty";
            die();
         }
     } else {
        echo "Email should not be empty";
        die();
     }

} else {
echo "name should not be empty";
die();
}
?>