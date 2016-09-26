<?php include("table.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/main_page_style.css">
</head>
<script src="js/jquery.js"></script>
<script>
	function view_low_level(obj){
		var e = obj.innerHTML;
		var lvl = obj.className;
		var prev1 = null, prev2 = null;
		if(lvl != "one")
		{
			prev1 = obj.previousSibling;
			prev2 = prev1.previousSibling;
			if (prev1 != null)
			{
				prev1 = prev1.innerHTML;
			}
			else
				prev1 = null;
			if (prev2 != null)
			{
				prev2 = prev2.innerHTML;
			}
			else 
				prev2 = null;
		}
		if(lvl == "four")
			alert("Самый низкий уровень иерархии");
		$.ajax({
			url: 'get_low_tree.php',
			type: 'POST',
			data: {name : e, level : lvl, pr_one : prev1, pr_two : prev2},
			dataType: 'json',
			success: function(data){
				$('.information').css("display","block");
				$('.table-all-data').css("display","none");
				$('.title').html(e);
				$('#myTable > tbody > tr').remove();
				for(i= 0; i <=data.length;i++){
					$('#myTable').append('<tr></tr>');
					if(data[i][0]!= undefined)
						$('#myTable > tbody > tr:last').append('<td>'+data[i][0]+'</td>');
					if(data[i][1]!= undefined)
						$('#myTable > tbody > tr:last').append('<td>'+data[i][1]+'</td>');
					if(data[i][2]!= undefined)
						$('#myTable > tbody > tr:last').append('<td>'+data[i][2]+'</td>');
				}
			}

		});

	}
	function close_info(){
		$('.information').css("display","none");
		$('.table-all-data').css("display","block");
	} 
</script>
<body>
	<div class="information">
		<div class="close" onclick='close_info();'>X</div>
		<div class="title"></div>
		<table id="myTable"></table>
	</div>
	<?php 
	$dataBase = new DAtaBase();
	$dataBase-> connectDB("control_system_project");
	$dataBase-> getAllTree();
	?>
</body>
</html>