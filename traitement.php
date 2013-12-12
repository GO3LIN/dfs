<?php
include('Df.php');
$nbrChamps = count($_POST);
if($nbrChamps>1){

	$nbrDfs = $nbrChamps /2;

	for($i=0;$i<$nbrDfs;$i++){
		new Df($_POST['dpfg'.$i], $_POST['dpfd'.$i]);
	}
	Df::removeReflexivity();
	print_r(Df::$dfs);

}else {
	echo "Entrez une dépendance fonctionnelle au moins.";
}
?>