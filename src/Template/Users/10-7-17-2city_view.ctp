<div class="mid_wrapper">
<?php  $cityName = isset($cityDetail->name) ? $cityDetail->name : $slug;$countryName = isset($cityDetail->country->name) ? $cityDetail->country->name : ''; ?>
	<?php if(isset($images) && !$images->isEmpty()){ ?>
	<div class="cityBanner">
		<div id="allslider" class="">
			<ul class="slides">
			<?php foreach($images as $key => $img){ ?>
				<li	<?php if($key > 0){ ?>style="display:none" <?php  } ?>>
					<div class="citySlide">
					<?php if($key == 0){ ?>
							<img alt="Image" src="<?php echo CASINO_FULL_IMG_URL.$img->file ?>" />
					<?php }else{ ?>
							<img alt="img"  id="<?php echo $key; ?>_img" class="lazy" src="<?php echo WEBSITE_IMG_URL.'camera-loader.gif' ?>" data-src="<?php echo CASINO_FULL_IMG_URL.$img->file ?>" />
					<?php } ?>
						<div class="slideCptin">
							<h1><?php echo $cityDetail->name; ?></h1>
							<h2><?php echo $countryName; ?></h2>
							<!--  <div class="block"><a   href="javascript:void(0);"  data-type="city" data-id="<?php // echo $cityDetail->id; ?>" class="add-photos-click btn addBtn"><i class="fa fa-camera"></i>Add a Photo</a></div> -->
						</div>
					</div>
				</li>
			<?php } ?>
			</ul>
		</div>
		<div class="cityThumb">
			<div class="container">
				<div id="allcarousel" class="carousel-box thumbSlide">
					<ul class="slides mouse-pointer">
						<?php 
						$count	=	$num_of_img = 0;
						foreach($images as $img){ $num_of_img++;}
				//if num_of_img is greater than one than show images to that city		
				if($num_of_img > 1) {
						foreach($images as $img){ $count++; ?>							
							<li id="<?php echo ($count == 1) ? 'actimg' : ''; ?>"><img alt="img" src="<?php echo WEBSITE_URL.'image.php?width=150px&height=75px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$img->file ?>" /></li>
						<?php } ?>
					</ul>
					<?php if($count >8){ ?>
					 <div class="thumbNav">
						<a href="javascript:void(0)" class="prev"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>ic2.png" alt="icon" /></a>
						<a href="javascript:void(0)" class="next"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>ic3.png" alt="icon" /></a>
					 </div>
					<?php } 
				} ?>
				</div>
			</div>
		</div>
	</div> 	
  <div class="clowdInfo" data-ng-app="myApp" >
   <?php //echo $this->element('add_review_popup'); ?>
    <div class="container">
		<div class="clowdTop">
        <div class="pull-left"><a href="javascript:void(0);" data-name="<?php echo $cityDetail->name; ?>" data-type="city" data-id="<?php echo $cityDetail->id; ?>" class="btn red_btn city-click add-rvw-btn hide">Add Review</a></div>
        <div class="pull-right"> <a href="">Add Info</a> <span>/</span> <a href="javascript:void(0);"  data-type="city" data-id="<?php echo $cityDetail->id; ?>" class="add-photos-click">Add Photos</a> </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <div class="clowdRight">
            <h2>Information</h2>
            <div class="clowdIn col_info2">
              <div class="col">
                <div class="informa_info">
                <h4>Population</h4>
                <p><?php echo $cityDetail->population ?> hab.</p>
                <div class="pull-left"><img src="<?php echo WEBSITE_URL; ?>images/poblacion_icon.png" alt="icon" width="32" height="37"></div>
              </div>
              </div>
              <div class="col">
                <div class="informa_info">
                <h4>Casinos</h4>
                <p><?php echo $this->request->params['paging']['Casinos']['count']; ?></p>
                <div class="pull-left"><img src="<?php echo WEBSITE_URL; ?>images/casino_icon2.png" alt="icon" width="37" height="37"></div>
              </div>
              </div>
              <div class="col">
                <div class="informa_info">
                <h4>Altitude</h4>
                <p><?php echo $cityDetail->altitude ?> m s. n. m.</p>
                <div class="pull-left"><img src="<?php echo WEBSITE_URL; ?>images/Altitud_img.png" alt="icon" width="46" height="26"></div>
              </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6" data-ng-controller="myCtrl">
          <div class="clowdRight">
            <h2>Current Forecast <span><a target="_blank" href="http://www.openweathermap.com/" class="mouse-pointer">by openweathermap</a></span></h2>
            <div class="clowdIn loading">
				<p class="text-center">Loading...</p>
			</div>
            <div class="clowdIn hide weather">
              <div class="col">
                <div class="pull-left">
					<h3>
						<span data-ng-show="!temp">{{Temp_f}}<sup><span data-ng-class="temp ? 'active' : ''" data-ng-click="temp=false"> &nbsp; °F</span> | <span data-ng-class="!temp ? 'active' : ''" data-ng-click="temp=true">°C</span></sup></span>
						<span data-ng-show="temp">{{Temp_c}}<sup><span data-ng-class="temp ? 'active' : ''" data-ng-click="temp=false"> &nbsp; °F</span> | <span data-ng-class="!temp ? 'active' : ''" data-ng-click="temp=true">°C</span></sup></span>
					</h3>
                </div>
                <div class="pull-right">
					<img data-ng-src="{{icon}}" src="#" alt="icon" />
				</div>
              </div>
              <div class="col">
				<div class="dgriCol m"><span>Wind Speed</span><span data-ng-show="temp">{{wind_speed_c | number : 0 }} km/h</span><span data-ng-show="!temp">{{wind_speed_f | number : 0 }} mph</span></div>
             
                <div class="dgriCol m"><span>Humidity</span><span>{{humidity}}%</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php }else{ ?>
	<div class="cityBanner contrybanner ">
		<div class="citySlide city_Banner2"><img src="<?php echo WEBSITE_URL ?>images/city_img3.jpg" alt="img">
			<div class="AddCity  Addcity2 Addcity_page2">				  
				<div class="container">
					<h1><?php echo $cityName; ?></h1>
					<h2><?php echo $countryName/* .'/';
					echo isset($cityDetail->name) ? $cityDetail->name : $slug; */ ?></h2>
				  <div class="block"><a   href="javascript:void(0);"  data-type="city" data-id="<?php echo $cityDetail->id; ?>" class="add-photos-click btn addBtn"><i class="fa fa-camera"></i>Add a Photo</a></div>
				</div>
			</div>
		</div>
	</div>
  <div class="clowdInfo"  data-ng-app="myApp"  data-ng-controller="myCtrl">
  <?php //echo $this->element('add_review_popup'); ?>
    <div class="container">
      <div class="clowdTop">
        <div class="pull-left"><a href="javascript:void(0);" data-name="<?php echo $cityDetail->name; ?>" data-type="city" data-id="<?php echo $cityDetail->id; ?>" class="btn red_btn city-click add-rvw-btn hide">Add Review</a></div>
        <div class="pull-right"> <a href="">Add Info</a> <span>/</span> <a  href="javascript:void(0);"  data-type="city" data-id="<?php echo $cityDetail->id; ?>" class="add-photos-click">Add Photos</a> </div>
      </div>
      <div class="row">
		<div class="col-lg-6 col-md-6">
          <div class="clowdRight">
            <h2>Information</h2>
            <div class="clowdIn col_info2">
              <div class="col">
                <div class="informa_info">
                <h4>Population</h4>
                <p><?php echo $cityDetail->population ?> hab.</p>
                <div class="pull-left"><img src="<?php echo WEBSITE_URL; ?>images/poblacion_icon.png" alt="icon" width="32" height="37"></div>
              </div>
              </div>
              <div class="col">
                <div class="informa_info">
                <h4>Casinos</h4>
                <p><?php echo $this->request->params['paging']['Casinos']['count']; ?></p>
                <div class="pull-left"><img src="<?php echo WEBSITE_URL; ?>images/casino_icon2.png" alt="icon" width="37" height="37"></div>
              </div>
              </div>
              <div class="col">
                <div class="informa_info">
                <h4>Altitude</h4>
                <p><?php echo $cityDetail->altitude ?> m s. n. m.</p>
                <div class="pull-left"><img src="<?php echo WEBSITE_URL; ?>images/Altitud_img.png" alt="icon" width="46" height="26"></div>
              </div>
              </div>
            </div>
          </div>
        </div>
		<div class="col-lg-6 col-md-6">
        <div class="clowdRight" data-ng-class="no_rec ? 'hide' : ''">
            <h2>Current Forecast <span><a target="_blank" href="http://www.openweathermap.com/" class="mouse-pointer">by openweathermap</a></span></h2>
            <div class="clowdIn loading">
				<p class="text-center">Loading...</p>
			</div>
            <div class="clowdIn hide weather">
              <div class="col">
                <div class="pull-left">
					<h3>
						<span data-ng-show="!temp">{{Temp_f}}<sup><span data-ng-class="temp ? 'active' : ''" data-ng-click="temp=false"> &nbsp; °F</span> | <span data-ng-class="!temp ? 'active' : ''" data-ng-click="temp=true">°C</span></sup></span>
						<span data-ng-show="temp">{{Temp_c}}<sup><span data-ng-class="temp ? 'active' : ''" data-ng-click="temp=false"> &nbsp; °F</span> | <span data-ng-class="!temp ? 'active' : ''" data-ng-click="temp=true">°C</span></sup></span>
					</h3>
                </div>
                <div class="pull-right">
					<img data-ng-src="{{icon}}" src="#" alt="icon" />
				</div>
              </div>
              <div class="col">
				<div class="dgriCol m"><span>Wind Speed</span><span data-ng-show="temp">{{wind_speed_c | number : 0 }} km/h</span><span data-ng-show="!temp">{{wind_speed_f | number : 0 }} mph</span></div>
             
                <div class="dgriCol m"><span>Humidity</span><span>{{humidity}}%</span></div>
              </div>
            </div>
          </div>
          </div>
      </div>
    </div>
  </div>
  
  <?php } ?>
  <div class="casino_desc">
    <div class="container">
		<div class="row">
			<div class="title cuntery_Title">
				<h2>Popular Casinos in <?php echo isset($cityDetail->name) ? $cityDetail->name : ''; ?></h2>
			</div>
		</div>
	</div>
	<div class="container">
	   <div class="row">
		  <div class="clint_info">
		<?php 
		if(!$casinosData->isEmpty()){
			foreach($casinosData as $casino){  ?>
			 <div class="clint_info_post">
				<div class="clint_post">
				   <div class="clint_item">
                   <a href="<?php echo $this->Url->build(array('controller' => 'casinos','action' => 'casino_view','casino_view' => $casino->slug)); ?>">
				   <?php if(!empty($casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image)){ ?>
						<img class="img-responsive" alt="img"  src="<?php echo WEBSITE_UPLOADS_URL.'image.php?height=130px&image='.CASINO_FULL_IMG_URL.$casino->image; ?>"/>
					<?php }else{ ?>
						<img class="img-responsive" alt="img"  src="<?php echo WEBSITE_UPLOADS_URL.'image.php?height=130px&image='.NO_CASINO_IMG; ?>"/><?php 
					} ?></a></div>
				   <div class="clint_post_right">
					  <span><a href="<?php echo $this->Url->build(array('controller' => 'casinos','action' => 'casino_view','casino_view' => $casino->slug)); ?>"><?php echo $casino->title ?></a></span>
					  <div class="clientRating readonly" data-score="<?php echo $casino->avg_rating; ?>"></div>
					  <p><?php echo $cityName ?>,<?php echo $countryName; ?></p>
				   </div>
				   <div class="sbumit_block3">
					  <div class="more_info_btn">
						 <a class="more_btn more_Btn" href="<?php echo $this->Url->build(array('controller' => 'casinos','action' => 'casino_view','casino_view' => $casino->slug)); ?>">More info</a>
					  </div>
				   </div>
				</div>
			 </div>
		<?php }
		}else{
			?><div class="text-center h500">No Record Found</div><?php
		}
		
		echo $this->element('country_page_pagination',['url' =>$this->Url->build(['plugin' => '','controller' => 'Users','action' => 'city_view','country' => $countrySlug,'city' => $slug])]);
	
		?>
			<div class="clint_info_post">
				<?php echo $this->element('normal_casino_review_json',['name' => $cityDetail->name,'id' => $cityDetail->id,'type' => 'city','count' => $cityDetail->review_count,'avg_rating' => $cityDetail->avg_rating]);
					
					echo $this->element('question_answer_json',['name' => $cityDetail->name,'id' => $cityDetail->id,'type' => 'city','count' => $cityDetail->question_count]);
				?>
			</div>
		  </div>
		  <div class="gamblingBox">
			 <div class="detail_map">
				<h2>Map</h2>
				<div id="map_canvas"></div>
			 </div>
			 <div class="news_post ">
				<h3>Recommed Casinos</h3>
				<div class="newsBidget">
				    <?php foreach($recommedCasinos as $casino){ ?>
			<div class="item_D1">
			   <div class="item_img"><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]) ?>"><?php 
				if(!empty($casino->image) && (CASINO_FULL_IMG_ROOT_PATH.$casino->image)){
					echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=110px&height=59px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$casino->image,['alt' => 'Image','height' => 59,'width' => 110]);
				} ?></a></div>
			   <div class="item_text">
				  <a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]) ?>"><?php echo $casino->title ?></a>
				  <small class="readonly" data-score="<?php echo $casino->avg_rating; ?>"></small><a data-title="<?php echo $casino->title ?>" data-url="<?php echo $casino->slug ?>" <?php echo NEWTAB ?> rel="nofollow" href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $casino->main_promotion->slug)); ?>" class="btn playBtn">Play now</a>
			   </div>
			</div>
		 <?php } ?>
				</div>
				<div class="view_all_casino"><a href="/casino/online-casinos">View All Casinos</a></div>
			 </div>
		  </div>
	   </div>
	</div>	
  </div>
</div>
<?php 

echo $this->Html->script(['https://maps.googleapis.com/maps/api/js?v=3&libraries=geometry%2Cplaces&key&language='.$Defaultlanguage.'&key=AIzaSyCjfXKrWKV1PBcTcbd8cMtT97uM71SBacA','masonry.js'],array('block' =>'custom_script'));
$this->Html->scriptStart(array('block' => 'custom_script')); ?>
var geocoder;
var map;
var address = "<?php echo (isset($cityDetail->name)) ? $cityDetail->name.'&nbsp;&nbsp;' : $slug; echo isset($cityDetail->country->name) ? $cityDetail->country->name : ''; ?>";

function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(-34.397, 150.644);
  var myOptions = {
    zoom: 8,
    center: latlng,
    mapTypeControl: true,
    mapTypeControlOptions: {
      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
    },
    navigationControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  if (geocoder) {
    geocoder.geocode({
      'address': address
    }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
          map.setCenter(results[0].geometry.location);

          var infowindow = new google.maps.InfoWindow({
            content: '<b>' + address + '</b>',
            size: new google.maps.Size(150, 50)
          });

          var marker = new google.maps.Marker({
            position: results[0].geometry.location,
            map: map,
            title: address
          });
          google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
          });

        } else {
          alert("No results found");
        }
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }
}

google.maps.event.addDomListener(window, 'load', initialize);
	var app = angular.module('myApp', []);
	
	app.controller('myCtrl', function($scope, $http) {
		
		$http.get("http://api.openweathermap.org/data/2.5/weather?q=<?php echo (isset($cityDetail->name)) ? $cityDetail->name.','.$cityDetail->country_name : $slug ?>&appid=858c699462f8c4ace63f729323c20adf")
		.then(function(response) {
			if(response.data.cod != 404){
				Temp_c 					= Math.round(10*(response.data.main.temp -273.15))/10 ;
				$scope.Temp_c 			= Temp_c.toFixed(); ;
				
				wind_speed_c 			=  (3600*response.data.wind.speed)/1000;
				wind_speed_f			=	0.62 * wind_speed_c;
				$scope.wind_speed_c 	=  wind_speed_c.toFixed(); 
				$scope.wind_speed_f = wind_speed_f.toFixed();
				Temp_f 			=  Math.round((10*(response.data.main.temp -273.15))/10) * 9/5 + 32;
				// Temp_f			=	10.5555555555555555555;
				$scope.Temp_f 	=  Temp_f.toFixed(); 
				
				
				$scope.humidity 		=  response.data.main.humidity;
				
				$scope.icon		 		= 'http://openweathermap.org/img/w/'+response.data.weather[0]['icon']+'.png';
				$scope.no_rec		=	false;
			}else{
				$scope.no_rec		=	true;
			}
				$(".loading").addClass('hide');
				$(".weather").removeClass('hide');
			
		});
	});
	
	
		$(".prev").click(function() {
			$('#allcarousel').flexslider("prev")
		});
		$(".next").click(function() {
			$('#allcarousel').flexslider("next")
		});
		
		$('#allcarousel').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: false,
			slideshow: false,
			itemWidth: 120,
			maxItems: 8,
			minItems: 8,
			directionNav: false,
			itemMargin: 0,
			asNavFor: '#allslider'		
		});

	$('#allslider').flexslider({
		animation: "fade",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		sync: "#allcarousel",
		directionNav: false,
		
		before: function (slider) {
		  var slides 	= slider.slides,
			index 		= slider.animatingTo,
			$slide 		= $(slides[index]),
			$img 		= $slide.find('img[data-src]'),
			current 	= index,
			nxt_slide 	= current + 1,
			prev_slide 	= current - 1;
		
		  $slide
			.parent()
			.find('img.lazy:eq(' + current + '), img.lazy:eq(' + prev_slide + '), img.lazy:eq(' + nxt_slide + ')')
			.each(function () {
				var src = $(this).attr('data-src');
				$(this).attr('src', src).removeAttr('data-src');
				
			});/* 
			
			$("#"+current+"_img").removeClass('lazy');
			$("#"+nxt_slide+"_img").removeClass('lazy');
			$("#"+prev_slide+"_img").removeClass('lazy'); */
		}
	});	
<?php $this->Html->scriptEnd(); 	echo $this->element('add_info_popup',['type' => 'city','foreign_key' => $cityDetail->id]);
 ?>
