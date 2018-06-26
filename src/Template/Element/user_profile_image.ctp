<?php if(!empty($userDetails->facebook_id)){ ?>
	<img src="<?php echo 'http://graph.facebook.com/'.$userDetails->facebook_id.'/picture?type=large' ?>" alt="img"  class="img-responsive" />
<?php }else{ ?>
	<img src="<?php echo NO_PROFILE_IMAGE ?>" alt="img"  class="img-responsive" />
<?php } ?>