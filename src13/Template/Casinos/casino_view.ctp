<?php use Cake\Core\Configure; if($casino->type == 'normal'){ $cUrl = '#'; ?>
<div class="mid_wrapper">
	 <div class="container">
		<div class="brud_crum banner_textblock rev_info col-md-8">
		   <ul>
			   <?php if(isset($casino->city->country->name)){ ?>
            <li><a href="<?php echo $this->Url->build(array('controller' => 'users','action' => 'country_view','country_view' => $casino->city->country->slug )); ?>"><?php echo $casino->city->country->name; ?></a><span>/</span></li>
            <?php  } 
               if(isset($casino->city->name)){ ?>
            <li><a href="<?php echo $cUrl =  $this->Url->build(array('controller' => 'users','action' => 'city_view','country' => $casino->city->country->slug,'city' => $casino->city->slug)); ?>"><?php echo $casino->city->name; ?></a><span>/</span></li>
            <?php } ?>
            <?php if($casino->type == 'online'){ ?>
            <li><a href="<?php echo $this->Url->build(array('controller' => 'casinos','action' => 'onlineCasino')); ?>">Online Casinos</a><span>></span></li>
            <?php } ?>
            <li class="act"><?php echo $casino->title; ?></li>
		   </ul>
         <h1 class="topheading"><?php echo $casino->title; ?> Review</h1>
		   <p><span class="rank">Ranked #<?php echo $position; ?>:</span>
            <?php if(isset($casino->city->name)){  ?><a href="<?php echo $cUrl; ?>"><?php echo $casino->city->name; ?> Casinos</a><?php } ?></a></p>
		</div>
	 </div>
	 <div class="casino_desc">
		 <div class="container">
         <div class="row">
            <div class="col-md-8">
               <?php if(!empty($casinoImage)){ ?>
               <div class="detail_banner">
                  <div class="flexslider banner_slide"  id="photoslider" >
                     <ul class="slides">
                        <?php
						$show = true;
                           foreach($casinoImage as $image)
                           { 
                           	if(!empty($image->file) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$image->file)){  $show = false; ?>
								<li class="h390">
								   <?php echo $this->Html->image(CASINO_FULL_IMG_URL.$image->file,['class' => 'img-responsive','alt' => 'Image']); ?>
								</li>
                        <?php 
							}
                           }
						if($show){
							?>
						<li class="h390">
                           <?php echo $this->Html->image(NO_CASINO_IMG,['class' => 'img-responsive','alt' => 'Image']); ?>
                        </li>	
							<?php
						} ?>
                     </ul>
                  </div>
                  <?php if($casinoImage->count() > 1){ ?>
                  <span class="left-span"><a href="javascript:void(0);" class="prev"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>left-arrow.png" class="img-responsive" /></a></span> 
                  <span class="right-span"><a href="javascript:void(0);" class="next"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>right-arrow.png" class="img-responsive" /></a></span>
                  <?php } ?>
               </div><?php } ?>
				<div class="edit edit_2">
                  <a href="javascript:void(0);" data-name="<?php echo $casino->title; ?>" data-type="casino" data-id="<?php echo $casino->id; ?>" class="city-click add-rvw-btn hide"><img src="<?php echo WEBSITE_IMG_URL; ?>fav_2.png" alt="img">Add To Favorites</a>
               </div>
				  <div class="edit">
                  <a href="javascript:void(0);" data-name="<?php echo $casino->title; ?>" data-type="casino" data-id="<?php echo $casino->id; ?>" class="city-click addBtn_rating add-rvw-btn hide">Add Review</a>
				  <span>/</span>
                  <a href="javascript:void(0);" data-type="casino" data-id="<?php echo $casino->id; ?>" class="edit_info_details">Edit Info</a>
				  <span>/</span>
				  <a href="javascript:void(0);" data-type="casino" data-id="<?php echo $casino->id; ?>" class="add-photos-click">Add Photos</a>
               </div><?php $tot = array_sum($rat); ?>
				<div class="description">
					<div class="ratingbox">
			<?php /*			<h4>Casino Rating</h4>
		*/?>
					   <div class="rat-left">
						  <a class="button-rat">
							 <img src="<?php echo WEBSITE_URL ?>images/star-11.png"><img src="<?php echo WEBSITE_URL ?>images/star-11.png"> <img src="<?php echo WEBSITE_URL ?>images/star-11.png"> <img src="<?php echo WEBSITE_URL ?>images/star-11.png"><img src="<?php echo WEBSITE_URL ?>images/starhalf-11.png">   
							 <p>4.5</p>
						  </a>
					   </div>
					   <div class="rat-right"><img src="<?php echo WEBSITE_URL ?>images/thumb-left.png"/>
					</div>
					<div class="ratingbox ratingbox-bottom">
					   <div class="rat-left">
						  <ul>
							 <li>
								<img src="<?php echo WEBSITE_URL ?>images/img-icon1.png" /> 
								<p><?php echo $casino->review_count; ?></p>
							 </li>
							 <li>
								<img src="<?php echo WEBSITE_URL ?>images/img-icon2.png" /> 
								<p><?php echo $casino->review_count; ?></p>
							 </li>
							 <li>
								<img src="<?php echo WEBSITE_URL ?>images/img-icon3.png" /> 
								<p><?php echo $casino->question_count; ?></p>
							 </li>
						  </ul>
						  </a> 
					   </div>
					   <div class="rat-right">
						  <h3>Good  Choice</h3>
					   </div>
					</div>
					</div>
				   <div class="titl detil_title">
					   <span class="title-head">Casino Description</span>
					</div>
				   <div><?php echo $this->App->force_balance_tags($casino->description); ?></div>
				</div>
				<?php if(!empty($casino->range_of_games)){ ?>
				 <div class="description">
					<div class="titl detil_title">
					   <span class="title-head">Range Of Games</span>
					</div>
					 <div><?php echo $this->App->force_balance_tags($casino->range_of_games); ?></div>
				 </div>
				<?php } 
				if(!empty($casino->hotels)){ ?>
				<div class="description">
					<div class="titl detil_title">
					   <span class="title-head">Hotels</span>
					</div>
					 <div><?php echo $this->App->force_balance_tags($casino->hotels); ?></div>
				 </div>
				 <?php } 
				if(!empty($casino->food_and_beverages)){ ?>
				 <div class="description">
					<div class="titl detil_title">
					   <span class="title-head">Food & Beverages	</span>
					</div>
					 <div><?php echo $this->App->force_balance_tags($casino->food_and_beverages	); ?></div>
				 </div>
				 <?php } 
				if(!empty($casino->activities_services)){ ?>
				 <div class="description">
					<div class="titl detil_title">
					   <span class="title-head">Activities Services</span>
					</div>
					 <div><?php echo $this->App->force_balance_tags($casino->activities_services); ?></div>
				 </div>
				 <?php }  ?>
				<div class="casinoDatil casino_dat">
				   <div class="titl">
					  <span class="title-head">Casino Details</span>
				   </div>
				   <div class="casinotable">
					  <span class="subtitle-head">General</span>
					  <ul class="casino_detInfo cont-info">
						 <li>
						<?php  
						if(!empty($casino->contact_website)){
							$web 	=	$casino->contact_website;
							if (false === strpos($web, '://')) {
								$web = 'http://' . $web;
							}	
							?>
							<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Website-min.png" /><a target="blank" href="<?php echo $web; ?>">Website</a></div>
						<?php }
						if(!empty($casino->contact_facebook)){
							$Facebook 	=	$casino->contact_facebook;
							if (false === strpos($Facebook, '://')) {
								$Facebook = 'http://' . $Facebook;
							} ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Facebook-min.png" /><a target="blank" href="<?php echo $Facebook; ?>">Facebook</a></div>
						<?php } ?>
						 </li>
						 <li>
						<?php 
							if(!empty($casino->contact_phone)){
								$contact_phone 	=	$casino->contact_phone; ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Phone-min.png" /><span><?php echo $contact_phone ?></span></div>
						<?php } 
							if(!empty($casino->contact_twitter)){
								$contact_twitter 	=	$casino->contact_twitter;
								if (false === strpos($contact_twitter, '://')) {
									$contact_twitter = 'http://' . $contact_twitter;
								} ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Twitter-min.png" /><a target="blank" href="<?php echo $contact_twitter ?>">Twitter</a></div>
							<?php } ?>
						 </li>
						 <li>
						<?php 	
							if(!empty($casino->table_games)){
								$table_games 	=	$casino->table_games;  ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Table-games-min.png" /><span>Table Games : <?php echo $table_games; ?></span></div>
							<?php }  	
							if(!empty($casino->contact_email)){
								$contact_email 	=	$casino->contact_email;  ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Email-min.png" /><span><a href="mailto:<?php echo $casino->contact_email; ?>">Email</a></span></div>
							<?php } ?>
						 </li>
						 <li>
							<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Self-parking-min.png" /><span>Self Parking: <?php echo $casino->self_parking; ?></span></div>
							<?php 
							if(!empty($casino->gaming_machines)){
								$gaming_machines 	=	$casino->gaming_machines;  ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Gaming-machines-min.png" /><span>Gaming Machines: <?php echo $gaming_machines; ?></span></div>
							<?php } ?>
						 </li>
						 <li>
						 <?php 
							if(!empty($casino->casino_sq_ft)){
								$casino_sq_ft 	=	$casino->casino_sq_ft;  ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Casino sqft-min.png" /><span>Casino sq/ft: <?php echo $casino_sq_ft; ?></span></div>
							<?php } ?>
							<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Valet-parking-min.png" /><span>Valet: <?php echo $casino->valet; ?></span></div>
						 </li>
						 <li class="schedule-li"><?php $contact_schedule	=	json_decode($casino->contact_schedule,true);$showSch			=	false;
								
							if(!empty($contact_schedule)){ ?>
							<div class="col">
							   <img src="<?php echo WEBSITE_IMG_URL ?>Horario-min.png" /><span><a data-id="hh1" title="Click to view" class="pa0 schedule-d asc" href="javascript:void(0);">Opening Hours</a></span>
							  <ul id="hh1" class="tel_info schedule_ul" style="display:none">
								<?php 
								if($contact_schedule['all_day'] == 1){
									$schedule	=	Configure::read('weekday');
									foreach($schedule as $key => $val){ $showSch = true; ?>
										<li><span><?php echo $val; ?></span><span class="pull-right">Open 24Hr</span></li>
									<?php  
									}
								}else{
									// $schedule	=	unset($contact_schedule['all_day']);
									// pr($contact_schedule);
									foreach($contact_schedule as $key => $val){ 
										if((!empty($val['from']) && !empty($val['to']))){  $showSch = true; ?>
											<li><span><?php echo Configure::read('weekday.'.$key); ?></span>
											<?php if($val['all_day'] == 1){ ?>
												<span class="pull-right">Open 24Hr</span>
											<?php }else{ ?>
												<span class="pull-right"><?php echo $val['from']; ?>/<?php echo $val['to']; ?></span>
											<?php } ?>
											</li>
									<?php } 
									} 
								} if(!$showSch){
									echo "Not Added";
								} ?>
								</ul>
							</div>
							 <?php 
							}
							if(!empty($casino->convention_sq_ft)){
								$convention_sq_ft 	=	$casino->convention_sq_ft;  ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Casino sqft-min.png" /><span>Convention sq/ft: <?php echo $convention_sq_ft; ?></span></div>
							<?php } ?>
						 </li>
					  </ul>
					  <span class="poker_div subtitle-head">Poker</span>
					  <ul class="casino_detInfo cont-info poker_div">
						<li>
						 <?php 
						 $poker_div		=	false;
							if(!empty($casino->poker_website)){
								$poker_div     = true;
								$poker_website 	=	$casino->poker_website;
								if (false === strpos($poker_website, '://')) {
									$poker_website = 'http://' . $poker_website;
								}
								?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Website-min.png" /><a target="blank" href="<?php echo $poker_website; ?>">Website</a></div>
							<?php } 
							if(!empty($casino->poker_facebook)){
								$poker_div     = true;
								$poker_facebook 	=	$casino->poker_facebook;
								if (false === strpos($poker_facebook, '://')) {
									$poker_facebook = 'http://' . $poker_facebook;
								}
								?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Facebook-min.png" /><span><a target="blank" href="<?php echo $poker_facebook; ?>">Facebook</a></span></div>
							<?php } ?>
						 </li>
						 <li>
						<?php 
							if(!empty($casino->poker_phone)){
								$poker_div     = true;
								$poker_phone 	=	$casino->poker_phone;  ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Phone-min.png" /><span><?php echo $poker_phone; ?></span></div>
						<?php }  
							if(!empty($casino->poker_tw)){
								$poker_div     = true;
								$poker_tw 	=	$casino->poker_tw;
								if (false === strpos($poker_tw, '://')) {
									$poker_tw = 'http://' . $poker_tw;
								} ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Twitter-min.png" /><a target="blank" href="<?php echo $poker_tw; ?>">Twitter</a></div>
							<?php } ?>
						 </li>
						 <li>
						 <?php $poker_schedule	=	json_decode($casino->poker_schedule,true);
						
							if(!empty($poker_schedule)){  ?>
							<div class="col poker_div_showSch">
							   <img src="<?php echo WEBSITE_IMG_URL ?>Horario-min.png" /><span><a data-id="hh2" title="Click to view" class="pa0 schedule-d asc" href="javascript:void(0);">Opening Hours</a></span>
							   <ul id="hh2" style="display:none" class="shedulebar">
								  <?php 
								$showSch			=	false;
								
								if($poker_schedule['all_day'] == 1){
									$schedule	=	Configure::read('weekday');
									foreach($schedule as $key => $val){ $showSch = true;$poker_div     = true; ?>
										<li><span><?php echo $val; ?></span><span class="pull-right">Open 24Hr</span></li>
									<?php  
									}
								}else{
									// $schedule	=	unset($contact_schedule['all_day']);
									foreach($poker_schedule as $key => $val){
										if((!empty($val['from']) && !empty($val['to']))){  $showSch = true;$poker_div     = true; ?>
											<li><span><?php echo Configure::read('weekday.'.$key); ?></span>
											<?php if($val['all_day'] == 1){ ?>
												<span class="pull-right">Open 24Hr</span>
											<?php }else{ ?>
												<span class="pull-right"><?php echo $val['from']; ?>/<?php echo $val['to']; ?></span>
											<?php } ?>
											</li>
									<?php } 
									} 
								}  ?>
							   </ul>
							</div>
							 <?php 
							}
							if(!empty($casino->poker_email)){
								$poker_div     = true;
								$poker_email 	=	$casino->poker_email;
								 ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Email-min.png" /><span><a href="mailto:<?php echo $poker_email; ?>">Email</a></span></div>
							<?php } ?>
						 </li>
					  </ul>
					  <?php 
					  if(!$poker_div){						
						$this->Html->scriptStart(array('block' => 'custom_script')); ?>
							$(".poker_div").remove();
						<?php
						$this->Html->scriptEnd(); 
					  }else{
							if(!$showSch){
								$this->Html->scriptStart(array('block' => 'custom_script')); ?>
									$(".poker_div_showSch").remove();
							<?php $this->Html->scriptEnd(); 
							}
						}
					   ?>
					  <span class="subtitle-head bo_d">Box Office</span>
					  <ul class="casino_detInfo cont-info bo_d">
						<li>
						 <?php 
							$bo_d	=	false;
							if(!empty($casino->bo_web)){
								$bo_d	=	true;
								$bo_web 	=	$casino->bo_web;
								if (false === strpos($bo_web, '://')) {
									$bo_web = 'http://' . $bo_web;
								}
								?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Website-min.png" /><a target="blank" href="<?php echo $bo_web; ?>">Website</a></div>
							<?php } 
							if(!empty($casino->bo_facebook)){ $bo_d	=	true;
								$bo_facebook 	=	$casino->bo_facebook;
								if (false === strpos($bo_facebook, '://')) {
									$bo_facebook = 'http://' . $bo_facebook;
								}
								?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Facebook-min.png" /><span><a target="blank" href="<?php echo $bo_facebook; ?>">Facebook</a></span></div>
							<?php } ?>
						 </li>
						 <li>
						<?php 
							if(!empty($casino->bo_ph)){ $bo_d	=	true;
								$bo_ph 	=	$casino->bo_ph;  ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Phone-min.png" /><span><?php echo $bo_ph; ?></span></div>
						<?php }  
							if(!empty($casino->bo_tw)){ $bo_d	=	true;
								$bo_tw 	=	$casino->bo_tw;
								if (false === strpos($bo_tw, '://')) {
									$bo_tw = 'http://' . $bo_tw;
								} ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Twitter-min.png" /><a target="blank" href="<?php echo $bo_tw; ?>">Twitter</a></div>
							<?php } ?>
						 </li>
						 <li>
						  <?php $bo_schedule	=	json_decode($casino->bo_schedule,true);
								
							if(!empty($bo_schedule)){ ?>
							<div class="col bo_d_showSch">
							   <img src="<?php echo WEBSITE_IMG_URL ?>Horario-min.png" /><span><a data-id="hh3" title="Click to view" class="pa0 schedule-d asc" href="javascript:void(0);">Opening Hours</a></span>
							   <ul id="hh3" style="display:none" class="shedulebar">
								  <?php 
								$showSch			=	false;
								if($bo_schedule['all_day'] == 1){
									$schedule	=	Configure::read('weekday');
									foreach($schedule as $key => $val){ $showSch = true; $bo_d	=	true; ?>
										<li><span><?php echo $val; ?></span><span class="pull-right">Open 24Hr</span></li>
									<?php  
									}
								}else{
									// $schedule	=	unset($contact_schedule['all_day']);
									foreach($bo_schedule as $key => $val){
										if((!empty($val['from']) && !empty($val['to']))){  $showSch = true; $bo_d	=	true; ?>
											<li><span><?php echo Configure::read('weekday.'.$key); ?></span>
											<?php if($val['all_day'] == 1){ ?>
												<span class="pull-right">Open 24Hr</span>
											<?php }else{ ?>
												<span class="pull-right"><?php echo $val['from']; ?>/<?php echo $val['to']; ?></span>
											<?php } ?>
											</li>
									<?php } 
									} 
								} ?>
							   </ul>
							</div>
							<?php 
							}
							if(!empty($casino->bo_email)){ $bo_d	=	true;
								$bo_email 	=	$casino->bo_email;
								 ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Email-min.png" /><span><a href="mailto:<?php echo $bo_email; ?>">Email</a></span></div>
							<?php } ?>
						 </li>
					  </ul>
						  <?php 
						  if(!$bo_d){						
							$this->Html->scriptStart(array('block' => 'custom_script')); ?>
								$(".bo_d").remove();
							<?php
								$this->Html->scriptEnd(); 
							}else{
								if(!$showSch){
									$this->Html->scriptStart(array('block' => 'custom_script')); ?>
										$(".bo_d_showSch").remove();
								<?php $this->Html->scriptEnd(); 
								}
							} ?>
						 <span class="hading_h2 grp_sale_div">Group Sales</span>
					  <ul class="casino_detInfo cont-info grp_sale_div">
						<li>
						 <?php 
							$grp_sale_div	=	false;
							if(!empty($casino->gs_web)){
								$grp_sale_div	=	true;
								$gs_web 	=	$casino->gs_web;
								if (false === strpos($gs_web, '://')) {
									$gs_web = 'http://' . $gs_web;
								}
								?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Website-min.png" /><a target="blank" href="<?php echo $gs_web; ?>">Website</a></div>
							<?php } 
							if(!empty($casino->gs_facebook)){ $grp_sale_div	=	true;
								$gs_facebook 	=	$casino->gs_facebook;
								if (false === strpos($gs_facebook, '://')) {
									$gs_facebook = 'http://' . $gs_facebook;
								}
								?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Facebook-min.png" /><span><a target="blank" href="<?php echo $gs_facebook; ?>">Facebook</a></span></div>
							<?php } ?>
						 </li>
						 <li>
						<?php 
							if(!empty($casino->gs_ph)){ $grp_sale_div	=	true;
								$gs_ph 	=	$casino->gs_ph;  ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Phone-min.png" /><span><?php echo $gs_ph; ?></span></div>
						<?php }  
							if(!empty($casino->gs_tw)){ $grp_sale_div	=	true;
								$gs_tw 	=	$casino->gs_tw;
								if (false === strpos($gs_tw, '://')) {
									$gs_tw = 'http://' . $gs_tw;
								} ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Twitter-min.png" /><a target="blank" href="<?php echo $gs_tw; ?>">Twitter</a></div>
							<?php } ?>
						 </li>
						 <li>
						 <?php $gs_schedule	=	json_decode($casino->gs_schedule,true);
								
							if(!empty($gs_schedule)){  ?>
							<div class="col grp_sale_div_showSch">
							   <img src="<?php echo WEBSITE_IMG_URL ?>Horario-min.png" /><span><a data-id="hh4" title="Click to view" class="pa0 schedule-d asc" href="javascript:void(0);">Opening Hours</a></span>
							   <ul id="hh4" style="display:none" class="shedulebar">
								  <?php 
								$showSch			=	false;
								
								if($gs_schedule['all_day'] == 1){
									$schedule	=	Configure::read('weekday');
									foreach($schedule as $key => $val){ $showSch = true;  $grp_sale_div	=	true; ?>
										<li><span><?php echo $val; ?></span><span class="pull-right">Open 24Hr</span></li>
									<?php  
									}
								}else{
									// $schedule	=	unset($contact_schedule['all_day']);
									
									foreach($gs_schedule as $key => $val){
										if((!empty($val['from']) && !empty($val['to']))){
											$showSch = true;$grp_sale_div	=	true; ?>
											<li><span><?php echo Configure::read('weekday.'.$key); ?></span>
											<?php if($val['all_day'] == 1){ ?>
												<span class="pull-right">Open 24Hr</span>
											<?php }else{ ?>
												<span class="pull-right"><?php echo $val['from']; ?>/<?php echo $val['to']; ?></span>
											<?php } ?>
											</li>
									<?php } 
									} 
								}  ?>
							   </ul>
							</div>
							 <?php 
							}
							if(!empty($casino->gs_email)){ $grp_sale_div	=	true;
								$gs_email 	=	$casino->gs_email;
								 ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Email-min.png" /><span><a href="mailto:<?php echo $gs_email; ?>">Email</a></span></div>
							<?php } ?>
						 </li>
					  </ul>
					  <?php 
						  if(!$grp_sale_div){						
							$this->Html->scriptStart(array('block' => 'custom_script')); ?>
								$(".grp_sale_div").remove();
							<?php
							$this->Html->scriptEnd(); 
						  }else{
								if(!$showSch){
									$this->Html->scriptStart(array('block' => 'custom_script')); ?>
										$(".grp_sale_div_showSch").remove();
								<?php $this->Html->scriptEnd(); 
								}
							} ?>
					  <span class="subtitle-head cont-info Conferences">Conferences</span>
					  <ul class="casino_detInfo cont-info Conferences">
						<li>
						 <?php 
							$Conferences	=	false;
							if(!empty($casino->cf_web)){
								$Conferences	=	true;
								$cf_web 	=	$casino->cf_web;
								if (false === strpos($cf_web, '://')) {
									$cf_web = 'http://' . $cf_web;
								}
								?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Website-min.png" /><a target="blank" href="<?php echo $cf_web; ?>">Website</a></div>
							<?php } 
							if(!empty($casino->cf_facebook)){ $Conferences	=	true;
								$cf_facebook 	=	$casino->cf_facebook;
								if (false === strpos($cf_facebook, '://')) {
									$cf_facebook = 'http://' . $cf_facebook;
								}
								?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Facebook-min.png" /><span><a target="blank" href="<?php echo $cf_facebook; ?>">Facebook</a></span></div>
							<?php } ?>
						 </li>
						 <li>
						<?php 
							if(!empty($casino->cf_ph)){ $Conferences	=	true;
								$cf_ph 	=	$casino->cf_ph;  ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Phone-min.png" /><span><?php echo $cf_ph; ?></span></div>
						<?php }  
							if(!empty($casino->cf_tw)){ $Conferences	=	true;
								$cf_tw 	=	$casino->cf_tw;
								if (false === strpos($cf_tw, '://')) {
									$cf_tw = 'http://' . $cf_tw;
								} ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Twitter-min.png" /><a target="blank" href="<?php echo $cf_tw; ?>">Twitter</a></div>
							<?php } ?>
						 </li>
						 <li>
						 <?php 
							$cf_schedule	=	json_decode($casino->cf_schedule,true);								
							if(!empty($cf_schedule)){ ?>
							<div class="col Conferences_showSch">
							   <img src="<?php echo WEBSITE_IMG_URL ?>Horario-min.png" /><span><a data-id="hh5" title="Click to view" class="pa0 schedule-d asc" href="javascript:void(0);">Opening Hours</a></span>
							   <ul id="hh5" style="display:none" class="shedulebar">
								  <?php 
								$showSch			=	false;
								if($cf_schedule['all_day'] == 1){ 
									$schedule	=	Configure::read('weekday');
									foreach($schedule as $key => $val){  $Conferences	=	true;$showSch = true; ?>
										<li><span><?php echo $val; ?></span><span class="pull-right">Open 24Hr</span></li>
									<?php  
									}
								}else{
									// $schedule	=	unset($contact_schedule['all_day']);
									foreach($cf_schedule as $key => $val){
										if((!empty($val['from']) && !empty($val['to']))){   $Conferences	=	true;$showSch = true; ?>
											<li><span><?php echo Configure::read('weekday.'.$key); ?></span>
											<?php if($val['all_day'] == 1){ ?>
												<span class="pull-right">Open 24Hr</span>
											<?php }else{ ?>
												<span class="pull-right"><?php echo $val['from']; ?>/<?php echo $val['to']; ?></span>
											<?php } ?>
											</li>
									<?php } 
									} 
								} ?>
							   </ul>
							</div>
							 <?php 
							}
							if(!empty($casino->cf_em)){ $Conferences	=	true;
								$cf_em 	=	$casino->cf_em;
								 ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Email-min.png" /><span><a href="mailto:<?php echo $cf_em; ?>">Email</a></span></div>
							<?php } ?>
						 </li>
					  </ul>
					  <?php 
						  if(!$Conferences){						
							$this->Html->scriptStart(array('block' => 'custom_script')); ?>
								$(".Conferences").remove();
							<?php
							$this->Html->scriptEnd(); 
							}else{
								if(!$showSch){
									$this->Html->scriptStart(array('block' => 'custom_script')); ?>
										$(".Conferences_showSch").remove();
								<?php $this->Html->scriptEnd(); 
								}
							} ?>
				   </div>
				</div>
				<div class="titl">
						<!-- <h3 class="title-head">Amenitie</h3>-->
					  </div>
				<?php $activitieData = $casino->casino_activity_datas;
					$casino_activity_data = array();
					foreach($activitieData as $activitie){
						$casino_activity_data[$activitie->parent_master->title][]	=	$activitie;	
					} if(!empty($casino_activity_data)){ ?>
					<div class="Amenities ament_info AmenitInfo2">
					  
					  <?php foreach($casino_activity_data as $key12 => $casino_activity_datas1){
 ?>
					  <div class="ament_post">
							<div> 
								 <span><?php echo $key12; ?></span>
								 <ul class="">
								<?php foreach($casino_activity_datas1 as $key1 => $casino_activity_datas){ ?>
									<li><a class="divb" href="javascript:void(0)" data-id="<?php echo md5($casino_activity_datas->casino_activity->title); ?>"><?php echo $casino_activity_datas->casino_activity->title; ?></a></li>
								<?php } ?>
								 </ul>
							</div>
					  </div>
					  <?php } ?>
				   </div>
<?php 			} if(!empty($casino->casino_gambling_options)) { ?>
				   <div class="gambling ">
					  <div class="titl">
						 <span class="title-head">Range of Games</span>
					  </div>
					  <div class="gamble_option gambling_INFO_2">
						 <?php foreach($casino->casino_gambling_options as $casino_gambling_options){ ?>
						 <div class="round round_2">
							<div class="img_round img_round_2"> 
							   <?php 
								  if(file_exists((AMENITIES_ROOT_PATH.$casino_gambling_options->master->image))){ ?>
							   <img src="<?php echo WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.AMENITIES_IMG_URL.$casino_gambling_options->master->image ?>" class="img-responsive" alt="img" /> 
							   <?php } ?>
							   <?php /*<span><?php echo $casino_gambling_options->value ?>%</span> */?>
							</div>
							<h3><?php echo $casino_gambling_options->master->name ?></h3>
						 </div>
						 <?php } ?>
					  </div>
				   </div>
				   <?php }
					
					foreach($casino_activity_data as $key12 => $casino_activity_datas1){ 
					?>
					 <div class="Activities_info">
						<div class="Active_post">
						   <span class="title-head"><?php echo $key12; ?></span>
						   <div class="block">
							<?php 
							// pr($casino_activity_datas1);
							foreach($casino_activity_datas1 as $key1 => $casino_activity_datas){
								$schedule	=	array();
								
							$iid = md5($key1.$key12);							?>
							  <div class="Active_col" id="<?php echo md5($casino_activity_datas->casino_activity->title); ?>">								
								<span class="subtitle-head"><?php echo $casino_activity_datas->casino_activity->title; ?></span>
								 <?php if(!empty($casino_activity_datas->casino_activity->description)){ ?>
									<div><?php echo $casino_activity_datas->casino_activity->description; ?></div>
								 <?php } ?>
								 <?php if(!empty($casino_activity_datas->casino_activity->casino_images)){ ?>
									<div class="detail_banner acte_slider">
									  <div class="flexslider banner_slide" id="photoslider<?php echo $iid; ?>">
										 <ul class="slides">
											<?php
											$show = true;
											   foreach($casino_activity_datas->casino_activity->casino_images as $image)
											   {
													if(file_exists(CASINO_FULL_IMG_ROOT_PATH.$image->file)){ $show=false; ?>
														<li class="h_auto11">
														   <?php echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=718px&height=359px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$image->file,['class' => 'img-responsive','alt' => 'Image']); ?>
														</li>
												<?php 
												   }
											   }
											if($show){
												 ?>
												   <li class="h_auto11">
													   <?php echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=718px&height=359px&cropratio=2:1&image='.NO_ACTIVITY_IMG,['class' => 'img-responsive','alt' => 'Image']); ?>
													</li>
												   <?php
											} ?>
										 </ul>
									  </div>
									  <?php if(isset($casino_activity_datas->casino_activity->casino_images[1])){ ?>
										  <span class="left-span"><a href="javascript:void(0);" class="prev<?php echo $key1.$key12; ?>"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>left-arrow.png" class="img-responsive" /></a></span> 
										  <span class="right-span"><a href="javascript:void(0);" class="next<?php echo $key1.$key12; ?>"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>right-arrow.png" class="img-responsive" /></a></span>
							<?php 		} 
								 ?>
								</div><?php } ?>
								 <ul class="tel_info">
								<?php  
								$info = unserialize($casino_activity_datas->casino_activity->info);
								foreach($info as $key => $val){ 
									if(!empty($val)){ ?>
									<li><?php
										if(file_exists(AMENITIES_ROOT_PATH.$amenitiesInfo[$key]->image)){
											echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=25px&height=25px&cropratio=1:1&image='.AMENITIES_IMG_URL.$amenitiesInfo[$key]->image,['title' => $amenitiesInfo[$key]->name]);
										} ?><span><?php 
										if($amenitiesInfo[$key]->field_type == 'text'){
											echo $val; 
										}elseif($amenitiesInfo[$key]->field_type == 'link'){
											?><a target="_blank" href="<?php 
											if (false === strpos($val, '://')) {
												$val = 'http://' . $val;
											}
											echo $val; ?>"><?php echo $amenitiesInfo[$key]->name;  ?></a><?php
										}elseif($amenitiesInfo[$key]->field_type == 'email'){
											?><a href="mailto:<?php echo $val; ?>"><?php echo $amenitiesInfo[$key]->name;  ?></a><?php
										}else{
											echo $val;
										} ?></span></li>
								<?php } 
								} ?>
								 </ul>
								<?php
								if(!empty($casino_activity_datas->casino_activity->schedule)){
									$schedule = unserialize($casino_activity_datas->casino_activity->schedule); ?>
									 <span class="hide" id="showSch<?php echo $iid; ?>"><?php echo $this->Html->image(WEBSITE_IMG_URL.'timer.png'); ?>
										<a data-id="openhour<?php echo $iid; ?>" title="Click to view" class="schedule-d asc" href="javascript:void(0);">Opening Hours</a>
									 </span>
									 <ul class="tel_info schedule_ul" id="openhour<?php echo $iid; ?>" style="display:none">
									<?php 
									$showSch	=	false;
									if($casino_activity_datas->casino_activity->all_day == 1){
										$schedule	=	Configure::read('weekday');
										foreach($schedule as $key => $val){ $showSch = true; ?>
											<li><span><?php echo $val; ?></span><p>Open 24Hr</p></li>
										<?php  
										}
									}else{
										foreach($schedule as $key => $val){
											if((!empty($val['from']) && !empty($val['to']))){  $showSch = true; ?>
												<li><span><?php echo Configure::read('weekday.'.$key); ?></span>
												<?php if($val['all_day'] == 1){ ?>
													<p>Open 24Hr</p>
												<?php }else{ ?>
													<p><?php echo $val['from']; ?>/<?php echo $val['to']; ?></p>
												<?php } ?>
												</li>
										<?php } 
										} 
									} ?>
									</ul>
								<?php } ?>
								
							  </div>
							  <?php $this->Html->scriptStart(array('block' => 'custom_script'));
									if($showSch){ ?>
									$("#showSch<?php echo $iid; ?>").removeClass('hide');
									<?php } ?>
									$('#photoslider<?php echo $iid; ?>').flexslider({
										animation: 'fade',
										controlsContainer: '.flex-container',
										controlNav: false,
										directionNav: false
									});
									$(".prev<?php echo $iid; ?>").click(function() {
										$('#photoslider<?php echo $iid; ?>').flexslider("prev")
									});
									$(".next<?php echo $iid; ?>").click(function() {
										$('#photoslider<?php echo $iid; ?>').flexslider("next")
									});
							<?php $this->Html->scriptEnd(); 
							}
								?>
						   </div>
						</div>
					</div>
					<?php } echo $this->element('normal_casino_review_json',['name' => $casino->title,'type' => 'casino','count' => $casino->review_count,'avg_rating' => $casino->avg_rating,'id' => $casino->id]);
					echo $this->element('question_answer_json',['name' => $casino->title,'type' => 'casino','count' => $casino->question_count,'avg_rating' => $casino->avg_rating,'id' => $casino->id]); ?>
					
			</div>
			<div class="col-md-4">
				<div class="block-1 bestPmnt block_4">
                  <h3><?php echo $mainPromotions->title ?></h3>
                  <div class="imageFreame">
					<a data-title="<?php echo $mainPromotions->casino->title ?>" data-url="<?php echo $mainPromotions->casino->slug ?>"  <?php echo NEWTAB ?> rel="nofollow" href="<?php  echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $mainPromotions->slug)); ?>">
                     <?php 
                        if(!empty($mainPromotions->logo) && (PROMOTION_CASINO_LOGO_ROOT_PATH.$mainPromotions->logo)){
                        	echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=323px&height=192px&cropratio=2:1&image='.PROMOTION_CASINO_LOGO_IMG_URL.$mainPromotions->logo);
                        }elseif(!empty($mainPromotions->casino->image) && (CASINO_FULL_IMG_ROOT_PATH.$mainPromotions->casino->image)){
                        	echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=323px&height=192px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$mainPromotions->casino->image);
                        }else{
                        	echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=323px&height=192px&cropratio=2:1&image='.NO_CASINO_IMG);
                        } ?></a>
                  </div>
                  <ul>
                     <?php 
                        if(!empty($mainPromotions->text)){
                        	$text = json_decode($mainPromotions->text) ; 
                        	foreach($text as $t){  ?>
								<li><a href="javascript:void(0);"><?php echo $t; ?></a></li>
                     <?php }
                        } ?>
                  </ul>
                  <div class="play-now play"><a data-title="<?php echo $mainPromotions->casino->title ?>" data-url="<?php echo $mainPromotions->casino->slug ?>"  <?php echo NEWTAB ?> rel="nofollow" class="btn red_btn btn1" href="<?php  echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $mainPromotions->slug)); ?>">Play now!</a></div>
               </div>
               <?php echo $this->element('normal_casino_sidebar'); ?>				
            </div>
			</div>
		</div>
	 </div>
  </div>      
<?php }else{ ?>
<div class="mid_wrapper">
   <div class="container">
      <div class="brud_crum banner_textblock">
         <ul>            
            <li><a href="<?php echo $this->Url->build(array('controller' => 'casinos','action' => 'onlineCasino')); ?>">Online Casinos</a><span>></span></li>
            <li class="act"><?php echo $casino->title; ?></li>
         </ul>
         <h1><?php echo $casino->title; ?> Review</h1>
      </div>
   </div>
   <div class="promotion-image">
      <div class="container">
         <div class="row">
            <div class="col-md-8">
               <?php if(!empty($casinoImage)){ ?>
               <div class="detail_banner">
                  <div class="flexslider banner_slide"  id="photoslider" >
                     <ul class="slides">
                        <?php
                           foreach($casinoImage as $image)
                           {
                           	if(!empty($image->file) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$image->file)){ ?>
                      <li class="h390">
                           <?php echo $this->Html->image(CASINO_FULL_IMG_URL.$image->file,['class' => 'img-responsive','alt' => 'Image']); ?>
                        </li>
                        <?php 
                           }
                           } ?>
                     </ul>
                  </div>
                  <?php if($casinoImage->count() > 1){ ?>
                  <span class="left-span"><a href="javascript:void(0);" class="prev"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>left-arrow.png" class="img-responsive" /></a></span> 
                  <span class="right-span"><a href="javascript:void(0);" class="next"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>right-arrow.png" class="img-responsive" /></a></span>
                  <?php } ?>
               </div>
               <?php } ?>
               <div class="edit edit_2">
                  <a href="javascript:void(0);" data-name="<?php echo $casino->title; ?>" data-type="casino" data-id="<?php echo $casino->id; ?>" class="city-click add-rvw-btn hide"><img src="<?php echo WEBSITE_IMG_URL; ?>fav_2.png" alt="img">Add To Favorites</a>
               </div>
               <div class="edit">
                  <a href="javascript:void(0);" data-type="casino" data-id="<?php echo $casino->id; ?>" class="edit_info_details">Edit Info</a><span>/</span><a href="javascript:void(0);" data-type="casino" data-id="<?php echo $casino->id; ?>" class="add-photos-click">Add Photos</a>
               </div>
			    <div class="description">
					<div class="titl detil_title text-left">
					   <span>Casino Rating</span>
					</div>
				   <div class="ratingDescrip">
						<div class="ratingCol">
							<p><?php echo $casino->avg_rating; ?></p>
							<span class="readonly" data-score="<?php echo $casino->avg_rating; ?>"></span>
						</div>
						<div class="ratingCol">
							<div class="ratingProgres">
							   <div class="icon"><i><img src="<?php echo WEBSITE_URL ?>images/starIcon2.png" alt="img"></i><span><?php echo $casino->our_rating; ?></span></div>
							   <div class="progersBar"><p><span style="width:<?php echo ($casino->our_rating)*20; ?>%;"></span><label>Our Rating</label></p></div>         
						   </div>
						   <div class="ratingProgres">
							   <div class="icon"><i><img src="<?php echo WEBSITE_URL ?>images/starIcon2.png" alt="img"></i><span><?php echo $casino->member_rating; ?></span></div>
							   <div class="progersBar"><p><span style="width:<?php echo ($casino->member_rating)*20; ?>%;"></span><label>User Rating</label></p></div>         
						   </div>
						</div>
						<div class="ratingCol">
							<a href="javascript:void(0);" data-name="<?php echo $casino->title; ?>" data-type="casino" data-id="<?php echo $casino->id; ?>" class="city-click addBtn_rating add-rvw-btn hide">Add Review</a>
						</div>
					</div>
				</div>
			<div class="casino_desc casino_desc3">
               <div class="description">
					<div class="titl detil_title ffff">
					   <span>Casino Description</span>
					</div>
                  <div><?php echo $this->App->force_balance_tags($casino->sdescription); ?></div>
               </div>
               <div class="casinoDatil">
                  <div class="titl">
                     <h3>Casino Details</h3>
                  </div>
                  <div class="casinotable">
                     <ul>
                        <li>
                           <div class="col"><span>Company</span></div>
                           <div class="col">
                              <p><?php echo (!empty($casino->owner)) ? $casino->owner.' / '.$casino->established : ''.$casino->established  ?></p>
                           </div>
                        </li>
                        <li>
                           <div class="col"><span>Devices</span></div>
                           <div class="col">
                              <?php foreach($casino->casino_devices as $res){ ?>
                              <div class="softCol">
                                 <?php 
                                    if(!empty($res->master->image) && file_exists((AMENITIES_ROOT_PATH.$res->master->image))){ ?>
                                 <img src="<?php echo WEBSITE_UPLOADS_URL.'image.php?width=30px&height=30px&cropratio=1:1&image='.AMENITIES_IMG_URL.$res->master->image ?>" class="img-responsive" alt="<?php echo $res->master->name; ?>" title="<?php echo $res->master->name; ?>"/> 
                                 <?php } ?>
                                 <p><?php echo $res->master->name; ?></p>
                              </div>
                              <?php } ?>
                           </div>
                        </li>
                        <li>
                           <div class="col"><span>Currencies</span></div>
                           <div class="col">
                              <p><?php 
								$count	=	count($casino->casino_currencies);
								$append	=	',&nbsp;';
                                 foreach($casino->casino_currencies as $key => $res){
									 if($count == $key+1){
										 $append	=	'';
									 }
                                 	echo $res->master->name.$append; 
                                 } ?></p>
                           </div>
                        </li>
                        <li>
                           <div class="col"><span>Languages</span></div>
                           <div class="col">
                              <div class="depositBlok rong_icon1"><?php 
                                 foreach($casino->casino_language as $res){ 
                                 	if(!empty($res->master->image) && file_exists((AMENITIES_ROOT_PATH.$res->master->image))){ ?><span><img src="<?php echo WEBSITE_UPLOADS_URL.'image.php?width=35px&height=27px&cropratio=1:1&image='.AMENITIES_IMG_URL.$res->master->image ?>" class="img-responsive" alt="<?php echo $res->master->name; ?>" title="<?php echo $res->master->name; ?>"/></span><?php 
                                    }
                                    } ?>
                              </div>
                           </div>
                        </li>
                        <li>
                           <div class="col"><span>Software</span></div>
                           <div class="col">
                              <p><?php 
                                $count	=	count($casino->casino_software);
								$append	=	',&nbsp;';
                                 foreach($casino->casino_software as $key => $res){
									 if($count == $key+1){
										 $append	=	'';
									 }
                                 	echo $res->master->name.$append; 
                                 }  ?></p>
                           </div>
                        </li>
                        <li>
                           <div class="col"><span>Deposit Methods</span></div>
                           <div class="col">
                              <div class="depositBlok"><?php 
                                 foreach($casino->casino_deposit_methods as $res){ 
                                 	if(!empty($res->master->image) && file_exists((AMENITIES_ROOT_PATH.$res->master->image))){ ?><span>
                                 <img src="<?php echo WEBSITE_UPLOADS_URL.'image.php?width=82px&height=30px&cropratio=3:1&image='.AMENITIES_IMG_URL.$res->master->image ?>" class="img-responsive" alt="<?php echo $res->master->name; ?>" title="<?php echo $res->master->name; ?>"/></span><?php 
                                    }
                                    }  ?>
                              </div>
                           </div>
                        </li>
                        <li>
                           <div class="col"><span>Withdrawal Methods</span></div>
                           <div class="col">
                              <div class="depositBlok"><?php 
                                 foreach($casino->casino_withdrawal_methods as $res){ 
                                 	if(!empty($res->master->image) && file_exists((AMENITIES_ROOT_PATH.$res->master->image))){ ?><span>
                                 <img src="<?php echo WEBSITE_UPLOADS_URL.'image.php?width=82px&height=30px&cropratio=3:1&image='.AMENITIES_IMG_URL.$res->master->image ?>" class="img-responsive" alt="<?php echo $res->master->name; ?>" title="<?php echo $res->master->name; ?>"/></span><?php 
                                    }
                                    }  ?>
                              </div>
                           </div>
                        </li>
                        <li>
                           <div class="col"><span>Payout Speed</span></div>
                           <div class="col">
                              <p><?php echo $casino->min_time; ?><?php echo $casino->type1; ?>-<?php echo $casino->max_time; ?><?php echo $casino->type2; ?></p>
                           </div>
                        </li>
                        <li>
                           <div class="col"><span>Payout Percentage</span></div>
                           <div class="col">
                              <p><?php echo $casino->payout_percentage; ?>%</p>
                           </div>
                        </li>
                        <li>
                           <div class="col"><span>Licenses</span></div>
                           <div class="col">
                              <p><?php 
								$count	=	count($casino->casino_licences);
								$append	=	',&nbsp;';
                                 foreach($casino->casino_licences as $key => $res){
									 if($count == $key+1){
										 $append	=	'';
									 }
                                 	echo $res->master->name.$append; 
                                 } ?></p>
                           </div>
                        </li>
                        <li>
                           <div class="col"><span>Restricted Countries</span></div>
                           <div class="col">
                              <div class="depositBlok rong_icon"><?php 
								$append	=	', ';
								 $count	=	count($casino->restricated_countries);
                                 foreach($casino->restricated_countries as $key => $res){
                                 	if(!empty($res->country->flag) && file_exists((AMENITIES_ROOT_PATH.$res->country->flag))){ ?><span>
                                 <img src="<?php echo AMENITIES_IMG_URL.$res->country->flag ?>" height="20" width="30" class="img-responsive" alt="<?php echo $res->country->name; ?>" title="<?php echo $res->country->name; ?>"/></span><?php 
                                    
                                    }else{
										 if($count == $key+1){
											 $append	=	'';
										 }
										echo $res->country->name.$append;
								 } 
								} ?>
                              </div>
                           </div>
                        </li>
					</ul>
                  </div>
               </div>
               <?php $url	=	$casino->promotions[0]->slug;
			   if(!empty($url)){ ?>
               <div class="Btn_PlayNow">
					<a <?php echo NEWTAB ?> data-title="<?php echo $casino->title ?>" data-url="<?php echo $casino->promotions[0]->slug ?>"  rel="nofollow" class="btn red_btn btn1 PlayNow" href="<?php  echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $url)); ?>">Play now!</a>
               </div>
               <?php } ?>
               <div class="description">
                  <div>
                     <?php echo $this->App->force_balance_tags($casino->description); ?>
                  </div>
               </div>
               <?php
                  if(!empty($casino->casino_software)){ ?>
               <div class="gambling ">
                  <div class="titl">
                     <h3>Range of Games</h3>
                  </div>
                  <div class="gamble_option gambling_INFO_2">
                     <?php foreach($casino->casino_gambling_options as $casino_gambling_options){ ?>
                     <div class="round round_2">
                        <div class="img_round img_round_2"> 
                           <?php 
                              if(file_exists((AMENITIES_ROOT_PATH.$casino_gambling_options->master->image))){ ?>
                           <img src="<?php echo WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.AMENITIES_IMG_URL.$casino_gambling_options->master->image ?>" class="img-responsive" alt="img" /> 
                           <?php } ?>
                          
                        </div>
                        <h3><?php echo $casino_gambling_options->master->name ?></h3>
                     </div>
                     <?php } ?>
                  </div>
               </div>
               <div class="description">
                  <div><?php echo $this->App->force_balance_tags($casino->tdescription); ?></div>
               </div>
               <?php }
                  if(!empty($casino->promotions)){ ?>
               <div class="casinoDatil">
                  <div class="titl">
                     <h3>Best <?php echo $casino->title; ?> Bonuses</h3>
                  </div>
                  <div class="Promotionstable">
                     <table>
                        <tbody>
                           <tr>
                              <td>Bonus Description</td>
                              <td>Wagering</td>
                              <td>Code</td>
                              <td>&nbsp;</td>
                           </tr>
                           <?php foreach($casino->promotions as $promotions){ //pr($promotions); ?>
                           <tr>
                              <td><?php echo $promotions->amount ?></td>
                              <td><?php echo $promotions->wagering ?></td>
                              <td><?php echo !empty($promotions->code) ? $promotions->code  : '-';  ?></td>
                              <td>
								<a <?php echo NEWTAB ?> data-title="<?php echo $casino->title ?>" data-url="<?php echo $casino->slug ?>" rel="nofollow" class="btn red_btn" href="<?php  echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $promotions->slug)); ?>">Claim Now</a>
								 </td>
                           </tr>
                           <?php } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
               <?php }  ?>
               <div class="description">
                  <div><?php echo $this->App->force_balance_tags($casino->fdescription); ?></div>
               </div>
               <div class="prosBar2">
                  <?php if(!empty($casino->pros)){
                     $tt	=	json_decode($casino->pros);	?>
                  <div class="pros_info">
                     <h3>Pros</h3>
                     <ul>
                        <?php foreach($tt as $text){ if(empty($text)) continue; ?>
                        <li><?php echo $text; ?></li>
                        <?php } ?>
                     </ul>
                  </div>
                  <?php } ?>
                  <?php if(!empty($casino->cons)){
                     $tt	=	json_decode($casino->cons);	?>
                  <div class="cons_info">
                     <h3>Cons</h3>
                     <ul>
                        <?php foreach($tt as $text){if(empty($text)) continue;  ?>
                        <li><?php echo $text; ?></li>
                        <?php } ?>
                     </ul>
                  </div>
                  <?php } if($casino->type == 'online'){ ?>
				  <div class="Btn_PlayNow">
						<a <?php echo NEWTAB ?> data-title="<?php echo $casino->title ?>" data-url="<?php echo $casino->slug ?>" rel="nofollow" href="<?php  echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $url)); ?>" class="btn red_btn btn1 "><?php if(!empty($casino->promotions[0]->text)){ $text = json_decode($casino->promotions[0]->text) ;  echo 'Claim '.$text[0]; } ?></a>
				  </div>
				  <?php } ?>
               </div>
               <?php echo $this->element('normal_casino_review_json',['name' => $casino->title,'type' => 'casino','count' => $casino->review_count,'avg_rating' => $casino->avg_rating,'id' => $casino->id]);
			   echo $this->element('question_answer_json',['name' => $casino->title,'type' => 'casino','count' => $casino->question_count,'avg_rating' => $casino->avg_rating,'id' => $casino->id]);
 ?>	  
            </div>
            </div>
            <div class="col-md-4">
				<?php if(isset($casino->promotions[0]->title)){ ?>
				   <div class="block-1 bestPmnt block_4">
					  <h3><?php echo $casino->promotions[0]->title ?></h3>
					  <div class="imageFreame">
					  <a data-title="<?php echo $casino->title ?>" data-url="<?php echo $casino->slug ?>"  <?php echo NEWTAB ?> rel="nofollow" href="<?php  echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $url)); ?>">
						 <?php 
							if(!empty($casino->promotions[0]->logo) && (PROMOTION_CASINO_LOGO_ROOT_PATH.$casino->promotions[0]->logo)){
								echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=323px&height=192px&cropratio=2:1&image='.PROMOTION_CASINO_LOGO_IMG_URL.$casino->promotions[0]->logo);
							}elseif(!empty($casino->image) && (CASINO_FULL_IMG_ROOT_PATH.$casino->image)){
								echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=323px&height=192px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$casino->image);
							}else{
								echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=323px&height=192px&cropratio=2:1&image='.NO_CASINO_IMG);
							} ?></a>
					  </div>
					  <ul>
						 <?php 
							if(!empty($casino->promotions[0]->text)){
								$text = json_decode($casino->promotions[0]->text) ; 
								foreach($text as $t){  ?>
									<li><a href="javascript:void(0);"><?php echo $t; ?></a></li>
						 <?php }
							} ?>
					  </ul>
					  <div class="play-now play"><a data-title="<?php echo $casino->title ?>" data-url="<?php echo $casino->slug ?>"  <?php echo NEWTAB ?> rel="nofollow" class="btn red_btn btn1" href="<?php  echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $url)); ?>">Play now!</a></div>
				   </div>
               <?php } ?>
			    <?php echo $this->cell('Inbox::casino_side_bar'); ?>
            </div>
         </div>
      </div>
   </div>
</div>
<?php }
	echo $this->element('add_info_popup',['type' => 'casino','foreign_key' => $casino->id]);
 if($casino->type == 'normal'){
  	echo $this->Html->script(array('https://maps.googleapis.com/maps/api/js?v=3&libraries=geometry%2Cplaces&key&language=en&ver=4.3.1&key=AIzaSyALXv-As7qSIdGRZ4S5vKRK315dP5FgneU'),array('block' =>'footer_script'));
 }
   	$this->Html->scriptStart(array('block' => 'custom_script'));  	?>
	var app = angular.module('myApp', []);
<?php if($casino->type == 'normal'){ ?>
	app.controller('myCtrl', function($scope, $http) {
		$http({
			url : "<?php echo $this->Url->build(array('plugin' => '','controller' => 'casinos','action' => 'casino_amenities')); ?>",
			data : $.param({'slug' : '<?php echo $slug; ?>'}),
			method: "POST",
			headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
		}).then(function(response) {
			$scope.amenties = response.data;
		});
	});
<?php } ?>
$(window).load(function() {
	$('#photoslider').flexslider({
		animation: 'fade',
		controlsContainer: '.flex-container',
		controlNav: false,
		directionNav: false
	});
	$(".prev").click(function() {
		$('#photoslider').flexslider("prev")
	});
	$(".divb").click(function() {
		id = $(this).attr('data-id');
		 $('html,body').animate({
			scrollTop: $("#"+id).offset().top-100
		},
        'slow');
			$("#"+id).addClass('border-color');
		setTimeout(function(){			
			$("#"+id).removeClass('border-color');
		},2000)
	});
	$(".next").click(function() {
		$('#photoslider').flexslider("next")
	});
});
$(".schedule-d").click(function(){
	id	=	$(this).attr("data-id");
	$("#"+id).slideToggle('slow');
	$(this).toggleClass('asc');
	$(this).toggleClass('desc');
});
<?php $this->Html->scriptEnd(); ?>