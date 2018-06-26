<h2 class="deshtitle">Settings</h2>
<div class="settingTabs hmtab">
	<ul>
		 <li class="active"><a class="us-tabs" data-tab="basic" onclick=openSetting(event,'basic','deshSettings','us-tabs')>Basic Info </a></li>
		 <li><a class="us-tabs" data-tab="noti" onclick=openSetting(event,'noti','deshSettings','us-tabs')>Email Notifictions </a></li>
		 <li><a class="us-tabs" data-tab="pref" onclick=openSetting(event,'pref','deshSettings','us-tabs')>Preferences </a></li> 
		<!--<li ng-class="$root.iconclass=='basic' ? 'active' : ''"><a href="javascript:void(0);" ng-click="noti($event,'basic')">Basic Info</a></li>
		<li ng-class="$root.iconclass=='noti' ? 'active' : ''"><a href="javascript:void(0);" ng-click="noti($event,'noti')">Email Notifictions</a></li>
		<li ng-class="$root.iconclass=='pref' ? 'active' : ''"><a href="javascript:void(0);" ng-click="noti($event,'pref')">Preferences</a></li> -->
	</ul>
</div>
<div ng-class="$root.iconclass=='basic' ? '' : 'hide'" class="deshSettings" id='basic'>
  <h2>Update Your Account</h2>
  <?php echo $this->Form->create($loginData,['id' => 'updateprofile']); ?>
	<div id="updateprofile_error_div"></div>
     <div class="row">
        <div class="fild">
           <label>Full Name:</label>
           <?php echo $this->Form->text('full_name',['ng-model' => "formData.full_name"]); ?>
        </div>
        <div class="fild">
           <label>Email Address:</label>
           <?php echo $this->Form->text('email',['ng-model' => "formData.email"]); ?>
        </div><?php /* 
        <div class="fild">
           <label>Password: <small>(6 character minimum)</small></label>
           <?php echo $this->Form->password('password1',['ng-model' => "formData.password1"]); ?>
        </div>*/ ?>
        <div class="fild">
           <label>Current City:</label>
           <?php echo $this->Form->text('city',['ng-model' => "formData.city"]); ?>
        </div>
        <div class="fild">
           <label>Country:</label>
		   <?php echo $this->Form->select('country_id',$countryList,['empty' => 'Select country','class' => 'select-dashboard ','ng-model' => "formData.country_id"]); ?>
        </div>
		
        <div class="fild">
			<label>Sex:</label>
			<div class="label_name">
				<?php echo $this->Form->radio(
				    'sex',
				    [
				        ['value' => 'male', 'text' => 'Male','ng-model' => "formData.sex"],
				        ['value' => 'female', 'text' => 'Female','ng-model' => "formData.sex"]
				    ]
				); ?>
			</div>	
        </div>
		<?php /*
		<div class="fild">
           <div class="formCheck">
              <div class="checbox"><label> <?php echo $this->Form->checkbox('accept',['ng-model' => "formData.accept"]); ?><span></span></label></div>
              <p>I accept the <a href="">Terms and Conditions</a> above and the <a href="">Privacy policy.</a></p>
           </div>
        </div>*/ ?>
     </div>
     <div class="block"><input type="button" class="btn red_btn" onClick="updateProfile()" value="Update" /></div>
  <?php echo $this->Form->end(); ?>
</div>
<div ng-class="$root.iconclass=='basic' ? '' : 'hide'" class="deshSettings" style="display:none" id='noti'>
  <?php 
	echo $this->Form->create($emailPref,['id' => 'emailPref','url' => '/globalusers/updatepreference' ]);
	echo $this->Form->hidden('type' ,['value' => 'email']);
	?>
	
   <div id="emailPref_error_div"></div>
   <h2>Send me an email notification when...</h2>
   <div class="checkList">
	<?php foreach(Configure::read('email_preference') as $key => $email){ ?>
	  <ul>
		 <h2><?php echo __($key); ?>:</h2>
		 <?php foreach($email as $key1 => $subEmail){ 
			$isChecked	=	(in_array($key1,$emailPrefArray)) ? 'checked="checked"' : ''; ?>
			 <li>
				<div class="checbox">
				   <label>
					<?php echo $this->Form->checkbox($key1,[$isChecked]); ?>
					<span></span> </label> 
				   <p><?php echo __($subEmail); ?></p>
				</div>
			 </li>
		 <?php } ?>
	  </ul>
	<?php } ?>
   </div>
   <div class="block">
		<input type="button" data-rel="emailPref" value="Update" class="btn red_btn noti_update">
   </div>
   <?php echo $this->Form->end(); ?>
</div>
<div ng-class="$root.iconclass=='basic' ? '' : 'hide'" class="deshSettings Preferences" style="display:none" id='pref'>
	<?php 
	echo $this->Form->create($emailPref,['id' => 'accountPref','url' => '/globalusers/updatepreference' ]);
	echo $this->Form->hidden('type' ,['value' => 'account']);
	?>
   <h2>Set preferences in your account...</h2>
   <div id="accountPref_error_div"></div>
   <div class="checkList">
	<?php foreach(Configure::read('preference') as $key => $preference){  ?>
	  <ul>
		 <h2><?php echo __($key); ?>?</h2>
		 <?php foreach($preference as $key1 => $name){ 
		 $isChecked	=	(in_array($key1,$accountPrefArray)) ? 'checked="checked"' : '';
		 ?>
		 <li>
			<div class="checbox">
			   <label><?php echo $this->Form->checkbox($key1,[$isChecked]); ?><span></span> </label> 
			   <p><?php echo __($name); ?></p>
			</div>
		 </li>
		 <?php } ?>
	  </ul>		
	<?php } ?>
   </div>
	<div class="block">
		<input type="button" data-rel="accountPref" ng-click="updateProfile()" value="Update" class="btn red_btn noti_update">
	</div>
   <?php echo $this->Form->end(); ?>
</div>