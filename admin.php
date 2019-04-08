<!DOCTYPE html>
<html>
<head>
 <title>Table with database</title>
 <style>
  table {
   border-collapse: collapse;
   width: 100%;
   color: #588c7e;
   font-family: monospace;
   font-size: 25px;
   text-align: left;
     } 
  th {
   background-color: #588c7e;
   color: white;
    }
  tr:nth-child(even) {background-color: #f2f2f2}
 </style>
</head>
<body>
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
</body>
</html>