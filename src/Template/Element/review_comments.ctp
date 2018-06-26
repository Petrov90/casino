<?php use Cake\Core\Configure;
	use Cake\I18n\Time; ?>
<div class="commentPostN" id="review_comment_id<?php echo $comments->id; ?>">
	<div class="pull-left">											
	<?php  if(!empty($comments->user->profile_image) && file_exists(PROFILE_ROOT_PATH.$comments->user->profile_image)){ ?>
			<img src="<?php echo WEBSITE_URL.'image.php?width=66px&height=66px&cropratio=1:1&image='.PROFILE_IMG_URL.$comments->user->profile_image ?>" class="img-responsive" alt="img" />
		<?php }elseif(!empty($comments->user->facebook_id)){ ?>
			<img alt="img" class="img-responsive" src="<?php echo 'http://graph.facebook.com/'.$comments->user->facebook_id.'/picture' ?>" alt="img" />
	<?php }else{ ?>
		<img src="<?php echo WEBSITE_URL.'image.php?width=66px&height=66px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$comments->user->sex.'.png'; ?>" alt="img" class="img-responsive man"/>
	<?php } ?>
	</div>
	<div class="commented">
		<div>
			<a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'users','action' => 'user_slug','user_slug' => $comments->user->slug]); ?>"><?php echo $comments->user->full_name; ?></a>
			<p class="readmoretext"><?php echo nl2br($comments->comment); ?></p>
		</div>
	   <span><?php
				$now = new Time($comments->created);
				$utb_tm =  $now->timeAgoInWords(
				['format' => 'MMM d, YYY', 'end' => '+1 year']);
				$utb_tm = current(explode(',', $utb_tm));
				$ago_tm = substr($utb_tm, -3);
				if($ago_tm != 'ago'){
					$utb_tm = $utb_tm.' ago';
				}
				echo $utb_tm;				
	    /*echo $comments->created->format(Configure::read('Date.'.$Defaultlanguage));*/ ?></span>
	</div>
	
	<div class="comntEdit">
		<?php if($comments->user_id != $this->request->session()->read('Auth.User.id')){ ?>
			<a title="Mark As Report Spam" data-type="comment" data-id="<?php echo $comments->id; ?>" href="javascript:void(0);" class="report_as_spam"><img src="<?php echo WEBSITE_IMG_URL; ?>ic17.png" class="img-responsive" alt="img"></a>
		
		<?php } if($comments->user_id == $this->request->session()->read('Auth.User.id')){ ?>
		<a data-id="<?php echo $comments->id; ?>" data-pid="<?php echo $reviewId; ?>" href="javascript:void(0);" class="fa fa-close delete_review_comment"></a>
	<?php } ?>
	</div>
</div>