 <?php use Cake\Utility\Inflector; 
      use Cake\Core\Configure;
      use Cake\I18n\Time;
?>
<?php
  //echo "<pre>"; print_r($totalCasino); die;
  $title =   $headBlock->title;
  $head_first_block = $headBlock->head_first_block;
  $faqcategory =   $headBlock->id;
  $faq_mn_title =   $headBlock->faq_mn_title;
  $faq_title =   $headBlock->faq_title;
  $best_casino_title =   $headBlock->best_casino_title;
  $best_casino_des =   $headBlock->best_casino_des;
  $city_title =  $headBlock->city_title;
  $online_gambling_title =  $headBlock->online_gambling_title;
  $most_casino =  $headBlock->most_casino;
?>
<div class="banner_inner banner_back_img banner_land_based casinos-directory"> 
  <div class="banner">
   <div class="transparent-black bonuses">
      <div class="container">
         <div class="banner-content">
            <h1><?= __('homepage.discover_amazing_casinos') ?></h1>
              
            <!-- <div class="search-back">

               <div class="top-search" data-ng-app>
                  <input type="text" data-ng-model="city_name" name="city_name" id="city_id" class="autocomplete" value="" placeholder="Casino name or destination" >
                  
                  <a data-ng-href="<?php echo WEBSITE_URL; if($Defaultlanguage != 'en'){ echo $Defaultlanguage.'/'; } ?>search/{{city_name}}" class="search-back-a"><?= __('homepage.search'); ?></a>       
               </div>

            </div> -->
             <div class="search-back">

               <div class="top-search" data-ng-app>

                  <input type="text" data-ng-model="city_name" name="city_name" id="city_name" class="autocomplete" value="" placeholder="Casino name or destination" >

                  <a data-ng-href="<?php echo WEBSITE_URL; if($Defaultlanguage != 'en'){ echo $Defaultlanguage.'/'; } ?>search/{{city_name}}" class="search-back-a"><?= __('homepage.search'); ?></a>       

               </div>

            </div>

         </div>
      </div>
   </div><?php /*
   <div class="find_line"><?php echo (!empty($allBlocks[3]->_translations[$Defaultlanguage]->description)) ? $allBlocks[3]->_translations[$Defaultlanguage]->description : $allBlocks[3]->_translations['en']->description ; ?></div>*/ ?>
</div>
</div>

<div class="mid_wrapper casinos-directory">
  <div class="worldwide-dir">
    <div class="container">
      <h2><?php
          if(isset($title)){ echo $title;}
               else{  
        echo (isset($headBlock->_translations[$Defaultlanguage]->title) && !empty($headBlock->_translations[$Defaultlanguage]->title)) ? $headBlock->_translations[$Defaultlanguage]->title : $headBlock->_translations['en']->title;
         }
            ?> </h2>
      <div class="diectory-content">
        <div class="gambling-div">
        <?php 
               if(isset($head_first_block)){ echo $head_first_block;}
               else{  
        echo (isset($headBlock->_translations[$Defaultlanguage]->head_first_block) && !empty($headBlock->_translations[$Defaultlanguage]->head_first_block)) ? $headBlock->_translations[$Defaultlanguage]->head_first_block : $headBlock->_translations['en']->head_first_block;
         }
            ?>
               </div>
        <div class="most-compre">
          <span>The most comprehensive casino directory</span>
          <ul>
            <li>
              <img src="../images/the-most-img1.png" alt="img">
              <span><?php echo $totalCasino; ?></span>
              <p>Land-Based Casinos</p>
            </li>
            <li>
              <img src="../images/the-most-img2.png" alt="img">
              <span><?php echo $review_count; ?></span>
              <p>Opinions about Casinos</p>
            </li>
            <li>
              <img src="../images/the-most-img3.png" alt="img">
              <span><?php echo $question_count; ?></span>
              <p>User questions</p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <section class="gambling">
    <div class="container">
      <h2><?php 
               if(isset($city_title)){ echo $city_title;}
               else{  
        echo (isset($headBlock->_translations[$Defaultlanguage]->city_title) && !empty($headBlock->_translations[$Defaultlanguage]->city_title)) ? $headBlock->_translations[$Defaultlanguage]->city_title : $headBlock->_translations['en']->city_title;
         }
            ?></h2>
      <ul>
      <?php if(isset($featureCity) && !empty($featureCity)){
        foreach ($featureCity as $key => $featuseCitya) { 
          //echo "<pre>"; print_r($featuseCitya);  die;
          $countrydetails = $this->SocialShare->countryslug($featuseCitya->country_id);
          //echo $countrydetails->slug; 
          ?>
        <li>
          <a href="<?php echo $this->Url->build(array('controller' => 'users','action' => 'city_view','country' => $countrydetails->slug,'city' => $featuseCitya->slug)); ?>">
          <?php if(isset($featuseCitya->image) && !empty($featuseCitya->image)){ ?>
            <img src="files/<?php echo $featuseCitya->image; ?>" alt="img"> <?php
          }else{ ?>
            <img src="../images/gambling-cities-img.jpg" alt="img"> <?php
          } ?>
          </a>
          <div class="gambling-cities-dec">
            <a href="<?php echo $this->Url->build(array('controller' => 'users','action' => 'city_view','country' => $countrydetails->slug,'city' => $featuseCitya->slug)); ?>"><h3><?php echo $featuseCitya->name; ?></h3></a>
            <span><p class="readonly read_num" data-score="<?php echo $featuseCitya->avg_rating; ?>"></p><p><?php echo $featuseCitya->avg_rating; ?> opinions</p></span>
            <!--<span><img src="../images/star-rating.png" alt="img-rating"> <?php echo $countryCitys->review_count; ?> opinions</span> -->
            <span><p class="pull-left"><?php echo $featuseCitya->country_name; ?></p> <p class="pull-right"><?php echo $featuseCitya->casino_count; ?> Casinos</p></span>
          </div>
        </li>
        <?php
        }
      } ?>
      </ul>
    </div>
  </section>
  <section class="brief-history">
    <div class="container">
      <h2><?php echo (isset($headBlock->_translations[$Defaultlanguage]->footer_main_title) && !empty($headBlock->_translations[$Defaultlanguage]->footer_main_title)) ? $headBlock->_translations[$Defaultlanguage]->footer_main_title : $headBlock->_translations['en']->footer_main_title; ?></h2>
      <?php echo (isset($headBlock->_translations[$Defaultlanguage]->second_description) && !empty($headBlock->_translations[$Defaultlanguage]->second_description)) ? $headBlock->_translations[$Defaultlanguage]->second_description : $headBlock->_translations['en']->second_description; ?>
      <h2><?php 
               if(isset($online_gambling_title)){ echo $online_gambling_title;}
               else{  
        echo (isset($headBlock->_translations[$Defaultlanguage]->online_gambling_title) && !empty($headBlock->_translations[$Defaultlanguage]->online_gambling_title)) ? $headBlock->_translations[$Defaultlanguage]->online_gambling_title : $headBlock->_translations['en']->online_gambling_title;
         }
            ?></h2>
    </div>
  </section>
  <section class="gambling-online">
    <div class="container">
      <div class="take-break">
        <div class="clint_info_post">
        <?php foreach($promotions as $key => $promotion){ ?>
           <div class="clint_post client_post1">
              <div class="clint_item clint_item_new">
                 <a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $promotion->casino->slug)); ?>"><?php 
                  if(!empty($promotion->logo) && (PROMOTION_CASINO_LOGO_ROOT_PATH.$promotion->logo)){
                    echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=132px&height=71px&cropratio=2:1&image='.PROMOTION_CASINO_LOGO_IMG_URL.$promotion->logo,['alt' => $promotion->casino->title.' review']);
                  }else{
                    if(!empty($promotion->casino->image) && (CASINO_FULL_IMG_ROOT_PATH.$promotion->casino->image)){
                      echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=132px&height=71px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$promotion->casino->image,['alt' => $promotion->casino->title.' review']);
                    }
                  } ?></a>
                 <div class="col_list cl_num1"><span><?php echo $key+1; ?></span></div>
              </div>
              <div class="clint_post_right">
                 <div class="block casino_block"><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $promotion->casino->slug)); ?>"><span><?php echo $promotion->casino->title; ?></span></a></div>
                 <div class="clientRating clientRating1 readonly" data-score="<?php echo $promotion->casino->avg_rating; ?>" title="Great"></div>
              </div>
              <!--new contetn-->
                 <div class="new_content">
                    <div class="col_list new-col-list list_new">
                       <div class="check_list">
                          <span class="checkBx"><?php echo $promotion->small_text; ?></span>
                          <p><?php echo $promotion->small_text2; ?></p>
                       </div>
                    </div>
                    <div class="col_list new-col-list list_new">
                       <div class="check_list">
                          <span class="checkBx"><?php echo $promotion->casino->payout_percentage; ?> %</span>
                          <p>Win Rate</p>
                       </div>
                    </div>
                    <div class="col_list new-col-list list_new1">
                       <div class="check_list">
                          <span class="checkBx"><?php
                            $pay_day = round(($promotion->casino->p_min + $promotion->casino->p_max) / (84600*2));
                            if($pay_day > 1) {
                              $p_day = 'Days';
                            } 
                            else{ 
                              $p_day = 'Day';
                            }
                            echo $pay_day.' '.$p_day; ?></span>
                          <p>Payout Time</p>
                       </div>
                    </div>
                 </div>
                 <!--new contetn-->
              <div class="sbumit_block3">
                 <div class="more_info_btn "><a rel="nofollow" data-title="<?php echo $promotion->casino->title ?>" data-url="<?php echo $promotion->casino->slug ?>" class="paly_now" target="_blank" href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $promotion->slug)); ?>">Play Now</a>
                 <a class="read-reav" href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $promotion->casino->slug]) ?>">Read review</a></div>
              </div>
           </div>
        <?php } ?>
        <div class="view-all">
          <a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'onlineCasino']) ?>" class="view-more text-center">View All Casinos</a>
        </div>
        </div>

      </div>
    </div>
  </section>

  <section class="gambling most-popular">
    <div class="container">
      <h2><?php 
               if(isset($most_casino)){ echo $most_casino;}
               else{  
        echo (isset($headBlock->_translations[$Defaultlanguage]->most_casino) && !empty($headBlock->_translations[$Defaultlanguage]->most_casino)) ? $headBlock->_translations[$Defaultlanguage]->most_casino : $headBlock->_translations['en']->most_casino;
         }
            ?></h2>
      <ul>
      <?php if(!empty($popularCasinos)){ ?>
      <?php   $cnId = 0;
        foreach($popularCasinos as $popularCasino){  ?>
        <li>
          <a href="<?php 
              if($popularCasino->type == 'normal'){
              echo $this->Url->build(['plugin' => '','controller' => 'Casinos','action' => 'casino_view','casino_view' => $popularCasino->casino->slug]);
              }else{
              echo $this->Url->build(['plugin' => '','controller' => 'Casinos','action' => 'casino_view','casino_view' => $popularCasino->casino->slug]);
              }
              ?>">
              <?php 
              if(!empty($popularCasino->logo) && file_exists(PROMOTION_CASINO_LOGO_ROOT_PATH.$popularCasino->logo)){
              echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=280px&height=233px&cropratio=1:1&image='.PROMOTION_CASINO_LOGO_IMG_URL.$popularCasino->logo,['alt' =>$popularCasino->text.' review']);
              }else{
              echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=280px&height=233px&cropratio=1:1&image='.NO_CASINO_IMG,['class' => 'img-responsive','alt' =>$popularCasino->text.' review']);
              }  ?>
              <!-- <img src="../images/gambling-cities-img.jpg" alt="img"> -->
          </a>
          <div class="gambling-cities-dec">
            <a href="<?php 
              if($popularCasino->type == 'normal'){
              echo $this->Url->build(['plugin' => '','controller' => 'Casinos','action' => 'casino_view','casino_view' => $popularCasino->casino->slug]);
              }else{
              echo $this->Url->build(['plugin' => '','controller' => 'Casinos','action' => 'casino_view','casino_view' => $popularCasino->casino->slug]);
              }
              ?>"><h3><?php echo $popularCasino->text ?></h3></a>
            <span>
              <?php $fill_rating = 5 - $popularCasino->casino->avg_rating;
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
            <!-- <img src="../images/star-rating.png" alt="img-rating"> -->
              <?php
              echo $popularCasino->casino->review_count;
              if($popularCasino->casino->review_count   > 1)
              echo ' Opinions';
              else
              echo ' Opinion';?>
            </span>
            <span><p><?php echo isset($popularCasino->casino->city->name) ? $popularCasino->casino->city->name : ''; ?>,
                    <?php echo isset($cntByCas[$cnId]) ? $cntByCas[$cnId] : ''; $cnId++;?></p> <!-- <p>185 Casinos</p> --></span>
          </div>
        </li>
      <?php } ?>
      <?php } ?>
      </ul>
    </div>
  </section>

      <?php echo $this->element('guide_casinos'); ?>
      
 <!--  <section class="beginners">
    <div class="container">
      <div class="beginners-content">
        <h3>Beginners Guide to Casinos</h3>
        <ul>
          <li><img src="../images/beginners-img1.png">
            <div class="content-title">
              <span>Basics of Gambling at Online Casinos<p>All the essentials of playing online casino games</p></span>
            </div>
          </li>
          <li><img src="../images/beginners-img4.png">
            <div class="content-title">
              <span>Basics of Gambling at Online Casinos<p>All the essentials of playing online casino games</p></span>
            </div>
          </li>
          <li><img src="../images/beginners-img2.png">
            <div class="content-title">
              <span>Basics of Gambling at Online Casinos<p>All the essentials of playing online casino games</p></span>
            </div>
          </li>
          <li><img src="../images/beginners-img5.png">
            <div class="content-title">
              <span>Basics of Gambling at Online Casinos<p>All the essentials of playing online casino games</p></span>
            </div>
          </li>
          <li><img src="../images/beginners-img3.png">
            <div class="content-title">
              <span>Basics of Gambling at Online Casinos<p>All the essentials of playing online casino games</p></span>
            </div>
          </li>
          <li><img src="../images/beginners-img6.png">
            <div class="content-title">
              <span>Basics of Gambling at Online Casinos<p>All the essentials of playing online casino games</p></span>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </section> -->






<div class="gamble_online land_based_info">

  <div class="container">

  <div class="title">

        <h2><?php echo (isset($headBlock->_translations[$Defaultlanguage]->sub_title) && !empty($headBlock->_translations[$Defaultlanguage]->sub_title)) ? $headBlock->_translations[$Defaultlanguage]->sub_title : $headBlock->_translations['en']->sub_title; ?></h2>

        <div><?php echo (isset($headBlock->_translations[$Defaultlanguage]->sub_title_description) && !empty($headBlock->_translations[$Defaultlanguage]->sub_title_description)) ? $headBlock->_translations[$Defaultlanguage]->sub_title_description : $headBlock->_translations['en']->sub_title_description; ?>
        </div>

        <span></span> </div>

		<div class="ChooosetypeRow">

  <?php foreach($Continents as  $cat){ ?>

				<div class="col col_bml2">

			<a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' =>  Inflector::camelize(Inflector::underscore($cat->slug)))); ?>">

				   <div class="block"><div class="block_2"><i><img src="<?php echo GALLERY_IMG_URL.$cat->back_image; ?>" alt="<?=$cat->_translations['en']->icon_title?>"></i><i class="fa"><img src="<?php echo GALLERY_IMG_URL.$cat->head_image; ?>" alt="<?=$cat->_translations['en']->icon_title?>"></i></div></div>

				   <div class="col_block"><span><?php  echo (!empty($cat->_translations[$Defaultlanguage]->icon_title)) ? $cat->_translations[$Defaultlanguage]->icon_title : $cat->_translations['en']->icon_title; ?></span></div>

			</a>

				</div>

  <?php } ?>  

  </div>

  </div>

  </div>



  <section class="faq-section">
     <div class="container">
        <div class="row">
           <div class="col-md-12">
              <div class="fq_main">
                 
                 <div class="fq-content">
                  <h3><?php echo $faq_mn_title; ?></h3>
                  <p><?php echo $faq_title; ?></p>
                  <?php
                  $faqcategorydetails = $this->SocialShare->faqcategory($faqcategory);
                  //echo "<pre>"; print_r($faqcategorydetails);
                  if(isset($faqcategorydetails) && !empty($faqcategorydetails)){ 
                  //echo "<pre>"; print_r($faqcategorydetails); die;
                  $tt = json_decode($faqcategorydetails);
                  //pr($tt); 
                  foreach($faqcategorydetails as $text){ ?>
                  <div class="faq_question border-tops">

                  <img src="<?php echo WEBSITE_IMG_URL ?>faq_ques_cas.png" alt="<?=$text['faq_alt']?>"> <h4><?php echo $text['faq_title']; ?></h4>

                  <p><?php echo $text['faq_description']; ?></p>

                  </div>

                  <?php 
                  } 
                  }?>
                 </div>
              </div>
           </div>
        </div>
     </div>
  </section>






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

 

  </div>
  </div>

  