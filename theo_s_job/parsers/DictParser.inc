<?php
class DictParser {
	
	protected $content;
	
	public function init($position, $offset, $resourc_link){
		
		$this->content = '';
		
		$fp = fopen ($resourc_link, "rb" );
		if (! $fp) {
			echo 'Could not open '.$resourc_link; return;
			//TODO use exception to handdle this kind of error report...
		}

		if($position == 0 || $offset == 0){
			return;
		}
	
		fseek($fp,$position);
		$this->content=fread($fp, $offset);
	}
	
	public function get_content(){
		if(isset($this->content))
			return $this->content;
	}
}