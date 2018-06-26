<?php $this->Html->scriptStart(array('block' => 'custom_script')); ?>
$(function(){
	$.ajax({
		url  : '<?php echo $this->Url->build('/users/get_reviews') ?>',
		data : {
			type 		: '<?php echo $type; ?>',
			foreign_key : '<?php echo $id; ?>',
			name 		: '<?php echo $name ?>',
			count 		: '<?php echo $count; ?>',
			avg_rating  : '<?php echo $avg_rating; ?>'
		},
		type : 'POST',
		dataType : 'json',
		success : function(r){
			$("#review_div").html(r.data);
		}		
	});
	$(document).on('click', '.report_as_spam1', function(){
		<?php if(empty($this->request->session()->read('Auth.User'))){ ?>
			$(".login-pop").trigger('click');
		<?php }else{ ?>
			id		=	$(this).attr('data-id');
			type	=	$(this).attr('data-type');
			$("#report_span_foreignkey").val(id);
			$("#report_span_foreignkey_type").val(type);
			$("#report_span_modal").modal('show');			
		<?php } ?>		
	});
	$(document).on('change', '.sort_by', function(){
		val	 =	$(this).val();
		$("#review_div").html('<div class="text-center"><img alt="Loading" src="<?php echo WEBSITE_IMG_URL.'ajax-loading.gif'; ?>" /></div>');
		$.ajax({
			url  : '<?php echo $this->Url->build('/users/get_reviews') ?>',
			data : {
				type 		: '<?php echo $type; ?>',
				foreign_key : '<?php echo $id; ?>',
				name 		: '<?php echo $name ?>',
				count 		: '<?php echo $count; ?>',
				avg_rating  : '<?php echo $avg_rating; ?>',
				sort_by 	: val
			},
			type 	 : 'POST',
			dataType : 'json',
			success  : function(r){
				$("#review_div").html(r.data);
			}		
		});
	});
	
	$(document).on('click', '.city-click', function(){
		<?php if(!empty($this->request->session()->read('Auth.User'))){ ?>			
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

});
<?php $this->Html->scriptEnd(); ?>
<div id="review_div"><div class="text-center"><img alt="Loading" src="<?php echo WEBSITE_IMG_URL.'ajax-loading.gif'; ?>" /></div></div>
<?php 

if(!empty($this->request->session()->read('Auth.User'))){ 	
	echo $this->element('edit_review_popup'); 
	echo $this->element('add_review_popup');  ?>

<?php 
}
 $this->Html->scriptStart(array('block' => 'custom_script')); ?>
	$(document).on('click', '.report_span_update', function(e){
		e.preventDefault();
		form_id	=	'report_span_form';
		var error_div_id	=	form_id+'_error_div';
		var error_div		=	$("#"+error_div_id);
		error_div.hide();
		$("#ajax-loader").removeClass('hide');
		var options = {
			type: 'POST',
		<!-- 	dataType:'JSON', -->
			success:function(r){
				$("#ajax-loader").addClass('hide');
				data		=	JSON.parse(r) ;
		
				if(data.success){
					$("#report_span_modal").modal('hide');
				
					
				<!--		$("#succ_popup1").modal();
					notice('Success',data.message,'success');
					// window.location.reload();-->
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

$(window).load(function() {
	$('.jump_review').on('click', function(){

		<?php if(!empty($this->request->session()->read('Auth.User'))){ 
			?>
			var pos = $(document).height() - 900;

			$('html,body').animate({scrollTop: pos }, 600);
			return false;	
		<?php }else{ ?>
			$(".login-pop").trigger('click');
		<?php } ?>
	});	
});

<?php $this->Html->scriptEnd(); ?>