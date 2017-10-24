/*$(function(){
	window.setInterval(function(){
		$('[data-countdown]').each(function(){
			var countdown = $(this).data('countdown');
		
			if (countdown == 0) {
				
				$('#propform').load('enchere3.php?id='+bidid+'');
			}
		});
			
	},1000);
});*/


function rebour(tps,bidid){ //Deffinition d'une fonction
	if (tps>0) { //Si le temps est différent de 0
		var heure = Math.floor(tps/3600); //Nombre d'heure écoulés
		if(heure >= 24){ //Si plus de 24 => 1 jour
			var jour = Math.floor(heure/24); //Calcul du nombre de jour
			var moins = 86400*jour; // Deffinition et attribution d'une valeur à `moins` qui est la variable soustractrice de la fonction
			var heure = heure-(24*jour); //On enléve le nombre d'heure concernée
		}else{
			var jour = 0; //Sinon, il n'y a pas de jour
			var moins = 0; // Et pas ed variable moins
		}
		moins = moins+3600*heure; // Recalcul
		var minutes = Math.floor((tps-moins)/60); // Calcul des minutes
		moins = moins + 60*minutes; // Recalcul de la variable moins
		var secondes = tps-moins; //Calcul des seconde
		minutes = ((minutes < 10) ? "0" : "") + minutes;//On rajoute un 0 si les minutes sont inférieures à 10
		secondes = ((secondes < 10) ? "0" : "") + secondes; //On rajoute un 0 si les secondes sont inférieures à 10
		var test = 'Temps restant : '+jour+' Jours, '+heure+':'+minutes+':'+secondes; //On affiche le resultat dans le div concerné
		$("#cabour").text(test);
		var restant = tps-1; //On enléve une seconde
    	
		setTimeout("rebour("+restant+")", 1000);//On rappelle la fonction toute les secondes
	}else{
		
		$('#cabour').load('enchere3.php?id='+bidid+'');

	}
}

function seecountchange(bidid) {
	var time = $('[data-timeleft]').data('timeleft');
    var auto_refresh = setTimeout(
    function()
    {
        $('#propform').load('enchere4.php?id='+bidid+'');
    }, time*1000);
}

function seeproposal(bidid) {
    var auto_refresh = setInterval(
    function()
    {
        $('#proposition').load('enchere2.php?id='+bidid+'');
    }, 1000);
}

function seeprice(bidid) {
    var auto_refresh = setInterval(
    function()
    {
        $('#price').load('enchereprice.php?id='+bidid+'');
    }, 1000);
}








