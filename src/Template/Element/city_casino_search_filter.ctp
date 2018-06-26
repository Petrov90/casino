<?php 
if(!$result->isEmpty()){
	foreach($result as $key => $casino){ ?>
		<div class="clint_info_post">
		
			<div class="clint_post client_post1"> 
				<div class="clint_item clint_item_new">
					<a href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]); ?>"><?php 
						 
							if(!empty($casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image)){
							echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=242px&height=129px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$casino->image,['alt' => $casino->title.' review','height'=>129, 'width'=>242]);
							}else{
								?>
								<img src="http://www.casinoo.com/webroot/uploads/image.php?width=239px&amp;height=120px&amp;cropratio=2:1&amp;image=http://www.casinoo.com/webroot/img/city-image.jpg" alt="Image">
								<?php
							}
					    ?><?php
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
                                    echo ' reviews';
                                 else
                                    echo ' review';?>
                    </span>
					
<!--new contetn-->

<!--new contetn-->
				</div>
				<div class="sbumit_block3">
					<div class="more_info_btn ">
						<!-- <a rel="nofollow" data-title="<?php echo $casino->title ?>" data-url="<?php echo $casino->slug ?>" class="paly_now" <?php echo NEWTAB ?> href="<?php $slug	=	$casino->main_promotion->slug; echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $slug)); ?>">Play Now</a> -->
						<a class="more_btn" href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]); ?>">More info</a>
					</div>
				</div>
				<div>
				<?php
				$countrydetails = $this->SocialShare->countryslug($casino->country_id);
				echo $casino->city_name.", ".$countrydetails->name; 
				?>
				</div>
			</div>
		</div><?php 
	}

if(isset($isAjax)){ ?><div id="pagination"> <?php }
echo $this->element('pagination3');
if(isset($isAjax)){ ?> </div> <?php }
}else{ ?>
<div class="text-center">No record found</div>
<?php } ?>


<style type="text/css">
.clint_post.client_post1.mostcasino {
   background: #edecbf !important;
}
</style>