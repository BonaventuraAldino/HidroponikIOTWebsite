<?php 
	//Koneksi ke Database
	$konek = mysqli_connect("localhost", "root", "", "hidroponikwmf");

	$status_pompatm = $_GET["status_pompaTM"];

	mysqli_query($konek, "INSERT INTO k_tds (id, status_pompa) VALUES ('','$status_pompatm')");

?>