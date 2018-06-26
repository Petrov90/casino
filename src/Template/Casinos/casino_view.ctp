<script src="../js/jquery.min.js"></script>
<script src="../slick/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="../slick/jquery.bxslider.css" rel="stylesheet" />

<script type="text/javascript">
 var $j = jQuery.noConflict();
 $j(document).ready(function(){
   $j('.bxslider').bxSlider({
        minSlides: 2,
		maxSlides: 2,
		slideWidth: 360,
		slideMargin: 10
   	});
});
</script>
<style type="text/css">
.flexslider .slides > li:first-child {display: block; -webkit-backface-visibility: visible;} 
.bxslider {
	 width: 210% !important;
	}
	.thumbSlide {
    float: left;
    padding: 0 31px;
    position: relative;
    width: 100%;
}
.gambling_INFO_2 {
    border: 1px solid #d9d9d9;
    float: left;
    padding: 10px;
    width: 100%;
}
.gambl
</style>
<!-- <script>
    $(document).ready(function() {
		$("#owl-demo").owlCarousel({
	 navigation : true,
	  pagination : false,
navigationText : ["",""],
			items :2,
			autoHeight : true,
			autoPlay : true,
			transitionStyle:"fade",
			 itemsDesktop : [1199,2],
itemsDesktopSmall : [1024,2],
itemsTablet: [900,1],
itemsTabletSmall: false,
itemsMobile : [640,1],
		});
    });

    </script>

 <script type="text/javascript" src="<?php //WEBSITE_URL?>webroot/js/jquery.flexisel.js"></script> -->
<?php use Cake\Core\Configure;
$rv_cnt  = $casino->review_count;
$on_str = $tw_str = $thr_str = $fr_str = $fv_str = 0;
$rv_cnt_total =$rv_cnt - $rat['zero'];//echo  $rv_cnt_total;die;
$str_rat = array();
if($rv_cnt > 0)
{	//print_r($rat);die;

	$fv_str  = $str_rat[] =  ($rat['five'] * 100)/$rv_cnt_total;
	$fr_str  = $str_rat[] = ($rat['four'] * 100)/$rv_cnt_total;
	$thr_str = $str_rat[] = ($rat['three'] * 100)/$rv_cnt_total;
	$tw_str  = $str_rat[] = ($rat['two'] * 100)/$rv_cnt_total;
	$on_str  = $str_rat[] = ($rat['one'] * 100)/$rv_cnt_total;
	/*foreach ($str_rat as $key => $value) {
		echo $key.'  '.bcdiv($value,1,2).'<br>';
		# code...
	}die;*/
}else {
	$str_rat= array(0, 0, 0, 0, 0);
}
//$casino->slug;
/*$rd_to_cmnt = $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'casino_view','#'=>'rw_div','casino_view'=>$slug]);	*/

if($casino->type == 'normal'){ $cUrl = '#'; ?>
<div class="mid_wrapper">
	<div class="container">
		<div class="brud_crum banner_textblock rev_info col-md-8">
		    <ul>
				   <?php if(isset($casino->city->country->name)){ ?>
	            <li><a href="<?php echo $this->Url->build(array('controller' => 'users','action' => 'country_view','country_view' => $casino->city->country->slug )); ?>"><?php echo $casino->city->country->name; ?></a>
	            <span>/</span></li>
	            <?php  }
	               if(isset($casino->city->name)){ ?>
	            <li><a href="<?php echo $cUrl =  $this->Url->build(array('controller' => 'users','action' => 'city_view','country' => $casino->city->country->slug,'city' => $casino->city->slug)); ?>"><?php echo $casino->city->name; ?></a><span>/</span></li>
	            <?php } ?>
	            <?php if($casino->type == 'online'){ ?>
	            <li><a href="<?php echo $this->Url->build(array('controller' => 'casinos','action' => 'onlineCasino')); ?>">Online Casinos</a><span>></span></li>
	            <?php } ?>
	            <li class="act"><?php echo $casino->title; ?></li>
		    </ul>
            <div class="head-left">
	            <h1 class="topheading"><?php echo $casino->title; ?> Review</h1>
         	    <p class="rank1"><span class="rank">Ranked #<?php echo $position; ?>:</span>
               <?php if(isset($casino->city->name)){  ?><a href="<?php echo $cUrl; ?>"><?php echo $casino->city->name; ?> Casinos</a><?php } ?></a></p>
            </div>
            <!-- userrating question and userrating with star starts from here -->
            <div class="rat-left rank-box">
                <div class="rat_onetext rat_text">
                	<?php /*
                	<span><?php echo $casino->avg_rating;?> User Ratings</span> <span>|</span> <span><?php echo $casino->question_count; ?> Question</span>
                	*/ ?>




                	<div class="dropdown show">
   						<a class="btn btn-secondary dropdown-toggle onln_drp" href="#_" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   						<?php
							 echo $rv_cnt;
  							if($rv_cnt > 1)
  								echo ' Opinions';
  							else
  								echo ' Opinion';
  						?>

   <img  class="oln_img" src="../images/drop_icon_img.png">

  </a><div class="opt_one">
</div>
    <div class="dropdown-menu onln_rv_rat usr1" aria-labelledby="dropdownMenuLink">

    	<?php if($casino->avg_rating) {?>
				    <span class="">User rating: <?php echo $casino->avg_rating.' stars';?>
				    </span>

				    <?php } else {?>
				    <span class="">No user rating  yet
				    </span>
				<?php }?>
				<?php if($casino->avg_rating) {?>
					<table id="histogramTable" class="a-normal a-align-middle a-spacing-base table_bar">
  						<tbody><?php $num_s = 5;
  						foreach ($str_rat as $key => $value) { ?>
							<tr class="a-histogram-row">
	    						<td class="a-nowrap">
	      						<i class="a-size-small">
	        						<?php echo $num_s--;?> star
	      						</i>

	    						</td>
							    <td class="a-span10">
							    <div class="p-bar" newval=<?php echo $value;?> id="land_cas_bar<?php echo $num_s;?>" >
								</div>
							    </td>
							    <td class="a-nowrap">
							    <i class="a-size-small"><?php
							    	//echo bcdiv($value,1,2);
									echo round($value);
							    	?>%</i>
							    </td>
  							</tr>
  						<?php }

  							?>
						    <tr>
						    <td colspan="3" class="bar-head v_al_cas">
						    <!-- <a href="<?php //echo WEBSITE_URL.'casino/'.$casino->slug.'#rw_div'?>">View all opinions</a> -->
						    	<a class="scroll cntr_arow amzn_spc" target="rw_div">View all opinions</a></td>
						    </tr>
                        </tbody>
                    </table>
                    	<?php }?>
  </div>
</div>
                </div>
					<a class="button-rat onln_drp">
							  <?php $fill_rating = 5 - $casino->avg_rating;
							  	$back_rating = floor($fill_rating);
							  	$fill_rating = 5.0 - $fill_rating;
							  	$full_rating = floor($fill_rating);
							  	$half_rating = $fill_rating - $full_rating;
							  	if($full_rating){
							  		for($irat=0; $irat < $full_rating;$irat++) {?>
							  		<img src="<?php echo WEBSITE_URL ?>images/star-on.png"><?php
							  		}
							  	}
							  	if($half_rating){?>
							  		<img src="<?php echo WEBSITE_URL ?>images/star_3.png"><?php
							  	}
							  	if($back_rating){
							  		for($irat=0; $irat < $back_rating;$irat++) {?>
							  		<img src="<?php echo WEBSITE_URL ?>images/star-off.png"><?php
							  		}
							  	}
							  	?>
							 <!--  <p><?php //echo $casino->avg_rating ?></p> -->
						    </a>
			</div>
			<!-- userrating question and userrating with star ends here -->
		</div>
	</div>
	<!-- slider part starts from here -->
	<link href="../css/jquery.lineProgressbar.css" rel="stylesheet" type="text/css">
<div id="html"></div>



<script src="../js/jquery.lineProgressbar.js"></script>
<script>

 var $j = jQuery.noConflict();
$j(document).on('click','#dropdownMenuLink',function(){

  /*	$j('#html').LineProgressbar({
		percentage:80,
		radius: '3px',
		height: '20px',
		fillBackgroundColor: '#DA4453'
	});*/


  	br0 = $j("#land_cas_bar0").attr("newval");
  	br0clr = '';
  	if(br0 > 0) {
  		br0clr = '#aa1d2d';
  	}
	$j('#land_cas_bar0').LineProgressbar({
		percentage:br0,
		fillBackgroundColor: br0clr
	});



  	br1 = $j("#land_cas_bar1").attr("newval");
  	br1clr = '';
  	if(br1 > 0) {
  		br1clr = '#aa1d2d';
  	}
	$j('#land_cas_bar1').LineProgressbar({
		percentage:br1,
		fillBackgroundColor: br1clr
	});


  	br2 = $j("#land_cas_bar2").attr("newval");
  	br2clr = '';
  	if(br2 > 0) {
  		br2clr = '#aa1d2d';
  	}
  	$j('#land_cas_bar2').LineProgressbar({
		percentage:br2,
		fillBackgroundColor: br2clr
	});


  	br3 = $j("#land_cas_bar3").attr("newval");
  	br3clr = '';
  	if(br3 > 0) {
  		br3clr = '#aa1d2d';
  	}
	$j('#land_cas_bar3').LineProgressbar({
		percentage:br3,
		fillBackgroundColor: br3clr
	});


  	br4 = $j("#land_cas_bar4").attr("newval");
  	br4clr = '';
  	if(br4 > 0) {
  		br4clr = '#aa1d2d';
  	}
  	$j('#land_cas_bar4').LineProgressbar({
		percentage:br4,
		fillBackgroundColor: br4clr
	});

});
</script>
	<div class="bgslide-part">
	<div class="slidr_bgpart">
		<div class="container">
			<div class="row">
		 		<div class="col-md-8">
		 			<div class="slider-part"> <?php
		 		  		if(!empty($casinoImage)){ ?>
		 		  		<!-- slider images and background slider start here -->
               			<div class="detail_banner">
                    		<div class="flexslider banner_slide"  id="photoslider" >
	                        <ul class="slides">
		                        <?php
								$show = true;
								$img_num = 0;
		                           foreach($casinoImage as $image)
		                           {
		                           	if(!empty($image->file) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$image->file)){  $show = false;
		                           		$img_num++;
		                           		if($img_num == 1){
		                           			$bgimgurl = $image->file;
										}
		                           		?>

										<li class="h390">
										   <?php echo $this->Html->image(CASINO_FULL_IMG_URL.$image->file,['class' => 'img-responsive','alt' => 'Image']); ?>
										</li>
		                        <?php
									}
		                           }
								if($show) {

     		if(!empty($dfImg)) {
										$r_val =  rand(0,count($dfImg)-1);
										$d_file = $dfImg[$r_val]; ?>

										<li class="h390">
										   <?php echo $this->Html->image(CASINO_FULL_IMG_URL.$d_file,['class' => 'img-responsive','alt' => 'Image']); ?>
										</li>

									<?php }else{ ?>
										<li class="h390">
				                           <?php echo $this->Html->image(NO_CASINO_IMG,['class' => 'img-responsive','alt' => 'Image']); ?>
				                        </li>

								<?php 	}


									?>

			                        <style type="text/css">
				 						.bgslide-part{width: 100%; float: left; background: url(../img/casino2-01.png) no-repeat; background-size: cover;
				 						/* padding: 20px 0 20px 0;*/
				 							padding:30px 0px !important;
				 					}
				 					</style> <?php
								} ?>
	                     	</ul>
<?php if($show) { ?>
	                     	<div class="slide_btn"><a href="javascript:void(0);" data-type="casino" data-id="<?php echo $casino->id; ?>" class="addBtn add-photos-click"><i class="fa fa-camera"></i>Add a Photo</a></div>
<?php }?>

                  			</div><?php

                  			if($casinoImage->count() > 1){ ?>
			                  <span class="left-span"><a href="javascript:void(0);" class="prev"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>left-arrow.png" class="img-responsive" /></a></span>
			                  <span class="right-span"><a href="javascript:void(0);" class="next"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>right-arrow.png" class="img-responsive" /></a></span> <?php
			                } ?>
	            		</div><!-- background image and slider end here --><?php
		            	} ?>
		            	<!--add2favorite,remove from favorite and thumb with choice strts-->
						<div class="ratingbox slider-rat">
							<div class="edit edit_2 edit3" id="mycasinolink">
								<?php if($setCasino == 'no') { ?>
				                  <a href="javascript:void(0);" casino_uid ="<?php echo $casino_Uid;?>" data-status="no" data-casinotype="normal" id="casinolink" data-name="<?php echo $casino->title; ?>" data-type="casino" data-casid="<?php echo $casino->id; ?>" class="city1-click add-rvw-btn"><img src="<?php echo WEBSITE_IMG_URL; ?>fav_unfav.png" alt="img">Add to Favorites</a>
				                <?php } else {?>
				                  <a href="javascript:void(0);" casino_uid =<?php echo $casino_Uid;?> data-status="yes" data-casinotype="normal" id="casinolink" data-name="<?php echo $casino->title; ?>" data-type="casino" data-casid="<?php echo $casino->id; ?>" class="city1-click add-rvw-btn"><img src="<?php echo WEBSITE_IMG_URL; ?>fav_unfav.png" alt="img">Remove from Favorites</a>
				                <?php } ?>
	                		</div>
					    	<div class="rat-right thumb_box">
								<?php $rating_txt ='';
							   	if( ($casino->avg_rating > 3.0) &&($casino->avg_rating <= 4.0)) {$rating_txt = 'Good Choice';
							   	}elseif(($casino->avg_rating > 4) &&($casino->avg_rating < 5)){
									$rating_txt = 'Excellent Choice';
							   	}elseif( ($casino->avg_rating ==5)){
									$rating_txt = 'Best Choice';
							   	}
							   	?>
								  <h3><?php echo $rating_txt;?></h3>
							  <?php if( $casino->avg_rating > 3) {?><img src="<?php echo WEBSITE_URL ?>images/thumb-left.png"/><?php }?>
					    	</div>
						</div><!--add2fav,remfavorite and thumb with choice ends-->
			 		</div><!--slider with fav ends here-->
			 	</div>
				<?php
			 	if(!$show) { ?>
			 		<style type="text/css">
			 			.bgslide-part{width: 100%; float: left; background: url('../files/<?php echo  $bgimgurl?>') no-repeat  scroll center center / cover;
			 			 /*padding: 20px 0 30px 0;*/
			 			 padding: 30px 0 !important;
			 			}
			 		</style><?php
			 		} ?>
		 		<div class="col-md-4">
					<div class="block-1 bestPmnt block_4 bk4">
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
		                        } ?>
	                        </a>
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
	                  	<div class="play-now play">
	                  		<a data-title="<?php echo $mainPromotions->casino->title ?>" data-url="<?php echo $mainPromotions->casino->slug ?>"  <?php echo NEWTAB ?> rel="nofollow" class="btn red_btn btn1" href="<?php  echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $mainPromotions->slug)); ?>">Play now!
	                  		</a>
	                  	</div>
	                </div>
		 		</div>
		 	</div>
		</div>
	</div>
	</div>
 <div class="casino_desc">
		 <div class="container">
		<div class="col-md-8">
			<div class="edit update_cas">
	            <a href="javascript:void(0);" data-type="casino" data-id="<?php echo $casino->id; ?>" class="edit_info_details"><img src="../images/edit-info.png">Edit Info</a>
	            <a href="javascript:void(0);" data-name="<?php echo $casino->title; ?>" data-type="casino" data-id="<?php echo $casino->id; ?>" class="city-click addBtn_rating add-rvw-btn "><img src="../images/ad-review.png"> Add Review</a>
				<a href="javascript:void(0);" data-type="casino" data-id="<?php echo $casino->id; ?>" class="add-photos-click"><img src="../images/ad-photo.png">Add Photos</a>
	        </div><?php $tot = array_sum($rat); ?>
		</div>
         <div class="row">
            <div class="col-md-8">

				<div class="description">
					<div class="titl detil_title">
					   <span class="title-head">Casino Description</span>
					</div>
				   <div><?php echo $this->App->force_balance_tags($casino->description); ?></div>
				</div>
				<?php if(!empty($casino->range_of_games)){ ?>

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
						    <li> <?php
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
						    <li> <?php
								if(!empty($casino->contact_phone)){
									$contact_phone 	=	$casino->contact_phone; ?>
									<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Phone-min.png" /><span><?php echo $contact_phone ?></span></div><?php
								}
								if(!empty($casino->contact_twitter)){
									$contact_twitter 	=	$casino->contact_twitter;
									if (false === strpos($contact_twitter, '://')) {
										$contact_twitter = 'http://' . $contact_twitter;
									} ?>
									<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Twitter-min.png" /><a target="blank" href="<?php echo $contact_twitter ?>">Twitter</a></div><?php
								} ?>
						    </li>
						    <li>	<?php
						        $cas_email = $casino->contact_email;
								if(!empty($casino->table_games)){
									$table_games 	=	$casino->table_games;  ?>
									<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Table-games-min.png" /><span>Table Games: <?php echo $table_games; ?></span></div>
								<?php }
								if(!empty($cas_email)){
									$contact_email 	=	$casino->contact_email;  ?>
									<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Email-min.png" /><span><a href="mailto:<?php echo $casino->contact_email; ?>">Email</a></span></div>
								<?php }/* else {
									$contact_email 	=	'';?>
									<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Email-min.png" /><span><a href="<?php echo $contact_email; ?>">Email</a></span></div>
										<?php
									}*/ ?>
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
							<li class="schedule-li"><?php $contact_schedule	=	json_decode($casino->contact_schedule,true);
								$schdl = $contact_schedule;
								//echo '<pre>';print_r($schdl);
								$entr = false;
								if(!empty($schdl)){
								 	if($schdl['all_day'] ==1){
									 	$entr = true;
								 	}
								 	unset($schdl['all_day']);
								 	$day_cnt = 0;
								 	foreach ($schdl as $key) {
								 		if($key['all_day'] == 1) {
								 			$day_cnt++;
								 			$entr = true;
								 		}
								 		if( ( !empty($key['from']) && !empty($key['from']) )  ){
								 			$entr = true;
								 		}
								 	}
								}
							 	$showSch = false;
								if($entr){ ?>
									<?php
									if( ($contact_schedule['all_day'] == 1) || ($day_cnt == 7) ){ ?>
									<div class="col">
									   <img src="<?php echo WEBSITE_IMG_URL ?>Horario-min.png" /><?php

										$schedule	=	Configure::read('weekday');
											$showSch = true; ?>
											<span class="opn_hrs1">Opening Hours:
											</span>
											<ul id="hh1" class="ul_cls1" style="">
												<li><span class="pull-right">24/7</span></li>
											</ul>
									</div>		<?php
									}else{ unset($contact_schedule['all_day']); ?>
										<img src="<?php echo WEBSITE_IMG_URL ?>Horario-min.png" />
										<span>
											<a data-id="hh1" title="Click to view" class="schedule-d asc" href="javascript:void(0);">Opening Hours</a>
										</span>
								  		<ul id="hh1" class="tel_info schedule_ul shedulebar " style="display: none;"><?php
											foreach($contact_schedule as $key=>$val){
												$frmto = true;
												if($val['all_day'] == 1){
													$showSch = true;$frmto = false; ?>
													<li><span><?php echo Configure::read('weekday.'.$key); ?></span>
														<span>Open 24Hr</span>
													</li><?php
												}
												elseif( !empty($val['from']) && !empty($val['to']) && $frmto){
													 $showSch = true; ?><li>
													<span><?php echo Configure::read('weekday.'.$key); ?></span>
														<span ><?php echo $val['from']; ?>/<?php echo $val['to']; ?>
														</span></li><?php
											    }

											} ?>
										</ul><?php
									}
									if(!$showSch){	echo "Not Added";
									}
								}?>
							</li>
							<li><?php
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
								$schdl = $poker_schedule;
								$entr = false;;
								if(!empty($schdl)){
								 	if($schdl['all_day'] ==1){
									 	$entr = true;
								 	}
								 	$day_cnt = 0;
								 	unset($schdl['all_day']);
								 	foreach ($schdl as $key) {
								 		if($key['all_day'] == 1){
								 			$day_cnt++;
								 			$entr = true;
								 		}
								 		if( ( !empty($key['from']) && !empty($key['from']) )  ){
								 			$entr = true;
								 		}
								 	}
								}
						 	$showSch = false;
							if($entr){ ?>
								<?php
								if( ($poker_schedule['all_day'] == 1) || ($day_cnt == 7) ){ ?>
								<div class="col poker_div_showSch">
								   <img src="<?php echo WEBSITE_IMG_URL ?>Horario-min.png" /><?php
									$schedule	=	Configure::read('weekday');
										$showSch = true;
										$poker_div  = true; ?>
										<span class="opn_hrs1">Opening Hours:
										</span>
										<ul id="hh1" class="ul_cls1" style="">
											<li><span class="pull-right">24/7</span></li>
										</ul>
								</div>		<?php
								}else{ unset($poker_schedule['all_day']); ?>
									<img src="<?php echo WEBSITE_IMG_URL ?>Horario-min.png" />
									<span>
										<a data-id="hh2" title="Click to view" class="schedule-d asc" href="javascript:void(0);">Opening Hours
										</a>
									</span>

							  		<ul id="hh2" style="display:none" class="shedulebar tel_info schedule_ul"><?php
										foreach($poker_schedule as $key=>$val){
											$frmto = true;
											if($val['all_day'] == 1){
												$showSch = true;
												$poker_div = true;
												$frmto = false; ?>
												<li><span><?php echo Configure::read('weekday.'.$key); ?></span>
													<span>Open 24Hr</span>
												</li><?php
											}
											elseif( !empty($val['from']) && !empty($val['to']) && $frmto){
												 $showSch = true; ?><li>
												<span><?php echo Configure::read('weekday.'.$key); ?></span>
													<span ><?php echo $val['from']; ?>/<?php echo $val['to']; ?>
													</span></li><?php
										    }

										} ?>
									</ul><?php
								}

							} ?>
							</li>
							<li> <?php
								if(!empty($casino->poker_email)){
									$poker_div     = true;
									$poker_email 	=	$casino->poker_email;
									 ?>
									<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Email-min.png" /><span><a href="mailto:<?php echo $poker_email; ?>">Email</a></span></div>
								<?php }?>

							</li>
						</ul> <?php
					    if(!$poker_div){
							$this->Html->scriptStart(array('block' => 'custom_script')); ?>
							$(".poker_div").remove();<?php
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
							<li> <?php
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
						 	<li> <?php
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
						    <li><?php
						   	   $bo_schedule =json_decode($casino->bo_schedule,true);
								$schdl = $bo_schedule;
								$entr = false;
								if(!empty($schdl)){
								 	if($schdl['all_day'] ==1){
									 	$entr = true;
								 	}
								 	unset($schdl['all_day']);
					 				$day_cnt = 0 ;
								 	foreach ($schdl as $key) {
								 		if($key['all_day'] == 1){
					 						$day_cnt++;
					 						$entr = true;
								 		}
								 		if( ( !empty($key['from']) && !empty($key['from']) )  ){
								 			$entr = true;
								 		}
								 	}
								}

						 	$showSch = false;
							if($entr){ ?>
								<?php
								if( ($bo_schedule['all_day'] == 1)|| ($day_cnt == 7) ){ ?>
								<div class="col bo_d_showSch">
								   <img src="<?php echo WEBSITE_IMG_URL ?>Horario-min.png" /><?php
									$schedule	=	Configure::read('weekday');
										$showSch = true;
										$bo_d  = true; ?>
										<span class="opn_hrs1">Opening Hours:
										</span>
										<ul id="hh1" class="ul_cls1" style="">
											<li><span class="pull-right">24/7</span></li>
										</ul>
								</div>		<?php
								}else{ unset($bo_schedule['all_day']); ?>
									<img src="<?php echo WEBSITE_IMG_URL ?>Horario-min.png" />
									<span>
										<a data-id="hh3" title="Click to view" class="schedule-d asc" href="javascript:void(0);">Opening Hours
										</a>
									</span>

							  		<ul id="hh3" style="display:none" class="shedulebar tel_info schedule_ul"><?php
										foreach($bo_schedule as $key=>$val){
											$frmto = true;
											if($val['all_day'] == 1){
												$showSch = true;
												$bo_d  = true;
												$frmto = false; ?>
												<li><span><?php echo Configure::read('weekday.'.$key); ?></span>
													<span>Open 24Hr</span>
												</li><?php
											}
											elseif( !empty($val['from']) && !empty($val['to']) && $frmto){
												 $showSch = true;
												 $bo_d  = true; ?><li>
												<span><?php echo Configure::read('weekday.'.$key); ?></span>
													<span ><?php echo $val['from']; ?>/<?php echo $val['to']; ?>
													</span></li><?php
										    }

										} ?>
									</ul><?php
								}

							} ?>
						    </li>
						    <li> <?php
								if(!empty($casino->bo_email)) {
									$bo_d	=	true;
									$bo_email =	$casino->bo_email; ?>
									<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Email-min.png" />
										<span><a href="mailto:<?php echo $bo_email; ?>">Email</a>
										</span>
									</div> <?php
								} ?>
						    </li>
					    </ul>	<?php

						if(!$bo_d){
							$this->Html->scriptStart(array('block' => 'custom_script')); ?>
							$(".bo_d").remove(); <?php
							$this->Html->scriptEnd();
						}else {
							if(!$showSch){
								$this->Html->scriptStart(array('block' => 'custom_script')); ?>
								$(".bo_d_showSch").remove(); <?php
								$this->Html->scriptEnd();
							}
						} ?>

						<span class="hading_h2 grp_sale_div">Group Sales</span>
					    <ul class="casino_detInfo cont-info grp_sale_div">
						<li> <?php
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
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Facebook-min.png" /><span><a target="blank" href="<?php echo $gs_facebook; ?>">Facebook</a></span></div><?php
							} ?>
						</li>
						<li> <?php
							if(!empty($casino->gs_ph)){ $grp_sale_div	=	true;
								$gs_ph 	=	$casino->gs_ph;  ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Phone-min.png" /><span><?php echo $gs_ph; ?></span>
								</div> <?php
							}
							if(!empty($casino->gs_tw)){ $grp_sale_div	=	true;
								$gs_tw 	=	$casino->gs_tw;
								if (false === strpos($gs_tw, '://')) {
									$gs_tw = 'http://' . $gs_tw;
								} ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Twitter-min.png" /><a target="blank" href="<?php echo $gs_tw; ?>">Twitter</a>
								</div> <?php
							} ?>
						</li>
						<li> <?php
						    $gs_schedule = json_decode($casino->gs_schedule,true);
							$schdl = $gs_schedule;
							$entr = false;
							if(!empty($schdl)){
							 	if($schdl['all_day'] ==1){
								 	$entr = true;
							 	}
							 	unset($schdl['all_day']);
							 	$day_cnt = 0;
							 	foreach ($schdl as $key) {
				 					if($key['all_day'] == 1){
		 								$day_cnt++;
		 								$entr = true;
				 					}
							 		if( ( !empty($key['from']) && !empty($key['from']) )  ){
							 			$entr = true;
							 		}
							 	}
							}
						 	$showSch = false;
							if($entr){ ?>
								<?php
								if( ($gs_schedule['all_day'] == 1) || ($day_cnt == 7) ){ ?>
								<div class="col grp_sale_div_showSch">
								   <img src="<?php echo WEBSITE_IMG_URL ?>Horario-min.png" /><?php
									$schedule	=	Configure::read('weekday');
										$showSch = true;
										$grp_sale_div  = true; ?>
										<span class="opn_hrs1">Opening Hours:
										</span>
										<ul id="hh1" class="ul_cls1" style="">
											<li><span class="pull-right">24/7</span></li>
										</ul>
								</div>		<?php
								}else{ unset($gs_schedule['all_day']); ?>
									<img src="<?php echo WEBSITE_IMG_URL ?>Horario-min.png" />

									<span>
										<a data-id="hh4" title="Click to view" class="schedule-d asc" href="javascript:void(0);">Opening Hours
										</a>
									</span>
							   		<ul id="hh4" style="display:none" class="shedulebar tel_info schedule_ul"> <?php
										foreach($gs_schedule as $key=>$val){
											$frmto = true;
											if($val['all_day'] == 1){
												$showSch = true;
												$grp_sale_div  = true;
												$frmto = false; ?>
												<li><span><?php echo Configure::read('weekday.'.$key); ?></span>
													<span>Open 24Hr</span>
												</li><?php
											}
											elseif( !empty($val['from']) && !empty($val['to']) && $frmto){
												$showSch = true;
												$grp_sale_div  = true; ?>
												<li>
													<span><?php echo Configure::read('weekday.'.$key); ?>      </span>
													<span ><?php echo $val['from']; ?>/<?php echo $val['to']; ?>
													</span>
												</li><?php
										    }

										} ?>
									</ul><?php
								}

							} ?>
						</li>
						<li><?php
							if(!empty($casino->gs_email)){
								$grp_sale_div	=	true;
								$gs_email 	=	$casino->gs_email;
								 ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Email-min.png" /><span><a href="mailto:<?php echo $gs_email; ?>">Email</a></span></div>	<?php
							} ?>
					    </li>
					</ul>   <?php

					if(!$grp_sale_div) {
						$this->Html->scriptStart(array('block' => 'custom_script')); ?>
						$(".grp_sale_div").remove(); <?php
						$this->Html->scriptEnd();
					}else{
						if(!$showSch){
							$this->Html->scriptStart(array('block' => 'custom_script')); ?>
							$(".grp_sale_div_showSch").remove(); <?php
							$this->Html->scriptEnd();
						}
					} ?>

					<span class="subtitle-head cont-info Conferences">Conferences</span>
					<ul class="casino_detInfo cont-info Conferences">
						<li><?php
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
						<li> <?php
							if(!empty($casino->cf_ph)){ $Conferences	=	true;
								$cf_ph 	=	$casino->cf_ph;  ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Phone-min.png" /><span><?php echo $cf_ph; ?></span>
								</div> <?php
							}
							if(!empty($casino->cf_tw)) {
								$Conferences	=	true;
								$cf_tw 	=	$casino->cf_tw;
								if (false === strpos($cf_tw, '://')) {
									$cf_tw = 'http://' . $cf_tw;
								} ?>
								<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Twitter-min.png" />
									<a target="blank" href="<?php echo $cf_tw; ?>">Twitter</a>
								</div> <?php
							} ?>
						</li>
						<li><?php
							$cf_schedule = json_decode($casino->cf_schedule,true);
							$schdl = $cf_schedule;
							$entr = false;
							if(!empty($schdl)){
							 	if($schdl['all_day'] ==1){
								 	$entr = true;
							 	}
							 	unset($schdl['all_day']);
							 	$day_cnt = 0;
							 	foreach ($schdl as $key) {
									if($key['all_day'] == 1){
 										$day_cnt++;
 										$entr = true;
									}
							 		if( ( !empty($key['from']) && !empty($key['from']) )  ){
							 			$entr = true;
							 		}
							 	}
							}
						 	$showSch = false;

							if($entr){ ?>
								<?php
								if( ($cf_schedule['all_day'] == 1) ||($day_cnt == 7) ){ ?>
								<div class="col Conferences_showSch">
							   		<img src="<?php echo WEBSITE_IMG_URL ?>Horario-min.png" /><?php
									$schedule	=	Configure::read('weekday');
										$showSch = true;
										$Conferences  = true; ?>
										<span class="opn_hrs1">Opening Hours:
										</span>
										<ul id="hh1" class="ul_cls1" style="">
											<li><span class="pull-right">24/7</span></li>
										</ul>
								</div>		<?php
								}else{ unset($cf_schedule['all_day']); ?>
									<img src="<?php echo WEBSITE_IMG_URL ?>Horario-min.png" />

									<span>
										<a data-id="hh5" title="Click to view" class="schedule-d asc" href="javascript:void(0);">Opening Hours
										</a>
									</span>
							   		<ul id="hh5" style="display:none" class="shedulebar tel_info schedule_ul"> <?php
										foreach($cf_schedule as $key=>$val){
											$frmto = true;
											if($val['all_day'] == 1){
												$showSch = true;
												$Conferences  = true;
												$frmto = false; ?>
												<li><span><?php echo Configure::read('weekday.'.$key); ?></span>
													<span>Open 24Hr</span>
												</li><?php
											}
											elseif( !empty($val['from']) && !empty($val['to']) && $frmto){
												$showSch = true;
												$Conferences  = true; ?>
												<li>
													<span><?php echo Configure::read('weekday.'.$key); ?>      </span>
													<span ><?php echo $val['from']; ?>/<?php echo $val['to']; ?>
													</span>
												</li><?php
										    }

										} ?>
									</ul><?php
								}

							} ?>
							</li>
							<li><?php
								if(!empty($casino->cf_em)) {
									$Conferences	=	true;
								    $cf_em 	=	$casino->cf_em; ?>
									<div class="col"><img src="<?php echo WEBSITE_IMG_URL ?>Email-min.png" />
										<span><a href="mailto:<?php echo $cf_em; ?>">Email</a>
										</span>
									</div> <?php
								} ?>
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

				<?php $activitieData = $casino->casino_activity_datas;
					$casino_activity_data = array();
					foreach($activitieData as $activitie){
						$casino_activity_data[$activitie->parent_master->title][]	=	$activitie;
					}
			// links(Hotels, Food and Beverages, Activities and Services)starts here
				/*	 if(!empty($casino_activity_data)){ ?>
					<div class="Amenities ament_info AmenitInfo2">

					  <?php foreach($casino_activity_data as $key12 => $casino_activity_datas1){
 ?>
					  <div class="ament_post">
							<div>
								 <span><?php echo $key12; ?></span>
								 <ul class="">
								<?php foreach($casino_activity_datas1 as $key1 => $casino_activity_datas){ ?>
									<li><img src="../images/check.png"><a class="divb" href="javascript:void(0)" data-id="<?php echo md5($casino_activity_datas->casino_activity->title); ?>"><?php echo $casino_activity_datas->casino_activity->title; ?></a></li>
								<?php } ?>
								 </ul>
							</div>
					  </div>
					  <?php } ?>
				   </div>
<?php 			}
				*/
			// links(Hotels, Food and Beverages, Activities and Services)ends here
?>

				   </div>
				</div>
				<!--<div class="titl">
						<h3 class="title-head">Amenitie</h3>
					  </div>
				ranges of games start from here
					   -->
					 <?php

	if(!empty($casino->casino_gambling_options)) { ?>
	<div class="gambling ">
                <div class="gamble_option gambling_INFO_2">
                    <div class="titl tit_slide">
                       <h3>Range of Games</h3>
                    </div>
					<div class="description">
			<div><?php echo $this->App->force_balance_tags($casino->range_of_games); ?></div>
			</div>
			<div class="kpkp">
				<div id="allcarousel" class="carousel-box thumbSlide">
					<div class="thumbNav">
					</div>
				<ul class="bxslider">
					 <?php  foreach($casino->casino_gambling_options as $casino_gambling_options) {
					  ?>
						  	<li>
						  		<div class="round round_2">
							<div class="img_round img_round_2">
							<?php if(file_exists((AMENITIES_ROOT_PATH.$casino_gambling_options->master->image))){ ?>
							<img src="<?php echo WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.AMENITIES_IMG_URL.$casino_gambling_options->master->image ?>" class="img-responsive" alt="img"/>
							<?php } ?>
							</div>
							<h3><?php echo $casino_gambling_options->master->name ?></h3>
							</div>
                     		</li>
					<?php } ?>
				</ul>
				</div>
                </div>
            </div>

         <!--  </div>-->

                </div>
	<?php
	}
/*Hotels, Food and Beverages, Activities and Services start here*/
	foreach($casino_activity_data as $key12 => $casino_activity_datas1){ ?>
		<div class="Activities_info">
			<div class="Active_post">
		   		<span class="title-head"><?php echo $key12; ?></span>
					<div class="block"><?php
							// pr($casino_activity_datas1);
						foreach($casino_activity_datas1 as $key1 => $casino_activity_datas) {
							$schedule =	array();
							$iid = md5($key1.$key12);	?>
							  	<div class="Active_col" id="<?php echo md5($casino_activity_datas->casino_activity->title); ?>">
									<span class="subtitle-head"><?php echo $casino_activity_datas->casino_activity->title; ?>
									</span> <?php
									if(!empty($casino_activity_datas->casino_activity->description)){ ?>
										<div><?php echo $casino_activity_datas->casino_activity->description; ?>
										</div><?php
									} ?><?php
									if(!empty($casino_activity_datas->casino_activity->casino_images)){ ?>
										<div class="detail_banner acte_slider">
									  		<div class="flexslider banner_slide" id="photoslider<?php echo $iid; ?>">
										 		<ul class="slides"><?php
											$show = true;
											    foreach($casino_activity_datas->casino_activity->casino_images as $image) {
													if(file_exists(CASINO_FULL_IMG_ROOT_PATH.$image->file)){
														 $show=false; ?>
														<li class="h_auto11">
														   <?php echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=718px&height=359px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$image->file,['class' => 'img-responsive','alt' => 'Image']); ?>
														</li><?php
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
									  		</div><?php
									  		if(isset($casino_activity_datas->casino_activity->casino_images[1]))
									  		{ ?>
										  		<span class="left-span"><a href="javascript:void(0);" class="prev<?php echo $key1.$key12; ?>"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>left-arrow.png" class="img-responsive" /></a></span>
											    <span class="right-span"><a href="javascript:void(0);" class="next<?php echo $key1.$key12; ?>"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>right-arrow.png" class="img-responsive" /></a>
											    </span><?php
											} ?>
								        </div><?php
								    } ?>
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
											} ?></span></li><?php
										}
									} ?>
									</ul><?php
									if(!empty($casino_activity_datas->casino_activity->schedule)){
										$schedule = unserialize($casino_activity_datas->casino_activity->schedule);
										$act_schdl = $schedule;
										unset($act_schdl['all_day']);
										$day_cnt = 0;
										foreach ($act_schdl as $ac_key => $ac_value) {
											if($ac_value['all_day'] == 1)
											    $day_cnt++;
										}
										$ul_cls = "shw_hrs";
										$a_cls ="";
										$showSch	=	false;
										if( ($casino_activity_datas->casino_activity->all_day == 1) || ($day_cnt ==7) ){
											$schedule	=	Configure::read('weekday');
											$showSch = true; ?>
											<span id="showSch<?php echo $iid; ?>">
											<?php echo $this->Html->image(WEBSITE_IMG_URL.'timer.png'); ?>
												<span class="opn_hrs">Opening Hours:</span>
											</span>
											<ul class="<?php echo $ul_cls;?>" id="openhour<?php echo $iid; ?>" >

											<li><span class="pull-right">24/7</span></li><?php
										/*foreach($schedule as $key => $val){ $showSch = true; ?>
											<li><span><?php echo $val; ?></span><p>Open 24Hr</p></li>
										<?php
										}*/
										}else{?>
											<span class="hide" id="showSch<?php echo $iid; ?>"><?php echo $this->Html->image(WEBSITE_IMG_URL.'timer.png'); ?>
												<a data-id="openhour<?php echo $iid; ?>" title="Click to view" class="schedule-d asc" href="javascript:void(0);">Opening Hours
												</a>
									 		</span>
									 		<ul class="tel_info schedule_ul shedulebar" id="openhour<?php echo $iid; ?>" style="display:none"><?php
											foreach($schedule as $key => $val){

												$frmto = true;
												if($val['all_day'] == 1){
													$showSch = true;
													$frmto = false; ?>
													<li><span><?php echo Configure::read('weekday.'.$key); ?></span>
														<p>Open 24Hr</p>
													</li><?php
												}
												elseif( !empty($val['from']) && !empty($val['to']) && $frmto){
													$showSch = true; ?>
													<li>
														<span><?php echo Configure::read('weekday.'.$key); ?>      </span>
														<p><?php echo $val['from']; ?>/<?php echo $val['to']; ?>
														</p>
													</li><?php
											    }

/*
											if((!empty($val['from']) && !empty($val['to']))){
												$showSch = true; ?>
												<li>
													<span><?php echo Configure::read('weekday.'.$key); ?>
													</span><?php
													if($val['all_day'] == 1){ ?>
														<p>Open 24Hr</p><?php
													}else { ?>
														<p><?php
														echo $val['from']; ?>/<?php echo $val['to']; ?>
														</p><?php
													} ?>
												</li><?php
											} */

											}
										} ?>
									</ul><?php
								} ?>
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
               <?php echo $this->element('normal_casino_sidebar'); ?>
            </div>
			</div>
		</div>
	 </div>
  </div>
<?php }else{ ?>
<div class="mid_wrapper">
    <div class="container">
        <div class="brud_crum banner_textblock rev_info col-md-8">
         	<ul>
            	<li><a href="<?php echo $this->Url->build(array('controller' => 'casinos','action' => 'onlineCasino')); ?>">Online Casinos</a><span>></span></li>
            	<li class="act"><?php echo $casino->title; ?></li>
         	</ul>
         	<div class="head-left">
	            <h1 class="topheading"><?php echo $casino->title; ?> Review</h1>
	            <p class="rank1"><span class="rank">Ranked #<?php echo $position;?>: <a href="<?php echo WEBSITE_URL?>online-casinos">Online Casinos</a></span></p>
            </div>
			<div class="rat-left rank-box">
                <div class="rat_text">
                	<?php
   				/*
				$rd_to_cmnt = $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','#'=>'rw_div','casino_view'=>$casino->slug]);*/
					/*echo WEBSITE_URL.'online-casinos/'.$casino->slug.'#rw_div';*/
                	/*
                	<span><?php echo $casino->avg_rating;?> User Ratings</span> <span>|</span> <span><?php echo $casino->question_count; ?> Question</span>
                	*/ ?>
                	<div class="dropdown show">
  						<a class="btn btn-secondary dropdown-toggle onln_drp" href="#_" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php
                         $rv_cnt1 = $rv_cnt + 1;
  						 echo $rv_cnt1;
  							if($rv_cnt1 > 1)
  								echo ' Opinions';
  							else
  								echo ' Opinion';
  						?> <img class="oln_img" src="../images/drop_icon_img.png">
  						</a>
					  <div class="dropdown-menu onln_rv_rat" aria-labelledby="dropdownMenuLink">
					 <div class="usr1">
					  <span class="onlncas_usr">Our rating:<?php echo ' '.$casino->our_rating.' stars';?></span>


					 </div>

					 <table id="histogramTable" class="a-normal a-align-middle a-spacing-base table_bar">
  						<tbody>
							<tr class="a-histogram-row">
	    						<td class="a-nowrap">
	      						<i class="a-size-small">
	        						<?php echo $casino->our_rating;?> star
	      						</i>

	    						</td>
							    <td class="a-span10">
							     <div class="p-bar" newval=100 id="onln_ourrt"><!-- <span class="bar_bg" style="width:100%"> </span> -->
								</div>
							    </td>
							    <td class="a-nowrap">
							    <i class="a-size-small"><?php
							    	//echo bcdiv($value,1,2);
									/*echo round(
										$casino->avg_rating/$value);*/
							    	?>100%</i>
							    </td>
  							</tr>

								<tr>
						    <td colspan="3" class="bar-head center v_al_cas usr1">
						    <hr>
						    <?php if($casino->member_rating) {?>
						    <span class="">User rating: <?php echo $casino->member_rating.' stars';?>
						    </span>

						    <?php } else {?>
						    <span class="">No user rating  yet
						    </span>
						    <?php }?>

						    </td>
						    </tr>
  						<?php $num_s = 5;
                    if($casino->member_rating) {
  						foreach ($str_rat as $key => $value) { ?>
							<tr class="a-histogram-row">
	    						<td class="a-nowrap">
	      						<i class="a-size-small">
	        						<?php echo $num_s--;?> star
	      						</i>

	    						</td>
							    <td class="a-span10">
							 <!--<div class="p-bar"><span class="<?php //if($value) echo 'bar_bg'?>" style="width:<?php //echo $value;?>%"> </span>
								</div>-->
								<div class="p-bar" newval=<?php echo $value;?> id="land_cas_bar<?php echo $num_s;?>" >
							     	<!-- <span class="<?php// if($value) echo 'bar_bg'?>" newval=<?php //echo $value;?> id="land_cas_bar<?php //echo $num_s;?>" >
							     	</span> -->
								</div>
							    </td>
							    <td class="a-nowrap">
							    <i class="a-size-small"><?php
							    	//echo bcdiv($value,1,2);
									echo round($value);
							    	?>%</i>
							    </td>
  							</tr>
  						<?php }

  							?>
						    <tr>
						    <td colspan="3" class="bar-head v_al_cas">
						    <a  class="amzn_spc" href="<?php echo WEBSITE_URL.'online-casinos/'.$casino->slug.'#onln_rw'?>">View all opinions</a></td>
						    </tr>
					<?php }?>
                        </tbody>
                    </table>



					  </div>
					</div>
                </div>
				<a class="button-rat onln_drp">
				  <?php $fill_rating = 5 - $casino->avg_rating;
				  	$back_rating = floor($fill_rating);
				  	$fill_rating = 5.0 - $fill_rating;
				  	$full_rating = floor($fill_rating);
				  	$half_rating = $fill_rating - $full_rating;
				  	if($full_rating){
				  		for($irat=0; $irat < $full_rating;$irat++) {?>
				  		<img src="<?php echo WEBSITE_URL ?>images/star-on.png"><?php
				  		}
				  	}
				  	if($half_rating){?>
				  		<img src="<?php echo WEBSITE_URL ?>images/star_3.png"><?php
				  	}
				  	if($back_rating){
				  		for($irat=0; $irat < $back_rating;$irat++) {?>
				  		<img src="<?php echo WEBSITE_URL ?>images/star-off.png"><?php
				  		}
				  	}
				  	?>
					<!--  <p><?php// echo $casino->avg_rating ?></p> -->
				</a>
			</div>
      	</div>
   </div>

	<!-- online slider part starts from here -->

<link href="../css/jquery.lineProgressbar.css" rel="stylesheet" type="text/css">
<div id="html"></div>


<script src="../js/jquery.lineProgressbar.js"></script>
<script>

 var $j = jQuery.noConflict();
$j(document).on('click','#dropdownMenuLink',function(){

  /*	$j('#html').LineProgressbar({
		percentage:80,
		radius: '3px',
		height: '20px',
		fillBackgroundColor: '#aa1d2d'
	});*/

	$j('#onln_ourrt').LineProgressbar({
		percentage:100,
		fillBackgroundColor: '#aa1d2d'
	});

  	br0 = $j("#land_cas_bar0").attr("newval");
  	br0clr = '';
  	if(br0 > 0) {
  		br0clr = '#aa1d2d';
  	}
	$j('#land_cas_bar0').LineProgressbar({
		percentage:br0,
		fillBackgroundColor: br0clr
	});



  	br1 = $j("#land_cas_bar1").attr("newval");
  	br1clr = '';
  	if(br1 > 0) {
  		br1clr = '#aa1d2d ';
  	}
	$j('#land_cas_bar1').LineProgressbar({
		percentage:br1,
		fillBackgroundColor: br1clr
	});


  	br2 = $j("#land_cas_bar2").attr("newval");
  	br2clr = '';
  	if(br2 > 0) {
  		br2clr = '#aa1d2d';
  	}
  	$j('#land_cas_bar2').LineProgressbar({
		percentage:br2,
		fillBackgroundColor: br2clr
	});


  	br3 = $j("#land_cas_bar3").attr("newval");
  	br3clr = '';
  	if(br3 > 0) {
  		br3clr = '#aa1d2d';
  	}
	$j('#land_cas_bar3').LineProgressbar({
		percentage:br3,
		fillBackgroundColor: br3clr
	});


  	br4 = $j("#land_cas_bar4").attr("newval");
  	br4clr = '';
  	if(br4 > 0) {
  		br4clr = '#aa1d2d';
  	}
  	$j('#land_cas_bar4').LineProgressbar({
		percentage:br4,
		fillBackgroundColor: br4clr
	});

});
</script>



	<div class="bgslide-part">
	   <div class="slidr_bgpart">
		<div class="container">

			<div class="row">
		 		<div class="col-md-8">
		 			<div class="slider-part"> <?php
		                if(!empty($casinoImage)){ ?>
		                	<div class="detail_banner">
		                  		<div class="flexslider banner_slide"  id="photoslider" >
		                    	   <ul class="slides"><?php
		                        	$show = true;
		                        	$img_num = 1;
		                            foreach($casinoImage as $image) {
		                           		if(!empty($image->file) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$image->file)){
		                           			$show = false;

			                           		if($img_num){
			                           			$bgimgurl = $image->file;
			                           			$img_num=0;
											} ?>
		                      				<li class="h390"><?php
		                      				echo $this->Html->image(CASINO_FULL_IMG_URL.$image->file,['class' => 'img-responsive','alt' => 'Image']); ?>
		                        			</li><?php
		                           		}
		                            }
									if($show) { ?>
										<li class="h390">
				                           <?php echo $this->Html->image(NO_CASINO_IMG,['class' => 'img-responsive','alt' => 'Image']); ?>
				                        </li>
				                        <style type="text/css">
					 						.bgslide-part{width: 100%; float: left;
					 							background: url(../img/casino2-01.png) no-repeat; background-size: cover; padding:30px 0px !important;
					 						}
					 					</style> <?php
									} ?>
		                            </ul>
		                  		</div><?php
		                  		if($casinoImage->count() > 1) { ?>
		                  			<span class="left-span">
		                  				<a href="javascript:void(0);" class="prev"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>left-arrow.png" class="img-responsive" />
		                  				</a>
		                  			</span>
		                  			<span class="right-span">
		                  				<a href="javascript:void(0);" class="next"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>right-arrow.png" class="img-responsive" />
		                  				</a>
		                  			</span><?php
		                  		} ?>
		               		</div><?php
		               	} ?>

		            	<!--add2favorite,remove from favorite and thumb with choice strts-->
						<div class="ratingbox slider-rat">
							<div class="edit edit_2 edit3" id="mycasinolink"> <?php if($setCasino == 'no') { ?>
                  					<a href="javascript:void(0);" data-status="no" data-casinotype="online" casino_uid ="<?php echo $casino_Uid;?>" id="casinolink" data-name="<?php echo $casino->title; ?>" data-type="casino" data-casid="<?php echo $casino->id; ?>" class="city1-click add-rvw-btn">
                  						<img src="<?php echo WEBSITE_IMG_URL; ?>fav_unfav.png" alt="img">Add to Favorites
                  					</a> <?php
                  				} else {?>
					                <a href="javascript:void(0);" data-status="yes" id="casinolink" casino_uid =<?php echo $casino_Uid;?> data-casinotype="online" data-name="<?php echo $casino->title; ?>" data-type="casino" data-casid="<?php echo $casino->id; ?>" class="city1-click add-rvw-btn">
					                	<img src="<?php echo WEBSITE_IMG_URL; ?>fav_unfav.png" alt="img">Remove from Favorites
					                </a> <?php
					            } ?>
	                		</div>
					    	<div class="rat-right thumb_box">
								<?php $rating_txt ='';
							   	if( ($casino->avg_rating > 3.0) &&($casino->avg_rating <= 4.0)) {$rating_txt = 'Good Choice';
							   	}elseif(($casino->avg_rating > 4) &&($casino->avg_rating < 5)){
									$rating_txt = 'Excellent Choice';
							   	}elseif( ($casino->avg_rating ==5)){
									$rating_txt = 'Best Choice';
							   	}
							   	?>
								  <h3><?php echo $rating_txt;?></h3>
							  <?php if( $casino->avg_rating > 3) {?><img src="<?php echo WEBSITE_URL ?>images/thumb-left.png"/><?php }?>
					    	</div>
						</div><!--add2fav,remfavorite and thumb with choice ends-->
			 		</div><!--slider with fav ends here-->
			 	</div>
				<?php
			 	if(!$show) { ?>
			 		<style type="text/css">
			 			.bgslide-part{width: 100%; float: left;
			 				background:url('../files/<?php echo  $bgimgurl?>') no-repeat scroll center center / cover;
			 				/*padding: 20px 0 30px 0;*/
			 				padding:30px 0px !important;
			 			}
			 		</style><?php
			 	} ?>
		 		<div class="col-md-4">

         <?php if(isset($casino->promotions[0]->title)){ ?>
				    <div class="block-1 bestPmnt block_4 bk4">
					  	<h3><?php echo $casino->promotions[0]->title ?></h3>
					  	<div class="imageFreame">
					  		<a data-title="<?php echo $casino->title ?>" data-url="<?php echo $casino->slug ?>"  <?php echo NEWTAB ?> rel="nofollow" href="<?php  echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $casino->promotions[0]->slug)); ?>"> <?php
								if(!empty($casino->promotions[0]->logo) && (PROMOTION_CASINO_LOGO_ROOT_PATH.$casino->promotions[0]->logo)){
								echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=323px&height=192px&cropratio=2:1&image='.PROMOTION_CASINO_LOGO_IMG_URL.$casino->promotions[0]->logo);
								}elseif(!empty($casino->image) && (CASINO_FULL_IMG_ROOT_PATH.$casino->image)){
								echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=323px&height=192px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$casino->image);
								}else{
								echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=323px&height=192px&cropratio=2:1&image='.NO_CASINO_IMG);
								} ?>
							</a>
					    </div>
					    <ul> <?php
							if(!empty($casino->promotions[0]->text)){
								$text = json_decode($casino->promotions[0]->text) ;
								foreach($text as $t){  ?>
									<li><a href="javascript:void(0);"><?php echo $t; ?></a>
									</li><?php
								}
							} ?>
					    </ul>
					  	<div class="play-now play">
					  		<a data-title="<?php echo $casino->title ?>" data-url="<?php echo $casino->slug ?>"  <?php echo NEWTAB ?> rel="nofollow" class="btn red_btn btn1" href="<?php  echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $casino->promotions[0]->slug)); ?>">Play now!
					  		</a>
					  	</div>
				   </div>
                <?php } ?>


		 		    <?php /*
					<div class="block-1 bestPmnt block_4 bk4">
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
		                        } ?>
	                        </a>
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
	                  	<div class="play-now play">
	                  		<a data-title="<?php echo $mainPromotions->casino->title ?>" data-url="<?php echo $mainPromotions->casino->slug ?>"  <?php echo NEWTAB ?> rel="nofollow" class="btn red_btn btn1" href="<?php  echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $mainPromotions->slug)); ?>">Play now!
	                  		</a>
	                  	</div>
	                </div>*/?>
		 		</div>
		 	</div>
		</div>
	</div>
</div>


   <!--online slider ends here  "add classpromotion-image" -->

    <div class="casino_desc">
        <div class="container">
      		<div class="col-md-8">
				<div class="edit update_cas">
		            <a href="javascript:void(0);" data-type="casino" data-id="<?php echo $casino->id; ?>" class="edit_info_details"><img src="../images/edit-info.png">Edit Info</a>
		            <a href="javascript:void(0);" data-name="<?php echo $casino->title; ?>" data-type="casino" data-id="<?php echo $casino->id; ?>" class="city-click addBtn_rating add-rvw-btn "><img src="../images/ad-review.png"> Add Review</a>
					<a href="javascript:void(0);" data-type="casino" data-id="<?php echo $casino->id; ?>" class="add-photos-click"><img src="../images/ad-photo.png">Add Photos</a>
	        	</div><?php $tot = array_sum($rat); ?>
			</div>
           <div class="row">

            <div class="col-md-8">
 <?php   /* <?php if(!empty($casinoImage)){ ?>
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
                    </div><?php
                    if($casinoImage->count() > 1){ ?>
                  		<span class="left-span"><a href="javascript:void(0);" class="prev"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>left-arrow.png" class="img-responsive" /></a></span>
                  		<span class="right-span"><a href="javascript:void(0);" class="next"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>right-arrow.png" class="img-responsive" /></a></span>
                  <?php } ?>
               </div>
               <?php } ?>

                <div class="edit edit_2" id="mycasinolink">  <?php
                	if($setCasino == 'no') { ?>
                  		<a href="javascript:void(0);" data-status="no" data-casinotype="online" casino_uid ="<?php echo $casino_Uid;?>" id="casinolink" data-name="<?php echo $casino->title; ?>" data-type="casino" data-casid="<?php echo $casino->id; ?>" class="city1-click add-rvw-btn"><img src="<?php echo WEBSITE_IMG_URL; ?>fav_2.png" alt="img">Add to Favorites</a><?php
                  	} else {?>
                  		<a href="javascript:void(0);" data-status="yes" id="casinolink" casino_uid =<?php echo $casino_Uid;?> data-casinotype="online" data-name="<?php echo $casino->title; ?>" data-type="casino" data-casid="<?php echo $casino->id; ?>" class="city1-click add-rvw-btn"><img src="<?php echo WEBSITE_IMG_URL; ?>fav_2.png" alt="img">Remove from Favorites</a> <?php
                  	} ?>
                </div>
                <div class="edit">
                 	<a href="javascript:void(0);" data-name="<?php echo $casino->title; ?>" data-type="casino" data-id="<?php echo $casino->id; ?>" class="city-click addBtn_rating add-rvw-btn hide">Add Review</a>
				    <span>/</span>
                  	<a href="javascript:void(0);" data-type="casino" data-id="<?php echo $casino->id; ?>" class="edit_info_details">Edit Info</a><span>/</span><a href="javascript:void(0);" data-type="casino" data-id="<?php echo $casino->id; ?>" class="add-photos-click">Add Photos</a>
                </div>
			    <div class="description">
					<div class="titl detil_title text-left">
					   <span>Casino Rating</span>
					</div>
				    <div class="ratingbox">
<!-- 						<div class="ratingCol">
								<p><?php // echo $casino->avg_rating; ?></p>
								<span class="readonly" data-score="<?php //echo $casino->avg_rating; ?>"></span>
				            </div> -->
					    <div class="rat-left online_cas_rat">
						    <a class="button-rat bt_tr">
						    <?php $fill_rating = 5 - $casino->avg_rating;
						  	$back_rating = floor($fill_rating);
						  	$fill_rating = 5.0 - $fill_rating;
						  	$full_rating = floor($fill_rating);
						  	$half_rating = $fill_rating - $full_rating;
							  	if($full_rating){
							  		for($irat=0; $irat < $full_rating;$irat++) {?>
							  		<img src="<?php echo WEBSITE_URL ?>images/star-11.png"><?php
							  		}
							  	}
							  	if($half_rating){?>
							  		<img src="<?php echo WEBSITE_URL ?>images/starhalf-11.png"><?php
							  	}
							  	if($back_rating){
							  		for($irat=0; $irat < $back_rating;$irat++) {?>
							  		<img src="<?php echo WEBSITE_URL ?>images/star-o.png"><?php
							  		}
							  	}		?>
							    <p><?php echo $casino->avg_rating ?></p>
						    </a>
							<ul class="rew_que">
							    <li>
									<a href="javascript:void(0);" data-name="<?php echo $casino->title; ?>" data-type="casino" data-id="<?php echo $casino->id; ?>" class="jump_review">	<img src="<?php echo WEBSITE_URL ?>images/img-icon1.png" />
								    </a>
									<p><?php echo $casino->review_count; ?></p>
							 	</li>
							 	<li>
									<a href="javascript:void(0);" data-name="<?php echo $casino->title; ?>" data-type="casino" data-id="<?php echo $casino->id; ?>" class="jump_review">
									<img src="<?php echo WEBSITE_URL ?>images/img-icon2.png" />
									</a>
									<p><?php echo $casino->review_count; ?></p>
							 	</li>

							 	<li><a href="javascript:void(0);" id="scr_to_qa" divid="review_div_<?php echo $casino->id.'_casino' ?>">
								<img src="<?php echo WEBSITE_URL ?>images/img-icon3.png" /></a>
								<p><?php echo $casino->question_count; ?></p>
							 	</li>
							</ul>
					    </div>
						<div class="ratingCol user_our_rating">
							<div class="ratingProgres">
								<div class="progersBar pbar"><p><span style="width:<?php echo ($casino->our_rating)*20; ?>%;"></span><label>Our Rating</label><i class="rat_num"><?php echo $casino->our_rating; ?></i></p>
								</div>
							</div>
							<div class="ratingProgres">								    <div class="progersBar pbar"><p>
								 	<span style="width:<?php echo ($casino->member_rating)*20; ?>%;">
							   		</span><label>User Rating</label><i class="rat_num"><?php echo $casino->member_rating; ?></i></p>
							    </div>
							</div>
					    </div>
					    <div class="rat-right rat-cas"><?php
					    	if( $casino->avg_rating > 3) {?>	<img src="<?php echo WEBSITE_URL ?>images/thumb-left.png"/><?php }?>
							<?php $rating_txt ='';
						   	if( ($casino->avg_rating > 3.0) &&($casino->avg_rating <= 4.0)) {$rating_txt = 'Good Choice';
						   	}elseif(($casino->avg_rating > 4) &&($casino->avg_rating < 5)){
								$rating_txt = 'Excellent Choice';
						   	}elseif( ($casino->avg_rating ==5)){
								$rating_txt = 'Best Choice';
						   	}
						   	?>
							  <h3><?php echo $rating_txt;?></h3>
					    </div>
					</div>
				</div>  */?>
			<div class="casino_desc3 casino_desc">
                <div class="description">
					<div class="titl detil_title">
					   <span>Casino Description</span>
					</div>
                    <div><?php echo $this->App->force_balance_tags($casino->sdescription); ?>
                    </div>
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
	                           <div class="col soft_col1">
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
                    <div class="col"><span>Languages</span>
                    </div>
                    <div class="col">
		      			<div class="rat_text flag_drop">
                	        <div class="dropdown show">
  								<div class="depositBlok rong_icon1 cntr_flg"><?php  $numlang = 1;

	  							foreach($casino->casino_language as $res) {

			  						if($numlang < 10) {
										if(!empty($res->master->image) && file_exists((AMENITIES_ROOT_PATH.$res->master->image))){ ?>
											<span class="lng_brdr">
												<!-- <img src="<?php //echo WEBSITE_UPLOADS_URL.'image.php?width=35px&height=27px&cropratio=1:1&image='.AMENITIES_IMG_URL.$res->master->image ?>" class="img-responsive" alt="<?php //echo $res->master->name; ?>" title="<?php //echo $res->master->name; ?>"/> -->
												<img src="<?php echo AMENITIES_IMG_URL.$res->master->image ?>" class="img-responsive" height="27" width="35" alt="<?php echo $res->master->name; ?>" title="<?php echo $res->master->name; ?>"/>
											</span><?php
		                                }
									}
									if($numlang==11) {
										break;
									}
									$numlang++;
							    }?>
								</div> <?php
								if($numlang > 10) { ?>
								<!-- <a class="btn btn-secondary dropdown-toggle"  id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<img src="../images/drop_icon_img.png">
  								</a> -->
  								<a class="schedule-d asc cntr_arow"  data-id="dropdownMenuLink_lang" >

  								</a>
  								<?php } ?>
								<!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> -->
								<div id="dropdownMenuLink_lang" class="tel_info tel_info-tel_info schedule_ul shedulebar res_schld" style="display: none;">
					    			<a class="dropdown-item" >
			                            <div class="depositBlok rong_icon1"><?php $numlang = 0;
			                                foreach($casino->casino_language as $res){$numlang++;

			                                if($numlang > 9 ) {
			                                 	if(!empty($res->master->image) && file_exists((AMENITIES_ROOT_PATH.$res->master->image))){ ?><span class="lng_brdr"><!-- <img src="<?php // echo WEBSITE_UPLOADS_URL.'image.php?width=35px&height=27px&cropratio=1:1&image='.AMENITIES_IMG_URL.$res->master->image ?>" class="img-responsive" alt="<?php //echo $res->master->name; ?>" title="<?php// echo $res->master->name; ?>"/> -->

													<img src="<?php echo AMENITIES_IMG_URL.$res->master->image ?>" class="img-responsive" height="27" width="35" alt="<?php echo $res->master->name; ?>" title="<?php echo $res->master->name; ?>"/>


			                                 	</span><?php
			                                    }
			                                }
			                                } ?>
			                            </div>
			                        </a>
                            	</div>
                            </div>
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
	                           <div class="col"><span>Withdrawal Limit</span></div>
	                           <div class="col">
	                              <p><?php
	                              //	pr($casino->casino_withdrawal_limit);
									$count	=	count($casino->casino_withdrawal_limit);
									$append	=	',&nbsp;';
	                                 foreach($casino->casino_withdrawal_limit as $key => $res){
										 if($count == $key+1){
											 $append	=	'';
										 }
	                                 	echo $res->master->name.$append;
	                                 } ?></p>
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
<?php

$numflg = 1;
$append	=	', ';
$count	=	count($casino->restricated_countries);?>


	                <div class="col">
	                  	<span>Restricted Countries</span>
	                </div>
	                <div class="col">
		      			<div class="rat_text flag_drop">
                	        <div class="dropdown show">
  							<div class="depositBlok rong_icon cntr_flg"><?php
  							foreach($casino->restricated_countries as $key => $res) {

		  						if($numflg < 10) {
									if(!empty($res->country->flag) && file_exists((AMENITIES_ROOT_PATH.$res->country->flag))) { ?>   	  <span class="flg_brdr">
				                           <img src="<?php echo AMENITIES_IMG_URL.$res->country->flag ?>" height="27" width="35" class="img-responsive" alt="<?php echo $res->country->name; ?>" title="<?php echo $res->country->name; ?>"/>
				                        </span><?php

									}else{
										 if($count == $key+1){
											 $append	=	'';
										 }
										echo $res->country->name.$append;
									 }
								}if($numflg==11) {
										break;
									}
								$numflg++;
						    }?>
						</div>
					<!-- uncmnt this for list
					<a class="btn btn-secondary dropdown-toggle"  id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="../images/drop_icon_img.png">
  					</a> -->
  					<?php if($numflg > 10) {?>
  					<a class="schedule-d asc cntr_arow"  data-id="dropdownMenuLink12" >
						<!--< img src="../images/drop_icon_img.png"> -->
  					</a>
  					<?php } ?>
					<!-- uncnt this for list
					<div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> -->
					<div id="dropdownMenuLink12" class="tel_info tel_info-tel_info schedule_ul shedulebar res_schld" style="display: none;">
					    <a class="dropdown-item" >
					    	<div class="depositBlok rong_icon"><?php
								$append	=	', ';
								$numflg = 0;
								$count	= count($casino->restricated_countries);

                            foreach($casino->restricated_countries as $key => $res){$numflg++;
                            	if($numflg > 9 ) {
                                 	if(!empty($res->country->flag) && file_exists((AMENITIES_ROOT_PATH.$res->country->flag))){ ?>
                                 		<span class="flg_brdr">
                                 		<img src="<?php echo AMENITIES_IMG_URL.$res->country->flag ?>" height="27" width="35" class="img-responsive" alt="<?php echo $res->country->name; ?>" title="<?php echo $res->country->name; ?>"/>
                                 		</span><?php

                                    }else{
										 if($count == $key+1){
											 $append	=	'';
										 }
										echo $res->country->name.$append;
								 	}
								}
							} ?>
	                              </div></a>

					  </div>
					</div>
                </div>



	                           </div>
	                        </li>
						</ul>
                    </div>
                </div>
               <?php $url	=	$casino->promotions[0]->slug;
			   if(!empty($url)){ ?>
               <div class="Btn_PlayNow">
					<a <?php echo NEWTAB ?> data-title="<?php echo $casino->title ?>" data-url="<?php echo $casino->promotions[0]->slug ?>"  rel="nofollow" class="btn red_btn btn1 PlayNow btn_ply_now" href="<?php  echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $url)); ?>">Play now!</a>
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
                <div class="gamble_option gambling_INFO_2">
                    <div class="titl tit_slide">
                       <h3>Range of Games</h3>
                    </div>
					<div class="description">
	                  <div><?php echo $this->App->force_balance_tags($casino->tdescription); ?></div>
	               </div>
    			<!-- 	<div id="owl-demo" class="owl-carousel second1"> -->
                    <?php
                  		//foreach($casino->casino_gambling_options as $casino_gambling_options) { ?>
                    <!--  	   <div class="item pos"> -->

                     			<!-- <div class="round round_2">
                        			<div class="img_round img_round_2"> <?php
                              			if(file_exists((AMENITIES_ROOT_PATH.$casino_gambling_options->master->image))){ ?>
                           					<img src="<?php echo WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.AMENITIES_IMG_URL.$casino_gambling_options->master->image ?>" class="img-responsive" alt="img" /> <?php }
                           			    ?>
                        			</div>
                        			<h3><?php echo $casino_gambling_options->master->name ?></h3>
                     			</div> --><!-- </div> -->
                     	<?php
                     	//} ?>
                  	<!-- </div> -->
                <div class="kpkp">
                <div id="allcarousel" class="carousel-box thumbSlide">
					<div class="thumbNav">
					</div>
		                <ul class="bxslider">
		                <?php  foreach($casino->casino_gambling_options as $casino_gambling_options) { ?>

						  	<li>
						  		<div class="round round_2">
		                        	<div class="img_round img_round_2">
		                        		<?php if(file_exists((AMENITIES_ROOT_PATH.$casino_gambling_options->master->image))){ ?>
		          						<img src="<?php echo WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.AMENITIES_IMG_URL.$casino_gambling_options->master->image ?>" class="img-responsive" alt="img"/>
		          						<?php } ?>
		          					</div>
	                        		<h3><?php echo $casino_gambling_options->master->name ?></h3>
	                     		</div>
                     		</li>
                     	<?php } ?>
						</ul>
				</div>
                </div>
            </div>

         <!--  </div>-->

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
						<a <?php echo NEWTAB ?> data-title="<?php echo $casino->title ?>" id="onln_rw" data-url="<?php echo $casino->slug ?>" rel="nofollow" href="<?php  echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $url)); ?>" class="btn red_btn btn1 "><?php if(!empty($casino->promotions[0]->text)){ $text = json_decode($casino->promotions[0]->text) ;  echo 'Claim '.$text[0]; } ?></a>
				  </div>
				  <?php } ?>
               </div>
               <?php echo $this->element('normal_casino_review_json',['name' => $casino->title,'type' => 'casino','count' => $casino->review_count,'avg_rating' => $casino->avg_rating,'id' => $casino->id]);
			   echo $this->element('question_answer_json',['name' => $casino->title,'type' => 'casino','count' => $casino->question_count,'avg_rating' => $casino->avg_rating,'id' => $casino->id]);
 ?>
            </div>
            </div>
            <div class="col-md-4">
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

$('.scroll').click(function() {
    $('html, body').animate({
        scrollTop: eval($('#' + $(this).attr('target')).offset().top - 70)
    }, 1000);
     return false;
});

$("#scr_to_qa").click(function() {

$('html,body').animate({scrollTop: $(document).height() }, 600);
		return false;

});

$(document).on('click', '.city1-click', function(){

		<?php if(!empty($this->request->session()->read('Auth.User'))){ ?>
			status		=	$(this).attr('data-status');
			casinotype	=	$(this).attr('data-casinotype');
			id		=	$(this).attr('data-casid');
			name		=	$(this).attr('data-name');
			casino_uid = $(this).attr('casino_uid');

			if(status === 'no') {
				if (casinotype == 'normal') {
					url1 = '<?php echo $this->Url->build('/CasinoVisits/add/') ?>';
					newlink = '<a href="javascript:void(0);" casino_uid ="'+casino_uid+'" data-status="yes" data-casinotype="normal" id="casinolink" data-name="'+name+'" data-type="casino" data-casid="'+id+'" class="city1-click add-rvw-btn "><img src="<?php echo WEBSITE_IMG_URL; ?>fav_unfav.png" alt="img">Remove from Favorites</a>';

				}  else {
					url1 =  '<?php echo $this->Url->build('/CasinoLikes/add/') ?>';
					newlink = '<a href="javascript:void(0);" casino_uid ="'+casino_uid+'" data-status="yes" data-casinotype="online" id="casinolink" data-name="'+name+'" data-type="casino" data-casid="'+id+'" class="city1-click add-rvw-btn "><img src="<?php echo WEBSITE_IMG_URL; ?>fav_unfav.png" alt="img">Remove from Favorites</a>';
				}
				message = 'Casino has been added';
			    url1 += id;
			} else {
				if (casinotype === 'normal') {
					url1 = '<?php echo $this->Url->build('/CasinoVisits/delete/') ?>';
					newlink = '<a href="javascript:void(0);" casino_uid ="'+casino_uid+'" data-status="no" data-casinotype="normal" id="casinolink" data-name="'+name+'" data-type="casino" data-casid="'+id+'" class="city1-click add-rvw-btn "><img src="<?php echo WEBSITE_IMG_URL; ?>fav_unfav.png" alt="img">Add to Favorites</a>';

				}  else {
					url1 =  '<?php echo $this->Url->build('/CasinoLikes/delete/') ?>';
					newlink = '<a href="javascript:void(0);" casino_uid ="'+casino_uid+'" data-status="no" data-casinotype="online" id="casinolink" data-name="'+name+'" data-type="casino" data-casid="'+id+'" class="city1-click add-rvw-btn "><img src="<?php echo WEBSITE_IMG_URL; ?>fav_unfav.png" alt="img">Add to Favorites</a>';
				}
				message = 'Casino has been deleted from your list';
				url1 += casino_uid;
			}
			$.ajax({
				url  : url1,
				type 	 : 'get',
				dataType : 'json',
				success  : function(data){
					id = data.id;
					$("#mycasinolink").html(newlink);
					$("#casinolink").attr("casino_uid",id);
					notice('Success',message,'success');
				}
			});

		<?php }else{ ?>
			$(".login-pop").trigger('click');
		<?php } ?>
	});
<?php $this->Html->scriptEnd(); ?>
