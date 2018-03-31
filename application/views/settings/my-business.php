<?php $this->load->view('layout/header');?>
	<div class="main-section-full settings">
		<div class="card">
			<div class="card-header main-header">
				<a href="<?php echo base_url('settings');?>">Account Settings</a> <i class="fa fa-chevron-right" aria-hidden="true"></i> <span id="current-page"> My Business  </span>
			</div>
			<div class="card-body">
				<div class="card-block" id="my_business">
					  <!-- when you place an action in forms the folder structure is "controller/function" -->
					<form id="formEditSettings" action="<?php echo base_url(); ?>settings/edit_business_settings" method="POST">
						<div class="form-group">
							<label for="company">Company</label>
							<input type="text" class="form-control" id="company">
						</div>
						<div class="form-group">
							<label for="branches">Branches</label>
							<input type="text" class="form-control" id="branches">
						</div>
						<div class="form-group">
							<label for="address">Address</label>
							<input type="text" class="form-control" id="address">
						</div>
						<div class="form-group">
							<label for="phone">Phone</label>
							<input type="text" class="form-control" id="phone">
						</div>
						<hr>
						<h5> Connect your social media accounts below:</h5>
							<!-- social media buttons -->
							<div class="row">
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-linkedin"></i></div>
									<input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="LinkedIn">
									</div>
								</div>
							</div>

							<div class="col-12 col-sm-6">
								<div class="form-group">
									<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-twitter"></i></div>
									<input type="text" class="form-control" id="twitter" name="twitter" placeholder="Twitter">
									</div>
								</div>
							</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-6">
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-addon"><i class="fa fa-facebook"></i></div>
											<input type="text" class="form-control" id="facebook" name="facebook" placeholder="Facebook">
										</div>
									</div>
								</div>

								<div class="col-12 col-sm-6">
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-addon"><i class="fa fa-instagram"></i></div>
												<input type="text" class="form-control" id="instagram" name="instagram" placeholder="Instagram">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-6">
									<div class="form-group">
										<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-google-plus"></i></div>
										<input type="text" class="form-control" id="google-plus" name="google-plus" placeholder="Google+">
										</div>
									</div>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-12">
									<h5>Proposals:</h5>
									<div class="form-group">
										<label for="header">Header:</label>
										<textarea name="header"><?php echo $account->header; ?></textarea>
									</div>
									<div class="form-group">
										<label for="footer">Footer:</label>
										<input type="text" class="form-control" name="footer"  value="<?php echo $account->footer; ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<button class="btn btn-primary" type="submit">Save</button>
								</div>
							</div>

					</form>
					<div class="card-block-footer">
						<div class="row">
							<div class="col-12">
								<a href="<?php echo base_url();?>settings/initial-settings"><button class="btn btn-primary"> Back</button></a>
								<a href="<?php echo base_url();?>settings/users"><button class="btn btn-primary pull-right"> Next</button></a>
							</div>
						</div>
					</div>
				</div><!-- #my-business -->
			</div><!-- .card-body -->
		</div><!-- .card -->
	</div><!-- main-section-full -->
	<script src="<?php echo base_url(); ?>assets/js/tinymce.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/wysiwyg-editor.js"></script>
<?php $this->load->view('layout/footer');?>
