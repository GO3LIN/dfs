<?php
class Df {


	static $dfs = array(); // l'ensemble de toute les dfs
	public $partieGaucheString;
	public $partieDroiteString;
	public $partieGauche = array();
	public $partieDroite = array();

	public function __construct($pg, $pd){
		// A, B, C, ...
		$this->partieGauche = explode(",", $pg);
		$this->partieDroite = explode(",", $pd);

		self::$dfs[] = $this;
	}



	static function removeReflexivity(){
		


		for($i=0; $i<count(self::$dfs); $i++){
			for($j=0; $j<count(self::$dfs);$j++){
				if($i!=$j){
					// On verifie le tableau gauche avec le tableau droite

					if(self::$dfs[$i]->partieGaucheString === self::$dfs[$j]->partieDroiteString){
						if(self::$dfs[$i]->partieDroiteString === self::$dfs[$j]->partieGaucheString){
							self::$dfs[$i] = null;
						}
					}
				}
			}
		}
	}

	public function cle(){

	}

}
?>