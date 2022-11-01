<?php 
	//Koneksi ke Database
	$konek = mysqli_connect("localhost", "root", "", "hidroponikwmf");

	$status_pompaphu = $_GET["status_pompapHUM"];

	mysqli_query($konek, "INSERT INTO k_ph (id, status_pompad, status_pompau) VALUES ('','0','$status_pompaphu')");

?>