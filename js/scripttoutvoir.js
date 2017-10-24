var toutvoir = document.getElementById('inputtoutvoir'); //Récupération des propriétés de la case à cocher "#toutvoir" dans la variable toutvoir.
var meubles = document.getElementById('inputmeubles'); //Idem "#inputmeuble".
var tableaux = document.getElementById('inputtableaux'); //Idem "#inputyableaux".
var vases = document.getElementById('inputvases'); //Idem "#inputvases".



$(document).ready(function() { //Au chargement de la page, exécuter ceci :
	$(toutvoir).click(function(event) { //Clic détecté sur la case "Tout voir", on ne sait pas si elle est cochée ou pas.
		//On va donc faire le test pour vérifier si tout voir à été cochée ou pas.
        if(toutvoir.checked==true) { //Si l'on constate que la case "Tout voir" est cochée...
            meubles.checked=false; // Alors on décoche toutes les autres cases.
			tableaux.checked=false;
            vases.checked=false;
            $('.Meubles').addClass('visible').removeClass('hidden'); //Et on rend visibles toutes les images
            $('.Tableaux').addClass('visible').removeClass('hidden');
            $('.Vases').addClass('visible').removeClass('hidden');
        }else{ //Sinon, on constate que la case "Tout voir" est décochée, donc...
            $('.Meubles').addClass('hidden').removeClass('visible'); // On rend invisibles toutes les images.
            $('.Tableaux').addClass('hidden').removeClass('visible');
            $('.Vases').addClass('hidden').removeClass('visible');         
        }
		if(meubles.checked==false && tableaux.checked==false && vases.checked==false && toutvoir.checked==false) { //Si l'on constate que la case "Meuble, etc" est cochée...
         // Alors on rechoche tout voir.
        toutvoir.checked=true;
          $('.Meubles').addClass('visible').removeClass('hidden'); //Et on rend visibles toutes les images
          $('.Tableaux').addClass('visible').removeClass('hidden');
          $('.Vases').addClass('visible').removeClass('hidden');
        }
    });

   $(meubles).click(function(event) { //Clic détecté sur la case "Meuble", on soupçonne qu'elle a été cochée...
   		//On fait un bilan de ce qui est coché ou non pour adapter la visiblité des images.
        if(meubles.checked==true) { // Si l'on constate que la case "Meubles" est effectievement cochée
            $('.Meubles').addClass('visible').removeClass('hidden');//Alors on rend les images des meubles visibles
            toutvoir.checked=false; //On en profite pour décocher la case "Tout voir".
        }
        else{ //Sinon, on constate que la case "Meuble" n'a pas été cochée.
            $('.Meubles').removeClass('visible').addClass('hidden'); //Alors on rend les images de meubles invisibles.
        }

        if(tableaux.checked==false){ //On constate que la case de "Tableau" n'est pas cochée.
        	$('.Tableaux').removeClass('visible').addClass('hidden'); //Alors Tableaux => invisible
		}
		
		if(vases.checked==false){ //On constate que la case de "Vases" n'est pas cochée.
			$('.Vases').removeClass('visible').addClass('hidden'); //Alors Vases => invisible.
		}
		if(meubles.checked==false && tableaux.checked==false && vases.checked==false && toutvoir.checked==false) { //Si l'on constate que la case "Meuble, etc" est cochée...
         // Alors on rechoche tout voir.
        toutvoir.checked=true;
          $('.Meubles').addClass('visible').removeClass('hidden'); //Et on rend visibles toutes les images
          $('.Tableaux').addClass('visible').removeClass('hidden');
          $('.Vases').addClass('visible').removeClass('hidden');
        }
    });

    $(tableaux).click(function(event) { //Clic détecté sur la case "Tableaux", on soupçonne qu'elle a été cochée...
    	//On fait un bilan de ce qui est coché ou non pour adapter la visiblité des images.
    	if(tableaux.checked==true) {// Si l'on constate que la case "Tableaux" est effectievement cochée
            $('.Tableaux').addClass('visible').removeClass('hidden');//Alors on rend les images des tableaux visibles
            toutvoir.checked=false; //On en profite pour décocher la case "Tout voir".
        }else{//Sinon, on constate que la case "Tableau" n'a pas été cochée.
            $('.Tableaux').removeClass('visible').addClass('hidden'); //Alors on rend les images de tableaux invisibles.
        }
    	if(meubles.checked==false){//On constate que la case de "Meuble" n'est pas cochée.
    		$('.Meubles').removeClass('visible').addClass('hidden');//Alors Meubles => invisible.
    	}
        if (vases.checked==false){//On constate que la case de "Vases" n'est pas cochée.
        	$('.Vases').removeClass('visible').addClass('hidden'); //Alors Vases => invisible.
        }
		if(meubles.checked==false && tableaux.checked==false && vases.checked==false && toutvoir.checked==false) { //Si l'on constate que la case "Meuble, etc" est cochée...
         // Alors on rechoche tout voir.
        toutvoir.checked=true;
          $('.Meubles').addClass('visible').removeClass('hidden'); //Et on rend visibles toutes les images
          $('.Tableaux').addClass('visible').removeClass('hidden');
          $('.Vases').addClass('visible').removeClass('hidden');
        }
        
    });

    $(vases).click(function(event) {//Clic détecté sur la case "Vases", on soupçonne qu'elle a été cochée...
    	//On fait un bilan de ce qui est coché ou non pour adapter la visiblité des images.
    	if(vases.checked==true) {// Si l'on constate que la case "Vases" est effectievement cochée
            $('.Vases').addClass('visible').removeClass('hidden');//Alors on rend les images des vases visibles
            toutvoir.checked=false; //On en profite pour décocher la case "Tout voir".
        }else{//Sinon, on constate que la case "Vases" n'a pas été cochée.
            $('.Vases').removeClass('visible').addClass('hidden');
        }
    	if (meubles.checked==false){ //On constate que la case de "Meuble" n'est pas cochée.
    		$('.Meubles').removeClass('visible').addClass('hidden');//Alors Meubles => invisible.
    	}
        if (tableaux.checked==false){  //On constate que la case de "Tableau" n'est pas cochée.
        	$('.Tableaux').removeClass('visible').addClass('hidden'); //Alors Tableaux => invisible
		}
		if(meubles.checked==false && tableaux.checked==false && vases.checked==false && toutvoir.checked==false) { //Si l'on constate que la case "Meuble, etc" est cochée...
         // Alors on rechoche tout voir.
        toutvoir.checked=true;
          $('.Meubles').addClass('visible').removeClass('hidden'); //Et on rend visibles toutes les images
          $('.Tableaux').addClass('visible').removeClass('hidden');
          $('.Vases').addClass('visible').removeClass('hidden');
        }
        
    });


	
	
	
	
	/*
		$(toutvoir).click(function(){
			if($(this).is(':checked')){
				console.log ("coucou");
				$('input:checkbox').attr("checked",true);
			}else{
				$('input:checkbox').removeAttr("checked");
			}
		})
		$(meubles).click(function(){
			if($(this).is(':checked')){
				if($(tableaux).is(':checked') && $(vases).is(':checked')){
					$('input:checkbox').attr("checked",true);
				}
			}else{
				$('input:checkbox').removeAttr("checked");		
			}
		})
		$(tableaux).click(function(){
			if($(this).is(':checked')){
				if($(meubles).is(':checked') && $(vases).is(':checked')){
					$('input:checkbox').attr("checked",true);
				}
			}else{
				$('input:checkbox').removeAttr("checked");
			}
		})
		$(vases).click(function(){
			if($(this).is(':checked')){
				if($(meubles).is(':checked') && $(tableaux).is(':checked')){
					$('input:checkbox').attr("checked",true);
				}
			}else{
				$('input:checkbox').removeAttr("checked");
			}
		});
	*/
	
	
});