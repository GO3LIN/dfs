$(document).ready(function(){
	var i=1;
	$("#buttonAjouter").click(function(){
		var dpfRow ='<div class="row"><div class="small-5 columns"><input type="text" name="dpfg'+i+'" ></div><div class="small-2 columns"><center><img src="img/fleche.png" alt="->" /></center></div><div class="small-5 columns"><input type="text" name="dpfd'+i+'"></div></div>';
		$("#dependances").append(dpfRow);
		$("#dependances .row").last().hide().slideDown('slow');
		i++;
		return false;
	});

});