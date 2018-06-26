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
						<div class="col-lg-12" ng-app="plunker"  ng-controller="MainCtrl">
							<?php echo $this->Form->create($casino,array('role' => 'form','novalidate' => true)); ?>
								<div class="form-group">
									<label>Title</label>
									<?php echo $this->Form->text("title",array('class' => 'form-control','placesholder' => 'Title','ng-model' => 'name','ng-required' => "required")); ?>   
									<?php echo $this->Form->error("title"); ?>
								</div>
								<div class="form-group">
									<label>Url</label>
									<?php echo $this->Form->text("slug",array('class' => 'form-control','placesholder' => 'Url','ng-model' => 'slug','slug' => 'name')); ?>
									<?php echo $this->Form->error("slug"); ?>
								</div>
								<div class="form-group">
									<label>Country</label>
									<?php echo $this->Form->select("country_id",$country,array('class' => 'form-control country_id','empty' => 'Select country','required' => false,'id' => 'Countries')); ?>
									<?php echo $this->Form->error("address"); ?>
								</div>
								<div class="form-group">
									<label>City</label>
									<?php echo $this->Form->text("city_name",array('class' => 'form-control autocomplete','empty' => false,'required' => false)); ?>
									<?php echo $this->Form->hidden("city_id",array('id' => 'city_id','required' => false)); ?>
									<?php echo $this->Form->error("city_id"); ?>
								</div>
								<div class="form-group">
									<label>Address</label>
									<?php echo $this->Form->textarea("address",array('class' => 'form-control','placesholder' => 'Address','rows' => '1','required' => false)); ?>
									<?php echo $this->Form->error("address"); ?>
								</div>
								<div class="form-group">
									<label>Description</label>
									<?php //echo $this->Html->script('ckeditor/ckeditor', array('inline' => false));
									 echo $this->Form->textarea("description",array('class' => 'form-control','placeholdder' => 'Description','required' => false,'id' =>'body')); ?>
					<?php $this->Html->scriptStart(array('inline' => false,'block' => 'custom_script')); ?>
						CKEDITOR.replace( 'body',{} );
					<?php $this->Html->scriptEnd(); ?>
					<?php echo $this->Form->error("body"); ?>
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
									<?php echo $this->Form->text("phone",array('class' => 'form-control','placesholder' => 'Phone','required' => false)); ?>
									<?php echo $this->Form->error("phone"); ?>
								</div>
								<div class="form-group">
									<label>Software</label>
									<?php echo $this->Form->textarea("software",array('class' => 'form-control','placesholder' => 'Software','required' => false)); ?>
									<?php echo $this->Form->error("software "); ?>
								</div>
								<div class="form-group">
									<label>Deposit Methods</label>
									<?php echo $this->Form->textarea("deposit_methods",array('class' => 'form-control','placesholder' => 'Deposit Methods','required' => false)); ?>
									<?php echo $this->Form->error("deposit_methods "); ?>
								</div>
								<div class="form-group">
									<label>Withdrawal Methods</label>
									<?php echo $this->Form->textarea("withdrawal_methods",array('class' => 'form-control','placesholder' => 'Withdrawal Methods','required' => false)); ?>
									<?php echo $this->Form->error("withdrawal_methods "); ?>
								</div>
								<div class="form-group">
									<label>Withdrawal Limit</label>
									<?php echo $this->Form->textarea("withdrawal_limit",array('class' => 'form-control','placesholder' => 'Withdrawal Limit','required' => false)); ?>
									<?php echo $this->Form->error("withdrawal_limit "); ?>
								</div>
								<div class="form-group">
									<label>Language</label>
									<?php echo $this->Form->textarea("language",array('class' => 'form-control','placesholder' => 'Language','required' => false)); ?>
									<?php echo $this->Form->error("language "); ?>
								</div>
								<div class="form-group">
									<label>Currencies</label>
									<?php echo $this->Form->textarea("currencies",array('class' => 'form-control','placesholder' => 'Currencies','required' => false)); ?>
									<?php echo $this->Form->error("currencies "); ?>
								</div>
								<div class="form-group">
									<label>Gambling Options</label>
									<?php  foreach($gambling_options as $key => $name){
									 ?>
										<div style="margin-top:10px;" class = "row">
											 <div class="col-lg-4">
												<label for="<?php echo "gambling_options.".$key; ?>" style="margin:7px;"><?php echo $name ?></label>
											 </div>
											 <div class="col-lg-8">
												<?php echo $this->Form->checkbox("gambling_options.".$key,array('id' => "gambling_options.".$key)); ?>
											 </div>
										 </div>
									 
									 <?php
									} ?>
								</div><?php /*
								<div class="form-group">
									<label>Amenities</label>
									<?php echo $this->Form->select("amenities",$amenities,array('class' => 'form-control','empty' => false,'required' => false,'multiple' => true)); ?>
									<?php echo $this->Form->error("amenities"); ?>
								</div>*/?>
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

<?php 
echo $this->Html->script(array('angular.min.js'),
	array('block' =>'angular'));
 $this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
var app = angular.module('plunker', []);

	app.controller('MainCtrl', function($scope) {
	  $scope.name = '<?PHP echo (!empty($casino->title)) ? $casino->title : ''; ?>';
	})
	.directive('slug', function () {
		return {
		  restrict: 'A',
		  scope: {
			slug: '=',
			ngModel: '='
		  },
		  
		  link: function (scope) {
			scope.$watch('slug', function (newValue, oldValue) {
			  var trExp = /[\/\s]+/gi;
			  oldValue = oldValue.replace(trExp, '-');
			  newValue = newValue.replace(trExp, '-');
			  if (scope.ngModel === oldValue || !scope.ngModel) {
				scope.ngModel = newValue;
			  }
			});
		  }
		};
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
<?php $this->Html->scriptEnd(); ?>