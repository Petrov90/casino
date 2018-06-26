<?php use Cake\I18n\Time; ?>

	  <!-- <div class="news_post">

		 <h3>Casinos nearby</h3>

		 <div class="newsBidget">
		 <?php //echo $pageTitle; die("kpkp"); ?>
		 <?php foreach($mostPopularNews as $news){ ?>

			<div class="item_D1">

			   <div class="item_img"><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'news','action' => 'news_view','news_view' => $news->slug)); ?>"><?php 

			 if(!empty($news->image) && file_exists(CASINO_THUMB_IMG_ROOT_PATH.$news->image)){

				echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=110px&height=59px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$news->image,['alt' => 'Image','height'=>59, 'width'=>110]);

			 } ?></a></div>

			   <div class="item_text">

				  <p><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'news','action' => 'news_view','news_view' => $news->slug)); ?>"><?php echo $news->title ?></a></p>
				  <?php if($news->question_count == 0){
				  	
				  }else{ ?>
				  	<span><?php echo $news->question_count; ?> comments</span> 
				  <?php
				  } ?>
				  
			   </div>

			</div>

		 <?php } ?>

		 </div>

	  </div> -->

	  <!-- <div class="news_post">		

		 <h3>Recommed Casinos</h3>

		 <div class="newsBidget">

		 <?php foreach($recommedCasinos as $casino){ ?>

			<div class="item_D1">

			   <div class="item_img"><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]) ?>"><?php 

				if(!empty($casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image)){

					echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=110px&height=59px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$casino->image,['alt' => $casino->title.' review','height' => 59,'width' => 110]);

				} ?></a></div>

			   <div class="item_text">

				  <a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]) ?>"><?php echo $casino->title ?></a>

				  <small class="readonly" data-score="<?php echo $casino->avg_rating; ?>"></small><a data-title="<?php echo $casino->title ?>" data-url="<?php echo $casino->slug ?>" <?php echo NEWTAB ?> rel="nofollow" href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $casino->main_promotion->slug)); ?>" class="btn playBtn">Play now</a>

			   </div>

			</div>

		 <?php } ?>

		 </div>

		 <div class="view_all_casino"><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'onlineCasino']); ?>">View All Casinos</a></div>

	  </div> -->
	  
	  <div class="news_post newsBonuses">		

		 <h3>Latest Bonuses</h3>

		 <div class="newsBidget">			

		 <?php foreach($latestBonuses as $bonus){  ?>

			<div class="item_D1">

			   <span><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $bonus->casino->slug]) ?>"><?php echo $bonus->title; ?></a></span>

			   <div class="item_img "><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $bonus->casino->slug]) ?>"><?php 

				if(!empty($bonus->logo) && file_exists(PROMOTION_CASINO_LOGO_ROOT_PATH.$bonus->logo)){

					echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=110px&height=59px&cropratio=2:1&image='.PROMOTION_CASINO_LOGO_IMG_URL.$bonus->logo,['alt' => 'Image','height' => 59,'width' => 110]);

				}else{

					if(!empty($bonus->casino->image) && (CASINO_FULL_IMG_ROOT_PATH.$bonus->casino->image)){

						echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=110px&height=59px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$bonus->casino->image,['alt' => 'Image','height' => 59,'width' => 110]);

					}

				} ?></a></div>

			   <div class="item_text">

				  <p><span>Published: <?php  $now = new Time($bonus->created);

						/*echo $now->timeAgoInWords(

							['format' => 'MMM d, YYY', 'end' => '+1 year']

						);*/

						$utb_tm = $now->timeAgoInWords(

							['format' => 'MMM d, YYY', 'end' => '+1 year']);

							$utb_tm = current(explode(',', $utb_tm));

							$ago_tm = substr($utb_tm, -3);

							if($ago_tm != 'ago'){

								$utb_tm = $utb_tm.' ago';

							}

							echo $utb_tm;

						 ?> </span></p>

				  <small class="readonly"  data-score="<?php echo $bonus->casino->avg_rating; ?>"></small><a data-title="<?php echo $bonus->casino->title ?>" data-url="<?php echo $bonus->casino->slug ?>" <?php echo NEWTAB ?> rel="nofollow" href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $bonus->slug)); ?>" class="btn playBtn">Claim now</a> 

			   </div>

			</div>

		 <?php } ?>

		 </div>

		 <div class="view_all_casino"><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'promotions','action' => 'promotion']); ?>">View All Bonuses</a></div>

	  </div>

  	