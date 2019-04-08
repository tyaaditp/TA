<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Admin Page</title>
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
    <div class="container">
        <a class="navbar-brand font-weight-bold page-scroll" href="#home" style="font-size:150%">OPTAN</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link page-scroll" href="#home">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="optan.html" tabindex="-1">Logout</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
 </nav>
 <section class="mt-5 pt-5 text-center">
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
            </tr>

 <?php
$conn = mysqli_connect("localhost", "root", "", "ta_anotasi");
  // Check connection
  if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
  } 
  $sql = "SELECT id, nama, email, username, password, role FROM user";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["nama"] . "</td><td>" . $row["email"] . "</td><td>" . $row["username"] . "</td><td>"
. $row["password"]. "</td><td>" . $row["role"] . "</td></tr>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>
        </table>
    </div>
    <div>
        <a class="btn btn-warning btn-sm mt-4" href="UserRegister.html">Add New Data</a>
    </div>
 </section>


    <!-- Footer -->
    <footer class="bg-dark text-white fixed-bottom">
        <div class="container text-center">
            <div class="row pt-2">
                <div class="col">
                    <p style="font-size:12px">&copy; 2019 | Built with <img src="svg/si-glyph-heart.svg" style="width:16px;
                        height:16px;"> by Nav.</p>
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