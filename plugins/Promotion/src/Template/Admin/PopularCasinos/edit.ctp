<?php echo $this->Html->script(array(
		WEBSITE_ADMN_JS_URL.'ckeditor/ckeditor.js',
		WEBSITE_ADMIN_JS_URL.'autocomplete.js'
		),
	array('block' =>'bottom')); 
	 echo $this->Html->css(array(
		WEBSITE_ADMIN_CSS_URL.'autocomplete.css'
		),
	array('block' =>'css')); ?>
<div id="page-wrapper" style="min-height: 140px;">
	<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>	
	<div class="row">
		<div class="col-lg-6">
			<h1 class="page-header">Add popular casino</h1>
		</div>
		<div class="col-lg-6">
			<?php echo $this->Html->link('Back',array('action' => 'index'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?php echo $this->Form->create($casino,['type' => 'file']); ?>
								<div class="form-group">
									<label>Casino</label>
									<?php echo $this->Form->text("text",array('class' => 'form-control autocomplete','empty' => false,'placeholder' => 'Search Any Casino','required' => true)); 
									echo $this->Form->hidden("casino_id",array('id' => 'casino_id'));
									echo $this->Form->error("casino_id"); ?>
								</div>	
								<?php echo $this->Form->hidden("url",array('class' => 'form-control','value' => 'Url','required' => true,'id' => 'url1')); ?>
								<div class="form-group">
									<label>Name</label>
									<?php echo $this->Form->text("text",array('class' => 'form-control','placesholder' => 'Title','ng-model' => 'name','required' => true,'id' => 'text')); ?>   
									<?php echo $this->Form->error("text"); ?>
								</div>								
								<div class="form-group">
									<label>Image</label>
									<?php echo $this->Form->file("logo",['required' => false]); 
									if(!empty($casino->logo) && (PROMOTION_CASINO_LOGO_ROOT_PATH.$casino->logo)){
											echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.PROMOTION_CASINO_LOGO_IMG_URL.$casino->logo);
										}?>   
									<?php echo $this->Form->error("logo"); ?>
								</div>							
								<button class="btn btn-default" type="submit">Save</button>
								<button class="btn btn-default" type="reset">Reset</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php  
$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
$(function () {	
	$(".addd").click(function(){
		$("#ddd").append('<div style="margin-top:10px" class="row"><div class="col-lg-10"><?php echo $this->Form->text("text1[]",array('class' => 'form-control','placesholder' => '','value' => '','required' => true)); ?></div><div class="col-lg-2"><a href="javascript:void(0)" class="remove">Delete</a></div></div>');
	});
	
	$(document).on('click', '.remove', function(e) {
		len 	=	$("#ddd .row").size();		
		if(len == 1){
			$("#errrr").html('Atleast one message is required');
			return false;
		}
		$(this).parent().parent().remove();
		
	});
	
	$(".autocomplete").autocomplete({
		source: function( request, response ) {
			$.ajax({
			  url: "<?php echo $this->Url->build(array('action' => 'city_autocomplete')); ?>",
			  dataType: "json",
			  data: {
				q: request.term
			  },
			  success: function( data ) {
				response( data );
			  }
			});
		  },
		  minLength: 1,
		  select: function( event, ui ) {
			id 		=	ui.item.id;
			setTimeout(function(){
				$(".autocomplete").val(ui.item.title);
			},2);
			 
			 $("#casino_id").val(id);
			 $("#text").val(ui.item.title);
			 $("#url1").val(ui.item.url);
		 },
		  open: function() {
			$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
		  },
		  close: function() {
			$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
		  }
	
	}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
		
		 return $( "<li>" )
		.data( "ui-autocomplete-item", item )
		.append("<a href=javascript:void(0);>" + item.title + "</a>")
		.appendTo( ul );
	};
});
<?php $this->Html->scriptEnd(); ?>