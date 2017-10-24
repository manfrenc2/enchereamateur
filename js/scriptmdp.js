var motdepasse = document.getElementById("newmdp"); // On récupère le modèle de l'objet signalé par l'id mdp
var motdepasse2 = document.getElementById("newmdp2");

function comparaison() { 
	
    if (motdepasse.value !== motdepasse2.value) { // Si la valeur de motdepass n'est pas egale à la valeur de mondepasse2
        motdepasse.style.borderColor="red";
		motdepasse2.style.borderColor="red";
		return false; // ca retourne faux (onsubmit dans la balise html)
	}else{ // sinon
		return true; // ca retourne vrai (onsubmit dans la balise html)
    }
	
}