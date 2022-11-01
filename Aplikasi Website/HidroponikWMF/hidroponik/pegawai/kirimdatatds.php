<?php 
	//Koneksi ke Database
	$konek = mysqli_connect("localhost", "root", "", "hidroponikwmf");

	$nilai_tds = $_GET["sensor"];

	mysqli_query($konek, "INSERT INTO m_tds (id_tds, nilai_tds) VALUES ('','$nilai_tds')");
?>