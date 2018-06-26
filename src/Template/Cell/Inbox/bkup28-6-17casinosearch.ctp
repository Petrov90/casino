<div class="clint_info_post ">
   <div class="clint_post">
	  <div class="clint_item"><a href="<?php 
		if($casino->type == 'online'){
			$url 	=	 $this->Url->build(['controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]);
			$noImage = NO_CASINO_IMG;
		}else if($casino->type == 'normal'){
			$url 	=	 $this->Url->build(['controller' => 'casinos','action' => 'casino_view','casino_view' => $casino->slug]) ;
			$noImage = NO_CASINO_IMG;
		}else if($casino->type == 2){
			$slug	=	explode("!2!",$casino->slug);
			$citySlug		=	$slug[0];
			$countrySlug	=	$slug[1];
			$url 	=	 $this->Url->build(['controller' => 'users','action' => 'city_view','country' => $countrySlug,'city' => $citySlug]);
			$noImage = NO_CITY_IMG;
		}else{
			$url 	=	 $this->Url->build(['controller' => 'users','action' => 'country_view','country_view' => $casino->slug]);
			$noImage = NO_COUNTRY_IMG;
		} echo $url;  ?>">
		<?php 
		if(file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image)){
			$img_pth = CASINO_FULL_IMG_URL.$casino->image;
		}else {
			$img_pth = WEBSITE_UPLOADS_URL.'amenities/'.$casino->image;
		}
		if(!empty($casino->image) && ( file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image) || file_exists(AMENITIES_ROOT_PATH.$casino->image) ) ){
			echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=239px&height=120px&cropratio=2:1&image='.$img_pth,['alt' => 'Image']);
		}else{ 
			echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=239px&height=120px&cropratio=2:1&image='.$noImage,['alt' => 'Image']);			
		} ?></a>
	  </div>
	  <div class="clint_post_right">
		 <a href="<?php echo $url; ?>"><?php echo (!empty($casino->name)) ? $casino->name : $casino->title; ?></a>
			<div class="clientRating readonly" data-score="<?php echo $casino->avg_rating; ?>"></div>
		<?php 
		if($casino->type == 'online' && isset($result->main_promotion->text)){
			$text	=	json_decode($result->main_promotion->text); 
			if(isset($text[0])){ ?>
			
				<h5><img src="<?php echo WEBSITE_IMG_URL; ?>check.png" alt="img" /><?php echo $text[0]; ?> </h5>
			<?php }
		}	?>
		<?php if($casino->type == '2' || $casino->type == '1'){ ?>
		<h3></h3>
		<?php } ?>
		<?php if($casino->type == 'normal'){ ?>
			<h3><?php echo $result->city->name; ?>, <?php echo $result->city->country->name; ?></h3>
		<?php } ?>
	  </div>
	  <div class="sbumit_block3">
		 <div class="more_info_btn">
		 <?php if($casino->type == 'online'){ ?>
				<a <?php echo NEWTAB ?> data-title="<?php echo $casino->name ?>" data-url="<?php echo $url; ?>" rel="nofollow" href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => (isset($result->main_promotion->slug)) ? $result->main_promotion->slug : '')); ?>" class="paly_now">Play now</a>
		 <?php } ?>
			<a class="more_btn" href="<?php echo $url;  ?>">More info</a>
		 </div>
	  </div>
   </div>
</div>