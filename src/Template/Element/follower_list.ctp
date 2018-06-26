<?php foreach($UserFollowers as $result){ //pr($result); ?>
<div class="popup_follow">
 <div class="follow_info">
	<div class="img_follow2">
	   <span><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'user_slug','user_slug' => $result->follower->slug)); ?>"><img src="<?php 
if(!empty($result->follower->profile_image) && file_exists(PROFILE_ROOT_PATH.$result->follower->profile_image)){
	$url	=	WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.PROFILE_IMG_URL.$result->follower->profile_image;					
}else if(!empty($result->follower->facebook_id)){
	$url	=	 'http://graph.facebook.com/'.$result->follower->facebook_id.'/picture?type=large'; 
}else{  
	$sex	=	$result->follower->sex;
	$url	=	WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$sex.'.png';
} echo $url; ?>" alt="img" class="img-responsive"></a></span>
	   <p><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'user_slug','user_slug' => $result->follower->slug)); ?>"><?php echo $result->follower->full_name; ?></a></p>
	</div>
	<div class="followBtn"><?php if($this->request->session()->read('Auth.User.id') != $result->follower->id){ ?>	
		<a href="javascript:void(0);" data-id="<?php echo $result->follower->id; ?>" data-rel="<?php echo (!empty($result['follower']['user_follower'])) ? 'no' : 'yes'; ?>" class="btn red_btn follow"><i class="fa fa-plus <?php echo (!empty($result['follower']['user_follower'])) ? 'hide' : ''; ?>" id="f_icon"></i> <span id="f_text"><?php echo ($result['follower']['user_follower']) ? 'Following' : 'Follow'; ?></span></a>
	<?php } ?>
	</div>
 </div>
</div>	
	<?php
} ?>