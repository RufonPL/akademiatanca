<div id="googleMap"></div>
<?php 
if(is_page(template_id('contact'))) {
	$addresses 	= get_field('_map_points');
	$map_icon	= get_field('_map_points_icon');	
}else {
	$addresses 	= get_field('_courses_places', 'option');
	$map_icon	= get_field('_cp_map_points_icon', 'option');	
}
?>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB4XNTTMcp8RATV_NwU_UMaXVDEUXbyCd0"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/markerclusterer.min.js"></script>

<?php if($addresses) : ?>
<script>
var locations = [
	<?php foreach($addresses as $address) : ?>
	{
		<?php if(is_page(template_id('contact'))) : ?>
		lat: <?php echo wp_json_encode($address['_lat']); ?>,
		lng: <?php echo wp_json_encode($address['_lng']); ?>,
		name: <?php echo wp_json_encode($address['_map_point_header']); ?>,
		address: <?php echo wp_json_encode(p2br($address['_map_point_address'])); ?>,
		<?php else : ?>
		lat: <?php echo wp_json_encode($address['_cp_lat']); ?>,
		lng: <?php echo wp_json_encode($address['_cp_lng']); ?>,
		name: '',
		address: <?php echo wp_json_encode($address['_cp_text']); ?>,
		<?php endif; ?>
	},
	<?php endforeach; ?>
];

var map = new google.maps.Map(document.getElementById('googleMap'), {
	zoom:15,
	disableDefaultUI:false,
	scrollwheel: false,
});

var infowindow = new google.maps.InfoWindow();

function displayMarkers() {
	var bounds = new google.maps.LatLngBounds();
	for (i = 0; i < locations.length; i++) {
		
		var latlng = new google.maps.LatLng(locations[i].lat, locations[i].lng);
		var name = locations[i].name;
		var address = locations[i].address;
		
		createMarker(latlng, name, address);
		
		bounds.extend(latlng);
	}
	map.fitBounds(bounds);
}

function createMarker(latlng, name, address) {
	map.setCenter(latlng);
	
	var infoContent = '<div class="map-info">' +
	'<p class="point-name"><strong>' + name + '</strong></p>' +
	'<p>' + address + '</p>' +
	'</div>';
	marker = new google.maps.Marker({
		position: latlng,
		map: map,
		icon: <?php echo wp_json_encode($map_icon); ?>,
		html: infoContent,
		animation: google.maps.Animation.DROP
	});
	
	google.maps.event.addListener(marker, 'click', function() { 
		infowindow.setContent(this.html);
		infowindow.open(map, this);
	});
	google.maps.event.addListener(map, 'click', function() {
		if (infowindow) {
			infowindow.close();
		}
	});
	google.maps.event.addListener(infowindow, 'domready', function() {
		var iwOuter = $('.gm-style-iw');
		
		//The DIV we want to change is above the .gm-style-iw DIV
		var iwBackground = iwOuter.prev();
 		
		// Remove the background shadow DIV
  		iwBackground.children(':nth-child(2)').css({'display' : 'none'});

   		// Remove the white background DIV
   		iwBackground.children(':nth-child(4)').css({'display' : 'none'});
		
		iwOuter.parent().parent().css({left: '20px', top: '30px'});
		
		// Shadow of the arrow
		iwBackground.children(':nth-child(1)').css({'display' : 'none'});
		
		// The arrow
		iwBackground.children(':nth-child(3)').css({'display' : 'none'});
		
		var iwCloseBtn = iwOuter.next();
		iwCloseBtn.css({
			opacity: '1',
			'border-radius': '5px',
			right: '57px', top: '3px',
		});
		
		// The API automatically applies 0.7 
		iwCloseBtn.mouseout(function(){
		  $(this).css({opacity: '1'});
		});
	});
}
displayMarkers();
</script>
<?php endif; ?>

    	