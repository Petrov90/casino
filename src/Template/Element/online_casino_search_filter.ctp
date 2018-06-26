<?php 
if(!$result->isEmpty()){
    ?>
<div class="filter_2N new-block"><p class="casino-list"><?= $this->Paginator->param('count'); ?> Casino listed</p></div>
<?php
	foreach($result as $key => $casino){ ?>
		<div class="clint_info_post">
		
			<div class="clint_post client_post1"> 
				<div class="clint_item clint_item_new">
					<a href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]); ?>"><?php 
						if(!empty($casino->main_promotion->logo) && file_exists(PROMOTION_CASINO_LOGO_ROOT_PATH.$casino->main_promotion->logo)){
							echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=242px&height=129px&cropratio=2:1&image='.PROMOTION_CASINO_LOGO_IMG_URL.$casino->main_promotion->logo,['alt' => $casino->title.' review','height'=>129, 'width'=>242]);
						}else{ 
							if(!empty($casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image)){
							echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=242px&height=129px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$casino->image,['alt' => $casino->title.' review','height'=>129, 'width'=>242]);
							}
					    } ?><?php
						 $paginator = $this->request->params['paging']['Casinos'];

						
						$page =  $paginator['page'] - 1;

					     ?>
				   </a><div class="col_list cl_num1"><span><?php echo (($page*10) + ($key+1)); ?></span></div>
				</div>
	            <div class="clint_post_right">
					<div class="block casino_block">
						<a href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]); ?>"><span><?php echo $casino->title; ?></span></a>
					</div>
					<div class="clientRating clientRating1 readonly" data-score="<?php echo $casino->avg_rating; ?>"></div>
					 <span class="op_txt1">
                                 <?php
                                 echo $casino->review_count + 1;
                                 if($casino->review_count   > 1)
                                    echo ' Opinions';
                                 else
                                    echo ' Opinion';?>
                    </span>
					<div class="casino_b2">
						<span> <?php 
							if(isset($casino->main_promotion->title)){
								$text	=	$casino->main_promotion->title; 
							if(isset($text[0])){ ?><img src="<?php echo WEBSITE_IMG_URL; ?>check.png" alt="img" /><?php echo $text; ?><?php }
							}	?>
						</span>
					</div>
<!--new contetn-->
<div class="new_content">
			   <div class="col_list new-col-list list_new">
				    <div class="check_list">
					 	<span class="checkBx"><?php /*<img src="<?php echo WEBSITE_IMG_URL ?>check.png" alt="Image"/> <?php */ echo $casino->main_promotion->small_text; ?></span>
					 	<p><?php echo $casino->main_promotion->small_text2; ?></p>
				    </div>
			    </div>
			    <div class="col_list new-col-list list_new">
				    <div class="check_list">
					   <span class="checkBx"><?php echo $casino->payout_percentage; ?> %</span>
					 <p>Win Rate</p>
				    </div>
			    </div>
			    <div class="col_list new-col-list list_new1">
				    <div class="check_list">
					  <span class="checkBx"><?php
						$pay_day = round(($casino->p_min + $casino->p_max) / (84600*2));
						if($pay_day > 1) {
							$p_day = 'Days';
						}	
						else{	
							$p_day = 'Day';
						}
					  echo $pay_day.' '.$p_day; ?></span>
					 <p><?php echo 'Payout Time' ?></p>
				    </div>
			    </div>
</div>
<!--new contetn-->
				</div>
				<div class="sbumit_block3">
					<div class="more_info_btn ">
						<a rel="nofollow" data-title="<?php echo $casino->title ?>" data-url="<?php echo $casino->slug ?>" class="paly_now" <?php echo NEWTAB ?> href="<?php $slug	=	$casino->main_promotion->slug; echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $slug)); ?>">Play Now</a>
						<a class="more_btn" href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]); ?>">More info</a>
					</div>
				</div>
				<?php  
 				$promotions = $this->SocialShare->casinopromotions($casino->id);
 				?>
				<ul class="free-spins">
				<?php
				if(!empty($promotions->text)){
				$text = json_decode($promotions->text) ; 
				foreach($text as $t){  ?>
					<li><?php echo $t; ?></li>
				<?php
				} 
				}?>
				</ul>
			</div>
		</div><?php 
	}
if(isset($isAjax)){ ?><div id="pagination"> <?php }
echo $this->element('pagination');
if(isset($isAjax)){ ?> </div> <?php }
}else{ ?>
<div class="text-center">No record found</div>
<?php } ?>


<style type="text/css">
.clint_post.client_post1.mostcasino {
   background: #edecbf !important;
}
</style>