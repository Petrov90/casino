<?php $this->Html->scriptStart(array('block' => 'custom_script')); ?>
$(function(){
	$.ajax({
		url  : '<?php echo WEBSITE_URL.'questions/index' ?>',
		data : {
			type 		: '<?php echo $type; ?>',
			foreign_key : '<?php echo $id; ?>',
			name 		: '<?php echo str_replace("'","",$name); ?>',
			count 		: '<?php echo $count; ?>'
		},
		type : 'POST',
		dataType : 'json',
		success : function(r){
			$("#review_div_<?php echo $id.'_'.$type ?>").html(r.data);
		}		
	});
	$(document).on('click', '.report_as_spam', function(){		
		<?php if(empty($this->request->session()->read('Auth.User'))){ ?>
			$(".login-pop").trigger('click');
		<?php }else{ ?>			
				$("#report_span_modal").modal('show');			
		<?php } ?>		
	});
	$(document).on('click', '.r-btn1', function(){
		id		=	$(this).attr('data-id');
		type	=	$(this).attr('data-type');
		value	=	$("#"+type+id).val();
		value	=	value.trim();
		if(value == '' || value == ' '){
			$("#"+type+id).addClass('border-red');
			return false;
		}
		$("#"+type+id).removeClass('border-red');
		
		$.ajax({
			url  : '<?php echo WEBSITE_URL.'questions/update' ?>',
			data : {
				type 	: type,
				value 	: value,
				id	 	: id
			},
			type 	 : 'POST',
			dataType : 'json',
			success  : function(r){
				if(r.success){
					$("#"+type+'text'+id).html(r.value);
					notice('Success',r.message,'success');
					
					$('#'+type+'hhh'+id).hide('slow');
					$('#'+type+'ppp'+id).show('slow');
				}else{
					notice('Error',r.message,'error');					
				}
			}		
		});
		
	});
	$(document).on('click', '.edit-q-c', function(){
		id		=	$(this).attr('data-id');
		type	=	$(this).attr('data-type');
		$("#"+type+"ppp"+id).hide();
		$("#"+type+"hhh"+id).show();
	});
	$(document).on('change', '.sort_by1', function(){
		val	 =	$(this).val();
		$("#review_div_<?php echo $id.'_'.$type ?>").html('<div class="text-center"><img alt="Loading" src="<?php echo WEBSITE_IMG_URL.'ajax-loading.gif'; ?>" /></div>');
		$.ajax({
			url  : '<?php echo WEBSITE_URL.'questions/index' ?>',
			data : {
				type 		: '<?php echo $type; ?>',
				foreign_key : '<?php echo $id; ?>',
				name 		: '<?php echo str_replace("'","",$name); ?>',
				count 		: '<?php echo $count; ?>',
				sort_by 	: val
			},
			type 	 : 'POST',
			dataType : 'json',
			success  : function(r){
				$("#review_div_<?php echo $id.'_'.$type ?>").html(r.data);
			}		
		});
	});
	
	$(document).on('click', '.add_question', function(){
		<?php if(!empty($this->request->session()->read('Auth.User'))){ ?>			
			type		=	$(this).attr('data-type');
			name		=	$(this).attr('data-name');
			id			=	$(this).attr('data-id');
			$("#AddCommentPopup").show('slow');
			$("#type1").val(type);
			$("#foreign_key1").val(id);		
		<?php }else{ ?>
			$(".login-pop").trigger('click');
		<?php } ?>
	});
});
<?php $this->Html->scriptEnd(); ?>
<div id="mydivqa" atrb="hello"><div id="review_div_<?php echo $id.'_'.$type ?>"></div></div>