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
			<h1 class="page-header">Edit casino</h1>
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
						<div class="col-lg-12" ng-app="plunker"  ng-controller="MainCtrl">
							<?php							
							if($error){
								echo $this->Form->create($casino,array('role' => 'form','type' => 'file','novalidate' => true));
							}else{
								echo $this->Form->create($realCasino,array('role' => 'form','type' => 'file','novalidate' => true));
								
							}	?>
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
									<label>Country</label>
									<?php echo $this->Form->select("country_id",$country,array('class' => 'form-control country_id','empty' => 'Select country','id' => 'Countries')); ?>
									<?php echo $this->Form->error("country_id"); ?>									
									<label>Country : <?php echo $realCasino->country_name ?></label>
								</div>
								<div class="form-group">
									<label>State</label>
									<?php echo $this->Form->text("state_name",array('class' => 'form-control','value' => $realCasino->state_name)); ?>
									<?php echo $this->Form->error("state_name"); ?>
									<label>State : <?php echo $realCasino->state_name ?></label>
								</div>
								<div class="form-group">
									<label>City</label>
									<?php echo $this->Form->text("city_name",array('class' => 'form-control autocomplete','empty' => false)); ?>
									<?php echo $this->Form->hidden("country_name",array('id' => 'country_name')); ?>
									<?php echo $this->Form->hidden("city_id",array('id' => 'city_id')); ?>
									
									<?php echo $this->Form->error("city_id"); ?>
								</div>
								<div class="form-group">
									<label>Address</label>
									<?php echo $this->Form->textarea("address",array('class' => 'form-control','placesholder' => 'Address','rows' => '1','value' => trim($realCasino->address))); ?>
									<?php echo $this->Form->error("address"); ?>
								</div>
								<div class="form-group">
									<label>Short Description</label>
									<?php //echo $this->Html->script('ckeditor/ckeditor', array('inline' => false));
									 echo $this->Form->textarea("sdescription",array('class' => 'form-control','placeholdder' => 'Description','id' =>'body1')); ?>
					<?php $this->Html->scriptStart(array('block' => 'custom_script')); ?>
						CKEDITOR.replace( 'body1',{} );
					<?php $this->Html->scriptEnd(); ?>
					<?php echo $this->Form->error("sdescription"); ?>
								</div>
								<div class="form-group">
									<label>Full Description</label>
									<?php //echo $this->Html->script('ckeditor/ckeditor', array('inline' => false));
									 echo $this->Form->textarea("description",array('class' => 'form-control','placeholdder' => 'Description','id' =>'body')); ?>
									<?php $this->Html->scriptStart(array('inline' => false,'block' => 'custom_script')); ?>
										CKEDITOR.replace( 'body',{} );
									<?php $this->Html->scriptEnd(); ?>
									<?php echo $this->Form->error("description"); ?>
								</div>
								<div class="form-group">
									<label>Official Website</label>
									<?php echo $this->Form->text("url",array('class' => 'form-control','placesholder' => 'Official Website','required' => false)); ?>
									<?php echo $this->Form->error("url"); ?>
								</div>
								<div class="form-group">
									<label>Email</label>
									<?php echo $this->Form->text("email",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
									<?php echo $this->Form->error("email"); ?>
								</div>
								<div class="form-group">
									<label>Phone</label>
									<?php echo $this->Form->text("phone",array('class' => 'form-control','placesholder' => 'Phone','required' => false,'value' => $realCasino->phone)); ?>
									<?php echo $this->Form->error("phone"); ?>
								</div>
								<div class="form-group">
									<label>Amenities</label>
									<ul>
									<?php foreach($amenities as $ame){ 
										$id				=	$ame->id;  	
										$li				=	'';
										$mainChecked	=	false;
										$mainCheckedDis	=	false;
										$count	=	count($ame->child_masters);										
										foreach($ame->child_masters as $key => $child_masters ){
											$isChecked	=	(!empty($casino_amenities) && in_array($child_masters->id,$casino_amenities)) ? 'checked="checked"' : '' ;
											
											if(!empty($casino_amenities) && in_array($child_masters->id,$casino_amenities)){
												$isChecked	=	'checked="checked"';
												if($key+1 == $count){
													$mainChecked	=	'checked="checked"';
												}else{
													$mainCheckedDis	=	true;
												}
											}else{
												$isChecked	=	'';
											}
											$li	.=
											'<li>
												<label for="amenities_child.'.$child_masters->id.'" class="checkbox">
												'.$this->Form->checkbox("amenities.".$ame->id.".".$child_masters->id,array('id' => "amenities_child.".$child_masters->id,$isChecked)).$child_masters->name.'</label>
											</li>';  
										} ?>
										<li>
											<label for="<?php echo "amenities.".$id ?>" class="checkbox">
												<?php echo $this->Form->checkbox("amenities.".$ame->id,array('id' => "amenities.".$id,$mainChecked)); ?><strong><?php echo $ame->name; ?></strong>
											</label>
											<ul>
												<?php  echo $li; ?>
											</ul>
										</li>
									<?php } ?>										
									</ul>
								</div>	
								<div class="form-group">
									<label>Gambling Options</label>
									<?php  foreach($gambling_options as $key => $name){ 
										$isChecked	=	(!empty($casino_gambling_options) && in_array($key,$casino_gambling_options)) ? 'checked="checked"' : '' ; 
										?>
										<div style="margin-top:10px;" class = "row">
											 <div class="col-lg-4">
												<label for="<?php echo "gambling_options.".$key; ?>" style="margin:7px;font-weight:100;cursor:pointer"><?php echo $name ?></label>
											 </div>
											 <div class="col-lg-8">
												<?php echo $this->Form->checkbox("gambling_options.".$key,array('id' => "gambling_options.".$key,$isChecked)); ?>
											 </div>
										 </div>									 
									 <?php
									} ?>
								</div>
								<div class="form-group">
									<label>Meta Description</label>
									<?php echo $this->Form->textarea("meta_description",array('class' => 'form-control','placesholder' => 'Meta Description','rows' => '1')); ?>
									<?php echo $this->Form->error("meta_description"); ?>
								</div><?php /*
								<div class="form-group">
									<label>Rating</label>
									<span data-score="3" class="jrating111"></span>
									<?php echo $this->Form->error("our_rating"); ?>
								</div>*/ ?>							
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
								<button class="btn btn-default" type="submit">Save</button>
								<button class="btn btn-default" type="reset">Reset</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div><script>WEBSITE_UPLOADS_URL = '<?php echo WEBSITE_URL; ?>';</script>

<?php  

// echo $this->Html->css(array('jquery.raty.css'),array('block' =>'css'));

// echo $this->Html->script(array('jquery.raty.js'),array('block' =>'bottom'));

// echo $this->Html->script(array('angular.min.js'),array('block' =>'angular'));
$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>


	$(function () {	
      $('input[type="checkbox"]').change(function (e) {
		  // class = $(this).attr('class');
          var checked = $(this).prop("checked"),
              container = $(this).closest("li"),
              siblings = container.siblings();
          container.find('input[type="checkbox"]').prop({
              indeterminate: false,
              checked: checked
          });

          function checkSiblings(el) {
              var parent = el.parent().parent(),
                  all = true,
                  parentcheck=parent.children("label");
              el.siblings().each(function () {
                  return all = ($(this).find('input[type="checkbox"]').prop("checked") === checked);
              });
              if (all && checked) {
                  parentcheck.children('input[type="checkbox"]').prop({
                      indeterminate: false,
                      checked: checked
                  });
                  checkSiblings(parent);
              } else if (all && !checked) {
                  parentcheck.children('input[type="checkbox"]').prop("checked", checked);
                  parentcheck.children('input[type="checkbox"]').prop("indeterminate", (parent.find('input[type="checkbox"]:checked').length > 0));
                  checkSiblings(parent);
              } else {
                 parentcheck.children('input[type="checkbox"]').prop({
                      indeterminate: true,
                      checked: false
                  });
              }
          }
          checkSiblings(container);
      });
  
	$(".autocomplete").autocomplete({
		source: function( request, response ) {
			$.ajax({
			  url: "<?php echo $this->Url->build(array('controller' => 'casinos','action' => 'city_autocomplete')); ?>",
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
	
	
/* 	$('.jrating111').raty({
		scoreName : 'our_rating',
		score: function() {
			return $(this).attr('data-score');
		}
	}); */
});

$("#Countries").change(function(){
	Countries	=	$("#Countries option:selected").text();
	$("#country_name").val(Countries);
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
$(".c_title").trigger('keyup');
<?php $this->Html->scriptEnd(); ?>