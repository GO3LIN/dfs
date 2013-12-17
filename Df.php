<?php
class Df {


	public $partieGaucheString;
	public $partieDroiteString;

	public function __construct($pg, $pd){
		$this->partieGaucheString = $pg;
		$this->partieDroiteString = $pd;

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