<?php use Cake\Core\Configure;
	use Cake\I18n\Time;
 $showReviewButton	= 	true; ?>
<div id="rw_div" name="rw_div" class="member_review" ng-app="comment" ng-controller="commentController">
	<div class="member_bord">
	  <div class="member">
		<h2 class="mainheading"><?php echo ($count == 0) ? 'Users Reviews' : 'Members Reviews'; ?> (<span id="count_review"><?php echo $count; ?></span>)</h2>
	  </div>
	  <div class="sort_search"><span>Sort By :</span>
		<?php echo $this->cell('Inbox::display',[$sort_by]); ?>		
	  </div>
	</div>
	<div class="AddReviewBtn hide add-rvw-btn">
		<div class="pull-right">
			<a href="javascript:void(0);" data-name="<?php echo $name; ?>" data-type="<?php echo $type; ?>" data-id="<?php echo $foreign_key; ?>" class="btn red_btn city-click">Add Review</a>
		</div>	  
	</div>
	<div class="member_info">
		<?php 
		$k	=	1;
		foreach($reviewList as $reviews){ $k = 0; ?>
			<div class="member_detail" id="comment_div_<?php echo $reviews->id; ?>">
				<div class="mamber_col">
					<div class="mem_img"><?php 
						if(!empty($reviews->user->profile_image) && file_exists(PROFILE_ROOT_PATH.$reviews->user->profile_image)){ ?>
							<img src="<?php echo WEBSITE_URL.'image.php?width=150px&height=150px&cropratio=1:1&image='.PROFILE_IMG_URL.$reviews->user->profile_image ?>" class="img-responsive" alt="img" />
						<?php }elseif(!empty($reviews->user->facebook_id)){ ?>
							<img alt="img" class="img-responsive" src="<?php echo 'http://graph.facebook.com/'.$reviews->user->facebook_id.'/picture?type=large' ?>" alt="img" />
					<?php }else{ ?>
						<img src="<?php echo WEBSITE_URL.'image.php?width=150px&height=150px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$reviews->user->sex.'.png'; ?>" alt="img" class="img-responsive man"/>
					<?php } ?>	
					</div>
				  <h2><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'users','action' => 'user_slug','user_slug' => $reviews->user->slug]); ?>"><?php echo $reviews->user->full_name; ?></a></h2>
				  <span><?php echo $reviews->user->city; ?></span>
				</div>
				<div class="memberRiver">
					<div class="revi_memb ">
					 <p class="">
						<span class="readonly" data-score="<?php echo $reviews->rating; ?>"></span>
							<span class="h2"><?php 
							/*echo $reviews->created->format(Configure::read('Date.'.$Defaultlanguage));*/
							$now = new Time($reviews->created);
							$utb_tm = $now->timeAgoInWords(
							['format' => 'MMM d, YYY', 'end' => '+1 year']);
							$utb_tm = current(explode(',', $utb_tm));
							$ago_tm = substr($utb_tm, -3);
							if($ago_tm != 'ago'){
								$utb_tm = $utb_tm.' ago';
							}
							echo $utb_tm;								
							?></span>
					  </p>
					<p class="readmoretext"><?php echo nl2br($reviews->comment); ?></p>
					</div>
					<div class="cment_sect">
						<img src="<?php echo WEBSITE_IMG_URL ?>cment.png" class="img-responsive" alt="img" />
						<a href="javascript:void(0);" data-id="addcomment_<?php echo $reviews->id; ?>" class="show_comment">Add Comment</a><span>-  Was this  review helpful ?</span>
						<div class="play_yes">
						<?php if(!empty($reviews->review_likes)){ ?>
							<a href="javascript:void(0);" class="click-like btn_play" data-rel="no" data-id="<?php echo $reviews->id; ?>" data-type="<?php echo $type; ?>">Yes</a>
						<?php }else{ ?>
							<a href="javascript:void(0);" class="click-like play_no" data-rel="yes" data-id="<?php echo $reviews->id; ?>" data-type="<?php echo $type; ?>">Yes</a>
						<?php } ?>
						<span id="like_counter_<?php echo $reviews->id ?>"> <?php echo !empty($reviews->like_count) ? '( '.$reviews->like_count.' )' : ''; ?></span>
						</div>
						<?php  if($reviews->user_id != $this->request->session()->read('Auth.User.id')){ ?>
						<div class="pull-right"><a  data-type="review" href="javascript:void(0)" data-id="<?php echo $reviews->id; ?>" class="report_as_spam" title="Report"><img src="<?php echo WEBSITE_IMG_URL; ?>ic17.png" class="img-responsive" alt="img"></a></div>
						<?php }
						if($reviews->comment_count > 3){ ?>
								<a href="javascript:void(0);" class="show_all_review_comments" data-id="<?php echo $reviews->id; ?>">Show all answers(<qa id="<?php echo $reviews->id; ?>_showall" data-count="<?php echo (!empty($reviews->comment_count)) ? $reviews->comment_count : 0 ;  ?>"><?php echo (!empty($reviews->comment_count)) ? $reviews->comment_count : 0 ;  ?></qa>)</a><?php 
							} ?>
						<?php if($reviews->user_id == $this->request->session()->read('Auth.User.id')){ $showReviewButton = false;  ?>
						<div class="block editComment">
							<div class="comEditbtn">
								<a href="javascript:void(0);" data-name="<?php echo $name; ?>" data-rating="<?php echo $reviews->rating; ?>" data-type="<?php echo $type; ?>" data-content="<?php echo $reviews->comment; ?>" class="edit_comment" data-id="<?php echo $reviews->foreign_key; ?>">Edit</a>
								<a href="javascript:void(0);" class="delete_comment_review" data-id="<?php echo $reviews->id; ?>">Delete</a>
							</div>
						</div>
						<?php } ?>						
						<div class="comment_boxN"  id="show_comment_<?php echo $reviews->id; ?>">
							<div class="CommentRow" id="comment_box_<?php echo $reviews->id; ?>">
								<?php //pr($reviews);
								if (!empty($reviews->review_comments)){
									foreach($reviews->review_comments as $key => $comments){  if($key > 3){continue;}  
										echo $this->element('review_comments',['comments' => $comments,'reviewId' => $reviews->id]);
									} 
								} ?>
							</div>
							<div id="addcomment_<?php echo $reviews->id; ?>" class="commentHere" style="display:none">
								<div class="pull-left">								
								<?php  if(!empty($this->request->session()->read('Auth.User.profile_image')) && file_exists(PROFILE_ROOT_PATH.$this->request->session()->read('Auth.User.profile_image'))){ ?>
										<img src="<?php echo WEBSITE_URL.'image.php?width=66px&height=66px&cropratio=1:1&image='.PROFILE_IMG_URL.$this->request->session()->read('Auth.User.profile_image') ?>" class="img-responsive" alt="img" />
									<?php }elseif(!empty($this->request->session()->read('Auth.User.facebook_id'))){ ?>
										<img alt="img" class="img-responsive" src="<?php echo 'http://graph.facebook.com/'.$this->request->session()->read('Auth.User.facebook_id').'/picture' ?>" alt="img" />
								<?php }else{ ?>
									<img src="<?php if($this->request->session()->read('Auth.User.sex')){
										echo WEBSITE_URL.'image.php?width=66px&height=66px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$this->request->session()->read('Auth.User.sex').'.png';
									}else{
										echo WEBSITE_URL.'image.php?width=66px&height=66px&cropratio=1:1&image='.NO_PROFILE_IMAGE.'male.png';
									} ?>" alt="img" class="img-responsive man"/>
								<?php } ?>
								</div>
								<div class="commentaria">
									<textarea id="show_comment_<?php echo $reviews->id; ?>_textarea" data-id="<?php echo $reviews->id; ?>" placeholder="Write a comment" class="add_new_comment"></textarea>
									<div class="pull-right">
										<button class="rvew-btn-cancel" data-id="<?php echo $reviews->id; ?>">Cancel</button><button data-id="<?php echo $reviews->id; ?>" class="rvew-btn-save">Save</button>
									</div>
								</div>
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
	<?php if($showReviewButton){ ?>
		$(".add-rvw-btn").removeClass('hide');
<?php } ?>
	 $(document).on('click', '.edit_review_comment', function(){
		id	=	$(this).attr('data-id');
	 });
	 
	 
	$(document).on('click', '.show_all_review_comments', function(){
		id = $(this).attr('data-id');
		$.ajax({
			url  	 : '<?php echo $this->Url->build('/users/get_all_reviews'); ?>',
			data 	 : {id : id},
			type	 : 'POST',
			dataType : 'json',
			success  : function(r){
				$("#comment_box_"+id).html(r.data);
			}
		});	
	});
	$(document).on('click', '.rvew-btn-cancel', function(){
		id		=	$(this).attr('data-id');
		$("#show_comment_"+id+"_textarea").val('');
		$("#show_comment_"+id+"_textarea").removeClass('border-red');
		$("#addcomment_"+id).hide('slow');
	});
	 $(document).on('click', '.delete_review_comment', function(){
		if(confirm('Are you sure to delete this comment')){
			pid		=	$(this).attr('data-pid');
			id		=	$(this).attr('data-id');
			$this	=	$(this);
			
			count	=	parseInt($("#"+pid+"_showall").attr('data-count'));
			count	=	count-1;
			$("#review_comment_id"+id).hide('slow', function(){ $("#review_comment_id"+id).remove(); });		
			$.ajax({
				url  	 : '<?php echo $this->Url->build('/users/delete_review_comment'); ?>',
				data 	 : {id : id},
				type	 : 'POST',
				dataType : 'json',
				success  : function(r){		
					if(r.success){
						notice('Success','<?php echo __('Comment deleted successfully',true); ?>','success');
						
						$("#"+pid+"_showall").html(count);
						$("#"+pid+"_showall").attr('data-count',count);
					}else{
						 notice('Error',r.message,'error');
						 location.reload(); 						
					}
				}
			}); 
		}
	 });
	 $(document).on('click', '.show_comment', function(){
		<?php if(empty($this->request->session()->read('Auth.User'))){ ?>
			$(".login-pop").trigger('click');
		<?php }else{ ?>
			id = $(this).attr('data-id');
			$("#"+id).show('slow');
			$('html, body').animate({
				//scrollTop: $('#'+id+'_textarea').offset().top-100
			}, 2000);
		<?php } ?>
	});
	eclick	=	true;
	
	
	$(document).on('click', '.rvew-btn-save', function(event){
		<?php if(empty($this->request->session()->read('Auth.User'))){ ?>
			$(".login-pop").trigger('click');
		<?php }else{ ?>
		if(eclick){
			id		= pid =	$(this).attr('data-id');			
			val 	=	$("#show_comment_"+id+"_textarea").val();
			if(val == '' || val == ' ' || val == false){
				$("#show_comment_"+id+"_textarea").addClass('border-red');
				return false;
			}
			
			$this	=	$("#show_comment_"+id+"_textarea");
			
			eclick	=	false;
			
			count	=	parseInt($("#"+pid+"_showall").attr('data-count'));
			count	=	count+1;
						
			$.ajax({
				url  	 : '<?php echo $this->Url->build('/users/add_review_comment'); ?>',
				data 	 : {id : id,comment : val},
				dataType : 'json',
				type	 : 'POST',
				success  : function(r){
					var myDiv = document.getElementById("comment_box_"+id);
					myDiv.scrollTop = 0;
					data			=	r.data;
					commentId		=	r.id;
					$("#comment_box_"+id).append('<div class="commentPostN" style="display:none" id="review_comment_id'+commentId+'">'+data+'</div>');
					
					$("#review_comment_id"+commentId).show('slow');
					
					$this.val('');
					notice('Message','<?php echo __('Comment posted successfully',true); ?>','success');
					eclick	=	true;
					
					
					$("#"+pid+"_showall").html(count);
					$("#"+pid+"_showall").attr('data-count',count);
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
	$(document).on('click', '.delete_comment_review', function(){
		if(confirm('Are you sure to delete this review')){
			id 		=	$(this).attr('data-id');
			$.ajax({
				url  	 : '<?php echo $this->Url->build('/users/review_delete'); ?>',
				data 	 : {id : id},
				dataType : 'json',
				type	 : 'POST',
				success  : function(r){
					if(r.success){						
						count	=	r.count;
						$("#count_review").html(count);
						$("#comment_div_"+id).remove();
					}else{
						notice('Error',r.message,'error');
						 location.reload(); 
					}
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
<div class="modal fade writeReview" id="report_span_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content photoPoup">
			<div class="popupIn">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo $this->Url->build('/users/report_as_spam'); ?>" id="report_span_form" accept-charset="utf-8" method="post" class="ng-pristine ng-valid">
						 <?php echo $this->Form->hidden('foreign_key',['id' => 'report_span_foreignkey']); ?>						
						 <?php echo $this->Form->hidden('type',['id' => 'report_span_foreignkey_type']); ?>						
						<div class="radioInfocheck"><span>Report As Spam</span></div>
						<div class="radioInfocheck"><?php echo $this->Form->radio('category',$reportAsSpam); ?></div>
					  <div class="reviewBtn"><div id="report_span_form_error_div"></div>
						<input type="submit" class="btn red_btn report_span_update" value="Submit" />
					  </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
