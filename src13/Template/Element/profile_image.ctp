<?php
if(!empty($this->request->session()->read('Auth.User.profile_image')) && file_exists(PROFILE_ROOT_PATH.$this->request->session()->read('Auth.User.profile_image'))){
	$url	=	PROFILE_IMG_URL.$this->request->session()->read('Auth.User.profile_image');					
}else if(!empty($this->request->session()->read('Auth.User.facebook_id'))){
	$url	=	 'http://graph.facebook.com/'.$this->request->session()->read('Auth.User.facebook_id').'/picture?type=large'; 
}else{  
	// $url	=	NO_PROFILE_IMAGE;
	$url	=	WEBSITE_URL.'image.php?width=150px&height=150px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$this->request->session()->read('Auth.User.sex').'.png';
}  ?>
<img src="<?php echo $url ?>" alt="img"  class="img-responsive" />