<?php use Cake\Core\Configure; // pr($_SERVER['HTTP_USER_AGENT']); ?>
<?php
if(!empty($loginData->profile_image) && file_exists(PROFILE_ROOT_PATH.$loginData->profile_image)){
	$url	=	PROFILE_IMG_URL.$loginData->profile_image;					
}else if(!empty($loginData->facebook_id)){
	$url	=	 'http://graph.facebook.com/'.$loginData->facebook_id.'/picture?type=large'; 
}else{
	$sex = $loginData->sex;
	$url	=	WEBSITE_URL.'image.php?width=150px&height=150px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$sex.'.png';
}  ?>
<div class="mid_wrapper" ng-app="Dashboard">
   <div class="deshboardInfo  banner_textblock ">
		<div class="deshProfile" ng-controller="profileDropdown">
			<div class="container">
				<h2>Dashboard</h2>
				<div class="profledes">				
					<img ng-show="!showImageChange" src="<?php echo $url; ?>" alt="img"  id="main_image" class="img-responsive" />
					<img ng-show="showImageChange" ng-src="{{myCroppedImage}}" alt="img" class="img-responsive" />
				</div>
				<div class="profiledat">
					<h3><?php echo $loginData->full_name; ?></h3>
					<div class="block">
						<a href="javascript:void(0);" ng-click="dropListtogle();"><span><img src="<?php echo WEBSITE_IMG_URL; ?>arrow1.png" alt="arrow" /></span><?php echo Date('M Y',strtotime($this->request->session()->read('Auth.User.created'))); ?></a>
						<a><?php echo $loginData->city; ?></a>
						<ul class="dropList dropList1">
							<li><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'globalusers','action' => 'index']) ?>"><img src="<?php echo WEBSITE_URL; ?>images/Dashboard-icon1.png" alt="icon" />Dashboard</a></li>
							<li><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'users','action' => 'user_slug','user_slug' => $loginData->slug]) ?>"><img src="<?php echo WEBSITE_IMG_URL; ?>Nic15.png" alt="icon" />My profile</a></li>
							<li><a href="javascript:void(0);" ng-click="changeProfileImage()"><img src="<?php echo WEBSITE_IMG_URL; ?>Nic16.png" alt="icon" />Change profile image</a></li>
							<li><a href="javascript:void(0);" ng-click="gotoSetting('basic')"><img src="<?php echo WEBSITE_IMG_URL; ?>Nic17.png" alt="icon" />Edit info</a></li>
							<li><a href="javascript:void(0);" ng-click="gotoElement('message')"><img src="<?php echo WEBSITE_IMG_URL; ?>Nic18.png" alt="icon" />Messages</a></li>
							<li><a href="javascript:void(0);" ng-click="gotoSetting('noti')"><img src="<?php echo WEBSITE_IMG_URL; ?>Nic19.png" alt="icon" />Settings</a></li>
					   </ul>
					</div>
				</div>
			</div>		  
			<div class="container hide showImage" ng-show="showImage">
				<?php if($browser !='Safari'){ ?>
				<div class="col-md-3">
					<div class="g-div">
						<p>Select an image file: </p>
						<input type="file" id="fileInput" />
						<p id="imageError" style="color:#B72F3E;display:none;">Please upload valid image. Valid image extension are gif,jpeg,png,jpg</p>
					</div>
				</div>
				<div ng-show="myCroppedImage1" class="col-md-5">
					<img-crop image="myImage" result-image="myCroppedImage"></img-crop>
				</div>
				<div class="col-md-4">
					<div class="g-div">
						<div class="block">
							<input ng-show="loading" type="button" class="btn red_btn" value="Upload Image" ng-click="submit()">
							<input ng-show="loadingShow" type="button" class="btn red_btn" value="Loading">
						</div>
					</div>
				</div>
				<?php }else{ ?>
				<div class="col-md-3">
					<div class="g-div">
						<p>Select an image file: </p>
					<form id="safariform" action="<?php echo $this->Url->build('/globalusers/updateprofilepic'); ?>">
						<input name="data" type="file" id="fileInput1" />
					</form>
						<p id="imageError1" style="color:#B72F3E;display:none;">Please upload valid image. Valid image extension are gif,jpeg,png,jpg</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="g-div">
						<div class="block">
							<input ng-show="loading" type="button" class="btn red_btn" value="Upload Image" ng-click="submit()">
							<input ng-show="loadingShow" type="button" class="btn red_btn" value="Loading">
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
      <div class="deshInfo">
         <div class="container">
            <div class="deshInfomation">
               <h2 class="deshtitle">Infomation</h2>
               <p class="deshBtn"><a data-href="info112" class="info112" href="javascript:void(0);">Learn how to score</a></p>
              <?php echo $this->element('level'); ?>
            </div>
            <div class="deshInfomation" id="message">
				<h2 class="deshtitle">Messages</h2>
				<div class="MessagesBox">
					<div class="messLeft">
						<?php $type= 'inbox';$count=0; /* <div class="block"><select><option>Inbox (0)</option></select></div> */ ?>
						<div class="block">
							<input id="inbox_count" type="button" data-type="inbox" class="inbox <?php echo ($type == 'inbox') ? 'mactive' : '' ?>" value="Inbox <?php echo ($count > 0) ? '( '.$count.' )' : ''; ?>">
						</div>
						<div class="block">
							<input type="button" data-type="sent" class="sent <?php echo ($type == 'sent') ? 'mactive' : '' ?>" value="Sent">
						</div>
						<div class="block">
							<input type="button" data-type="compose" class="compose" value="Compose">
						</div>
					</div>					
					<div class="messRight inboxBox">
						<div class="editBar">
						  <div class="SearchMail">
							 <select class="message_drop">
								<option value="dd">Select a option</option>
								<option value="unread">Mark as unread</option>
								<option value="delete">Delete marked messages</option>
							 </select>
						  </div>
					   </div>
						<div  id="message_list" style="display:none"></div>
					</div>
				</div>
			</div>
            <div class="deshInfomation Casinoswop hide" id="casinoIloveDiv" ng-controller="BeenHere"></div>
            <div class="Contributions Casinoswop" id="cntributions"></div>
            <div class="Contributions Casinoswop" id="edit_settings" ng-controller="DashboardTabCntrl">
               <h2 class="deshtitle">Settings</h2>
				<div class="userSettingsTabs hmtab">
					<ul>
						 <li class="active"><a class="us-tabs" data-tab="basic" onclick=openSetting(event,'basic','deshSettings','us-tabs')>Basic Info </a></li>
						 <li><a class="us-tabs" data-tab="noti" onclick=openSetting(event,'noti','deshSettings','us-tabs')>Email Notifictions </a></li>
						 <li><a class="us-tabs" data-tab="pref" onclick=openSetting(event,'pref','deshSettings','us-tabs')>Preferences </a></li> 
						<!--<li ng-class="$root.iconclass=='basic' ? 'active' : ''"><a href="javascript:void(0);" ng-click="noti($event,'basic')">Basic Info</a></li>
						<li ng-class="$root.iconclass=='noti' ? 'active' : ''"><a href="javascript:void(0);" ng-click="noti($event,'noti')">Email Notifictions</a></li>
						<li ng-class="$root.iconclass=='pref' ? 'active' : ''"><a href="javascript:void(0);" ng-click="noti($event,'pref')">Preferences</a></li> -->
					</ul>
				</div>
                <div ng-class="$root.iconclass=='basic' ? '' : 'hide'" class="deshSettings" id='basic'>
                  <h2>Update Your Account</h2>
                  <?php echo $this->Form->create($loginData,['id' => 'updateprofile']); ?>
					<div id="updateprofile_error_div"></div>
                     <div class="row">
                        <div class="fild">
                           <label>Full Name:</label>
                           <?php echo $this->Form->text('full_name',['id' => 'full_name','ng-model' => "formData.full_name"]); ?>
                        </div>
                        <div class="fild">
                           <label>Email Address:</label>
                           <?php echo $this->Form->text('email',['id' => 'email','ng-model' => "formData.email"]); ?>
                        </div><?php /* 
                        <div class="fild">
                           <label>Password: <small>(6 character minimum)</small></label>
                           <?php echo $this->Form->password('password1',['ng-model' => "formData.password1"]); ?>
                        </div>*/ ?>
                        <div class="fild">
                           <label>Current City:</label>
                           <?php echo $this->Form->text('city',['id' => 'city','ng-model' => "formData.city"]); ?>
                        </div>
                        <div class="fild">
                           <label>Country:</label>
						   <?php echo $this->Form->select('country_id',$countryList,['id' => 'country_id','empty' => 'Select country','class' => 'select-dashboard ','ng-model' => "formData.country_id"]); ?>
                        </div>
						
                        <div class="fild">
							<label>Sex:</label>
							<div class="label_name">
								<?php echo $this->Form->radio(
								    'sex',
								    [
								        ['value' => 'male', 'text' => 'Male','ng-model' => "formData.sex"],
								        ['value' => 'female', 'text' => 'Female','ng-model' => "formData.sex"]
								    ]
								); ?>
							</div>	
                        </div>
						<?php /*
						<div class="fild">
                           <div class="formCheck">
                              <div class="checbox"><label> <?php echo $this->Form->checkbox('accept',['ng-model' => "formData.accept"]); ?><span></span></label></div>
                              <p>I accept the <a href="">Terms and Conditions</a> above and the <a href="">Privacy policy.</a></p>
                           </div>
                        </div>*/ ?>
                     </div>
                     <div class="block">
                         <input type="button" data-rel="basicProfile" class="btn red_btn" ng-click="updateProfile()" value="Update" />
                    </div>
                  <?php echo $this->Form->end(); ?>
               </div>
				<div ng-class="$root.iconclass=='basic' ? '' : 'hide'" class="deshSettings" style="display:none" id='noti'>
                  <?php 
					echo $this->Form->create($emailPref,['id' => 'emailPref','url' => '/globalusers/updatepreference' ]);
					echo $this->Form->hidden('type' ,['value' => 'email']);
					?>
					
				   <div id="emailPref_error_div"></div>
				   <h2>Send me an email notification when...</h2>
				   <div class="checkList">
					<?php foreach(Configure::read('email_preference') as $key => $email){ ?>
					  <ul>
						 <h2><?php echo __($key); ?>:</h2>
						 <?php foreach($email as $key1 => $subEmail){ 
							$isChecked	=	(in_array($key1,$emailPrefArray)) ? 'checked="checked"' : ''; ?>
							 <li>
								<div class="checbox">
								   <label>
									<?php echo $this->Form->checkbox($key1,[$isChecked]); ?>
									<span></span> </label> 
								   <p><?php echo __($subEmail); ?></p>
								</div>
							 </li>
						 <?php } ?>
					  </ul>
					<?php } ?>
				   </div>
				   <div class="block">
						<input type="button" data-rel="emailPref" value="Update" class="btn red_btn noti_update">
				   </div>
				   <?php echo $this->Form->end(); ?>
				</div>
				<div ng-class="$root.iconclass=='basic' ? '' : 'hide'" class="deshSettings Preferences" style="display:none" id='pref'>
					<?php 
					echo $this->Form->create($emailPref,['id' => 'accountPref','url' => '/globalusers/updatepreference' ]);
					echo $this->Form->hidden('type' ,['value' => 'account']);
					?>
				   <h2>Set preferences in your account...</h2>
				   <div id="accountPref_error_div"></div>
				   <div class="checkList">
					<?php foreach(Configure::read('preference') as $key => $preference){  ?>
					  <ul>
						 <h2><?php echo __($key); ?>?</h2>
						 <?php foreach($preference as $key1 => $name){ 
						 $isChecked	=	(in_array($key1,$accountPrefArray)) ? 'checked="checked"' : '';
						 ?>
						 <li>
							<div class="checbox">
							   <label><?php echo $this->Form->checkbox($key1,[$isChecked]); ?><span></span> </label> 
							   <p><?php echo __($name); ?></p>
							</div>
						 </li>
						 <?php } ?>
					  </ul>		
					<?php } ?>
				   </div>
					<div class="block">
						<input type="button" data-rel="accountPref" ng-click="updateProfile()" value="Update" class="btn red_btn noti_update">
					</div>
				   <?php echo $this->Form->end(); ?>
				</div>
			</div>
         </div>
      </div>
   </div>
</div>
<script>
    function openSetting(evt, settingName,tabgroup,tablinkgroup) {
    // Declare all variables
    var i, tabcontent, tablinks;

    $(".userSettingsTabs li").removeClass('active');
    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName(tabgroup);
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName(tablinkgroup);
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(settingName).style.display = "block";
    evt.currentTarget.className += " active";
    evt.srcElement.parentElement.className = 'active';
    
}

    /*function updateUserBasicProfile(){
		console.log("update profile");
			$("#ajax-loader").removeClass('hide');
			$("#updateprofile_error_div").hide('slow');
			var fData = {};		 
    		fData.full_name		=	document.getElementById("full_name");
    		fData.email			=	document.getElementById("email");
    		fData.city			=	document.getElementById("city");
    		fData.country_id		=	document.getElementById("country_id");
    		fData.sex		=	document.getElementById("sex");
    		console.log(fData)
            $.post('<?php echo $this->Url->build('/globalusers/updateprofile'); ?>',
                    formData,
                    function(data,status) {
                        console.log(data);
                        console.log(status);
        // 				$("#ajax-loader").addClass('hide');
        // 				if (!data.success) {
        					
        // 					$("#updateprofile_error_div").show('slow');
        // 					data = data.errors;
        // 					var error_div_id	=	'updateprofile_error_div';
        // 					$('#login-modal').animate({ scrollTop: 0 }, 'slow');
        					
        // 					var error_div		=	$("#"+error_div_id);
        					
        // 					var error	=	'<ul class="client-side-error">';
        // 					$.each(data,function(index,html){
        // 						error	+=	'<li>'+html+'</li>';
        // 					});
        // 					error	+=	'</ul>';
        // 					error_msg	=	'<div class="alert alert-danger alert-dismissible site-color" style="padding-left: 0;" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'+error+'</div>';
        // 					error_div.html(error_msg);
        // 					error_div.show();
        					
        // 				} else {									
        // 					notice('Success',data.message,'success');
        // 				}
        			}
        			);
		}*/
</script>
<?php 
// echo $this->Html->css(['https://cdn.rawgit.com/alexk111/ngImgCrop/master/compile/minified/ng-img-crop.css'],array('block' =>'css'));
echo $this->Html->script(['https://maps.googleapis.com/maps/api/js?v=3&libraries=geometry%2Cplaces&key&language=en&key=AIzaSyCjfXKrWKV1PBcTcbd8cMtT97uM71SBacA','ng-img-crop.js','ng-infinite-scroll.min.js'],array('block' =>'custom_script'));
	$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

	$('.readonly').raty({
		readOnly : true,
		scoreName : 'rating',
		score: function() {
			return $(this).attr('data-score');
		}
	});
	
	var geocoder;
	var map;
	var bounds = new google.maps.LatLngBounds();

	function initialize(title,address) {
		locations = [];		
		locations.push([title,address,'#']);
		map = new google.maps.Map(
		document.getElementById("map_canvas_dashboard"), {
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
	
	$(function(){
		function cntributions(){
			$.post('<?php echo $this->Url->build('/globalusers/cntributions') ?>', function(r){
				$("#cntributions").html(r.data);
				$("#cntributions").show();showChar = 130,ph = 0, 
		ph = 0, 
		$(".whole-block").each(function() {
			h = $(this).height(), h > ph && (ph = h)
		}), $(".whole-block").css("min-height", ph+5)
		
			}, 'json');
		}		
		function getMessage(type){
			$("#message_list").html('<div class="text-center"><img src="<?php echo WEBSITE_IMG_URL.'ajax-loading.gif'; ?>" /></div>');
			$.get('<?php echo $this->Url->build('/messages/getMessage/') ?>'+type, function(r){
				$("#message_list").html(r.data);
				$("#message_list").show();				
				if(type == 'inbox' && r.count > 0){
					$("#inbox_count").val('Inbox ( '+r.count+' )');
				}else if(type == 'inbox'){
					$("#inbox_count").val('Inbox');
				}
				
				setTimeout(function(){
					cntributions();
				},1000);
		    $('.message_drop').prop('selectedIndex',0);
			}, 'json');
		}		
		setTimeout(function(){
			getMessage('inbox');
		},1000);		
	
		$(document).on('click', '#pagination a', function(e) {
			e.preventDefault();			
			var target = $(this).attr('href');
			if(target != ''){
				$("#message_list").html('<div class="text-center"><img src="<?php echo WEBSITE_IMG_URL.'ajax-loading.gif'; ?>" /></div>');
				$.get(target, function(r){
					$("#message_list").html(r.data);
				}, 'json');
			}
		});
		
		$(document).on('click', '.compose', function(e) {
			$(".mactive").removeClass('mactive');
			$(".MessageView").hide('slow');
			$(".noMessage").hide('slow');
			$(".list_m").hide('slow');
			$(".composeBox").show('slow');
			$(this).addClass('mactive');
			$("#rplyBox").addClass('hide');
		});
		
		$(document).on('click', '.sent', function(e) {
			$(".mactive").removeClass('mactive');
			$("#rplyBox").addClass('hide');
		/* 	$(".list_m").show('slow');
			$(".MessageView").hide('slow');
			$(".composeBox").hide('slow'); */
			$(this).addClass('mactive');			
			getMessage('sent');
		});
		
		$(document).on('click', '.inbox', function(e) {
			type	=	$(this).attr('data-type');
			if(type == 'compose'){
				$(".mactive").removeClass('mactive');
				$(".composeBox").hide('slow');
				$(".list_m").show('slow');
				$(this).addClass('mactive');
			}else{
				$(".mactive").removeClass('mactive');
				$(this).addClass('mactive');
				getMessage('inbox');
			}
			$("#rplyBox").addClass('hide');
		});
		$(document).on('click', '.asort a', function(e) {
			e.preventDefault();
			var target = $(this).attr('href');
			if(target != ''){
				$("#message_list").html('<div class="text-center"><img src="<?php echo WEBSITE_IMG_URL.'ajax-loading.gif'; ?>" /></div>');
				$.get(target, function(r){
					$("#message_list").html(r.data);
				}, 'json');
			}
		});
		
		$(document).on('click', '.noti_update', function(e) {
			form_id = $(this).attr('data-rel');
			$("#ajax-loader").removeClass('hide');
			var options = {
				type: 'post',
				success:function(r){
					$("#ajax-loader").addClass('hide');
					data		=	JSON.parse(r);
					if(data.success){
						notice('Success',data.message,'success');
					}else{ 
						message = data.message;
						data = data.errors;
						var error_div_id	=	form_id+'_error_div';						
						var error_div		=	$("#"+error_div_id);
						
						var error	=	'<ul class="client-side-error">';
						$.each(data,function(index,html){
							error	+=	'<li>'+html+'</li>';
						});
						error	+=	'</ul>';
						error_msg	=	'<div class="alert alert-danger alert-dismissible site-color" style="padding-left: 0;" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'+error+'</div>';
						error_div.html(error_msg);
						error_div.show();
						console.log(error_msg);
						notice('Error',message,'error');
					}
					return false;
				},
				resetForm:false
			}; 
			$("form#"+form_id).ajaxSubmit(options);
		});
		
		$(document).on('click', '.message_view', function(e) {
			id		=	$(this).attr('data-id');
			type	=	$(this).attr('data-type');
			sender = $(this).attr('data-sender');
			$.get('<?php echo $this->Url->build('/messages/messageView/') ?>'+id+'/'+type, function(r){
				$(".MessageView").html(r.data);
				$("#receiver_id1").val(sender);
				$("#rplymsg").removeClass("hide");
				$("#rplyBox").removeClass("hide");

				if(r.count > 0){
					$("#inbox_count").val('Inbox ( '+r.count+' )');
					
				}else{
					$("#inbox_count").val('Inbox');
				}
				$(".list_m").hide('slow');

			}, 'json');
		});
	
		$(document).on('click', '.message_sent', function(e) {
			e.preventDefault();
			if($("#receiver_id").val() == ''){
				$(".autocomplete").addClass('border-red');
				return false;
			}
			if($("#message_box").val() == ''){
				$("#message_box").addClass('border-red');
				return false;
			}
			form_id = $(this).attr('data-rel');
			$("#ajax-loader").removeClass('hide');

			var options = {
				type: 'post',
				success:function(r){
					$("#ajax-loader").addClass('hide');
					data		=	JSON.parse(r) ;
					if(data.success){
						notice('Success',data.message,'success');
						$("#message_box").val('');
						$("#receiver_id").val('');
						$(".autocomplete").val('');
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

		$(document).on('click', '.message_reply', function(e) {
			e.preventDefault();
			if($("#receiver_id1").val() == ''){
				$(".autocomplete").addClass('border-red');
				return false;
			}
			if($("#reply_box").val() == ''){
				$("#reply_box").addClass('border-red');
				return false;
			}
			form_id = $(this).attr('data-rel');
			$("#ajax-loader").removeClass('hide');

			var options = {
				type: 'post',
				success:function(r){
					$("#ajax-loader").addClass('hide');
					data		=	JSON.parse(r) ;
					if(data.success){
						notice('Success',data.message,'success');
						$("#reply_box").val('');
						$("#receiver_id1").val('');
						$(".autocomplete").val('');
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
		
		$(document).on('change', '.message_drop', function(e) {
			val 		= 	$(this).val();
			type 		= 	$(".mactive").attr('data-type');
			serialize	=	$('.ids:checked').serialize();
			if(serialize && (val == 'unread' || val == 'delete')){
				$.ajax({
				  url: "<?php echo $this->Url->build('/messages/delete'); ?>/"+val,
				  type: "post",
				  data: $('.ids:checked').serialize(),
				  success: function(data) {
					getMessage(type);
				   }
			  });
			}
		});	 
	});
	
	var app = angular.module('Dashboard', ['ngImgCrop','infinite-scroll']);	
	app.service('anchorSmoothScroll', function(){
		this.scrollTo = function(eID) {

			var startY = currentYPosition();
			var stopY = elmYPosition(eID);
			var distance = stopY > startY ? stopY - startY : startY - stopY;
			if (distance < 100) {
				scrollTo(0, stopY); return;
			}
			var speed = Math.round(distance / 100);
			if (speed >= 20) speed = 20;
			// speed	=	5;
			var step = Math.round(distance / 25);
			var leapY = stopY > startY ? startY + step : startY - step;
			var timer = 0;
			if (stopY > startY) {
				for ( var i=startY; i<stopY; i+=step ) {
					setTimeout("window.scrollTo(0, "+leapY+")", timer * speed);
					leapY += step; if (leapY > stopY) leapY = stopY; timer++;
				} return;
			}
			for ( var i=startY; i>stopY; i-=step ) {
				setTimeout("window.scrollTo(0, "+leapY+")", timer * speed);
				leapY -= step; if (leapY < stopY) leapY = stopY; timer++;
			}
			
			function currentYPosition() {
				// Firefox, Chrome, Opera, Safari
				if (self.pageYOffset) return self.pageYOffset;
				// Internet Explorer 6 - standards mode
				if (document.documentElement && document.documentElement.scrollTop)
					return document.documentElement.scrollTop;
				// Internet Explorer 6, 7 and 8
				if (document.body.scrollTop) return document.body.scrollTop;
				return 0;
			}
			
			function elmYPosition(eID) {
				var elm = document.getElementById(eID);
				var y = elm.offsetTop;
				var node = elm;
				while (node.offsetParent && node.offsetParent != document.body) {
					node = node.offsetParent;
					y += node.offsetTop;
				} return y;
			}

		};
		
	});

	app.controller("profileDropdown", function($scope, $location, anchorSmoothScroll,$http){
		$scope.dropListtogle = function(){
			$('.dropList1').toggle('');
		};
		$scope.gotoElement = function (eID){
			$('.dropList1').toggle('');
			anchorSmoothScroll.scrollTo(eID);		  
		}; 
		
		$scope.gotoSetting = function (type){
			$('.dropList1').toggle('');
			$scope.$root.iconclass = type; //or false
			anchorSmoothScroll.scrollTo('edit_settings');		  
		};
	<?php if($browser != 'Safari'){ ?>
		
		$scope.myImage='';
		$scope.myCroppedImage='';
		var handleFileSelect=function(evt) {
		
		  $scope.myCroppedImage1		= true;
		  $scope.showImageChange	= true;
		  var file		=	evt.currentTarget.files[0];
		 
		  var filename = file.name;
			var index = filename.lastIndexOf(".");
			var strsubstring = filename.substring(index, filename.length);
			if (strsubstring == '.gif' || strsubstring == '.jpeg' || strsubstring == '.png' || strsubstring == '.jpg')
			{
				$scope.loading 	=	true;
				$("#imageError").hide();
				 var reader 	= 	new FileReader();
				  reader.onload = 	function (evt) {
					$scope.$apply(function($scope){
					  $scope.myImage=evt.target.result;
					});
				  };
				  reader.readAsDataURL(file);
			}else{
				$("#imageError").show();
			}		  
		};
		angular.element(document.querySelector('#fileInput')).on('change',handleFileSelect);
	
		
		$scope.submit = function (){
			$scope.loading 		=	false;
			$scope.loadingShow 	=	true;
			$http({
				method  : 'POST',
				url     : '<?php echo $this->Url->build('/globalusers/updateprofilepic'); ?>',
				data    :  $.param({ "data": $scope.myCroppedImage }),
				headers: {
					'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'
				}, 
			}).success(function(data) {
				$scope.loadingShow 			=	false;
				$scope.loading 			=	false;
				$scope.myCroppedImage1	=	'';
				if(data.success){
					$("#main_image").attr('src',data.src);
					$scope.showImage		=	false;
					$scope.showImageChange		=	false;
					$("#fileInput").val('');
				}
				notice(data.title,data.message,data.type);
			});
		}; 
		
		<?php }else{ ?>
			
		$scope.loading 	=	true;
				
		$scope.submit = function (){
			$scope.loading 		=	false;
			$scope.loadingShow 	=	true;
			
			var options = {
				type: 'post',
				success: function(r) {
					data = JSON.parse(r);
							
					$scope.loadingShow 		=	false;
					$scope.loading 			=	true;
					$scope.myCroppedImage1	=	'';
					if(data.success){
						$("#main_image").attr('src',data.src);
						$scope.showImage		=	false;
						$scope.showImageChange		=	false;
						$("#fileInput1").val('');
					}
					notice(data.title,data.message,data.type);
				}
			};
			$("form#safariform").ajaxSubmit(options);
		}; 
		
		<?php } ?>
		
		$scope.changeProfileImage = function (){
			
			$scope.showImage		=	true;
			$('.dropList1').toggle('');
		};
	});
	
	console.log("Registering DashboardTabCntrl");
	app.controller("DashboardTabCntrl", function($scope, $http){
	console.log("controller");
		$scope.$root.iconclass=	'basic';
		$scope.noti = function($event, team) {
			$scope.$root.iconclass=	team;
		};
		
		$scope.formData = {};		 
		$scope.formData.full_name		=	'<?php echo $loginData->full_name; ?>';
		$scope.formData.email			=	'<?php echo $loginData->email; ?>';
		$scope.formData.city			=	'<?php echo $loginData->city; ?>';
		$scope.formData.country_id		=	'<?php echo $loginData->country_id; ?>';
		$scope.formData.sex		=	'<?php echo $loginData->sex; ?>';
		$scope.updateProfile = function(){
		console.log("update profile");
			$("#ajax-loader").removeClass('hide');
			$("#updateprofile_error_div").hide('slow');

			$http({
				method  : 'POST',
				url     : '<?php echo $this->Url->build('/globalusers/updateprofile'); ?>',
				data    : $.param($scope.formData),  // pass in data as strings
				headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
			}).success(function(data) {
				$("#ajax-loader").addClass('hide');
				if (!data.success) {
					
					$("#updateprofile_error_div").show('slow');
					data = data.errors;
					var error_div_id	=	'updateprofile_error_div';
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
					
				} else {									
					notice('Success',data.message,'success');
				}
			});
		};
	});
	
	app.controller("BeenHere", function($scope,$http,$compile){
		$scope.huu	=	20;
		$scope.loveToplay	=	true;
		$scope.casinos	=	[];
		$scope.casinosLike	=	[];
		$scope.offset	=	20;
		$scope.offset1	=	20;
		$scope.LoadMoreLikesCount	=	20;
		$scope.LoadMoreVisitsCount	=	20;
		$http.get('<?php echo $this->Url->build('/globalusers/casinolove'); ?>').success(function(response){			
			$el = $(response.data);
			$compile($el)($scope);
			$("#casinoIloveDiv").html($el);
			
			allCasinos			=	response.allCasinos;
			
			$scope.LoadMoreVisitsCount	=	response.allCasinosCount;
			console.log(allCasinos);
			for (var i = 0; i < response.allCasinosCount; i++) {
				$scope.casinos.push(allCasinos[i]);
			}
			$scope.casinoIvisites				=	response.casinoIvisites;
			$scope.casinoILikes					=	response.casinoILikes;
			$scope.casinoIvisitesAllCasino		=	response.casinoIvisitesAllCasino;
			$scope.casinoILikesAllCasino		=	response.casinoILikesAllCasino;
			
			
			$scope.casinosLike					=	response.allLikesCasinos;
			$scope.LoadMoreLikesCount			=	response.allLikesCasinosCount;
		
			
			
		});
			 
		
		$scope.casinoIvisites1 = function() {
			$scope.loveToplay	=	true;
		};
		$scope.casinoILikes1 = function() {
			$scope.loveToplay	=	false;
			$scope.showMap	=	false;
			
			
			$('#likeId').animate({ scrollTop: '1px' }, 'slow');
			$('#CasinoLikes').animate({ scrollTop: '1px' }, 'slow');
		};
		$scope.loadMore = function() {
			console.log(1221);
		};
		$scope.beenHere = function(id) {
			$("#li_"+id).hide('slow');
			
			$http.get('<?php echo $this->Url->build('/CasinoVisits/add'); ?>/'+id).success(function(response){
				$el = $(response.data);
				$compile($el)($scope);
				$("#visitedId ul").append($el);
				
				notice('Success','Casino has been added','success');
				$scope.casinoIvisites++;
				$scope.casinoIvisitesAllCasino--;				
				$('.readonly').raty({
					readOnly : true,
					scoreName : 'rating',
					score: function() {
						return $(this).attr('data-score');
					}
				});
				$("#li_"+id).remove();
			});
		};
		
		$scope.LoadMoreVisits = function() {
			$http.get('<?php echo $this->Url->build('/globalusers/loadmorevisits'); ?>/'+$scope.offset).success(function(response){
				$scope.offset	=	$scope.offset+20;
				data			=	response.data;
				$scope.LoadMoreVisitsCount	=	response.count;

				for (var i = 0; i < response.count; i++) {
					$scope.casinos.push(data[i]);
				}
			});
		}
		$scope.LoadMoreLikes = function() {
			$http.get('<?php echo $this->Url->build('/globalusers/loadmorelikess'); ?>/'+$scope.offset1).success(function(response){
				$scope.offset1	=	$scope.offset1+20;
				data			=	response.data;
				$scope.huu	=	false;
				$scope.casinosLike	=	'';
				$scope.casinosLike	=	data;
				$scope.LoadMoreLikesCount	=	0;
				// $(".phpli").remove();
			});
		}
		
		$scope.LikeThis = function(id) {
			$("#likes_"+id).hide('slow');
			
			$http.get('<?php echo $this->Url->build('/CasinoLikes/add'); ?>/'+id).success(function(response){
				
				$el = $(response.data);
				$compile($el)($scope);
				$("#likeId ul").append($el);
				
				notice('Success','Casino has been added','success');				
				$scope.casinoILikes++;
				$scope.casinoILikesAllCasino--;
				$("#likes_"+id).remove();
				

			});
		};
		 $scope.showMapF = function(obj) {
			$scope.showMap	=	true;
			$scope.title	=	title	=	obj.target.attributes.title.value;
			$scope.address	=	address	=	obj.target.attributes.address.value;
			$scope.imgsrc	=	obj.target.attributes.imgsrc.value;
			$scope.score	=	obj.target.attributes.score.value;
			$scope.city		=	obj.target.attributes.city.value;
			setTimeout(function(){
				initialize(title,address);
			},100);
		}; 
		$scope.remove = function(id,type,divid) {
			$("#"+divid).remove();			
			$http.get('<?php echo WEBSITE_URL ?>'+type+'/delete/'+id).success(function(response){				
				$el = $(response.data);
				$compile($el)($scope);
					
				$($el).insertBefore("#"+type+' .preiv');
				$($el).insertBefore("#"+type+' .preivl');
				
				notice(response.title,response.message,response.type);
				if(type == 'CasinoVisits'){
					$scope.casinoIvisites--;
					$scope.casinoIvisitesAllCasino++;
					

				}else{
					$scope.casinoILikes--;					
					$scope.casinoILikesAllCasino++;	
					
				}
			});
		};		
		
		 $scope.CasinoVisitsSearch = function(){
			
			$http.get('<?php echo $this->Url->build('/globalusers/casino_search'); ?>/'+$scope.keywords).success(function(response){
				data			=	response.data;
				$scope.casinos	=	[];
				$scope.casinos	=	data;
				$scope.LoadMoreVisitsCount	=	response.count;
				

			});
		};
		
		$scope.CasinoLikesSearch = function(){
			
			$http.get('<?php echo $this->Url->build('/globalusers/casino_like_search'); ?>/'+$scope.likeskeywords).success(function(response){
				data			=	response.data;				
				$scope.casinosLike	=	[];				
				$scope.casinosLike					=	data;
				$scope.LoadMoreLikesCount			=	response.count;

			});
		};

	});
	
	$(window).load(function(){
		$("#casinoIloveDiv").removeClass('hide');
		$(".showImage").removeClass('hide');
		$('#CasinoVisits').animate({ scrollTop: '1px' }, 'slow');
		$('#visitedId').animate({ scrollTop: '1px' }, 'slow');
	});
	
	$(".sssss").click(function(){
		$("#info11").modal('show');
	});
	
	$(".info112").click(function(){
		$("#info112").modal('show');
	});
<?php $this->Html->scriptEnd(); ?>
<div class="modal fade" id="info112" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog popup_Info">
		<div class="modal-content photoPoup">
			<div class="popupIn">
				<div class="modal-header modal_Poup_info">
				 <span>How to Earn Points?</span>
				 <p>Compete with your friends, community and even the world sharing their
knowledge of the best casinos, online casino and places. </p>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
				<div class="modal_body_info"><?php /*
			    <span>How does in work</span>
                <div class="modal_1">
                <span><img src="../webroot/images/img_pop_1.png" alt="img" /></span>	
                <p>Keep the activity in your account</p>         
                   
                </div>

                 <div class="modal_1">
                <span><img src="../webroot/images/img_pop_2.png" alt="img" /></span>	
                <p>You earn points with your activities</p>         
                   
                </div>

                 <div class="modal_1">
                <span><img src="../webroot/images/img_pop_3.png" alt="img" /></span>	
                <p>You can win gifts top user</p>         
                   
                </div>*/?>
                <ul class="body_list_info">
                <li><p>Adding Review (< 200 characters)</p><span>3 points</span></li>
                 <li><p>Adding Review (> 200 characters)</p><span>6 points</span></li>
                  <li><p>Adding Information</p><span>10 points</span></li>
                 <li><p>Adding Photo</p><span>15 points</span></li>
                 <li><p>Adding A Place Or Casino</p><span>30 points</span></li>
                 <li><p>Share On Social Media</p><span>10 points</span></li>
                  <li><p>First Review Added</p><span>+3 points</span></li>
                   <li><p>First Information Added</p><span>+10 points</span></li>
                   <li><p>First Photo Added</p><span>+15 points</span></li>
                </ul>
                </div>
				
				</div>
			</div>
		</div>
	</div>
</div>