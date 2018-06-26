<?php use Cake\Core\Configure; ?>
<div class="row">
   <?php foreach($photoList as $review){ ?>
   <div class="col-md-4 <?php if($review->type == 'casino'){
		echo 'photos_'.$review['casino']['type'];
	}else{
		echo 'photos_'.$review->type;
	} ?>">
      <div class="whole-block1">
         <div class="user-area">
            <?php 
			$htmlurl	=	'';
			$url	=	NO_CASINO_IMG;
			$name	=	'';
			$cityName	=	'';// pr($review);
               if($review->type == 'city'){				 
				   
					$name		=	$cityName	=	isset($review['city']['name']) ? $review['city']['name'] : '';
					$ccountryName	=	isset($review->city->country->name) ? $review->city->country->name : '';
					$slug		=	$review['city']['slug'];
					$countrySlug		=	isset($review['cityparent']['slug']) ? $review['cityparent']['slug'] : '';
					
					$htmlurl	=	$this->Url->build(['plugin' => '','controller' => 'users','action' => 'city_view','country'=>$countrySlug,'city'=>$slug]);
               }else if($review->type == 'casino'){ 
				  
               
				   $name			=	isset($review['casino']['title']) ? $review['casino']['title'] : '';
				   $slug			=	isset($review['casino']['slug']) ? $review['casino']['slug'] : '';
				   if(isset($review['casino']['type']) && $review['casino']['type'] == 'online'){ 
						$htmlurl	=	$this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view'=>$slug]);
				   }else{
						$htmlurl	=	$this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'casino_view','casino_view'=>$slug]);					   
				   }
				   
				   
				   
				}else if($review->type == 'country'){
				   
					$name		=	$cityName	=	$ccountryName	=	isset($review['country']['name']) ? $review['country']['name'] : '';
					$slug		=	$review['country']['slug'];
					$htmlurl	=	$this->Url->build(['plugin' => '','controller' => 'users','action' => 'country_view','country_view'=>$slug]);
					
					
					
               }
			if(!empty($review->file) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$review->file)){
				$url	=	CASINO_FULL_IMG_URL.$review->file;
		   }else{
				$url	=	NO_CASINO_IMG;
		   }
				   ?>				
            <img  alt="Image loading" src="<?php echo WEBSITE_URL.'image.php?width=400px&height=215px&cropratio=2:1&image='.$url; ?>" class="img-responsive " />			
            <a href="<?php echo $htmlurl; ?>"><?php echo $name; ?></a>			
         </div><?php /*
         <div class="col-md-3">
            <div class="">
               <?php 
                  if(!empty($review['user']['profile_image']) && file_exists(PROFILE_ROOT_PATH.$review['user']['profile_image'])){ ?>
               <img src="<?php echo  WEBSITE_URL.'image.php?width=66px&height=66px&cropratio=1:1&image='.PROFILE_IMG_URL.$review['user']['profile_image']; ?>" class="img-responsive man" alt="img" />
               <?php }elseif(!empty($review['user']['facebook_id'])){ ?>
               <img alt="img" class="img-responsive man" src="<?php echo 'http://graph.facebook.com/'.$review['user']['facebook_id'].'/picture?type=large' ?>" alt="img" />
               <?php }else{ 
				$sex = $review['user']['sex'];	?>
               <img src="<?php echo WEBSITE_URL.'image.php?width=66px&height=66px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$sex.'.png'; ?>" alt="img" class="img-responsive man"/>
               <?php } ?> 
            </div>
         </div>
         <div class="col-md-9">
            <div class="man-matter">
               <p><a href="<?php echo $this->Url->build(array('controller' => 'users','action' => 'user_slug' ,'user_slug' => $review['user']['slug'])); ?>"><span class="style"><?php echo $review['user']['full_name']; ?></span></a></p>
              
            </div>
         </div>
         <div class="paregraph">
            <p class="readmoretext"><?php echo nl2br($review->title); ?></p>
         </div>*/ ?>
      </div>
   </div>
   <?php } ?>   
</div>

