<div class="block">
	<?php 
	$i = 0;
	foreach($result as $casino){ 
		$i = 1; //pr($casino); ?>
	 <div class="promotion_block promotion_info">
		<div class="row">
		   <div class="col-md-4 col-sm-4">
			  <div class="block-1 bestPmnt active_img">
				 <h3>100% Deposit bonus</h3>
				 <div class="fream_img"><img src="<?php echo WEBSITE_IMG_URL; ?>img_07.png" alt="img" class="img-responsive" /></div>
				 <div class="imageFreame images_fream">
					<?php 
					if((CASINO_THUMB_IMG_ROOT_PATH.$casino->image)){
						echo $this->Html->image(WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.CASINO_FULL_IMG_URL.$casino->image,['class' => 'img-responsive']);
					} ?>
				</div>
				 <ul>
					<li><a href="#">Over 500slots</a></li>
					<li><a href="#">Zero blackjack video pocker &amp; bacarrat</a></li>
					<li><a href="#">High payout rates</a></li>
				 </ul>
				 <div class="play-now"><a href="#" class="btn red_btn btn1">play now!</a> </div>
			  </div>
		   </div>
		   <div class="col-md-8 col-sm-8">
			  <div class="promotionDetail flag_img_in">
				 <h2><?php echo $casino->title; ?></h2>
				 <div class="flag_img"><img src="<?php echo WEBSITE_IMG_URL; ?>img_09.png" alt="img" class="img-responsive" /></div>
				 <div class="review_info promRating">
					<div class="pull-left"><img src="<?php echo WEBSITE_IMG_URL; ?>red-star.png" alt="Rating" /></div>
					<span class="h2"><?php echo $casino->review_count; ?> review</span>
					<span class="rank">Ranked#1:</span>
					<?php /* <a href="#">London Casino</a>*/ ?>
				 </div>
				 <div><?php echo $casino->sdescription; ?><p><a href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'casino_view','casino_view' => $casino->slug]); ?>">More...</a></p></div>
				 <div class="gambling">
					<h4>Gambling Option in this Casino</h4>
					<div class="gamble_option">
						<?php foreach($casino->casino_gambling_options as $casino_gambling_options){ ?>
							<?php if(file_exists((AMENITIES_ROOT_PATH.$casino_gambling_options->master->image))){ ?>
							   <div class="round not_round">
									<div class="img_round not_round_img">
										<img src="<?php echo WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.AMENITIES_IMG_URL.$casino_gambling_options->master->image ?>" class="img-responsive" alt="img" /> 
									</div>
							   </div>
						   <?php } ?>
						<?php } ?>
					</div>
				 </div>
			  </div>
		   </div>
		</div>
	 </div>
	<?php } ?>
  </div>
  <?php $paginator    =    $this->Paginator; ?>
<div class="Pagination_nav list_m">
	<?php if($this->request['Casinos']['pageCount'] > 1){ ?>
	<ul class="" id="pagination">	
	<?php
		echo $paginator->prev(__('<i class="fa fa-caret-left"></i>', true),
			array(
				'id'=> 'p_prev',
				'tag'=> 'li',
				'escape'=>false
			),
			null,
			array(
				'class'=>'pagination',
				'escape'=>false,
			   'tag'=> 'li',
				'disabledTag'=>'a'
			)
		);
		echo $paginator->numbers(array(
		   'tag'=> 'li',
			'span'=>false,
			'currentClass' => 'pagination',
			'currentTag' => 'a',
			'separator' => false,
			'class' => "pagination"
			
		));    
		echo $paginator->next(__('<i class="fa fa-caret-right"></i>', true),
			array(
				'id'=> 'p_next',
				'tag'=> 'li',
				'escape'=>false
			),
			null,
			array(
				'class'=>'pagination',
				'escape'=>false,
			   'tag'=> 'li',
				'disabledTag'=>'a'
			)
		);
	?>
	</ul>
	<?php } ?>
</div>