<?php 

include('table.php');
$dataBase = new DAtaBase();
$dataBase-> connectDB("control_system_project");

$dataBase->db->query ( "set names utf8" );
$cus = $_REQUEST['cust'];
$sql = 'SELECT project_name FROM `view_project_and_customer` WHERE customer = "'.$cus.'"';
$res = $dataBase->db->query($sql);
$array = array();
$i = 0;
while($row = $res->fetch_array())
{
	$array[$i] = $row;
	
	$i++;
}


echo json_encode($array);