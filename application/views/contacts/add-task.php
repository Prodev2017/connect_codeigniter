<?php
	$this->load->view('layout/header');
?>
		
		<div class="main-section-subnav">

			<section class="tab-current">

				<h2>ADD TASK</h2>

				<form>
					
					<div class="row">
						
						<div class="col-xl-8 col-lg-12">
						
							<input type="text" class="form-control" placeholder="Task name">

						</div>
						
						<div class="col-xl-4 col-lg-12">
							
							<select class="form-control" id="task_type" name="task_type">
								<option value="">Task Type</option>
								<option value="__">Type 1</option>
								<option value="__">Type 2</option>
								<option value="__">Type 3</option>
							</select>
							
							<div class="clear-5"></div>
							
						</div>
							
					</div><!-- end of row -->
						
					<div class="row">
						
						<div class="col-xl-4 col-lg-12">
							
							<input type="text" class="form-control datepicker" placeholder="Due date">
							
						</div>
						
						<div class="col-xl-4 col-lg-12">
							
							<input type="text" class="form-control" placeholder="Allocated time">
							
						</div>
						
						<div class="col-xl-4 col-lg-12">
							
							<input type="text" class="form-control" placeholder="Actual time">
							
						</div>
						
					</div><!-- end of row -->
					
					<textarea class="form-control wysiwyg"></textarea>

					<fieldset>
						<legend>ASSIGNED TO</legend>
						<input type="text" class="form-control" placeholder="Name">
					</fieldset>

					<fieldset>
						<legend>LINKED TO</legend>
						<input type="text" class="form-control" placeholder="Project or job">								 
						<input type="text" class="form-control" placeholder="People">								 
						<input type="text" class="form-control" placeholder="Company">								 
					</fieldset>

					<div class="float-right">
						<button type="button" class="btn btn-primary cancel">CANCEL</button>
						<button type="button" class="btn btn-primary">SAVE</button>
					</div><!-- end of float right -->

				</form>

				<div class="clearfix"></div>

			</section><!-- end of tab current -->
			
			<?php $this->load->view('layout/planned-past'); ?>

		</div><!-- end of form block -->		
									
<?php
	$this->load->view('layout/sidebar');
	$this->load->view('layout/footer');
?>