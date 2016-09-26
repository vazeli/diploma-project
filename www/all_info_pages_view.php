<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/main_page_style.css">
	<script src="js/jquery.js"></script>
	<script>
		function createTable(data){
			$('#myTable > tbody > tr').remove();
			for(i= 0; i <=10;i++){
				$('#myTable').append('<tr></tr>');

				$('#myTable > tbody > tr:last').append('<td>'+data[i][0]+'</td>');
				$('#myTable > tbody > tr:last').append('<td>'+data[i][1]+'</td>');
				$('#myTable > tbody > tr:last').append('<td>'+data[i][2]+'</td>');
				$('#myTable > tbody > tr:last').append('<td width="80">'+data[i][3]+'</td>');
		
				
			}
		}

		function next_page(c){

			var now = $('#now_page').text();
			
			$.ajax({
				url: 'get_data_all_info.php',
				type: 'POST',
				data: {course: c,
					now_page: now},
					dataType: 'json',
					success: function(data){

						$('#now_page').text(data[1]);
					//	$('#dd').text(data[2]);
					var i = 0;

					createTable(data[3]);
				}
			});
		}
	</script>
</head>
<body>
	<script>next_page(-1);</script>
	<div class="main-container">
		<div class="title">
			<p>page now : </p><p id="now_page">1</p>
		</div>

		<div class="nav" onclick='next_page(-1);'>left</div>
		<div class="nav" onclick='next_page(1);'>right</div>
		<table id="myTable"></table>

	</div>
</body>
</html>