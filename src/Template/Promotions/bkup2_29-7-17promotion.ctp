<?php use Cake\I18n\Time;

$bns_cnt = 1;
$faq_sect = 0;

if($type == 'bonus-type'){
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

   if($type == $cat->slug)
   {
      $title               = 	(!empty($cat->_translations[$Defaultlanguage]->title)) ? $cat->_translations[$Defaultlanguage]->title : $cat->_translations['en']->title;
      $footer_main_title   =  	(!empty($cat->_translations[$Defaultlanguage]->footer_main_title)) ? $cat->_translations[$Defaultlanguage]->footer_main_title : $cat->_translations['en']->footer_main_title;
      $sub_title           =    (!empty($cat->_translations[$Defaultlanguage]->sub_title)) ? $cat->_translations[$Defaultlanguage]->sub_title : $cat->_translations['en']->sub_title;
      $middle_title        =    (!empty($cat->_translations[$Defaultlanguage]->middle_title)) ? $cat->_translations[$Defaultlanguage]->middle_title : $cat->_translations['en']->middle_title;
       $head_first_block    =  (!empty($cat->_translations[$Defaultlanguage]->head_first_block)) ? $cat->_translations[$Defaultlanguage]->head_first_block : $cat->_translations['en']->head_first_block;
      $head_second_block   =  (!empty($cat->_translations[$Defaultlanguage]->head_second_block)) ? $cat->_translations[$Defaultlanguage]->head_second_block : $cat->_translations['en']->head_second_block;
      $head_image          =  $cat->head_image;
      $faq_title =   $cat->faq_title;
	  $faq_ques1 =   $cat->faq_ques1;
	  $faq_desc1 =   $cat->faq_desc1;
	  $faq_ques2 =   $cat->faq_ques2;
	  $faq_desc2 =   $cat->faq_desc2;	 
	  $faq_ques3 =   $cat->faq_ques3;
	  $faq_desc3 =   $cat->faq_desc3;	
	  $faq_sect = 1; 
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
?><div class="banner_inner banner_back_top  img_block2  banner_leftSide">
   <div class="banner_info banner_textblock">
      <div class="container">
      <h1> <?php 
               if(isset($title)){ echo $title;}
               else{	
				echo (isset($headBlock->_translations[$Defaultlanguage]->title) && !empty($headBlock->_translations[$Defaultlanguage]->title)) ? $headBlock->_translations[$Defaultlanguage]->title : $headBlock->_translations['en']->title;
			   }
            ?></h1>
         <div class="banner_post banner_parg">
            <div class="col-md-6"><?php /*
               <span> <?php 
			         if(isset($head_image)){
				           echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=115px&height=131px&cropratio=1:1&image='.GALLERY_IMG_URL.$head_image,['alt' => 'Image']);				
			            }else{
							echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=115px&height=131px&cropratio=1:1&image='.GALLERY_IMG_URL.$headBlock->head_image,['alt' => 'Image']);
                     } 
                  ?></span>*/ ?>
               <div>
			  <?php 
               if(isset($head_first_block)){ 
                     echo $this->App->force_balance_tags($head_first_block);
               }else{
                     echo $this->App->force_balance_tags((!empty($headBlock->_translations[$Defaultlanguage]->head_first_block)) ? $headBlock->_translations[$Defaultlanguage]->head_first_block : $headBlock->_translations['en']->head_first_block);
                     }
            ?>
               </div>
            </div>
            <div class="col-md-6">
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
<div class="mid_wrapper">
   <div class="casinoSearch Casino_iNFo  sub_titleLeft">
      <div class="container">
         <div class="title">
            <h2><?php if(isset($sub_title)){ echo $sub_title; }else{  echo (!empty($headBlock->_translations[$Defaultlanguage]->sub_title)) ? $headBlock->_translations[$Defaultlanguage]->sub_title : $headBlock->_translations['en']->sub_title; }  ?></h2>
         </div>
         <div class="row">
			<div class="filter_2N">
				<div class="fil_block">
					<ul>
						<li><?php echo $this->Paginator->sort('id','Recommended'); ?></li>					
						<li><?php echo $this->Paginator->sort('created','Date'); ?></li>

						<li><?php echo $this->Paginator->sort('Casino.avg_rating','User Rating'); ?></li>
						<li><?php echo $this->Paginator->sort('title','Name'); ?></li>
					</ul>				
				</div>
			<div class="">
				<?php echo $this->Form->create('Promotions',['type' => 'get','class' => 'search_box3']); ?>
				<?php echo $this->Form->text('title',['placeholder' => 'Casino Name','value' => isset($requestedQuery['title']) ? $requestedQuery['title'] : '']); ?>
				<button type="submit"><img src="<?php echo WEBSITE_IMG_URL; ?>search_img.png" alt="img"></button>
				<?php echo $this->Form->end(); ?>
			</div>			
			</div>
        </div>
         <div class="filtrInner">
            <div class="clint_info">
				<div class="data_div">
					<?php echo $this->element('promotion_search'); ?>
				</div>
            </div>
            <div class="gamblingBox side_bar_box">
				<?php //echo $this->element('promotion_search_side_bar_'.$Defaultlanguage); ?>
				<?php echo $this->cell('Inbox::bonuspage', [], ['cache' => ['config' => 'longlong', 'key' => 'promotion_'.$Defaultlanguage]]); ?>
            </div>
         </div>
      </div>
   </div>
   <div class="gamble_online gamble_online_info2 gamble_online_Images  sub_titleLeft">
      <div class="container">
         <div class="title">
            <h2><?php echo (isset($middle_title)) ? $middle_title : (!empty($headBlock->_translations[$Defaultlanguage]->middle_title)) ? $headBlock->_translations[$Defaultlanguage]->middle_title : $headBlock->_translations['en']->middle_title; ?></h2>
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
			<div class="col col_bml2">
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
   <div class="gamble_online_info gamble_online_in2  sub_titleLeft">
      <div class="container">
         <div class="title">
            <h2>
               <?php 
                  if(isset($footer_main_title)){ echo $footer_main_title;}
                  else{  echo (!empty($headBlock->_translations[$Defaultlanguage]->footer_main_title)) ? $headBlock->_translations[$Defaultlanguage]->footer_main_title : $headBlock->_translations['en']->footer_main_title; }
               ?>
         </h2>
         </div>
         <div class="gamble_online_post">
            <div class="gamble_online_item">
   			<?php if(isset($second_description)){ 
   				echo $this->App->force_balance_tags($second_description);
   			}else{
				echo $this->App->force_balance_tags((!empty($headBlock->_translations[$Defaultlanguage]->second_description)) ? $headBlock->_translations[$Defaultlanguage]->second_description : $headBlock->_translations['en']->second_description);
             } ?></div>
         </div>
      </div>

  <!-- faq section strat -->
  <?php if($faq_sect) {?>

  <section class="faq-section">
  	<div class="container">
	  	<div class="row">
	  		<div class="col-md-12">
	  			<div class="fq-content">
	  				<h3>Online Casino Bonuses FAQ</h3>
	  				<p><?php echo $faq_title; ?></p>

	  				<div class="faq_question border-tops">
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
	  				</div>			
	  			</div>
	  		</div>
	  	</div>
	  </div>
  </section>
<?php }?>
  <!-- faq section end --> 



   </div>
</div><?php 
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
<?php $this->Html->scriptEnd(); ?>