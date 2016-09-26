<?php 



include('table.php');
$dataBase = new DAtaBase();
$dataBase-> connectDB("control_system_project");

$dataBase->db->query ( "set names utf8" );

$type_cus =  $_REQUEST['cust_type'];
$string_1251=iconv("UTF-8", "windows-1251", $type_cus);
$sql = 'SELECT custumer FROM `all_info_project` WHERE customer_type = "'.$type_cus.'"';

$res = $dataBase->db->query($sql);
$array = array();
$i = 0;
/*while($row = $res->fetch_array())
{
	$array[$i] = $row;
	
	$i++;
}*/

echo json_encode($type_cus);