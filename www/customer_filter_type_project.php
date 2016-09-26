<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<link rel="stylesheet" href="css/main_page_style.css">
	<script src="js/jquery.js"></script>
	<script>
		function show_project(obj){
			var e = obj.innerHTML;
		
			$.ajax({
				url: 'get_data_type_customer.php',
				type: 'POST',
				data: {cust_type : e},
				dataType: 'json',
				success: function(data){
					$('.information').css("display","block");
					$('.table-all-data').css("display","none");
					$('.title').html(e);
					$('#myTable > tbody > tr').remove();

					for(i= 0; i <=10;i++){
						$('#myTable').append('<tr></tr>');

						$('#myTable > tbody > tr:last').append('<td>'+data[i][0]+'</td>');
					}
				}	
			});

	
		}
		function close_info(){
			$('.information').css("display","none");
			$('.table-all-data').css("display","block");
		}
	</script>
</head>
<body>
	<div class="information">
		<div class="close" onclick='close_info();'>X</div>
		<div class="title"></div>
		<table id="myTable"></table>
	</div>
	<?php 
		include("table.php");
		$dataBase = new DAtaBase();
		$dataBase-> connectDB("control_system_project");
		$dataBase-> getAllCustomerType();
	 ?>
</body>
</html>