<!-- 公共聊天窗口页面刷新 -->
<html>
<head>
<meta charset="UTF-8">
<script src='./js/ajax4.0.js'></script>
		<script src='./js/jquery-1.6.js'></script>
</head>
<body>
<div id='content' style="overflow:auto;width:1400px;height:500px;padding:10px;border:1px solid #000;"></div>
<script>
function putinfo(data){
	$("#content").html(data);
	document.getElementById('content').scrollTop += 5000;
	}
function myrefresh(){
	Ajax().get('centernp.php',putinfo);
}
setInterval('myrefresh()',1000);
</script>
<table style='text-aligh:left' border='1'>
</table>
</body>
</html>
