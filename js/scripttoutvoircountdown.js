$(function(){
     
    window.setInterval(function(){
        $('.cabour').each(function(){
            var sec = $(this).data('timeleft');
			if (sec>0) { //Si le temps est différent de 0
				var heure = Math.floor(sec/3600); //Nombre d'heure écoulés
				if(heure >= 24){ //Si plus de 24 => 1 jour
					var jour = Math.floor(heure/24); //Calcul du nombre de jour
					var moins = 86400*jour; // Deffinition et attribution d'une valeur à `moins` qui est la variable soustractrice de la fonction
					var heure = heure-(24*jour); //On enléve le nombre d'heure concernée
				}else{
					var jour = 0; //Sinon, il n'y a pas de jour
					var moins = 0; // Et pas ed variable moins
				}
				var moins = moins+3600*heure; // Recalcul
				var minutes = Math.floor((sec-moins)/60); // Calcul des minutes
				var moins = moins + 60*minutes; // Recalcul de la variable moins
				var secondes = sec-moins; //Calcul des seconde
				var minutes = ((minutes < 10) ? "0" : "") + minutes; //On rajoute un 0 si les minutes sont inférieures à 10
				var secondes = ((secondes < 10) ? "0" : "") + secondes; //On rajoute un 0 si les secondes sont inférieures à 10
				$(this).text(+ jour +' jours '+ heure +':' + minutes + ':' + secondes + '');  //On affiche le resultat dans le div concerné
				$(this).data('timeleft',sec-1); //On enléve une seconde
			}
		});
	},1000);

});

$(function(){
	window.setInterval(function(){

		$('[data-timeleft]').each(function(){
			var testtime = $(this).data('timeleft');
			if (testtime == 0) {
				$(this).parents('.toutvoir').hide();
			}
		});		
	},1000);
});




/*function seebid() {
    var auto_refresh = setInterval(
    function()
    {
        $('#bidlist').load('toutvoir2.php');
    }, 5000);

}*/


/*$(function(){

    window.setInterval(function(){
        $('.cabour').each(function(){
            var sec = $(this).data('timeleft');
            jours = sec/86400;  //On récupère le nombre de jours sous forme décimal (par exemple : 3,4). Cette
            //variable nous servira pour les calculs ultérieurs.
            joursaff = Math.floor(jours); //On fait une troncature pour ne retenir que le nombre de jour mais
            //sans les décimaux puisque cette variable est destinée à être affichée.

            heures = jours - joursaff; //Les heures représentent le nombre décimal des jours, par exemple dans 3,4
            //on a 0,4 heures, minutes et secondes. On fait donc 3,4-3 pour récupérer 0,4 jours afin de le convertir 
            //en heures.
            heures = heures*24; //0,4 * 24 =9,6 nous donne le nombre d'heures, minutes et secondes.
            heuresaff = Math.floor(heures); //variable destiné à l'affichage, on garde que le 9 pour l'affichage.

            minutes = heures - heuresaff; //Les minutes représentent le nombre décimal d'heures, par exemple dans 9,6
            //on a 0,6 minutes et secondes. On fait donc 9,6-9 pour récupérer 0,6 jours afin de le convertir 
            //en minutes.
            minutes = minutes*60;
            minutesaff = Math.floor(minutes);

             secondes = minutes - minutesaff;
            secondes = secondes*60;
            secondesaff = Math.floor(secondes);

            $(this).text(+ joursaff +' jours '+ heuresaff +' heures ' + minutesaff + ' minute et ' + secondesaff + ' seconde');
            $(this).data('timeleft',sec-1);

    });},1000);

});*/