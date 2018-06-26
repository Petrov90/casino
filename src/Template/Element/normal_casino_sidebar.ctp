<script>loctn = [];</script>
<?php 

foreach ($casCity as $casino) {
	$murl = $this->Url->build(['plugin' => '','controller' => 'Casinos','action' => 'casino_view','casino_view' => $casino->slug]);?>
	  <script>
     	loctn.push(['<?php echo str_replace("'","",$casino->title); ?>','<?php echo str_replace("'","",$casino->address); ?>','<?php echo str_replace("'","",$murl); ?>']);
     	//alert(loctn);
    </script><?php
	
}
?>



<div class="newsaws_info news_in2">
   <div class="newsaws_post">
   	<div class="news_post">

		 <h3>Casinos nearby</h3>

		 <div class="newsBidget">
		 <?php //echo"<pre>"; print_r($recommedCasinos1); die("kpkp"); 
		 	$recommedCasinoscount = 0;?>
		 <?php foreach($recommedCasinos1 as $news){ $recommedCasinoscount++;  
		 	if($recommedCasinoscount <= 5){ 
		 	?>
			<div class="item_D1">

			   <div class="item_img"><a href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $news->slug]); ?>"><?php 

			 if(!empty($news->image) && file_exists(CASINO_THUMB_IMG_ROOT_PATH.$news->image)){

				echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=110px&height=59px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$news->image,['alt' => 'Image','height'=>59, 'width'=>110]);

			 }else{ ?>
					<img src="http://www.casinoo.com/webroot/uploads/image.php?width=110px&amp;height=120px&amp;cropratio=2:1&amp;image=http://www.casinoo.com/webroot/img/city-image.jpg" alt="Image">
					<?php
			    } ?>
			 	
			 </a></div>

			   <div class="item_text">

				  <p><a href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $news->slug]); ?>"><?php echo $news->title ?></a></p>
				  <?php if($news->review_count == 0){
				  	
				  }else{ ?>
				  	<span><?php echo $news->review_count; ?> comments</span> 
				  <?php
				  } ?>
				  
			   </div>

			</div>

		 <?php }
		 } ?>

		 </div>

	  </div>
	  <div class="news_post">		

		 <h3>Recommed Casinos</h3>

		 <div class="newsBidget">

		 <?php foreach($recommedCasinos as $casino){ ?>

			<div class="item_D1">

			   <div class="item_img"><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]) ?>"><?php 

				if(!empty($casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image)){

					echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=110px&height=59px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$casino->image,['alt' => $casino->title.' review','height' => 59,'width' => 110]);

				} ?></a></div>

			   <div class="item_text">

				  <a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]) ?>"><?php echo $casino->title ?></a>

				  <small class="readonly" data-score="<?php echo $casino->avg_rating; ?>"></small><a data-title="<?php echo $casino->title ?>" data-url="<?php echo $casino->slug ?>" <?php echo NEWTAB ?> rel="nofollow" href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $casino->main_promotion->slug)); ?>" class="btn playBtn">Play now</a>

			   </div>

			</div>

		 <?php } ?>

		 </div>

		 <div class="view_all_casino"><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'onlineCasino']); ?>">View All Casinos</a></div>

	  </div>
	
		<div class="news_post">
			<h3>Map</h3>
			<div class="newsBidget">			
				<div id="map_canvas">
				</div>
			</div>
		</div>
		<?php echo $this->cell('Inbox::news_right_side_bar_index'); ?>
	</div>
</div><?php
//echo $this->Html->script(['https://maps.googleapis.com/maps/api/js?v=3&libraries=geometry%2Cplaces&key&language='.$Defaultlanguage.'&key=AIzaSyCjfXKrWKV1PBcTcbd8cMtT97uM71SBacA','masonry.js'],array('block' =>'custom_script'));
$this->Html->scriptStart(array('block' => 'custom_script')); ?>



google.maps.event.addDomListener(window, 'load', initialize);
		var bounds = new google.maps.LatLngBounds();
		
		var geocoder;
		var map;
		var bounds = new google.maps.LatLngBounds();

		function initialize() {

			map = new google.maps.Map(
			document.getElementById("map_canvas"), {
			  center: new google.maps.LatLng(37.4419, -122.1419),
			  zoom: 20,  
			    mapTypeControl: true,
		    mapTypeControlOptions: {
		      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
		    },
    		navigationControl: true,
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			});
		  geocoder = new google.maps.Geocoder();

		  for (i = 0; i < loctn.length; i++) {
			geocodeAddress(loctn, i);
		  }
		}
		function geocodeAddress(locations, i) {
		
		  var title = loctn[i][0];
		  var address = loctn[i][1];
		  var url = loctn[i][2];
		  geocoder.geocode({
			  'address': loctn[i][1]
			},
			function(results, status) {
			  if (status == google.maps.GeocoderStatus.OK) {
				var marker = new google.maps.Marker({
				  icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
				  map: map,
				  position: results[0].geometry.location,
				  title: title,
				  center: results[0].geometry.location,
				  animation: google.maps.Animation.DROP,
				  address: address,
				  url: url
				});
				infoWindow(marker, map, title, address, url);
				bounds.extend(marker.getPosition());
				map.fitBounds(bounds);
				map.panTo(marker.center);
				map.setZoom(13);			
			  }
			});
		}
		function infoWindow(marker, map, title, address, url) {
		var htmls = "<div><h4><a href="+url+">" + title + "</a></h4><p>" + address + "<br></div></p></div>";
		  google.maps.event.addListener(marker, 'click', function() {
			var html = "<div><h4><a href="+url+">" + title + "</a></h4><p>" + address + "<br></div></p></div>";
			iw = new google.maps.InfoWindow({
			  content: html,
			  size: new google.maps.Size(150, 50)
			});
			iw.open(map, marker);
		  }); 	  
	
		}
		function createMarker(results) {
		    var marker = new google.maps.Marker({
				//icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
				map: map,
				position: results[0].geometry.location,
				title: title,
				animation: google.maps.Animation.DROP,
				address: address,
				url: url
		    })
		    bounds.extend(marker.getPosition());
		    map.fitBounds(bounds);
		    infoWindow(marker, map, title, address, url);
		    return marker;
		}				

<?php $this->Html->scriptEnd(); ?>