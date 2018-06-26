<div id="page-wrapper">
	<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h1 class="page-header">Spam questions</h1>
			</div>
			<div class="col-lg-6">
				<?php //echo $this->Html->link('Add New Casino',array('action' => 'add'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
			</div>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive1">
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-3">
									<div class="dataTables_length">
										<label>
											<?php echo $this->element('paging_info'); ?>
										</label>
									</div>
								</div>
								<div class="col-sm-9">
									<?php echo $this->Form->create('QuestionSpams',array('type' => 'get')); ?>
									<div class="col-sm-5"> <?php echo $this->Form->text("full_name",array('class' =>'form-control','placeholder' => 'Search by marked spam user','value' => isset($requestedQuery['full_name']) ? $requestedQuery['full_name'] : '')); ?></div><?php /*
									<div class="col-sm-3">
										<?php echo $this->Form->text("email",array('class' =>'form-control','placeholder' => 'Search by email','value' => isset($requestedQuery['email']) ? $requestedQuery['email'] : '')); ?>
									</div>*/ ?>
									<div class="col-sm-4">
										<input type="submit" value="Search" class="btn btn-primary">
										<?php echo $this->Html->link("Reset",array('action' => 'index'),array('class' => 'btn btn-default')); ?>
									 </div>
									 <?php echo $this->Form->end(); ?>
								</div>
							</div>
						</div>
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th width="15%">question For</th>
									<th width="15%">question Posted By</th>
									<th width="25%">question</th>
									<th width="15%">Mark Spam By</th>
									<th width="10%">Category</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($QuestionSpams as $casino):
										$id	=	$casino->id;
										// pr($casino);
										?>
										<tr>
											<td><?php 
											if(isset($casino->question->casino->title)){
												
												$name	=	$casino->question->casino->title;
												$slug	=	 $casino->question->casino->slug;
												
												if(isset($casino->question->casino->type) && $casino->question->casino->type == 'online'){ 
													$htmlurl	=	['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view'=>$slug.'#question_div','prefix' => false];
												}else{
													$htmlurl	=	['plugin' => '','controller' => 'casinos','action' => 'casino_view','casino_view'=>$slug.'#question_div','prefix' => false];					   
												}
												   
											}else if(isset($casino->question->country->name)){
												$name	=	 $casino->question->country->name;
												
												$slug		=	$casino->question->country->slug;
												$htmlurl	=	['plugin' => '','controller' => 'users','action' => 'country_view','country_view'=>$slug.'#question_div','prefix' => false];
												
											}else if(isset($casino->question->city->name)){
												$name			=	 $casino->question->city->name;
												$slug			=	 $casino->question->city->slug;
												
												$countrySlug	=	isset($casino->question->city->c_country->slug) ? $casino->question->city->c_country->slug : '';
					
												$htmlurl	=	['plugin' => '','controller' => 'users','action' => 'city_view','country'=>$countrySlug,'city'=>$slug,'prefix' => false];
												
											} echo $this->Html->link($name,$htmlurl,['target' => '_blank']); ?></td>
											<td><?php echo $this->Html->link($casino->question->user->full_name,['plugin' => '','controller' => 'users','action' => 'user_slug','user_slug'=>$casino->question->user->slug,'prefix' => false],['target' => '_blank']); ?></td>
											<td><?= h(html_entity_decode($casino->question->comment)) ?></td>
											<td><?php echo $this->Html->link($casino->user->full_name,['plugin' => '','controller' => 'users','action' => 'user_slug','user_slug'=>$casino->user->slug,'prefix' => false],['target' => '_blank']); ?></td>
											<td><?= h($casino->master->name) ?></td>
											<td>
												<?php $is_feat	=	($casino->is_feature == 1) ? 0 : 1;
												$title		=	($casino->is_feature == 1) ? 'Mark As Unfeatured' : 'Mark As featured';
												$title1		=	($casino->is_feature == 1) ? 'Click To Mark As Unfeatured' : 'Click To Mark As Featured';
												$class		=	($casino->is_feature == 1) ? 'btn btn-info' : 'btn btn-warning';
												// echo $this->Html->link($title,['action' => 'feat',$casino->id,$is_feat],['class' => $class,'title' => $title1]); ?>
												
												<?php //echo $this->Html->link(__('Edit'), ['action' => 'edit', $casino->id],['class' => 'btn btn-primary']) ?>
												<?= $this->Form->postLink(__('Delete The question'), ['action' => 'delete', $casino->id], ['confirm' => __('Are you sure you want to delete the question', $casino->id),'class' => 'btn btn-danger']) ?>
												<?= $this->Form->postLink(__('Delete The Spam Request'), ['action' => 'deletespam', $casino->id], ['confirm' => __('Are you sure you want to delete the spam request ?', $casino->id),'class' => 'btn btn-warning']) ?>
											</td>
										</tr>	
									 <?php endforeach;

								if(!isset($id)){ ?>
								<tr class="odd gradeX">
									<td colspan="6" class="text-center">No record found</td>
								</tr>
									<?php
									
								} ?>
							</tbody>
						</table>
						<?php $paginator    =    $this->Paginator; ?>
						<div class="row">
							<div class="col-sm-12 text-right">
								<ul class="pagination">	
								<?php
									echo $paginator->prev(__('Prev', true),
										array(
											'id'=> 'p_prev',
											'tag'=> 'li',
											'escape'=>false
										),
										null,
										array(
											'class'=>'pagination',
											'escape'=>false,
										   'tag'=> 'li',
											'disabledTag'=>'a'
										)
									);
									echo $paginator->numbers(array(
									   'tag'=> 'li',
										'span'=>false,
										'currentClass' => 'pagination',
										'currentTag' => 'a',
										'separator' => false,
										'class' => "pagination"
										
									));    
									echo $paginator->next(__('Next', true),
										array(
											'id'=> 'p_next',
											'tag'=> 'li',
											'escape'=>false
										),
										null,
										array(
											'class'=>'pagination',
											'escape'=>false,
										   'tag'=> 'li',
											'disabledTag'=>'a'
										)
									);
								?>
								</ul>
							</div>
						 </div>
					</div>					
				</div>				
			</div>			
		</div>		
	</div>
</div>