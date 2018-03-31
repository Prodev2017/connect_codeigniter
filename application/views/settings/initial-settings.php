<?php $this->load->view('layout/header');?>
	<div class="main-section-full settings">
		<div class="card">
			<div class="card-header main-header">
				<a href="<?php echo base_url('settings');?>">Account Settings</a> <i class="fa fa-chevron-right" aria-hidden="true"></i> <span id="current-page"> Initial Settings </span>
			</div>
			<div class="card-body">

				<div id="initial_settings" class="card-block">
					<div class="media d-flex">
						<div class="media-body" >
							<h5>System Status</h5>
								<div class="gray-table-container">
									<h5> Xero </h5>
									<div class="row">
										<div class="col-12">
											<label> Connected Status: </label>
											<div class = "connection-status-container pull-right">
												<i class="fa fa-times"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="gray-table-container">
									<h5> GoCardless </h5>
									<div class="row">
										<div class="col-12">
											<label> Connected Status: </label>
											<div class = "connection-status-container pull-right"  >
												<i class="fa fa-times"></i>
											</div>
										</div>
									</div>
									<div class = "row">
										<div class="col-12">
											<label>Last Payment:</label>
											<div class="system-status-data pull-right">
												<div class="gocardless-last-payment">
														data
												</div>
											</div>
										</div>
									</div>
									<div class = "row">
										<div class="col-12">
											<label>Last 30 days: </label>
											<div class="system-status-data pull-right">
												<div class = "gocardless-last-30-days">
														data
												</div>
												<div class="gocardless-last-30-days-percent pull-right">
														%
												</div>
											</div>
										</div>
									</div>
									<div class = "row">
										<div class="col-12">
											<label>Previous 30 days: </label>
											<div class="system-status-data pull-right">
												<div class=" gocardless-previous-30-days">
													data
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="gray-table-container">
									<h5> Stripe </h5>
									<div class="row">
										<div class="col-12">
											<label> Connected Status: </label>
											<div class = "connection-status-container pull-right">
												<i class="fa fa-times"></i>
											</div>
										</div>
									</div>
									<div class = "row">
										<div class="col-12">
											<label>Last Payment:</label>
											<div class="system-status-data pull-right">
												<div class="stripe-last-payment">
													data
												</div>
											</div>
										</div>
									</div>
									<div class = "row">
										<div class="col-12">
											<label>Last 30 days: </label>
											<div class="system-status-data pull-right">
												<div class = "stripe-last-30-days">
													data
												</div>
												<div class="stripe-last-30-days-percent pull-right">
													%
												</div>
											</div>
										</div>
									</div>
									<div class = "row">
										<div class="col-12">
											<label>Previous 30 days: </label>
											<div class="system-status-data">
												<div class="stripe-previous-30-days pull-right">
													data
												</div>
											</div>
										</div>
									</div>
								</div>
						</div>
					</div>
					<div class="card-block-footer">
						<div class="row">
							<div class="col-12">
								<a href="<?php echo base_url();?>settings/my-business"><button class="btn btn-primary pull-right"> Next</button></a>
							</div>
						</div>
					</div>		
				</div> <!-- #initial_settings -->

			</div><!-- .card-body -->
		</div><!-- .card -->
	</div><!-- main-section-full -->
<?php $this->load->view('layout/footer');?>
