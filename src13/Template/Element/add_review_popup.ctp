<?php if(!empty($this->request->session()->read('Auth.User'))){ ?>
<div class="modal fade writeReview" id="writeReviews" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content photoPoup">
			<div class="popupIn">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<?php echo $this->Form->create('User',['url' => array('plugin' => '','controller' => 'users','action' => 'addReview'),'id' => 'review_form']); ?>
					<?php 
						echo $this->Form->hidden('foreign_key',['id' => 'foreign_key']);
						echo $this->Form->hidden('type',['id' => 'type']); ?>
						<div id="review_form_error_div"></div>
						<div class="reviewBlog">
							<div class="pull-left">
								<div class="ReviewProfile"><?php echo $this->element('profile_image'); ?></div>
								<h2><?php echo $this->request->session()->read('Auth.User.full_name') ?></h2>
								<span><?php echo $this->request->session()->read('Auth.User.city') ?></span>
							</div>
							<div class="reviewText">
								<h2>Write a Review for</h2>
								<a id="city_name_r"></a>
							</div>
							<div class="review_box">
								<div class="block">
									<span>Your Rating :<span class="red-star">*</span></span>
									<div class="jrating111" data-score="0"></div>
									<div class="block"> <span>Your Review :<span class="red-star">*</span></span>
									  <?php echo $this->Form->textarea('comment',['onkeyup' => 'count_text()','id' => 'text_count_textarea']); ?>
									  <p>
										<label><is id="t_count">0</is> characters</label>
									  </p>
									</div>
								</div>
							</div><?php /*
							<div class="reviewCheck">
							  <div class="checbox">
								<label>
									<?php echo $this->Form->checkbox('checkbox'); ?>
									<span></span></label>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris</p>
							  </div>
							</div>*/ ?>
						</div>
					  <div class="reviewBtn">
						<button type="submit" class="btn red_btn review_submit">Submit</button>						
					  </div>
					</form>
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
	function count_text(){
		val	=	$("#text_count_textarea").val().length;
		$("#t_count").text(val);
	}
	$(".review_submit").click(function(e){
		e.preventDefault();
		form_id	=	'review_form';
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
					var error_div_id	=	form_id+'_error_div';
					 $('#writeReviews').animate({ scrollTop: 0 }, 'slow');
					
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
	
 <?php } ?>
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
			$("#writeReviews").modal('show');
			$("#type").val(type);
			$("#foreign_key").val(id);
			
			
		<?php }else{ ?>
			$(".login-pop").trigger('click');
		<?php } ?>
	});
<?php $this->Html->scriptEnd(); ?>