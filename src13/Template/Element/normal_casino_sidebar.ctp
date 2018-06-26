<div class="newsaws_info news_in2">
   <div class="newsaws_post">
	<?php echo $this->cell('Inbox::news_right_side_bar_index'); ?>
		<div class="news_post">
			<h3>Map</h3>
			<div class="newsBidget">			
				<div id="map_canvas">
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->Html->scriptStart(array('block' => 'custom_script')); ?>

	var latlng = new google.maps.LatLng(<?php echo (!empty($casino->latitude)) ? $casino->latitude : LAT; ?>,<?php echo (!empty($casino->longitude)) ? $casino->longitude : LONG; ?>);					
    var myOptions ={
		zoom: 15,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	var myMarker = new google.maps.Marker(
	{
		position: latlng,
		map: map,
		title:"<?php echo $casino->title; ?>"
    });	
	google.maps.event.trigger(map, 'resize');
<?php $this->Html->scriptEnd(); ?>