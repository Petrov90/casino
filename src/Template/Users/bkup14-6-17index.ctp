<?php use Cake\Core\Configure; ?>
<div class="banner">
   <div class="flexslider">
      <ul class="slides fsl">
         <?php foreach($sliders as $images){ ?>
         <li><img src="<?php echo SLIDER_IMG_URL.$images->image ?>" class="img-responsive" alt="Image loading" /></li>
         <?php } ?>
      </ul>
   </div>
   <div class="transparent-black">
      <div class="container">
         <div class="banner-content">
            <h1><?= __('homepage.discover_amazing_casinos') ?></h1>
            <small>Most Trusted Casino Review Community & Directory</small>
            <div class="search-back">
               <div class="top-search" data-ng-app>
                  <input type="text" data-ng-model="city_name" name="city_name" id="city_name" class="autocomplete1" value="" placeholder="Casino name or destination" >
                  <a data-ng-href="<?php echo WEBSITE_URL; if($Defaultlanguage != 'en'){ echo $Defaultlanguage.'/'; } ?>search/{{city_name}}" class="search-back-a"><?= __('homepage.search'); ?></a>			
               </div>
            </div>
         </div>
      </div>
   </div><?php /*
   <div class="find_line"><?php echo (!empty($allBlocks[3]->_translations[$Defaultlanguage]->description)) ? $allBlocks[3]->_translations[$Defaultlanguage]->description : $allBlocks[3]->_translations['en']->description ; ?></div>*/ ?>
</div>
<div class="mid_wrapper">

   <div class="Most_Popular_info">
      <div class="container">
         <div class="title">
            <h2><?php echo (!empty($allBlocks[4]->_translations[$Defaultlanguage]->description)) ? $allBlocks[4]->_translations[$Defaultlanguage]->title : $allBlocks[4]->_translations['en']->title ; ?></h2>
            <?php /*echo (!empty($allBlocks[4]->_translations[$Defaultlanguage]->description)) ? $allBlocks[4]->_translations[$Defaultlanguage]->description : $allBlocks[4]->_translations['en']->description ; ?>
            <span></span> */?><span></span> 
         </div>         
			<?php echo $this->element('most_popular_online_casino_homepage'); ?>
      </div>
   </div>
   <div class="gamble_online gamble_online_info2 gamble_online_block2 ">
      <div class="container">
         <div class="title">
            <h2><?php echo (!empty($allBlocks[6]->_translations[$Defaultlanguage]->title)) ? $allBlocks[6]->_translations[$Defaultlanguage]->title : $allBlocks[6]->_translations['en']->title ; ?></h2>
            <?php echo (!empty($allBlocks[6]->_translations[$Defaultlanguage]->description)) ? $allBlocks[6]->_translations[$Defaultlanguage]->description : $allBlocks[6]->_translations['en']->description ; ?>
            <span></span> 
         </div>
         <div class="ChooosetypeRow">
            <div class="col gam_cat">
               <a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'Casinos', 'action' => 'onlineCasino')); ?>">            
                  <div class="block">
                     <div class="block_2"><i><img src="<?php echo WEBSITE_IMG_URL; ?>img_25.1.png" alt="icon"></i><i class="fa"><img src="<?php echo WEBSITE_IMG_URL; ?>img_25.png" alt="icon"></i></div>
                  </div>
                  <div class="col_block"><span>Casino</span></div>
               </a>
            </div>
            
            <div class="col gam_cat">
               <a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'Casinos', 'action' => 'pokers')); ?>">
                  <div class="block">
                     <div class="block_2"><i><img src="<?php echo WEBSITE_IMG_URL; ?>img_8.1.png" alt="icon"></i><i class="fa"><img src="<?php echo WEBSITE_IMG_URL; ?>img_8.png" alt="icon"></i></div>
                  </div>
                  <div class="col_block"><span>Poker</span></div>
               </a>   
            </div>
            
            <div class="col gam_cat">
               <a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'Casinos', 'action' => 'bingos')); ?>">
                  <div class="block">
                     <div class="block_2"><i><img src="<?php echo WEBSITE_IMG_URL; ?>img_9.1.png" alt="icon"></i><i class="fa"><img src="<?php echo WEBSITE_IMG_URL; ?>img_9.png" alt="icon"></i></div>
                  </div>
                   <div class="col_block"><span>Bingo</span></div>
                  </a>
            </div>
            
            <div class="col gam_cat">
               <a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'Casinos', 'action' => 'sportBettings')); ?>">            
                  <div class="block">
                     <div class="block_2"><i><img src="<?php echo WEBSITE_IMG_URL; ?>img_10.1.png" alt="icon"></i><i class="fa"><img src="<?php echo WEBSITE_IMG_URL; ?>img_10.png" alt="icon"></i></div>
                  </div>
                  <div class="col_block"><span>Sportsbetting</span></div>
               </a>
            </div>
            
         </div>
      </div>
   </div>
   <?php if(!empty($popularCasinos)){ ?>
   <div class="Explore">
      <div class="container">
         <div class="title">
            <h2><?php echo (!empty($allBlocks[5]->_translations[$Defaultlanguage]->title)) ? $allBlocks[5]->_translations[$Defaultlanguage]->title : $allBlocks[5]->_translations['en']->title ; ?></h2>
            <?php echo (!empty($allBlocks[5]->_translations[$Defaultlanguage]->description)) ? $allBlocks[5]->_translations[$Defaultlanguage]->description : $allBlocks[5]->_translations['en']->description ; ?>
            <span></span> 
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="explore-img shadwo_none">
                  <ul>
                     <?php foreach($popularCasinos as $popularCasino){  ?>
                     <li class="explore_links">
                     <a href="<?php 
                                 if($popularCasino->type == 'normal'){
                                 echo $this->Url->build(['plugin' => '','controller' => 'Casinos','action' => 'casino_view','casino_view' => $popularCasino->casino->slug]);
                                 }else{
                                 echo $this->Url->build(['plugin' => '','controller' => 'Casinos','action' => 'casino_view','casino_view' => $popularCasino->casino->slug]);
                                 }
                                 ?>">
                        <div class="img_block">
                           <?php 
                              if(!empty($popularCasino->logo) && file_exists(PROMOTION_CASINO_LOGO_ROOT_PATH.$popularCasino->logo)){
                              echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=280px&height=233px&cropratio=1:1&image='.PROMOTION_CASINO_LOGO_IMG_URL.$popularCasino->logo,['alt' =>"Image loading"]);
                              }else{
                              echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=280px&height=233px&cropratio=1:1&image='.NO_CASINO_IMG,['class' => 'img-responsive','alt' =>"Image loading"]);
                              }  ?>
                           <div class="overlay">
                              <span><?php echo $popularCasino->text ?></span>
                              <p><?php echo isset($popularCasino->casino->city->name) ? $popularCasino->casino->city->name : ''; ?></p>
                           </div>
                        </div>
                        </a>
                     </li>
                     <?php } ?>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php } ?>
   
   <?php /*
      <div class="map">
      <div class="container">
      <div class="title">
      <h2><?php echo (!empty($allBlocks[7]->_translations[$Defaultlanguage]->title)) ? $allBlocks[7]->_translations[$Defaultlanguage]->title : $allBlocks[7]->_translations['en']->title ; ?></h2><?php echo (!empty($allBlocks[7]->_translations[$Defaultlanguage]->description)) ? $allBlocks[7]->_translations[$Defaultlanguage]->description : $allBlocks[7]->_translations['en']->description ; ?>
   <span></span> 
</div>
<div class="row">
   <div class="col-md-12">
      <div class="map-img"> <img src="<?php echo WEBSITE_IMG_URL; ?>map.jpg" alt="Image loading" class="img-responsive" /> </div>
   </div>
</div>
</div>
</div>*/?>

<div class="hotels hotels_info_2">
   <div class="container">
      <div class="title">
         <h2><?= __('homepage.casinos_in_popular_destinations'); ?></h2>
         <span></span> 
      </div>
      <?php echo $this->element('worldwide_popular_casino'); ?>
   </div>
</div>
<div class="gamble_online_info gamble_online_in2">
   <div class="container">
      <div class="title">
         <h2><?php echo (!empty($allBlocks[25]->_translations[$Defaultlanguage]->title)) ? $allBlocks[25]->_translations[$Defaultlanguage]->title : $allBlocks[25]->_translations['en']->title ; ?></h2>
         <div><?php echo (!empty($allBlocks[25]->_translations[$Defaultlanguage]->description)) ? $allBlocks[25]->_translations[$Defaultlanguage]->description : $allBlocks[25]->_translations['en']->description ; ?></div>
         <span></span> 
      </div>
      <div class="gamble_online_post">
         <div class="gamble_online_item">
            <?php echo (!empty($allBlocks[25]->_translations[$Defaultlanguage]->second_description)) ? $allBlocks[25]->_translations[$Defaultlanguage]->second_description : $allBlocks[25]->_translations['en']->second_description ; ?>
         </div>
      </div>
   </div>
</div>
<div class="experience-user shadwo_none experience_user_info">
   <div class="container">
      <div class="title">
         <h2><?php echo (!empty($allBlocks[8]->_translations[$Defaultlanguage]->title)) ? $allBlocks[8]->_translations[$Defaultlanguage]->title : $allBlocks[8]->_translations['en']->title ; ?></h2>
         <?php echo (!empty($allBlocks[8]->_translations[$Defaultlanguage]->description)) ? $allBlocks[8]->_translations[$Defaultlanguage]->description : $allBlocks[8]->_translations['en']->description ; ?>
         <span></span> 
      </div>
      <?php echo $this->element('review_list'); ?>
      <div class="block"><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'newReviews')); ?>" class="btn trans_btn"><?= __('homepage.view_more') ?></a></div>
   </div>
</div>
</div>

