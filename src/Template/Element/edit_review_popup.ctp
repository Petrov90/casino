<?php if(!empty($this->request->session()->read('Auth.User'))){ ?>
<div class="modal fade writeReview" id="writeReviews_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content photoPoup">
			<div class="popupIn">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'addReview')); ?>" id="review_form_edit" accept-charset="utf-8" method="post" class="ng-pristine ng-valid">
						 <?php 
						 echo $this->Form->hidden('foreign_key',['id' => 'foreign_key_edit']); 
						 echo $this->Form->hidden('type',['id' => 'type_edit']); ?>
						 <?php echo $this->Form->hidden('checkbox',['value' => 1]); ?>
						<div id="review_form_edit_error_div"></div>
						<div class="reviewBlog">
							<div class="pull-left">
								<div class="ReviewProfile"><?php echo $this->element('profile_image'); ?></div>
								<h2><?php echo $this->request->session()->read('Auth.User.full_name') ?></h2>
								<span><?php echo $this->request->session()->read('Auth.User.city') ?></span>
							</div>
							<div class="reviewText">
								<h2>Update Your Review for</h2>
								<a id="edit_city_name_r"></a>
							</div>
							<div class="review_box">
								<div class="block">
									<span>Your Rating :</span>
									<div class="jrating" id="comment_rating" data-score="0"></div>
									<div class="block"> <span>Your Review :</span>
									  <?php echo $this->Form->textarea('comment',['ng-model' => 'formData','id' => 'comment_id']);  /* ?>
									  <p>
										<label>{{formData.length}} characters</label>
									  </p> */?>
									</div>
								</div>
							</div>
						</div>
					  <div class="reviewBtn">
						<input type="submit" class="btn red_btn review_submit_update" value="Update" />
					  </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
	
}
/* echo $this->Html->css(['jquery.raty.css'],array('block' =>'css')); */
	/* echo $this->Html->script(['jquery.raty.js'],array('block' =>'footer_script'));  */
 $this->Html->scriptStart(array('block' => 'custom_script')); ?>
	$(document).on('click', '.review_submit_update', function(e){
		e.preventDefault();
		form_id	=	'review_form_edit';
		$("#ajax-loader").removeClass('hide');
		var options = {
			type: 'post',
			success:function(r){
				$("#ajax-loader").addClass('hide');

				data		=	JSON.parse(r) ;
				if(data.success){
					 // window.location	=	'<?php echo $this->Url->build(array('plugin' => '','controller' => 'globalusers','action' => 'index')); ?>';
					 window.location.reload();
				}else{
					data 				=  data.errors;
					var error_div_id	=	form_id+'_error_div';
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
	
	$(document).on('click', '.edit_comment', function(){
		type			=	$(this).attr('data-type');
		name			=	$(this).attr('data-name');
		id				=	$(this).attr('data-id');
		content			=	$(this).attr('data-content');
		rating			=	$(this).attr('data-rating');
		edit_city_name_r			=	$(this).attr('data-name');
		
		
		$("#writeReviews_edit").modal('show');
		$("#type_edit").val(type);
		$("#foreign_key_edit").val(id);
		$("#comment_id").val(content);
		$("#edit_city_name_r").html(edit_city_name_r);
		$("#comment_rating").attr('data-score',rating);
		
		$('.jrating').raty({
			scoreName : 'rating',
			score: function() {
				return $(this).attr('data-score');
			}
		});
			
			
	});
<?php $this->Html->scriptEnd(); ?>