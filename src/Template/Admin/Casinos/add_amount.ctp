
<div id="page-wrapper" style="min-height: 140px;">
<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>	
	<div class="row">
		<div class="col-lg-6">
			<h1 class="page-header">Add new </h1>
		</div>
		<div class="col-lg-6">
			<?php echo $this->Html->link('Back',array('action' => 'casino_amount'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?php echo $this->Form->create($casino,array('role' => 'form','type' => 'file','novalidate' => true)); ?>
								<div class="form-group">
									<label>Title</label>
									<?php echo $this->Form->text("title",array('class' => 'form-control c_title','placesholder' => 'Title','ng-model' => 'name','ng-required' => "required")); ?>   
									<?php echo $this->Form->error("title"); ?>
								</div>
								<div class="form-group">
									<label>Currency</label>
									<?php echo $this->Form->text("currency",array('class' => 'form-control','placesholder' => 'Currency')); ?>
									<?php echo $this->Form->error("currency"); ?>
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