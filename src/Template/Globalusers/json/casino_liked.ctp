<li id="my_lis_<?php echo $id ?>">
   <div class="pull-left"><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $result->slug]); ?>" target="_blank" class="colCasinoHeading">
   <?php if(!empty($result->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$result->image)){ ?>
			<?php echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=70px&height=70px&cropratio=1:1&image='.CASINO_FULL_IMG_URL.$result->image,['class' => 'img-responsive']); ?>
		<?php 
		}else{ ?>				
			<img src="<?php echo WEBSITE_URL.'image.php?width=70px&height=70px&cropratio=1:1&image='.NO_CASINO_IMG; ?>" class="img-responsive" />
		<?php } ?></a></div>
   <div class="locatnDet">
      <div class="col">
        <a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $result->slug]); ?>" target="_blank" class="colCasinoHeading"><?php echo $result->title; ?></a>
      </div>
      <div class="pull-right">
		<a  rel="nofollow" data-title="<?php echo $result->title ?>" data-url="<?php echo $result->slug ?>"  <?php echo NEWTAB ?>  href="<?php 
								$url	=	$result->main_promotion->slug;
								echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $url))  ?>" class="btn red_btn">Play</a>
		<span class="imgColseIcon">						
         <a href="javascript:void(0);" ng-click="remove('<?php echo $id ?>','CasinoLikes','my_lis_<?php echo $id ?>')"  class="remove colseIcone colseIcone2">X</a>
		  <a  href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $result->slug]); ?>" target="_blank" class="eyeIcon"><img src="../images/eye_icon.png" alt="img" /></a></span>
      </div>
   </div>
</li>



