<?php $this->load->view('layout/header');?>
	<div class="main-section-full settings">
		<div class="card">
			<div class="card-header main-header">
				<a href="<?php echo base_url('settings');?>">Account Settings</a> <i class="fa fa-chevron-right" aria-hidden="true"></i> <span id="current-page">  </span>
			</div>
			<div class="card-body">
				<div class="card-block" id="users">
					<h6>Users, Roles, Statuses Address (default from company record details but editable) Phone (default from company record details but editable) Social Media profiles (default from company record details but editable) </h6>
					<div class="row">
						<div class="col-12">
							<div class="table-responsive">
								<table id="crm-users" class="table table-striped">
									<thead>
										<tr>
											<th>First Name</th>
											<th>Last Name</th>
											<th>Email</th>
											<th>Status</th>
											<th>Company</th>
											<th>Address</th>
											<th>Phone</th>
											<th>Job Title</th>
											<th>Twitter</th>
											<th>LinkedIn</th>
											<th>You Tube</th>
											<th>Faebook</th>
											<th>Groups</th>
											<th>Status</th>
											<th class="text-center">Actions</th> <!-- actions -->
										</tr>
									</thead>
									<tbody>
										<!-- Get the current users company name -->
										<?php $this_company = $user->company; ?>
										<!-- Loop through all users  -->
										<?php foreach ($users as $user):?>
											<!-- If another users company is the same then display them in the table-->
											<?php if($user->company ==  $this_company):?>
												<tr>
													<td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
													<td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
													<td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
													<td> <?php echo ($user->active) ? anchor("admin/deactivate/".$user->id, lang('index_active_link')) : anchor("admin/activate/". $user->id, lang('index_inactive_link'));?></td>
													<td><?php echo htmlspecialchars($user->company, ENT_QUOTES, 'UTF-8');?></td>
													<td><?php echo htmlspecialchars($user->address,ENT_QUOTES,'UTF-8');?> </td>
													<td> <?php echo htmlspecialchars($user->phone, ENT_QUOTES, 'UTF-8');?></td>
													<td> <?php echo htmlspecialchars($user->phone, ENT_QUOTES, 'UTF-8');?></td>
													<td> <?php echo $account->twitter; ?>  </td>
													<td> <?php echo $account->linkedin; ?> </td>
													<td> <?php echo $account->youtube; ?>  </td>
													<td> <?php echo $account->facebook; ?> </td>
													<td> <?php echo $account->facebook; ?> </td>
													<td> <?php echo $account->facebook; ?> </td>
													<td class="text-center">
														<a href="<?php echo base_url() ?>user/edit_user" >Edit</a>
													</td>
												</tr>
											<?php endif;?>
										<?php endforeach;?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="card-block-footer">
						<div class="row">
							<div class="col-12">
								<a href="<?php echo base_url();?>settings/my-business"><button class="btn btn-primary"> Back</button></a>
								<a href="<?php echo base_url();?>settings/workflows"><button class="btn btn-primary pull-right"> Next</button></a>
							</div>
						</div>
					</div>
				</div><!-- #users -->
			</div><!-- .card-body -->
		</div><!-- .card -->
	</div><!-- main-section-full -->
<?php $this->load->view('layout/footer');?>
