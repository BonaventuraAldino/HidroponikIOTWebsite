<?php 
	//Koneksi ke Database
	$konek = mysqli_connect("localhost", "root", "", "hidroponikwmf");

	$nilai_ph = $_GET["sensorph"];

	mysqli_query($konek, "INSERT INTO m_ph (id_ph, nilai_ph) VALUES ('','$nilai_ph')");
?>