<?php use Cake\Core\Configure; ?>
<div class="mid_wrapper">
   <div class="banner_inner banner_back_top  img_block9"> 
  <div class="NewReviewsBan topUser bacnner_img_03">
      <div class="container">
         <div class="Reviewsbanner">
            <h1>Top Users</h1>
			 <div class="block"><?php if(empty($this->request->session()->read('Auth.User'))){ ?><a data-rel="signup_div" data-title="Create Account" class="btn red_btn login-pop" href="javascript:void(0)">Signup</a><?php } ?></div>
         </div>
      </div>
   </div>
   </div>
   <div class="topUserSearch">
      <div class="container">
         <select>
            <option>Select a option</option>
         </select>
      </div>
   </div>
   <div class="TopUserSction">
      <div class="container">
         <div class="title">
            <h2>Congrats To <?php echo Configure::read('Site.title'); ?>’s Global Top Reviewers</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <span></span> 
         </div>
         <div class="TopThreeUser">
            <div class="col">
               <div class="UserTop">
                  <div class="pull-left"><a class="img_round1" href="<?php echo $this->Url->build(array('controller' => 'users','action' => 'user_slug' ,'user_slug' => $allUserArray[1]['slug'])); ?>"><?php 
						if(!empty($allUserArray[1]['profile_image']) && file_exists(PROFILE_ROOT_PATH.$allUserArray[1]['profile_image'])){ ?>
							<img alt="img" src="<?php echo WEBSITE_URL.'image.php?width=98px&height=98px&cropratio=1:1&image='.PROFILE_IMG_URL.$allUserArray[1]['profile_image']; ?>" class="img-responsive" />
						<?php }elseif(!empty($allUserArray[1]['facebook_id'])){ ?>
							<img class="img-responsive" src="<?php echo 'http://graph.facebook.com/'.$allUserArray[1]['facebook_id'].'/picture?type=large' ?>" alt="img" />
					<?php }else{ ?>
						<img alt="img" src="<?php echo WEBSITE_URL.'image.php?width=98px&height=98px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$allUserArray[1]['sex'].'.png' ?>"/>
					<?php } ?></a></div>
                  <div class="UserDetail">
                     <a href="<?php echo $this->Url->build(array('controller' => 'users','action' => 'user_slug' ,'user_slug' => $allUserArray[1]['slug'])); ?>"><?php echo $allUserArray[1]['full_name']; ?></a>
                     <span><?php echo $allUserArray[1]['city']; ?></span>
                  </div>
               </div>
               <div class="PointRank">
                  <div class="rankPoint">
                     <span>2</span>
                  </div>
                  <span><?php echo $allUserArray[1]['user_points']; ?> Points</span>
               </div>
            </div>
            <div class="col">
               <div class="UserTop">
                  <div class="pull-left"><a class="img_round1" href="<?php echo $this->Url->build(array('controller' => 'users','action' => 'user_slug' ,'user_slug' => $allUserArray[0]['slug'])); ?>"><?php 
						if(!empty($allUserArray[0]['profile_image']) && file_exists(PROFILE_ROOT_PATH.$allUserArray[0]['profile_image'])){ ?>
							<img  alt="img" src="<?php echo WEBSITE_URL.'image.php?width=98px&height=98px&cropratio=1:1&image='.PROFILE_IMG_URL.$allUserArray[0]['profile_image']; ?>" class="img-responsive" />
						<?php }elseif(!empty($allUserArray[0]['facebook_id'])){ ?>
							<img alt="img" class="img-responsive" src="<?php echo 'http://graph.facebook.com/'.$allUserArray[0]['facebook_id'].'/picture?type=large' ?>"/>
					<?php }else{ ?>
						<img alt="img" src="<?php echo WEBSITE_URL.'image.php?width=98px&height=98px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$allUserArray[0]['sex'].'.png' ?>"/>
					<?php } ?></a></div>
                  <div class="UserDetail">
                     <a href="<?php echo $this->Url->build(array('controller' => 'users','action' => 'user_slug' ,'user_slug' => $allUserArray[0]['slug'])); ?>"><?php echo $allUserArray[0]['full_name']; ?></a>
                     <span><?php echo $allUserArray[0]['city']; ?></span>
                  </div>
               </div>
               <div class="PointRank">
                  <div class="rankPoint">
                     <span>1</span>
                  </div>
                  <span><?php echo $allUserArray[0]['user_points']; ?> Points</span>
               </div>
            </div>
            <div class="col">
               <div class="UserTop">
                  <div class="pull-left"><a class="img_round1" href="<?php echo $this->Url->build(array('controller' => 'users','action' => 'user_slug' ,'user_slug' => $allUserArray[2]['slug'])); ?>"><?php 
						if(!empty($allUserArray[2]['profile_image']) && file_exists(PROFILE_ROOT_PATH.$allUserArray[2]['profile_image'])){ ?>
							<img  alt="img" src="<?php echo WEBSITE_URL.'image.php?width=98px&height=98px&cropratio=1:1&image='.PROFILE_IMG_URL.$allUserArray[2]['profile_image']; ?>" class="img-responsive" />
						<?php }elseif(!empty($allUserArray[2]['facebook_id'])){ ?>
							<img alt="img" class="img-responsive" src="<?php echo 'http://graph.facebook.com/'.$allUserArray[2]['facebook_id'].'/picture?type=large' ?>"/>
					<?php }else{ ?>
						<img alt="img" src="<?php echo WEBSITE_URL.'image.php?width=98px&height=98px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$allUserArray[2]['sex'].'.png' ?>"/>
					<?php } ?></a></div>
                  <div class="UserDetail">
                     <a href="<?php echo $this->Url->build(array('controller' => 'users','action' => 'user_slug' ,'user_slug' => $allUserArray[2]['slug'])); ?>"><?php echo $allUserArray[2]['full_name']; ?></a>
                     <span><?php echo $allUserArray[2]['city']; ?></span>
                  </div>
               </div>
               <div class="PointRank">
                  <div class="rankPoint">
                     <span>3</span>
                  </div>
                  <span><?php echo $allUserArray[2]['user_points']; ?> Points</span>
               </div>
            </div>
         </div>
         <div class="OtherRanks">
            <h2>Write A Review To Start Climbing The Top Users.</h2>
            <ul>
				<?php foreach($allUser as $key =>  $users){ if($key<3) continue;  ?>
               <li>
                  <div class="pull-left">
                     <div class="UsRank"><?php echo $key+1; ?></div>
                     <div class="Ususer"><a href="<?php echo $this->Url->build(array('controller' => 'users','action' => 'user_slug' ,'user_slug' => $users->slug)); ?>"><?php 
						if(!empty($users->profile_image) && file_exists(PROFILE_ROOT_PATH.$users->profile_image)){ ?>
							<img  alt="img" src="<?php echo WEBSITE_URL.'image.php?width=98px&height=98px&cropratio=1:1&image='.PROFILE_IMG_URL.$users->profile_image; ?>" class="img-responsive" />
						<?php }elseif(!empty($users->facebook_id)){ ?>
							<img alt="img" class="img-responsive" src="<?php echo 'http://graph.facebook.com/'.$users->facebook_id.'/picture?type=large' ?>"/>
					<?php }else{ ?>
						<img alt="img" src="<?php echo WEBSITE_URL.'image.php?width=98px&height=98px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$users->sex.'.png' ?>"/>
					<?php } ?></a></div>
                  </div>
                  <div class="portDetail">
                     <a href="<?php echo $this->Url->build(array('controller' => 'users','action' => 'user_slug' ,'user_slug' => $users->slug)); ?>"><?php echo $users->full_name; ?></a>
                     <span><?php echo $users->city; ?></span>
                     <div class="block"><span><?php echo $users->user_points; ?> Points</span></div>
                  </div>
               </li>
				<?php } ?>
            </ul>
         </div>
         <?php /*<div class="block moreBtn"> <a href="" class="btn trans_btn">View more</a> </div>*/?>
      </div>
   </div>
</div>