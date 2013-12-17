<?php
class Dfs {

	public $dfsArray = array(); // Tableau contenant les dependances fonctionnelles.
	public $cle = array(); // Tableau contenant la clé primaire.

	public function __construct(){

	}

	public function add($df){
		$this->dfsArray[] = $df;
	}

	/* #######################
	## Fonction cherchant s'il y a des dependances qui se repete selon la loi de la reflexivité ( ex : A->B | B->A )
	## @return: un tableau contenant l'index d'une des deux dependances fonctionnelles si une reflexivité est trouvé
	##########################
	*/

	public function getReflexivity(){
		$reflexiveIndexes = array();
		for($i=0; $i<count($this->dfsArray);$i++){
			if(!in_array($i, $reflexiveIndexes)) {
				for($j=0;$j<count($this->dfsArray);$j++){
					if($i!=$j AND $this->dfsArray[$i]->reflexive($this->dfsArray[$j])){
						$reflexiveIndexes[] = $j;
					}
				}
			}
		}
		return $reflexiveIndexes;
	}


	public function getTransitivity(){
		$transitiveValues = array();
		for($i=0; $i<count($this->dfsArray);$i++){
			for($j=0;$j<count($this->dfsArray);$j++){
				if($i!=$j AND $this->dfsArray[$i]->transitive($this->dfsArray[$j])){
					$transitiveValues[] = $this->dfsArray[$i]->partieDroiteString;
				}
			}
		}
		return $transitiveValues;
	}

	/* ################
	## Fonction qui remplie l'attribut cle et le retourne
	##
	##################*/

	public function getPrimaryKey(){
		$reflexivityI = $this->getReflexivity();

		for($i=0; $i<count($this->dfsArray);$i++){
			if(!in_array($i, $reflexivityI)) {
				$attributs = explode(",", trim($this->dfsArray[$i]->partieGaucheString));
				foreach ($attributs as $attribut) {
					$attribut = trim($attribut);
					if(!in_array($attribut, $this->cle)){
						$attributCle = true;
						foreach ($this->dfsArray as $key=>$df) {
							if(!in_array($key, $reflexivityI)){
								if($attribut == $df->partieDroiteString)
									$attributCle = false;
							}
						}
						if($attributCle)
							$this->cle[] = $attribut;
					}
				}
			}
		}
		return $this->cle;
	}



}
?>