<?php $this->load->view('layout/header');?>
	<div class="main-section-full settings">
		<div class="card">
			<div class="card-header main-header">
				<a href="<?php echo base_url('settings');?>">Account Settings</a> <i class="fa fa-chevron-right" aria-hidden="true"></i> <span id="current-page"> Custom Fields  </span>
			</div>
			<div class="card-body">
				<div id="custom_fields" class="card-block">
					<div class="row">
						<div class="col-12">
							<div> <!-- Custom Fields Tabs -->
								<ul class="nav nav-tabs" id="myTab" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="custom-fields-tab" data-toggle="tab" href="#custom-fields" role="tab" aria-controls="custom-fields" aria-selected="false">Custom Fields</a>
									</li>
									
								</ul>

								<div class="tab-content" id="myTabContent">
									<div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
										<form action="#" method="post" accept-charset="utf-8">
											<div class="form-group">
												<label for="company">Company</label>
												<input type="text" class="form-control" name="company" id="company" value="<?php echo $account->name; ?>">
											</div>
											<div class="form-group">
												<input type="submit" class="btn btn-primary" value="Save">
											</div>
										</form>
									</div>
									<div class="tab-pane fade" id="custom-fields" role="tabpanel" aria-labelledby="custom-fields-tab">
										<button type="button" data-toggle="modal" data-target="#add-header" class="btn btn-info btn-sm"><i class="fa fa-plus"> </i> Add Header</button>
										<?php if (!empty($headers)):?>
										<button type="button" data-toggle="modal" data-target="#add-field" class="btn btn-info btn-sm"><i class="fa fa-plus"> </i> Add Custom Field </button>
										<?php endif; ?>
										<div class="row">
											<?php if (!empty($headers)): ?>
												<?php foreach ($headers as $header): ?>
													<div class="col-12" style="margin-top:15px;">
														<div class="card">
															<div class="card-header"><h5 class="card-header-text"><?php echo $header->header_name;?> <i>(<?php echo $header->location; ?>)</i></h5>
															<div data-toggle="modal" data-target="#header-edit-<?php echo $header->header_id; ?>" class="btn btn-custom-fields"> <i class="fa fa-pencil-square-o"></i></div>
															<div data-toggle="modal" data-target="#warning-<?php echo $header->header_id; ?>" class="btn btn-custom-fields"><i class="fa fa-trash"></i></div>
															<div class="pull-right">
																<a href="" data-toggle="modal" data-target="#input-type-Modal"><i class="fa fa-code"></i></a>
															</div>
														</div>
														<!-- end of modal -->
															<div class="" style="padding:10px;">
																<?php if (!empty($fields[$header->header_id])): ?>
																	<?php foreach ($fields[$header->header_id] as $fields_under_header): ?>
																		<div class="row">
																			<div class="col-sm-4">
																				<?php echo $fields_under_header->field_name; ?>
																			</div>
																			<div class="col-sm-4">
																				<i><?php echo $fields_under_header->field_type; ?></i>
																			</div>
																			<div class="col-sm-4">
																				<a href="<?php echo base_url(); ?>account/delete_field/<?php echo $fields_under_header->field_id; ?>"><div class="btn pull-right btn-custom-fields"> <i class="fa fa-trash"></i></div></a>
																				<div data-toggle="modal" data-target="#edit-<?php echo $fields_under_header->field_id; ?>" class="btn btn-custom-fields pull-right" style="margin-right:15px;"> <i class="fa fa-pencil-square-o"></i></div>
																			</div>
																		</div>
																	<?php endforeach; ?>
																<?php endif; ?>
															</div>
														</div>
													</div>
												<?php endforeach; ?>
											<?php endif; //$headers  ?>
										</div>
									</div>
								</div>
							</div>  <!-- Custom Fields Tabs -->
						</div>
					</div>
					<div class="card-block-footer">
						<div class="row">
							<div class="col-12">
								<a href="<?php echo base_url();?>settings/templates"><button class="btn btn-primary"> Back</button></a>
								<a href="<?php echo base_url();?>settings/tags"><button class="btn btn-primary pull-right"> Next</button></a>
							</div>
						</div>
					</div>
				</div><!-- #custom_fields -->
			</div><!-- .card-body -->
		</div><!-- .card -->
	</div><!-- main-section-full -->
	
<?php $this->load->view('layout/footer');?>
