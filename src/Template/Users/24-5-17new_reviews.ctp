<?php use Cake\Core\Configure;$htmlurl	=	'';
			$url	=	NO_CASINO_IMG;
			$name	=	'';
			$cityName	=	''; ?>
<div class="mid_wrapper">
<div class="banner_inner banner_back_top  img_block12"> 
  <div class="NewReviewsBan back_img_5 ">

      <div class="container">
         <div class="Reviewsbanner">
            <h1>New Reviews</h1>
            <h3>See the experiences more recent of some of the members of Casinolineup</h3>
			<?php if(empty($this->request->session()->read('Auth.User'))){ ?>
            <div class="block"><a data-rel="signup_div" data-title="Create Account" class="btn red_btn login-pop" href="javascript:void(0)">Signup</a></div><?php } ?>
         </div>
      </div>
   </div>
   </div>
   <div class="newreviewInfo">
      <div class="container">
         <div class="title">
            <h2>Experiences Of Other Users</h2>
            <span></span> 
         </div>
         <div class="experience-user">
			<?php 
			$count	=	0;
			foreach($reviewList as $review){ 
				$noImage	=	$Image	=	false;
				$count++; 
				$userImage	=	'';				
				if($review->type == 'city'){
					// pr($review->city);
					if(!empty($review->city['casino_images'][0]->file) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$review->city['casino_images'][0]->file)){	
						$Image	=	CASINO_FULL_IMG_URL.$review->city['casino_images'][0]->file;						
					}else{
						$noImage	=	NO_CITY_IMG;				
					}
					$name		=	$cityName	=	isset($review->city->name) ? $review->city->name : '';
					$ccountryName	=	isset($review->city->country->name) ? $review->city->country->name : '';
					$slug		=	$review->city->slug;
					$countrySlug		=	$review->city->country->slug;
					$htmlurl	=	$this->Url->build(['plugin' => '','controller' => 'users','action' => 'city_view','country'=>$countrySlug,'city'=>$slug]);
				}else if($review->type == 'casino'){ //pr($review->casino['casino_images']);
					if(!empty($review->casino['casino_images'][0]->file) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$review->casino['casino_images'][0]->file)){						
						$Image		=	CASINO_FULL_IMG_URL.$review->casino['casino_images'][0]->file;
					}else{
						$noImage	=	NO_CASINO_IMG;
					}
					$name			=	isset($review->casino->title) ? $review->casino->title : '';
					$cityName		=	isset($review->casino->city->name) ? $review->casino->city->name : '';
					$ccountryName	=	isset($review->casino->city->country->name) ? $review->casino->city->country->name : '';
					 $slug			=	isset($review->casino->slug) ? $review->casino->slug : '';
				   if(isset($review->casino->type) && $review->casino->type == 'online'){
						$htmlurl	=	$this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view'=>$slug]);
				   }else{
					   // pr(CASINO_FULL_IMG_URL.$review->casino['casino_images'][0]->file);
						$htmlurl	=	$this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'casino_view','casino_view'=>$slug]);					   
				   }
				   
				}else if($review->type == 'country'){
					if(!empty($review->country['casino_images'][0]->file) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$review->country['casino_images'][0]->file)){
						$Image		=	CASINO_FULL_IMG_URL.$review->country['casino_images'][0]->file;
					}else{
						$noImage	=	NO_CASINO_IMG;
					}
					$name		=	$cityName	=	$ccountryName	=	isset($review->country->name) ? $review->country->name : '';
					$slug		=	$review->country->slug;
					$htmlurl	=	$this->Url->build(['plugin' => '','controller' => 'users','action' => 'country_view','country_view'=>$slug]);
				}
				
				if($noImage){
					if($count == 1 || $count == 4){
						$url	=	WEBSITE_URL.'image.php?width=363px&height=303px&cropratio=2:1&image='.$noImage;
					}else{
						$url	=	WEBSITE_URL.'image.php?width=756px&height=303px&cropratio=4:1&image='.$noImage;
					}	
				}
				if($Image){
					if($count == 1 || $count == 4){
						$url	=	WEBSITE_URL.'image.php?width=363px&height=303px&cropratio=2:1&image='.$Image;
					}else{
						$url	=	WEBSITE_URL.'image.php?width=756px&height=303px&cropratio=4:1&image='.$Image;
					}	
				}	
				
				
				if(!empty($review->user->profile_image) && file_exists(PROFILE_ROOT_PATH.$review->user->profile_image)){
					$userImage	= WEBSITE_URL.'image.php?width=66px&height=66px&cropratio=1:1&image='.PROFILE_IMG_URL.$review->user->profile_image;
				}elseif(!empty($review->user->facebook_id)){
					$userImage	= 'http://graph.facebook.com/'.$review->user->facebook_id.'/picture?type=large';
				}else{
					$sex = $review->user->sex;
					$userImage	=	WEBSITE_URL.'image.php?width=66px&height=66px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$sex.'.png';
				}
				$cityName	=	!empty($cityName) ? $cityName.', ' : '';
				
				$reviewUserSlug	=	$this->Url->build(array('controller' => 'users','action' => 'user_slug' ,'user_slug' => $review->user->slug));
				$html	=	'<div class="whole-block">
						 <div class="user-area">
							<img src="#####akshay#####" class="img-responsive">
							<a href="'.$htmlurl.'">'.$name.'</a>
						 </div>
						 <div class="col-md-3">
							<div class="">
							       <a href="'.$this->Url->build(array('plugin' => '','controller' => 'users','action' => 'user_slug' ,'user_slug' => $review->user->slug)).'">
							 <img src="'.$userImage.'" class="img-responsive man ####class####"> </a></div>
						 </div>
						 <div class="col-md-9">
							<div class="man-matter">
							   <p><a href="'.$reviewUserSlug.'" class="style">'.$review->user->full_name.'</a>
							   </p>
							   <p>'.$review->created->format(Configure::read('Date.'.$Defaultlanguage)).'</p>
							   <p class="review"><samp>Rating</samp><span  class="readonly" data-score="'.$review->rating.'"></span></p>
							</div>
						 </div>
						 <div class="paregraph">
							<p class="readmoretext">&#8220;'.nl2br($review->comment).'&#8221;</p>
						 </div>
					  </div>';
				if($count == 1){ ?>
				<div class="row">
					<div class="col-md-4">
					  <?php echo str_replace(array('#####akshay#####','####class####'),array($url,'img4'),$html); ?>
					</div>
				<?php } if($count == 2){ ?>
					<div class="col-md-8">
						<?php echo str_replace(array('#####akshay#####','####class####'),array($url,'img8'),$html); ?>
					</div>
				</div>
				<?php
				}				
				if($count == 3){ ?>				
				<div class="row">				  
					<div class="col-md-8">
					 <?php echo str_replace(array('#####akshay#####','####class####'),array($url,'img8'),$html); ?>
				   </div>
				<?php } if($count == 4){ ?>
					<div class="col-md-4">
						<?php echo str_replace(array('#####akshay#####','####class####'),array($url,'img4'),$html); ?>
					</div>
				</div>
				<?php
				$count	=	0;
				}
			} ?>
         </div>
      </div>
   </div>
</div>
 <?php  $this->Html->scriptStart(array('block' => 'custom_script')); ?>
	showChar	=	100;
	$('.readonly').raty({
		readOnly : true,
		score: function() {
			return $(this).attr('data-score');
		}
	});
	$(window).load(function() {
	    ph = 0, 
	$(".whole-block").each(function() {
        h = $(this).height(), h > ph && (ph = h)
    }), $(".whole-block").css("min-height", ph);
	
	});
<?php $this->Html->scriptEnd(); ?>