<?php 
use Cake\I18n\Time;
use Cake\Utility\Inflector; 
if(!$promotions->isEmpty()){
foreach($promotions as $promotion){ ?>
   <div class="clint_info_post">
	  <div class="clint_post">
		 <div class="clint_item"><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $promotion->casino->slug]) ?>"><?php 
				if(!empty($promotion->logo) && (PROMOTION_CASINO_LOGO_ROOT_PATH.$promotion->logo)){
					echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=242px&height=129px&cropratio=2:1&image='.PROMOTION_CASINO_LOGO_IMG_URL.$promotion->logo,['alt' => 'Image']);
				}else{
					if(!empty($promotion->casino->image) && (CASINO_FULL_IMG_ROOT_PATH.$promotion->casino->image)){
						echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=242px&height=129px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$promotion->casino->image,['alt' => 'Image']);
					}
				} ?></a>
			</div>
			<div class="clint_post_right bonus_pa">
            <div class="block casino_block">
			   <a data-title="<?php echo $promotion->casino->title ?>" data-url="<?php echo $promotion->casino->slug ?>" <?php echo NEWTAB ?> rel="nofollow" class="paly_now" href="<?php 
		$slug	=	$promotion->slug; echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $slug)); ?>"><span><?= $promotion->title; ?></span></a>
               </div>
			   <p>Published: <?php  $now = new Time($promotion->created);
						echo $now->timeAgoInWords(['format' => 'MMM d, YYY',    'accuracy' => ['month' => 'month'], 'end' => '+1 year']); ?></p>
				<div class="casino_b2"><span><?php echo $promotion->casino->title ?></span></div>							 
			   <div class="clientRating readonly" data-score="<?php echo $promotion->casino->avg_rating ?>"></div>
			</div>
			<div class="sbumit_block3">
			   <div class="more_info_btn">
				  <a data-title="<?php echo $promotion->casino->title ?>" data-url="<?php echo $promotion->casino->slug ?>" <?php echo NEWTAB ?> rel="nofollow" class="paly_now" href="<?php 
		$slug	=	$promotion->slug; echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $slug)); ?>">Claim Bonus</a>
				  <a class="more_btn" href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $promotion->casino->slug]) ?>">More info</a>
			   </div>
			</div>
		
		 <div class="table_col">
			<table>
			   <thead>
				  <tr>
					 <th>Bonus Description</th>
					 <th>Wagering</th>
					 <th>Bonus Code</th>
				  </tr>
			   </thead>
			   <tbody>
				  <tr><?php /*
				   <td><?php 
					foreach($promotion->promotion_bonus_types as $promotion_bonus_types){
					   echo $promotion_bonus_types->master->name.'<br/>';
					} ?></td>*/ ?>
				   <td><?php echo $promotion->amount ?></td>
				   <?php /* <td><?php echo $promotion->matched_amount ?></td>*/ ?>
				   <td><?php echo $promotion->wagering ?></td>
				   <td><?php echo !empty($promotion->code) ? $promotion->code  : '-';  ?></td><?php /*
					<td><a <?php echo NEWTAB ?> rel="nofollow" href="<?php $slug	=	$promotion->slug; echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $slug));  ?>">Claim Bonus</a></td>*/?>
				  </tr>
			   </tbody>
			</table>
		 </div>
		 <div class="social_ic">
			<ul>
			   <li><?php echo $this->SocialShare->link(
					'facebook',
				   '<img src="'.WEBSITE_IMG_URL.'icon_1.png" alt="img" />',$this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $promotion->casino->slug]),['escape' => false]
				); ?></li>
			   <li><?php echo $this->SocialShare->link(
					'twitter',
				   '<img src="'.WEBSITE_IMG_URL.'icon_2.png" alt="img" />',$this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $promotion->casino->slug]),['escape' => false]
				); ?></li>
			   <li><?php /*echo $this->SocialShare->link(
					'whatsapp',
				   '<img src="'.WEBSITE_IMG_URL.'icon_3.png" alt="img" />',$this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $promotion->casino->slug]),['text' => $promotion->title,'escape' => false]
				); ?></li>
			   <li><?php */ echo $this->SocialShare->link(
					'gplus',
				   '<img src="'.WEBSITE_IMG_URL.'icon_4.png" alt="img" />',$this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $promotion->casino->slug]),['escape' => false]
				); ?></li>
			   <li><?php echo $this->SocialShare->link(
					'email',
				   '<img src="'.WEBSITE_IMG_URL.'icon_5.png" alt="img" />',$this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $promotion->casino->slug]),['text' => $promotion->title,'escape' => false]
				); ?></li>
			</ul>
		 </div>
		  </div>
	  </div>
<?php }
 if(isset($isAjax)){ ?><div id="pagination"> <?php }
	echo $this->element('pagination');
 if(isset($isAjax)){ ?> </div> <?php }
}else{ ?>
	<div class="text-center">No record found</div>
<?php } ?>
