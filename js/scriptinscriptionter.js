var formulaire = ['nom', 'prenom', 'mail', 'adresse', 'cp', 'ville', 'tel', 'motdepasse', 'motdepasse2'];
formulaire[0] = document.getElementById("lastname");
formulaire[1] = document.getElementById("firstname");
formulaire[2] = document.getElementById("email");
formulaire[3] = document.getElementById("adress");
formulaire[4] = document.getElementById("zipCode");
formulaire[5] = document.getElementById("ville");
formulaire[6] = document.getElementById("tel");
formulaire[7] = document.getElementById("mdp"); //On récupère le modèle de l'objet signalé par l'id mdp.
formulaire[8] = document.getElementById("mdp2");

for (var i = 0; i < 8; i++) {
    formulaire[i].addEventListener("change", retire); //evenement "keyup" : lorsque l'utilisateur tape au clavier.
}

function retire() {
    this.style.borderColor="green";
}

function comparaison() {
    if (formulaire[7].value == formulaire[8].value) { //Si la valeur de la propriété value de modepasse == value de modepasse2
        return true; //On retourne vrai.
    }else{
        formulaire[7].style.borderColor="red";
        formulaire[8].style.borderColor="red";
		return false;//Sinon on retourne faux.
    }
}

function verif() {
    for (var i = 0; i <= 8; i++) {
        if (formulaire[i].value == 0) {
        	formulaire[i].style.borderColor="red";    
        }
        if (formulaire[2].validity.valid == false) {
            formulaire[2].style.borderColor="red";
        }
    }
}




