<?php $this->load->view('layout/header');?>
	<div class="main-section-full settings">
		<div class="card">
			<div class="card-header main-header">
				<a href="<?php echo base_url('settings');?>">Account Settings</a> <i class="fa fa-chevron-right" aria-hidden="true"></i> <span id="current-page"> Connected Apps </span>
			</div>
			<div class="card-body">
				<div id="connected-apps" class="card-block">
					<div class="row">
						<div class="col-12">
            				connected-apps
						</div>
					</div>
					<div class="card-block-footer">
						<div class="row">
							<div class="col-12">
								<a href="<?php echo base_url();?>settings/tags"><button class="btn btn-primary"> Back</button></a>
								<a href="<?php echo base_url();?>settings/import"><button class="btn btn-primary pull-right"> Next</button></a>
							</div>
						</div>
					</div>
				</div><!-- #connected-apps -->
			</div><!-- .card-body -->
		</div><!-- .card -->
	</div><!-- main-section-full -->
<?php $this->load->view('layout/footer');?>
