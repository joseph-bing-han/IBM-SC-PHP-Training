<?php
require_once './resources/Resources.inc';
require_once './parsers/DictParser.inc';
require_once './parsers/IdxParser.inc';
class Dictionary {
	protected $resources;
	protected $dictparser;
	protected $idxparser;
	protected $result_pool;
	
	/**
	 *
	 * @param DictParser $dp        	
	 * @param IdxParser $ip        	
	 */
	public function __construct(DictParser $dp, IdxParser $ip) {
		$this->resources = new Resources ();
		$this->dictparser = $dp;
		$this->idxparser = $ip;
	}
	
	/**
	 *
	 * @param string $to_search        	
	 */
	public function find($to_search) {
		$idx_list = $this->resources->get_idx_list ();
		$dict_list = $this->resources->get_dict_list ();
		for($i = 0; $i < $this->count_resources (); $i ++) {
			if ($this->idxparser->init ($idx_list [$i] )) {
				$this->dictparser->init ( $this->idxparser->get_position ($to_search, $idx_list [$i]), $this->idxparser->get_offset ($to_search, $idx_list [$i]), $dict_list [$i] );
			}
			
			echo $this->dictparser->get_content ();
		}
	}
	protected function count_resources() {
		return Resources::resource_count;
	}
}