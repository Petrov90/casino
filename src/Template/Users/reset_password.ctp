<?php $this->Html->scriptStart(array('block' => 'custom_script')); ?>
	var formApp = angular.module('resetPassword', []);
	
	formApp.controller('resetPasswordController',function($scope, $http) {
		$scope.formData = {};
		$scope.processForm = function(){
			$http({
				method  : 'POST',
				url     : '<?php echo $this->Url->build('/users/resetPassword/'.$forgot_password_string); ?>',
				data    : $.param($scope.formData),  // pass in data as strings
				headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
			}).success(function(data) {
				console.log(data);
				if (!data.success) {
					// if not successful, bind errors to error variables
					$scope.errorList 	= data.errors;
					
				} else {
					// if successful, bind success message to message
					$scope.errorList 	= '';
					$scope.formData = {};
					window.location	=	'<?php echo $this->Url->build(['action' => 'index']); ?>'
				}
			});
		};
	});
<?php $this->Html->scriptEnd(); ?>
<div class="mid_wrapper">
	<div class="map">
		<div class="container">
			<div class="title">
				<h2>Reset password</h2>
			</div>        
			<div class="col-md-3"></div>
			<div class="col-md-6"  ng-app="resetPassword" ng-controller='resetPasswordController'>
				<?php echo $this->Form->create($reset,['url' => false,'class' => 'css-form','ng-submit' => "processForm()", 'name' => 'form']); ?>
				<div ng-show="errorList">
					<div class="alert alert-danger alert-dismissible site-color" role="alert">
						<ul class="client-side-error" ng-repeat="error in errorList">
							<li>{{error}}</li>
						</li>
					</div>
				</div>
					<div class="fildlogin p0">
					  <div class="form-group">
						<label>New Password<span class="red-star">*</span></label>
						<?php echo $this->Form->password('password',['class' => 'form-control','ng-model' => "formData.password",'required' => true]); ?>
					  </div>
					</div>
					<div class="fildlogin p0">
					  <div class="form-group">
						<label>Confirm Password<span class="red-star">*</span></label>
						<?php echo $this->Form->password('c_password',['class' => 'form-control','ng-model' => "formData.c_password",'required' => true]); ?>
					  </div>
					</div>
					<div class="loginfooter">
						<input type="submit" value="Submit" class="btn red_btn" />
					</div>
				<?php echo $this->Form->end(); ?>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
</div>