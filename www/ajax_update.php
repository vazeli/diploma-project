<?php 
 	
include('table.php');
$dataBase = new DAtaBase();
$dataBase-> connectDB("control_system_project");

$dataBase->db->query ( "set names utf8" );


	$name = $_REQUEST['name'];
	$progr = $_REQUEST['progr'];

	
	$sql = "UPDATE  project set program=$progr where name='$name' ";
	$res=$dataBase->db->query($sql);
	echo json_encode($sql);