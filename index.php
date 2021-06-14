<html>
<head>
	<script src="./modeles/jquery-3.3.1.min.js"></script>
	<link href="css/default.css" rel="stylesheet" type="text/css"/>
	<script>
		$(document).ready(function(){
			$("#calcsumm").click(function(){
				var nom = $("#nominal").val();
				var sum = $("#summ").val();				
				$.ajax({
					url: "./modeles/calc.php",
					type:"POST",
					data:{nom: nom, sum: sum},
					success:function(result){
						$('#ANSW').html(result);
						$('.answer').css('display','block');
					}});
			});
		});
	</script>
	<title>Банкомат</title>
</head>
<body>
<div class="all" style="">
	<div class="main">Банкомат</div>
	<div class="container">
		<div class="left">
			<label for="nominal">Номинал в наличии (Разделитель ',' или '.')</label><br>
			<input id="nominal" type="text" name="nominal" required value="" placeholder="5,10,20,30,50">
			<label for="summ">Ваша сумма</label><br>
			<input id="summ" type="text" name="summ" required value="" placeholder="1045">
		</div>
		<div class="right">
			<input type="submit" name="send" id="calcsumm" value="Отправить"/>
		</div>
		<div class="answer">
			<div class="left">Ответ:</div>
			<div id="ANSW"></div>
		</div>
	</div>
</div>
</body>
</html>