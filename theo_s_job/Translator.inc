<?php
require_once './Dictionary.inc';

class Translator{
	protected $dictionary;
	
	/**
	 * 
	 * @param Dictionary $d
	 */
	public function __construct(Dictionary $d){
		$this->dictionary = $d;
	}
	

	public function run(){
		
		fwrite(STDOUT, "\nEnter word to check: ");
		$word_to_check = trim(fgets(STDIN));
		$this->dictionary->find($word_to_check);
		
		$this->run();
	}
}