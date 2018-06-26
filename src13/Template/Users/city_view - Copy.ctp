<div class="mid_wrapper">
	<?php if(!empty($images)){ ?>
	<div class="cityBanner">
		<div id="allslider" class="">
			<ul class="slides">
			<?php foreach($images as $key => $img){ ?>
				<li>
					<div class="citySlide">
					<?php if($key == 0){ ?>
							<img alt="Image" src="<?php echo CASINO_FULL_IMG_URL.$img->file ?>" />
					<?php }else{ ?>
							<img alt="img"  id="<?php echo $key; ?>_img" class="lazy" src="<?php echo WEBSITE_IMG_URL.'camera-loader.gif' ?>" data-src="<?php echo CASINO_FULL_IMG_URL.$img->file ?>" />
					<?php } ?>
						<div class="slideCptin">
							<h1><?php echo $cityDetail->name; ?></h1>
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
						$count	=	0;
						foreach($images as $img){ $count++; ?>
							<li><img alt="img" src="<?php echo CASINO_THUMB_IMG_URL.$img->file ?>" /><?php /* <span>Boston Hotels</span> */?></li>
						<?php } ?>
					</ul>
				<?php if($count >8){ ?>
				 <div class="thumbNav">
					<a href="javascript:void(0)" class="prev"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>ic2.png" alt="icon" /></a>
					<a href="javascript:void(0)" class="next"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>ic3.png" alt="icon" /></a>
				 </div>
				<?php } ?>
				</div>
			</div>
		</div>
	</div> 	
  <div class="clowdInfo" data-ng-app="myApp" >
   <?php //echo $this->element('add_review_popup'); ?>
    <div class="container">
		<div class="clowdTop">
        <div class="pull-left"><a href="javascript:void(0);" data-name="<?php echo $cityDetail->name; ?>" data-type="city" data-id="<?php echo $cityDetail->id; ?>" class="btn red_btn city-click">Add Review</a></div>
        <div class="pull-right"> <a href="">Add Info</a> <span>/</span> <a href="">Add Photos</a> </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <div class="clowdLeft">
            <div data-ng-class="!readmore ? 'show' : 'hide'"><?php echo $this->Text->truncate($cityDetail->description,350,['html' => true]); ?></div>
            <div data-ng-class="readmore ? 'show' : 'hide'"><?php echo $cityDetail->description; ?></div>
			<div data-ng-click="readmore=true" data-ng-class="!readmore ? 'show' : 'hide'" class="block"><a href="">Read More</a></div>
			<div data-ng-class="readmore ? 'show' : 'hide'" data-ng-click="readmore=false" class="block"><a href="">Read Less</a></div>
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
				<div class="dgriCol m"><span>Wind Speed</span><span data-ng-show="temp">{{wind_speed_c | number : 2 }} km/h</span><span data-ng-show="!temp">{{wind_speed_f | number : 2 }} mph</span></div>
             
                <div class="dgriCol m"><span>Humidity</span><span>{{humidity}}%</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php }else{ ?>
	<div class="AddCity  Addcity2">
    <div class="container">
      <h1><?php echo isset($cityDetail->name) ? $cityDetail->name : $slug; ?></h1>
      <h2><?php echo isset($cityDetail->country->name) ? $cityDetail->country->name.'/' : ''; echo isset($cityDetail->name) ? $cityDetail->name : $slug; ?></h2>
      <div class="block"><a href="" class="btn addBtn"><i class="fa fa-camera"></i>Add a Photo</a></div>
    </div>
  </div>
  <div class="clowdInfo"  data-ng-app="myApp"  data-ng-controller="myCtrl">
  <?php //echo $this->element('add_review_popup'); ?>
    <div class="container">
      <div class="clowdTop">
        <div class="pull-left"><a href="javascript:void(0);" data-name="<?php echo $cityDetail->title; ?>" data-type="city" data-id="<?php echo $cityDetail->id; ?>" class="btn red_btn city-click">Add Review</a></div>
        <div class="pull-right"> <a href="">Add Info</a> <span>/</span> <a href="">Add Photos</a> </div>
      </div>
      <div class="clowdMid" data-ng-class="no_rec ? 'hide' : ''">
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
				<div class="dgriCol m"><span>Wind Speed</span><span data-ng-show="temp">{{wind_speed_c | number : 2 }} km/h</span><span data-ng-show="!temp">{{wind_speed_f | number : 2 }} mph</span></div>
             
                <div class="dgriCol m"><span>Humidity</span><span>{{humidity}}%</span></div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
  
  <?php } ?>
  <div class="casino_info cacinoCitys">
    <div class="container">
      <div class="title">
        <h2>Popular Casinos in <?php echo isset($cityDetail->name) ? $cityDetail->name : ''; ?></h2>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
        <span></span> </div>
      <div class="casino_city">
		<?php if(!empty($cityDetail->casino)){ ?>
        <ul>
		<?php foreach($cityDetail->casino as $casino){ ?>
          <li>
			<a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'casinos','action' => 'casino_view','casino_view' => $casino->slug)); ?>">
				<img class="img-responsive" alt="img"  src="<?php echo CASINO_THUMB_IMG_URL.$casino->image; ?>">
			</a>
            <div class="casino_detail">
              <h2><?php echo $casino->title ?></h2>
              <p><?php echo $this->Number->format($casino->review_count) ?> Reviews</p>
            </div>
          </li>
		<?php } ?>
        </ul>
		<?php }else{ ?>
			<p class="no-casino"><?php echo __('No casino has been added yet'); ?></p>
		<?php } ?>
      </div>
    </div>
  </div>
   <div class="casinoLocation">
    <div class="container">
      <div class="title">
        <h2>Locations</h2>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
        <span></span> </div>
      <div class="LoctionMap" id="map_canvas"></div>
    </div>
  </div>
  <div class="casino_desc">
    <div class="container">      
      <div class="row">
        <div class="col-md-12">
			<?php echo $this->element('normal_casino_review_json',['name' => $cityDetail->name,'id' => $cityDetail->id,'type' => 'city','count' => $cityDetail->review_count,'avg_rating' => $cityDetail->avg_rating]); ?>
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
				$scope.Temp_c 			= Temp_c.toFixed(2); ;
				
				wind_speed_c 			=  (3600*response.data.wind.speed)/1000;
				$scope.wind_speed_f 	=  wind_speed_c.toFixed(2); ;
				
				Temp_f 			=  Math.round((10*(response.data.main.temp -273.15))/10) * 9/5 + 32;
				// Temp_f			=	10.5555555555555555555;
				$scope.Temp_f 	=  Temp_f.toFixed(2); ;
				
				
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
		animation: "slide",
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
<?php $this->Html->scriptEnd(); ?>