var motdepasse = document.getElementById("mdp"); // On récupère le modèle de l'objet signalé par l'id mdp
var motdepasse2 = document.getElementById("mdp2");
var nom = document.getElementById("lastname");
var prenom = document.getElementById("firstname");
var mail = document.getElementById("email");
var adresse = document.getElementById("adress");
var cp = document.getElementById("zipCode");
var ville = document.getElementById("ville");
var tel = document.getElementById("tel");


function comparaison() { 
	var filtre = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; // format mail
    if (motdepasse.value !== motdepasse2.value) { // Si la valeur de motdepass n'est pas egale à la valeur de mondepasse2
        motdepasse.style.borderColor="red";
		motdepasse2.style.borderColor="red";
		return false; // ca retourne vrai (onsubmit dans la balise html)
    }else if (cp.value ==0 || cp.value.length !== 5 || isNaN(cp.value) == true){ // Si egale 0, different de 5 en longueur et non numerique
		return false;
	}else if (tel.value ==0 || tel.value.length !== 10 || isNaN(tel.value) == true){
		return false;
	}else if (mail.value == 0 || !filtre.test(mail.value)) { // si egale 0, different du format mail
		mail.style.borderColor="red";
		return false;
	}else{ // sinon
		return true; // ca retourne vrai (onsubmit dans la balise html)
    }
	
}


function verif() { // Après onclick sur "envoyer" si nom est vide alors bordure en rouge etc....

	
	if (nom.value == 0) {
		nom.style.borderColor="red";
	}else if (prenom.value ==0){
		prenom.style.borderColor="red";
	}else if (mail.value ==0 || mail.validity.valid == false){
		mail.style.borderColor="red";
	}else if (adresse.value ==0){
		adresse.style.borderColor="red";
	}else if (cp.value ==0 || cp.value.length !== 5 || isNaN(cp.value) == true){ // si 0 ou s'il ne fait pas 5 chiffres, bordure rouge
		cp.style.borderColor="red";
	}else if (ville.value ==0){
		ville.style.borderColor="red";
	}else if (tel.value ==0 || tel.value.length !== 10 || isNaN(tel.value) == true){
		tel.style.borderColor="red";
	}else if (motdepasse.value ==0){
		motdepasse.style.borderColor="red";
	}else if (motdepasse2.value ==0){
		motdepasse2.style.borderColor="red";
	}
}

/* Couleur vert si valide */

nom.addEventListener("change", retire); // "keyup" lorsque l'utilisateur frappe au clavier, "change" dès que l'utilisateur a fini et changé d'input
prenom.addEventListener("change", retire);
mail.addEventListener("change", retire);
adresse.addEventListener("change", retire);
cp.addEventListener("change", retire);
ville.addEventListener("change", retire);
tel.addEventListener("change", retire);
motdepasse.addEventListener("change", retire);
motdepasse2.addEventListener("change", retire);

function retire() {
	this.style.borderColor="green";
}

