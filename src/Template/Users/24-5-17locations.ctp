<?php use Cake\Utility\Inflector; ?><div class="banner_inner banner_back_img banner_land_based"> 
  <div class="banner_info banner_textblock"> 
  <div class="container">
   <h1><?php echo (isset($headBlock->_translations[$Defaultlanguage]->title) && !empty($headBlock->_translations[$Defaultlanguage]->title)) ? $headBlock->_translations[$Defaultlanguage]->title : $headBlock->_translations['en']->title; ?></h1>
  <div class="banner_post banner_parg">
  
  <div class="col-md-6">
 <div><?php echo $this->App->force_balance_tags((!empty($headBlock->_translations[$Defaultlanguage]->head_first_block)) ? $headBlock->_translations[$Defaultlanguage]->head_first_block : $headBlock->_translations['en']->head_first_block); ?></div>
  </div>
  
  <div class="col-md-6">
 <div><?php  echo $this->App->force_balance_tags((!empty($headBlock->_translations[$Defaultlanguage]->head_second_block)) ? $headBlock->_translations[$Defaultlanguage]->head_second_block : $headBlock->_translations['en']->head_second_block); ?></div>
  </div>
  </div>
  </div>  
  </div>
</div>
<div class="mid_wrapper">
<div class="gamble_online land_based_info">
  <div class="container">
  <div class="title">
        <h2><?php echo (isset($headBlock->_translations[$Defaultlanguage]->sub_title) && !empty($headBlock->_translations[$Defaultlanguage]->sub_title)) ? $headBlock->_translations[$Defaultlanguage]->sub_title : $headBlock->_translations['en']->sub_title; ?></h2>
        <div><?php echo (isset($headBlock->_translations[$Defaultlanguage]->sub_title_description) && !empty($headBlock->_translations[$Defaultlanguage]->sub_title_description)) ? $headBlock->_translations[$Defaultlanguage]->sub_title_description : $headBlock->_translations['en']->sub_title_description; ?></div>
        <span></span> </div>
		<div class="ChooosetypeRow">
  <?php foreach($Continents as  $cat){ ?>
				<div class="col">
			<a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' =>  Inflector::camelize(Inflector::underscore($cat->slug)))); ?>">
				   <div class="block"><div class="block_2"><i><img src="<?php echo GALLERY_IMG_URL.$cat->back_image; ?>" alt="icon"></i><i class="fa"><img src="<?php echo GALLERY_IMG_URL.$cat->image; ?>" alt="icon"></i></div></div>
				   <div class="col_block"><span><?php  echo (!empty($cat->_translations[$Defaultlanguage]->icon_title)) ? $cat->_translations[$Defaultlanguage]->icon_title : $cat->_translations['en']->icon_title; ?></span></div>
			</a>
				</div>
  <?php } ?>  
  </div>
  </div>
  </div>
  <?php if(!empty($cities)){ ?>
  <div class="casino_info">
  <div class="container">
  <div class="title">
        <h2><?php echo (isset($headBlock->_translations[$Defaultlanguage]->middle_title) && !empty($headBlock->_translations[$Defaultlanguage]->middle_title)) ? $headBlock->_translations[$Defaultlanguage]->middle_title : $headBlock->_translations['en']->middle_title; ?></h2>
        <div><?php echo (isset($headBlock->_translations[$Defaultlanguage]->middle_title_description) && !empty($headBlock->_translations[$Defaultlanguage]->middle_title_description)) ? $headBlock->_translations[$Defaultlanguage]->middle_title_description : $headBlock->_translations['en']->middle_title_description; ?></div>
        <span></span> </div>
        <div class="casino_city">
        <ul>
        <li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'casinos','action' => 'casino_view' ,'casino_view' => $cities[0]->city->slug)); ?>"><?php
			 if(!empty($cities[0]->image) && file_exists(GALLERY_ROOT_PATH.$cities[0]->image)){
			 echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=157px&height=217px&cropratio=1:1&image='.GALLERY_IMG_URL.$cities[0]->image,['alt' => 'image','class' => 'img-responsive','height' => '217','width' => '157']);
			 } ?>
        <div class="casino_detail">
        <h2><?php echo $cities[0]->city->name; ?></h2>
        <p><?php echo $cities[0]->city->review_count; ?> Reviews</p>
        </div></a>
        </li>
        <li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'casinos','action' => 'casino_view' ,'casino_view'  =>$cities[1]->city->slug)); ?>"><?php
			 if(!empty($cities[1]->image) && file_exists(GALLERY_ROOT_PATH.$cities[1]->image)){
			 echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=157px&height=217px&cropratio=1:1&image='.GALLERY_IMG_URL.$cities[1]->image,['alt' => 'image','class' => 'img-responsive','height' => '217','width' => '157']);
			 } ?>
        <div class="casino_detail">
        <h2><?php echo $cities[1]->city->name; ?></h2>
        <p><?php echo $cities[1]->city->review_count; ?> Reviews</p>
        </div></a></li>
        <li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'casinos','action' => 'casino_view' ,'casino_view'  =>$cities[2]->city->slug)); ?>"><?php
			 if(!empty($cities[2]->image) && file_exists(GALLERY_ROOT_PATH.$cities[2]->image)){
			 echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=157px&height=217px&cropratio=1:1&image='.GALLERY_IMG_URL.$cities[2]->image,['alt' => 'image','class' => 'img-responsive','height' => '217','width' => '157']);
			 } ?>
        <div class="casino_detail">
        <h2><?php echo $cities[2]->city->name; ?></h2>
        <p><?php echo $cities[2]->city->review_count; ?> Reviews</p>
        </div></a></li>
        <li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'casinos','action' => 'casino_view' ,'casino_view'  =>$cities[3]->city->slug)); ?>"><?php
			 if(!empty($cities[3]->image) && file_exists(GALLERY_ROOT_PATH.$cities[3]->image)){
			 echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=462px&height=161px&cropratio=2:1&image='.GALLERY_IMG_URL.$cities[3]->image,['alt' => 'image','class' => 'img-responsive','height' => '462','width' => '161']);
			 } ?>
        <div class="casino_detail">
        <h2><?php echo $cities[3]->city->name; ?></h2>
        <p><?php echo $cities[3]->city->review_count; ?> Reviews</p>
        </div></a></li>
        </ul>
        <ul class="nxt-info">
        <li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'casinos','action' => 'casino_view' ,'casino_view'  =>$cities[4]->city->slug)); ?>"><?php
			 if(!empty($cities[4]->image) && file_exists(GALLERY_ROOT_PATH.$cities[4]->image)){
			 echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=462px&height=161px&cropratio=2:1&image='.GALLERY_IMG_URL.$cities[4]->image,['alt' => 'image','class' => 'img-responsive','height' => '462','width' => '161']);
			 } ?>
        <div class="casino_detail">
        <h2><?php echo $cities[4]->city->name; ?></h2>
        <p><?php echo $cities[4]->city->review_count; ?> Reviews</p>
        </div></a></li>
		<li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'casinos','action' => 'casino_view' ,'casino_view'  =>$cities[5]->city->slug)); ?>"><?php
			 if(!empty($cities[5]->image) && file_exists(GALLERY_ROOT_PATH.$cities[5]->image)){
			 echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=157px&height=217px&cropratio=1:1&image='.GALLERY_IMG_URL.$cities[5]->image,['alt' => 'image','class' => 'img-responsive','height' => '217','width' => '157']);
			 } ?>
        <div class="casino_detail">
        <h2><?php echo $cities[5]->city->name; ?></h2>
        <p><?php echo $cities[5]->city->review_count; ?> Reviews</p>
        </div></a></li>
		<li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'casinos','action' => 'casino_view' ,'casino_view'  =>$cities[6]->city->slug)); ?>"><?php
			 if(!empty($cities[6]->image) && file_exists(GALLERY_ROOT_PATH.$cities[6]->image)){
			 echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=157px&height=217px&cropratio=1:1&image='.GALLERY_IMG_URL.$cities[6]->image,['alt' => 'image','class' => 'img-responsive','height' => '217','width' => '157']);
			 } ?>
        <div class="casino_detail">
        <h2><?php echo $cities[6]->city->name; ?></h2>
        <p><?php echo $cities[6]->city->review_count; ?> Reviews</p>
        </div></a></li>
		<li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'casinos','action' => 'casino_view' ,'casino_view'  =>$cities[7]->city->slug)); ?>"><?php
			 if(!empty($cities[7]->image) && file_exists(GALLERY_ROOT_PATH.$cities[7]->image)){
			 echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=157px&height=217px&cropratio=1:1&image='.GALLERY_IMG_URL.$cities[7]->image,['alt' => 'image','class' => 'img-responsive','height' => '217','width' => '157']);
			 } ?>
        <div class="casino_detail">
        <h2><?php echo $cities[7]->city->name; ?></h2>
        <p><?php echo $cities[7]->city->review_count; ?> Reviews</p>
        </div></a></li>
        </ul>        
        <ul class="half_col">
        <li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'casinos','action' => 'casino_view' ,'casino_view'  =>$cities[8]->city->slug)); ?>"><?php
			 if(!empty($cities[8]->image) && file_exists(GALLERY_ROOT_PATH.$cities[8]->image)){
			 echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=580px&height=277px&cropratio=2:1&image='.GALLERY_IMG_URL.$cities[8]->image,['alt' => 'image','class' => 'img-responsive','height' => '277','width' => '580']);
			 } ?>
        <div class="casino_detail">
        <h2><?php echo $cities[8]->city->name; ?></h2>
        <p><?php echo $cities[8]->city->review_count; ?> Reviews</p>
        </div></a></li>
        <li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'casinos','action' => 'casino_view' ,'casino_view'  =>$cities[9]->city->slug)); ?>"><?php
			 if(!empty($cities[9]->image) && file_exists(GALLERY_ROOT_PATH.$cities[9]->image)){
			 echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=580px&height=277px&cropratio=2:1&image='.GALLERY_IMG_URL.$cities[9]->image,['alt' => 'image','class' => 'img-responsive','height' => '277','width' => '580']);
			 } ?>
        <div class="casino_detail">
        <h2><?php echo $cities[9]->city->name; ?></h2>
        <p><?php echo $cities[9]->city->review_count; ?> Reviews</p>
        </div></a></li>
        </ul>
        </div>
  </div>
  </div>
  <?php } ?>
  <div class="hotels">
  <div class="container">
        
        <div class="title">
        <h3><?= __('land_based_casino.hotels_in_popular_destination_find_hotels_motels_near_you'); ?></h2>
        <span></span> </div>
 <?php echo $this->element('worldwide_popular_casino'); ?>
 </div>
  </div>
  
  
  <div class="gamble_online gamble_online_info2 gamble_online_land_based">
  <div class="container">
   <div class="title">
        <h2><?php echo (isset($headBlock->_translations[$Defaultlanguage]->footer_main_title) && !empty($headBlock->_translations[$Defaultlanguage]->footer_main_title)) ? $headBlock->_translations[$Defaultlanguage]->footer_main_title : $headBlock->_translations['en']->footer_main_title; ?></h2><div><?php echo (isset($headBlock->_translations[$Defaultlanguage]->description) && !empty($headBlock->_translations[$Defaultlanguage]->description)) ? $headBlock->_translations[$Defaultlanguage]->description : $headBlock->_translations['en']->description; ?></div>
        <span></span> </div>
 <div class="gamble_online_post">
  <div class="gamble_online_item">
  <?php echo (isset($headBlock->_translations[$Defaultlanguage]->second_description) && !empty($headBlock->_translations[$Defaultlanguage]->second_description)) ? $headBlock->_translations[$Defaultlanguage]->second_description : $headBlock->_translations['en']->second_description; ?>
  </div>
  </div>
  </div>
  </div>
  </div>
  