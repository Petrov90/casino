<?php use Cake\Core\Configure;
echo $this->Html->script(array(
		WEBSITE_ADMN_JS_URL.'ckeditor/ckeditor.js',
		// WEBSITE_URL.'uploader/assets/js/jquery.js',
		WEBSITE_URL.'uploader/assets/js/jquery-ui-custom.js',
		WEBSITE_URL.'uploader/assets/js/fileupload.js',
		WEBSITE_URL.'uploader/assets/js/lightbox-2.6.min.js',
		WEBSITE_URL.'uploader/assets/js/custom_js.js',
		WEBSITE_ADMIN_JS_URL.'autocomplete.js'
		),
	array('block' =>'bottom')); 
	 echo $this->Html->css(array(
		WEBSITE_ADMIN_CSS_URL.'autocomplete.css', 
		WEBSITE_URL.'uploader/assets/css/style.css',
		WEBSITE_URL.'uploader/assets/css/lightbox.css'
		),
	array('block' =>'css')); 
	?>
<div id="page-wrapper" style="min-height: 140px;">
<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>	
	<div class="row">
		<div class="col-lg-6">
			<h1 class="page-header">Update aminities</h1>
		</div>
		<div class="col-lg-6">
			<?php echo $this->Html->link('Back',array('action' => 'index'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?php echo $this->Form->create($casino,array('type' => 'file','novalidate' => true)); ?>
								<!-- <div class="form-group">
									<label>Parent</label>
									<?php echo $this->Form->select("casino_id",$totalCasinolist,array('class' => 'form-control','empty' => 'Select Casino','required' => false)); ?>
									<?php echo $this->Form->error("casino_id"); ?>
									
								</div> -->
								<?php $Casinodetails = $this->SocialShare->casinodetails($casino->casino_id);?>
								<div class="form-group">
									<label>Casino</label>
									<?php echo $this->Form->text("text",array('class' => 'form-control autocomplete','empty' => false,'placeholder' => 'Search Any Casino','value'=>$Casinodetails->title,'required' => true)); 
									echo $this->Form->hidden("casino_id",array('id' => 'casino_id','value'=>$casino->casino_id));
									echo $this->Form->error("casino_id"); ?>
								</div>
								<div class="form-group">
									<label>Parent</label>
									<?php echo $this->Form->select("parent_id",$parentMasters,array('class' => 'form-control c_title','empty' => 'Select Parent','required' => false)); ?>
									<?php echo $this->Form->error("parent_id"); ?>
								</div>
								<div class="form-group">
									<label>Title</label>
									<?php echo $this->Form->text("title",array('class' => 'form-control ','placesholder' => 'Title','ng-model' => 'name','ng-required' => "required")); ?>   
									<?php echo $this->Form->error("title"); ?>
								</div>
							<div id="test_01" class="<?php echo (empty($casino->parent_id)) ? 'hide' : ''; ?>">
								<div class="form-group">
									<label>Description</label>
									<?php
									 echo $this->Form->textarea("description",array('class' => 'form-control','placeholdder' => 'Description','required' => false,'id' =>'body')); ?>
									<?php $this->Html->scriptStart(array('inline' => false,'block' => 'custom_script')); ?>
										CKEDITOR.replace( 'body',{} );
									<?php $this->Html->scriptEnd(); ?>
									<?php echo $this->Form->error("description"); ?>
								</div>
								<h4>Amenities Info(All fields are optional)</h4>
								<div style="border: 1px solid;margin-bottom: 2%;padding: 2%;">
								<?php foreach($amenitiesInfo as $key => $name){ ?>
								<div class="form-group">
									<label><?php echo $name; ?></label>
									<?php echo $this->Form->text("info.".$key,array('class' => 'form-control','empty' => false,'required' => false)); ?>
								</div>
								<?php } ?>
								</div>								
								<h4>Schedule</h4>
								<div style="border: 1px solid;margin-bottom: 2%;padding: 2%;">
								<div class="form-group">
									<label>All Days 24 hour <span class="float-right"><?php echo $this->Form->checkbox("all_day"); ?></span></label>									
								</div>
								<?php 
								// pr($this->request);
								$arr = Configure::read('weekday');
								foreach($arr as $key => $name){ ?>
									<div class="form-group">
										<label><?php echo $name; ?></label>
										<div>
										<?php echo $this->Form->text("schedule.".$key.".from",array('class' => 'w10','placeholder' => '10:00 AM')); ?><span class="w101">/</span><?php echo $this->Form->text("schedule.".$key.".to",array('class' => 'w10','placeholder' => '12:00 PM')); ?>
										<?php echo $this->Form->checkbox("schedule.".$key.".all_day"); ?>(Check the checkbox For Full Day)
										</div>
									</div>
								<?php } ?>
								</div>
								<div class="form-group">
									<label>Image</label>
									 <div id="container">
										<?php 
										$object_id = rand(1000000,99999999);
										if(!empty($casino->object_id)){
											$object_id = $casino->object_id;
										}
										$user_id = ADMIN_ID;   
										$type_id = 1;
										add_uploader($object_id , $user_id, $type_id);
										echo $this->Form->hidden("object_id",array("value" => $object_id)); ?> 
									</div>
									<?php echo $this->Form->error("object_id"); ?>
								</div>	
							</div>
								<button class="btn btn-default" type="submit">Save</button>
								<button class="btn btn-default" type="reset">Reset</button>
							</form>
						</div>
						<!-- /.col-lg-6 (nested) -->
					</div>
					<!-- /.row (nested) -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>

<script>WEBSITE_UPLOADS_URL = '<?php echo WEBSITE_URL; ?>';</script>
<?php  $this->Html->scriptStart(array('block' => 'custom_script')); ?>
$(".c_title").change(function(){
	val = $(this).val();
	if(val){
		$("#test_01").removeClass('hide');
	}else{
		$("#test_01").addClass('hide');
		
	}
});
<?php $this->Html->scriptEnd(); ?>
<style>
.w101{width:10%;padding:2%}
.w10{width:10%;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
    color: #555;
    /* display: block; */
    font-size: 14px;
    height: 34px;
    line-height: 1.42857;
    padding: 6px 12px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
}
</style>
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