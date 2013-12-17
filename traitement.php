<?php
include('Df.php');
include('Dfs.php');

include('includes/header.php');
?>
<div class="row">
<div class="large-12 columns">
<?php

$nbrChamps = count($_POST);
if($nbrChamps>1){

	$nbrDfs = $nbrChamps /2;
	$dfs = new Dfs();

	for($i=0;$i<$nbrDfs;$i++){
		if(!empty($_POST['dpfg'.$i]) AND !empty($_POST['dpfd'.$i]))
			$dfs->add(new Df($_POST['dpfg'.$i], $_POST['dpfd'.$i]));
	}

	echo "<p><strong>Clé primaire:</strong> ".implode(", ", $dfs->getPrimaryKey());


	
	//print_r($dfs->dfsArray);

}else {
	echo "Entrez une dépendance fonctionnelle au moins.";
}
?>
</div>
</div>
<?php

include('includes/footer.php');
?>