<?php use Cake\Core\Configure;
use Cake\I18n\Time; ?>
<div class="member_review">
	<div class="member_bord">
	  <div class="member">
		<h2><?php echo ($type == 'news') ? 'Comments' : 'Questions & Answers'; ?> (<span id="count_question"><?php echo $count; ?></span>)</h2>
	  </div><?php /*
	  <div class="sort_search"><span>Sort By :</span>
		<?php echo $this->cell('Inbox::display',[$sort_by]); ?>		
	  </div>*/?>
	</div>
	<div class="AddReviewBtn">
		<div class="pull-right">
			<a href="javascript:void(0);" data-name="<?php echo $name; ?>" data-type="<?php echo $type; ?>" data-id="<?php echo $foreign_key; ?>" class="btn red_btn add_question"><?php echo ($type == 'news') ? 'Add Comment' : 'Add Question'; ?></a>
		</div>	  
	</div>
	<div class="member_info">
        <div class="block">
			<div id="AddCommentPopup" class="member_detail" style="display:none">
			<?php echo $this->Form->create('User',['url' => WEBSITE_URL.'questions/add','id' => 'question_form']);
				echo $this->Form->hidden('foreign_key',['id' => 'foreign_key1']);
				echo $this->Form->hidden('type',['id' => 'type1']); ?>
				<div id="question_form_error_div"></div>
				<div class="member_detail hht hht2">
				   <div class="mamber_col">
					  <div class="mem_img">
						  <?php  if(!empty($this->request->session()->read('Auth.User.profile_image')) && file_exists(PROFILE_ROOT_PATH.$this->request->session()->read('Auth.User.profile_image'))){ ?>
							<img src="<?php echo WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.PROFILE_IMG_URL.$this->request->session()->read('Auth.User.profile_image') ?>" class="img-responsive" alt="img" />
						<?php }elseif(!empty($this->request->session()->read('Auth.User.facebook_id'))){ ?>
							<img alt="img" class="img-responsive" src="<?php echo 'http://graph.facebook.com/'.$this->request->session()->read('Auth.User.facebook_id').'/picture' ?>" alt="img" />
					<?php }else{ if($this->request->session()->read('Auth.User.sex')){ ?>
						<img src="<?php echo WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$this->request->session()->read('Auth.User.sex').'.png'; ?>" alt="img" class="img-responsive man"/>
					<?php } } ?>
					  </div>
					  <h2><?php echo $this->request->session()->read('Auth.User.full_name'); ?></h2>
					  <p><?php echo $this->request->session()->read('Auth.User.city'); ?></p>
				   </div>
				   <div class="memberRiver addQuiton">
						<div class="revi_memb revi_memb1">
							<?php echo $this->Form->textarea('comment',['class' => 'form-control','placeholder' => ($type == 'news') ? 'Please add comment' :'Please add question']); ?>
						</div>
						<div class="reviewBtn">
							<button type="submit" class="r-btn comment_submit"><?php echo ($type == 'news') ? 'Add Comment' : 'Add Question'; ?></button>&nbsp;
							<button type="button" onclick="$('#AddCommentPopup').hide('slow');" class="w-btn">Cancel</button>
						</div>							
				   </div>
				</div>
			</div>
		<?php echo $this->Form->end(); ?>
		<?php 
		$k	=	1;
		foreach($reviewList as $reviews){ $k = 0;//pr($reviews);  ?>
			<div class="member_detail" id="comment_div_<?php echo $reviews->id; ?>">
				<div class="mamber_col">
					<div class="mem_img"><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'users','action' => 'user_slug','user_slug' => $reviews->user->slug]); ?>"><?php 
						if(!empty($reviews->user->profile_image) && file_exists(PROFILE_ROOT_PATH.$reviews->user->profile_image)){ ?>
							<img src="<?php echo WEBSITE_URL.'image.php?width=150px&height=150px&cropratio=1:1&image='.PROFILE_IMG_URL.$reviews->user->profile_image ?>" class="img-responsive" alt="img" />
						<?php }elseif(!empty($reviews->user->facebook_id)){ ?>
							<img alt="img" class="img-responsive" src="<?php echo 'http://graph.facebook.com/'.$reviews->user->facebook_id.'/picture?type=large' ?>" alt="img" />
					<?php }else{ ?>
						<img src="<?php echo WEBSITE_URL.'image.php?width=150px&height=150px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$reviews->user->sex.'.png';; ?>" alt="img" class="img-responsive man"/>
					<?php } ?></a>
					</div>
				  <h2><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'users','action' => 'user_slug','user_slug' => $reviews->user->slug]); ?>"><?php echo $reviews->user->full_name; ?></a></h2>
				  <span><?php echo $reviews->user->city; ?></span>
				</div>
				<div class="memberRiver addQuiton">
					<div class="revi_memb" id="questionsppp<?php echo $reviews->id; ?>">
						 <p class="">
							<span><?php 
							$now = new Time($reviews->created);
							$utb_tm = $now->timeAgoInWords(
							['format' => 'MMM d, YYY', 'end' => '+1 year']);
							$utb_tm = current(explode(',', $utb_tm));
							$ago_tm = substr($utb_tm, -3);
							if($ago_tm != 'ago'){
								$utb_tm = $utb_tm.' ago';
							}
							echo $utb_tm;
							//echo $reviews->created->format('M d, Y'); ?></span>
						  </p>
						<p class="readmoretext" id="questionstext<?php echo $reviews->id; ?>"><?php echo nl2br($reviews->comment); ?></p>
					</div>
					<div class="revi_memb" style="display:none" id="questionshhh<?php echo $reviews->id; ?>">
						 <p><textarea class="form-control" id="questions<?php echo $reviews->id; ?>"><?php echo ($reviews->comment); ?></textarea></p>
						<div class="reviewBtn">
							<button type="submit" class="r-btn1" data-id="<?php echo $reviews->id; ?>" data-type="questions">Save</button>&nbsp;
							<button type="button" onclick="$('#questionshhh<?php echo $reviews->id; ?>').hide('slow'),$('#questionsppp<?php echo $reviews->id; ?>').show('slow');" class="w-btn1">Cancel</button>
						</div>
					</div>
					<div class="cment_sect">
						<div class="pull-left rerpo_btn respond respondBTN2">
							<a href="javascript:void(0);" data-id="<?php echo $reviews->id; ?>" class="btn red_btn comment_div commentBTN">Respond</a>
							<p>Was this question helpful to you</p>
							<div class="play_yes">
							<?php //if(isset($reviews->question_likes[0]->user_id) && $reviews->question_likes[0]->user_id == $this->request->session()->read('Auth.User.id')) ?>
								<span class="checkinfo2">
									<input <?php echo (isset($reviews->question_likes[0]->user_id) && ($reviews->question_likes[0]->user_id == $this->request->session()->read('Auth.User.id')) && ($reviews->question_likes[0]->value == 'yes')) ? 'checked="checked"' : ''; ?> data-id="<?php echo $reviews->id; ?>" data-type="question" type="radio" name="qyes<?php echo $reviews->id; ?>" id="qyes<?php echo $reviews->id; ?>" value="yes"/>
									<label for="qyes<?php echo $reviews->id; ?>" id="myes<?php echo $reviews->id; ?>question">Yes<?php echo (!empty($reviews->like_count)) ? '('.$reviews->like_count.')' : ''; ?></label>
								</span>
								<span class="checkinfo2">
									<input  <?php echo (isset($reviews->question_likes[0]->user_id) && $reviews->question_likes[0]->user_id == $this->request->session()->read('Auth.User.id') && $reviews->question_likes[0]->value == 'no') ? 'checked="checked"' : ''; ?> data-id="<?php echo $reviews->id; ?>" data-type="question" type="radio" name="qyes<?php echo $reviews->id; ?>" id="qno<?php echo $reviews->id; ?>" value="no"/>
									<label id="mno<?php echo $reviews->id; ?>question" for="qno<?php echo $reviews->id; ?>">No<?php echo (!empty($reviews->dislike_count)) ? '('.$reviews->dislike_count.')' : ''; ?></label>
								</span>          
							</div>
						</div>
						<div class="pull-right">
							<div class="qrashe">
								<a href="javascript:void(0);" title="Click For Report As Spam" data-id="<?php echo $reviews->id; ?>" class="showEditBtn qras" data-type="question"><img src="<?php echo WEBSITE_IMG_URL; ?>ic17.png" class="img-responsive" alt="img"></a>
								<?php if($this->request->session()->read('Auth.User.id') == $reviews->user_id){ ?>
								<div class="qrasedit">
									<a href="javascript:void(0);" data-id="<?php echo $reviews->id; ?>" class="showEditBtn edit-q-c" data-type="questions">Edit</a>
									<a href="javascript:void(0);" data-pid="count_question" data-id="<?php echo $reviews->id; ?>" data-div="comment_div_" class="showEditBtn dlt-q" data-type="question">Delete</a>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="member_detail hht" style="display:none" id="comment_div_textarea_<?php echo $reviews->id; ?>">
                        <div class="mamber_col">
                          <div class="mem_img">
						  <?php  if(!empty($this->request->session()->read('Auth.User.profile_image')) && file_exists(PROFILE_ROOT_PATH.$this->request->session()->read('Auth.User.profile_image'))){ ?>
								<img src="<?php echo WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.PROFILE_IMG_URL.$this->request->session()->read('Auth.User.profile_image') ?>" class="img-responsive" alt="img" />
							<?php }elseif(!empty($this->request->session()->read('Auth.User.facebook_id'))){ ?>
								<img alt="img" class="img-responsive" src="<?php echo 'http://graph.facebook.com/'.$this->request->session()->read('Auth.User.facebook_id').'/picture' ?>" alt="img" />
						<?php }else{ ?>
							<img src="<?php
							if(!empty($this->request->session()->read('Auth.User.sex'))){
								echo WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$this->request->session()->read('Auth.User.sex').'.png';
							}else{
								echo WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.NO_PROFILE_IMAGE.'male.png';
							}  ?>" alt="img" class="img-responsive man"/>
						<?php } ?></div>
                          <h2><?php echo $this->request->session()->read('Auth.User.full_name'); ?></h2>
						</div>
                        <div class="memberRiver addQuiton">
							<div class="revi_memb">
							<?php echo $this->Form->create('Question'); ?>
								<?php echo $this->Form->textarea("question",['class' => 'form-control','id' => 'answer_comment_'.$reviews->id]); ?>
								<p class="ansBtnInfo"><button type="button" data-id="<?php echo $reviews->id; ?>" class="comment_div ansBtn2">Cancel</button><button data-id="<?php echo $reviews->id; ?>" class="answer_comment ansBtn2" type="submit">Save</button></p>
							<?php echo $this->Form->end(); ?>
							</div>
                        </div>
                    </div>
					<?php if($reviews->comment_count > 3){ ?>
						<div class="allAnswer"><a href="javascript:void(0);"  class="show_all_comments" data-id="<?php echo $reviews->id; ?>">Show all answers(<?php echo (!empty($reviews->comment_count)) ? '<span id="count_answer_'.$reviews->id.'">'.$reviews->comment_count.'</span>' : 0 ;  ?>)</a></div><?php 
					}
					if (!empty($reviews->question_comments)){ ?>
					<div id="comment_div_all_<?php echo $reviews->id; ?>"><?php
						foreach($reviews->question_comments as $key => $comments){ if($key > 3){continue;}  
							echo $this->element('question_comment',['comments' => $comments,'questionId' => $reviews->id]); ?>

					<?php } ?></div><?php
					} ?>
				</div>				
			</div>
		<?php } if($k){	?>
			<div class="member_detail text-center">
				 <h4><?php echo ($type == 'news') ? 'No record found' : 'No question has been asked'; ?></h4>
			</div>
			<?php 
		} ?>	  
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).on('click', '.dlt-q', function(e){
		
		if(confirm('Are you sure ?')){
			id		=	$(this).attr('data-id');
			type	=	$(this).attr('data-type');
			div		=	$(this).attr('data-div');
			pid		=	$(this).attr('data-pid');
			$this	=	$(this);
				
			$.ajax({
				url  	 : '<?php echo $this->Url->build('/questions/delete'); ?>',
				data 	 : {id : id,type : type},
				type	 : 'POST',
				dataType : 'json',
				success  : function(r){
					
					if(r.success){
						$("#"+div+id).hide('slow');						
						notice('Success',r.message,'success');
						
						setTimeout(function(){
							$("#"+div+id).remove();
						},1000);
						
						count	=	$("#"+pid).html();
						$("#"+pid).html(count-1);
						
						
					}else{
						 notice('Error',r.message,'error');
						 location.reload(); 						
					}
				}
			}); 
		}
	});
	$(document).on('click', '.show_all_comments', function(e){
		$(this).hide();
		e.preventDefault();
		question_id	=	$(this).attr('data-id');
		$.ajax({
			url  	 : '<?php echo $this->Url->build('/questions/list_all_answer'); ?>',
			data 	 : {question_id : question_id},
			type	 : 'POST',
			dataType : 'json',
			success  : function(r){
				if(r.success){
					$("#comment_div_all_"+question_id).html(r.data);					
				}
			}
		}); 
	});
	$(document).on('click', '.answer_comment', function(e){
		e.preventDefault();
		question_id	=	$(this).attr('data-id');
		answer_comment = $("#answer_comment_"+question_id).val();
		if(answer_comment == '' || answer_comment == ' ' || answer_comment == false){
			$("#answer_comment_"+question_id).addClass('border-red');
			return false;
		}
		
		$.ajax({
			url  	 : '<?php echo $this->Url->build('/questions/add_answer_comment'); ?>',
			data 	 : {answer_comment : answer_comment,question_id : question_id,type : '<?php echo $type ?>'},
			type	 : 'POST',
			dataType : 'json',
			success  : function(r){
				
				if(r.success){					
					$("#comment_div_all_"+question_id).append(r.data);
					$("#answer_comment_"+question_id).val('');
					$("#comment_div_textarea_"+question_id).hide();
				 
					notice('Success',r.message,'success');
					<?php if (empty($reviews->question_comments)){ ?>
							location.reload();
						<?php } ?>
				}else{
					// conso
					$("#answer_comment_"+question_id).addClass('border-red');
					 notice('Error',r.errors.answer_comment,'error');
					return false;
					 // location.reload(); 						
				}
			}
		}); 
	});
	
	$(document).on('click', '.qras', function(){
		id	 = $(this).attr('data-id');
		type = $(this).attr('data-type');
		<?php if(empty($this->request->session()->read('Auth.User'))){ ?>
			$(".login-pop").trigger('click');
		<?php }else{ ?>
			$("#report_span_foreignkey_question").val(id);
			$("#type_question").val(type);
			$("#report_span_modal_questionmodal").modal('show');	
		<?php } ?>
	});
	
	$(document).on('click', '.comment_div', function(){
		id = $(this).attr('data-id');
		$("#answer_comment_"+id).removeClass('border-red');
		$("#answer_comment_"+id).val('');
		
		$("#comment_div_textarea_"+id).toggle('slow'); 
	 });
	 
	 $(document).on('click', '.edit_review_comment', function(){
		id	=	$(this).attr('data-id');
	 });
	 

	$(document).on('click', "input[name^='qyes']", function(){
		<?php if(empty($this->request->session()->read('Auth.User'))){ ?>
			$(".login-pop").trigger('click');
		<?php }else{ ?>
			btn 		=$(this); 
			id 			= $(this).attr('data-id');
			value 		= $(this).attr('value');
			type 		= $(this).attr('data-type');
			question 	= $(this).attr('data-question-id');
			btn.button('loading');

			$.ajax({
				url  	 : '<?php echo $this->Url->build('/questions/questionlikes'); ?>',
				data 	 : {id : id,value : value,type : type,maintype :'<?php echo $type ?>'},
				type	 : 'POST',
				dataType : 'json',
				success  : function(r){
					like_count	  = r.like_count;
					dislike_count = r.dislike_count;
					$("#mno"+id+type).html('No ('+dislike_count+')');
					$("#myes"+id+type).html('Yes ('+like_count+')');
					btn.button('reset');
				}
			}); 
		<?php } ?>
	});	
	 $(document).on('click', '.show_comment_que', function(){
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
	
	$(document).on('click', '.report_span_update_question', function(e){
		e.preventDefault();
		form_id				=	'report_span_modal_question';
		var error_div_id	=	form_id+'_error_div';
		var error_div		=	$("#"+error_div_id);
		error_div.hide();
		$("#ajax-loader").removeClass('hide');
		var options = {
			type: 'post',
			success:function(r){
				$("#ajax-loader").addClass('hide');
				data		=	JSON.parse(r) ;
				if(data.success){
					$("#report_span_modal_questionmodal").modal('hide');
					$("#succ_popup").modal();
				//	notice('Success',data.message,'success');
				}else{
					data 				=  data.errors;
					
					var error	=	'<ul class="client-side-error">';
					$.each(data,function(index,html){
						error	+=	'<li>'+html+'</li>';
					});
					error	+=	'</ul>';
					error_msg	=	'<div class="alert alert-danger alert-dismissible site-color" style="padding-left: 0;" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'+error+'</div>';
					error_div.html(error_msg);
					error_div.show();
				}
				return false;
			},
			resetForm:false
		}; 
		$("form#"+form_id).ajaxSubmit(options);		
	});
	
	$(".comment_submit").click(function(e){
		e.preventDefault();
		form_id	=	'question_form';
		/* $("#ajax-loader").removeClass('hide'); */

		var options = {
			type: 'post',
			success:function(r){
				$("#ajax-loader").addClass('hide');
				data		=	JSON.parse(r) ;
				if(data.success){
					 window.location.reload();
				}else{
					var error_div_id	=	form_id+'_error_div';
					 $('#AddCommentPopup').animate({ scrollTop: 0 }, 'slow');
					
					data = data.errors;
					var error_div		=	$("#"+error_div_id);
					
					var error	=	'<ul class="client-side-error">';
					$.each(data,function(index,html){
						error	+=	'<li>'+html+'</li>';
					});
					error	+=	'</ul>';
					error_msg	=	'<div class="alert alert-danger alert-dismissible site-color" style="padding-left: 0;" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'+error+'</div>';
					error_div.html(error_msg);
					error_div.show();
				}
				return false;
			},
			resetForm:false
		}; 
		$("form#"+form_id).ajaxSubmit(options);		
	});
</script>
<div class="modal fade writeReview" id="report_span_modal_questionmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content photoPoup">
			<div class="popupIn">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo $this->Url->build('/question/report_as_spam'); ?>" id="report_span_modal_question" accept-charset="utf-8" method="post" class="ng-pristine ng-valid">
						 <?php echo $this->Form->hidden('foreign_key',['id' => 'report_span_foreignkey_question']); ?>
						 <?php echo $this->Form->hidden('type',['id' => 'type_question']); ?>						
						<div class="radioInfocheck"><span>Report As Spam</span></div>
						<div class="radioInfocheck"><?php echo $this->Form->radio('category',$reportAsSpam); ?></div>
					  <div class="reviewBtn">
					  						<div id="report_span_modal_question_error_div"></div>

						<input type="submit" class="btn red_btn report_span_update_question" value="Submit" />
					  </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- succss popup -->

<div class="modal fade writeReview" id="succ_popup" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm model_new">
    <div class="modal-content photoPoup">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        Thank you for informing us,we have received you report, if we see
        that this content voilates our terms of use,it will remove.
      </div>
      <div class="reviewBtn">
        <button type="button" class="btn red_btn" data-dismiss="modal">Accept</button>
      </div>
    </div>
  </div>
</div>