<?php $this->load->view('layout/header');?>
	<div class="main-section-full settings">
		<div class="card">
			<div class="card-header main-header">
				<a href="<?php echo base_url('settings');?>">Account Settings</a>
			</div>
			<div class="card-body">
				<div class="list-items card-block" id="list-items">
					<a href="<?php echo base_url();?>settings/initial-settings" class="btn btn-default settings-card">
						<div class="title">
							1. Initial Setup
						</div>
						<div  class="content">
							Manage your connection to Xero, GoCardless and Stripe
						</div>
					</a>
					<a href="<?php echo base_url();?>settings/my-business" class="btn btn-default settings-card">
						<div class="title">
							2. My Business
						</div>
						<div  class="content">
							Chnage your business contact information, connect to your social media accounts and set default users
						</div>
					</a>
					<a href="<?php echo base_url();?>settings/users" class="btn btn-default settings-card">
						<div class="title">
							3. Users
						</div>
						<div  class="content">
							Manage users associated with this account and edit their contact information
						</div>
					</a>
					<a href="<?php echo base_url();?>settings/workflows" class="btn btn-default settings-card">
						<div class="title">
							4. Workflows
						</div>
						<div  class="content">
							Change workflows names,order and owner
						</div>
					</a>
					<a href="<?php echo base_url();?>settings/stages" class="btn btn-default settings-card">
						<div class="title">
							5. Stages
						</div>
						<div  class="content">
							quiries, connections, sales, getting paid, results 
						</div>
					</a>
					<a href="<?php echo base_url();?>settings/outcomes" class="btn btn-default settings-card">
						<div class="title">
							6. Outcomes
						</div>
						<div  class="content">
							Change the name and associated steps
						</div>
					</a>
					<a href="<?php echo base_url();?>settings/automations" class="btn btn-default settings-card">
						<div class="title">
							7. Automations
						</div>
					</a>
					<a href="<?php echo base_url();?>settings/opportunities" class="btn btn-default settings-card">
						<div class="title">
							8. Opportunities
						</div>
						<div  class="content">
							Categorise opportunities by choosing their name and colours
						</div>
					</a>
					<a href="<?php echo base_url();?>settings/templates" class="btn btn-default settings-card">
						<div class="title">
							9. Templates
						</div>
					</a>
					<a href="<?php echo base_url();?>settings/custom-fields" class="btn btn-default settings-card">
						<div class="title">
							10. Custom Fields
						</div>
					</a>
					<a href="<?php echo base_url();?>settings/tags" class="btn btn-default settings-card">
						<div class="title">
							11. Tags
						</div>
						<div  class="content">
							Create new tags or change an existing tags colour
						</div>
					</a>
					<a href="<?php echo base_url();?>settings/connected-apps" class="btn btn-default settings-card">
						<div class="title">
							12. Connected Apps
						</div>
						<div  class="content">
							Manage your connected apps, check the status of their connection and link to accounting software
						</div>
					</a>
					<a href="<?php echo base_url();?>settings/import" class="btn btn-default settings-card">
						<div class="title">
							13. Import
						</div>
						<div  class="content">
							Import contacts and company records into the system, as well as opportunities and emails from a CSV or another system
						</div>
					</a>
					<a href="<?php echo base_url();?>settings/reports" class="btn btn-default settings-card">
						<div class="title">
							14. Reports
						</div>
						<div  class="content">
							See reports
						</div>
					</a>
				</div>  <!-- .lis-items -->
			</div><!-- .card-body -->
		</div><!-- .card -->
	</div><!-- main-section-full -->
<?php $this->load->view('layout/footer');?>
