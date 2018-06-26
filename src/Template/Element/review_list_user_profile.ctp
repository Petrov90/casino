<?php use Cake\Core\Configure; ?>
<div class="row">
   <?php foreach($reviewsList as $review){   ?>
   <div class="col-md-4">
      <div class="whole-block">
         <div class="user-area">
            <?php 
			$htmlurl	=	'';
			$url	=	NO_CASINO_IMG;
			$name	=	'';
			$cityName	=	'';
               if($review->type == 'city'){
				   if(!empty($review->city->image) && file_exists(CASINO_THUMB_IMG_ROOT_PATH.$review->city->image)){
						$url	=	CASINO_FULL_IMG_URL.$review->city->image;
				   }else{
						$url	=	NO_CITY_IMG;			
				   }					
					$name		=	$cityName	=	isset($review->city->name) ? $review->city->name : '';
					$ccountryName	=	isset($review->city->country->name) ? $review->city->country->name : '';
					$slug		=	$review->city->slug;
					$countrySlug		=	$review->city->country->slug;
					$htmlurl	=	$this->Url->build(['plugin' => '','controller' => 'users','action' => 'city_view','country'=>$countrySlug,'city'=>$slug]);
               }else if($review->type == 'casino'){ 
				   if(!empty($review->casino->image) && file_exists(CASINO_THUMB_IMG_ROOT_PATH.$review->casino->image)){
						$url	=	CASINO_FULL_IMG_URL.$review->casino->image;
				   }else{
						$url	=	NO_COUNTRY_IMG;
					}
               
				   $name			=	isset($review->casino->title) ? $review->casino->title : '';
				   $cityName		=	isset($review->casino->city->name) ? $review->casino->city->name : '';
				   $ccountryName	=	isset($review->casino->city->country->name) ? $review->casino->city->country->name : '';
				   $slug			=	isset($review->casino->slug) ? $review->casino->slug : '';
				   if(isset($review->casino->type) && $review->casino->type == 'online'){
						$htmlurl	=	$this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view'=>$slug]);
				   }else{
						$htmlurl	=	$this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'casino_view','casino_view'=>$slug]);					   
				   }
				   
				}else if($review->type == 'country'){
				   if(!empty($review->country->image) && file_exists(AMENITIES_ROOT_PATH.$review->country->image)){
						$url	=	AMENITIES_IMG_URL.$review->country->image;
				   }else{
						$url	=	NO_CASINO_IMG;
				   }
					$name		=	$cityName	=	$ccountryName	=	isset($review->country->name) ? $review->country->name : '';
					$slug		=	$review->country->slug;
					$htmlurl	=	$this->Url->build(['plugin' => '','controller' => 'users','action' => 'country_view','country_view'=>$slug]);
					
               } ?>				
            <img  alt="Image loading" src="<?php echo WEBSITE_URL.'image.php?width=372px&height=170px&cropratio=3:1&image='.$url; ?>" class="img-responsive " />			
            <a href="<?php echo $htmlurl; ?>"><?php echo $name; ?></a>			
         </div>
         <div class="col-md-3">
            <div class="">
               <?php 
                  if(!empty($review->user->profile_image) && file_exists(PROFILE_ROOT_PATH.$review->user->profile_image)){ ?>
               <img src="<?php echo  WEBSITE_URL.'image.php?width=66px&height=66px&cropratio=1:1&image='.PROFILE_IMG_URL.$review->user->profile_image; ?>" class="img-responsive man" alt="img" />
               <?php }elseif(!empty($review->user->facebook_id)){ ?>
               <img alt="img" class="img-responsive man" src="<?php echo 'http://graph.facebook.com/'.$review->user->facebook_id.'/picture?type=large' ?>" alt="img" />
               <?php }else{ ?>
               <img src="<?php echo WEBSITE_URL.'image.php?width=66px&height=66px&cropratio=1:1&image='.NO_PROFILE_IMAGE; ?>" alt="img" class="img-responsive man"/>
               <?php } ?> 
            </div>
         </div>
         <div class="col-md-9">
            <div class="man-matter">
               <p><a href="<?php echo $this->Url->build(array('controller' => 'users','action' => 'user_slug' ,'user_slug' => $review->user->slug)); ?>"><span class="style"><?php echo $review->user->full_name; ?></span></a> <?= __('homepage.was_in') ?><a href="<?php echo $htmlurl; ?>"> <span class="style"><?php echo $name; ?></span></a></p>
               <p>
					<img src="<?php echo WEBSITE_IMG_URL; ?>location.png" alt="img" /><?= __('homepage.visited') ?>: <?php echo $cityName; ?>, <?php echo $review->created->format(Configure::read('Date.'.$Defaultlanguage)); ?></p>
               <p class="review"><samp><?= __('homepage.review') ?></samp><span  class="readonly" data-score="<?php echo $review->rating; ?>"></span></p>
            </div>
         </div>
         <div class="paregraph">
            <p class="readmoretext"><?php echo nl2br($review->comment); ?></p>
         </div>
      </div>
   </div>
   <?php } ?>   
</div>

