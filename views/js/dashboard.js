// slightly modified myreports.js fix for map in dynamic content
// http://goo.gl/A2rh2I
var map = [];

$(document).ready(function(){
	var totals;
	$('#content-open').load('resources/openReports.php', function() {
		totals = parseInt($('#content-open').find('#totalopen').html());

		// init bootpag
		$('#page-selection-open').bootpag({
			total: totals,
			page: 1,
			maxVisible: 4
		}).on("page", function(event, num){
				$("#content-open").load('resources/openReports.php', {page: num});
		});

		$('.modal').on('shown.bs.modal', function (e) {
			var i = e.currentTarget.id;
			if (map[i] == undefined){
				// find coordinates
				var that = $(this);
				var lat = that.find('span[data-lat]').data('lat');
				var long = that.find('span[data-long]').data('long');

				var mapOptions = {
					center: new google.maps.LatLng(lat, long),
					zoom: 16,
					disableDefaultUI: true
				};
				map[i] = new google.maps.Map(document.getElementById('map'+i), mapOptions);
				var marker = new google.maps.Marker({
					position: mapOptions.center,
					map: map[i]
				});
			}else{		
				var center = map[i].getCenter();
				google.maps.event.trigger(map[i], "resize");
				map[i].setCenter(center);
			}
		});
	});

	$('#content-closed').load('resources/closedReports.php', function() {
		totals = parseInt($('#content-closed').find('#totalclosed').html());

		 //init bootpag
		$('#page-selection-closed').bootpag({
			total: totals,
			page: 1,
			maxVisible: 4
		}).on("page", function(event, num){
				$("#content-closed").load('resources/closedReports.php', {page: num});
		});
	});
	
	$(document).on("click", ".closebtn", function() {
		/* Loipon o logos gia tin parakatw asxhmia einai o eksis:
		 * otan epestrefa ta dynamika modals meta tin epilogi selidas
		 * den mporousa na parw to form pou eixa ekei, kai oti tropos 
		 * kai na dokimaza itan xalia. Opote afairesa to form apo ta modals
		 * kai evala apla elements. Etsi pairnw apla ta dedomena gia to post
		 * apo ta elements kai kataskeuazw ena form to opoio ginetai
		 * non-ajax post sto dashboard.php.
		 * */
		var modalform = $(this).parent().parent();
		var id = modalform.find('span[data-id]').data('id');
		var comment = modalform.find('textarea').val(); 
		var post_data = { report_id: id, comment: comment, markClosed: 1 };
		console.log("before posting");

		$('<form method="post" action="dashboard.php" role="form">' +
			'<input name="report_id" value="' + id + '">' +
			'<textarea name="comment">'+comment+'</textarea>' +
			'<input name="markClosed">' +
			'</form>').submit();
	});

	//delegate event to document in case of newlly added categories
	$(document).on("click", ".category", function() {
		$(this).attr('contentEditable', true);
	}).blur(function() {
		$(this).attr('contentEditable', false);
		var newName = $(this).text();
		if (newName){
			var id = $(this).attr('id');
			var post_data = "newName="+newName+"&category_id="+id;
			$.post( "dashboard.php", post_data );
		}
	});

	//delegate event to document in case of newlly added categories
	$(document).on("click", ".catRemove", function() {
		var cat_id = $(this).siblings().attr('id');	
		var post_data = "del_cat_id="+cat_id;
		$.post( "dashboard.php", post_data );
		$(this).parent().remove();
	});

	$('.delUser').click(function() {
		var uid = $(this).parent().siblings("td.uid").text();
		$('<form method="post" action="dashboard.php" role="form">' +
			'<input name="del_user_id" value="' + uid + '">' +
			'</form>').submit();
	});

	$(document).on("submit", "#categoryForm", function(e) {
		e.preventDefault();
		var post_data = $(this).serialize() + "&categorySubmit="+encodeURIComponent(1);
		$.post( "dashboard.php", post_data )
			.done(function( data ) {
				$('#categories').append(data);
			});
	});




});

