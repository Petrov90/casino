<?php if(!empty($this->request->session()->read('Auth.User'))){ ?>
<div class="modal fade writeReview" id="AddCommentPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog w900">
		<div class="modal-content photoPoup">
			<div class="popupIn">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<?php echo $this->Form->create('User',['url' => WEBSITE_URL.'questions/add','id' => 'question_form']); ?>
					<?php 
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
							<?php }else{ ?>
								<img src="<?php echo WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$this->request->session()->read('Auth.User.sex').'.png'; ?>" alt="img" class="img-responsive man"/>
							<?php } ?>
							  </div>
							  <h2><?php echo $this->request->session()->read('Auth.User.full_name'); ?></h2>
							  <p><?php echo $this->request->session()->read('Auth.User.city'); ?></p>
						   </div>
						   <div class="memberRiver addQuiton">
								<div class="revi_memb revi_memb1">
									<?php echo $this->Form->textarea('comment',['class' => 'form-control','placeholder' => ($type == 'news') ? 'Please add comment' :'Please add question']); ?>
								</div>
								<div class="reviewBtn">
									<button type="submit" class="btn red_btn comment_submit pull-right"><?php echo ($type == 'news') ? 'Add Comment' : 'Add Question'; ?></button>
								</div>							
						   </div>
						</div>
					<?php echo $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
/* 	echo $this->Html->css(['jquery.raty.css'],array('block' =>'css'));
	echo $this->Html->script(['jquery.raty.js'],array('block' =>'footer_script'));  */
}
 $this->Html->scriptStart(array('block' => 'custom_script')); ?>
 <?php if(!empty($this->request->session()->read('Auth.User'))){ ?>
	$(".comment_submit").click(function(e){
		e.preventDefault();
		form_id	=	'question_form';
		$("#ajax-loader").removeClass('hide');

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
	
 <?php } /* ?>
	$(document).on('click', '.city-click', function(){
		<?php if(!empty($this->request->session()->read('Auth.User'))){ ?>			
			$("#review_form_error_div").hide();
			
			$("#text_count_textarea").val('');
			
			$(".jrating111").attr('data-score',0);
			
			$('.jrating111').raty({
				scoreName : 'rating',
				score: function() {
					return $(this).attr('data-score');
				}
			});
			slug		=	$(this).attr('data-slug');
			type		=	$(this).attr('data-type');
			name		=	$(this).attr('data-name');
			id			=	$(this).attr('data-id');
			
			
			$("#city_name_r").html(name);
			$("#AddCommentPopup").modal('show');
			$("#type").val(type);
			$("#foreign_key").val(id);
			
			
		<?php }else{ ?>
			$(".login-pop").trigger('click');
		<?php } ?>
	});
<?php */ $this->Html->scriptEnd(); ?>