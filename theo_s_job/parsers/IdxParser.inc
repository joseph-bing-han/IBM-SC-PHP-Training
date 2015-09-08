<?php
class IdxParser {
	protected $index_s; // the array for indexing the dictinary index array cache.
	protected $index_i; // the cached index array for offset (key == 'o') and length (key == 'l')
	private static $ins; // the instance
	/**
	 * concstructor, setup arrays.
	 */
	private function __construct() {
		$this->index_s = array ();
		$this->index_i = array ();
	}
	
	/**
	 * use one instance to cache the dictionary index.
	 */
	public static function get_instance() {
		if (! isset ( self::$ins )) {
			self::$ins = new IdxParser ();
		}
		
		return self::$ins;
	}
	
	/**
	 * Get hash of the resource location string.
	 * Use this hash value to be the key of index array.
	 *
	 * @param string $str        	
	 * @return string
	 */
	private function index_hash($str) {
		return md5 ( $str );
	}
	
	/**
	 * initialize the index to array.
	 *
	 * @param string $resource_link        	
	 * @return boolean
	 */
	public function init($resource_link) {
		$resource_link_hash = $this->index_hash ( $resource_link );
		
		if (isset ( $this->index_s [$resource_link_hash] )) {
			return true;
		}
		
		$fp = fopen ( $resource_link, "rb" );
		
		if (! $fp) {
			echo 'Could not open file ' . $resource_link;
			return false;
			// TODO use exception and try catch to report error.
		}
		
		$tempval = '';
		
		while ( true ) {
			if (feof ( $fp )) {
				break;
			}
			
			$temp = fgetc ( $fp );
			
			if ($temp == "\0") {
				$offset = ( int ) sprintf ( "%u", array_shift ( @unpack ( "N", fread ( $fp, 4 ) ) ) );
				$length = ( int ) sprintf ( "%u", array_shift ( @unpack ( "N", fread ( $fp, 4 ) ) ) );
				
				$this->index_s [$resource_link_hash] [] = $tempval;
				$this->index_i [$resource_link_hash] [] = array (
						'o' => $offset,
						'l' => $length 
				);
				$tempval = "";
			} else {
				$tempval = $tempval . $temp;
			}
		}
		fclose ( $fp );
		// var_dump($this->index); exit;
		$this->init_complete = true;
		return true;
	}
	
	/**
	 * calculate the position/offset of result in dictionary with search string and resource link
	 *
	 * @param string $str        	
	 * @param string $resource_link        	
	 * @return int
	 */
	public function get_position($str, $resource_link) {
		$resource_link_hash = $this->index_hash ( $resource_link );
		
		$i = array_search ( $str, $this->index_s [$resource_link_hash] );
		$var = 0;
		if ($i) {
			$var = ( int ) $this->index_i [$resource_link_hash] [$i] ['o'];
		}
		
		return $var;
		// return $this->offset;
	}
	
	/**
	 * calculate the length of the result.
	 *
	 * @param string $str        	
	 * @param string $resource_link        	
	 * @return int
	 */
	public function get_offset($str, $resource_link) {
		$resource_link_hash = $this->index_hash ( $resource_link );
		$i = array_search ( $str, $this->index_s [$resource_link_hash] );
		$var = 0;
		
		if ($i) {
			$var = ( int ) $this->index_i [$resource_link_hash] [$i] ['l'];
		}
		
		return $var;
	}
}