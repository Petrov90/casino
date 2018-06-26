<?php use Cake\I18n\Time;
echo $this->Html->script(['bootstrap-select.js'],array());
?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script>
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
</script>
  <?php
$bns_cnt = 1;
$faq_sect = 0;
//pr($headBlock);die;
 $best_casino_title = "";
 $best_casino_des = "";
if($type == 'bonus-type'){
	$faqcategory =   $headBlock->id;
	$faq_mn_title =   $headBlock->faq_mn_title;
	 $faq_title =   $headBlock->faq_title;
	  $faq_ques1 =   $headBlock->faq_ques1;
	  $faq_desc1 =   $headBlock->faq_desc1;
	  $faq_ques2 =   $headBlock->faq_ques2;
	  $faq_desc2 =   $headBlock->faq_desc2;
	  $faq_ques3 =   $headBlock->faq_ques3;
	  $faq_desc3 =   $headBlock->faq_desc3;
	  $best_casino_title =   $headBlock->best_casino_title;
	  $best_casino_des =   $headBlock->best_casino_des;

	  $faq_sect = 1;
}

foreach($allCat as $cat)
{
   if($type == $cat->slug)
   {
      $title               = 	(!empty($cat->_translations[$Defaultlanguage]->title)) ? $cat->_translations[$Defaultlanguage]->title : $cat->_translations['en']->title;
      $footer_main_title   =  	(!empty($cat->_translations[$Defaultlanguage]->footer_main_title)) ? $cat->_translations[$Defaultlanguage]->footer_main_title : $cat->_translations['en']->footer_main_title;
      $second_description   =    (!empty($cat->_translations[$Defaultlanguage]->second_description)) ? $cat->_translations[$Defaultlanguage]->second_description : $cat->_translations['en']->second_description;
      $sub_title           =    (!empty($cat->_translations[$Defaultlanguage]->sub_title)) ? $cat->_translations[$Defaultlanguage]->sub_title : $cat->_translations['en']->sub_title;
      $middle_title        =    (!empty($cat->_translations[$Defaultlanguage]->middle_title)) ? $cat->_translations[$Defaultlanguage]->middle_title : $cat->_translations['en']->middle_title;

       $middle_title_description        =    (!empty($cat->_translations[$Defaultlanguage]->middle_title_description)) ? $cat->_translations[$Defaultlanguage]->middle_title_description : $cat->_translations['en']->middle_title_description;

       $head_first_block    =  (!empty($cat->_translations[$Defaultlanguage]->head_first_block)) ? $cat->_translations[$Defaultlanguage]->head_first_block : $cat->_translations['en']->head_first_block;
      $head_second_block   =  (!empty($cat->_translations[$Defaultlanguage]->head_second_block)) ? $cat->_translations[$Defaultlanguage]->head_second_block : $cat->_translations['en']->head_second_block;
      $head_image          =  $cat->head_image;
      $faqcategory =  $cat->id;
      $faq_title =   $cat->faq_title;
	  $faq_ques1 =   $cat->faq_ques1;
	  $faq_desc1 =   $cat->faq_desc1;
	  $faq_ques2 =   $cat->faq_ques2;
	  $faq_desc2 =   $cat->faq_desc2;
	  $faq_ques3 =   $cat->faq_ques3;
	  $faq_desc3 =   $cat->faq_desc3;
	  $faq_mn_title = $cat->faq_mn_title;
	  $faq_sect = 1;
	  $best_casino_title =   $cat->best_casino_title;
	  $best_casino_des =   $cat->best_casino_des;
   }

   if($cat->slug == 'welcome-bonuses')
   {
      $slug =  'welcomeBonuses';
   }
   if($cat->slug == 'free-spins')
   {
      $slug =  'freeSpins';
   }
   if($cat->slug == 'no-deposit-bonuses')
   {
      $slug =  'noDepoitBonus';
   }
   if($cat->slug == 'cash-back-bonus')
   {
      $slug =  'cashBackBonus';
   }
   if($cat->slug == 'reload-bonus')
   {
      $slug =  'reloadBonus';
   }
   if($cat->slug == 'high-roller-bonus')
   {
      $slug =  'highRollerBonus';
   }
}
?>
<!-- <script>
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
</script> -->
<style type="text/css">
	body {
}
.center-on-page {
   background: #fff none repeat scroll 0 0;
    display: inline-flex;
    padding: 5px;
    width: 100%;}
h1 {
  text-align: center;
}
/* Reset Select */
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
.search-back-a {
    background: #aa1c2c none repeat scroll 0 0;
    border: medium none;
    color: #fff;
    font-family: 'latosemibold';
    font-size: 18px;
    height: 100%;
    letter-spacing: 1px;
    padding: 6px 12px;
    position: absolute;
    right: 0;
    top: 0;
}
#slct > option{border-bottom: 1px solid #f1f1f1; padding: 5px 0; border-right: none !important; text-indent: 10px}
.banner_parg-right > div {
    background: #fff none repeat scroll 0 0;
    float: left;
    margin-left: -15px;
    min-height: 230px;
    padding: 10px 10px 10px 30px;
border: 1px solid #dbdbdb;
}
.bonuses-section h1{ font-family: 'latosemibold'; color: #393838; font-size: 24px;}
.title h2{ font-family: 'latosemibold'; color: #393838; font-size: 24px;}
.banner_parg-right p strong{font-size: 15px; font-family: 'latobold';}
.banner_parg-right li{font-size: 15px; color: #393838;}
.banner_post p{font-size: 15px;}
.bonuses-mid-wrap .fil_block ul a, .bonuses-mid-wrap .fil_block ul li{font-size: 14px; font-family:'latoregular'; font-weight: normal;}
.pptionsBox ul li label{font-size: 16px; color: #6f6f6f;}
.side_bar_post h3{font-family: 'latosemibold' !important; font-size: 16px !important;}
.fil_block ul li a{padding: 0 48px;}
.fil_block ul li:last-child{border-right: none;}
.gamb_post{background:#fff; margin: 55px 0 0;}
.gamb_post .title{margin: 0; background:#284450; width: auto;}
.gamb_post .title h2{margin: 0 !important; padding: 8px 18px; width: auto;float: left; color: #fff;}
.gamb_post_iner{padding: 0 18px;}
.faq-section .fq-content p{color: #000; font-size: 14px;}
.faq-section .faq_question h4{font-size: 14px; color: #000;}
.faq-section .fq-content{padding: 6px; border: none;}
.fq_main{  -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #fff;
    border-color: currentcolor #ccc #ccc;
    border-image: none;
    border-style: none solid solid;
    border-width: medium 1px 1px;
    float: left;
    padding: 0;
    width: 100%;}
    .fq_main h3{background:#aa1d2d; color: #fff; margin: 0; padding: 10px 38px; float: left;}
    .prev.disabled {
    display: none !important;
}

.best_para ol {
    color: #fff;
    padding: 0 0 0 40px;
}
</style>
<?php
  // if(isset($_POST['find']))
  // {
  //   echo "here";
  //   die;
  // }

?>
<div class="banner">
   <div class="transparent-black bonuses">
      <div class="container">
         <div class="banner-content">
            <h1>Find the Perfect Casino Bonus</h1>
          <?php  echo $this->Form->create('Bonus',['type' => 'GET','id' => 'search_form','url' => $this->Url->build(['plugin' => '','controller' => 'promotions','action' => 'promotion'])]); ?>
  <div class="search-back">
               <div class="top-search" data-ng-app>
                 <div class="form-group">
			     <div class="center-on-page">
				  <div class="select">

				    <select name="bonustype" id="slct" class="bonus-type-select" onchange="headerFormFilter()">
				      <option> Select a bonus type </option>
				      <?php
              foreach($allCatSideBarq as $bonustype){

                $bonus = strtolower(str_replace(" ","-",$bonustype->icon_title)); ?>
				      <option <?php if(!empty($this->request->query['bonustype']) && $this->request->query['bonustype'] == $bonustype->id)
               { echo "selected"; } ?>
               value="<?php  echo $bonustype->id; ?>">
              <?php echo !empty($bonustype->icon_title) ? $bonustype->icon_title : $bonustype->title;  ?></option>
				      <?php }  ?>
				      <!-- <option value="1">Pure CSS</option>
				      <option value="2">No JS</option>
				      <option value="3">Nice!</option> -->
				    </select>
				  </div>
				  <div class="select">
            <?php //if($this->request->data['amount']) { //echo $this->request->data['amount']; }?>
				    <select name="amount" id="slct" class="amount-type-select" onchange="headerFormFilter()">
				      <option value="">Select an amount</option>
              <optgroup>
              <option <?php if(!empty($this->request->query['amount']) && $this->request->query['amount'] == "less_100_USD")
               { echo "selected"; } ?> value = "less_100_USD"> < &nbsp;100 USD</option>
              <option <?php if(!empty($this->request->query['amount']) && $this->request->query['amount'] == "100-500-USD")
               { echo "selected"; } ?>  value = "100-500-USD">  100-500 USD</option>
              <option <?php if(!empty($this->request->query['amount']) && $this->request->query['amount'] == "greter_500_USD")
               { echo "selected"; } ?>  value = "greter_500_USD"> &nbsp;> 500 USD</option>
              </optgroup>
              <optgroup label="----------------------">
              <option <?php if(!empty($this->request->query['amount']) && $this->request->query['amount'] == "less_100_EUR")
               { echo "selected"; } ?>  value = "less_100_EUR"> < &nbsp;100 EUR</option>
              <option <?php if(!empty($this->request->query['amount']) && $this->request->query['amount'] == "100-500-EUR")
               { echo "selected"; } ?>  value = "100-500-EUR">  100-500 EUR</option>
              <option <?php if(!empty($this->request->query['amount']) && $this->request->query['amount'] == "greter_500_EUR")
               { echo "selected"; } ?>  value = "greter_500_EUR" > >&nbsp; 500 EUR</option>
              </optgroup>
              <optgroup label="----------------------">
              <option <?php if(!empty($this->request->query['amount']) && $this->request->query['amount'] == "less_100_GBP")
               { echo "selected"; } ?>  value = "less_100_GBP"> < &nbsp; 100 GBP</option>
              <option <?php if(!empty($this->request->query['amount']) && $this->request->query['amount'] == "100-500-GBP")
               { echo "selected"; } ?>  value = "100-500-GBP">  100-500 GBP</option>
              <option <?php if(!empty($this->request->query['amount']) && $this->request->query['amount'] == "greter_500_GBP")
               { echo "selected"; } ?>  value = "greter_500_GBP"> >&nbsp;500 GBP</option>
              </optgroup>

				    </select>
				  </div>
				  <div class="select" id="selectajax">
				    <select name="game_id" id="slct">
				      <option value=""> Select a game</option>
              <?php //$gambling_options = json_decode($gambling_options); ?>
				      <?php /*foreach($gambling_options as $game){ //echo "<pre>"; print($cat); ?>
				      <option
              <?php if(!empty($this->request->query['game_id']) && $this->request->query['game_id'] == $game->id)
               { echo "selected"; } ?>
              value="<?php echo $game->id; ?>"><?php echo $game->name; ?></option>
				      <?php } */ ?>
				      <!-- <option value="1">Pure CSS</option>
				      <option value="2">No JS</option>
				      <option value="3">Nice!</option> -->
				    </select>
				  </div>
				</div>
			    </div>
                <button class="search-back-a" type="submit">Find Bonus</button>
                <!-- <input value="Find Bonus" class="search-back-a" type="button"> -->
                  <!-- <a data-ng-href="<?php echo WEBSITE_URL; if($Defaultlanguage != 'en'){ echo $Defaultlanguage.'/'; } ?>search/{{city_name}}" class="search-back-a"><?= __('homepage.search'); ?></a>  -->
               </div>
            </div>
            <?php echo $this->Form->end(); ?>
         </div>
      </div>
   </div><?php /*
   <div class="find_line"><?php echo (!empty($allBlocks[3]->_translations[$Defaultlanguage]->description)) ? $allBlocks[3]->_translations[$Defaultlanguage]->description : $allBlocks[3]->_translations['en']->description ; ?></div>*/ ?>
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
<div class="mid_wrapper bonuses-mid-wrap">
   <div class="casinoSearch Casino_iNFo  sub_titleLeft">
      <div class="container">
         <div class="title">
            <h2><?php if(isset($sub_title)){ echo $sub_title; }else{  echo (!empty($headBlock->_translations[$Defaultlanguage]->sub_title)) ? $headBlock->_translations[$Defaultlanguage]->sub_title : $headBlock->_translations['en']->sub_title; }  ?></h2>
         </div>
         <div class="row">
			<div class="col-md-8">
				<div class="filter_2N">
					<div class="fil_block">
						<ul>
							<li><strong>Sort by:</strong></li>
							<li><?php echo $this->Paginator->sort('id','Recommended'); ?></li>
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
							<?php echo $this->element('promotion_search'); ?>
						</div>
		            </div>

            	</div>
            	<div class="col-md-4">
	            	<div class="gamblingBox side_bar_box">
						<?php //echo $this->element('promotion_search_side_bar_'.$Defaultlanguage); ?>
						<?php echo $this->cell('Inbox::bonuspage', [], ['cache' => ['config' => 'longlong', 'key' => 'promotion_'.$Defaultlanguage]]); ?>
		            </div>
	            </div>
            </div>
         </div>
      </div>
   </div>

<div class="best_casino">
	<div class="container">
		<div class="cas_bes_iner">
			<h4><?php echo $best_casino_title; ?></h4>
<div class="serchbox">
	<img src="images/search_icn.png">
</div>
<div class="best_para">
	<p>
		<?php echo $best_casino_des; ?>

	</p>

</div>
		</div>

	</div>
</div>


   <div class="gamble_online_info gamble_online_in2  sub_titleLeft">
      <div class="container">

         <div class="gamble_online_post gamb_post">
         <div class="title">
            <h2>
               <?php
                  if(isset($footer_main_title)){ echo $footer_main_title;}
                  else{  echo (!empty($headBlock->_translations[$Defaultlanguage]->footer_main_title)) ? $headBlock->_translations[$Defaultlanguage]->footer_main_title : $headBlock->_translations['en']->footer_main_title; }
               ?>
         </h2>
         </div>
            <div class="gamble_online_item gamb_post_iner">
             <!-- <img src="images/welcome_bonus.png">  -->
   			<?php if(isset($second_description)){
   				echo $this->App->force_balance_tags($second_description);
   			}else{
		echo $this->App->force_balance_tags((!empty($headBlock->_translations[$Defaultlanguage]->second_description)) ? $headBlock->_translations[$Defaultlanguage]->second_description : $headBlock->_translations['en']->second_description);
             } ?></div>
         </div>
      </div>
      <div ></div>
<!--  gmbl catergory starts here-->
   <div class="gamble_online gamble_online_info2 gamble_online_Images  sub_titleLeft">
      <div class="container">
         <div class="title">

            <h2>
              <?php
                  if(isset($middle_title)){ echo $middle_title;}
                  else{  echo (!empty($headBlock->_translations[$Defaultlanguage]->middle_title)) ? $headBlock->_translations[$Defaultlanguage]->middle_title : $headBlock->_translations['en']->middle_title; }
               ?>
            </h2>

         </div>
            <div>
            <?php
                  if(isset($middle_title_description)){ echo $middle_title_description;}
                  else{  echo (!empty($headBlock->_translations[$Defaultlanguage]->middle_title_description)) ? $headBlock->_translations[$Defaultlanguage]->middle_title_description : $headBlock->_translations['en']->middle_title_description; }
               ?>

            </div>
         <div class="ChooosetypeRow">
            <?php foreach($allCat as $cat){
				if($type == $cat->slug){
					$second_description   =  (!empty($cat->_translations[$Defaultlanguage]->second_description)) ? $cat->_translations[$Defaultlanguage]->second_description : $cat->_translations['en']->second_description;
				}

			$bns_alt = '';

			if($cat->slug == 'welcome-bonuses'){
				$slug	=	'welcomeBonuses';
				$bns_alt = 'Welcome bonus';
			}
			if($cat->slug == 'free-spins'){
				$slug	=	'freeSpins';
				$bns_alt = 'Free spins';
			}
			if($cat->slug == 'no-deposit-bonuses'){
				$slug	=	'noDepoitBonus';
				$bns_alt = 'No deposit bonus';
			}
			if($cat->slug == 'cash-back-bonus'){
				$slug	=	'cashBackBonus';
				$bns_alt = 'Cash back bonus';
			}
			if($cat->slug == 'reload-bonus'){
				$slug	=	'reloadBonus';
				$bns_alt = 'Reload bonus';
			}
			 if($cat->slug == 'high-roller-bonus')
			   {
				  $slug =  'highRollerBonus';
				  $bns_alt = 'High roller bonus';
			   }
			?>
		<?php
			if( ($type == 'welcome-bonuses' || $type == 'free-spins' || $type == 'no-deposit-bonuses' || $type == 'cash-back-bonus' || $type == 'reload-bonus' || $type == 'high-roller-bonus') && $bns_cnt ) {?>
				<div class="col col_bml2">
					<a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'promotions','action' => 'promotion')); ?>">
					   <div class="block"><div class="block_2"> <i><img src="<?php echo WEBSITE_IMG_URL; ?>bonus2_new2.png" alt="icon"></i><i class="fa"><img src="<?php echo WEBSITE_IMG_URL; ?>bonus1_new1.png"" alt="icon"></i> </div></div>
					    <div class="col_block"><span><?php  echo 'All Bonuses'; ?></span></div>
					</a>
				</div>
		<?php $bns_cnt= 0 ; }?>




		<?php if($type != $cat->slug) {?>
			<div class="col col_bml2 bb_cat">
				<a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'promotions','action' => $slug)); ?>">
				   <div class="block"><div class="block_2"><i><img src="<?php echo GALLERY_IMG_URL.$cat->back_image; ?>" alt="<?php echo $bns_alt;?>"></i><i class="fa"><img src="<?php echo GALLERY_IMG_URL.$cat->image; ?>" alt="<?php echo $bns_alt;?>"></i></div></div>
				    <div class="col_block"><span><?php  echo (!empty($cat->_translations[$Defaultlanguage]->icon_title)) ? $cat->_translations[$Defaultlanguage]->icon_title : $cat->_translations['en']->icon_title; ?></span></div>
				</a>
			</div>
		<?php } ?>

            <?php } ?>
		</div>
      </div>
   </div>

<!-- gabmbl ends here -->
  <!-- faq section strat -->
  <?php if($faq_sect) {?>

  <section class="faq-section">
  	<div class="container">
	  	<div class="row">
	  		<div class="col-md-12">
        <div class="fq_main">
          <h3><?php echo $faq_mn_title; ?></h3>
	  			<div class="fq-content">

	  				<p><?php echo $faq_title; ?></p>
	  				<?php //echo $faqcategory;
	  				$faqcategorydetails = $this->SocialShare->faqcategory($faqcategory);
	  				//echo "<pre>"; print_r($faqcategorydetails);
					if(isset($faqcategorydetails) && !empty($faqcategorydetails)){
					//echo "<pre>"; print_r($faqcategorydetails); die;
						//$tt	=	json_decode($faqcategorydetails);
						//pr($tt);
						foreach($faqcategorydetails as $text){ ?>
		  				<div class="faq_question border-tops">

		  				<img src="<?php echo WEBSITE_IMG_URL ?>faq_ques_cas.png" alt="<?=$text['faq_alt']?>">	<h4><?php echo $text['faq_title']; ?></h4>

		  					<p><?php echo $text['faq_description']; ?></p>

		  				</div>

		  				<?php
		  				}
					}?>
	  				<!-- <div class="faq_question border-tops">
	  				<img src="<?php echo WEBSITE_IMG_URL ?>faq_ques_cas.png">	<h4><?php echo $faq_ques1; ?></h4>
	  					<p><?php echo $faq_desc1; ?></p>
	  				</div>
	  				<div class="faq_question">
	  				<img src="<?php echo WEBSITE_IMG_URL ?>faq_ques_cas.png">	<h4><?php echo $faq_ques2; ?></h4>
	  					<p><?php echo $faq_desc2; ?></p>
	  				</div>
	  		  		<div class="faq_question">
	  				<img src="<?php echo WEBSITE_IMG_URL ?>faq_ques_cas.png">	<h4><?php echo $faq_ques3; ?></h4>
	  					<p><?php echo $faq_desc3; ?></p>
	  				</div>	 -->
	  			</div>
</div>


	  		</div>
	  	</div>
	  </div>
  </section>
<?php }?>
  <!-- faq section end -->



   </div>
</div>

<?php

echo $this->Html->css(['jquery-ui.min.css'],array('block' =>'css1'));
echo $this->Html->script(['jqueryslider.js'],array('block' =>'footer_script'));
$this->Html->scriptStart(array('block' => 'custom_script')); ?>
function casino_search(){
   form_id	=	'pchec';
 var data = {},
        fdata = [],
        loc = $('<a>', {href:window.location})[0];
		$('input[type="checkbox"]').each(function(i){
			if(this.checked){
				if(!data.hasOwnProperty(this.name)){
					data[this.name] = [];
				}
				name	=	this.name;
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
			data		=	JSON.parse(r) ;
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
		 var class1	=	$(this).attr('class');
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

function headerFormFilter(){
	bonus = $(".bonus-type-select").val();
	amount = $(".amount-type-select").val();
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
	})
}
headerFormFilter();
<?php $this->Html->scriptEnd(); ?>
