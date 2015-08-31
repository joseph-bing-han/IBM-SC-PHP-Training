<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $CTITLE; ?></title>
	<link rel="stylesheet" href="/Chat/css/chat.css">
</head>
<body>
    <div id="room-content">
        <div id="c-room-left">
            <div>Welcome, <span><?php echo $USERNAME; ?> </span></div>
            <input type="hidden" value="<?php echo $CURRENT_USER; ?>" id="currentuserid">
            <div id="c-room-left-list">
                <ul>
                    <?php echo $ONLINE_USERLIST; ?>
                </ul>
            </div>

        </div>
        <div id="c-room-right">
            <div id="c-room-content">
            	<?php echo $HISTORY; ?>
            </div>
            <div>
                <input type="text" id="c-room-input" placeholder="Type a message here???" autofoucus>
                <input type="button" id="c-room-send" value="Send" />
            </div>

        </div>
    </div>
    <script src="/Chat/js/jquery-2.0.3.js"></script>
    <script src="/Chat/js/app.js"></script>
</body>
</html>
