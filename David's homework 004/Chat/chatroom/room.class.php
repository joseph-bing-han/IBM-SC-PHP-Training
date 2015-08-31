<?php
/**
 *
 * @author David
 *
 */
class ChatRoom{

	private $redis;
	private $db;
	private $template;
	private $userId;
	/**
	 *
	 */
	function __construct(){
		$this->redis = new CRedis();
		$this->db = Database::getInstance();
		$this->template = new template();
	}
	/**
	 * init the chat room
	 */
	public function init(){
		$this->userId = $_SESSION['userid'];
		$this->template->assign("CTITLE", "Welcome, SCS 聊天室");
		$this->template->assign("USERNAME", $_SESSION['username']);
		$this->template->assign("CURRENT_USER", $this->userId);

		$rs = $this->redis->getOnlineUser();
		$userIds = join(',', $rs);
		$rs = $this->db->Query("select id,name,login_time from user where id in ($userIds)");
		$userlist = '';
		if(count($rs) > 0){
			foreach ($rs as $k => $v){
				$userlist .= '<li>';
				$userlist .= $v['name'];
				$userlist .= '</li>';;
			}
		}
		$this->template->assign("ONLINE_USERLIST", $userlist);//display online user

		$rs = $this->redis->getMyMsg($this->userId);
		$history = '';
		if(!empty($rs)){
			foreach ($rs as $k => $v){
				$history .= '<div class="c-room-content-item">'.$v.'</div>';
			}
		}
		$this->template->assign("HISTORY", $history);
		$this->template->display("tpl.room.html");
	}
	/**
	 * push msg to all online user's redis db
	 * @param Array $data
	 */
	public function pushMsg($data){

		$useridStr = $this->redis->get('userid');
		$useridArr = explode(',', $useridStr);
		$actionUser = isset($data['actionUser'])?$data['actionUser']:0;
		$date = isset($data['date'])?$data['date']:0;
		$content = isset($data['content'])?$data['content']:0;
		$msg = "<span>{$actionUser}</span><span>[{$date}]: </span><span>{$content}</span>";
		foreach ($useridArr as $k => $v ){
			if($isonline = json_decode($this->redis->get($v.'_on'))){

				$newMsg = array();
				foreach ($isonline as $ok => $ov){
					if ($ok=='msg'){
						array_push($ov, $msg);
						$newMsg = $ov;
					}
				}
				$this->redis->set($v.'_on', json_encode(array('time'=>date('Y-m-d H:i:s'), 'msg'=>$newMsg)));
			}
		}

		return true;
	}
}
?>
