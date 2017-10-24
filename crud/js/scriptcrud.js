/*var editor;

$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        table: "#membres",
        fields: [ {
                label: "Nom:",
                name: "name"
            }, {
                label: "Prenom:",
                name: "firstname"
            }, {
                label: "Adresse:",
                name: "adress"
            }, {
                label: "Code postal:",
                name: "zipcode"
            }, {
                label: "Ville:",
                name: "city"
            }, {
                label: "Telephone:",
                name: "phone"
            }, {
                label: "Mail:",
                name: "mail"
            },{
                label: "Admin:",
                name: "admin"
            }
        ]
    } );
	
	$('#membres').dataTable({
		"dom": "Bfrtip",
		"bPaginate":true,
		"sPaginationType":"full_numbers",
		"iDisplayLength": 5,
		"aoColumns": [
			{ mData: 'Ref'},
			{ mData: 'Nom'},
			{ mData: 'Prenom'},
			{ mData: 'Adresse'},
			{ mData: 'Code_postal'},
			{ mData: 'Ville'},
			{ mData: 'Telephone'},
			{ mData: 'Mail'},
			{ mData: 'Admin'}
		],
		"select": true,
		"buttons": [
            { extend: "edit",   editor: editor },
            { extend: "remove", editor: editor }
        ]
	});
} );*/
	
	

/*$(document).ready(function() {
    var table = $("#membres").DataTable({
		"bProcessing": true,
		"sAjaxSource": "dbcrud.php",
		"bPaginate":true,
		"sPaginationType":"full_numbers",
		"iDisplayLength": 5,
		"aoColumns": [
			{ mData: 'Ref'},
			{ mData: 'Nom'},
			{ mData: 'Prenom'},
			{ mData: 'Adresse'},
			{ mData: 'Code_postal'},
			{ mData: 'Ville'},
			{ mData: 'Telephone'},
			{ mData: 'Mail'},
			{ mData: 'Admin'}
		]
	});
} );*/


$(document).ready(function() { // Fonction s'execute page chargé
	var table = $('#membres').dataTable({ // Récupération de l'id de table membre pour modifier le tableau
		"language": { //Modification des phrases en français
			"decimal":  "",
			"emptyTable":"Il n'y a aucune donnée dans cette table",
			"info":"Lignes _START_ à _END_ sur _TOTAL_ lignes au total",
			"infoEmpty":"Aucune entrée trouvée !",
			"infoFiltered":"(_MAX_ lignes ont été filtrées)",
			"infoPostFix": "",
		    "thousands": "",
		    "lengthMenu":"Afficher _MENU_ lignes par page",
		    "loadingRecords":"Chargement...",
		    "processing":"Traitement...",
		    "search":"Recherche :",
		    "zeroRecords":"Aucun résultat",
		    "paginate": {
			   "first":"Premier",
			   "last":"Dernier",
			   "next":"Suivant",
			   "previous":"Précédent"
		    },
			"aria": {
			   "sortAscending":  ": Classement des colonnes du plus petit au plus grand",
			   "sortDescending": ": Classement des colonnes du plus grand au plus petit"
			}
		},

		"paging":true, // activation pagination, bPaginate (v1.9) -> paging (v1.10)
		"pagingType":"full_numbers", // type de pagination, sPaginationType (v1.9) -> pagingType (v1.10)
		"pageLength": 10, // le nombre de ligne page par défault, iDisplayLength (v1.9) -> pageLength (v1.10)
		"columns": [ // récuperation des colonnes pour permetre le trie, aoColumns (v1.9) -> Columns (v1.10)
		{ Data: 'Ref'}, // mData (v1.9) -> Data (v1.10)
		{ Data: 'Nom'},
		{ Data: 'Prenom'},
		{ Data: 'Adresse'},
		{ Data: 'Code_postal'},
		{ Data: 'Ville'},
		{ Data: 'Telephone'},
		{ Data: 'Mail'},
		{ Data: 'Admin'},
		{ Data: ''}
		],
		"columnDefs": [ // Trie des inputs
       { "type": "html-input", "targets": [0,1, 2, 3, 4, 5, 6, 7, 8] }
		]

	});


		var table2 = $('#articles').dataTable({ // Récupération de l'id de table membre pour modifier le tableau
			"language": { //Modification des phrases en français
				"decimal":  "",
				"emptyTable":"Il n'y a aucune donnée dans cette table",
				"info":"Lignes _START_ à _END_ sur _TOTAL_ lignes au total",
				"infoEmpty":"Aucune entrée trouvée !",
				"infoFiltered":"(_MAX_ lignes ont été filtrées)",
				"infoPostFix": "",
				"thousands": "",
				"lengthMenu":"Afficher _MENU_ lignes par page",
				"loadingRecords":"Chargement...",
				"processing":"Traitement...",
				"search":"Recherche :",
				"zeroRecords":"Aucun résultat",
				"paginate": {
				   "first":"Premier",
				   "last":"Dernier",
				   "next":"Suivant",
				   "previous":"Précédent"
				},
				"aria": {
				   "sortAscending":  ": Classement des colonnes du plus petit au plus grand",
				   "sortDescending": ": Classement des colonnes du plus grand au plus petit"
				}
			},

			"paging":true, // activation pagination, bPaginate (v1.9) -> paging (v1.10)
			"pagingType":"full_numbers", // type de pagination, sPaginationType (v1.9) -> pagingType (v1.10)
			"pageLength": 10, // le nombre de ligne page par défault, iDisplayLength (v1.9) -> pageLength (v1.10)
			"columns": [ // récuperation des colonnes pour permetre le trie, aoColumns (v1.9) -> Columns (v1.10)
			{ Data: 'Id'}, // mData (v1.9) -> Data (v1.10)
			{ Data: 'Titre'},
			{ Data: 'Description'},
			{ Data: 'Stock'},
			{ Data: 'Category'},
			{ Data: 'Valide'},
			{ Data: ''}
			],
			"columnDefs": [ // Trie des inputs
		   { "type": "html-input", "targets": [0,1, 2, 3, 4, 5] }
			] 

		});
		
		var table3 = $('#encheres').dataTable({ // Récupération de l'id de table membre pour modifier le tableau
			"language": { //Modification des phrases en français
				"decimal":  "",
				"emptyTable":"Il n'y a aucune donnée dans cette table",
				"info":"Lignes _START_ à _END_ sur _TOTAL_ lignes au total",
				"infoEmpty":"Aucune entrée trouvée !",
				"infoFiltered":"(_MAX_ lignes ont été filtrées)",
				"infoPostFix": "",
				"thousands": "",
				"lengthMenu":"Afficher _MENU_ lignes par page",
				"loadingRecords":"Chargement...",
				"processing":"Traitement...",
				"search":"Recherche :",
				"zeroRecords":"Aucun résultat",
				"paginate": {
				   "first":"Premier",
				   "last":"Dernier",
				   "next":"Suivant",
				   "previous":"Précédent"
				},
				"aria": {
				   "sortAscending":  ": Classement des colonnes du plus petit au plus grand",
				   "sortDescending": ": Classement des colonnes du plus grand au plus petit"
				}
			},

			"paging":true, // activation pagination, bPaginate (v1.9) -> paging (v1.10)
			"pagingType":"full_numbers", // type de pagination, sPaginationType (v1.9) -> pagingType (v1.10)
			"pageLength": 10, // le nombre de ligne page par défault, iDisplayLength (v1.9) -> pageLength (v1.10)
			"columns": [ // récuperation des colonnes pour permetre le trie, aoColumns (v1.9) -> Columns (v1.10)
			{ Data: 'Idenchere'}, // mData (v1.9) -> Data (v1.10)
			{ Data: 'Datedebut'},
			{ Data: 'Datefinprevue'},
			{ Data: 'Miseaprix'},
			{ Data: 'Prixfinal'},
			{ Data: 'Datefineffective'},
			{ Data: 'Gagnant'},
			{ Data: 'Datecreation'},
			{ Data: 'idarticle'},
			{ Data: 'idgagnant'},
			{ Data: ''}
			],


		});
	



	/*$("#users").submit(function(event) {
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "../dbcrud.php?update",
			data: $(this).serialize(),
			dataType: "html"
		});
	});*/
	
	
	$('.crud-update').click(function(event){
		//$(this).addClass('btn-danger').removeClass('btn-success');		// test pour comprendre
		//$(this).closest('tr').remove();								// test pour comprendre
		/* text pour comprendre * /
		$(this).closest('tr').find(':text').each(function(){
			console.log("merde");
		});
		*/
		var tds = $(this).closest('tr').find(':text').serialize()+"&action=update"; //On ajoute un paramètre à notre tds.
		console.log("tds: " + tds);
	
		$.ajax({
			type: "POST",
			url: "crud.php",
			data: tds,
			dataType: "html"
		});
	});
	
	$('.crud-delete').click(function(event) {
		var row = $(this).closest('tr');	// on trouve la ligne la plus proche, on s'en servira dans le success de ajax ($(this) n'y est pas accessible)
		var idu = row.find(':first').find(':first').serialize()+"&action=delete"; // on trouve l'idu correspondant à la ligne, et on utilise row pour éviter à jQuery de reparcourir le DOM
		console.log("idu: " + idu);
		
		$.ajax({
			type: "POST",
			url: "crud.php",
			data: idu,
			dataType: "html",
			success: function(data,textStatus,jqXHR) {
				row.remove();
			}
			
		});
	});


	$('.crud-update2').click(function(event){
			//$(this).addClass('btn-danger').removeClass('btn-success');		// test pour comprendre
			//$(this).closest('tr').remove();								// test pour comprendre
			/* text pour comprendre * /
			$(this).closest('tr').find(':text').each(function(){
				console.log("merde");
			});
			*/
			var tds2 = $(this).closest('tr').find(':text').serialize()+"&action=update2"; //On ajoute un paramètre à notre tds.
			console.log("tds2: " + tds2);
		
			$.ajax({
				type: "POST",
				url: "crud.php",
				data: tds2,
				dataType: "html"
			});
		});
		
	$('.crud-delete2').click(function(event) {
		var row = $(this).closest('tr');	// on trouve la ligne la plus proche, on s'en servira dans le success de ajax ($(this) n'y est pas accessible)
		var ida = row.find(':first').find(':first').serialize()+"&action=delete2"; // on trouve l'ida correspondant à la ligne, et on utilise row pour éviter à jQuery de reparcourir le DOM
		console.log("ida: " + ida);
		
		$.ajax({
			type: "POST",
			url: "crud.php",
			data: ida,
			dataType: "html",
			success: function(data,textStatus,jqXHR) {
				row.remove();
			}
			
		});
	});
	
	$('.crud-delete3').click(function(event) {
		var row = $(this).closest('tr');	// on trouve la ligne la plus proche, on s'en servira dans le success de ajax ($(this) n'y est pas accessible)
		var idb = row.find(':first').find(':first').serialize()+"&action=delete3"; // on trouve l'idb correspondant à la ligne, et on utilise row pour éviter à jQuery de reparcourir le DOM
		console.log("idb: " + idb);
		
		$.ajax({
			type: "POST",
			url: "crud.php",
			data: idb,
			dataType: "html",
			success: function(data,textStatus,jqXHR) {
				row.remove();
			}
			
		});
	});
	
	/*$('.crud-add2').click(function(event){
		
		var bra = $(this).closest('tr').find('.lol').serialize()+"&action=ajout2";
		console.log("bra: " + bra);
		
		$.ajax({
			type: "POST",
			url: "crud.php",
			data: bra,
			dataType: "html",
			//success: function(data,textStatus,jqXHR) {
				//row.remove();
			//}
			
		});
		
		
	});*/

} );