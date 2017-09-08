<div class="col-lg-12">
	<section class="panel">
		<div class="panel-body">
			<form class="form-inline pull-right " role="form">
				<div class="form-group">
					<input type="text" id="gmap_geocoding_address" class=" form-control" placeholder="Address..." />
				</div>
				<input type="button" id="gmap_geocoding_btn" class="btn  btn-info" value="Search" />
			</form>
			<br>
			<div id="gmap_marker" class="gmaps"></div>
		</div>
	</section>
</div>

<?php
$maper = "";
foreach ($car_lat_long as $clt) {

	$maper .= 'map.addMarker({
					lat: ' . $clt['carPickUpLat'] . ',
					lng: ' . $clt['carPickUpLon'] . ',
					details: {
						database_id: 42,
						author: "HPNeo"
					},
					click: function (e) {
						if (console.log) console.log(e);
						//alert("You clicked in this marker");
					}
				});';
}

$custum_js = '
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1JDWvMiOd6zDVI2ppYGtSFK-3vRCSQic&sensor=true"></script>
	<script src="' . AUTH_ASSETS . 'js/gmaps.js" ></script>
    
		<script>
		var GoogleMaps = function () {

			var mapMarker = function () {
				var map = new GMaps({
					div: "#gmap_marker",
					lat: 34.7071301,
					lng:33.022617399999945,
					zoom: 10,
				});
				
				' . $maper . '
					
			var handleAction = function() {
				var text = $.trim($("#gmap_geocoding_address").val());
				GMaps.geocode({
				  address: text,
				  callback: function(results, status){
					if(status=="OK"){
					  var latlng = results[0].geometry.location;
					  map.setCenter(latlng.lat(), latlng.lng());
					  App.scrollTo($("#gmap_marker"));
					}
				  }
				});
			}

			$("#gmap_geocoding_btn").click(function(e){
				e.preventDefault();
				handleAction();
			});

			$("#gmap_geocoding_address").keypress(function(e){
				var keycode = (e.keyCode ? e.keyCode : e.which);
				if(keycode == "13") {
					e.preventDefault();
					handleAction();
				}
			});
			}
			
			
			
			return {
				//main function to initiate map samples
				init: function () {
				  mapMarker();
				}

			};

		}();
		  jQuery(document).ready(function() {
			  GoogleMaps.init();
		  });
		</script>
	';
echo modules::run('auth_panel/template/add_custum_js', $custum_js);
?>