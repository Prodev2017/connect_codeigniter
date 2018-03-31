<?php
	$this->load->view('layout/header');
?>
		
		<div class="main-section-subnav">

			<section class="tab-current">

				<h2>SEND EMAIL</h2>

				<form>
					
					<input type="text" class="form-control" placeholder="To:">
					
					<input type="text" class="form-control" placeholder="From:">
					
					<input type="text" class="form-control" placeholder="Subject:">
										
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
						<button type="button" class="btn btn-primary">SEND</button>
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