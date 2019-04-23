<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Super Admin Page</title>
    <style>
        table {
        border-collapse: collapse;
        width: 100%;
        color: #231e11;
        font-family: Helvetica, sans-serif;
        font-size: 15px;
        text-align: left;
        } 
        .tabel {
        margin-left: 30px;
        margin-right: 30px;
        }
        th {
        background-color: #231e11;
        color: white;
        }
        tr:nth-child(even) {background-color: #f2f2f2}
    </style>
</head>
<body>

 <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-warning">
    
    <div class="container" style="margin: 0px 5px;">
        <!-- <a class="navbar-brand font-weight-bold page-scroll" href="#home" style="font-size:150%">OPTAN</a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- <div class="logo"><img src="minilogo.png" alt="minilogo optan" style="width:70px;"></div> -->
        <div class="collapse navbar-collapse " id="navbarSupportedContent" style="font-size: 100%;">
            <ul class="navbar-nav mr-auto" style="height:50px;">
                <img src="minilogo.png" alt="minilogo optan" style="width:100px; height:60px;">
            </ul>
            <ul class="navbar-nav ml-auto" style="height:50px;">
                <li class="nav-item">
                    <a class="nav-link btn btn-sm btn-outline-secondary" href="/TA/logout.php" tabindex="-1"><b>Logout</b></a>
                </li>
            </ul>
            <!-- <div class="navbar-nav mr-auto" style="height:50px;">
                <img src="minilogo.png" alt="minilogo optan" style="width:70px;" class="nav-item active">
                <a class="nav-link pull-right" href="/TA/logout.php" tabindex="-1">Logout</a>
            </div> -->
            <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
            </form> -->
        </div>
    </div>
 </nav>
 <section class="mt-5 pt-5 text-center mb-5">
    <h2>User Data</h2>
    <div class="tabel">
        <table>
            <tr>
                <th>Id</th> 
                <th>Nama</th>
                <th>Email</th>
                <th>Username</th> 
                <th>Password</th>
				<th>Role</th>
				<th>Ijin Akses</th>
            </tr>

 <?php
$conn = mysqli_connect("localhost", "root", "", "TA_anotasi");
  // Check connection
  if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
  } 
  $id = $_SESSION['id'];
  $sql = "SELECT id, nama, email, username, password, role, akses FROM user"; 
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
	echo "<tr>
	<td>" . $row["id"]. "</td>
	<td>" . $row["nama"] . "</td>
	<td>" . $row["email"] . "</td>
	<td>" . $row["username"] . "</td>
	<td>" . $row["password"]. "</td>
	<td>" . $row["role"] . "</td>
	<td>" . $row["akses"] ."<form action='gantistatus.php' method='post' style='display:inline;'><input name='akses' type='hidden' value='".$row["akses"]."'/><input type='hidden' name='id' value='".$row["id"]."'/> <button value='ganti status'/> Ganti status  </form></td>
	</tr>" ;
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>
        </table>
    </div>
    <div>
        <a class="btn btn-warning btn-sm mt-4" data-target="#addDataUser" data-toggle="modal">Add New Data</a>
        <!-- <a class="btn btn-warning btn-sm mt-4" href="UserRegister.html">Add New Data</a> -->
    </div>
 </section>

    <!-- form add new data user -->
    <div class="modal" id="addDataUser" tabindex="-1" data-backdrop="static">
        <div class="modal-dialog modal-sm">
          <center>
          <div class="modal-content bg-dark">
            <div class="modal-header">
              <h4 class="modal-title" style="color:beige;">ADD NEW USER DATA</h4>
              <button class="close pull-right" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" action="connectToDatabase.php">
                    <input type="text" name="nama" placeholder="Name" class="text-center"><br><br>
                    <input type="email" name="email" placeholder="Email Address" class="text-center"><br><br>
                    <input type="text" name="username" placeholder="Username" class="text-center"><br><br>
                    <input type="password" name="password" placeholder="Password" class="text-center"><br><br>
                    <!-- <input type="text" name="role" placeholder="User Role"><br><br> -->
                    <div class="form-group">
                        <select name="role" placeholder="Select Role">
                            <option class="disabled">Select Role</option>
                            <option>Expert</option>
                            <option>Doctor</option>
                        </select>
                    </div>
                    <input type="submit" value="Submit" class="submit"> 
                    <input type="button" name="cancel" value="Cancel" data-dismiss="modal"/>
                </form>
            </div>
          </div>
          </center>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white fixed-bottom">
        <div class="container text-center">
            <div class="row pt-2">
                <div class="col">
                    <p style="font-size:12px">&copy; 2019 | TA.1819.1.1.L</p>
                    <!-- <p style="font-size:12px">&copy; 2019 | Built with <img src="svg/si-glyph-heart.svg" style="width:16px;
                        height:16px;"> by Nav.</p> -->
                </div>
            </div>
        </div>
    </footer>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>