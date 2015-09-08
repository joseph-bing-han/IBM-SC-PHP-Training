<!-- 左侧用户登录列表刷新 -->
<html>
<head>
<meta charset="UTF-8">
<script src='./js/ajax4.0.js'></script>
		<script src='./js/jquery-1.6.js'></script>
<title>Login users</title>
</head>
<body>
<div id='content' style="overflow:auto;width:120px;height:500px;padding:10px;border:1px solid #000;"></div>
<script>
function putinfo(data){
	$("#content").html(data);
	document.getElementById('content').scrollTop += 5000;
	}
function myrefresh(){
	Ajax().get('getlist.php',putinfo);
}
setInterval('myrefresh()',1000);
</script>
<table style='text-aligh:left' border='1'>
</table>
</body>
</html>
