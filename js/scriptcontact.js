var nom = document.getElementById("nomcont");
var prenom = document.getElementById("prenomcont");
var mail = document.getElementById("mailcont");
var tel = document.getElementById("telcont");
var message = document.getElementById("comment");

function comparaison2() {
	var filtre = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; //format mail
	if (nom.value == 0) {
		nom.style.borderColor="red";
		return false;
	}else if (prenom.value == 0) {
		prenom.style.borderColor="red";
		return false;
	}else if (mail.value == 0 || !filtre.test(mail.value)) { //si egale 0, different du format mail
		mail.style.borderColor="red";
		return false;
	}else if (tel.value == 0 || tel.value.length !== 10 || isNaN(tel.value) == true){ // Si egale 0, different de 10 en longueur et non numerique
		tel.style.borderColor="red";
		return false;
	}else if (message.value == 0) {
		comment.style.borderColor="red";
		return false;
	}else{
		return true;
	}

}	



/* Couleur vert si valide */

nom.addEventListener("change", retire); // "keyup" lorsque l'utilisateur frappe au clavier, "change" dès que l'utilisateur a fini et changé d'input
prenom.addEventListener("change", retire);
mail.addEventListener("change", retire);
tel.addEventListener("change", retire);
message.addEventListener("change", retire);

function retire() {
	this.style.borderColor="green";
}
