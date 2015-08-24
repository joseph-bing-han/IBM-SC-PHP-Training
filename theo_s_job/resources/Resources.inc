<?php
class Resources {
	const resource_count = 3;
	const idx = 'idx';
	const dict = 'dict';
	const ifo = 'ifo';
	
	private $dict_resources;
	
	public function __construct(){
		$this->dict_resources = array();
		
		$this->dict_resources[self::idx][0] = './resources/stardict-gaojihanyudacidian_fix-2.4.2/gaojihanyudacidian_fix.idx';
		$this->dict_resources[self::dict][0] = './resources/stardict-gaojihanyudacidian_fix-2.4.2/gaojihanyudacidian_fix.dict';
		$this->dict_resources[self::ifo][0] = './resources/stardict-gaojihanyudacidian_fix-2.4.2/gaojihanyudacidian_fix.ifo';
		
		$this->dict_resources[self::idx][1] = './resources/stardict-oald-cn-2.4.2/oald_cn.idx';
		$this->dict_resources[self::dict][1] = './resources/stardict-oald-cn-2.4.2/oald_cn.dict';
		$this->dict_resources[self::ifo][1] = './resources/stardict-oald-cn-2.4.2/oald_cn.ifo';
		
		$this->dict_resources[self::idx][2] = './resources/stardict-powerword2011_1_901-2.4.2/powerword2011_1_901.idx';
		$this->dict_resources[self::dict][2] = './resources/stardict-powerword2011_1_901-2.4.2/powerword2011_1_901.dict';
		$this->dict_resources[self::ifo][2] = './resources/stardict-powerword2011_1_901-2.4.2/powerword2011_1_901.ifo';
		
		
	}
	
	/**
	 * @return array
	 */
	public function get_idx_list(){
		return $this->dict_resources[self::idx];
	}
	
	/**
	 * @return array
	 */
	public function get_dict_list(){
		return $this->dict_resources[self::dict];
	}
	
	/**
	 * @return array
	 */
	public function get_ifo_list(){
		return $this->dict_resources[self::ifo];
	}
}