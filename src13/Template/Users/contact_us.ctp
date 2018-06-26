<div class="mid_wrapper">
	<div class="map banner_textblock">
		<div class="container">
			<div class="title">
				<h1><?php echo $contactBlock->title; ?></h1>
				<?php echo $contactBlock->description; ?>
				<span></span> 
			</div>        
			<div class="contact_form">
				<div class="row" data-ng-app="formApp" data-ng-controller="formController">
					<form name="form" class="css-form" data-ng-submit="processForm()">
						 <div class="form-group">
							  <div class="col-md-6">
								<div class="field">
									<label><?php echo __('Name',true);?>:<span class="red-star">*</span></label>
									<input  class="form-control" type="text" data-ng-model="formData.name" name="name" required/>
									<div class="err-msg" data-ng-show="errorName">
										<span class="help-block" data-ng-show="errorName">{{ errorName }}</span>
									</div>
								</div>
							  </div>						  
							  <div class="col-md-6">
							  <div class="field">
								<label>Email:<span class="red-star">*</span></label>
								<input type="email" name="email"  class="form-control" data-ng-model="formData.email" required>
								<div class="err-msg" data-ng-show="errorEmail">
									<span class="help-block" data-ng-show="errorEmail">{{ errorEmail }}</span>	
								</div>
							  </div>
							</div>						
							<div class="col-md-6">
							  <div class="field">
								<label>Subject:<span class="red-star">*</span></label>
									<input type="text" data-ng-model="formData.subject" name="subject" class="form-control" required >
									<div  class="err-msg" data-ng-show="errorSubject">
										<span class="help-block" data-ng-show="errorSubject">{{ errorSubject }}</span>
									</div>
								</div>
							</div>
						
							<div class="col-md-6">
								<div class="field">
									<label>Department:<span class="red-star">*</span></label>
									<?php echo $this->Form->select('master_id',$departmentList,array('required' => true,'class' => 'form-control main','data-ng-model' => 'formData.master_id','empty' => __('Select Department',true))); ?>
									<div class="err-msg" data-ng-show="errorDepartment">
										<span class="help-block" data-ng-show="errorDepartment">{{ errorDepartment }}</span>
									</div>
								</div>
							</div>						
							<div class="col-md-6">
								<div class="field">
									<label>Message:<span class="red-star">*</span></label>
									<textarea data-ng-model="formData.message" class="form-control"  name="message" placeholder="" required></textarea>
									<div class="err-msg" data-ng-show="errorMessage">	
										<span class="help-block" data-ng-show="errorMessage">{{ errorMessage }}</span>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="field">
									<label>Captcha:<span class="red-star">*</span></label>
									
									<?php echo $this->Captcha->create('securitycode', ['type' => 'image','class' => 'form-control','alt' => 'img']); //$settings are optional ?>
									
									<div class="err-msg" data-ng-show="securitycodeError">	
										<span class="help-block" data-ng-show="securitycodeError">{{ securitycodeError }}</span>
									</div>
								</div>
							</div>
							<div class="col-md-12 text-center">
								<div class="err-msg" data-ng-show="message">	
									<span class="help-block" data-ng-show="message">{{ message }}</span>
								</div>
							  <input type="submit" class="btn red_btn" value="Submit" />
							</div>			
						</div>			
					  </form>
      
				<?php /*
					<form data-ng-submit="processForm()">
						<div id="name-group" class="form-group" data-ng-class="{ 'has-error' : errorName }">
							<label>Name</label>
							<input type="text" name="name" class="form-control" placeholder="Bruce Wayne" data-ng-model="formData.name">
							<span class="help-block" data-ng-show="errorName">{{ errorName }}</span>
						</div>

						<!-- SUPERHERO NAME -->
						<div id="superhero-group" class="form-group" data-ng-class="{ 'has-error' : errorSuperhero }">
							<label>Superhero Alias</label>
							<input type="text" name="superheroAlias" class="form-control" placeholder="Caped Crusader" data-ng-model="formData.superheroAlias">
							<span class="help-block" data-ng-show="errorSuperhero">{{ errorSuperhero }}</span>
						</div>

						<!-- SUBMIT BUTTON -->
						<button type="submit" class="btn btn-success btn-lg btn-block">Submit!</button>
					</form>*/ ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->Html->scriptStart(array('block' => 'custom_script')); ?> 
	var formApp = angular.module('formApp', []);
	// create angular controller and pass in $scope and $http
	formApp.controller('formController',function($scope, $http) {
		// create a blank object to hold our form information
		// $scope will allow this to pass between controller and view
		$scope.formData = {};
		// process the form
		$scope.processForm = function(){
			$("#ajax-loader").removeClass('hide');

			$http({
				method  : 'POST',
				url     : '<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'contactUs')); ?>',
				data    : $.param($scope.formData),  // pass in data as strings
				headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
			}).success(function(data) {
				$("#ajax-loader").addClass('hide');

				if (!data.success) {
					// if not successful, bind errors to error variables
					$scope.errorName 			= data.errors.name;
					$scope.errorEmail	 		= data.errors.email;
					$scope.errorSubject	 		= data.errors.subject;
					$scope.errorDepartment	 	= data.errors.master_id;
					$scope.errorMessage	 		= data.errors.message;
					$scope.securitycodeError	 = data.errors.securitycode;
					
				} else {
					// if successful, bind success message to message
					// $scope.message 				= data.message;
					$scope.errorName 			= '';
					$scope.errorEmail	 		= '';
					$scope.errorSubject	 		= '';
					$scope.errorDepartment	 	= '';
					$scope.errorMessage	 		= '';
					$scope.securitycodeError	= '';
					$scope.formData = {};
					
					notice('Success',data.message,'success');
				}
			});
		};
	});
	
	jQuery('.creload').on('click', function() {
		var mySrc = $(this).prev().attr('src');
		var glue = '?';
		if(mySrc.indexOf('?')!=-1)  {
			glue = '&';
		}
		$(this).prev().attr('src', mySrc + glue + new Date().getTime());
		return false;
	});
<?php $this->Html->scriptEnd(); ?>