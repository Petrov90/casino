<div class="mid_wrapper">
	<?php $countryName =  $countryDetail->name; 
	if(isset($images) && !$images->isEmpty()){
	
			$myimg = $images;
			$count	=	0;
			$images_arr = array();
			$dbimg = 0;	$bgimg_cnt=0;		
			foreach($myimg as $img){
				$images_arr[] = $img->file;
			}	
			if( in_array($countryDetail->cntry_img, $images_arr)){
				$dbimg = 1;
			}
		
	
	?>
	<div class="cityBanner">
		<div id="allslider" class="">
			<ul class="slides">
			<?php foreach($images as $key => $img){
			       
	                $bgimg_cnt++;
					//echo $countryDetail->cntry_img;
		  			$img_cls = ''; 
					if($dbimg ){
						if($countryDetail->cntry_img == $img->file) {
							$img_cls = 'bglow_cls';
						}
					}else if($bgimg_cnt == 1){
							$img_cls = 'bglow_cls';
					}
			
			?>
				<li	<?php if($key > 0){ ?>style="display:none" <?php  } ?>>
					<div class="citySlide">
					<?php if($key == 0){ ?>
							<img alt="Image" class="<?php echo $img_cls ?>" src="<?php echo CASINO_FULL_IMG_URL.$img->file ?>" />
					<?php }else{ ?>
							<img alt="img"  id="<?php echo $key; ?>_img" class="lazy <?php echo $img_cls ?>" src="<?php echo WEBSITE_IMG_URL.'camera-loader.gif' ?>" data-src="<?php echo CASINO_FULL_IMG_URL.$img->file ?>" />
					<?php  } ?>
						<div class="slideCptin">
							<h1><?php echo $countryName; ?></h1>
							<div class="block"><span><img src="<?php if(file_exists(AMENITIES_ROOT_PATH.$countryDetail->flag)){ echo WEBSITE_UPLOADS_URL.'image.php?width=100px&height=50px&cropratio=2:1&image='.AMENITIES_IMG_URL.$countryDetail->flag; }else{
								echo WEBSITE_UPLOADS_URL.'image.php?width=100px&height=50px&cropratio=2:1&image='.NO_COUNTRY_IMG;
							} ?>" class="img-responsive" alt="<?php echo $countryDetail->name; ?>" title="<?php echo $countryDetail->name; ?>"/> </span></div>
						<!-- <div class="block"><a href="javascript:void(0);" data-type="country" data-id="<?php // echo $countryDetail->id; ?>" class="add-photos-click btn addBtn"><i class="fa fa-camera"></i>Add a Photo</a></div> -->
						</div>
					</div>
				</li>
			<?php } ?>
			</ul>
		</div>
		<div class="cityThumb">
			<div class="container">
				<div id="allcarousel" class="carousel-box thumbSlide">
					<ul class="slides mouse-pointer">
						<?php 

                       
/*          $img_cls = ''; 
			if($dbimg ){
				if($countryDetail->cntry_img == $img->file) {
					$img_cls = 'actimg';
				}
			}else if($count == 1){
					$img_cls = 'actimg';
			}
*/



						foreach($images as $img){ $count++;
							//echo $countryDetail->cntry_img;
				  			$img_cls = ''; 
							if($dbimg ){
								if($countryDetail->cntry_img == $img->file) {
									$img_cls = 'actimg';
								}
							}else if($count == 1){
									$img_cls = 'actimg';
							}

							 ?>
							<li class="dflt_cntry_img" itmid="<?php echo $countryDetail->id;?>" imgid="<?php echo $img->id?>"itm_name="<?php echo $img->file;?>" slgname="<?php echo $countryDetail->slug?>" id="<?php echo $img_cls; ?>"><img alt="img" src="<?php echo WEBSITE_URL.'image.php?width=150px&height=75px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$img->file ?>" />
<i id="icn_<?php echo $img->id?>" class="fa fa-check ck_icn"></i>
							</li>
						<?php } ?>
					</ul>
				<?php if($count >8){ ?>
				 <div class="thumbNav">
					<a href="javascript:void(0)" class="prev"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>ic2.png" alt="icon" /></a>
					<a href="javascript:void(0)" class="next"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>ic3.png" alt="icon" /></a>
				 </div>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<?php }else{ ?>
	<div class="cityBanner contrybanner ">
		<div class="citySlide">
		<img src="<?php echo NO_COUNTRY_IMG ?>" alt="img"/>
		  <div class="slideCptin">
				<h2><?php echo $countryName =  $countryDetail->name; ?></h2>
			<div class="block"><span><img src="<?php if(file_exists(AMENITIES_ROOT_PATH.$countryDetail->flag)){ echo WEBSITE_UPLOADS_URL.'image.php?width=100px&height=50px&cropratio=2:1&image='.AMENITIES_IMG_URL.$countryDetail->flag; }else{
								echo WEBSITE_UPLOADS_URL.'image.php?width=100px&height=50px&cropratio=2:1&image='.NO_COUNTRY_IMG;
							} ?>" class="img-responsive" alt="<?php echo $countryDetail->name; ?>" title="<?php echo $countryDetail->name; ?>" class="img-responsive" alt="<?php echo $countryDetail->name; ?>" title="<?php echo $countryDetail->name; ?>"/> </span></div>
			<div class="block"><a href="javascript:void(0);" data-type="country" data-id="<?php echo $countryDetail->id; ?>" class="add-photos-click btn addBtn"><i class="fa fa-camera"></i>Add a Photo</a></div>
		  </div>
		</div>
	</div>  
	<?php } ?>
  <div class="casino_desc">
	<div class="container">
		<div class="clowdTop">
			<div class="pull-left">
			<a href="javascript:void(0);" data-name="<?php echo $countryDetail->name; ?>" data-type="country" data-id="<?php echo $countryDetail->id; ?>"  class="btn red_btn city-click add-rvw-btn hide">Add Review</a></div>
			<div class="pull-right"><a href="javascript:void(0);" data-type="country" data-id="<?php echo $countryDetail->id; ?>"  class="add-photos-click">Add Photos</a></div>
		</div>
		
         <div class="title cuntery_Title"><h2>Popular Casinos in <?php echo $countryDetail->name; ?></h2>
		</div>
           <div class="row">
			<div class="filter_2N">
				<div class="fil_block">
					  <ul><?php 
					  $paginator = $this->request->params['paging']['Casinos'];

						$order	=	'created';
						$page =  $paginator['page'];
						 $page	 	= ($page > 1) ? 'page='.$page.'&' : ''; 
						 $created 	= ($created == 'asc') ? 'created=desc' : 'created=asc'; 
						 $recommend	= ($recommend == 'asc') ? 'recommend=desc' : 'recommend=asc'; 
						 $rating	= ($rating == 'asc') ? 'rating=desc' : 'rating=asc';
						 $name	= ($name == 'asc') ? 'name=desc' : 'name=asc';
						 ?>
						
						<li class="<?php echo ($order == 'created') ? 'active' : '' ?>">
							<a class="<?php echo ($order == 'created') ? $created : '' ?>" href="<?php echo $this->Url->build(['plugin' => '','controller' => 'users','action' => 'country_view','country_view' => $slug]).'?'.$page.$created; ?>">Created</a>
						</li>
						 <li class="<?php echo ($order == 'recommend') ? 'active' : '' ?>"><a  class="<?php echo ($order == 'recommend') ? $recommend : '' ?>" href="<?php echo $this->Url->build(['plugin' => '','controller' => 'users','action' => 'country_view','country_view' => $slug]).'?'.$page.$recommend ?>">recommend</a></li>
						 <li class="<?php echo ($order == 'rating') ? 'active' : '' ?>"><a  class="<?php echo ($order == 'rating') ? $rating : '' ?>" href="<?php echo $this->Url->build(['plugin' => '','controller' => 'users','action' => 'country_view','country_view' => $slug]).'?'.$page.$rating ?>">Reviews</a></li>
						 <li class="<?php echo ($order == 'name') ? 'active' : '' ?>"><a  class="<?php echo ($order == 'name') ? $name : '' ?>" href="<?php echo $this->Url->build(['plugin' => '','controller' => 'users','action' => 'country_view','country_view' => $slug]).'?'.$page.$name ?>">Name</a></li>
					  </ul>			
				</div>
			<div class="">
				<?php echo $this->Form->create('Users',['class' => 'search_box3','type' => 'get']); ?>
	<?php echo $this->Form->text('search',['placeholder' => 'Casino Name','value' => (isset($this->request->query['search'])) ? $this->request->query['search'] : '']); ?>
					<button type="submit"><img src="<?php echo WEBSITE_IMG_URL ?>search_img.png" alt="img"></button>
				</form>			
			</div>	
			</div>
        </div>
         
      </div>
    <div class="container">
      <div class="row">
        
		<div class="clint_info">
			<?php 
		if(!$casinosData->isEmpty()){ 
			foreach($casinosData as $casino){ ?>
			 <div class="clint_info_post">
				<div class="clint_post">
				   <div class="clint_item">
                   <a href="<?php echo $this->Url->build(array('controller' => 'casinos','action' => 'casino_view','casino_view' => $casino->slug)); ?>">
					<?php if(!empty($casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image)){ ?>
						<img class="img-responsive" alt="img"  src="<?php echo WEBSITE_UPLOADS_URL.'image.php?height=130px&image='.CASINO_FULL_IMG_URL.$casino->image; ?>">
					<?php }else{ ?>
						<img class="img-responsive" alt="img"  src="<?php echo WEBSITE_UPLOADS_URL.'image.php?height=130px&image='.NO_CASINO_IMG; ?>"><?php 
					} ?>
				   </a></div>
				   <div class="clint_post_right">
					  <span><a href="<?php echo $this->Url->build(array('controller' => 'casinos','action' => 'casino_view','casino_view' => $casino->slug)); ?>"><?php echo $casino->title ?></a></span>
					  <div class="clientRating readonly" data-score="<?php echo $casino->avg_rating; ?>"></div>
					  <p><?php echo $casino->city->name; ?>, <?php echo $countryName; ?></p>
				   </div>
				   <div class="sbumit_block3">
					  <div class="more_info_btn">
						 <a class="more_btn more_Btn" href="<?php echo $this->Url->build(array('controller' => 'casinos','action' => 'casino_view','casino_view' => $casino->slug)); ?>">More info</a>
					  </div>
				   </div>
				</div>
			 </div>
		<?php } echo $this->element('country_page_pagination',['url' =>$this->Url->build(['plugin' => '','controller' => 'Users','action' => 'country_view','country_view' => $slug])]); 
		}else{ ?>
			<div class="text-center">No Record found</div>
		<?php } ?>
		</div>
		<div class="news_post cuntery_news_post">		
		 <h3>Recommed Casinos</h3>
		 <div class="newsBidget">
			<?php foreach($recommnedCasino as $casino){ ?>
		 			<div class="item_D1">
			   <div class="item_img"><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]) ?>"><?php 
				if(!empty($casino->image) && (CASINO_FULL_IMG_ROOT_PATH.$casino->image)){
					echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=110px&height=59px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$casino->image,['alt' => 'Image','height' => 59,'width' => 110]);
				} ?></a></div>
			   <div class="item_text">
				  <a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]) ?>"><?php echo $casino->title ?></a>
				  <small class="readonly" data-score="<?php echo $casino->avg_rating; ?>"></small><a data-title="<?php echo $casino->title ?>" data-url="<?php echo $casino->slug ?>" <?php echo NEWTAB ?> rel="nofollow" href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $casino->main_promotion->slug)); ?>" class="btn playBtn">Play now</a>
			   </div>
			</div>
			<?php } ?>
		 		 </div>
		 <div class="view_all_casino"><a href="/casino/online-casinos">View All Casinos</a></div>
	  </div>
        
        
		<div class="Explore title_cent">
			<div class="container">
			  <div class="title">
				<h2>Popular Cities</h2>  
				 </div>
				  <div class="row">
					<div class="col-md-12">
					  <div class="explore-img shadwo_none">		  
						<ul>
						<?php foreach($countryDetail->city as $key => $city){ ?>
						   <li>
							<div class="img_block">
							<?php if(!empty($city->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$city->image)){ ?>
								<img class="img-responsive" alt="img" src="<?php echo WEBSITE_UPLOADS_URL.'image.php?width=267px&height=233px&image='.CASINO_FULL_IMG_URL.$city->image ?>"/>
							<?php }else{ ?>
								<img class="img-responsive" alt="img" src="<?php echo WEBSITE_UPLOADS_URL.'image.php?width=267px&height=233px&image='.NO_CITY_IMG ?>"/>
								<?php 
							} ?>
								<div class="overlay"><span><a href="<?php echo $this->Url->build(['controller' => 'users','action' => 'city_view','country' => $slug,'city' => $city->slug]); ?>"><?php echo $city->name; ?></a></span></div>
							</div>
						   </li>
						 <?php } ?>
						</ul>
					  </div>
					</div>
				  </div>
			  <?php /*<div class="block"> <a href="#" class="btn trans_btn">View more</a> </div>*/ ?>
			</div>
		  </div>
		  	<?php echo $this->element('normal_casino_review_json',['name' => $countryDetail->name,'id' => $countryDetail->id,'type' => 'country','count' => $countryDetail->review_count,'avg_rating' => $countryDetail->avg_rating]);

			echo $this->element('question_answer_json',['name' => $countryDetail->name,'id' => $countryDetail->id,'type' => 'country','count' => $countryDetail->question_count]);
			?>

      </div>
    </div>
  </div>
</div>
<?php $this->Html->scriptStart(array('block' => 'custom_script')); ?>
	$(window).on("load", function() {
		$("#actimg").trigger('click');
		imgid = $("#actimg").attr("imgid");
		imgstyl ='#icn_'+imgid;


		
	});			
		$(".prev").click(function() {
			$('#allcarousel').flexslider("prev")
		});
		$(".next").click(function() {
			$('#allcarousel').flexslider("next")
		});
		
		$('#allcarousel').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: false,
			slideshow: false,
			itemWidth: 120,
			maxItems: 8,
			minItems: 8,
			directionNav: false,
			itemMargin: 0,
			asNavFor: '#allslider'		
		});

	$('#allslider').flexslider({
		animation: "fade",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		sync: "#allcarousel",
		directionNav: false,
		
		before: function (slider) {
		  var slides 	= slider.slides,
			index 		= slider.animatingTo,
			$slide 		= $(slides[index]),
			$img 		= $slide.find('img[data-src]'),
			current 	= index,
			nxt_slide 	= current + 1,
			prev_slide 	= current - 1;
		
		  $slide
			.parent()
			.find('img.lazy:eq(' + current + '), img.lazy:eq(' + prev_slide + '), img.lazy:eq(' + nxt_slide + ')')
			.each(function () {
				var src = $(this).attr('data-src');
				$(this).attr('src', src).removeAttr('data-src');
				
			});/* 
			
			$("#"+current+"_img").removeClass('lazy');
			$("#"+nxt_slide+"_img").removeClass('lazy');
			$("#"+prev_slide+"_img").removeClass('lazy'); */
		}
	});	


<?php $this->Html->scriptEnd();  echo $this->element('add_info_popup',['type' => 'country','foreign_key' => $countryDetail->id]); ?>