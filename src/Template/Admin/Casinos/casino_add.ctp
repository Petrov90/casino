<?php echo $this->Html->script(array(
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
			<h1 class="page-header">Add new online casino</h1>
		</div>
		<div class="col-lg-6">
			<?php echo $this->Html->link('Back',array('action' => 'casino'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12" ng-app="plunker"  ng-controller="MainCtrl">
							<?php echo $this->Form->create($casino,array('type' => 'file','novalidate' => true)); ?>
								<div class="form-group">
									<label>Title</label>
									<?php echo $this->Form->text("title",array('class' => 'form-control c_title','placesholder' => 'Title','ng-model' => 'name','ng-required' => "required")); ?>   
									<?php echo $this->Form->error("title"); ?>
								</div>					
								<div class="form-group" id="c_title">
									<label>Slug</label>
									<?php echo $this->Form->text("slug",array('class' => 'form-control','id' => 'c_title1','required' => false));
									echo $this->Form->error("slug"); ?>
								</div>	
								<div class="form-group">
									<label class="ddd">Restricated Country</label>
										<div style="margin-top:10px;" class = "row">
									<?php  foreach($country as $key => $name){
									 ?>
											 <div class="col-lg-4">
												<label for="<?php echo "country_id1.".$key; ?>" style="margin:7px;cursor:pointer; font-weight: unset;"><?php echo $name ?></label>
											
												<?php echo $this->Form->checkbox("country_id1.".$key,array('id' => "country_id1.".$key)); ?>
											 </div>
									 
									 <?php
									} ?>
										 </div>
								</div>
								<div class="form-group">
									<label>Owner</label>
									<?php echo $this->Form->text("owner",array('class' => 'form-control','empty' => false,'required' => false)); ?>
									<?php echo $this->Form->error("owner"); ?>
								</div><?php /*
								<div class="form-group">
									<label>Owner</label>
									<?php echo $this->Form->select("owner",$owner,array('class' => 'form-control','empty' => false,'required' => false)); ?>
									<?php echo $this->Form->error("owner"); ?>
								</div>*/?>
								<div class="form-group">
									<label>Established</label>
									<?php 
									for($i = (date('Y')-30) ; $i <= date('Y'); $i++){
										$established[$i]	=	$i;
									}
									echo $this->Form->select("established",$established,array('class' => 'form-control','placesholder' => 'Address','rows' => '1','required' => false)); ?>
									<?php echo $this->Form->error("established"); ?>
								</div>
								<div class="form-group">
									<label>Live Chat</label>
									<?php echo $this->Form->select("live_chat",$live_chat,array('class' => 'form-control','empty' => false,'required' => false)); ?>
									<?php echo $this->Form->error("live_chat"); ?>
								</div>
								<div class="form-group">
									<label>Manual flushing</label>
									<?php echo $this->Form->select("manual_flushing",$manual_flushing,array('class' => 'form-control','empty' => false,'required' => false)); ?>
									<?php echo $this->Form->error("manual_flushing"); ?>
								</div>
								<div class="form-group">
									<label>Payout percentage</label>
									<?php echo $this->Form->text("payout_percentage",array('class' => 'form-control',)); ?>
									<?php echo $this->Form->error("payout_percentage"); ?>
									<span>like 80% (without %)</span>
								</div>
								<div class="form-group">
									<label>Payout speed</label><br/>
									<p style=" display:inline-flex"><?php echo $this->Form->number("min_time",array('class' => 'form-control heyakshay','style' => 'width : 25%','placeholder' => 'Min time','id' => 'min1')); ?> <?php echo $this->Form->select("type1",array('hour' => 'Hour','day' => 'Day'),array('class' => 'form-control heyakshay','style' => 'width : 25%','placeholder' => 'Min time','id' => 'min2')); ?> <?php echo $this->Form->number("max_time",array('class' => 'form-control heyakshay','style' => 'width : 25%','placeholder' => 'Max time','id' => 'min3')); ?> <?php echo $this->Form->select("type2",array('hour' => 'Hour','day' => 'Day'),array('class' => 'form-control heyakshay','style' => 'width : 25%','placeholder' => 'Min time','id' => 'min4')); ?></p>
									<?php echo $this->Form->error("min_time"); ?>
								</div>
								<div class="form-group">
									<label>First Description</label>
									<?php //echo $this->Html->script('ckeditor/ckeditor', array('inline' => false));
									 echo $this->Form->textarea("sdescription",array('class' => 'form-control','placeholdder' => 'Description','id' =>'body1')); ?>
					<?php $this->Html->scriptStart(array('block' => 'custom_script')); ?>
						CKEDITOR.replace( 'body1',{} );
					<?php $this->Html->scriptEnd(); ?>
					<?php echo $this->Form->error("sdescription"); ?>
								</div>
								<div class="form-group">
									<label>Second Description</label>
									<?php //echo $this->Html->script('ckeditor/ckeditor', array('inline' => false));
									 echo $this->Form->textarea("description",array('class' => 'form-control','placeholdder' => 'Description','required' => false,'id' =>'body')); ?>
					<?php $this->Html->scriptStart(array('inline' => false,'block' => 'custom_script')); ?>
						CKEDITOR.replace( 'body',{} );
					<?php $this->Html->scriptEnd(); ?>
					<?php echo $this->Form->error("description"); ?>
								</div>
								<div class="form-group">
									<label>Third Description</label>
									<?php //echo $this->Html->script('ckeditor/ckeditor', array('inline' => false));
									 echo $this->Form->textarea("tdescription",array('class' => 'form-control','placeholdder' => 'Description','required' => false,'id' =>'tdescription')); ?>
					<?php $this->Html->scriptStart(array('inline' => false,'block' => 'custom_script')); ?>
						CKEDITOR.replace( 'tdescription',{} );
					<?php $this->Html->scriptEnd(); ?>
					<?php echo $this->Form->error("tdescription"); ?>
								</div>
								<div class="form-group">
									<label>Fourth Description</label>
									<?php //echo $this->Html->script('ckeditor/ckeditor', array('inline' => false));
									 echo $this->Form->textarea("fdescription",array('class' => 'form-control','placeholdder' => 'Description','required' => false,'id' =>'fdescription')); ?>
					<?php $this->Html->scriptStart(array('inline' => false,'block' => 'custom_script')); ?>
						CKEDITOR.replace( 'fdescription',{} );
					<?php $this->Html->scriptEnd(); ?>
					<?php echo $this->Form->error("fdescription"); ?>
								</div>
								<div class="form-group">
									<label>Affiliate Url</label>
									<?php echo $this->Form->text("url",array('class' => 'form-control','placesholder' => 'Affiliate Url','required' => false)); ?>
									<?php echo $this->Form->error("url"); ?>
								</div><?php /*
								<div class="form-group">
									<label>Email</label>
									<?php echo $this->Form->text("email",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
									<?php echo $this->Form->error("email"); ?>
								</div>
								<div class="form-group">
									<label>Phone</label>
									<?php echo $this->Form->text("phone",array('class' => 'form-control','placesholder' => 'Phone','required' => false)); ?>
									<?php echo $this->Form->error("phone"); ?>
								</div>*/ ?>
								
								<div class="form-group">
									<label class="ddd">Gambling Options</label>
										<div style="margin-top:10px;" class = "row">
									<?php  foreach($gambling_options as $key => $name){	 ?>
											 <div class="col-lg-4">
												<label for="<?php echo "gambling_options.".$key; ?>" style="margin:7px;cursor:pointer; font-weight: unset;"><?php echo $name ?></label>
											
												<?php echo $this->Form->checkbox("gambling_options.".$key,array('id' => "gambling_options.".$key)); ?>
											 </div>									 
									 <?php
									} ?>
										 </div>
								</div>
								<div class="form-group">
									<label class="ddd">Devices</label>
										<div style="margin-top:10px;" class = "row">
									<?php  foreach($devices as $key => $name){
									 ?>
											 <div class="col-lg-4">
												<label for="<?php echo "devices.".$key; ?>" style="margin:7px;cursor:pointer; font-weight: unset;"><?php echo $name ?></label>
											
												<?php echo $this->Form->checkbox("devices.".$key,array('id' => "devices.".$key)); ?>
											 </div>
									 
									 <?php
									} ?>
										 </div>
								</div>
								<div class="form-group">
									<label class="ddd">Currencies</label>
										<div style="margin-top:10px;" class = "row">
									<?php  foreach($currencies as $key => $name){
									 ?>
											 <div class="col-lg-4">
												<label for="<?php echo "currencies.".$key; ?>" style="margin:7px;cursor:pointer; font-weight: unset;"><?php echo $name ?></label>
												<?php echo $this->Form->checkbox("currencies.".$key,array('id' => "currencies.".$key)); ?>
											 </div>
									 
									 <?php
									} ?>
										 </div>
								</div>
								
								<div class="form-group">
									<label class="ddd">Language</label>
										<div style="margin-top:10px;" class = "row">
									<?php  foreach($language as $key => $name){
									 ?>
											 <div class="col-lg-4">
												<label for="<?php echo "language.".$key; ?>" style="margin:7px;cursor:pointer; font-weight: unset;"><?php echo $name ?></label>
												<?php echo $this->Form->checkbox("language.".$key,array('id' => "language.".$key)); ?>
											 </div>
									 
									 <?php
									} ?>
										 </div>
								</div>
								
								<div class="form-group">
									<label class="ddd">Software</label>
										<div style="margin-top:10px;" class = "row">
									<?php  foreach($software as $key => $name){
									 ?>
											 <div class="col-lg-4">
												<label for="<?php echo "software.".$key; ?>" style="margin:7px;cursor:pointer; font-weight: unset;"><?php echo $name ?></label>
											
												<?php echo $this->Form->checkbox("software.".$key,array('id' => "software.".$key)); ?>
											 </div>
									 
									 <?php
									} ?>
										 </div>
								</div>
								<div class="form-group">
									<label class="ddd">Deposit methods</label>
										<div style="margin-top:10px;" class = "row">
									<?php  foreach($deposit_methods as $key => $name){
									 ?>
											 <div class="col-lg-4">
												<label for="<?php echo "deposit_methods.".$key; ?>" style="margin:7px;cursor:pointer; font-weight: unset;"><?php echo $name ?></label>
												<?php echo $this->Form->checkbox("deposit_methods.".$key,array('id' => "deposit_methods.".$key)); ?>
											 </div>
									 
									 <?php
									} ?>
										 </div>
								</div>
								<div class="form-group">
									<label class="ddd">Withdrawal methods</label>
										<div style="margin-top:10px;" class = "row">
									<?php  foreach($withdrawal_methods as $key => $name){ ?>
											 <div class="col-lg-4">
												<label for="<?php echo "withdrawal_methods.".$key; ?>" style="margin:7px;cursor:pointer; font-weight: unset;"><?php echo $name ?></label>
												<?php echo $this->Form->checkbox("withdrawal_methods.".$key,array('id' => "withdrawal_methods.".$key)); ?>
											 </div>
									 
									 <?php
									} ?>
										 </div>
								</div>
								<div class="form-group">
									<label class="ddd">Licences</label>
										<div style="margin-top:10px;" class = "row">
									<?php  foreach($licences as $key => $name){	 ?>
											 <div class="col-lg-4">
												<label for="<?php echo "licences.".$key; ?>" style="margin:7px;cursor:pointer; font-weight: unset;"><?php echo $name ?></label>
												<?php echo $this->Form->checkbox("licences.".$key,array('id' => "licences.".$key)); ?>
											 </div>							 
									 <?php	} ?>
										 </div>
								</div>
								<div class="form-group">
									<label class="ddd">Withdrawal limit</label>
										<div style="margin-top:10px;" class = "row">
									<?php  foreach($withdrawal_limit as $key => $name){
									 ?>
											 <div class="col-lg-4">
												<label for="<?php echo "withdrawal_limit.".$key; ?>" style="margin:7px;cursor:pointer; font-weight: unset;"><?php echo $name ?></label>
												<?php echo $this->Form->checkbox("withdrawal_limit.".$key,array('id' => "withdrawal_limit.".$key)); ?>
											 </div>
									 
									 <?php
									} ?>
										 </div>
								</div>
								
								<div class="form-group">
									<label>Meta Description</label>
									<?php echo $this->Form->textarea("meta_description",array('class' => 'form-control','placesholder' => 'Meta Description','rows' => '1')); ?>
									<?php echo $this->Form->error("meta_description"); ?>
								</div>
								<div class="form-group">
									<label>Pros<a href="javascript:void(0);" class="pros">Add more</a> </label>
									<div id="pros_add">
										<?php if(!empty($this->request->data['pros'])){ 
										foreach($this->request->data['pros'] as $text){ ?>
											<div class="row" style="margin-top:10px">
												 <div class="col-lg-10">
													<?php echo $this->Form->text("pros[]",array('class' => 'form-control','placesholder' => 'Url','required' => false,'value' => $text)); ?>
												 </div>
												 <div class="col-lg-2">
													<a href="javascript:void(0)" class="pros_remove">Delete</a>
												 </div>
											</div>
										<?php }
										}else{
											?>
											<div class="row">
												 <div class="col-lg-10">
													<?php echo $this->Form->text("pros[]",array('class' => 'form-control','placesholder' => 'Url','required' => false)); ?>
												 </div>											 
												 <div class="col-lg-2">
													<a href="javascript:void(0)" class="pros_remove">Delete</a>
												 </div>
											</div>											
											<?php											
										} ?>
										<span style="color:red" id="pros_errrr"></span>
									</div>
									
									<?php echo $this->Form->error("pros"); ?>
								</div>
								<div class="form-group">
									<label>Cons<a href="javascript:void(0);" class="cons">Add more</a> </label>
									<div id="cons_add">
										<?php if(!empty($this->request->data['cons'])){ 
										foreach($this->request->data['cons'] as $text){ ?>
											<div class="row" style="margin-top:10px">
												 <div class="col-lg-10">
													<?php echo $this->Form->text("cons[]",array('class' => 'form-control','placesholder' => 'Url','required' => false,'value' => $text)); ?>
												 </div>
												 <div class="col-lg-2">
													<a href="javascript:void(0)" class="cons_remove">Delete</a>
												 </div>
											</div>
										<?php }
										}else{
											?>
											<div class="row">
												 <div class="col-lg-10">
													<?php echo $this->Form->text("cons[]",array('class' => 'form-control','placesholder' => 'Url','required' => false)); ?>
												 </div>											 
												 <div class="col-lg-2">
													<a href="javascript:void(0)" class="cons_remove">Delete</a>
												 </div>
											</div>											
											<?php											
										} ?>
										<span style="color:red" id="cons_errrr"></span>
									</div>	
									<?php echo $this->Form->error("cons"); ?>
								</div>			
								<div class="form-group">
									<label>Rating</label>
									<span data-score="<?php echo (!empty($casino->our_rating)) ? $casino->our_rating : 3; ?>" class="jrating111"></span>
									<?php echo $this->Form->error("our_rating"); ?>
								</div><?php /*
								<div class="form-group">
									<label>Review</label>
									<?php echo $this->Form->textarea("review",array('class' => 'form-control','placesholder' => 'Meta Description','rows' => '5')); ?>
									<?php echo $this->Form->error("review"); ?>
								</div>*/?>
								<div class="form-group">
									<label>Casino logo</label>
									<?php echo $this->Form->file("logo",['required' => true]); ?>   
									<?php echo $this->Form->error("logo"); ?>
								</div>
								<div class="form-group">
									<label>Casino Image</label>
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
<?php  
echo $this->Html->css(array('jquery.raty.css'),array('block' =>'css'));

echo $this->Html->script(array('jquery.raty.js'),array('block' =>'bottom'));
// echo $this->Html->script(array('angular.min.js'),array('block' =>'angular'));
 $this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
$('.jrating111').raty({
		scoreName : 'our_rating',
		score: function() {
			return $(this).attr('data-score');
		}
	});
	$(".pros").click(function(){
		$("#pros_add").append('<div style="margin-top:10px" class="row"><div class="col-lg-10"><?php echo $this->Form->text("pros[]",array('class' => 'form-control','placesholder' => '','value' => '','required' => false)); ?></div><div class="col-lg-2"><a href="javascript:void(0)" class="pros_remove">Delete</a></div></div>');
	});
	$(".cons").click(function(){
		$("#cons_add").append('<div style="margin-top:10px" class="row"><div class="col-lg-10"><?php echo $this->Form->text("cons[]",array('class' => 'form-control','placesholder' => '','value' => '','required' => false)); ?></div><div class="col-lg-2"><a href="javascript:void(0)" class="cons_remove">Delete</a></div></div>');
	});	
	$(document).on('change', '.heyakshay', function(e) {
		
		min1 = $("#min1").val();
		min2 = $("#min2").val();
		min3 = $("#min3").val();
		min4 = $("#min4").val();
		if(min2 == 'hour'){
			mintime = min1*3600;
		}else{
			mintime = min1*3600*24;
		}
		
		if(min4 == 'hour'){
			maxtime = min3*3600;
		}else{
			maxtime = min3*3600*24;
		}
		/* if(maxtime < mintime){
			$("#min4").addClass('border-red');
			$("#min3").addClass('border-red');
		} */
	});
	
	$(document).on('click', '.cons_remove', function(e) {
		/* len 	=	$("#cons_add .row").size();		
		if(len == 1){
			$("#cons_errrr").html('Atleast one message is required');
			return true;
		} */
		$(this).parent().parent().remove();		
	}); 
	$(document).on('click', '.pros_remove', function(e) {
		/* len 	=	$("#pros_add .row").size();		
		if(len == 1){
			$("#pros_errrr").html('Atleast one message is required');
			return true;
		} */
		$(this).parent().parent().remove();		
	}); 
	

$(function () {
   
	$(".autocomplete").autocomplete({
		source: function( request, response ) {
			$.ajax({
			  url: "<?php echo $this->Url->build(array('action' => 'city_autocomplete')); ?>",
			  dataType: "json",
			  data: {
				q: request.term+'&'+$("#Countries").val()
			  },
			  success: function( data ) {
				response( data );
			  }
			});
		  },
		  minLength: 1,
		  select: function( event, ui ) {

			name 	=	ui.item.name;
			id 		=	ui.item.id;
			
			setTimeout(function(){
				$(".autocomplete").val(ui.item.name);
			},100);
			 
			 $("#city_id").val(id);
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
		.append("<a href=javascript:void(0);>" + item.name + "</a>")
		.appendTo( ul );
	};
});

 var slug = function(str) {
    var $slug = '';
    var trimmed = $.trim(str);
    $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
    replace(/-+/g, '-').
    replace(/^-|-$/g, '');
    return $slug.toLowerCase();
}
$(".c_title").keyup(function(){
	$('#c_title').removeClass('hide');	
	$('#c_title1').val(slug($(this).val()));	
});
<?php $this->Html->scriptEnd(); ?>
<style>
.col-lg-4 > label {
    width: 50%;
}
.border-red {
    border-color: red;
}
</style>