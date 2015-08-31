<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Chat/chatroom/ACL.php";
//access control
// App::validateChatRoom();
ACL::hasAccess();
//init chat room
$c = new ChatRoom();
$c->init();
