<?php use Cake\Core\Configure;
use Cake\I18n\Time; ?>
<script>
$(document).ready(function(){
		/*$("#rvbtn1").click(function(){
		
		});*/
});
function myJsFunc1() {
  //  alert( 'you clicked on the link' );
    $('.rv_cls1').removeClass('hide');
	$('#rvbtn1').addClass('hide');
    return true;
}	
function myJsFunc2() {
 //   alert( 'you clicked on the link' );
    $('.rv_cls2').removeClass('hide');
	$('#rvbtn2').addClass('hide');
    return true;
}
	
</script>
<div class="row"> <?php $rv_cnt=0;
	foreach($reviewList as $review){ $rv_cnt++;
		$rv_cls = '';
		if($rv_cnt == 1) {
			
			echo '<div class="rv_cls0">';
		}		
		else if($rv_cnt == 4) {
			
			echo '<div class="rv_cls1 hide">';
		}else if($rv_cnt == 7){
			echo '<div class="rv_cls2 hide">';	
		}

	    ?>
   		<div class="col-md-4 <?php if($review->type == 'casino'){
			echo 'reviews_'.$review->casino->type;	}else{
			echo 'reviews_'.$review->type; } ?>">
      		<div class="whole-block">
        	<?php 
			$htmlurl	=	'';
			$url	=	NO_CASINO_IMG;
			$name	=	'';
			$cityName	=	'';
			if($review->type == 'city'){
			    if(!empty($review->city['casino_images'][0]->file) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$review->city['casino_images'][0]->file)){
					$url	=	CASINO_FULL_IMG_URL.$review->city['casino_images'][0]->file;
			    }else{
					$url	=	NO_CITY_IMG;			
			    }
			   
				$name			=	$cityName	=	isset($review->city->name) ? $review->city->name : '';
				$ccountryName	=	isset($review->city->country->name) ? $review->city->country->name : '';
				$slug			=	$review->city->slug;
				$countrySlug	=	isset($review->city->country->slug) ? $review->city->country->slug : '';
				
				$htmlurl		=	$this->Url->build(['plugin' => '','controller' => 'users','action' => 'city_view','country'=>$countrySlug,'city'=>$slug]);
			}else if($review->type == 'casino'){
			    if(!empty($review->casino['casino_images'][0]->file) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$review->casino['casino_images'][0]->file)){
					$url	=	CASINO_FULL_IMG_URL.$review->casino['casino_images'][0]->file;
			    }else{
					$url	=	NO_CASINO_IMG;
				}
				// pr($review);
			    $name =	isset($review->casino->title) ? $review->casino->title : '';
			    $cityName =	isset($review->casino->city->name) ? $review->casino->city->name : '';
			   // $ccountryName	=	isset($review->casino->city->country->name) ? $review->casino->city->country->name : '';
			   $slug = isset($review->casino->slug) ? $review->casino->slug : '';
  			    if(isset($review->casino->type) && $review->casino->type == 'online'){
					$htmlurl	=	$this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view'=>$slug]);
					$rd_to_cmnt = $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','#'=>'rw_div','online_casino_view'=>$slug]);
			    }else{
					$htmlurl	=	$this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'casino_view','casino_view'=>$slug]);
					$rd_to_cmnt = $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'casino_view','#'=>'rw_div','casino_view'=>$slug]);
				}				   
			}else if($review->type == 'country'){
			   if(!empty($review->country['casino_images'][0]->file) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$review->country['casino_images'][0]->file)){
					$url	=	CASINO_FULL_IMG_URL.$review->country['casino_images'][0]->file;
			   }else{
					$url	=	NO_COUNTRY_IMG;
				   
			   }
			   			   
				$name		=	$cityName	=	$ccountryName	=	isset($review->country->name) ? $review->country->name : '';
				$slug		=	$review->country->slug;
				$htmlurl	=	$this->Url->build(['plugin' => '','controller' => 'users','action' => 'country_view','country_view'=>$slug]);
			} ?>
				<div class="user-area">
					<a href="<?php echo $htmlurl; ?>">				
            		<img  alt="Image loading" src="<?php echo WEBSITE_URL.'image.php?width=400px&height=215px&cropratio=2:1&image='.$url; ?>" class="img-responsive " /><span class="user-area-new"><?php echo $name; ?></span></a>			
         		</div>
		        <div class="col-md-3">
		            <div class="">
		            	<a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'user_slug' ,'user_slug' => $review->user->slug)); ?>">
		               <?php 
		                  if(!empty($review->user->profile_image) && file_exists(PROFILE_ROOT_PATH.$review->user->profile_image)){ ?>
		               <img src="<?php echo  WEBSITE_URL.'image.php?width=66px&height=66px&cropratio=1:1&image='.PROFILE_IMG_URL.$review->user->profile_image; ?>" class="img-responsive man" alt="img" />
		               <?php }elseif(!empty($review->user->facebook_id)){ ?>
		               <img alt="img" class="img-responsive man" src="<?php echo 'http://graph.facebook.com/'.$review->user->facebook_id.'/picture?type=large' ?>" alt="img" />
		               <?php }else{ 
						$sex = $review->user->sex;	?>
		               <img src="<?php echo WEBSITE_URL.'image.php?width=66px&height=66px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$sex.'.png'; ?>" alt="img" class="img-responsive man"/>
		               <?php } ?> 
		            	</a>
		            </div>
		        </div>
		        <div class="col-md-9">
		            <div class="man-matter">
		               <p><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'user_slug' ,'user_slug' => $review->user->slug)); ?>"><span class="style"><?php echo $review->user->full_name; ?></span></a> </p>
		               <p>
						<?php 
						$now = new Time($review->created);
						$utb_tm = $now->timeAgoInWords(
							['format' => 'MMM d, YYY', 'end' => '+1 year']);
						$utb_tm = current(explode(',', $utb_tm));
						$ago_tm = substr($utb_tm, -3);
						if($ago_tm != 'ago'){
							$utb_tm = $utb_tm.' ago';
						}
						echo $utb_tm;		
						/*echo $review->created->format(Configure::read('Date.'.$Defaultlanguage));*/ ?></p>
		               <p class="review"><samp><?= 'Rating' ?></samp><span  class="readonly" data-score="<?php echo $review->rating; ?>"></span></p>
		            </div>
		        </div>
		        <div class="paregraph" id = "rdmore_redirect" >
		            <p class="readmore_redirect" rdlink="<?php echo $htmlurl.'#rw_div'?>">
		            	<span class="fa fa-quote-left qt_lft"></span>
		            		<?php echo nl2br($review->comment); ?>
		            	<span class="fa fa-quote-right qt_rt"></span>
		            </p>
		        </div>
		        <div id="cls_qut" class="hide"><span class="fa fa-quote-right qt_rt"></span></div>
      		</div>
   		</div>

   		<?php  if($rv_cnt == 3) { ?>
   			<div class="block" id="rvbtn1"><a href="#" class="btn trans_btn" onclick="myJsFunc1(); return false;">View More</a></div>

   			<?php } 
 			if($rv_cnt == 6) { ?>
   			<div class="block" id="rvbtn2"><a href="javascript:void(0);" class="btn trans_btn" onclick="myJsFunc2(); return false;">View More</a></div>
   			
   			<?php }
   			if($rv_cnt == 9) { ?>
      <div class="block">
         <a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'newReviews')); ?>" class="btn trans_btn"><?= __('homepage.view_more') ?>
         </a>
      </div><?php }

		if($rv_cnt == 3) {
			echo '</div>';
		}
		elseif($rv_cnt == 6) {
			echo '</div>';
		}else if($rv_cnt ==9){
			echo '</div>';	
		}   			?>



   <?php } ?>   
</div>
 <script>
	showChar	=	100;
	$('.readonly').raty({
		readOnly : true,
		score: function() {
			return $(this).attr('data-score');
		}
	});
	$(window).load(function() {
	    ph = 0, 
		$(".whole-block").each(function() {
	        h = $(this).height(), h > ph && (ph = h)
	    }), $(".whole-block").css("min-height", ph);
	
	});
</script>


