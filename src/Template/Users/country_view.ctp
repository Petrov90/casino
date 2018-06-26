<link rel="stylesheet" href="../css/lightbox.css">
<?php echo $this->Html->script(['https://maps.googleapis.com/maps/api/js?v=3&libraries=geometry%2Cplaces&key&language='.$Defaultlanguage.'&key=AIzaSyCMhDWSllv2IvaQL40G9rro0aHkeak9GoY','masonry.js'],array('block' =>'custom_script')); ?>

<div class="mid_wrapper city-page">
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
		}?>
	<div class="cityBanner">
		<div id="allslider" class="dfcnt_img">
			<ul class="slides"><?php 
				foreach($images as $key => $img) {
			       
	                $bgimg_cnt++;
					//echo $countryDetail->cntry_img;
		  			$img_cls = ''; 
					if($dbimg ){
						if($countryDetail->cntry_img == $img->file) {
							$img_cls = 'bglow_cls';
						}
					}else if($bgimg_cnt == 1){
							$img_cls = 'bglow_cls';
					} ?>
					<li	<?php if($key > 0){ ?>style="display:none" <?php  } ?>>
					<div class="citySlide"><?php 
						if($img_cls){ ?>
							<img alt="Image" class="<?php echo $img_cls ?>" src="<?php echo CASINO_FULL_IMG_URL.$img->file ?>" /><?php 
						}else{ ?>
							<img alt="img"  id="<?php echo $key; ?>_img" class="lazy <?php echo $img_cls ?>" src="<?php echo WEBSITE_IMG_URL.'camera-loader.gif' ?>" data-src="<?php echo CASINO_FULL_IMG_URL.$img->file ?>" /><?php 
						} ?>
						<div class="slideCptin">
							<h1><?php echo $countryName; ?></h1>
							<div class="block bl"><span><img src="<?php if(file_exists(AMENITIES_ROOT_PATH.$countryDetail->flag)){ echo WEBSITE_UPLOADS_URL.'image.php?width=100px&height=50px&cropratio=2:1&image='.AMENITIES_IMG_URL.$countryDetail->flag; }else{
								echo WEBSITE_UPLOADS_URL.'image.php?width=100px&height=50px&cropratio=2:1&image='.NO_COUNTRY_IMG;
							} ?>" class="img-responsive" alt="<?php echo $countryDetail->name; ?>" title="<?php echo $countryDetail->name; ?>"/> </span></div>
						<!-- <div class="block"><a href="javascript:void(0);" data-type="country" data-id="<?php // echo $countryDetail->id; ?>" class="add-photos-click btn addBtn"><i class="fa fa-camera"></i>Add a Photo</a></div> -->
						</div>
					</div>
				    </li><?php
				} ?>
			</ul>
		</div>
		<div class="cityThumb">
			<div class="container">
				<div id="allcarousel" class="carousel-box thumbSlide"> <?php 
				$num_of_cnty_img = 0;
				foreach($images as $img) {
				 $num_of_cnty_img++;
				}
			if($num_of_cnty_img > 1 ) { ?>
				<ul class="slides mouse-pointer"> <?php 
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
						<li class="dflt_cntry_img" itmid="<?php echo $countryDetail->id;?>" imgid="<?php echo $img->id?>"itm_name="<?php echo $img->file;?>" slgname="<?php echo $countryDetail->slug?>" id="<?php echo $img_cls; ?>">
						
		                <?php if($dbimg)  { ?>
						<a href="<?php echo CASINO_FULL_IMG_URL.$img->file ?>" data-lightbox="example-set" class="<?php if($img_cls =='' && $dbimg) echo 'example-image-link'?>"><?php }?>				
						
						    <img alt="img" src="<?php echo WEBSITE_URL.'image.php?width=150px&height=75px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$img->file ?>" />
						    <i id="icn_<?php echo $img->id?>" class="fa fa-check ck_icn"></i>
						    
						<?php if($dbimg)  {?></a><?php }?>
						 
						 
						</li> <?php 
					} ?>
				</ul> <?php 
				if($count >8){ ?>
					<div class="thumbNav">
						<a href="javascript:void(0)" class="prev"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>ic2.png" alt="icon" /></a>
						<a href="javascript:void(0)" class="next"><img alt="img" src="<?php echo WEBSITE_IMG_URL ?>ic3.png" alt="icon" /></a>
					</div><?php
				} 
			}	?>
				</div>
			</div>
		</div>		
	</div> <?php
	}else { ?>
	<div class="cityBanner contrybanner ">
		<div class="citySlide">
		<img src="<?php echo NO_COUNTRY_IMG ?>" alt="img"/>
		  <div class="slideCptin">
				<h1><?php echo $countryName =  $countryDetail->name; ?></h1>
			<div class="block bl"><span><img src="<?php if(file_exists(AMENITIES_ROOT_PATH.$countryDetail->flag)){ echo WEBSITE_UPLOADS_URL.'image.php?width=100px&height=50px&cropratio=2:1&image='.AMENITIES_IMG_URL.$countryDetail->flag; }else{
								echo WEBSITE_UPLOADS_URL.'image.php?width=100px&height=50px&cropratio=2:1&image='.NO_COUNTRY_IMG;
							} ?>" class="img-responsive" alt="<?php echo $countryDetail->name; ?>" title="<?php echo $countryDetail->name; ?>" class="img-responsive" alt="<?php echo $countryDetail->name; ?>" title="<?php echo $countryDetail->name; ?>"/> </span></div>
			<div class="block"><a href="javascript:void(0);" data-type="country" data-id="<?php echo $countryDetail->id; ?>" class="add-photos-click btn addBtn"><i class="fa fa-camera"></i>Add a Photo</a></div>
		  </div>
		</div>
	</div>  
	<?php } ?>
	 <!--  <div class="ed_inf">
  		<div class="container">
  			<div class="pull-right">
	        	<a href=""><img src="<?php echo WEBSITE_URL?>images/edit-info.png">
	        		<span> Edit Info</span></a> 
	        	<a href="javascript:void(0);" data-type="country" data-id="<?php echo $countryDetail->id; ?>"  class="add-photos-click"><img src="<?php echo WEBSITE_URL?>images/ad-photo.png">
	        	<span>Add Photos</span></a> 
	        </div>
	    </div>
	</div> -->
	 <div class="ed_inf">

		<div class="filter_2N new-block">

			<div class="fil_block new-fil-block">

				<div class="container">

					<div class="row">

						<div class="col-md-12">

							<ul>

								<li class="active"><a href="">About <?php echo  $countryDetail->name; ?></a></li>

								<li><a href="<?php echo WEBSITE_URL.$countryDetail->slug ?>/casinos"><?php echo  $countryDetail->name; ?> Casinos</a></li>

								<li><a href="/online-casinos?sort=title&amp;direction=asc"><?php echo  $countryDetail->name; ?> Hotels</a></li>

							</ul>

							<div class="pull-right">

								<a href=""><img src="<?php echo WEBSITE_URL?>images/edit-info.png">

								<span> Edit Info</span></a> 

								<a  href="javascript:void(0);"  data-type="city" data-id="<?php echo $cityDetail->id; ?>" class="add-photos-click"><img src="<?php echo WEBSITE_URL?>images/ad-photo.png">

							<span>Add Photos</span></a> 

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>
  <div class="casino_desc">
  	<div class="container">
  		  <script>loctn = [];</script>
			<div class="title">
			<h2><?php echo $countryDetail->head_frst;?> </h2>
			<span><?php echo $countryDetail->description;?></span>       
			</div>
			<div class="title cuntery_Title">
			<h2>Best Casinos in <?php echo isset($countryDetail->name) ? $countryDetail->name : ''; ?></h2>
			</div>
		<?php 
		if(!$casinosData->isEmpty()){ ?>
			<div class="explore-img explore-img1 shadwo_none">
				<ul>
				<?php
				$limitc = 0; 
				$results=array();
					foreach($casinosData as $casino){  
					$limitc ++;
					if($limitc  < 7) {
					?>                                
						<li class="explore_links popluler_indexbox">
						<a href="<?php $murl= '';
							if($casino->type == 'normal'){
							$murl = $this->Url->build(['plugin' => '','controller' => 'Casinos','action' => 'casino_view','casino_view' => $casino->slug]);
							echo $murl;
							}else{

							$murl = $this->Url->build(['plugin' => '','controller' => 'Casinos','action' => 'casino_view','casino_view' => $casino->slug]);
							echo $murl;
							}
							?>">
							<div class="img_block">
								<?php 
								if(!empty($casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image)){
								echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?height=233px&cropratio=1:1&image='.CASINO_FULL_IMG_URL.$casino->image,['alt' =>"Image loading"]);
								}else{
								echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=280px&height=233px&cropratio=1:1&image='.NO_CASINO_IMG,['class' => 'img-responsive','alt' =>"Image loading"]);
								}  ?>	                   
							</div>
						</a>
						<!--popular part start-->
						<div class="most_pop_box">
							<a class="cas_indx" href="<?php 
							if($casino->type == 'normal'){
							echo $this->Url->build(['plugin' => '','controller' => 'Casinos','action' => 'casino_view','casino_view' => $casino->slug]);
							}else{
							echo $this->Url->build(['plugin' => '','controller' => 'Casinos','action' => 'casino_view','casino_view' => $casino->slug]);
							}
							?>"> 
							<h4><?php echo $casino->title ?></h4>
							</a>
							<a class="clientRating readonly star_box" data-score="<?php echo $casino->avg_rating; ?>"></a>
							<a href="javascript:void(0);" class="Opinion_text"> <span>
							<?php
							echo $casino->review_count;
							if($casino->review_count   > 1)
							echo ' Opinions';
							else echo ' Opinion';?>
							</span>
							</a>
							<p class="text_para"><?php echo  $casino->city->name; ?>,
							<?php echo $countryName; ?>                               
							</p>  
							</div>    
						</li><?php 
					}
					if($casino->type == 'normal'){
					$murl1 = $this->Url->build(['plugin' => '','controller' => 'Casinos','action' => 'casino_view','casino_view' => $casino->slug]);
					}else{
					$murl1 = $this->Url->build(['plugin' => '','controller' => 'Casinos','action' => 'casino_view','casino_view' => $casino->slug]);
					}
					?>
					<script>
					loctn.push(['<?php echo str_replace("'","",$casino->title); ?>','<?php echo str_replace("'","",$casino->address); ?>','<?php echo str_replace("'","",$murl1); ?>']);
					</script>
					<?php
					array_push($results,array("title"=>$casino->title,"address"=>$casino->address));
				} 
				?>
				</ul>
			</div>
			<?php	
		}else{
		?><div class="text-center h500 n_rec">No Record Found</div><?php
		}
		?>
    
        
		<div class="Explore title_cent">
			<div class="gamblingBox gamblingBox_new">
				<div class="detail_map">
<script type="text/javascript">// <![CDATA[
var markers = [{"lat":"3559393","lng":"-1052239"},
{"title":"shilparamam","lat":"3559393","lng":"-1052239","description":"Mumbai formerly Bombay, is the capital city of the Indian state of Maharashtra."},
];
window.onload = function () {
var mapOptions = {
center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
zoom: 10,
mapTypeId: google.maps.MapTypeId.ROADMAP
};
var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
var infoWindow = new google.maps.InfoWindow();
var lat_lng = new Array();
var latlngbounds = new google.maps.LatLngBounds();
for (i = 0; i < markers.length; i++) {
var data = markers[i]
var myLatlng = new google.maps.LatLng(data.lat, data.lng);
lat_lng.push(myLatlng);
var marker = new google.maps.Marker({
position: myLatlng,
map: map,
title: data.title
});
latlngbounds.extend(marker.position);
(function (marker, data) {
google.maps.event.addListener(marker, "click", function (e) {
infoWindow.setContent(data.description);
infoWindow.open(map, marker);
});
})(marker, data);
}
map.setCenter(latlngbounds.getCenter());
map.fitBounds(latlngbounds);

}
</script>
					<div id="dvMap" style="width: 100%; height: 500px;"></div>
					<!-- <h2>Map</h2> -->
					<!-- <div id="map_canvas"></div> -->
		        </div>	
		  	</div>
			<!-- <div class="container"> -->
			  <div class="title">
				<h2>Popular Cities in <?php echo $countryName;?></h2>  
				 </div>
				  <div class="row">
					<div class="col-md-12">
					  <div class="explore-img shadwo_none">		  
						<ul>
						<?php $img_ct = 0;
						foreach($myallCity as $key => $city){if($img_ct++ == 6) break; ?>
						    <li class="explore_links popluler_indexbox">
						    	<a href="<?php echo $this->Url->build(['controller' => 'users','action' => 'city_view','country' => $slug,'city' => $city->slug]); ?>">

          						<div class="img_block">
	                       			<?php 
		                          if(!empty($city->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$city->image)){


		                          echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?height=233px&cropratio=1:1&image='.CASINO_FULL_IMG_URL.$city->image,['alt' =>"Image loading"]);
		                          }else{
		                          echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=280px&height=233px&cropratio=1:1&image='.NO_CASINO_IMG,['class' => 'img-responsive','alt' =>"Image loading"]);
		                          }  ?>	                   
	                    		</div>
	                    		</a>
	            <!--popular part start-->
                    <div class="most_pop_box">
                        <a href="<?php echo $this->Url->build(['controller' => 'users','action' => 'city_view','country' => $slug,'city' => $city->slug]); ?>">
                              <h4><?php echo $city->name ?></h4>
                        </a>
                        <a class="clientRating readonly star_box" data-score="<?php echo $city->avg_rating; ?>"></a>
                        <a href="javascript:void(0);" class="Opinion_text"> <span>
                                 <?php
                                 echo $city->review_count;
                                 if($city->review_count   > 1)
                                    echo ' Opinions';
                                 else
                                    echo ' Opinion';?>
                              </span>
                        </a>
                      
                         <p class="text_para"><?php echo $city->name; ?>,
                                 <?php echo $countryName; ?>                               
                        </p>  
                    </div> 


					
						   </li>

						 <?php } ?>
						</ul>
					  </div>
					</div>
				  </div>
			  <?php /*<div class="block"> <a href="#" class="btn trans_btn">View more</a> </div>*/ ?>
			<!-- </div> -->
		  </div>

		  <?php if(!empty($countryDetail->second_blok)) {?>
			        <div class="title">
			        	<h2>Casinos in <?php echo $countryDetail->name;?> </h2>
			          	<span><?php echo $countryDetail->second_blok;?></span>         
			        </div><?php }?>
		  	
		    <div class="container">
		  	<?php echo $this->element('normal_casino_review_json',['name' => $countryDetail->name,'id' => $countryDetail->id,'type' => 'country','count' => $countryDetail->review_count,'avg_rating' => $countryDetail->avg_rating]);

			echo $this->element('question_answer_json',['name' => $countryDetail->name,'id' => $countryDetail->id,'type' => 'country','count' => $countryDetail->question_count]);
			?>

      </div>
    </div>
  </div>
</div>
<!-- <?php //$this->Html->scriptStart(array('block' => 'custom_script')); ?>
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
			<?php if($dbimg){?>
				$(".dfcnt_img").removeAttr("id");

			 <?php }?>
		}
	});	


<?php //$this->Html->scriptEnd();  echo $this->element('add_info_popup',['type' => 'country','foreign_key' => $countryDetail->id]); ?>
<script src="../js/lightbox-plus-jquery.min.js"></script> -->


