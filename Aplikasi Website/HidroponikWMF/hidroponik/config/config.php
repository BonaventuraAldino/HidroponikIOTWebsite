<?php
define("DEVELOPMENT",TRUE);
function dbConnect(){
	$db=new mysqli("localhost","root","","hidroponikwmf");
	return $db;
}

function getDataPengguna($id_pengguna){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * FROM pengguna WHERE id_pengguna='$id_pengguna'");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
?>