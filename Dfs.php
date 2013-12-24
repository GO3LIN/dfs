<?php
class Dfs {

	public $dfsArray = array(); // Tableau contenant les dependances fonctionnelles.
	public $relation = array(); // Tableau contenant tous les attributs
	public $cle = array(); // Tableau contenant la clé primaire.
	public $deuxiemeForme = true;
	public $troisiemeForme = true;
	public $boyceCoddForme = true;

	public function __construct(){

	}

	/*
	##############################
	##	Fonction permettant d'ajouter une dépendances fonctionnelle au tableau dfsArray 
	##	ainsi que les attributs manquant dans le tableau relation
	##	@param: $df => Objet de Df à ajouter
	##############################
	*/

	public function add($df){
		$this->dfsArray[] = $df;
		foreach ($df->partieGaucheArray as $pg) {
			$pg = trim($pg);
			if(!in_array($pg, $this->relation))
				$this->relation[] = $pg;
		}
		foreach ($df->partieDroiteArray as $pd) {
			$pd = trim($pd);
			if(!in_array($pd, $this->relation))
				$this->relation[] = $pd;
		}
	}

	/*
	##############################
	##	Fonction cherchant s'il y a des dependances qui se repete selon la loi de la reflexivité 
	##	( ex : A->B | B->A )
	##	@return: un tableau contenant l'index d'une des deux dependances fonctionnelles
	##			 si une reflexivité est trouvé
	##############################
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

	/*
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
	*/

	/*
	##############################
	##	Fonction qui remplie l'attribut cle et le retourne
	##	@return: $this->cle la clé primaire
	##############################
	*/

	public function getPrimaryKey(){
		$reflexivityI = $this->getReflexivity();

		for($i=0; $i<count($this->dfsArray);$i++){
			if(!in_array($i, $reflexivityI)) {
				$attributs = array_map("trim" , explode(",", $this->dfsArray[$i]->partieGaucheString));
				foreach ($attributs as $attribut) {
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

	/*
	#############################
	##	Fonction permettant de vérifié les différents formes normales sur la relation
	##	Les formes normales sont renseignées par des boolean
	#############################
	*/

	public function getWichNormale(){
		if(empty($this->cle))
			$this->cle = $this->getPrimaryKey();

		$nonCles = array_diff($this->relation, $this->cle);

		// Deuxieme forme : Un attribut non clé ne depend pas que d'une partie de la clé:
		foreach ($this->dfsArray as $df) {
			foreach($nonCles as $nonCle){
				if(in_array($nonCle, $df->partieDroiteArray)){
					if(array_diff($this->cle, $df->partieGaucheArray)){
						$this->deuxiemeForme = false;
						break 2; // Arrete les deux boucles !
					}
				}
			}
		}

		// Troisieme forme : Un attribut non clé ne dépend pas d'un ou plusieurs attributs ne participant pas à la clé
		if($this->deuxiemeForme){
			foreach ($this->dfsArray as $df) {
				foreach ($nonCles as $nonCle) {
					if(in_array($nonCle, $df->partieDroiteArray)){
						foreach ($nonCles as $nnCle) {
							if(in_array($nnCle, $df->partieGaucheArray)){
								$this->troisiemeForme = false;
								break 3;
							}
						}
					}
				}
			}
		} else 
			$this->troisiemeForme = false;

		// Forme Boyce-Codd : Tous les attributs non-clé ne sont pas source de dépendance fonctionnelle (DF) vers une partie de la clé
		if($this->troisiemeForme){	
			foreach ($this->dfsArray as $df) {
				foreach($nonCles as $nonCle){
					if(in_array($nonCle, $df->partieGaucheArray)){
						foreach ($this->cle as $cle) {
							if(in_array($cle, $df->partieDroiteArray)){
								$this->boyceCoddForme = false;
								break 3;
							}
						}
					}
				}
			}	
		} else 
			$this->boyceCoddForme = false;

		$this->printNormale();
	}

	public function printNormale(){
		echo "<h4>Formes normales :</h4>";
		echo "On suppose que la 1ère forme normale est vérifiée (Les attributs sont atomiques).<br>";
		if($this->deuxiemeForme){
			echo "Cette relation est en 2ème forme normale.<br>";
			if($this->troisiemeForme){
				echo "Cette relation est en 3ème forme normale.<br>";
				if($this->boyceCoddForme){
					echo "Cette relation vérifie la forme normale de Boyce-Codd.<br>";
				} else 
					echo "Cette relation ne vérifie pas la forme normale de Boyce-Codd.<br>";
			} else 
				echo "Cette relation n'est pas en 3ème forme normale.<br>";
		} else 
			echo "Cette relation n'est pas en 2ème forme normale.<br>";

	}

	public function toString(){
		// Affiche la relation et les DFS :
		echo "<h4>Dépendences fonctionnelles :</h4><br>";

		foreach ($this->dfsArray as $df) {
			$html = "";
			$html .= '<div class="row">';
			$html .= '<div class="large-4 columns">'.$df->partieGaucheString.'</div>';
			$html .= '<div class="large-4 columns"><img src="img/fleche.png" /></div>';
			$html .= '<div class="large-4 columns">'.$df->partieDroiteString.'</div>';
			$html .= '</div>';

			echo  $html;
		}

		echo "<p><strong>R(U) = </strong>(".implode(", ", $this->relation).").<br>";
		echo "<strong>Clé primaire = </strong>(".implode(", ", $this->getPrimaryKey()).").</p>";
	}

	public function decomposition(){

		echo "<br><br><h4>Décomposition :</h4><br>";

		// On enleve les parties droites de R(U)
		$deco = $this->relation;
		$i=1;
		foreach ($this->dfsArray as $df) {
			echo "#".$i." : D(U) = (".implode(", ", $deco).")<br>";
			$deco = array_diff($deco, $df->partieDroiteArray);
			$i++;
		}
		echo "#".$i." : D(U) = (".implode(", ", $deco).")<br>";
		//return $deco;
	}

}
?>