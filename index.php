<?php
include('includes/header.php');
?>

     <div class="row">
      <div class="large-12 columns"> 
        <h1>Projet sur la normalisation</h1>
        <p>
          Entrez les attributs des dépendances fonctionnelles séparés d'une virgule.
        </p>
      </div>
    </div>
    
    <form method="post" action="traitement.php">
      <div class="row">
        <div class="small-11 columns">
          <div id="dependances">
            <div class="row">
              <div class="small-5 columns">
                <input type="text" name="dpfg0" >
              </div>
              <div class="small-2 columns">
                <center><img src="img/fleche.png" alt="->" /></center>
              </div>
              <div class="small-5 columns">
                <input type="text" name="dpfd0">
              </div>
            </div>
            <div class="row">
              <div class="small-5 columns">
                <input type="text" name="dpfg1" >
              </div>
              <div class="small-2 columns">
                <center><img src="img/fleche.png" alt="->" /></center>
              </div>
              <div class="small-5 columns">
                <input type="text" name="dpfd1">
              </div>
            </div>
            <div class="row">
              <div class="small-5 columns">
                <input type="text" name="dpfg2" >
              </div>
              <div class="small-2 columns">
                <center><img src="img/fleche.png" alt="->" /></center>
              </div>
              <div class="small-5 columns">
                <input type="text" name="dpfd2">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="large-4 columns">
              <button class="button tiny secondary" id="buttonAjouter">Ajouter</button>
              <button class="button tiny ">Procéder</button>
            </div>
            <div class="large-4 columns">
            </div>
          </div>
        </div>
      </div>
    </form>
    
<?php include('includes/footer.php'); ?>