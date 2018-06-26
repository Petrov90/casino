<?php
if(!empty($userDetails->profile_image) && file_exists(PROFILE_ROOT_PATH.$userDetails->profile_image)){
	$url	=	WEBSITE_URL.'image.php?width=150px&height=150px&cropratio=1:1&image='.PROFILE_IMG_URL.$userDetails->profile_image;					
}else if($userDetails->facebook_id){
	$url	=	 'http://graph.facebook.com/'.$userDetails->facebook_id.'/picture?type=large'; 
}else{  
	$sex	=	$userDetails->sex;
	$url	=	WEBSITE_URL.'image.php?width=150px&height=150px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$sex.'.png';
}  ?>
<div class="bannerCounter" <?php if(!empty($userDetails->cover_image) && file_exists(PROFILE_ROOT_PATH.$userDetails->cover_image)){
?>style="background-image:url(<?php echo WEBSITE_URL.'image.php?height=470px&cropratio=3:1&image='.PROFILE_IMG_URL.$userDetails->cover_image; ?>)"<?php
} ?>>
	<div class="profileCounter">
		<div class="container">
		 <?php if($userDetails->id == $this->request->session()->read('Auth.User.id')){ ?>
			<?php echo $this->Form->create('User',['url' => '/globalusers/upload_image_cover','id' => 'upload_img_form_cover']) ?>
			<div class="add_photo_in">
				<div class="block">
					<a href="javascript:void(0);" class="btn addBtn upcover"><i class="fa fa-camera"></i>
						<?php echo $this->Form->file('image',['class' => 'hide','id' => 'upcover']) ?>Add a Photo</a>
				</div>
			</div>
		 <?php echo $this->Form->end(); 
		 } ?>
			<div class="profileBox">
			<div class="pull-left">
			   <a class="pro_img_change" href="javascript:void(0);"><img src="<?php echo $url; ?>" alt="img"  id="image_src" class="img-responsive" /></a>
			   <?php if($userDetails->id == $this->request->session()->read('Auth.User.id')){ ?>

			   <div class="pro_file_img">
				  <div class="fileUpload">
					 <a href="" class="pro_im">
					 <i class="fa fa-camera"></i>               
					 </a>
					 <span>Upload</span>
						<?php echo $this->Form->create('User',['url' => '/globalusers/upload_image','id' => 'upload_img_form']) ?>
							  <?php echo $this->Form->file('image',['class' => 'upload','id' => 'upload_img_form_dile']) ?>
						<?php echo $this->Form->end(); ?>
				  </div>
			   </div><?php } ?>
			</div>
			<?php 
			if($userDetails->id != $this->request->session()->read('Auth.User.id')){ ?>
				<div class="profileFlow"> 
				<?php if( (in_array('who_can_follow_me_all_users',$preference) && !empty($this->request->session()->read('Auth.User.id')))  || in_array('who_can_follow_me_anyone',$preference) || (in_array('who_can_follow_me_i_follow_him',$preference) && (!empty($userDetails->he_follow_m_e)))){ ?>
					<div class="block">
						<a data-isPopup="yes" href="javascript:void(0);" data-id="<?php echo $userDetails->id; ?>" data-rel="<?php echo (!empty($userDetails->user_follower)) ? 'no' : 'yes'; ?>" class="btn red_btn follow"><i class="fa fa-plus <?php echo (!empty($userDetails->user_follower)) ? 'hide' : ''; ?>" id="f_icon"></i> <span id="f_text"><?php echo (!empty($userDetails->user_follower)) ? 'Following' : 'Follow'; ?></span></a>	
					</div>
				<?php 
				}
				if(in_array('who_can_contact_me_anyone',$preference) || (in_array('who_can_contact_me_all_users',$preference) && !empty($this->request->session()->read('Auth.User.id'))) || (in_array('who_can_contact_me_followers',$preference) && (!empty($userDetails->user_follower))) || (in_array('who_can_see_things_on_my_profile_i_follow_him',$preference) && (!empty($userDetails->he_follow_m_e)))){ ?>
					<div class="block">
						<a href="javascript:void(0);" class="btn red_btn message"><i class="fa"><img src="<?php echo WEBSITE_IMG_URL ?>ic6.png" alt="icon" /></i> Message</a>					
					</div>
				<?php } ?>
            </div>
			<?php } ?>
         </div>
      </div>
      <div class="profileTag">
         <div class="container">
            <div class="profileName">
               <span><?php echo $userDetails->full_name; ?></span>
               <p>Member since <?php echo Date('M Y',strtotime($userDetails->created)); ?></p>
            </div>
            <div class="col">
               <a href="javascript:void(0);"><i><img src="<?php echo WEBSITE_IMG_URL ?>ic7.png" alt="icon" /></i><?php echo $userDetails->city; ?></a>
            </div>
            <div class="col">
               <a href="javascript:void(0);"><i><img src="<?php echo WEBSITE_IMG_URL ?>ic8.png" alt="icon" /></i> Points <?php echo $userDetails->user_points; ?></a>
            </div>
            <div class="col">
               <a href="javascript:void(0);"><i><img src="<?php echo WEBSITE_IMG_URL ?>ic9.png" alt="icon" /></i> Contribution (<span id="ContributionCount">0</span>)</a>
            </div>
            <div class="col">
               <a class="followerList" href="javascript:void(0);"><i><img src="<?php echo WEBSITE_IMG_URL ?>ic10.png" alt="icon" /></i> Followers <span id="like_counter">(<?php echo $userDetails->follower_count; ?>)</span></a>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="mid_wrapper">
<?php if( in_array('who_can_see_things_on_my_profile_anyone',$preference) || (in_array('who_can_see_things_on_my_profile_followers',$preference) && (!empty($userDetails->user_follower))) || (in_array('who_can_see_things_on_my_profile_all_users',$preference) && (!empty($this->request->session()->read('Auth.User.id')))) ||($userDetails->id == $this->request->session()->read('Auth.User.id')) ){ ?>

   <div class="CasinoVisited">
      <div class="container">
         <h2 class="litelTitle">Casino I Visited</h2>
		 <?php if(!$casinoIvisites->isEmpty()){  ?>
         <div class="mapLoction">
            <div class="mapListcol">
               <div class="listarrow"><a href="javascript:void(0);" id="downClick" class="fa fa-chevron-up"></a></div>
               <ul id="scrl">
                  <?php 
				 if(!$casinoIvisites->isEmpty()){ 
					foreach($casinoIvisites as $key => $casino){ if($key == 0){
						$title = $casino->casino->title;
						$address = $casino->casino->address;
					} ?>
					  <li>
						 <div class="pull-left">
						 <a href="javascript:void(0);" onclick="initialize('<?php echo isset($casino->casino->title) ? str_replace("'","",$casino->casino->title) : ''; ?>','<?php echo isset($casino->casino->address) ? str_replace("'","",$casino->casino->address) : ''; ?>')">
						 <?php if(!empty($casino->casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->casino->image)){ ?>
								<?php echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=70px&height=70px&cropratio=1:1&image='.CASINO_FULL_IMG_URL.$casino->casino->image,['class' => 'img-responsive']); ?>
							<?php 
							}else{ ?>				
								<img src="<?php echo WEBSITE_URL.'image.php?width=70px&height=70px&cropratio=1:1&image='.NO_CASINO_IMG; ?>" class="img-responsive" />
							<?php } ?> 
						</a>
						</div>
						 <div class="locatnDet">
							 <a href="javascript:void(0);" onclick="initialize('<?php echo isset($casino->casino->title) ? str_replace("'","",$casino->casino->title) : ''; ?>','<?php echo isset($casino->casino->address) ? str_replace("'","",$casino->casino->address) : ''; ?>')"><?php echo isset($casino->casino->title) ? $casino->casino->title : ''; ?></a>
							<div class="rating">
								<div class="jrating" data-score="<?php echo isset($casino->casino->avg_rating) ? $casino->casino->avg_rating : 0; ?>"></div>
								<span><?php echo isset($casino->casino->review_count) ? $casino->casino->review_count : '0'; ?> review</span>
							</div>
						 </div>
					  </li>
				 <?php } 
				 }else{ ?>
					<li>
						 <div class="text-center">No Casino has been added</div>
					 </li>
				 <?php } ?>
               </ul>
               <div class="listarrow bot"><a href="javascript:void(0);" id="upClick" class="fa fa-chevron-down"></a></div>
            </div>
            <div class="mapFreme"><div id="map_canvas"></div></div>
         </div> <?php }else{
			 ?><div class="text-center">No Record Found</div><?php 
		 }   ?>
      </div>
   </div>
  
   <div class="loveonline">
      <div class="container">
         <h2 class="litelTitle">I love to play online at</h2>
		  <?php 
   if(!$casinoILikes->isEmpty()){  ?>
         <div class="loveonlineRow">
            <ul>
				<?php 
				$i 	=	0;
				foreach($casinoILikes as $result){
				$i++;
				if($i == 1){ ?>
					<li>
				<?php } ?>
					  <div class="col">
						 <div class="pull-left">
							<a href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $result->casino->slug]); ?>">
							<?php if(!empty($result->casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$result->casino->image)){ ?>
								<?php echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=70px&height=70px&cropratio=1:1&image='.CASINO_FULL_IMG_URL.$result->casino->image,['class' => 'img-responsive']); ?>
							<?php 
							}else{ ?>				
								<img src="<?php echo WEBSITE_URL.'image.php?width=70px&height=70px&cropratio=1:1&image='.NO_CASINO_IMG; ?>" class="img-responsive" />
							<?php } ?></a>
						</div>
						 <a href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $result->casino->slug]); ?>"><?php echo $result->casino->title; ?></a>
						 <div class="pull-right">
							<a class="btn red_btn" data-title="<?php echo $result->casino->title ?>" data-url="<?php echo $result->casino->slug ?>"  <?php echo NEWTAB ?> rel="nofollow" class="btn red_btn btn1" href="<?php  echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $result->casino->main_promotion->slug)); ?>">Play</a>
						 </div>
					  </div>
				  <?php if($i == 3){ $i = 0; ?>
					</li>
				  <?php }
				} ?>
            </ul>
         </div>
		 <?php }else{
			 ?><div class="text-center">No Record Found</div><?php 
		 }   ?>
      </div>
   </div>
 <div class="contribution"><div  id="cntributions" class="container"></div></div>
<?php }else{ ?>
	<div class="CasinoVisited">
		<div class="container">
			<h2 class="litelTitle text-center">User profile marked as private</h2>
		</div>
	</div>
<?php } ?>
</div>
<?php if(!empty($this->request->session()->read('Auth.User'))){ ?>
<div class="modal fade" id="message-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content loginForm">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h2 class="modal-title"><span>Send Message To <?php echo $userDetails->full_name; ?></span></h2>
         </div>
          <div class="modal-body login-modal">
           <?php echo $this->Form->create('User',['url' => '/messages/add','id' => 'message-form','class' => 'css-form']); ?>
			<div id="message-form_error_div"></div>
               <div class="fildlogin">
                  <div class="form-group">
                    <label>Message<span class="red-star">*</span></label>
					<?php echo $this->Form->textarea('message',['class' => 'form-control login-field']); ?>
					<?php echo $this->Form->hidden('receiver_id',['value' => $userDetails->id]); ?>
                  </div>
               </div>
               <div class="loginfooter">
					<input type="submit" value="Submit" class="btn red_btn send_message" data-rel="message-form"/>
               </div>
           <?php echo $this->Form->end(); ?>
         </div>		  
      </div>
   </div>
</div>
<div class="modal fade" id="followerList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog popup_Info">
		<div class="modal-content photoPoup">
			<div class="popupIn">
				<div class="modal-header modal_Poup_info2">
				 <span>Follower List...</span>
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                 <div class="popup_follow">
					
				 </div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } 
 if(!$casinoIvisites->isEmpty()){

echo $this->Html->script(['https://maps.googleapis.com/maps/api/js?v=3&libraries=geometry,places&key&language=en&key=AIzaSyCPU4hzQzGaRkgV-3K9yN_aSwL_KsDBh1A'],array('block' =>'custom_script'));
 }
	$this->Html->scriptStart(array('block' => 'custom_script')); ?>
	showChar = 130, 
	
	
	btnclick	=	true;
	height		=	0;
	$('#scrl li').each(function(index){
        height +=	$(this).height();
    });
	scrolled1	=	 height;
	scrolled	=	0;
	console.log(scrolled1);
    $("#upClick").on("click" ,function(){
		console.log(scrolled);
		if(scrolled1 > scrolled)
		scrolled=scrolled+150;
		$("#scrl").animate({
			scrollTop:  scrolled
	   });
	});

    
    $("#downClick").on("click" ,function(){
		if(scrolled > 0)
		scrolled=scrolled-150;
			console.log(scrolled);
		$("#scrl").animate({
			scrollTop:  scrolled
	   });
	});
	$(document).on('click', '.follow', function(e) {
	<?php if(!empty($this->request->session()->read('Auth.User'))){ ?>
		btn 	=	$(this);
		rel		=	$(this).attr('data-rel');
		id		=	$(this).attr('data-id');
		isPopup		=	$(this).attr('data-isPopup');
		if(btnclick){
			btnclick = false;
			if(rel == 'yes'){ console.log('yes');
				btn.attr('data-rel','no');
				btn.find('span').text('Following');
				btn.find("#f_icon").addClass('hide');
			}else{  console.log('no');
				btn.attr('data-rel','yes');
				btn.find("#f_icon").removeClass('hide');
				btn.find('span').text('Follow');
			}
			// like_counter	=	$(this).find()
			$.ajax({
				url  	 : '<?php echo $this->Url->build('/users/follow'); ?>',
				data 	 : {id : id,'rel' : rel},
				dataType : 'json',
				type	 : 'POST',
				success  : function(r){
					if(isPopup == 'yes'){
						$("#like_counter").html(' ('+r.count+') ');
					}
					btnclick = true;
					
				}
			});
		}
	<?php }else{ ?>
		$(".login-pop").trigger('click');
	<?php } ?>
	});	
	
	$(".followerList").click(function(e){
	<?php if(!empty($this->request->session()->read('Auth.User'))){ ?>
		$("#followerList").modal('show');
		$.ajax({
			url  	 : '<?php echo $this->Url->build('/users/listfollow/'.$userDetails->id); ?>',
			dataType : 'json',
			type	 : 'GET',
			success  : function(r){
				$(".popup_follow").html(r.data);
			}
		});
		
	<?php }else{ ?>
		$(".login-pop").trigger('click');
	<?php } ?>
	});
	<?php if(!empty($this->request->session()->read('Auth.User'))){ ?>
		$(".send_message").click(function(e){	
			e.preventDefault();
			form_id = $(this).attr('data-rel');
			$("#ajax-loader").removeClass('hide');

			var options = {
				type: 'post',
				success:function(r){
					$("#ajax-loader").addClass('hide');
					data		=	JSON.parse(r) ;
					if(data.success){
						notice('Success',data.message,'success');
						$("#"+form_id+" textarea").val('');
						$("#message-modal").modal('hide');
					}else{
						data = data.errors;
						var error_div_id	=	form_id+'_error_div';
						$('#login-modal').animate({ scrollTop: 0 }, 'slow');
						
						var error_div		=	$("#"+error_div_id);
						
						var error	=	'<ul class="client-side-error">';
						$.each(data,function(index,html){
							error	+=	'<li>'+html+'</li>';
						});
						error	+=	'</ul>';
						error_msg	=	'<div class="alert alert-danger alert-dismissible site-color" style="padding-left: 0;" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'+error+'</div>';
						error_div.html(error_msg);
						error_div.show();
						notice('Error',data.message,'error');
					}
					return false;
				},
				resetForm:false
			}; 
			$("form#"+form_id).ajaxSubmit(options);			
		});
	<?php } ?>
	$(".message").click(function(e){
	<?php if(!empty($this->request->session()->read('Auth.User'))){ ?>
		btn 	=	$(this);
		$("#message-modal").modal('show');
		
	<?php }else{ ?>
		$(".login-pop").trigger('click');
	<?php } ?>
	});
	
	$('.jrating').raty({
		readOnly : true,
		scoreName : 'rating',
		score: function() {
			return $(this).attr('data-score');
		}
	});
	
	<?php  if(!$casinoIvisites->isEmpty()){ ?>
	var bounds = new google.maps.LatLngBounds();
	
	var geocoder;
	var map;
	var bounds = new google.maps.LatLngBounds();

	function initialize(title,address) {
		locations = [];		
		locations.push([title,address,'#']);
		map = new google.maps.Map(
		document.getElementById("map_canvas"), {
		  center: new google.maps.LatLng(37.4419, -122.1419),
		  zoom: 2,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		});
	  geocoder = new google.maps.Geocoder();

	  for (i = 0; i < locations.length; i++) {
		geocodeAddress(locations, i);
	  }
	}
	
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
		var html = "<div><h4><a href="+url+">" + title + "</a></h4><p>" + address + "<br></div></p></div>";
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
	}
	
		initialize('<?php echo str_replace("'","",$title); ?>','<?php echo str_replace("'","",$address); ?>');
	<?php } ?>
	function cntributions(){
		$.post('<?php echo $this->Url->build('/globalusers/cntributions/'.$userDetails->id) ?>', function(r){
			$("#cntributions").html(r.data);
			$("#ContributionCount").html(r.tot_count);
			$("#cntributions").show();
			
			ph = 0, 
			$(".whole-block").each(function() {
				h = $(this).height(), h > ph && (ph = h)
			}), $(".whole-block").css("min-height", ph+5)
		}, 'json');
		
	}
	
	cntributions();
	$('#upload_img_form_dile').change(function (event) {
		$("#image_src").attr('src','<?php echo  WEBSITE_IMG_URL ?>ajax-loading.gif');
		
		form_id = 'upload_img_form';
		
		$("#upload_img_form_error_div").hide();
		
		var options = {
			type	: 'post',				
			success:function(r){
				data		=	JSON.parse(r) ;
				if(data.success){
					$("#image_src").attr('src',data.src);
				}else{
					
					data = data.errors;
					notice('Error',data.image);
				}
			},
			resetForm:false
		}; 
		$("form#"+form_id).ajaxSubmit(options);	
	});
	
	$('#upcover').change(function (event) {
		form_id = 'upload_img_form_cover';		
		$("#upload_img_form_error_div").hide();
		$(".bannerCounter").css('background-image', "url('<?php echo WEBSITE_IMG_URL ?>ajax-loading.gif')");
		var options = {
			type	: 'post',				
			success:function(r){
				data		=	JSON.parse(r) ;
				if(data.success){
					$(".bannerCounter").css('background-image', 'url(' + data.src + ')');
				}else{					
					data = data.errors;
					notice('Error',data.image);
				}
			},
			resetForm:false
		}; 
		$("form#"+form_id).ajaxSubmit(options);	
	});
	$(".upcover").click(function(){
		document.getElementById('upcover').click();
	});
<?php $this->Html->scriptEnd(); ?>