<?php
	$host = "localhost";
	$user = "postgres";
	$pass = "root";
	$port = "5432";
	$dbname = "tb_pbd";

	$conn = pg_connect("host=".$host." port=".$port." dbname=".$dbname." user=".$user." password=".$pass) or die("Gagal");
?>
