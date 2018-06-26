<div id="page-wrapper">
	<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h1 class="page-header">All Reviews List</h1>
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
									<?php echo $this->Form->create('Reviews',array('type' => 'get')); ?>
									<div class="col-sm-5"> <?php echo $this->Form->text("full_name",array('class' =>'form-control','placeholder' => 'Search by user','value' => isset($requestedQuery['full_name']) ? $requestedQuery['full_name'] : '')); ?></div>
									<div class="col-sm-3">
										<?php echo $this->Form->text("comment",array('class' =>'form-control','placeholder' => 'Search by review','value' => isset($requestedQuery['comment']) ? $requestedQuery['comment'] : '')); ?>
									</div>
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
									<th width="15%">Review For</th>
									<th width="15%">Review Posted By</th>
									<th width="45%">Review</th>
									<th width="5%">Rating</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($reviews as $casino):
										$id	=	$casino->id;
										?>
										<tr>
											<td><?php 
											if(isset($casino->casino->title)){
												
												$name	=	$casino->casino->title;
												$slug	=	 $casino->casino->slug;
												
												if(isset($casino->casino->type) && $casino->casino->type == 'online'){ 
													$htmlurl	=	['plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view'=>$slug.'#review_div','prefix' => false];
												}else{
													$htmlurl	=	['plugin' => '','controller' => 'casinos','action' => 'casino_view','casino_view'=>$slug.'#review_div','prefix' => false];					   
												}
												   
											}else if(isset($casino->country->name)){
												$name	=	 $casino->country->name;
												
												$slug		=	$casino->country->slug;
												$htmlurl	=	['plugin' => '','controller' => 'users','action' => 'country_view','country_view'=>$slug.'#review_div','prefix' => false];
												
											}else if(isset($casino->city->name)){
												$name			=	 $casino->city->name;
												$slug			=	 $casino->city->slug;
												
												$countrySlug	=	isset($casino->city->c_country->slug) ? $casino->city->c_country->slug : '';
					
												$htmlurl	=	['plugin' => '','controller' => 'users','action' => 'city_view','country'=>$countrySlug,'city'=>$slug,'prefix' => false];
												
											} echo $this->Html->link($name,$htmlurl,['target' => '_blank']); ?></td>
											<td><?php echo $this->Html->link($casino->user->full_name,['plugin' => '','controller' => 'users','action' => 'user_slug','user_slug'=>$casino->user->slug,'prefix' => false],['target' => '_blank']); ?></td>
											<td><?= h(html_entity_decode($casino->comment)) ?></td>
											<td><?= h($casino->rating) ?></td>
											<td>
												<?php $is_feat	=	($casino->is_feature == 1) ? 0 : 1;
												$title		=	($casino->is_feature == 1) ? 'Mark As Unfeatured' : 'Mark As featured';
												$title1		=	($casino->is_feature == 1) ? 'Click To Mark As Unfeatured' : 'Click To Mark As Featured';
												$class		=	($casino->is_feature == 1) ? 'btn btn-info' : 'btn btn-warning';
												// echo $this->Html->link($title,['action' => 'feat',$casino->id,$is_feat],['class' => $class,'title' => $title1]); ?>
												
												<?php //echo $this->Html->link(__('Edit'), 'javascript:void(0);',['class' => 'btn btn-primary edit_review','data-id' => $casino->id,'data-content' => html_entity_decode($casino->comment)]) ?>
												<?= $this->Form->postLink(__('Delete The Review'), ['action' => 'delete', $casino->id], ['confirm' => __('Are you sure you want to delete the review', $casino->id),'class' => 'btn btn-danger']) ?>
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
<div class="modal fade" id="edit_review" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content photoPoup">
			<div class="popupIn">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo $this->Url->build('/users/report_as_spam'); ?>" id="report_span_form" accept-charset="utf-8" method="post" class="ng-pristine ng-valid">
						 <?php echo $this->Form->hidden('foreign_key',['id' => 'report_span_foreignkey']); ?>
						<div class="reviewBtn">
							<div id="report_span_form_error_div"></div>

							<input type="submit" class="btn red_btn report_span_update" value="Submit" />
					  </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php  $this->Html->scriptStart(array('block' => 'custom_script')); ?>
$(".edit_review").click(function(){
	$("#edit_review").modal('open');
});
<?php $this->Html->scriptEnd(); ?>