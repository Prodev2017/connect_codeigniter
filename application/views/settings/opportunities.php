<?php $this->load->view('layout/header');?>
	<div class="main-section-full settings">
		<div class="card">
			<div class="card-header main-header">
				<a href="<?php echo base_url('settings');?>">Account Settings</a> <i class="fa fa-chevron-right" aria-hidden="true"></i> <span id="current-page"> Opportunities </span>
			</div>
			<div class="card-body">
				<div id="opportunities" class="card-block">
					<div class="row">
						<div class="col-12">
            				opportunities
						</div>
					</div>
					<div class="card-block-footer">
						<div class="row">
							<div class="col-12">
								<a href="<?php echo base_url();?>settings/automation"><button class="btn btn-primary"> Back</button></a>
								<a href="<?php echo base_url();?>settings/templates"><button class="btn btn-primary pull-right"> Next</button></a>
							</div>
						</div>
					</div>
				</div><!-- #opportunities -->
			</div><!-- .card-body -->
		</div><!-- .card -->
	</div><!-- main-section-full -->
<?php $this->load->view('layout/footer');?>
