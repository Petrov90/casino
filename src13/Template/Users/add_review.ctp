<div ng-app="add" ng-controller="addCtrl">
	<div ng-show="!icon" class="mid_wrapper">
	   <div class="Chooosetype addReviewInfo banner_textblock">
		  <div class="container">
			 <div class="title">
				<h2>Chooose a review</h2>
				<p>Please select a option a review.</p>
			 </div>
			 <div class="ChooosetypeRow">
				<div ng-click="foo($event,'country','Country')" class="col">
				   <div class="block"><i><img alt="icon" src="<?php echo WEBSITE_IMG_URL; ?>Nic7.png"></i><i class="fa"><img alt="icon" src="<?php echo WEBSITE_IMG_URL; ?>Nic8.png"></i></div>
				   <h2>Country</h2>
				   <div class="block"><span><samp></samp></span></div>
				</div>
				<div ng-click="foo($event,'city','City')" class="col">
				   <div class="block"><i><img alt="icon" src="<?php echo WEBSITE_IMG_URL; ?>Nic1.png"></i><i class="fa"><img alt="icon" src="<?php echo WEBSITE_IMG_URL; ?>Nic2.png"></i></div>
				   <h2>City</h2>
				   <div class="block"><span><samp></samp></span></div>
				</div>
				<div ng-click="foo($event,'casino','Casino')" class="col">
				   <div class="block"><i><img alt="icon" src="<?php echo WEBSITE_IMG_URL; ?>Nic3.png"></i><i class="fa"><img alt="icon" src="<?php echo WEBSITE_IMG_URL; ?>Nic4.png"></i></div>
				   <h2>Casino</h2>
				   <div class="block"><span><samp></samp></span></div>
				</div>
				<div ng-click="foo($event,'onlinecasino','Online Casino')" class="col">
				   <div class="block"><i><img alt="icon" src="<?php echo WEBSITE_IMG_URL; ?>Nic5.png"></i><i class="fa"><img alt="icon" src="<?php echo WEBSITE_IMG_URL; ?>Nic6.png"></i></div>
				   <h2>Online Casino</h2>
				   <div class="block"><span><samp></samp></span></div>
				</div>
			 </div>
			 <div class="block keepgobtn">
				<a class="" href=""><img alt="icon" src="<?php echo WEBSITE_IMG_URL; ?>Nic9.png">Keep going: get 5 points per rating and 100 for completin the review!</a>
			 </div>
		  </div>
	   </div>
	</div>
	<div ng-show="icon" class="mid_wrapper">
	   <div class="container">
		  <div class="AddReview" ng-class="iconclass">
			 <div class="reSearch">
				<span>Search A {{name}}</span>
				<div class="rightSearch" >
				   <div class="search">
					  <input type="text" ngValue="!icon ? '' : ''" placeholder="(e.g. Estados Unidos, Canda)" value="" class="autocomplete ui-autocomplete-input" id="city_name" name="city_name" autocomplete="off">					  
					  <input type="hidden" id="hname" value="{{hname}}">
				   </div>
				   <p>Select a {{name}} that you would like to make a review. <a href="javascript:void(0);" ng-click="back()">Back to review category</a></p>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<?php 
echo $this->element('add_review_popup');
$this->Html->scriptStart(array('block' => 'custom_script')); ?>	
	$(".autocomplete").autocomplete({
		source: function( request, response ) {
			  // New request 300ms after key stroke
			var $this = $(this);
			var $element = $(this.element);
			var previous_request = $element.data( "jqXHR" );
			if( previous_request ) {
				previous_request.abort();
			}
			// Store new AJAX request
			$element.data( "jqXHR", $.ajax({
			  url: "<?php echo $this->Url->build(array('plugin' => '','controller' => 'Users','action' => 'city_autocomplete')); ?>",
			  dataType: "json",
			  data: {
				q: request.term+'__'+$("#hname").val()
			  },
			  success: function( data ) {
				response( data );
				$(".autocomplete").removeClass('ui-autocomplete-loading');
			  }
			})
			);
		 },
		  minLength: 1,
		   select: function( event, ui ) {

			name 		=	ui.item.label;
			cc_fips		=	ui.item.value;
			
			setTimeout(function(){
				$(".autocomplete").val(ui.item.name);
			},2);
			 
			 $("#city_id").val(cc_fips);
		 },
		  open: function() {
			$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
		  },
		  close: function() {
			$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
		  }
	
	}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
			type 		= 	item.type;
			slug		=	item.slug;
			id			=	item.id;
		if(type == 'city'){
			name	=	item.name +', '+item.country;
			return $( "<li class='cityIc'>" )
			.data( "ui-autocomplete-item", item )
			.append("<a class='city-click' data-id='"+id+"' data-type='city' data-name='"+name+"' data-slug="+slug+" href='javascript:void(0);'><i class=''></i><em></em>" +name+"</a>")
			.appendTo( ul );
		}else if(type == 'country'){
			 name	=	item.name;
			 return $( "<li class='cuntryIc'>" )
			.data( "ui-autocomplete-item", item )
			.append("<a class='city-click' data-id='"+id+"' data-type='country' data-name='"+name+"' data-slug="+slug+" href='javascript:void(0);'><i class=''></i><em></em>" +name+"</a>")
			.appendTo( ul );
		}else{
			name	=	item.name;
			 return $( "<li class='casinoIc'>" )
			.data( "ui-autocomplete-item", item )
			.append("<a class='city-click' data-id='"+id+"' data-type='casino' data-name='"+name+"' data-slug="+slug+" href='javascript:void(0);'><i class=''></i><em></em>" +name+"</a>")
			.appendTo( ul );
		}
	};
	
	var app = angular.module('add', []);
	
	app.controller('addCtrl', function($scope) {
		$scope.foo = function($event, team, team2) {
			$scope.icon		=	true;
			$scope.name		=	team2;
			$scope.hname	=	team;
			$scope.iconclass=	team+'icon';
		   var el = (function(){
			   if ($event.target.nodeName === 'IMG') {
				  return angular.element($event.target).parent(); // get li
			   } else {
				  return angular.element($event.target);          // is li
			   }
		   });
		};
		$scope.back = function() {
			$scope.icon		=	false;
			$("#city_name").val('');
		}
	});
	
<?php $this->Html->scriptEnd(); ?>