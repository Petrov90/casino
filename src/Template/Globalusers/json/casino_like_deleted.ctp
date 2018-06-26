<?php if($type == 'like'){ ?>
<li id="likes_<?php echo $casino->id; ?>">
	 <div class="pull-left">
	 <a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]); ?>" target="_blank" class="colCasinoHeading">
	 <?php if(!empty($casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image)){ ?>
		<img src="<?php echo WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.CASINO_FULL_IMG_URL.$casino->image; ?>" class="img-responsive" />
	 <?php }else{ ?>
		 <img src="<?php echo WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.NO_CASINO_IMG; ?>" class="img-responsive" />
<?php } ?></a>
	</div>
	 <div class="locatnDet">
		<a class="colCasinoHeading"  href="<?php echo $this->Url->build(['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]); ?>"><?php echo $casino->title; ?></a>
		 <div class="editBtns">
			<a href="javascript:void(0);" ng-click="LikeThis(<?php echo $casino->id; ?>);" class="btn red_btn">Been here</a>
		  </div>
	 </div>
</li>
<?php }else{ ?>
<li id="li_<?php echo $casino->id; ?>">
	 <div class="pull-left">	<a href="<?php echo $this->Url->build(['plugin'=>'','controller' => 'casinos','action' => 'casino_view','casino_view' => $casino->slug]); ?>" target="_blank" class="colCasinoHeading">
	 <?php if(!empty($casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image)){ ?>
	<img src="<?php echo WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.CASINO_FULL_IMG_URL.$casino->image; ?>" class="img-responsive" />
	 <?php }else{ ?>
		 <img src="<?php echo WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.NO_CASINO_IMG; ?>" class="img-responsive" />
<?php } ?></a>
	</div>
	 <div class="locatnDet">
		<a class="colCasinoHeading" href="<?php echo $this->Url->build(['plugin'=>'','controller' => 'casinos','action' => 'casino_view','casino_view' => $casino->slug]); ?>"><?php echo $casino->title; ?></a>
		 <div class="editBtns">
			<a href="javascript:void(0);" ng-click="beenHere(<?php echo $casino->id; ?>);" class="btn red_btn">Been here</a>
		  </div>
	 </div>
</li>
<?php } ?>