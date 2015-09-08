<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>chatroom</title>
<link rel="stylesheet" type="text/css" href="css/page.css" />
<link rel="stylesheet" type="text/css" href="css/chat.css" />
<script src="js/jquery.js"></script>
<script src="js/chat.js"></script>
</head>

<body>
<?php 
session_name('webchat');
session_start();
if (!$_SESSION["logininfo"]){
        echo '<script type="text/javascript">alert("您尚未登陆");location.href = "login.php";</script>';
}
?>
<div id="chatContainer">

    <div id="chatTopBar" class="rounded">
        <span>
            <span class="name"><?php echo $_SESSION["userid"]; ?></span>
            <a class="logoutButton">Logout</a>
        </span>
    </div>
    
    <div id="chatUsers" class="rounded"></div>
    <form name=fm>
        <textarea id="myTextArea" readonly="true" style="resize:none;height:370px;width:350px"></textarea>
    </form>

    <div id="chatBottomBar" class="rounded">
    	<div class="tip"></div>
        
        <form id="submitForm" method="post" action="">
            <input id="chatText" name="chatText" class="rounded" maxlength="255" />
            <input type="submit" class="blueButton" value="Submit" />
        </form>
        
    </div>
    
</div>
</body>
</html>
