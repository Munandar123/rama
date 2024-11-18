<?php
$config = mysqli_connect("localhost","root","","dataweb01");
if (!$config) {
	die('Gagal terhubung ke MySQLi :'.mysqli_connect_error());
}
?>
