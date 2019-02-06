<?php
session_start();
?>

<?php include("template/header.php"); ?>

	<h2>User CRUD</h2>
    <h2>Hello marah<?= $_SESSION['email'] ?></h2>
    <h2>Sebagai <?= $_SESSION['role'] ?></h2>
	<p>Halaman tentang manajemen pengguna / user </p>
	<ul>
		<li><a href="user/index.php">List</a></li>
		<li><a href="user/create.php">Create</a></li>
	</ul>
</div>
<?php include("template/footer.php"); ?>