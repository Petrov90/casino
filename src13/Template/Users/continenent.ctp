<div class="banner_inner banner_back_top  img_block12">
   <div class="banner_info banner_textblock">
      <div class="container"><?php if(!empty($result->name)){ ?>
	  <h1><?php echo $result->name; ?></h1><?php } ?>
         <div class="banner_post banner_parg">
            <div class="col-md-6"><?php /*
               <span><?php echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=112px&height=127px&cropratio=1:1&image='.GALLERY_IMG_URL.$result->head_image,['alt' => 'Image','height' => 127,'width' => 112]); ?></span>*/ ?>
               <?php echo $result->head_first_block; ?>
            </div>
            <div class="col-md-6">
               <?php echo $result->head_second_block; ?>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="mid_wrapper">
   <div class="North_America_Info">
      <div class="container">
         <h2><?php echo $result->niddle_title; ?></h2>
         <div class="North_America_post">
            <div class="North_info">
			<?php foreach($casinosData as $casinos){ ?>
               <div class="col-md-6">
                  <div class="clint_post nort_Line">
                     <div class="clint_item"><?php if(!empty($casinos->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$casinos->image)){
						echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=239px&height=120px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$casinos->image,['alt' => 'Image','height'=>120, 'width'=>239]);
						}else{
							echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=239px&height=120px&cropratio=2:1&image='.NO_CASINO_IMG,['alt' => 'Image','height'=>120, 'width'=>239]);	
							
						} ?></div>
                     <div class="north_post">
                        <span><a class="clr" href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'casino_view','casino_view' => $casinos->slug]); ?>"><?php echo $casinos->title; ?></a></span>
                        <div class="clientRating readonly" data-score="<?php echo $casinos->avg_rating; ?>"></div>
                        <p><?php echo $casinos->city->name; ?>, <?php echo $casinos->country->name; ?></p>
                     </div>
                  </div>
               </div>
			<?php }
			
				$paginator    =    $this->Paginator; ?>
				<div class="Pagination_nav">
					<ul>	
					<?php
						echo $paginator->prev(__('<i class="fa fa-caret-left"></i>', true),
							array(
								'id'=> 'p_prev',
								'tag'=> 'li',
								'escape'=>false
							),
							null,
							array(
								'class'=>'pagination',
								'escape'=>false,
							   'tag'=> 'li',
								'disabledTag'=>'a'
							)
						);
						echo $paginator->numbers(array(
						   'tag'=> 'li',
							'span'=>false,
							'currentClass' => 'pagination',
							'currentTag' => 'a',
							'separator' => false,
							'class' => "pagination"
							
						));    
						echo $paginator->next(__('<i class="fa fa-caret-right"></i>', true),
							array(
								'id'=> 'p_next',
								'tag'=> 'li',
								'escape'=>false
							),
							null,
							array(
								'class'=>'pagination',
								'escape'=>false,
							   'tag'=> 'li',
								'disabledTag'=>'a'
							)
						);
					?>
					</ul>
				</div>
            </div>
         </div>
      </div>
      <div class="Countries_info">
         <div class="container">
            <h2>Countries</h2>
            <div class="Countries_post">
               <div class="Countries_list">
                  <ul>
                      <?php foreach($result->countries as $country){ ?>
					  <li><?php if(!empty($country->flag) && file_exists((AMENITIES_ROOT_PATH.$country->flag))){ ?>
							<img src="<?php echo WEBSITE_UPLOADS_URL.'image.php?width=20px&height=15px&cropratio=2:1&image='.AMENITIES_IMG_URL.$country->flag ?>" alt="<?php echo $country->name; ?>" title="<?php echo $country->name; ?>"/> 
					<?php } ?>
						<a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'country_view' ,'country_view' => $country->slug)); ?>"><?php echo $country->name; ?></a></li>
						<?php } ?>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <div class="Most_Popular_info">
         <div class="container">
            <h2>  Most Popular Online Casinos</h2>
			<?php echo $this->element('most_popular_online_casino_homepage'); ?>
		 </div>
      </div>
      <div class="gamble_online_info Most_INFO2">
         <div class="container">
            <div class="title">
               <h2><?php echo $result->footer_main_title; ?></h2>
            </div>
            <div class="gamble_online_post">
               <div class="gamble_online_item">
                  <?php echo $result->description; ?>
               </div>
            </div>
         </div>
      </div>
      <div class="experience-user experience_user_info">
         <div class="container">
            <div class="title content_2">
               <h2>Lastest reviews</h2>
            </div>
		<?php echo $this->element('review_list'); ?>
		</div>
      </div>
   </div>
</div><?php $this->Html->scriptStart(array('block' => 'custom_script')); ?>showChar=130,$(window).load(function(){ph=0,$(".ppppp ul").each(function(){h=$(this).height(),h>ph&&(ph=h)}),$(".ppppp ul").height(ph),ph=0,$(".whole-block").each(function(){h=$(this).height(),h>ph&&(ph=h)}),$(".whole-block").css("min-height",ph)});
<?php $this->Html->scriptEnd(); ?>