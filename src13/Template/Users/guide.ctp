<div class="banner_inner banner_back_top  img_block6"> 
  <div class="banner_info banner_textblock">
      <div class="container">
         <h3><?php echo $block->title;?></h3>
         <div class="banner_post">
            <div class="col-md-6">
               <?php echo $block->description;?>
            </div>
            <div class="col-md-6">
               <?php echo $block->second_description;?>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="mid_wrapper">
   <div class="beginners_info beginners_info_2">
      <div class="container">
         <div class="row">
            <div class="beginners_post">
               <div class="title">
                  <h2>BEGINNERS GUIDE TO CASINOS</h2>
                  <span></span> 
               </div>
			    <?php foreach($guideContent as $contents)
            {
         ?>
               <div class="col-md-6">
                  <div class="beginners_item_in">
                     <div class="beginners_item">
					 <a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'users','action' => 'guide_view','guide_view' => $contents->slug]); ?>">
					    <?php 
                  if(!empty($contents->image2) && file_exists(GALLERY_ROOT_PATH.$contents->image2)){
                     echo $this->Html->image(WEBSITE_URL.'image.php?width=95px&height=95px&cropratio=1:1&image='.GALLERY_IMG_URL.$contents->image2,['class' => 'img-responsive','alt' => 'Image',]);
                  } ?>
					 </a>
					 </div>
                     <div class="beginners_text beginners_text_2">
                        
               <h4> <a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'users','action' => 'guide_view','guide_view' => $contents->slug]); ?>"><?php echo $contents->title;?></a></h4>
               <p><?php echo $contents->sdescription;?></p>
                     </div>
                  </div>
               </div>
			<?php } ?>
            </div>
         </div>
      </div>
   </div>
   <div class="gamble_online_info gamble_online_info_2">
      <div class="container">
         <div class="title">
            <h2><?php echo $block->middle_title;?></h2>
            <p><?php echo $block->middle_short_description;?></p>
            <span></span> 
         </div>
         <div class="gamble_online_post">
            <div class="gamble_online_item">
               <?php echo $block->full_description;?>
            </div>
         </div>
      </div>
   </div>
</div>