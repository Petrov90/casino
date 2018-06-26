<?php 
if(!$result->isEmpty()){
foreach($result as $casino){ //pr($casino); ?>
<div class="clint_info_post">
<div class="clint_post">
<div class="clint_item"><a href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]); ?>"><?php 
if(!empty($casino->main_promotion->logo) && file_exists(PROMOTION_CASINO_LOGO_ROOT_PATH.$casino->main_promotion->logo)){
echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=242px&height=129px&cropratio=2:1&image='.PROMOTION_CASINO_LOGO_IMG_URL.$casino->main_promotion->logo,['alt' => 'Image','height'=>129, 'width'=>242]);
}else{ 
if(!empty($casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image)){
echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=242px&height=129px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$casino->image,['alt' => 'Image','height'=>129, 'width'=>242]);
}
} ?></a></div>
<div class="clint_post_right">
<div class="block casino_block">
<a href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]); ?>"><span><?php echo $casino->title; ?></span></a>
</div>
<div class="clientRating readonly" data-score="<?php echo $casino->avg_rating; ?>"></div>
<div class="casino_b2"><span> <?php 
if(isset($casino->main_promotion->title)){
$text	=	$casino->main_promotion->title; 
if(isset($text[0])){ ?><img src="<?php echo WEBSITE_IMG_URL; ?>check.png" alt="img" /><?php echo $text; ?><?php }
}	?></span></div>

</div>
<div class="sbumit_block3">
<div class="more_info_btn ">
<a rel="nofollow" data-title="<?php echo $casino->title ?>" data-url="<?php echo $casino->slug ?>" class="paly_now" <?php echo NEWTAB ?> href="<?php $slug	=	$casino->main_promotion->slug; echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $slug)); ?>">Play Now</a>
<a class="more_btn" href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]); ?>">More info</a>
</div>
</div>
</div>

</div>
<?php }
if(isset($isAjax)){ ?><div id="pagination"> <?php }
echo $this->element('pagination');
if(isset($isAjax)){ ?> </div> <?php }
}else{ ?>
<div class="text-center">No record found</div>
<?php } ?>