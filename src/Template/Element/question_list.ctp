<?php use Cake\Core\Configure;
use Cake\I18n\Time; ?>
<div class="filter_block">
   <div class="filter_post">
   <?php foreach($questionList as $review){    ?>   
	<div class="filter_post_item <?php if($review->type == 'casino'){ echo 'question_'.$review->casino->type; }else{ echo 'question_'.$review->type; } ?>">
	<?php 
	$htmlurl	=	'';
	$url	=	NO_CASINO_IMG;
	$name	=	'';
	$cityName	=	'';
	   if($review->type == 'city'){
		   if(!empty($review->city->image) && file_exists(CASINO_THUMB_IMG_ROOT_PATH.$review->city->image)){
				$url	=	CASINO_FULL_IMG_URL.$review->city->image;
		   }else{
				$url	=	NO_CITY_IMG;			
		   }
		   
			$name		=	$cityName	=	isset($review->city->name) ? $review->city->name : '';
			$ccountryName	=	isset($review->city->country->name) ? $review->city->country->name : '';
			$slug		=	$review->city->slug;
			$countrySlug		=	isset($review->city->country->slug) ? $review->city->country->slug : '';
			
			$htmlurl	=	$this->Url->build(['plugin' => '','controller' => 'users','action' => 'city_view','country'=>$countrySlug,'city'=>$slug]);
	   }else if($review->type == 'casino'){ 
		   if(!empty($review->casino->image) && file_exists(CASINO_THUMB_IMG_ROOT_PATH.$review->casino->image)){
				$url	=	CASINO_FULL_IMG_URL.$review->casino->image;
		   }else{
				$url	=	NO_COUNTRY_IMG;
			}
	   
		   $name			=	isset($review->casino->title) ? $review->casino->title : '';
		   $cityName		=	isset($review->casino->city->name) ? $review->casino->city->name : '';
		   $ccountryName	=	isset($review->casino->city->country->name) ? $review->casino->city->country->name : '';
		   $slug			=	isset($review->casino->slug) ? $review->casino->slug : '';
		   if(isset($review->casino->type) && $review->casino->type == 'online'){ 
				$htmlurl	=	$this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view'=>$slug]);
		   }else{
				$htmlurl	=	$this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'casino_view','casino_view'=>$slug]);					   
		   }
		   
		}else if($review->type == 'country'){
		   if(!empty($review->country->image) && file_exists(AMENITIES_ROOT_PATH.$review->country->image)){
				$url	=	AMENITIES_IMG_URL.$review->country->image;
		   }else{
				$url	=	NO_CASINO_IMG;
		   }
			$name		=	$cityName	=	$ccountryName	=	isset($review->country->name) ? $review->country->name : '';
			$slug		=	$review->country->slug;
			$htmlurl	=	$this->Url->build(['plugin' => '','controller' => 'users','action' => 'country_view','country_view'=>$slug]);
			
	   } ?>		
		
		<div class="col-md-2">
			<div class="img_filter">
				<div class="img_item">
				<a href="javascript:void(0);" class="pro_img_change1">
					<img  alt="Image loading" src="<?php
if(!empty($review->user->profile_image) && file_exists(PROFILE_ROOT_PATH.$review->user->profile_image)){
	$url1	=	WEBSITE_URL.'image.php?width=150px&height=150px&cropratio=1:1&image='.PROFILE_IMG_URL.$review->user->profile_image;					
}else if($review->user->facebook_id){
	$url1	=	 'http://graph.facebook.com/'.$userDetails->facebook_id.'/picture?type=large'; 
}else{  
	$sex	=	$review->user->sex;
	$url1	=	WEBSITE_URL.'image.php?width=150px&height=150px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$sex.'.png';
} echo $url1;  ?>"/>
				</a>
				</div>
                 <?php echo $review->user->full_name; ?>
               <span><?php echo $review->user->city; ?></span>
            </div>
        </div>        	
         <div class="col-md-7">
            <div class="contri_text contri_text1">
               <h3><?php 
					$now = new Time($review->created);
					$utb_tm = $now->timeAgoInWords(
					['format' => 'MMM d, YYY', 'end' => '+1 year']);	
					$utb_tm = current(explode(',', $utb_tm));
						$ago_tm = substr($utb_tm, -3);
						if($ago_tm != 'ago'){
							$utb_tm = $utb_tm.' ago';
						}
						echo $utb_tm;
              // echo $review->created->format('M,d Y'); ?></h3>
               <p><?php echo nl2br($review->comment); ?></p>
            </div>
            <div class="show_all_btn">
               <?php if(count($review->question_comments) > 0){ ?><a anstxt="Show all answers" href="javascript:void(0);" class="show_all_btn1 "
               	id="hide_show_ans" divid="<?php echo $review->id ?>" ans_no="<?php echo count($review->question_comments)?>">Show all answers(<?php echo count($review->question_comments); ?>)</a><?php } ?>
            </div>
         </div>	  
         <div class="col-md-3">
            <div class="right_img_session">
			<a href="<?php echo $htmlurl; ?>">
               <img src="<?php echo WEBSITE_URL.'image.php?width=400px&height=215px&cropratio=2:1&image='.$url; ?>" alt="img"></a>
            </div>
         </div>
	</div>
		<div class="col-md-12" style="display:none" id="an<?php echo $review->id; ?>">
		<?php foreach($review->question_comments as $question_comments){ ?>
			<div class="filter_post_item">
				 <div class="col-md-3">
					<div class="img_filter">
						<div class="img_item">
						<a href="javascript:void(0);" class="pro_img_change1">
							<img  alt="Image loading" src="<?php
							if(!empty($question_comments->user->profile_image) && file_exists(PROFILE_ROOT_PATH.$question_comments->user->profile_image)){
								$url1	=	WEBSITE_URL.'image.php?width=50px&height=50px&cropratio=1:1&image='.PROFILE_IMG_URL.$question_comments->user->profile_image;					
							}else if($question_comments->user->facebook_id){
								$url1	=	 'http://graph.facebook.com/'.$question_comments->user->facebook_id.'/picture?type=large'; 
							}else{  
								$sex	=	$question_comments->user->sex;
								$url1	=	WEBSITE_URL.'image.php?width=50px&height=50px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$sex.'.png';
							} echo $url1;  ?>"/>
						</a>
						</div>
						 <?php echo $question_comments->user->full_name; ?>
					   <span><?php echo $question_comments->user->city; ?></span>
					</div>			 
				 </div>
				 <div class="col-md-9">
					<div class="contri_text contri_text1">
					   <h3><?php 
						$now = new Time($question_comments->created);
						$utb_tm =  $now->timeAgoInWords(
						['format' => 'MMM d, YYY', 'end' => '+1 year']);
						$utb_tm = current(explode(',', $utb_tm));
						$ago_tm = substr($utb_tm, -3);
						if($ago_tm != 'ago'){
							$utb_tm = $utb_tm.' ago';
						}
						echo $utb_tm;	   
					   //echo $question_comments->created->format('M,d Y'); ?></h3>
					   <p><?php echo nl2br($question_comments->comment); ?></p>
					</div>
				 </div>
			 </div>
   <?php } ?>
		</div>
   <?php } ?>   
	</div>
</div>
<script>
	$(document).on('click','.show_all_btn1',function(){
			divid = $(this).attr('divid');
			hidn_div = "#an"+divid;

			no_of_ans = $(this).attr("ans_no");
			atrb_anstxt = $(this).attr('anstxt');
			show_ans_txt = "Show all answers("+no_of_ans+")";

			if(atrb_anstxt === "Show all answers") {
				$(this).attr("anstxt","Hide all answers");
				$(hidn_div).show();
				$(this).text("Hide all answers");
			} else {
				$(this).attr("anstxt","Show all answers");
				$(hidn_div).hide();
				$(this).text(show_ans_txt);
			}
	});
</script>