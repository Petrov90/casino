<div class="clint_info_post ">
   <div class="clint_post client_post1">
	  <div class="clint_item clint_item_new"><a href="<?php
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
			//$img_pth = '';
			
		} echo $url;  ?>">
		<?php 
		
		if(file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image)){
			$img_pth = CASINO_FULL_IMG_URL.$casino->image;
		}elseif(file_exists(AMENITIES_ROOT_PATH.$casino->image)) {
		$img_pth = WEBSITE_UPLOADS_URL.'amenities/'.$casino->image;
		}
		if(!empty($casino->image) && ( file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image) || file_exists(AMENITIES_ROOT_PATH.$casino->image) ) ){
			echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=239px&height=120px&cropratio=2:1&image='.$img_pth,['alt' => 'Image']);
		}else{ 
			echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=239px&height=120px&cropratio=2:1&image='.$noImage,['alt' => 'Image']);			
		} ?></a>
	  </div>
		<div class="clint_post_right">
			<div class="block casino_block"><a href="<?php echo $url; ?>"><span><?php echo (!empty($casino->name)) ? $casino->name : $casino->title; ?></span></a></div>
			<div class="clientRating readonly" data-score="<?php echo $casino->avg_rating; ?>"></div>
			<span class="op_txt1"> <?php echo $casino->review_count;?> reviews</span>
		<?php 
		/* if($casino->type == 'online' && isset($result->main_promotion->text)){
			$text	=	json_decode($result->main_promotion->text); 
			if(isset($text[0])){ ?>
			
				<h5><img src="<?php echo WEBSITE_IMG_URL; ?>check.png" alt="img" /><?php echo $text[0]; ?> </h5>
			<?php }
		} */	?>
		<?php 
			if($casino->type == '2'){ ?><h3><?php	echo $casino->country_name; ?></h3><?php }	?>
		<?php if($casino->type == 'online'){ ?>
			<div class="new_content">
				<div class="col_list new-col-list list_new">
					<div class="check_list">
						<span class="checkBx"><?php /*<img src="<?php echo WEBSITE_IMG_URL ?>check.png" alt="Image"/> <?php */ echo $result->main_promotion->small_text; ?></span>
					 	<p><?php echo $result->main_promotion->small_text2; ?></p>
					</div>
				</div>
				<div class="col_list new-col-list list_new">
					<div class="check_list"><span class="checkBx"><?php echo $result->payout_percentage; ?> %</span><p>Win Rate</p></div>
				</div>
				<div class="col_list new-col-list list_new1">
					<div class="check_list"><span class="checkBx"><?php
						$pay_day = round(($result->p_min + $result->p_max) / (84600*2));
						if($pay_day > 1) {
							$p_day = 'Days';
						}	
						else{	
							$p_day = 'Day';
						}
					  echo $pay_day.' '.$p_day; ?></span><p>Payout Time</p></div>
				</div>
			</div>
		<?php } ?>
		<?php if($casino->type == 'normal'){ ?>
		<div class="casino_b2"><span></span></div>
			<div class="new_content">
				<div class="col_list" style="width:100%;padding-bottom:0">
					<div class="check_list flax-div"><p><?php echo $result->city->name; ?>, <?php echo $result->city->country->name; ?></p></div>
				</div>
			</div>
		<?php } ?>
	  </div>
	  <div class="sbumit_block3 po-ab">
		 <div class="more_info_btn">
		 <?php if($casino->type == 'online'){ ?>
				<a <?php echo NEWTAB ?> data-title="<?php echo $casino->name ?>" data-url="<?php echo $url; ?>" rel="nofollow" href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => (isset($result->main_promotion->slug)) ? $result->main_promotion->slug : '')); ?>" class="paly_now">Play now</a>
		 <?php } ?>
			<a class="more_btn" href="<?php echo $url;  ?>">More info</a>
		 </div>
	  </div>
   </div>
</div>