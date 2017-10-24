/*$(document).ready(function() {
	select = document.getElementById('choice');
	$('#choice').change(function(){
		//alert("c'est changé");
		var contenu = select.value;
		var tab = contenu.split(" ");
		var id = tab[0];
		console.log(id);
	});
});*/

function seeidarticle() {
	select = document.getElementById('choice');
	$('#choice').change(function(){
		//alert("c'est changé");
		var contenu = select.value;
		var tab = contenu.split(" ");
		var idarticle = tab[0];
		$('#picture').load('picture.php?id='+idarticle+'');
	});
	
}