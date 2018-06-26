<h2 class="deshtitle">Contributions</h2>
<div class="reviewsTabs hmtab">
  <ul>
	 <li class="active"><a class="m-tab" data-tab="reviews" href="#reviews">Reviews (<?php echo count($reviewList); ?>)</a></li>
	 <li><a class="m-tab" data-tab="question" href="#question">Questions & Answers (<?php echo count($questionList); ?>)</a></li>
	 <li><a class="m-tab" data-tab="photos" href="#photos">Photos (<?php echo count($photoList); ?>)</a></li>
  </ul>
</div>
<ul class="filterRow">
  <li class="active" id="all-t"><a class="f-clck" data-tab="all" href="#all">All</a></li>
  <li><a class="f-clck" href="#normal" data-tab="normal">Land Based Casino</a></li>
  <li class=""><a class="f-clck" href="#online" data-tab="online">Online Casinos</a></li>
  <li class=""><a class="f-clck" href="#city" data-tab="city">City</a></li>
  <li class=""><a class="f-clck" href="#country" data-tab="country">Country</a></li>
</ul>
<div class="experience-user mtab">
  <div class="row" id="t_reviews"><?php 
	if(count($reviewList) > 0){
		echo $this->element('review_list'); 
	}else{
		?><div class="text-center">No Record Found</div><?php
	} ?></div>
  <div class="row" style="display:none" id="t_question"><?php 
	if(count($questionList) > 0){
		echo $this->element('question_list'); 
	}else{
		?><div class="text-center">No Record Found</div><?php
	} ?></div>
  <div class="row" style="display:none" id="t_photos"><?php 
	if(count($photoList) > 0){
		echo $this->element('photo_list'); 
	}else{
		?><div class="text-center">No Record Found</div><?php
	} ?></div>
</div>
<script>

		selTab	=	'reviews';
		$(document).on('click', '.m-tab', function(e) {
			$(".hmtab li").removeClass('active');
			$(".mtab > .row").hide();
			href = $(this).attr('data-tab');
			$("#t_"+href).show();
			$(this).parent('li').addClass('active');
			selTab	=	href;
			$(".filterRow > li").removeClass('active');
			
			$("#all-t").addClass('active');
			
			$("#t_"+selTab+" .col-md-4").show();

		});
		
		$(document).on('click', '.f-clck', function(e) {
			$(".filterRow > li").removeClass('active');
			tab = $(this).attr('data-tab');
			if(tab != 'all'){
				willShow	=	selTab+'_'+tab;				
				$("#t_"+selTab+" .col-md-4").hide();
				$("#t_"+selTab+" .filter_post_item").hide();
				// alert(selTab);
				$("."+willShow).show();
			}else{				
				$("#t_"+selTab+" .col-md-4").show();
				$("#t_"+selTab+" .filter_post_item").show();
			}
			$(this).parent('li').addClass('active');
		});
	
var showChar = showChar ? showChar : 150,
    ellipsestext = "...",
    lesstext = "Read less",
    moretext = "Read more";
/*$(".readmoretext").each(function() {
    var s = $(this).html();
    
    if (s.length > showChar) {
        var e = s.substr(0, showChar),
            t = s.substr(showChar, s.length - showChar),
            a = e +'<span class="moreellipses">' + ellipsestext +'&nbsp;</span><span class="morecontent"><span>' + t +'</span>&nbsp;&nbsp;<a href="" class="readmorelink">' + moretext + "</a></span>";
        $(this).html(a)
    }
});*/
$(".readmore_redirect").each(function() {
    var s = $(this).html();
    rdlink = $(this).attr("rdlink");
    if (s.length > showChar) {
        var e = s.substr(0, showChar),
            t = s.substr(showChar, s.length - showChar),
            a = e +'<span class="moreellipses">' + ellipsestext +'&nbsp;</span><span class="morecontent"><span>' + t +'</span>&nbsp;&nbsp;<a href="'+rdlink+'">' + moretext + "</a></span>";
        $(this).html(a)
    }
});


</script>