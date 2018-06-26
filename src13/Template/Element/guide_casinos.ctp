<div class="row">
   <div class="beginners_post">
      <div class="title3">
         <p>BEGINNERS GUIDE TO CASINOS</p>
         <span></span>
      </div>
         <?php foreach($guideContent as $contents)
            {
         ?>
      <div class="col-md-6">
        <div class="beginners_item_in">
            <div class="beginners_item"><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'users','action' => 'guide_view','guide_view' => $contents->slug]); ?>">
           <?php 
                  if(!empty($contents->image) && file_exists(GALLERY_ROOT_PATH.$contents->image)){
                     echo $this->Html->image(WEBSITE_URL.'image.php?width=95px&height=95px&cropratio=1:1&image='.GALLERY_IMG_URL.$contents->image,['class' => 'img-responsive','alt' => 'Image',]);
                  } ?></a>
            </div>
            <div class="beginners_text gidtitle">
               <h4><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'users','action' => 'guide_view','guide_view' => $contents->slug]); ?>"><?php echo (!empty($contents->_translations[$Defaultlanguage]->title)) ? $contents->_translations[$Defaultlanguage]->title : $contents->_translations['en']->title ; ?></a></h4>
               <div><?php echo $this->App->force_balance_tags((!empty($contents->_translations[$Defaultlanguage]->sdescription)) ? $contents->_translations[$Defaultlanguage]->sdescription : $contents->_translations['en']->sdescription) ; ?></div>
            </div>
         </div>
      </div>
      <?php
         }
      ?>
   </div>
   <div class="view_more_btn">
      <a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'guide')); ?>">View more</a>
   </div>
</div>