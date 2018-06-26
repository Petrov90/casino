<?php use Cake\Core\Configure;
 use Cake\I18n\Time; ?>
<div class="member_review">
	<div class="member_bord">
	  <div class="member">
		<h2  class="mainheading">Member Review(<span id="count_review"><?php echo $count; ?></span>)</h2>
	  </div>
	  <div class="sort_search"><span>Sort By :</span>
		<?php echo $this->cell('Inbox::display',[$sort_by]); ?>		
	  </div>
	</div>
	<div class="member_info">
		<?php 
		$k	=	1;
		foreach($reviewList as $reviews){ 
			$k = 0; ?>
			<div class="member_detail" id="comment_div_<?php echo $reviews->id; ?>">
				<div class="mamber_col">
					<div class="mem_img"><?php 
						if(!empty($reviews->user->profile_image) && file_exists(PROFILE_ROOT_PATH.$reviews->user->profile_image)){ ?>
							<img src="<?php echo WEBSITE_URL.'image.php?width=150px&height=150px&cropratio=1:1&image='.PROFILE_IMG_URL.$reviews->user->profile_image ?>" class="img-responsive" alt="img" />
						<?php }elseif(!empty($reviews->user->facebook_id)){ ?>
							<img alt="img" class="img-responsive" src="<?php echo 'http://graph.facebook.com/'.$reviews->user->facebook_id.'/picture?type=large' ?>" alt="img" />
					<?php }else{ ?>
						<img src="<?php echo WEBSITE_URL.'image.php?width=150px&height=150px&cropratio=1:1&image='.NO_PROFILE_IMAGE; ?>" alt="img" class="img-responsive man"/>
					<?php } ?>	
					</div>
				  <h2><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'users','action' => 'user_slug','user_slug' => $reviews->user->slug]); ?>"><?php echo $reviews->user->full_name; ?></a></h2>
				  <span><?php echo $reviews->user->city; ?></span>
				</div>
				<div class="memberRiver">
				  <div class="revi_memb">
					<div class="readonly" data-score="<?php echo $reviews->rating; ?>"></div>
						<span class="h2"><?php
							$now = new Time($reviews->created);
							echo $now->timeAgoInWords(
							['format' => 'MMM d, YYY', 'end' => '+1 year']);
						/*echo $reviews->created->format(Configure::read('Date.'.$Defaultlanguage));*/ ?></span>
						<p class="readmoretext"><?php echo nl2br($reviews->comment); ?></p>
				  </div>
					<div class="cment_sect">
						<img src="<?php echo WEBSITE_IMG_URL ?>cment.png" class="img-responsive" alt="img" />
						<a href="javascript:void(0);" data-id="show_comment_<?php echo $reviews->id; ?>" class="show_comment">Comment</a><span>-  Was this  review helpful ?</span>
						<div class="play_yes">
						<?php if(!empty($reviews->review_likes)){ ?>
							<a href="javascript:void(0);" class="click-like btn_play" data-rel="no" data-id="<?php echo $reviews->id; ?>" data-type="<?php echo $type; ?>">Yes</a>
						<?php }else{ ?>
							<a href="javascript:void(0);" class="click-like play_no" data-rel="yes" data-id="<?php echo $reviews->id; ?>" data-type="<?php echo $type; ?>">Yes</a>
						<?php } ?>
						<span id="like_counter_<?php echo $reviews->id ?>"> <?php echo !empty($reviews->like_count) ? '( '.$reviews->like_count.' )' : ''; ?></span>
						</div>
						<?php if($reviews->user_id == $this->request->session()->read('Auth.User.id')){ ?>
						<div class="block editComment">
							<div class="comEditbtn">
								<a href="javascript:void(0);" data-name="<?php echo $name; ?>" data-rating="<?php echo $reviews->rating; ?>" data-type="<?php echo $type; ?>" data-content="<?php echo $reviews->comment; ?>" class="edit_comment" data-id="<?php echo $reviews->foreign_key; ?>">Edit</a>
								<a href="javascript:void(0);" class="delete_comment" data-id="<?php echo $reviews->id; ?>">Delete</a>
							</div>
						</div>
						<?php } ?>
						<div class="comment_boxN <?php echo (empty($reviews->review_comments)) ? 'hide' : ''; ?>" id="show_comment_<?php echo $reviews->id; ?>">
							<div class="CommentRow" id="comment_box_<?php echo $reviews->id; ?>">
								<?php 
								if (!empty($reviews->review_comments)){
									foreach($reviews->review_comments as $comments){ ?>
										<div class="commentPostN" id="review_comment_id<?php echo $comments->id; ?>">
											<div class="pull-left">											
											<?php  if(!empty($comments->user->profile_image) && file_exists(PROFILE_ROOT_PATH.$comments->user->profile_image)){ ?>
													<img src="<?php echo WEBSITE_URL.'image.php?width=66px&height=66px&cropratio=1:1&image='.PROFILE_IMG_URL.$comments->user->profile_image ?>" class="img-responsive" alt="img" />
												<?php }elseif(!empty($comments->user->facebook_id)){ ?>
													<img alt="img" class="img-responsive" src="<?php echo 'http://graph.facebook.com/'.$comments->user->facebook_id.'/picture' ?>" alt="img" />
											<?php }else{ ?>
												<img src="<?php echo WEBSITE_URL.'image.php?width=66px&height=66px&cropratio=1:1&image='.NO_PROFILE_IMAGE; ?>" alt="img" class="img-responsive man"/>
											<?php } ?>
											</div>
											<div class="commented">
												<div>
													<a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'users','action' => 'user_slug','user_slug' => $comments->user->slug]); ?>"><?php echo $comments->user->full_name; ?></a>
													<p class="readmoretext"><?php echo nl2br($comments->comment); ?></p>
												</div>
											   <span><?php 
												$now = new Time($comments->created);
												echo $now->timeAgoInWords(
												['format' => 'MMM d, YYY', 'end' => '+1 year']);
											   /*echo $comments->created->format(Configure::read('Date.'.$Defaultlanguage));*/ ?></span>
											</div>
											<?php if($comments->user_id == $this->request->session()->read('Auth.User.id')){ ?>
											<div class="comntEdit"><?php /*
												<a data-id="<?php echo $comments->id; ?>" href="javascript:void(0);" class="fa fa-edit edit_review_comment"></a>*/?><a data-id="<?php echo $comments->id; ?>" href="javascript:void(0);" class="fa fa-close delete_review_comment"></a>
											</div>
											<?php } ?>
										</div>
								<?php } 
								} ?>
							</div>
							<div class="commentHere">
								<div class="pull-left">								
								<?php  if(!empty($this->request->session()->read('Auth.User.profile_image')) && file_exists(PROFILE_ROOT_PATH.$this->request->session()->read('Auth.User.profile_image'))){ ?>
										<img src="<?php echo WEBSITE_URL.'image.php?width=66px&height=66px&cropratio=1:1&image='.PROFILE_IMG_URL.$this->request->session()->read('Auth.User.profile_image') ?>" class="img-responsive" alt="img" />
									<?php }elseif(!empty($this->request->session()->read('Auth.User.facebook_id'))){ ?>
										<img alt="img" class="img-responsive" src="<?php echo 'http://graph.facebook.com/'.$this->request->session()->read('Auth.User.facebook_id').'/picture' ?>" alt="img" />
								<?php }else{ ?>
									<img src="<?php echo WEBSITE_URL.'image.php?width=66px&height=66px&cropratio=1:1&image='.NO_PROFILE_IMAGE; ?>" alt="img" class="img-responsive man"/>
								<?php } ?>
								</div>
								<div class="commentaria"><textarea id="show_comment_<?php echo $reviews->id; ?>_textarea" data-id="<?php echo $reviews->id; ?>" placeholder="Enter a comment" class="add_new_comment"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } if($k){	?>
			<div class="member_detail text-center">
				 <h4>No review has been added yet</h4>
			</div>
			<?php 
		} ?>	  
	</div>
</div>
<script type="text/javascript">
	 $(document).on('click', '.edit_review_comment', function(){
		id	=	$(this).attr('data-id');
	 });
	 
	 $(document).on('click', '.delete_review_comment', function(){
		if(confirm('Are you sure to delete this comment')){
			id		=	$(this).attr('data-id');
			$this	=	$(this);
		
			$("#review_comment_id"+id).hide('slow', function(){ $("#review_comment_id"+id).remove(); });		
			$.ajax({
				url  	 : '<?php echo $this->Url->build('/users/delete_review_comment'); ?>',
				data 	 : {id : id},
				type	 : 'POST',
				success  : function(r){					
					notice('Success','<?php echo __('Comment deleted successfully',true); ?>','success');
				}
			}); 
		}
	 });
	 $(document).on('click', '.show_comment', function(){
		<?php if(empty($this->request->session()->read('Auth.User'))){ ?>
			$(".login-pop").trigger('click');
		<?php }else{ ?>
			id = $(this).attr('data-id');
			$("#"+id).removeClass('hide');
			$('html, body').animate({
				scrollTop: $('#'+id+'_textarea').offset().top-100
			}, 2000);
		<?php } ?>
	});
	function getCaret(el) { 
		if (el.selectionStart) { 
			return el.selectionStart; 
		} else if (document.selection) { 
			el.focus();
			var r = document.selection.createRange(); 
			if (r == null) { 
				return 0;
			}
			var re = el.createTextRange(), rc = re.duplicate();
			re.moveToBookmark(r.getBookmark());
			rc.setEndPoint('EndToStart', re);
			return rc.text.length;
		}  
		return 0; 
	}
	$(document).on('keyup', '.add_new_comment', function(event){
		<?php if(empty($this->request->session()->read('Auth.User'))){ ?>
			$(".login-pop").trigger('click');
		<?php }else{ ?>
			if ( event.which == 13 ) {
				val 	=	$(this).val();
				if(val == '' || val == ' ' || val == false){
					$(this).addClass('border-red');
					return false;
				}
				
				var content  = this.value;  
				var caret	 = getCaret(this);          
				if(event.shiftKey){
					this.value = content.substring(0, caret - 1) + "\n" + content.substring(caret, content.length);
					event.stopPropagation();
					return false;
				}
				
				id		=	$(this).attr('data-id');
				$this	=	$(this);
				$.ajax({
					url  	 : '<?php echo $this->Url->build('/users/add_review_comment'); ?>',
					data 	 : {id : id,comment : val},
					dataType : 'json',
					type	 : 'POST',
					success  : function(r){
						var myDiv = document.getElementById("comment_box_"+id);
						myDiv.scrollTop = 0;
						data			=	r.data;
						commentId		=	r.data.id;
						$("#comment_box_"+id).prepend('<div class="commentPostN" style="display:none" id="review_comment_id'+commentId+'">'+data+'</div>');
						
						$("#review_comment_id"+commentId).show('slow');
						
						$this.val('');
						notice('Message','<?php echo __('Comment posted successfully',true); ?>','success');
					}
				});
				
			}
		<?php } ?>
	});
	
	$('.readonly').raty({
		readOnly : true,
		score: function() {
			return $(this).attr('data-score');
		}
	});
	
	btnclick	=	true;
	$(document).on('click', '.delete_comment', function(){
		if(confirm('Are you sure to delete this review')){
			id 		=	$(this).attr('data-id');
			$.ajax({
				url  	 : '<?php echo $this->Url->build('/users/review_delete'); ?>',
				data 	 : {id : id},
				dataType : 'json',
				type	 : 'POST',
				success  : function(r){
					count	=	r.count;
					$("#count_review").html(count);
					$("#comment_div_"+id).remove();
				}
			});
		}
	});
	$(document).on('click', '.click-like', function(){
		<?php if(!empty($this->request->session()->read('Auth.User'))){ ?>
			id		=	$(this).attr('data-id');
			rel		=	$(this).attr('data-rel');
			type	=	$(this).attr('data-type');
			btn 	=	$(this);
			btn.button('loading');
			if(btnclick){
				btnclick = false;
				$.ajax({
					url  	 : '<?php echo $this->Url->build('/users/like'); ?>',
					data 	 : {'type' : type, id : id,rel : rel},
					dataType : 'json',
					type	 : 'POST',
					success  : function(r){
						$("#like_counter_"+id).html(' ('+r.count+') ');
						btnclick = true;
						btn.button('reset');
						if(rel == 'yes'){
							btn.attr('data-rel','no');
							btn.removeClass('play_no');
							btn.addClass('btn_play');
						}else{
							btn.attr('data-rel','yes');
							btn.removeClass('btn_play');
							btn.addClass('play_no');
						}
					}
				});
			}
		<?php }else{ ?>
			$(".login-pop").trigger('click');
		<?php } ?>
	});
</script>