<?php
	$this->load->view('layout/header');
?>
		
		<div class="main-section-subnav">

			<section class="tab-current">

				<h2>SET DEADLINE</h2>

				<form>
					
					<input type="text" name="type-of-deadline" placeholder="Type of deadline" class="form-control">
						
					<div class="row">
						
						<div class="col-xl-4 col-lg-12">
							
							<input type="text" class="form-control datepicker" placeholder="Date">
							
						</div>
						
						<div class="col-xl-4 col-lg-12">
							
							<input type="text" class="form-control" placeholder="Start time">
							
						</div>
						
						<div class="col-xl-4 col-lg-12">
							
							<select class="form-control" id="signoff_required">
								<option value="">Sign off required</option>
								<option value="__">Yes</option>
								<option value="__">No</option>
							</select>
							
							<div class="clear-5"></div>
							
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
	$this->load->view('layout/sidebar-opportunities');
	$this->load->view('layout/footer');
?>