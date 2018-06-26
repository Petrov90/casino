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
			<h1 class="page-header">Edit Approval Request casino</h1>
		</div>
		<div class="col-lg-6">
			<?php echo $this->Html->link('Back',array('action' => 'casino_request'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12" ng-app="plunker"  ng-controller="MainCtrl">
							<?php echo $this->Form->create($casino,array('role' => 'form','type' => 'file','novalidate' => true)); ?>
								<div class="form-group">
									<label>Title</label>
									<?php echo $this->Form->text("title",array('class' => 'form-control c_title','placesholder' => 'Title')); ?>   
									<?php echo $this->Form->error("title"); ?>
								</div>								
								<div class="form-group" id="c_title">
									<label>Slug</label>
									<?php echo $this->Form->text("slug",array('class' => 'form-control','id' => 'c_title1','required' => false));
									echo $this->Form->error("slug"); ?>
								</div>	
								<div class="form-group">
									<label>Country</label>
									<?php echo $this->Form->select("country_id",$country,array('class' => 'form-control country_id','empty' => 'Select country','id' => 'Countries','default' => $casino->city->country->id)); ?>
									<?php echo $this->Form->error("country_id"); ?>
								</div>
								<div class="form-group">
									<label>State</label>
									<?php //echo $this->Form->text("state_name",array('class' => 'form-control')); 

									echo $this->Form->select("state_name",null,array('class' => 'form-control state_name','empty' => 'Select state','id' => 'state_name'));

									?>	

								</div>
								<div class="form-group">
									<label>City</label>
									<?php echo $this->Form->text("city_name",array('class' => 'form-control autocomplete','empty' => false)); ?>
									<?php echo $this->Form->hidden("city_id",array('id' => 'city_id')); ?>
									
									<?php echo $this->Form->hidden("country_name",array('id' => 'country_name')); ?>
									
									<?php echo $this->Form->error("city_id"); ?>
								</div>
								<div class="form-group">
									<label>Street, No</label>
									<?php echo $this->Form->text("street_no",array('class' => 'form-control c_title','placesholder' => 'Street, No')); ?>   
									<?php echo $this->Form->error("street_no"); ?>
								</div>
								<div class="form-group">
									<label>Zip Code</label>
									<?php echo $this->Form->text("zipcode",array('class' => 'form-control c_title','placesholder' => 'Zip Code')); ?>   
									<?php echo $this->Form->error("zipcode"); ?>
								</div>
								
								<!-- <div class="form-group">
									<label>Address</label>
									<?php echo $this->Form->textarea("address",array('class' => 'form-control','placesholder' => 'Address','rows' => '1')); ?>
									<?php echo $this->Form->error("address"); ?>
								</div> --><?php /*
								<div class="form-group">
									<label>Short Description</label>
									<?php //echo $this->Html->script('ckeditor/ckeditor', array('inline' => false));
									 echo $this->Form->textarea("sdescription",array('class' => 'form-control','placeholdder' => 'Description','id' =>'body1')); ?>
					<?php $this->Html->scriptStart(array('block' => 'custom_script')); ?>
						CKEDITOR.replace( 'body1',{} );
					<?php $this->Html->scriptEnd(); ?>
					<?php echo $this->Form->error("sdescription"); ?>
								</div>*/ ?>
								<!-- <div class="form-group">
									<label>Description</label>
									<?php //echo $this->Html->script('ckeditor/ckeditor', array('inline' => false));
									 echo $this->Form->textarea("description",array('class' => 'form-control','placeholdder' => 'Description','id' =>'body')); ?>
									<?php $this->Html->scriptStart(array('inline' => false,'block' => 'custom_script')); ?>
										CKEDITOR.replace( 'body',{} );
									<?php $this->Html->scriptEnd(); ?>
									<?php echo $this->Form->error("description"); ?>
								</div> -->
								<!-- <div class="form-group">
									<label>Range of games</label>
									<?php
									 echo $this->Form->textarea("range_of_games",array('class' => 'form-control','placeholdder' => 'Description','id' =>'range_of_games')); $this->Html->scriptStart(array('block' => 'custom_script')); ?>
						CKEDITOR.replace( 'range_of_games',{} );
					<?php $this->Html->scriptEnd(); ?>
								</div>
								<div class="form-group">
									<label>Hotels</label>
									<?php 
									 echo $this->Form->textarea("hotels",array('class' => 'form-control','placeholdder' => 'Description','id' =>'hotels')); $this->Html->scriptStart(array('block' => 'custom_script')); ?>
						CKEDITOR.replace( 'hotels',{} );
					<?php $this->Html->scriptEnd(); ?>
								</div>
								<div class="form-group">
									<label>Food and Beverages</label>
									<?php 
									 echo $this->Form->textarea("food_and_beverages",array('class' => 'form-control','placeholdder' => 'Description','id' =>'food_and_beverages')); $this->Html->scriptStart(array('block' => 'custom_script')); ?>CKEDITOR.replace( 'food_and_beverages',{} );<?php $this->Html->scriptEnd(); ?>
								</div>
								<div class="form-group">
									<label>Activities & Services</label>
									<?php 
									 echo $this->Form->textarea("activities_services",array('class' => 'form-control','placeholdder' => 'Description','id' =>'activities_services')); $this->Html->scriptStart(array('block' => 'custom_script')); ?>CKEDITOR.replace( 'activities_services',{} );<?php $this->Html->scriptEnd(); ?>
								</div>
								<div class="sss">
								<div class="form-group">
									<label>Affiliate Url</label>
									<?php echo $this->Form->text("url",array('class' => 'form-control','placesholder' => 'Affiliate Url','required' => false)); ?>
									<?php echo $this->Form->error("url"); ?>
								</div>
								<div>
									<h4><b>Contact information</b></h4>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Website</label>
												<?php echo $this->Form->text("contact_website",array('class' => 'form-control','placesholder' => 'Phone','required' => false)); ?>
												<?php echo $this->Form->error("contact_website"); ?>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Email</label>
												<?php echo $this->Form->text("contact_email",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
												<?php echo $this->Form->error("contact_email"); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Phone</label>
												<?php echo $this->Form->text("contact_phone",array('class' => 'form-control','placesholder' => 'Phone','required' => false)); ?>
												<?php echo $this->Form->error("contact_phone"); ?>
											</div>
										</div>
										
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Facebook</label>
												<?php echo $this->Form->text("contact_facebook",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
												<?php echo $this->Form->error("contact_facebook"); ?>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Twitter</label>
												<?php echo $this->Form->text("contact_twitter",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
												<?php echo $this->Form->error("contact_twitter"); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Table games</label>
												<?php echo $this->Form->text("table_games",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
												<?php echo $this->Form->error("table_games"); ?>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Gaming machines</label>
												<?php echo $this->Form->text("gaming_machines",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
												<?php echo $this->Form->error("gaming_machines"); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Self parking</label>
												<?php echo $this->Form->select("self_parking",array('yes' => 'Yes','no' => 'No'),array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
												<?php echo $this->Form->error("self_parking"); ?>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Valet</label>
												<?php echo $this->Form->select("valet",array('yes' => 'Yes','no' => 'No'),array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
												<?php echo $this->Form->error("email"); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Casino sq/ft</label>
												<?php echo $this->Form->text("casino_sq_ft",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
												<?php echo $this->Form->error("casino_sq_ft"); ?>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Convention sq/ft</label>
												<?php echo $this->Form->text("convention_sq_ft",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
												<?php echo $this->Form->error("convention_sq_ft"); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group">
												<label>Schedule</label>
												<div style="border: 1px solid;margin-bottom: 2%;padding: 2%;">
													<div class="form-group">
														<label>All Days 24 hour <span class="float-right"><?php echo $this->Form->checkbox("contact_schedule.all_day"); ?></span></label>									
													</div>
													<?php 
													$arr = Configure::read('weekday');
													foreach($arr as $key => $name){ ?>
														<div class="form-group">
															<label><?php echo $name; ?></label>
															<div>
															<?php echo $this->Form->text("contact_schedule.".$key.".from",array('class' => 'w10','placeholder' => '10:00 AM')); ?><span class="w101">/</span><?php echo $this->Form->text("contact_schedule.".$key.".to",array('class' => 'w10','placeholder' => '12:00 PM')); ?>
															<?php echo $this->Form->checkbox("contact_schedule.".$key.".all_day"); ?>(Check the checkbox For Full Day)
															</div>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div>
									<h4><b>Poker</b></h4>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Website</label>
												<?php echo $this->Form->text("poker_website",array('class' => 'form-control','placesholder' => 'Phone','required' => false)); ?>
												<?php echo $this->Form->error("poker_website"); ?>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Phone</label>
												<?php echo $this->Form->text("poker_phone",array('class' => 'form-control','placesholder' => 'Phone','required' => false)); ?>
												<?php echo $this->Form->error("poker_phone"); ?>
											</div>
										</div>									
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Facebook</label>
												<?php echo $this->Form->text("poker_facebook",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
												<?php echo $this->Form->error("poker_facebook"); ?>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Twitter</label>
												<?php echo $this->Form->text("poker_tw",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
												<?php echo $this->Form->error("poker_tw"); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Email</label>
												<?php echo $this->Form->text("poker_email",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
												<?php echo $this->Form->error("poker_email"); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group">
												<label>Schedule</label>
												<div style="border: 1px solid;margin-bottom: 2%;padding: 2%;">
													<div class="form-group">
														<label>All Days 24 hour <span class="float-right"><?php echo $this->Form->checkbox("poker_schedule.all_day"); ?></span></label>									
													</div>
													<?php 
													$arr = Configure::read('weekday');
													foreach($arr as $key => $name){ ?>
														<div class="form-group">
															<label><?php echo $name; ?></label>
															<div>
															<?php echo $this->Form->text("poker_schedule.".$key.".from",array('class' => 'w10','placeholder' => '10:00 AM')); ?><span class="w101">/</span><?php echo $this->Form->text("poker_schedule.".$key.".to",array('class' => 'w10','placeholder' => '12:00 PM')); ?>
															<?php echo $this->Form->checkbox("poker_schedule.".$key.".all_day"); ?>(Check the checkbox For Full Day)
															</div>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div>
									<h4><b>Box Office</b></h4>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Website</label>
												<?php echo $this->Form->text("bo_web",array('class' => 'form-control','placesholder' => 'Phone','required' => false)); ?>
												<?php echo $this->Form->error("bo_web"); ?>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Phone</label>
												<?php echo $this->Form->text("bo_ph",array('class' => 'form-control','placesholder' => 'Phone','required' => false)); ?>
												<?php echo $this->Form->error("bo_ph"); ?>
											</div>
										</div>									
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Facebook</label>
												<?php echo $this->Form->text("bo_facebook",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
												<?php echo $this->Form->error("bo_facebook"); ?>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Twitter</label>
												<?php echo $this->Form->text("bo_tw",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
												<?php echo $this->Form->error("bo_tw"); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Email</label>
												<?php echo $this->Form->text("bo_email",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
												<?php echo $this->Form->error("bo_email"); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group">
												<label>Schedule</label>
												<div style="border: 1px solid;margin-bottom: 2%;padding: 2%;">
													<div class="form-group">
														<label>All Days 24 hour <span class="float-right"><?php echo $this->Form->checkbox("bo_schedule.all_day"); ?></span></label>									
													</div>
													<?php 
													$arr = Configure::read('weekday');
													foreach($arr as $key => $name){ ?>
														<div class="form-group">
															<label><?php echo $name; ?></label>
															<div>
															<?php echo $this->Form->text("bo_schedule.".$key.".from",array('class' => 'w10','placeholder' => '10:00 AM')); ?><span class="w101">/</span><?php echo $this->Form->text("bo_schedule.".$key.".to",array('class' => 'w10','placeholder' => '12:00 PM')); ?>
															<?php echo $this->Form->checkbox("bo_schedule.".$key.".all_day"); ?>(Check the checkbox For Full Day)
															</div>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div>
									<h4><b>Group Sales</b></h4>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Website</label>
												<?php echo $this->Form->text("gs_web",array('class' => 'form-control','placesholder' => 'Phone','required' => false)); ?>
												<?php echo $this->Form->error("gs_web"); ?>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Phone</label>
												<?php echo $this->Form->text("gs_ph",array('class' => 'form-control','placesholder' => 'Phone','required' => false)); ?>
												<?php echo $this->Form->error("gs_ph"); ?>
											</div>
										</div>									
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Facebook</label>
												<?php echo $this->Form->text("gs_facebook",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
												<?php echo $this->Form->error("gs_facebook"); ?>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Twitter</label>
												<?php echo $this->Form->text("gs_tw",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
												<?php echo $this->Form->error("gs_tw"); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Email</label>
												<?php echo $this->Form->text("gs_email",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
												<?php echo $this->Form->error("gs_email"); ?>
											</div>
										</div>
									</div>	
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group">
												<label>Schedule</label>
												<div style="border: 1px solid;margin-bottom: 2%;padding: 2%;">
													<div class="form-group">
														<label>All Days 24 hour <span class="float-right"><?php echo $this->Form->checkbox("gs_schedule.all_day"); ?></span></label>									
													</div>
													<?php 
													$arr = Configure::read('weekday');
													foreach($arr as $key => $name){ ?>
														<div class="form-group">
															<label><?php echo $name; ?></label>
															<div>
															<?php echo $this->Form->text("gs_schedule.".$key.".from",array('class' => 'w10','placeholder' => '10:00 AM')); ?><span class="w101">/</span><?php echo $this->Form->text("gs_schedule.".$key.".to",array('class' => 'w10','placeholder' => '12:00 PM')); ?>
															<?php echo $this->Form->checkbox("gs_schedule.".$key.".all_day"); ?>(Check the checkbox For Full Day)
															</div>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div>
									<h4><b>Conferences</b></h4>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Website</label>
												<?php echo $this->Form->text("cf_web",array('class' => 'form-control','placesholder' => 'Phone','required' => false)); ?>
												<?php echo $this->Form->error("cf_web"); ?>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Phone</label>
												<?php echo $this->Form->text("cf_ph",array('class' => 'form-control','placesholder' => 'Phone','required' => false)); ?>
												<?php echo $this->Form->error("cf_ph"); ?>
											</div>
										</div>									
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Facebook</label>
												<?php echo $this->Form->text("cf_facebook",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
												<?php echo $this->Form->error("cf_facebook"); ?>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Twitter</label>
												<?php echo $this->Form->text("cf_tw",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
												<?php echo $this->Form->error("cf_tw"); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Email</label>
												<?php echo $this->Form->text("cf_em",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
												<?php echo $this->Form->error("cf_em"); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group">
												<label>Schedule</label>
												<div style="border: 1px solid;margin-bottom: 2%;padding: 2%;">
													<div class="form-group">
														<label>All Days 24 hour <span class="float-right"><?php echo $this->Form->checkbox("cf_schedule.all_day"); ?></span></label>									
													</div>
													<?php 
													$arr = Configure::read('weekday');
													foreach($arr as $key => $name){ ?>
														<div class="form-group">
															<label><?php echo $name; ?></label>
															<div>
															<?php echo $this->Form->text("cf_schedule.".$key.".from",array('class' => 'w10','placeholder' => '10:00 AM')); ?><span class="w101">/</span><?php echo $this->Form->text("cf_schedule.".$key.".to",array('class' => 'w10','placeholder' => '12:00 PM')); ?>
															<?php echo $this->Form->checkbox("cf_schedule.".$key.".all_day"); ?>(Check the checkbox For Full Day)
															</div>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
								<div class="form-group">
									<label>Amenities</label>
									<ul>
									<?php foreach($casinoActivities as $ame){ 
										$id				=	$ame->id;  	
										$li				=	'';
										$mainChecked	=	false;
										$mainCheckedDis	=	false;
										$count	=	count($ame->child_masters);										
										foreach($ame->child_masters as $key => $child_masters ){
											$isChecked	=	(!empty($casino_activity_datas) && in_array($child_masters->id,$casino_activity_datas)) ? 'checked="checked"' : '' ;
											
											if(!empty($casino_activity_datas) && in_array($child_masters->id,$casino_activity_datas)){
												$isChecked	=	'checked="checked"';
												if($key+1 == $count){
													$mainChecked	=	'checked="checked"';
												}else{
													$mainCheckedDis	=	true;
												}
											}else{
												$isChecked	=	'';
											}
											if($child_masters->casino_id == $casino->id || $isChecked == 'checked="checked"'){
											$li	.=
											'<li>
												<label for="amenities_child.'.$child_masters->id.'" class="checkbox">
												'.$this->Form->checkbox("casinoActivities.".$ame->id.".".$child_masters->id,array('id' => "amenities_child.".$child_masters->id,$isChecked)).$child_masters->title.'</label>
											</li>';  
											}
										} ?>
										<li>
											<label for="<?php echo "amenities.".$id ?>" class="checkbox">
												<?php echo $this->Form->checkbox("casinoActivities.".$ame->id,array('id' => "amenities.".$id,$mainChecked)); ?><strong><?php echo $ame->title; ?></strong>
											</label>
											<ul>
												<?php  echo $li; ?>
											</ul>
										</li>
									<?php } ?>										
									</ul>
								</div>	 -->
								<div class="form-group">
									<label>Gambling Options</label>
										<div style="margin-top:10px;" class = "row">
									<?php  foreach($gambling_options as $key => $name){ 
										$isChecked	=	(!empty($casino_gambling_options) && in_array($key,$casino_gambling_options)) ? 'checked="checked"' : '' ; 
										?>
											 <div class="col-lg-4">
												<label for="<?php echo "gambling_options.".$key; ?>" style="margin:7px;font-weight:100;cursor:pointer"><?php echo $name ?></label>
											
												<?php echo $this->Form->checkbox("gambling_options.".$key,array('id' => "gambling_options.".$key,$isChecked)); ?>
											 </div>
									 <?php
									} ?>
										 </div>									 
								</div>
								<!-- <div class="form-group">
									<label>Meta Description</label>
									<?php echo $this->Form->textarea("meta_description",array('class' => 'form-control','placesholder' => 'Meta Description','rows' => '1')); ?>
									<?php echo $this->Form->error("meta_description"); ?>
								</div> --><?php /*
								<div class="form-group">
									<label>Rating</label>
									<span data-score="<?php echo (!empty($casino->our_rating)) ? $casino->our_rating : 3; ?>" class="jrating111"></span>
									<?php echo $this->Form->error("our_rating"); ?>
								</div><?php 
								/* <div class="form-group">
									<label>Review</label>
									<?php echo $this->Form->textarea("review",array('class' => 'form-control','placesholder' => 'Meta Description','rows' => '5','value' => (isset($casino->reviews[0]->comment)) ? $casino->reviews[0]->comment : '')); ?>
									<?php echo $this->Form->error("review"); ?>
								</div> */?>
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
								<div class="form-group">
									<label>Casino Approval</label>
									<?php echo $this->Form->select("status",array('1' => 'Yes','0' => 'No'),array('class' => 'form-control','required' => false)); ?>  
									<?php echo $this->Form->error("status"); ?>
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

<script>WEBSITE_UPLOADS_URL = '<?php echo WEBSITE_URL; ?>';</script>
<?php  
// echo $this->Html->css(array('jquery.raty.css'),array('block' =>'css'));

// echo $this->Html->script(array('jquery.raty.js'),array('block' =>'bottom'));
$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>


$(function () {
	/* $('.jrating111').raty({
		scoreName : 'our_rating',
		score: function() {
			return $(this).attr('data-score');
		}
	}); */
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


$("#Countries").change(function(){
	cntryid = $(this).val();
	Countries	=	$("#Countries option:selected").text();
	$("#country_name").val(Countries);

	url1=  "<?php echo $this->Url->build(array('action' => 'getStates')) ?>/"+cntryid;		
		$.ajax(
			{
			type 	 : 'get',
			dataType : 'json',
			url: url1,    	    
    		success: function(data) { 
       			$("#state_name").find('option').remove();
    			$('<option>').val('').text('Select state').appendTo($("#state_name"));

				$.each(data, function(key, value) { 
					$('<option>').val(key).text(value).appendTo($("#state_name"));
				});
      		}
      	});
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
</style>