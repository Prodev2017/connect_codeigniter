<?php
	$this->load->view('layout/header');
?>
		
		<div class="main-section-subnav">

			<section class="tab-current">

				<h2>MAKE CALL</h2>

				<form>

					<input type="text" class="form-control" placeholder="Call details">

					<div class="row" id="timepair">
						
						<div class="col-xl-4 col-lg-12">
							
							<input type="text" class="form-control datepicker" placeholder="Date">
							
						</div>
						
							<div class="col-xl-4 col-lg-12">

								<input type="text" class="form-control time start" placeholder="Start time">

							</div>

							<div class="col-xl-4 col-lg-12">

								<input type="text" class="form-control time end" placeholder="End time">

							</div>
						
					</div><!-- end of row -->
					
					<div class="row">
						
						<div class="col-xl-4 col-lg-12">
							<button type="button" class="btn btn-primary btn-block">MAKE IT A ZOOM MEETING</button>
							<div class="clear-15"></div>
						</div>
						
						<div class="col-xl-8 col-lg-12">
							<input type="text" class="form-control" placeholder="Where">							
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
					</div>

				</form>

				<div class="clearfix"></div>

			</section><!-- end of tab current -->
			
			<?php $this->load->view('layout/planned-past'); ?>

		</div><!-- end of form block -->
									
<?php
	$this->load->view('layout/sidebar-opportunities');
	$this->load->view('layout/footer');
?>