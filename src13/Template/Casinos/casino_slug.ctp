<div ng-app="myApp"  ng-controller="MainCtrl">
	<div class="banner_inner  banner_inner banner_back_top img_block14">
	   <div class="search-cover banner_innerPage">
		  <div class="container">
			 <div class="banner-content">
				<div class="search-back">
				   <div class="top-search">
						<input type="text" ng-value="{{city_name}}" id="city_name" ng-model="city_name" class="autocomplete1" placeholder="Where do you search Casino?" >
						<input type="submit" ng-click="get()" value="Search" name="">		
						<a data-ng-href="<?php echo WEBSITE_URL; if($Defaultlanguage != 'en'){ echo $Defaultlanguage.'/'; } ?>search/{{city_name}}" class="search-back-a hide"></a>
					</div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
	<div class="mid_wrapper">
	   <div class="casinoSearch">
		  <div class="container">
			 <div class="row">
				<div class="filter_2N">
				   <div class="fil_block">
					  <ul><?php 
						 $page	 	= ($page > 1) ? 'page='.$page.'&' : ''; 
						 $nearby1 	= ($nearby == 'asc') ? 'nearby=desc' : 'nearby=asc'; 
						 $rating1	= ($rating == 'asc') ? 'rating=desc' : 'rating=asc'; 
						 $review1	= ($review == 'asc') ? 'review=desc' : 'review=asc';  ?>
						 <li class="<?php echo ($order == 'distance') ? 'active' : '' ?>"><a class="<?php echo ($order == 'distance') ? $nearby : '' ?>" href="<?php echo $this->Url->build(['plugin' => '','controller' => 'Casinos','action' => 'casino_slug','casino_slug' => $city_name]).'?'.$page.$nearby1; ?>">Nearby</a></li>
						 <li class="<?php echo ($order == 'avg_rating') ? 'active' : '' ?>"><a  class="<?php echo ($order == 'avg_rating') ? $rating : '' ?>" href="<?php echo $this->Url->build(['plugin' => '','controller' => 'Casinos','action' => 'casino_slug','casino_slug' => $city_name]).'?'.$page.$rating1 ?>">Rating</a></li>
						 <li class="<?php echo ($order == 'review_count') ? 'active' : '' ?>"><a  class="<?php echo ($order == 'review_count') ? $review : '' ?>" href="<?php echo $this->Url->build(['plugin' => '','controller' => 'Casinos','action' => 'casino_slug','casino_slug' => $city_name]).'?'.$page.$review1 ?>">Reviews</a></li>
					  </ul>
				   </div>
				   <?php /*
				   <div class="pull-right filter_btns">
					   <a href="javascript:void(0);" ng-click="gridr()" ng-class="grid ? 'active' : ''" class="fa fa-th "></a>
						<a href="javascript:void(0);" ng-click="brid()" ng-class="!grid ? 'active' : ''" class="fa fa-th-list active"></a>
				   </div>*/?>
				</div>
			 </div>
			 <div class="filtrInner">
				<div class="serchFilter data_div" ng-class="grid ? 'serchGride' : ''" >
					<?php echo $this->element('casino_slug_search'); ?>
				</div>
				<div class="gamblingBox side_bar_box">
					<?php echo $this->cell('Inbox::casinosearchpage'); /* ?>
					   <div class="detail_map">
						  <h2>Map</h2>
						  <div id="map_canvas"></div>
					   </div>*/ ?>
					
				</div>
			</div>
		</div>
		</div>
</div>
</div>
<?php
$this->Html->scriptStart(array('block' => 'custom_script')); ?>
$('.readonly').raty({
	readOnly : true,
	score: function() {
		return $(this).attr('data-score');
	}
});
<?php   $this->Html->scriptEnd(); 				
 // echo $this->Html->script(['https://maps.googleapis.com/maps/api/js?v=3&libraries=geometry%2Cplaces&key&language=en&key=AIzaSyCjfXKrWKV1PBcTcbd8cMtT97uM71SBacA'],array('block' =>'custom_script'));

/* echo $this->Html->css(['jquery.raty.css'],array('block' =>'css')); */
/* echo $this->Html->script(['jquery.raty.js'],array('block' =>'footer_script')); */
$this->Html->scriptStart(array('block' => 'custom_script')); ?>
	$(".side_bar_post > h2").click(function(){
		 var class1	=	$(this).attr('class');
		 if(class1=='active'){
			$(this).next('.side_bar_ptions').addClass('hide');
			$(this).removeClass('active');
		 }else{
			$(this).next('.side_bar_ptions').removeClass('hide');
			$(this).addClass('active');		 
		 }
	 });
	var locations = [];
	var app 	  = angular.module('myApp', []);	
	app.controller('MainCtrl', function($scope,$http) {
		 $scope.city_name	=	'<?php echo $city_name ?>';
		 $scope.get = function() {
			/* $("#ajax-loader").removeClass('hide'); */
			city_name	=	$("#city_name").val();
			url			=	'<?php echo $this->Url->build(['plugin' => '','controller' => 'Casinos','action' => 'casino_slug','casino_slug' => '']); ?>/'+city_name;
			window.location.href	=	url;
		 };
		 $scope.gridr = function() {		
			$scope.grid = true;
			/* setTimeout(function(){		
				$('.serchGride').masonry({
					itemSelector: '.FilterPost',
					transitionDuration: '1s',
					isInitLayout: false,
				});
				$('.serchGride').masonry('layout');
			},1000); */
		}	  
		$scope.brid = function() {
			$scope.grid = false;
		}
		/*
		$scope.no_rec		=	0;
		$scope.lactive		=	'nearby';
		$http.get('<?php echo $this->Url->build('/casino-by-slug/'.$city_name); ?>').success(function(response){
			if(response.length == 0){
				$scope.no_rec	=	1;
			}
			$scope.casino_list = response.casinos;
			$scope.city_detail = response.cities;
			$("#ajax-loader").addClass('hide');
			setTimeout(function(){
				$('.serchGride').masonry({
					itemSelector: '.FilterPost',
					transitionDuration: '1s',
					isInitLayout: false,
				});
				$('.serchGride').masonry('reloadItems');
				$('.serchGride').masonry('layout');
				
				
				$('.jrating').raty({
					readOnly : true,
					score: function() {
						return $(this).attr('data-score');
					}
				});
			},1000);			
			initialize(response);					
		});
		 
		$scope.get = function() {
			$("#ajax-loader").removeClass('hide');
			city_name	=	$("#city_name").val();
			url	=	'<?php echo $this->Url->build('/casino-by-slug/'); ?>'+city_name;
			$http.get(url).success(function(response){
				$scope.casino_list = response.casinos;
				$scope.city_detail = response.cities;
				
				$scope.no_rec	=	0;
				if(response.length == 0){
					$scope.no_rec	=	1;
				}
				$("#ajax-loader").addClass('hide');
				setTimeout(function(){
					$('.serchGride').masonry({
						itemSelector: '.FilterPost',
						transitionDuration: '1s',
						isInitLayout: false,
					});
					$('.serchGride').masonry('reloadItems');
					$('.serchGride').masonry('layout');
					
					$('.jrating').raty({
						readOnly : true,
						score: function() {
							return $(this).attr('data-score');
						}
					});
				},1000);
				initialize(response);			
			});
		}*/
		/* $scope.gridr = function() {	
			$scope.grid = true;
			setTimeout(function(){		
				$('.serchGride').masonry({
					itemSelector: '.FilterPost',
					transitionDuration: '1s',
					isInitLayout: false,
				});
				$('.serchGride').masonry('layout');
			},1000);
		}	  
		$scope.brid = function() {
			$scope.grid = false;
		}
		$scope.evalution = function() {			
			$("#ajax-loader").removeClass('hide');
			city_name	=	$("#city_name").val();
			url	=	'<?php echo $this->Url->build('/casino-by-slug/'); ?>'+city_name+'__review_count';
			$http.get(url).success(function(response){
				$scope.casino_list = response.casinos;
				$scope.city_detail = response.cities;
				
				$scope.lactive	=	'evalution';
				$("#ajax-loader").addClass('hide');
				setTimeout(function(){
					$('.serchGride').masonry({
						itemSelector: '.FilterPost',
						transitionDuration: '1s',
						isInitLayout: false,
					});
					$('.serchGride').masonry('reloadItems');
					$('.serchGride').masonry('layout');
					$('.jrating').raty({
						readOnly : true,
						score: function() {
							return $(this).attr('data-score');
						}
					});
				},1000);
				
				initialize(response);
				
			});
		}
		$scope.reviews = function() {
			$("#ajax-loader").removeClass('hide');
			$scope.lactive	=	'reviews';
			city_name	=	$("#city_name").val();
			url	=	'<?php echo $this->Url->build('/casino-by-slug/'); ?>'+city_name+'__review_count';
			$http.get(url).success(function(response){
				$scope.casino_list = response.casinos;
				$scope.city_detail = response.cities;
				
				$("#ajax-loader").addClass('hide');
				setTimeout(function(){
					$('.serchGride').masonry({
						itemSelector: '.FilterPost',
						transitionDuration: '1s',
						isInitLayout: false,
					});
					$('.serchGride').masonry('reloadItems');
					$('.serchGride').masonry('layout');
					$('.jrating').raty({
						readOnly : true,
						score: function() {
							return $(this).attr('data-score');
						}
					});
				},1000);
				
				initialize(response);
			});
		}
		$scope.nearby = function() {
			$("#ajax-loader").removeClass('hide');
			$scope.lactive	=	'nearby';
			city_name		=	$("#city_name").val();
			url				=	'<?php echo $this->Url->build('/casino-by-slug/'); ?>'+city_name;
			$http.get(url).success(function(response){
				$scope.casino_list = response.casinos;
				$scope.city_detail = response.cities;
				
				$("#ajax-loader").addClass('hide');
				setTimeout(function(){
					$('.serchGride').masonry({
						itemSelector: '.FilterPost',
						transitionDuration: '1s',
						isInitLayout: false,
					});
					$('.serchGride').masonry('reloadItems');
					$('.serchGride').masonry('layout');
					
					$('.jrating').raty({
						readOnly : true,
						score: function() {
							return $(this).attr('data-score');
						}
					});
				},1000);
				
				initialize(response);
			});
		} */
	});
	/* app.filter('htmlToPlaintext', function() {
		return function(text) {
		  return  text ? String(text).replace(/<[^>]+>/gm, '') : '';
		};
	  }
	); */
	
	<?php /*
var geocoder;
var map;
var bounds = new google.maps.LatLngBounds();

function initialize(str) {
	locations = [];
	<?php foreach($casinos as $casino){ if($casino['type'] == 'online') continue; ?>
		locations.push(['<?php echo $casino['name']; ?>','<?php echo $casino['name']; ?>','<?php echo $casino['id']; ?>']);
	<?php } ?>
	
  map = new google.maps.Map(
    document.getElementById("map_canvas"), {
      center: new google.maps.LatLng(37.4419, -122.1419),
      zoom: 13,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
  geocoder = new google.maps.Geocoder();

  for (i = 0; i < locations.length; i++) {
	geocodeAddress(locations, i);
  }
}
google.maps.event.addDomListener(window, "load", initialize);

function geocodeAddress(locations, i) {
  var title = locations[i][0];
  var address = locations[i][1];
  var url = locations[i][2];
  geocoder.geocode({
      'address': locations[i][1]
    },

    function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        var marker = new google.maps.Marker({
          icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
          map: map,
          position: results[0].geometry.location,
          title: title,
          animation: google.maps.Animation.DROP,
          address: address,
          url: url
        })
        infoWindow(marker, map, title, address, url);
        bounds.extend(marker.getPosition());
        map.fitBounds(bounds);
      }
    });
}

function infoWindow(marker, map, title, address, url) {
  google.maps.event.addListener(marker, 'click', function() {
    var html = "<div><h4><a>" + title + "</a></h4><p>" + address + "<br></div></p></div>";
    iw = new google.maps.InfoWindow({
      content: html,
      maxWidth: 350
    });
    iw.open(map, marker);
  });
}

function createMarker(results) {
  var marker = new google.maps.Marker({
    icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
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
}*/ ?>
$(".pr_che").change(function(){
	casino_search();		
});
function casino_search(){
   form_id	=	'pchec';
   $(".data_div").html('<div class="text-center"><img src="<?php echo WEBSITE_IMG_URL.'ajax-loading.gif'; ?>" /></div>');
   $('html, body').animate({scrollTop: ($(".data_div").offset().top - 200)}, 'slow');
	var options = {
		type: 'post',
		success:function(r){
			data		=	JSON.parse(r) ;
			$(".data_div").html(data.data);
			$('html, body').animate({scrollTop: ($(".data_div").offset().top - 200)}, 'slow');
			$('.readonly').raty({
				readOnly : true,
				score: function() {
					return $(this).attr('data-score');
				}
			});
		},
		resetForm:false
	}; 
	$("form#"+form_id).ajaxSubmit(options);		
}

$(document).on('click', '#pagination a', function(e) {
	e.preventDefault();			
	var target = $(this).attr('href');
	if(target != ''){
		 $(".data_div,#pagination a").css({'cursor' : 'wait'});
		/* $(".data_div").html('<div class="text-center"><img src="<?php echo WEBSITE_IMG_URL.'ajax-loading.gif'; ?>" /></div>'); */
		$.get(target, function(r){
			$(".data_div,#pagination a").css({'cursor' : 'default'});
			$(".data_div").html(r.data);
				$('.readonly').raty({
					readOnly : true,
					score: function() {
						return $(this).attr('data-score');
					}
				});
		}, 'json');
	}
});
	
<?php $this->Html->scriptEnd(); ?>
