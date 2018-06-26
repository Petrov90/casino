<?php echo $this->Html->script(array(
		WEBSITE_ADMN_JS_URL.'ckeditor/ckeditor.js',
		WEBSITE_ADMIN_JS_URL.'autocomplete.js'
		),
	array('block' =>'bottom')); 
	 echo $this->Html->css(array(
		WEBSITE_ADMIN_CSS_URL.'autocomplete.css'
		),
	array('block' =>'css')); 
	?>
<div id="page-wrapper" style="min-height: 140px;">
<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>	
	<div class="row">
		<div class="col-lg-6">
			<h1 class="page-header">Update promotion</h1>
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
									<?php echo $this->Form->text("casino_name",array('class' => 'form-control autocomplete','empty' => true,'placeholder' => 'Search Any Casino','value' => $casino->casino->title,'required' => true)); 
									echo $this->Form->hidden("casino_id",array('id' => 'casino_id'));
									echo $this->Form->error("casino_id"); ?>
								</div>
								<div class="form-group">
									<label>Url</label>
									<?php echo $this->Form->text("url",array('class' => 'form-control','placesholder' => 'Url','required' => true)); ?>
									<?php echo $this->Form->error("url"); ?>
								</div>
								
								<div class="form-group">
									<label>Promotion Title</label>
									<?php echo $this->Form->text("title",array('class' => 'form-control','placesholder' => 'Title','ng-model' => 'name','ng-required' => "required",'required' => true)); ?>   
									<?php echo $this->Form->error("title"); ?>
								</div>
									<!-- Add By Ghanshyam-->
								<div class="form-group">
									<label>Bonus Amount </label>
									<?php echo $this->Form->text("b_amount",array('class' => 'form-control','placesholder' => 'Bonus Amount','ng-model' => 'name','required' => true)); ?>   
									<?php echo $this->Form->error("Bonus Amount"); ?>
								</div>
								<div class="form-group">
									<?php //echo $this->Form->select('currency', array('opt1' => 'Choose Currency', 'opt2' => 'USD', 'opt3' => 'EUR', 'opt4' => 'GBP')); ?>
									<?php echo $this->Form->input('Currency', array(
                                        'type' => 'select', 
                                         'class' => 'form-control', 
                                        'options' => array(''=>'Select Currency','USD' => 'USD', 'EUR' => 'EUR','GBP'=>'GBP') 
                                       
                                    )); ?>
									<?php echo $this->Form->error("Currency"); ?>
								</div>
								<!-- End -->
								<?php /* 
								<div class="form-group">
									<label>Description</label>
									<?php //echo $this->Html->script('ckeditor/ckeditor', array('inline' => true));
									 echo $this->Form->textarea("description",array('class' => 'form-control','placeholdder' => 'Description','id' =>'body','required' => true)); ?>
									<?php $this->Html->scriptStart(array('block' => 'custom_script')); ?>
										CKEDITOR.replace( 'body',{} );
									<?php $this->Html->scriptEnd(); ?>
									<?php echo $this->Form->error("description"); ?>
								</div>*/ ?>
								<div class="form-group">
									<label>Small Text 1 To Shown on prmotion table(For Homepage)</label>
									<?php echo $this->Form->text("small_text",array('class' => 'form-control','placesholder' => 'Amount','required' => true)); ?>   
									<?php echo $this->Form->error("small_text"); ?>
								</div>
								<div class="form-group">
									<label>Small Text 2 To Shown on prmotion table(For Homepage)</label>
									<?php echo $this->Form->text("small_text2",array('class' => 'form-control','placesholder' => 'Amount','required' => true)); ?>   
									<?php echo $this->Form->error("small_text2"); ?>
								</div><?php /*
								<div class="form-group">
									<label>Matched Amount</label>
									<?php echo $this->Form->text("matched_amount",array('class' => 'form-control','placesholder' => 'Matched Amount','required' => true)); ?>   
									<?php echo $this->Form->error("matched_amount"); ?>
								</div>*/ ?>
								<div class="form-group">
									<label>Wagering</label>
									<?php echo $this->Form->text("wagering",array('class' => 'form-control','placesholder' => 'Wagering','required' => true)); ?>   
									<?php echo $this->Form->error("wagering"); ?>
								</div>
								<div class="form-group">
									<label>Code</label>
									<?php echo $this->Form->text("code",array('class' => 'form-control','placesholder' => 'Code','required' => true)); ?>   
									<?php echo $this->Form->error("code"); ?>
								</div><?php /*
								
								<div class="form-group">
									<label>Conditions</label>
									<?php echo $this->Form->textarea("conditions",array('class' => 'form-control','placesholder' => 'Conditions','required' => true)); ?>   
									<?php echo $this->Form->error("conditions"); ?>
								</div>*/?>
								<div class="form-group">
									<label>Bonus Type</label>
									<div style="margin-top:10px;" class = "row">
								<?php foreach($bonus_type as $key => $name){ $checked = (is_array($promotion_bonus_types_array) && in_array($key,$promotion_bonus_types_array)) ? 'checked="checked"' : ''; ?>
										<div class="col-lg-4">
											<label for="<?php echo "gambling_options.".$key; ?>" style="margin:7px;font-weight:100;cursor:pointer;width:60%"><?php echo $name ?></label>
											<?php echo $this->Form->checkbox("gambling_options.".$key,array('id' => "gambling_options.".$key,$checked)); ?>
										</div>
								<?php } ?>
									</div>	
									
									<?php echo $this->Form->error("gambling_options"); ?>
								</div>
								<div class="form-group">
									<label>Promotion Message <a href="javascript:void(0);" class="addd">Add more</a> </label>
									<div id="ddd">
										<?php 
									if(!empty($casino->text)){ 
										$tt	=	json_decode($casino->text);
										foreach($tt as $text){ ?>
											<div class="row" style="margin-top:10px">
												 <div class="col-lg-10">
													<?php echo $this->Form->text("text1[]",array('class' => 'form-control','placesholder' => 'Url','required' => true,'value' => $text)); ?>
												 </div>
												 <div class="col-lg-2">
													<a href="javascript:void(0)" class="remove">Delete</a>
												 </div>
											</div>
										<?php }
										}else{
											?>
											<div class="row">
												 <div class="col-lg-10">
													<?php echo $this->Form->text("text1[]",array('class' => 'form-control','placesholder' => 'Url','required' => true)); ?>
												 </div>											 
												 <div class="col-lg-2">
													<a href="javascript:void(0)" class="remove">Delete</a>
												 </div>
											</div>											
											<?php											
										} ?>
										<span style="color:red" id="errrr"></span>
									</div>
									
									<?php echo $this->Form->error("text1"); ?>
								</div>
								<div class="form-group">
									<label>Casino logo (Optional)</label>
									<?php echo $this->Form->file("logo"); ?>   
									<?php echo $this->Form->error("logo"); ?>
									<?php 
						if((PROMOTION_CASINO_LOGO_ROOT_PATH.$casino->logo)){
							echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.PROMOTION_CASINO_LOGO_IMG_URL.$casino->logo);
						} ?>
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
			return true;
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