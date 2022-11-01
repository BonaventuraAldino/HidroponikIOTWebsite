<?php 
	//Koneksi ke Database
	$konek = mysqli_connect("localhost", "root", "", "hidroponikwmf");

	$status_pompa = $_GET["status_pompaN"];

	mysqli_query($konek, "UPDATE k_tds SET status_pompa='$status_pompa'");
?>