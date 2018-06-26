<?php use Cake\Core\Configure;
$From	=	($type == 'inbox') ? 'From' : 'To'; 
 ?>
	<div class="editTable">
		<table width="100%" border="0" class="list_m">
			<tbody>
			   <tr>
				  <td class="asort"><?php echo $this->Paginator->sort('full_name',$From); ?></td>
				  <td class="asort"><?php echo $this->Paginator->sort('message','Subject'); ?></td>
				  <td class="asort"><?php echo $this->Paginator->sort('created','Date'); ?></td>
				 </tr>
			   <?php $i =	1;
				foreach($allMessage as $message){
					$i = 0; ?>
					<tr>
						<td>
							<div class="checbox">
								<label><input value="<?php echo $message->id; ?>" class="ids" name="delete[]" type="checkbox"><span></span></label>
							</div><i class="readIcon"><img alt="img" src="<?php echo ($type == 'inbox' && empty($message->message_reads)) ? WEBSITE_IMG_URL.'Nic20.png' : WEBSITE_IMG_URL.'Nic21.png' ; ?>"/></i>
							<a data-type="<?php echo $type; ?>" href="javascript:void(0)" data-sender="<?php echo $message->sender_id;?>"data-id="<?php echo $message->id; ?>" class="message_view"><?php echo ($type == 'inbox') ? $message->sender->full_name.' ('.$message->sender->email.')' :  $message->receiver->full_name.' ('.$message->receiver->email.')' ; ?></a>
						</td>
						<td class="word-break"><?php echo $this->Text->truncate($message->message,100); ?></a></td>
						<td><?php echo $message->created->format(Configure::read('Date.'.$Defaultlanguage)); ?></td>
					</tr>
			   <?php 
			   } ?>
			</tbody>
		</table>	
	<?php if($i){ ?>
		<div class="noMessage"><span>No Messages</span></div>
	<?php } ?>
		
		<?php $paginator    =    $this->Paginator; ?>
		<div class="composeBox" style="display:none">
			<?php echo $this->Form->create('User',['url' => '/messages/add','id' => 'message-form','class' => 'css-form']); ?>
			<div id="message-form_error_div"></div>
			<div class="composeTo">
				<?php echo $this->Form->text('name',['placeholder' => 'To','required' => false,'class' => 'autocomplete1']); ?>
				<?php echo $this->Form->hidden('receiver_id',['id' => 'receiver_id']); ?>
			</div>
			<?php echo $this->Form->textarea('message',['placeholder' => 'Message','required' => false,'id' => 'message_box']); ?>
			<input type="submit" class="btn red_btn message_sent" value="Send" data-rel="message-form">
			<?php echo $this->Form->end(); ?>
		 </div>
		 <div class="MessageView"></div>

		<?php echo $this->Form->create('User',['url' => '/messages/add','id' => 'reply-form','class' => 'css-form']); ?>
			<?php echo $this->Form->hidden('receiver_id',['id' => 'receiver_id1']); ?> 
			<?php if($type === 'inbox') { ?>
			<div id="rplyBox" class="block hide">
				<textarea name="message" placeholder="Reply" id="reply_box" rows="5"></textarea>
				 <button id="rplymsg" class="btn red_btn message_reply" data-rel="reply-form" type="submit">
					<?php echo 'Answer'; ?>
				 </button>
			</div>
			<?php } ?>

		 <?php echo $this->Form->end(); ?>
			 
	</div>
	<div class="Pagination_nav list_m">
		<?php if($this->request->params['paging']['Messages']['pageCount'] > 1){ ?>
		<ul class="" id="pagination">	
		<?php
			echo $paginator->prev(__('<i class="fa fa-caret-left"></i>', true),
				array(
					'id'=> 'p_prev',
					'tag'=> 'li',
					'escape'=>false
				),
				null,
				array(
					'class'=>'pagination',
					'escape'=>false,
				   'tag'=> 'li',
					'disabledTag'=>'a'
				)
			);
			echo $paginator->numbers(array(
			   'tag'=> 'li',
				'span'=>false,
				'currentClass' => 'pagination',
				'currentTag' => 'a',
				'separator' => false,
				'class' => "pagination"
				
			));    
			echo $paginator->next(__('<i class="fa fa-caret-right"></i>', true),
				array(
					'id'=> 'p_next',
					'tag'=> 'li',
					'escape'=>false
				),
				null,
				array(
					'class'=>'pagination',
					'escape'=>false,
				   'tag'=> 'li',
					'disabledTag'=>'a'
				)
			);
		?>
		</ul>
		<?php } ?>
	</div>
<script>
	$(".autocomplete1").autocomplete({
		source: function( request, response ) {
			  // New request 300ms after key stroke
			var $this = $(this);
			var $element = $(this.element);
			var previous_request = $element.data( "jqXHR" );
			if( previous_request ) {
				// a previous request has been made.
				// though we don't know if it's concluded
				// we can try and kill it in case it hasn't
				previous_request.abort();
			}
			// Store new AJAX request
			$element.data( "jqXHR", $.ajax({
			  url: "<?php echo $this->Url->build('/users/usersAutocomplate'); ?>",
			  dataType: "json",
			  data: {
				q: request.term
			  },
			  success: function( data ) {
				response( data );
				$(".autocomplete1").removeClass('ui-autocomplete-loading');
			  }
			})
			);		
		  },
		  minLength: 1,
		  select: function( event, ui ) {

			name 		=	ui.item.label;
			cc_fips		=	ui.item.value;
			
			setTimeout(function(){
				$(".autocomplete1").val(ui.item.name);
				$("#receiver_id").val(ui.item.id);
			},2);
			 
			 $("#city_id").val(cc_fips);
		 },
		  open: function() {
			$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
		  },
		  close: function() {
			$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
		  }
	
	}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
			name = item.name;
			email = item.email;
		  return $( "<li'>" )
			.data( "ui-autocomplete-item", item )
			.append("<a href='javascript:void(0)'>" +name+" ("+email+")</a>")
			.appendTo( ul );
	};
	
	
</script>