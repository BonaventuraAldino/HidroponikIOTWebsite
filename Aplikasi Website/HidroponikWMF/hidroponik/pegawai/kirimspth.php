<?php 
	//Koneksi ke Database
	$konek = mysqli_connect("localhost", "root", "", "hidroponikwmf");

	$status_pompath = $_GET["status_pompaTH"];

	mysqli_query($konek, "INSERT INTO k_tds (id, status_pompa) VALUES ('','$status_pompath')");
?>