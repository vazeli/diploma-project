<?php 

$count_block_on_page = 10;

include('table.php');
$dataBase = new DAtaBase();
$dataBase-> connectDB("control_system_project");

$dataBase->db->query ( "set names utf8" );

$c = $_REQUEST['course'];
$now_page = $_REQUEST['now_page'];
if ($c == -1 ){
	if( $now_page + $c > 0){
		$now_page = $now_page + $c;
	}
	else{
		$now_page = 1;
	}
}

$sql = "SELECT count(*) FROM `view_project_and_customer` ";
$res=$dataBase->db->query($sql);
$count_data =  $res->fetch_array();
$pages = ceil($count_data[0] / $count_block_on_page) + 1;

if ($c == 1 ){
	if( $now_page + $c < $pages){
		$now_page = $now_page + $c;
	}
	else{
		$now_page = $pages;
	}
}
$list=($now_page-1)*$count_block_on_page;
$sql = "SELECT * FROM `view_project_and_customer`  LIMIT $list,$count_block_on_page";
$res = $dataBase->db->query($sql);
$array = array();
$i = 0;
while($row = $res->fetch_array())
{
	$array[$i] = $row;
	
	$i++;
}
$data[1] = $now_page;
$data[2] = $sql;
$data[3] = $array;


echo json_encode($data);