<?php 
	//Koneksi ke Database
	$konek = mysqli_connect("localhost", "root", "", "hidroponikwmf");

	$status_pompaphd = $_GET["status_pompapHDH"];

	mysqli_query($konek, "INSERT INTO k_ph (id, status_pompad, status_pompau) VALUES ('','$status_pompaphd','0')");

?>