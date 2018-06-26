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
.online_casino_search_filter {
    background: #012331 none repeat scroll 0 0;
    float: left;
    margin-bottom: -56px;
    width: 100%;
}
</style>
<div class="online_casino_search_filter">
  <div class="banner_info banner_textblock">
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
<?php $this->Html->scriptEnd(); ?>
