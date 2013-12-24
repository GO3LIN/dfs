<?php
class Df {


	public $partieGaucheString;
	public $partieDroiteString;
	public $partieGaucheArray = array();
	public $partieDroiteArray = array();

	/*
	############################
	##	Constructeur : initialise les attributs de l'objet
	##	@params: $pg => String contenant les attributs de la partie gauche séparés d'une virgule
	##			$pg => idem partie droite
	##############################
	*/

	public function __construct($pg, $pd){
		$this->partieGaucheString = $pg;
		$this->partieDroiteString = $pd;
		$this->partieGaucheArray = array_map("trim", explode(",", $pg));
		$this->partieDroiteArray = array_map("trim", explode(",", $pd));

	}

	/*
	##############################
	##	Fonction vérifie la relexivité entre deux df
	##	@param: $df => Une dépendance fonctionnelle (objet de Df)
	##	@return: True si reflexive, false sinon
	##############################
	*/

	public function reflexive($df){
		if($this->partieGaucheString == $df->partieDroiteString){
			if($this->partieDroiteString == $df->partieGaucheString)
				return true;
		}
		return false;
	}

	/*
	##############################
	##	Fonction vérifie la transitivité entre deux df
	##	@param: $df => Une dépendance fonctionnelle (objet de Df)
	##	@return: True si transitive, false sinon
	##############################
	*/

	public function transitive($df){
		if($this->partieDroiteString == $df->partieGaucheString)
			return true;
		return false;
	}

	

}
?>