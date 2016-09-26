<?php 

include('table.php');
$dataBase = new DAtaBase();
$dataBase-> connectDB("control_system_project");

$dataBase->db->query ( "set names utf8" );
$name = $_REQUEST['name'];
$level = $_REQUEST['level'];
$pr_one = $_REQUEST['pr_one'];
$pr_two = $_REQUEST['pr_two'];
if($level == "lvl_one")
{
	$sql = 'SELECT lvl_two, lvl_tree, lvl_four, project FROM `all_data` WHERE lvl_one = "'.$name.'"';
}
if($level == "lvl_two")
{
	$sql = 'SELECT  lvl_tree, lvl_four, project FROM `all_data` WHERE lvl_two = "'.$name.'" and lvl_one = "'.$pr_one.'"';
}
if($level == "lvl_tree")
{
	$sql = 'SELECT  lvl_four, project FROM `all_data` WHERE lvl_tree = "'.$name.'" and lvl_two = "'.$pr_one.'" and lvl_one = "'.$pr_two.'"';
}

$res = $dataBase->db->query($sql);
$array = array();
$i = 0;
while($row = $res->fetch_array())
{
	$array[$i] = $row;
	
	$i++;
}


echo json_encode($array);