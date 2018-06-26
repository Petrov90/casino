<?php use Cake\Core\Configure;
	  use Cake\I18n\Time; ?>
<div class="member_detail" id="answer_div_<?php echo $comments->id; ?>">
    <div class="mamber_col">
	  <div class="mem_img">
		<a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'users','action' => 'user_slug','user_slug' => $comments->user->slug]); ?>">
			<?php  if(!empty($comments->user->profile_image) && file_exists(PROFILE_ROOT_PATH.$comments->user->profile_image)){ ?>
				<img src="<?php echo WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.PROFILE_IMG_URL.$comments->user->profile_image ?>" class="img-responsive" alt="img" />
			<?php }elseif(!empty($comments->user->facebook_id)){ ?>
				<img alt="img" class="img-responsive" src="<?php echo 'http://graph.facebook.com/'.$comments->user->facebook_id.'/picture' ?>" alt="img" />
		<?php }else{ ?>
				<img src="<?php echo WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$comments->user->sex.'.png'; ?>" alt="img" class="img-responsive man"/>
		<?php } ?></a>
			</div>
	 <h2><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'users','action' => 'user_slug','user_slug' => $comments->user->slug]); ?>"><?php echo $comments->user->full_name; ?></a></h2>
	 	<span><?php echo $comments->user->city; ?></span>
	</div>
	<div class="memberRiver addQuiton">
		<div class="revi_memb" id="answerppp<?php echo $comments->id; ?>">
			<p><span><?php
				$now = new Time($comments->created);
				echo $now->timeAgoInWords(
				['format' => 'MMM d, YYY', 'end' => '+1 year']);			 
			/*echo Date(Configure::read('Date.'.$Defaultlanguage),strtotime($comments->created));*/ ?></span></p>
			<p id="answertext<?php echo $comments->id; ?>"><?php echo nl2br($comments->comment); ?></p>
		</div>
		<div class="revi_memb" style="display:none" id="answerhhh<?php echo $comments->id; ?>">
			<p><textarea class="form-control" id="answer<?php echo $comments->id; ?>"><?php echo ($comments->comment); ?></textarea></p>
			<div class="reviewBtn">
				<button type="submit" class="r-btn1" data-id="<?php echo $comments->id; ?>" data-type="answer">Save</button>&nbsp;
				<button type="button" onclick="$('#answerhhh<?php echo $comments->id; ?>').hide('slow'),$('#answerppp<?php echo $comments->id; ?>').show('slow');" class="w-btn1">Cancel</button>
			</div>
		</div>
		<div class="cment_sect">                   
			<span>- Was this  answer helpful ?</span>
			<div class="play_yes">
				<span class="checkinfo2">
					<input <?php echo (isset($comments->question_comment_likes[0]->user_id) && $comments->question_comment_likes[0]->user_id == $this->request->session()->read('Auth.User.id') && $comments->question_comment_likes[0]->value == 'yes') ? 'checked="checked"' : ''; ?> data-question-id="<?php echo $questionId; ?>" data-id="<?php echo $comments->id; ?>" data-type="answer" type="radio" name="qyes<?php echo $questionId; ?><?php echo $comments->id; ?>" id="qyes<?php echo $comments->id; ?><?php echo $comments->id; ?>" value="yes"/>
					
					<label id="myes<?php echo $comments->id; ?>answer" for="qyes<?php echo $comments->id; ?><?php echo $comments->id; ?>">Yes<?php echo (!empty($comments->like_count)) ? '('.$comments->like_count.')' : ''; ?></label>
				</span>
				<span class="checkinfo2">
					<input <?php echo (isset($comments->question_comment_likes[0]->user_id) && $comments->question_comment_likes[0]->user_id == $this->request->session()->read('Auth.User.id') && $comments->question_comment_likes[0]->value == 'no') ? 'checked="checked"' : ''; ?>  data-question-id="<?php echo $questionId; ?>" data-id="<?php echo $comments->id; ?>" data-type="answer" type="radio" name="qyes<?php echo $questionId; ?><?php echo $comments->id; ?>" id="qno<?php echo $comments->id; ?><?php echo $comments->id; ?>" value="no"/>
					
					<label id="mno<?php echo $comments->id; ?>answer" for="qno<?php echo $comments->id; ?><?php echo $comments->id; ?>">No<?php echo (!empty($comments->dislike_count)) ? '('.$comments->dislike_count.')' : ''; ?></label>
				</span>          
			</div>
			<div class="pull-right">
				<div class="qrashe">					
				<a href="javascript:void(0);" title="Click For Report As Spam" class="showEditBtn qras" data-type="answer" data-id="<?php echo $comments->id; ?>"><img src="<?php echo WEBSITE_IMG_URL; ?>ic17.png" class="img-responsive" alt="img"></a>
					<?php if($this->request->session()->read('Auth.User.id') == $comments->user_id){ ?>
						<div class="qrasedit">
							<a href="javascript:void(0);" data-id="<?php echo $comments->id; ?>" class="showEditBtn edit-q-c" data-type="answer">Edit</a>
							<a href="javascript:void(0);" data-pid="count_answer_<?php echo $questionId; ?>" data-id="<?php echo $comments->id; ?>" data-div="answer_div_" class="showEditBtn dlt-q" data-type="answer">Delete</a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>