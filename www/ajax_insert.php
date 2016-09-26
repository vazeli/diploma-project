<?php 
 	
include('table.php');
$dataBase = new DAtaBase();
$dataBase-> connectDB("control_system_project");

$dataBase->db->query ( "set names utf8" );


	$cust = $_REQUEST['cust_type'];
	$proj = $_REQUEST['proj'];
	$start = $_REQUEST['start'];
	$finish = $_REQUEST['finish'];
	
	$sql = "INSERT into project(name,customer,time_start,time_finish)  values('$proj','$cust','$start','$finish') ";
	$res=$dataBase->db->query($sql);
	echo json_encode($finish);