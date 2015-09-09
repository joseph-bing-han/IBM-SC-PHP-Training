<?php
include_once "config.inc";
include_once $_SERVER['DOCUMENT_ROOT']."/Chat/lib/db.abstract.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Chat/lib/db.class.php";

include_once $_SERVER['DOCUMENT_ROOT']."/Chat/login/login.php";

include_once $_SERVER['DOCUMENT_ROOT']."/Chat/class/tpl.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Chat/chatroom/room.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Chat/class/cRedis.class.php";

include_once $_SERVER['DOCUMENT_ROOT']."/Chat/acl/ACL.php";