
$(document).ready(function() { // Fonction s'execute page chargé


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
		

	
	

		
	$('.crud-delmyarticle').click(function(event) {
		var row = $(this).closest('tr');	// on trouve la ligne la plus proche, on s'en servira dans le success de ajax ($(this) n'y est pas accessible)
		var ida = row.find(':first').find(':first').serialize()+"&action=delmyarticle"; // on trouve l'ida correspondant à la ligne, et on utilise row pour éviter à jQuery de reparcourir le DOM
		console.log("ida: " + ida);
		
		$.ajax({
			type: "POST",
			url: "myarticle.php",
			data: ida,
			dataType: "html",
			success: function(data,textStatus,jqXHR) {
				row.remove();
			}
			
		});
	});
	
	

} );