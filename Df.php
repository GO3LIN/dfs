<?php
class Df {


	public $partieGaucheString;
	public $partieDroiteString;
	public $partieGaucheArray = array();
	public $partieDroiteArray = array();


	public function __construct($pg, $pd){
		$this->partieGaucheString = $pg;
		$this->partieDroiteString = $pd;
		$this->partieGaucheArray = array_map("trim", explode(",", $pg));
		$this->partieDroiteArray = array_map("trim", explode(",", $pd));

	}



	public function reflexive($df){
		if($this->partieGaucheString == $df->partieDroiteString){
			if($this->partieDroiteString == $df->partieGaucheString)
				return true;
		}
		return false;
	}

	public function transitive($df){
		if($this->partieDroiteString == $df->partieGaucheString)
			return true;
		return false;
	}

	

}
?>