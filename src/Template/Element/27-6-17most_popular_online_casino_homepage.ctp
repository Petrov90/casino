<div class="Most_Popular_post">
   <div class="most_info most-info-info">
	  <div class="Popular_list">
		 <ul>
		 <?php foreach($promotions as $key => $promotion){  ?>
			<li>
			   <div class="col_list"><span><?php echo $key+1; ?></span></div>
			   <div class="col_list">
				  <div class="Popular_Rating"><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $promotion->casino->slug)); ?>"><?php 
	if(!empty($promotion->logo) && (PROMOTION_CASINO_LOGO_ROOT_PATH.$promotion->logo)){
		echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=132px&height=71px&cropratio=2:1&image='.PROMOTION_CASINO_LOGO_IMG_URL.$promotion->logo,['alt' => 'Image']);
	}else{
		if(!empty($promotion->casino->image) && (CASINO_FULL_IMG_ROOT_PATH.$promotion->casino->image)){
			echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=132px&height=71px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$promotion->casino->image,['alt' => 'Image']);
		}
	} ?></a></div>
				  <div class="Popular_li">
					 <a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $promotion->casino->slug)); ?>"><?php echo $promotion->casino->title; ?></a>
					 <p class="readonly" data-score="<?php echo $promotion->casino->avg_rating; ?>"></p>
				  </div>
			   </div>
			   <div class="col_list new-col-list">
				  <div class="check_list">
					 <span class="checkBx"><?php /*<img src="<?php echo WEBSITE_IMG_URL ?>check.png" alt="Image"/> <?php */ echo $promotion->small_text; ?></span>
					 <p><?php echo $promotion->small_text2; ?></p>
				  </div>
			   </div>
			   <div class="col_list new-col-list">
				  <div class="check_list">
					 <span class="checkBx"><?php echo $promotion->casino->payout_percentage; ?> %</span>
					 <p>Win Rate</p>
				  </div>
			   </div>
			   <div class="col_list new-col-list">
				  <div class="check_list">
					 <span class="checkBx"><?php
						$pay_day = round(($promotion->casino->p_min + $promotion->casino->p_max) / (84600*2));
						if($pay_day > 1) {
							$p_day = 'Days';
						}	
						else{	
							$p_day = 'Day';
						}
					  echo $pay_day.' '.$p_day; ?></span>
					 <p><?php echo 'Average Payout Time' ?></p>
				  </div>
			   </div>			   
			   <div class="col_list">
				  <div class="most_play_now">
					 <a class="btn most_play" <?php echo NEWTAB ?> data-title="<?php echo $promotion->casino->title ?>" data-url="<?php echo $promotion->casino->slug ?>" rel="nofollow" href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $promotion->slug)); ?>">Play now!</a>
					 <a  href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $promotion->casino->slug]) ?>" class="read_Review">Read review</a>
				  </div>
			   </div>
			</li>
			<?php } ?>
		 </ul>
         
	  </div>
	  <div class="view_all_casino"> <a  href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'onlineCasino']) ?>">View All Casinos</a> </div>
   </div>
</div>
         