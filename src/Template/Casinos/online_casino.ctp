<?php 
   $faq_sect = 0;
   // echo "<pre>"; print_r($headBlock); die;
   if($type == 'online-casino'){

    $faqcategory =   $headBlock->id;

   $faq_mn_title =   $headBlock->faq_mn_title;

    $faq_title =   $headBlock->faq_title;

     $faq_ques1 =   $headBlock->faq_ques1;

     $faq_desc1 =   $headBlock->faq_desc1;

     $faq_ques2 =   $headBlock->faq_ques2;

     $faq_desc2 =   $headBlock->faq_desc2;

     $faq_ques3 =   $headBlock->faq_ques3;

     $faq_desc3 =   $headBlock->faq_desc3;

     $faq_sect = 1;

   }


   foreach($allCat as $cat)

   {
    //echo "<pre>"; print_r($cat);
     if($type == $cat->slug)

     {

        $footer_main_title        =  (!empty($cat->_translations[$Defaultlanguage]->footer_main_title)) ? $cat->_translations[$Defaultlanguage]->footer_main_title : $cat->_translations['en']->footer_main_title;

        $title                    =  (!empty($cat->_translations[$Defaultlanguage]->title)) ? $cat->_translations[$Defaultlanguage]->title : $cat->_translations['en']->title;

        $sub_title                =  (!empty($cat->_translations[$Defaultlanguage]->sub_title)) ? $cat->_translations[$Defaultlanguage]->sub_title : $cat->_translations['en']->sub_title;

        $middle_title_description =  (!empty($cat->_translations[$Defaultlanguage]->middle_title)) ? $cat->_translations[$Defaultlanguage]->middle_title : $cat->_translations['en']->middle_title;

        $middle_title               =  (!empty($cat->_translations[$Defaultlanguage]->middle_title_description)) ? $cat->_translations[$Defaultlanguage]->middle_title_description : $cat->_translations['en']->middle_title_description;

        $second_description               =  (!empty($cat->_translations[$Defaultlanguage]->second_description)) ? $cat->_translations[$Defaultlanguage]->second_description : $cat->_translations['en']->second_description;

        $head_first_block         =  (!empty($cat->_translations[$Defaultlanguage]->head_first_block)) ? $cat->_translations[$Defaultlanguage]->head_first_block : $cat->_translations['en']->head_first_block;

        $head_second_block        =  (!empty($cat->_translations[$Defaultlanguage]->head_second_block)) ? $cat->_translations[$Defaultlanguage]->head_second_block : $cat->_translations['en']->head_second_block;

        $best_casino_title =  (!empty($cat->_translations[$Defaultlanguage]->best_casino_title)) ? $cat->_translations[$Defaultlanguage]->best_casino_title : $cat->_translations['en']->best_casino_title;

        $best_casino_reviews        =  (!empty($cat->_translations[$Defaultlanguage]->best_casino_reviews)) ? $cat->_translations[$Defaultlanguage]->best_casino_reviews : $cat->_translations['en']->best_casino_reviews;
        $best_casino_location        =  (!empty($cat->_translations[$Defaultlanguage]->best_casino_location)) ? $cat->_translations[$Defaultlanguage]->best_casino_location : $cat->_translations['en']->best_casino_location;
        $best_casino_earnings        =  (!empty($cat->_translations[$Defaultlanguage]->best_casino_earnings)) ? $cat->_translations[$Defaultlanguage]->best_casino_earnings : $cat->_translations['en']->best_casino_earnings;
        $best_casino_bonuses        =  (!empty($cat->_translations[$Defaultlanguage]->best_casino_bonuses)) ? $cat->_translations[$Defaultlanguage]->best_casino_bonuses : $cat->_translations['en']->best_casino_bonuses;
        $best_casino_times        =  (!empty($cat->_translations[$Defaultlanguage]->best_casino_times)) ? $cat->_translations[$Defaultlanguage]->best_casino_times : $cat->_translations['en']->best_casino_times;

        $head_image               =  $cat->head_image;



        $faqcategory =  $cat->id;

        $faq_mn_title =   $cat->faq_mn_title;

     $faq_title =   $cat->faq_title;

     $faq_ques1 =   $cat->faq_ques1;

     $faq_desc1 =   $cat->faq_desc1;

     $faq_ques2 =   $cat->faq_ques2;

     $faq_desc2 =   $cat->faq_desc2;

     $faq_ques3 =   $cat->faq_ques3;

     $faq_desc3 =   $cat->faq_desc3;

     $faq_sect = 1;



     }

     if($cat->slug == 'pokers')

     {

        $slug =  'pokers';

     }

     if($cat->slug == 'bingos')

     {

        $slug =  'bingos';

     }

     if($cat->slug == 'sport-bettings')

     {

        $slug =  'sportBettings';

     }

   }

   ?>
<!-- <div class="banner_inner banner_back_img">
   <div class="banner_info banner_textblock">

      <div class="container">

    <h1> <?php
      if(isset($title)){

      echo $title;

      }else{

      echo (isset($headBlock->_translations[$Defaultlanguage]->title) && !empty($headBlock->_translations[$Defaultlanguage]->title)) ? $headBlock->_translations[$Defaultlanguage]->title : $headBlock->_translations['en']->title;

      } ?></h1>

         <div class="banner_post banner_parg">

            <div class="col-md-6"><?php /*if(isset($head_first_block)){ ?>

   <span><?php
      if(isset($head_image)){

         echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=115px&height=131px&cropratio=1:1&image='.GALLERY_IMG_URL.$head_image,['alt' => 'Image','height' => 131,'width' => 115]);

         }else{

      echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=115px&height=131px&cropratio=1:1&image='.GALLERY_IMG_URL.$headBlock->head_image,['alt' => 'Image','height' => 131,'width' => 115]);

               }

            ?></span><?php }*/ ?><div><?php
      if(isset($head_first_block)){

            echo $this->App->force_balance_tags($head_first_block);

      }else{

      echo $this->App->force_balance_tags((!empty($headBlock->_translations[$Defaultlanguage]->head_first_block)) ? $headBlock->_translations[$Defaultlanguage]->head_first_block : $headBlock->_translations['en']->head_first_block);

      }

      ?></div></div><div class="col-md-6"> <?php
      if(isset($head_second_block)){

         echo $this->App->force_balance_tags($head_second_block);

      }else{

      echo $this->App->force_balance_tags((!empty($headBlock->_translations[$Defaultlanguage]->head_second_block)) ? $headBlock->_translations[$Defaultlanguage]->head_second_block : $headBlock->_translations['en']->head_second_block);

      } ?>

   </div>

         </div>

      </div>

   </div>

   </div> -->
<style type="text/css">
   select {
   background: #fff none repeat scroll 0 0;
   display: inline-block;
   height:28px;
   margin: 0 7px 0 0 !important;
   overflow: hidden;
   position: relative;
   width: 180px !important;
   border: none;
   color: #000 !important;
   }
   /* Custom Select */
   .select {
   position: relative;
   display: block;
   width: 180px !important;
   height: 28px;
   font-size: 12px;
   background: #2c3e50;
   overflow: hidden;
   color: #393838 !important;
   margin: 0 4px 0 0 !important;
   border: 1px solid #dbdbdb;
   }
   select {
   width: 100%;
   margin: 0;
   padding: 0 0 0 .5em;
   color: #fff;
   cursor: pointer;
   }
   select::-ms-expand {
   display: none;
   }
   /* Arrow */
   .select::after {
   content: '\25BC';
   position: absolute;
   top: 4px;
   right: 0;
   bottom: 0;
   padding: 0 1em;
   background: #fff;
   pointer-events: none;
   color: #393838;
   }
   /* Transition */
   .select:hover::after {
   }
   .select::after {
   -webkit-transition: .25s all ease;
   -o-transition: .25s all ease;
   transition: .25s all ease;
   }
   .banner_parg-right > div {
   background: #fff none repeat scroll 0 0;
   float: left;
   margin-left: -15px;
   min-height: 230px;
   padding: 10px 10px 10px 30px;
   border: 1px solid #dbdbdb;
   }
   .center-on-page {
   background: #fff none repeat scroll 0 0;
   display: inline-flex;
   padding: 5px;
   width: 100%;}
   .prev.disabled {
   display: none;
   }
</style>
<div class="banner">
   <div class="transparent-black bonuses online-casino">
      <div class="container">
         <div class="banner-content">
            <h1>Find the Perfect Online Casinos</h1>
          <?php  echo $this->Form->create('Bonus',['type' => 'POST','id' => 'search_form','url' => $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'onlinecasinoFilter'])]); ?>
  <div class="search-back">
               <div class="top-search" data-ng-app>
                 <div class="form-group">
			     <div class="center-on-page">
			     <!--Game Drop Down-->
				  <div class="select">
				    <select name="gametype" id="slct" class="bonus-type-select" onchange="drop_game();">
				      <option <?php if(empty($this->request->query['bonustype'])){echo "selected";} ?>> Select a game</option>
				      <?php
                        foreach($onlineCasinoGames as $onlinegames){
                            // print($onlinegames);
                            $bonus = strtolower(str_replace(" ","-",$onlinegames->name)); ?> 
        				      <option <?php if(!empty($this->request->query['gametype']) && $this->request->query['gametype'] == $onlinegames->id)
                               { echo "selected"; } ?>
                               value="<?php  echo $onlinegames->id; ?>">
                                <?php echo $onlinegames->name ?></option>
				      <?php }  ?>
				    </select>
				  </div>
				  <!--Payment Drop Down-->
				  <div class="select">
                    <?php //if($this->request->data['amount']) { //echo $this->request->data['amount']; }?>
				    <select name="deposit" id="slct_deposit" class="amount-type-select" onchange="drop_paymentmethod()" style="color: #969696 ! important;" disabled>
				        <option value="">Select a payment</option>
                        

				    </select>
				  </div>
				  <div class="select" id="selectajax">
				    <select name="device" id="slct_device" style="color: #969696 ! important;" disabled>
				        <option value=""> Select a device</option>
                        
				    </select>
				  </div>
				</div>
			    </div>
                <button class="search-back-a" type="submit">Find Casinos</button>
                <!-- <input value="Find Bonus" class="search-back-a" type="button"> -->
                  <!-- <a data-ng-href="<?php echo WEBSITE_URL; if($Defaultlanguage != 'en'){ echo $Defaultlanguage.'/'; } ?>search/{{city_name}}" class="search-back-a"><?= __('homepage.search'); ?></a>  -->
               </div>
            </div>
            <?php echo $this->Form->end(); ?>
         </div>
      </div>
   </div>
   <?php /*
      <div class="find_line"><?php echo (!empty($allBlocks[3]->_translations[$Defaultlanguage]->description)) ? $allBlocks[3]->_translations[$Defaultlanguage]->description : $allBlocks[3]->_translations['en']->description ; ?>
</div>
*/ ?>
</div>
<div class="banner_inner banner_back_top  img_block2  banner_leftSide bonuses-section">
   <div class="banner_info banner_textblock">
      <div class="container">
         <h1> <?php
            if(isset($title)){ echo $title;}

            else{

            echo (isset($headBlock->_translations[$Defaultlanguage]->title) && !empty($headBlock->_translations[$Defaultlanguage]->title)) ? $headBlock->_translations[$Defaultlanguage]->title : $headBlock->_translations['en']->title;

            }

            ?></h1>
         <div class="banner_post banner_parg">
            <div class="row">
               <div class="col-md-8 bg-dark-sky">
                  <div>
                     <?php
                        if(isset($head_first_block)){

                              echo $this->App->force_balance_tags($head_first_block);

                        }else{

                              echo $this->App->force_balance_tags((!empty($headBlock->_translations[$Defaultlanguage]->head_first_block)) ? $headBlock->_translations[$Defaultlanguage]->head_first_block : $headBlock->_translations['en']->head_first_block);

                              }

                        ?>
                     <!-- <p>Online casinos offer bonuses to attract new gamblers and to reward loyal players. Casino bonuses tend to vary from one casino to the other. Thats why we list the best online casino bonuses and give you a wide variety of promotions from which you can choose. The most popular ones are welcome bonuses, free spins and no deposit bonuses.</p>
                        <p>Start right now! All you need to do is to grab any of the bonus offers below and win big.</p> -->
                  </div>
                  <?php /*
                     <span> <?php
                        if(isset($head_image)){

                           echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=115px&height=131px&cropratio=1:1&image='.GALLERY_IMG_URL.$head_image,['alt' => 'Image']);

                           }else{

                        echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=115px&height=131px&cropratio=1:1&image='.GALLERY_IMG_URL.$headBlock->head_image,['alt' => 'Image']);

                                 }

                              ?></span>*/ ?>
                  <!--  <div>
                     <?php
                        if(isset($head_first_block)){

                              echo $this->App->force_balance_tags($head_first_block);

                        }else{

                              echo $this->App->force_balance_tags((!empty($headBlock->_translations[$Defaultlanguage]->head_first_block)) ? $headBlock->_translations[$Defaultlanguage]->head_first_block : $headBlock->_translations['en']->head_first_block);

                              }

                        ?>

                               </div> -->
               </div>
               <div class="col-md-4 banner_parg-right">
                  <div>
                     <?php
                        if(isset($head_second_block)){

                           echo $this->App->force_balance_tags($head_second_block);

                        }else{

                           echo $this->App->force_balance_tags((!empty($headBlock->_translations[$Defaultlanguage]->head_second_block)) ? $headBlock->_translations[$Defaultlanguage]->head_second_block : $headBlock->_translations['en']->head_second_block);

                         }

                        ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="mid_wrapper onlinecasino-mid">
   <div class="casinoSearch casinoSearch1">
      <div class="container">
         <div class="title">
            <h2 style="font-family: 'latoregular';"><?php if(!empty($sub_title)){ echo  $sub_title; }else{ echo (!empty($headBlock->_translations[$Defaultlanguage]->sub_title)) ? $headBlock->_translations[$Defaultlanguage]->sub_title : $headBlock->_translations['en']->sub_title ;}  ?></h2>
            <?php /*
               <div><?php echo (isset($sub_title_description)) ?  $sub_title_description : $headBlock->sub_title_description;  ?>
         </div>
         <span></span>*/ ?>
      </div>
      <div class="row">
         <div class="col-md-8">
            <div class="filter_2N new-block">
               <div class="fil_block new-fil-block">
                  <ul>
                     <li><strong>Sort by:</strong></li>
                     <li class="active"><?php echo $this->Paginator->sort('id','Recommended'); ?></li>
                     <li><?php echo $this->Paginator->sort('created','Date'); ?></li>
                     <li><?php echo $this->Paginator->sort('Casino.avg_rating','User Rating'); ?></li>
                     <li><?php echo $this->Paginator->sort('title','Name'); ?></li>
                  </ul>
               </div>
               <!-- <div class="">
                  <?php// echo $this->Form->create('Promotions',['type' => 'get','class' => 'search_box3']); ?>

                  <?php// echo $this->Form->text('title',['placeholder' => 'Casino Name','value' => isset($requestedQuery['title']) ? $requestedQuery['title'] : '']); ?>

                   <button type="submit"><img src="<?php //echo WEBSITE_IMG_URL; ?>search_img.png" alt="img"></button> -->
               <!--<?php //echo $this->Form->end(); ?>
                  </div> -->
               <p class="casino-list"><?= $this->Paginator->param('count'); ?> Casino listed</p>
            </div>
         </div>
      </div>
      <div class="filtrInner">
         <div class="row">
            <div class="col-md-8">
               <div class="clint_info">
                  <div class="data_div">
                     <?php echo $this->element('online_casino_search'); ?>
                  </div>
               </div>
            </div>
            <div class="col-md-4">
               <div class="gamblingBox side_bar_box side_bar_box1">
               <?php echo $this->element('online_casino_search_side_bar_'.$Defaultlanguage,array('ff_gametype'=>$ff_gametype,'ff_deposit'=>$ff_deposit,'ff_device'=>$ff_device)); ?>
               <?php //echo $this->cell('Inbox::onlinecasino', [], ['cache' => ['config' => 'longlong', 'key' => 'onlinecasino_'.$Defaultlanguage]]); ?>

               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--  <div class="beginners_info">
   <div class="container"> -->
<?php echo $this->element('guide_casinos'); ?>
<!--
   </div>

   </div> -->
<section class="tips-for-choosing">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="tips-content">
               <div class="tips-title">
                  <h3>
                  <?php if(!empty($best_casino_title)){ echo  $best_casino_title; } else{ echo (!empty($headBlock->best_casino_title)) ? $headBlock->best_casino_title : $headBlock->best_casino_title; }  ?>
                  </h3>
               </div>
               <ul>
                  <li>
                     <div class="reviews-div">
                        <span class="reviews-icon">Reviews</span>
                        <p><?php if(!empty($best_casino_reviews)){ echo  $best_casino_reviews; } else{ echo (!empty($headBlock->best_casino_reviews)) ? $headBlock->best_casino_reviews : $headBlock->best_casino_reviews; }  ?>
                        </p>
                     </div>
                  </li>
                  <li>
                     <div class="reviews-div">
                        <span class="location-icon">Location</span>
                        <p><?php if(!empty($best_casino_location)){ echo  $best_casino_location; } else{ echo (!empty($headBlock->best_casino_location)) ? $headBlock->best_casino_location : $headBlock->best_casino_location; }  ?></p>
                     </div>
                  </li>
                  <li>
                     <div class="reviews-div">
                        <span class="earnings-icon">Earnings</span>
                        <p><?php if(!empty($best_casino_earnings)){ echo  $best_casino_earnings; } else{ echo (!empty($headBlock->best_casino_earnings)) ? $headBlock->best_casino_earnings : $headBlock->best_casino_earnings; }  ?></p>
                     </div>
                  </li>
                  <li>
                     <div class="reviews-div">
                        <span class="welcome-bonuses-icon">Welcome Bonuses</span>
                        <p><?php if(!empty($best_casino_bonuses)){ echo  $best_casino_bonuses; } else{ echo (!empty($headBlock->best_casino_bonuses)) ? $headBlock->best_casino_bonuses : $headBlock->best_casino_bonuses; }  ?></p>
                     </div>
                  </li>
                  <li>
                     <div class="reviews-div">
                        <span class="payout-times-icon">Payout Times</span>
                        <p><?php if(!empty($best_casino_times)){ echo  $best_casino_times; } else{ echo (!empty($headBlock->best_casino_times)) ? $headBlock->best_casino_times : $headBlock->best_casino_times; }  ?></p>
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</section>
<div class="gamble_online">
   <div class="container">
      <div class="title">
         <h2><?php if(isset($middle_title)){ echo $middle_title; }else{ echo (!empty($headBlock->_translations[$Defaultlanguage]->middle_title)) ? $headBlock->_translations[$Defaultlanguage]->middle_title : $headBlock->_translations['en']->middle_title; } ?></h2>
         <p><?php if(isset($middle_title_description)){ echo $middle_title_description; }else{ echo (!empty($headBlock->_translations[$Defaultlanguage]->middle_title_description)) ? $headBlock->_translations[$Defaultlanguage]->middle_title_description : $headBlock->_translations['en']->middle_title_description; } ?></p>
      </div>
      <div class="ChooosetypeRow">
         <?php  $cat_flg = 1;
            if( (in_array($type,array('pokers','bingos','sport-bettings')) && $cat_flg==1)) {$cat_flg=0; ?>
         <div class="col col_gmbl">
            <a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'Casinos', 'action' => 'onlineCasino')); ?>">
               <div class="block">
                  <div class="block_2"><i><img src="<?php echo WEBSITE_IMG_URL; ?>img_25.1.png" alt="icon"></i><i class="fa">
                     <img src="<?php echo WEBSITE_IMG_URL; ?>img_25.png" alt="icon"></i>
                  </div>
               </div>
               <div class="col_block"><span>Casino</span></div>
            </a>
         </div>
         <?php
            }





            foreach($allCat as $cat){



            if($type == $cat->slug){

                 $second_description   =  (!empty($cat->_translations[$Defaultlanguage]->second_description)) ? $cat->_translations[$Defaultlanguage]->second_description : $cat->_translations['en']->second_description;







              }



            if($cat->categorie_type == 'countries'){

            continue;

            }

            $alt_icn = '';

            if($cat->slug == 'pokers')

            {

            $slug =  'pokers';

            $alt_icn ='Online poker reviews';

            }

            if($cat->slug == 'bingos')

            {

            $slug =  'bingos';

            $alt_icn ='Online bingo reviews';

            }

            if($cat->slug == 'sport-bettings')

            {

            $slug =  'sportBettings';

            $alt_icn ='Sportsbetting reviews';

            }



            if($type != $cat->slug)   { ?>
         <div class="col col_gmbl">
            <a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'Casinos', 'action' => $slug)); ?>">
               <div class="block">
                  <div class="block_2"><i><img src="<?php echo GALLERY_IMG_URL.$cat->back_image; ?>" alt="<?php echo $alt_icn;?>"></i><i class="fa">
                     <img src="<?php echo GALLERY_IMG_URL.$cat->image; ?>" alt="<?php echo $alt_icn;?>"></i>
                  </div>
               </div>
               <div class="col_block"><span><?php echo (!empty($cat->_translations[$Defaultlanguage]->icon_title)) ? $cat->_translations[$Defaultlanguage]->icon_title : $cat->_translations['en']->icon_title; ?></span></div>
            </a>
         </div>
         <?php }
            } ?>
      </div>
   </div>
</div>
<div class="gamble_online_info">
   <div class="container">
      <!-- <div class="title">
         <h2>Important aspects for our online casino reviews & ratings</h2>
      </div> -->
      <div class="row">
         <div class="col-md-12">
           <p><?php if(isset($second_description)){ echo $second_description; }else{ echo (!empty($headBlock->_translations[$Defaultlanguage]->second_description)) ? $headBlock->_translations[$Defaultlanguage]->second_description : $headBlock->_translations['en']->second_description; } ?></p>
            <!-- <div class="gamble-info-content">
               <h4>Online Casino Technology</h4>
               <p>As expected, a lot has changed in terms of technology being used by online casinos today compared to when the industry was just starting out. Initially, online casinos relied heavily on simple HTML coding and JavaScript technology. At the time, most of the games were download only and had to use computing resource to run. However, technological advancements over the years have seen online gaming now adapt a more convenient web-focused and mobile technology that’s built on either Flash or HTML5 technology.</p>
               <h4>Licensing and Jurisdiction</h4>
               <p>Despite there being not sufficient regulation of the online gambling industry, some governments and monitoring bodies have done an impressive job to bring some sanity. For example, some countries such as UK and Malta have set up very strict bodies to oversee the online gaming segment through the renowned UK Gambling Commission and Malta Lotteries and Gaming Authority respectively. Others include the Government of Gibraltar, Kahnawake Gaming Commission, and eCogra. On the other hand, some countries such as the US and France have put a lot of restrictions towards online gaming which has prompted a majority of software providers to prevent users from these countries from registering accounts with them or playing their games.</p>
               <h4>Online Casino and Games</h4>
               <p>There are numerous types of online casino games today including card games, slots, baccarat, video poker, dice games, and roulette. Currently, video slots are the most popular with a majority of them being inspired by video slot games played at most land-based casinos.Most online casinos opt to enter into partnerships with independent software providers to supply them with games. Some of the most reputable gaming suppliers today include Microgaming, NetEnt, Playtech, and IGT. The choice of software provider that a particular company makes plays a huge role in its overall online casino ratings.</p>
               <h4>Casino Promotions and Bonuses</h4>
               <p>Simply put, the competitiveness of an online casino today largely depends on the value it gives its players in the form of bonuses and rewards. Of all bonuses awarded to users, the welcome bonus is arguably the most popular. This bonus is usually given in terms of a percentage match on the first deposit made by a player on the platform. However, most casinos tie these bonuses to special terms and conditions with the most common being wager through requirements. These conditions dictate that a player must play a particular game for a given number of times before they can withdraw the bonus money to their accounts. Other terms include limits on withdrawal amounts allowed at a time, minimum deposits, location, and withdrawal times.</p>
               <a href="#" class="view-more">View more<i class="fa fa-caret-down"></i></a>
            </div> -->
         </div>
      </div>
   </div>
   <!-- <div class="container">
      <div class="title">

            <h2><?php
         if(isset($footer_main_title)){

         echo $footer_main_title;

         }else{

         echo (!empty($headBlock->_translations[$Defaultlanguage]->footer_main_title)) ? $headBlock->_translations[$Defaultlanguage]->footer_main_title : $headBlock->_translations['en']->footer_main_title;

         }?>

        </h2>

      </div>

      <div class="gamble_online_post">

            <div class="gamble_online_item"> <?php
         if(isset($second_description)){

         echo $this->App->force_balance_tags($second_description);

         }else{

         echo $this->App->force_balance_tags((!empty($headBlock->_translations[$Defaultlanguage]->second_description)) ? $headBlock->_translations[$Defaultlanguage]->second_description : $headBlock->_translations['en']->second_description);

               } ?>

          </div>

      </div>

      </div> -->
</div>
<?php if(!empty($allCountry)){ //echo "<pre>"; print_r($allCountry);  ?>
<div class="play_safely_info">
<div class="container">
<div class="title">
   <h2><?php echo __('online_casinos.PLAY_SAFELY_ONLINE_LOOK_AT_OUR_TOP_CASINO_TIPS'); ?></h2>
</div>
<div class="play_safely_post">
   <div class="row">
   	<?php $limits = 0;
   	foreach($allCountry as $country){ $limits++;
   		if($limits < 7) { ?>
      <div class="col-md-4">
         <div class="play_safely_item">
            <div class="play_item1">
            <?php
            	if(!empty($country->head_image) && file_exists(GALLERY_ROOT_PATH.$country->head_image)){
         		echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=149px&height=78px&cropratio=2:1&image='.GALLERY_IMG_URL.$country->head_image,['alt' => $country->head_image_alt,'height' => 78,'width' => 149]);
         		}
         	?>
            </div>
            <div class="play_text">
               <h3><?php echo (!empty($country->_translations[$Defaultlanguage]->preview_title)) ? $country->_translations[$Defaultlanguage]->preview_title : $country->_translations['en']->preview_title; ?></h3>
               <p><?php echo $this->App->force_balance_tags((!empty($country->_translations[$Defaultlanguage]->preview_text)) ? $country->_translations[$Defaultlanguage]->preview_text : $country->_translations['en']->preview_text); ?></p>
               <div class="view_more_all"><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'Casinos','action' => 'onlineCasino','country' => $country->slug]); ?>">All <?php $name = strtok($country->faq_mn_title," "); if($name == "New") { echo "New Zealand";} else { echo $name; } ?> casinos</a>
               </div>
            </div>
         </div>
      </div>
      <?php }
      } ?>
   </div>

   <div class="clearfix"></div>
   <!-- <?php foreach($allCountry as $country){
      if($country->show_for_fotter == 0){ ?>
      <div class="play_safely_item">

         <div class="play_item1"> <?php
         if(!empty($country->head_image) && file_exists(GALLERY_ROOT_PATH.$country->head_image)){

         echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=149px&height=78px&cropratio=2:1&image='.GALLERY_IMG_URL.$country->head_image,['alt' => 'Image','height' => 78,'width' => 149]);

         } ?></div>

         <div class="play_text">

            <h3><?php echo (!empty($country->_translations[$Defaultlanguage]->preview_title)) ? $country->_translations[$Defaultlanguage]->preview_title : $country->_translations['en']->preview_title; ?></h3>

      <?php echo $this->App->force_balance_tags((!empty($country->_translations[$Defaultlanguage]->preview_text)) ? $country->_translations[$Defaultlanguage]->preview_text : $country->_translations['en']->preview_text); ?>

            <div class="view_more_all">

               <a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'Casinos','action' => 'onlineCasino','country' => $country->slug]); ?>"><?php echo (!empty($country->_translations[$Defaultlanguage]->preview_url_title)) ? $country->_translations[$Defaultlanguage]->preview_url_title : $country->_translations['en']->preview_url_title; ?><img src="<?php echo WEBSITE_IMG_URL; ?>right_arrow_img.png" alt="img" /></a>

            </div>

         </div>

      </div>

      <?php }else{ ?>

      <div class="play_safely_item">

         <div class="play_item1 play_img_item"><img src="<?php echo WEBSITE_IMG_URL; ?>img_14.png" alt="img" /></div>

         <div class="play_text">

            <h3><?php echo (!empty($country->_translations[$Defaultlanguage]->preview_title)) ? $country->_translations[$Defaultlanguage]->preview_title : $country->_translations['en']->preview_title; ?></h3>

            <?php echo $this->App->force_balance_tags((!empty($country->_translations[$Defaultlanguage]->preview_text)) ? $country->_translations[$Defaultlanguage]->preview_text : $country->_translations['en']->preview_text); ?>

            <div class="map_list_all">

               <ul>

                  <li><img src="<?php echo WEBSITE_IMG_URL; ?>img_15.png" alt="img" /><span>United states </span></li>

                  <li><img src="<?php echo WEBSITE_IMG_URL; ?>img_16.png" alt="img" /><span>United states </span></li>

                  <li><img src="<?php echo WEBSITE_IMG_URL; ?>img_15.png" alt="img" /><span>United states </span></li>

                  <li><img src="<?php echo WEBSITE_IMG_URL; ?>img_16.png" alt="img" /><span>United states </span></li>

                  <li><img src="<?php echo WEBSITE_IMG_URL; ?>img_15.png" alt="img" /><span>United states </span></li>

                  <li><img src="<?php echo WEBSITE_IMG_URL; ?>img_16.png" alt="img" /><span>United states </span></li>

                  <li><img src="<?php echo WEBSITE_IMG_URL; ?>img_15.png" alt="img" /><span>United states </span></li>

                  <li><img src="<?php echo WEBSITE_IMG_URL; ?>img_16.png" alt="img" /><span>United states </span></li>

               </ul>

            </div>

         </div>

      </div>

      <?php }
         } ?>

      </div>

      </div>

      </div>

      <?php } ?> -->
   <!-- faq section strat -->
   <?php if($faq_sect) {?>
   <section class="faq-section">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="fq-content">
                  <h3><?php echo $faq_mn_title; ?></h3>
                  <p><?php echo $faq_title; ?></p>
                  <?php
                     //echo $faqcategory;

                     $faqcategorydetails = $this->SocialShare->faqcategory($faqcategory);

                     //echo "<pre>"; print_r($faqcategorydetails);

                     if(isset($faqcategorydetails) && !empty($faqcategorydetails)){

                     //echo "<pre>"; print_r($faqcategorydetails); die;

                     $tt  = json_decode($faqcategorydetails);

                     //pr($tt);

                     foreach($faqcategorydetails as $text){ ?>
                  <div class="faq_question border-tops">
                     <img src="<?php echo WEBSITE_IMG_URL ?>faq_ques_cas.png" alt="<?=$text['faq_alt']?>">
                     <h4><?php echo $text['faq_title']; ?></h4>
                     <p><?php echo $text['faq_description']; ?></p>
                  </div>
                  <?php
                     }

                     }?>
                  <!-- <div class="faq_question border-tops">
                     <img src="<?php echo WEBSITE_IMG_URL ?>faq_ques_cas.png">  <h4><?php echo $faq_ques1; ?></h4>

                      <p><?php echo $faq_desc1; ?></p>

                     </div>

                     <div class="faq_question">

                     <img src="<?php echo WEBSITE_IMG_URL ?>faq_ques_cas.png">  <h4><?php echo $faq_ques2; ?></h4>

                      <p><?php echo $faq_desc2; ?></p>

                     </div>

                        <div class="faq_question">

                     <img src="<?php echo WEBSITE_IMG_URL ?>faq_ques_cas.png">  <h4><?php echo $faq_ques3; ?></h4>

                      <p><?php echo $faq_desc3; ?></p>

                     </div>  -->
               </div>
            </div>
         </div>
      </div>
   </section>
   <?php }?>
   <!-- faq section end -->
</div>
</div>
</div>
<?php

echo $this->Html->css(['jquery-ui.min.css'],array('block' =>'css1'));
echo $this->Html->script(['jqueryslider.js'],array('block' =>'footer_script'));
$this->Html->scriptStart(array('block' => 'custom_script')); ?>

var catAmount = <?php echo json_encode($allCatSideBarqWithAmount); ?>;
function casino_search(){     
   form_id  = 'pchec';
 var data = {},
        fdata = [],
        loc = $('<a>', {href:window.location})[0];
    $('input[type="checkbox"]').each(function(i){
      if(this.checked){
        if(!data.hasOwnProperty(this.name)){
          data[this.name] = [];
        }
        name  = this.name;
        name = name.replace(/[[]]/g, "");
        console.log(name);
        data[this.name].push(this.value);
      }
    });
    /* $.each(data, function(k, v){
        fdata[k] = [v.join(',')];
    }); */
    // fdata = fdata.join('&');

    if(history.pushState){
        // history.pushState(null, null, loc.pathname+'?'+fdata);
    }
   $(".data_div").html('<div class="text-center"><img src="<?php echo WEBSITE_IMG_URL.'ajax-loading.gif'; ?>" /></div>');
   $('html, body').animate({scrollTop: ($(".data_div").offset().top - 200)}, 'slow');
  var options = {
    type: 'post',
    success:function(r){
      data    = JSON.parse(r) ;
      $(".data_div").html(data.data);
      $('html, body').animate({scrollTop: ($(".data_div").offset().top - 200)}, 'slow');
      $('.readonly').raty({
        readOnly : true,
        score: function() {
          return $(this).attr('data-score');
        }
      });
    },
    resetForm:false
  };
 
  $("form#"+form_id).ajaxSubmit(options);
}

$(function(){
  $('.readonly').raty({
    readOnly : true,
    score: function() {
      return $(this).attr('data-score');
    }
  });

  $(document).on('click', '#pagination a', function(e) {
    e.preventDefault();
    var target = $(this).attr('href');
    if(target != ''){
       $(".data_div,#pagination a").css({'cursor' : 'wait'});
      /* $(".data_div").html('<div class="text-center"><img src="<?php echo WEBSITE_IMG_URL.'ajax-loading.gif'; ?>" /></div>'); */
      $.get(target, function(r){
        $(".data_div,#pagination a").css({'cursor' : 'default'});
        $(".data_div").html(r.data);
        $('.readonly').raty({
          readOnly : true,
          score: function() {
            return $(this).attr('data-score');
          }
        });
      }, 'json');
    }
  });
  $(".pr_che").change(function(){
    casino_search();
  });
   $(".side_bar_post > h3").click(function(){
     var class1 = $(this).attr('class');
     if(class1=='active'){
      $(this).next('.side_bar_ptions').addClass('hide');
      $(this).removeClass('active');
     }else{
      $(this).next('.side_bar_ptions').removeClass('hide');
      $(this).addClass('active');
     }
   });
    $( "#slider-range" ).slider({
    range: true,
    min: 0,
    max: 300,
    values: [ 0, 300 ],
    slide: function( event, ui ) {
      $( "#p_min" ).val(ui.values[ 0 ]);
      $( "#p_min_html" ).html(ui.values[ 0 ]+'H');
      $( "#p_max" ).val(ui.values[ 1 ]);
      $( "#p_max_html" ).html(ui.values[ 1 ]+'H');
    },
    change: function( event, ui ) {
      casino_search();
    }
    });
  $( "#p_min" ).val(0);
  $( "#p_max" ).val(300);
  $( "#p_min_html" ).html('0H');
  $( "#p_max_html" ).html('300H');

  $( "#payout_percentage" ).val(0);
  $( "#payout_percentage_max" ).val(100);
  $( "#payout_percentageh" ).html('0%');
  $( "#payout_percentageh_max" ).html('100%');

    $( "#payout_percentages" ).slider({
    range: true,
    min: 0,
    max: 100,
    values: [ 0,100],
    slide: function( event, ui ) {
      $( "#payout_percentage" ).val(ui.values[ 0 ]);
      $( "#payout_percentage_max" ).val(ui.values[ 1 ]);
      $( "#payout_percentageh" ).html(ui.values[ 0 ]+'%');
      $( "#payout_percentageh_max" ).html(ui.values[ 1 ]+'%');
    },
    change: function( event, ui ) {
      casino_search();
    }
    });
  <?php if(!empty($selectedId)){ ?>
  setTimeout(function(){
    $("#<?php echo $selectedId; ?>").prop('checked', true);
  },2000);
  <?php } ?>
});

var amount_dict = {
    "USD":{
          "less_100_USD":[0,100,"<=100 USD"],
          "100-500-USD" :[100,500,"100-500 USD"],
          "greter_500_USD":[500,2147483648,"> 500 USD"]
        },
    "EUR":{
          "less_100_EUR":[0,100,"<=100 EUR"],
          "100-500-EUR":[100,500,"100-500 EUR"],
          "greter_500_EUR":[500,2147483648, "> 500 EUR"]
        },
    "GBP":{
          "less_100_GBP":[0,100,"<=100 GBP"],
          "100-500-GBP":[100,500,"100-500 GBP"],
          "greter_500_GBP":[500,2147483648, "> 500 GBP"]
        }
    };
    
function headerFormFilter(){
	bonus = $(".bonus-type-select").val();
	amount = $(".amount-type-select").val();
	//alert(bonus);
	//alert(amount);
	amount_dropdown = document.getElementById("slct_amount");
	//TODO: Got the price range in catAmount variables. Handle that on change and render price dropdown accordingly.
	console.log("amount is " + amount);

 	if(amount == ''){ 
	    return false;
	}

	$.ajax({  
		url: '<?php echo $this->Url->build('/promotions/headerSearch'); ?>',
		data: {'category_id' : bonus,'amount' : amount,'selected':'<?php if(!empty($this->request->query['game_id']))
               { echo $this->request->query['game_id']; } ?>'},
		type: 'POST',
		success:function(r){
			console.log(r);
			$("#selectajax").html(r);
		
		}
	}); 

}


/*
    Update amount filter based on type selected.
*/

function headerFormFilterType(){
	
	
	/*if ( catAmount.hasOwnProperty(bonus)){
	    amountRange = catAmount[bonus];
	    //console.log(amountRange);
	    alert(amountRange);
        var $select = $('#slct_amount');
        $select.children().remove(); 
        $select.append($("<option></option>").attr("value", ""  ).text("Select a payment") );
        
        var $game_select = $('#slct_game');
        $game_select.children().remove(); 
        $game_select.append($("<option></option>").attr("value", ""  ).text("Select a device") );
        
        $.each(amount_dict, function(key, value){
            var group = $('<optgroup label="----------------------" />');
            $.each(value, function(k,v){
                var enabled = false;
                for(var j in amountRange){
                    //console.log(j);
	                rangeVal = parseInt(amountRange[j]["b_amount"].replace(/[<>=]/g,''));
	                //console.log(key,v[0],rangeVal,v[1],amountRange[j]["Currency"]);
                    if (!isNaN(rangeVal) && v[0] <= rangeVal && rangeVal <= v[1] && amountRange[j]["Currency"].includes(key))
                    {
                        //console.log(v[2] + " enabled");
                        enabled = true;
                        break;
                    }
                }
                if(enabled == true){
                    $('<option />').attr("value", k  ).text(v[2]).appendTo(group);
                }
            });
            group.appendTo($select);
        });
    }*/
}

headerFormFilter();

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
/*($(document).ready(function(){
   
    $("#slct").change(function(){
        var game_name = $("#slct").val();
    	var url =  document.location.origin+'/casinos/getdepositMethodTM';
    		$.ajax({
        	  
        		url: url, 
        		data: {name : game_name },
        		type: 'POST',
        		success:function(r)
        		{
        			 alert(r);
        			$("#slct_deposit").html(r);
        		
        		},
        		 error: function(e) 
                {
                    alert('Some thing went Wrong!');
                }
        	}); 
        });
    
});*/

</script>
<script>
function drop_game()
{
	var game_id = $("#slct").val();
    var url =  document.location.origin+'/filter_game';
	if(game_id!=''){
    	$.ajax({
    		url:url,
    		type:'POST',
    		data:{game_id:game_id},
    		success:function(data){
    		//	alert(data);
    	     $('#slct_deposit').removeAttr('disabled');
    	      $('#slct_deposit').removeAttr("style");
    		 $("#slct_deposit").html(data);
    		  
    		}
    	});
	}
	else
	{
	    return false;
	}
}
function drop_paymentmethod()
{
	var deposit_method_id = $("#slct_deposit").val();
    var url =  document.location.origin+'/filter_paymetmethod';
	if(deposit_method_id!=''){
    	$.ajax({
    		url:url,
    		type:'POST',
    		data:{deposit_method_id:deposit_method_id},
    		success:function(data){
    		//	alert(data);
    	     $('#slct_device').removeAttr('disabled');
    	     $('#slct_device').removeAttr("style");
    		 $("#slct_device").html(data);
    		  
    		}
    	});
	}
	else
	{
	    return false;
	}
}


</script>

<?php $this->Html->scriptEnd(); ?>
