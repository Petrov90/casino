<?php if(!empty($this->request->session()->read('Auth.User'))){ ?><div class="modal fade" id="photo-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content photoPoup">
         <div class="popupIn">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h2 class="modal-title" id="myModalLabel">Add photo</h2>
            </div>
            <div class="modal-body">
				<div class="uploadPhoto" style="display:none" id="uploadPhoto1">
					<div>Please wait file is uploading</div>
					<div id="progressTimer"></div>
				</div>
				<div class="uploadPhoto" id="uploadPhoto">
					<?php echo $this->Form->create('User',['url' => '/users/upload_image','id' => 'upload_img_form']) ?>
						<div class="uploadIn">
							<span>Upload Photo<?php echo $this->Form->file('image') ?></span>
						</div>
					<?php echo $this->Form->end(); ?>
				</div>
				<?php echo $this->Form->create('User',['url' => '/users/upload_image','id' => 'upload_form']) ?>
					<?php echo $this->Form->hidden('type',['value' => $type]) ?>
					<?php echo $this->Form->hidden('foreign_key',['value' => $foreign_key]) ?>
					<?php echo $this->Form->hidden('image',['id' => 'image_name']) ?>
					<div style="display:none" class="uploadPhoto" id="uploadPhoto2">
						<img src="" alt="Image" id="image_src"/>
					</div>				
					<div class="Optional"><div id="upload_img_form_error_div"></div></div>
					<div class="Optional">
					  <p>Caption: <span>(Optional) 0/200</span></p>
					  <?php echo $this->Form->text('caption',['id' => 'caption']) ?>
					</div>
				   <div class="block"><a href="javascript:void(0)" class="btn red_btn img_up">Save</a></div>
			   <?php echo $this->Form->end(); ?>
            </div>
         </div>
      </div>
   </div>
</div>
<?php  }
echo $this->Html->script(['jquery.progressTimer.min.js'],array('block' =>'custom_script'));
$this->Html->scriptStart(array('block' => 'custom_script')); ?>	

		<?php if(!empty($this->request->session()->read('Auth.User'))){ ?>
	$('.img_up').click(function (event) {			
		form_id = 'upload_form';
		$("#ajax-loader").removeClass('hide');

		var options = {
			type	: 'post',				
			success:function(r){
				$("#ajax-loader").addClass('hide');
				data		=	JSON.parse(r) ;
				if(data.success){
					$("#photo-modal").modal('hide');
					notice('Info',data.message,'info');
				}else{
					$("#uploadPhoto").show();
					$("#uploadPhoto1").hide();
		
					data = data.errors;
					var error_div_id	=	'upload_img_form_error_div';
					$('#login-modal').animate({ scrollTop: 0 }, 'slow');
					
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
			},
			resetForm:false
		}; 
		$("form#"+form_id).ajaxSubmit(options);	
	
	});
	$('input[type=file]').change(function (event) {		
		form_id = 'upload_img_form';
		
		$("#upload_img_form_error_div").hide();
		$("#uploadPhoto").hide();
		$("#uploadPhoto1").show();
		
		$("#progressTimer").progressTimer({
			timeLimit: 10
		});			
		var options = {
			type	: 'post',				
			success:function(r){
				data		=	JSON.parse(r) ;
				if(data.success){
					$("#image_name").val(data.name);
					$("#image_src").attr('src',data.src);
					$("#uploadPhoto").hide();
					$("#uploadPhoto1").hide();
					$("#uploadPhoto2").show();
				}else{
					$("#uploadPhoto").show();
					$("#uploadPhoto1").hide();
		
					data = data.errors;
					var error_div_id	=	form_id+'_error_div';
					$('#login-modal').animate({ scrollTop: 0 }, 'slow');
					
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
			},
			resetForm:false
		}; 
		$("form#"+form_id).ajaxSubmit(options);	
	});
	
		<?php } ?>
	$(document).on('click', '.add-photos-click', function(){
		<?php if(!empty($this->request->session()->read('Auth.User'))){ ?>
			$("#image_name").val('');
			$("#caption").val('');
			$("#uploadPhoto").show();
			$("#uploadPhoto1").hide();
			$("#uploadPhoto2").hide();
			 $("#photo-modal").modal('show');
		<?php }else{ ?>
			$(".login-pop").trigger('click');
		<?php } ?>
	});
<?php $this->Html->scriptEnd(); ?>