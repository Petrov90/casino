<?php //pr($headBlock);
 foreach($allCat as $cat)
{
   if($type == $cat->slug)
   {  
      $footer_main_title   			=  (!empty($cat->_translations[$Defaultlanguage]->footer_main_title)) ? $cat->_translations[$Defaultlanguage]->footer_main_title : $cat->_translations['en']->footer_main_title;
      $title               			=  (!empty($cat->_translations[$Defaultlanguage]->title)) ? $cat->_translations[$Defaultlanguage]->title : $cat->_translations['en']->title;
      $sub_title           			=  (!empty($cat->_translations[$Defaultlanguage]->sub_title)) ? $cat->_translations[$Defaultlanguage]->sub_title : $cat->_translations['en']->sub_title;
      $middle_title           		=  (!empty($cat->_translations[$Defaultlanguage]->middle_title)) ? $cat->_translations[$Defaultlanguage]->middle_title : $cat->_translations['en']->middle_title;
      $head_first_block   			=  (!empty($cat->_translations[$Defaultlanguage]->head_first_block)) ? $cat->_translations[$Defaultlanguage]->head_first_block : $cat->_translations['en']->head_first_block;
      $head_second_block   			=  (!empty($cat->_translations[$Defaultlanguage]->head_second_block)) ? $cat->_translations[$Defaultlanguage]->head_second_block : $cat->_translations['en']->head_second_block;
      $head_image          			=  $cat->head_image;
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
<div class="banner_inner banner_back_img">
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
</div>
<div class="mid_wrapper">
   <div class="casinoSearch">
      <div class="container">
         <div class="title">
            <h2><?php if(!empty($sub_title)){ echo  $sub_title; }else{ echo (!empty($headBlock->_translations[$Defaultlanguage]->sub_title)) ? $headBlock->_translations[$Defaultlanguage]->sub_title : $headBlock->_translations['en']->sub_title ;}  ?></h2><?php /*
            <div><?php echo (isset($sub_title_description)) ?  $sub_title_description : $headBlock->sub_title_description;  ?></div>
            <span></span>*/ ?>
         </div>
           <div class="row">
			<div class="filter_2N">
				<div class="fil_block">
					<ul>
						<li><?php echo $this->Paginator->sort('created','Date'); ?></li>
						<li><?php echo $this->Paginator->sort('created','Recomended'); ?></li>
						<li><?php echo $this->Paginator->sort('avg_rating','User Rating'); ?></li>
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
					<?php echo $this->element('online_casino_search'); ?>
				</div>
            </div>
            <div class="gamblingBox side_bar_box"><?php echo $this->cell('Inbox::onlinecasino', [], ['cache' => ['config' => 'longlong', 'key' => 'onlinecasino_'.$Defaultlanguage]]); ?>
			</div>
         </div>
      </div>
   </div>
   <div class="beginners_info">
      <div class="container">
		    <?php echo $this->element('guide_casinos'); ?>

	  </div>
   </div>
   <div class="gamble_online">


      <div class="container">
        <div class="title">
          <h2><?php if(isset($middle_title)){ echo $middle_title; }else{ echo (!empty($headBlock->_translations[$Defaultlanguage]->middle_title)) ? $headBlock->_translations[$Defaultlanguage]->middle_title : $headBlock->_translations['en']->middle_title; } ?></h2>
        </div>
        <div class="ChooosetypeRow"><?php 
		foreach($allCat as $cat){
					   
		   if($type == $cat->slug){
              $second_description   =  (!empty($cat->_translations[$Defaultlanguage]->second_description)) ? $cat->_translations[$Defaultlanguage]->second_description : $cat->_translations['en']->second_description;             
           }
		   
		   if($cat->categorie_type == 'countries'){
			   continue;
		   }
		   
			if($cat->slug == 'pokers'){
			   $slug =  'pokers';
			}
			if($cat->slug == 'bingos'){
			   $slug =  'bingos';
			}
			if($cat->slug == 'sport-bettings'){
			   $slug =  'sportBettings';
			}
     
        ?>
		<a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'Casinos', 'action' => $slug)); ?>">
			<div class="col">
              <div class="block"><div class="block_2"><i><img src="<?php echo GALLERY_IMG_URL.$cat->back_image; ?>" alt="icon"></i><i class="fa">
				<img src="<?php echo GALLERY_IMG_URL.$cat->image; ?>" alt="icon"></i></div></div>
             <div class="col_block"><span><?php echo (!empty($cat->_translations[$Defaultlanguage]->icon_title)) ? $cat->_translations[$Defaultlanguage]->icon_title : $cat->_translations['en']->icon_title; ?></span></div>
           </div>
        </a><?php } ?>
     </div>
     </div>
  </div>
  <div class="gamble_online_info">
	<div class="container">
        <div class="title">
           <h2>
                <?php 
                  if(isset($footer_main_title)){
					  echo $footer_main_title;
				  }else{
					  echo (!empty($headBlock->_translations[$Defaultlanguage]->footer_main_title)) ? $headBlock->_translations[$Defaultlanguage]->footer_main_title : $headBlock->_translations['en']->footer_main_title;
				  }
               ?>
        </h2>
        </div>
        <div class="gamble_online_post">
           <div class="gamble_online_item">
   			<?php if(isset($second_description)){ 
   				echo $this->App->force_balance_tags($second_description);
   			}else{
				
				  echo $this->App->force_balance_tags((!empty($headBlock->_translations[$Defaultlanguage]->second_description)) ? $headBlock->_translations[$Defaultlanguage]->second_description : $headBlock->_translations['en']->second_description);
              } ?>
            </div>
        </div>
     </div>
 </div>
  <?php if(!empty($allCountry)){ ?>
   <div class="play_safely_info">
      <div class="container">
         <div class="title">
            <h2><?php echo __('online_casinos.PLAY_SAFELY_ONLINE_LOOK_AT_OUR_TOP_CASINO_TIPS'); ?></h2>
         </div>
         <div class="play_safely_post">
		 <?php foreach($allCountry as $country){
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
  <?php } ?>
</div>
<?php 
echo $this->Html->css(['jquery-ui.min.css'],array('block' =>'css1'));
echo $this->Html->script(['jqueryslider.js'],array('block' =>'footer_script'));
$this->Html->scriptStart(array('block' => 'custom_script')); ?>
function casino_search(){	
   form_id	=	'pchec';
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