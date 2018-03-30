<?php
	$this->load->view('layout/header');
?>
		
		<div class="main-section-subnav">

			<section class="tab-current">

				<h2>CREATE NOTE</h2>

				<form>

					<input type="text" class="form-control" placeholder="Note title">

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