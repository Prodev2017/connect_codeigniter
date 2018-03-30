<?php
	$this->load->view('layout/header');
?>
		
		<div class="main-section-subnav-full">
					
			<h2>EDIT/VIEW CONTACT DETAILS</h2>

			<div class="desktop">
				<p>Two line explanation in here telling people how this works and what they can expect in return. Always using the adage; put shit  in – get shit back out… </p>
			</div><!-- end of desktop -->
			
			<div class="clearfix"></div><div class="clear-10"></div>

			<div class="profile-card outer">
								
				<section>
										
					<div class="row">
					
					<div class="section-left-form-subnav">
						<div class="row">
							<div class="col-8  col-sm-12 col-lg-12">
								<div class="row">
									<div class="col-12">
										<label for="first_name" class="align-middle label">First name<?php echo $opportunity_id ?></label>
										<input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo $contact_single['first_name']; ?>" placeholder="First Name"> <div class="clear-input">x</div>
									</div>
									<div class="col-12">
										<label for="last_name" class="align-middle label">
											Last name
										</label>
										<input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo $contact_single['last_name']; ?>" placeholder="Last Name"> <div class="clear-input">x</div>
									</div>
								</div>
							</div>
							<div class="col-4 col-sm-12  col-lg-12 d-sm-none">
								<img src="<?php echo $contact_single['grav']; ?>" alt="<?php echo $contact_single['name']; ?>">
							</div>

						</div><!-- end of row -->
				

						<?php foreach ($contact_single['companies'] as $company) {


						 ?>

						<div class="company_box">

						<div class="clearfix"></div><div class="clear-10"></div>
							
						<div class="row">

							<div class="col-8 col-sm-12">
								<label for="company" class="align-middle label">
									Company
								</label>
								<input type="text" id="company" name="company" class="form-control" value="<?php echo $company->company_name; ?>" placeholder="Company Name"> <div class="clear-input">x</div>
							</div>
							<div class="col-4  col-sm-12">
								<label for="red_no" class="align-middle label">
									Reg No
								</label>
								<input type="text" id="reg_no" name="reg_no" class="form-control" value="<?php echo $contact_single['reg_no']; ?>" placeholder="Reg No"> <div class="clear-input">x</div>
							</div>

						</div><!-- end of row -->

						<div class="row f-hide-small">

							<div class="col-12">
								<label for="address" class="align-middle label">
									Address Line 1
								</label>
								<input type="text" id="address" name="address1" class="form-control" value="<?php echo $company->address->address_line1; ?>" placeholder="Address Line 1">  <div class="clear-input">x</div>
							</div>


						</div><!-- end of row -->
							
							<div class="row f-hide-small">

							<div class="col-12">
								<label for="address2" class="align-middle label">
									Address Line 2
								</label>
								<input type="text" id="address2" name="address2" class="form-control" value="<?php echo $company->address->address_line2; ?>" placeholder="Address Line 2">  <div class="clear-input">x</div>
							</div>


						</div><!-- end of row -->
							
							<div class="row f-hide-small">

							<div class="col-12">
								<label for="address3" class="align-middle label">
									Address Line 3
								</label>
								<input type="text" id="address3" name="address3" class="form-control" value="<?php echo $company->address->address_line3; ?>" placeholder="Address Line 3"> <div class="clear-input">x</div>
							</div>

						</div><!-- end of row -->
														
						<div class="row f-hide-small">

							<div class="col-12">
								<label for="postcode" class="align-middle label">
									Town / City
								</label>
								<input type="text" id="address" name="city" class="form-control" value="<?php echo $company->address->city; ?>" placeholder="City"> <div class="clear-input">x</div>
							</div>
						</div><!-- end of row -->

						<div class="row">
							
							<div class="col-8  col-sm-12">
								<label for="address4" class="align-middle label">
									County
								</label>
								<input type="text" id="address4" name="address4" class="form-control" value="<?php echo $company->address->address_line4; ?>" placeholder="County">  <div class="clear-input">x</div>
							</div>

							
							<div class="col-4  col-sm-12">
								<label for="postcode" class="align-middle label">
									Postcode
								</label>
								<input type="text" id="postcode" name="postcode" class="form-control" value="<?php echo $company->address->postal_code; ?>" placeholder="Postal Code">  <div class="clear-input">x</div>
							</div>

						</div><!-- end of row -->
						<div class="row">

							<div class="col-12">
								<label for="country" class="align-middle label">
									Country
								</label>
								<input type="text" id="country" name="country" class="form-control" value="<?php echo $company->address->country; ?>" placeholder="Address Line 1">  <div class="clear-input">x</div>
							</div>


						</div><!-- end of row -->

						<div class="row">
							
							<div class="col-6  col-sm-12">
								<label for="country" class="align-middle label">
									Title
								</label>
								<input type="text" id="title" name="title" class="form-control" placeholder="Title"> <div class="clear-input">x</div>
							</div>

							<div class="col-6  col-sm-12">
								<label for="phone" class="align-middle label">
									Phone
								</label>
								<input type="text" id="phone" name="phone" class="form-control" value="" placeholder="Phone">  <div class="clear-input">x</div>
							</div>
							
						</div><!-- end of row -->

						<div class="row">

							<div class="col-6  col-sm-12">
								<label for="Email" class="align-middle label">Email</label>
								<input type="text" id="email" name="email" class="form-control" value="<?php echo $contact_single['email']; ?>" placeholder="Email"> <div class="clear-input">x</div>
							</div>

							<div class="col-6  col-sm-12">
								<label for="website" class="align-middle label">
									Website
								</label>
								<input type="text" id="website" name="website" class="form-control" value="<?php echo $company->website; ?>" placeholder="Website"> <div class="clear-input">x</div>
							</div>

						</div><!-- end of row -->

					    </div>

					    <?php } ?>
						<div class="f-hide-large">
							<button type="button" class="btn btn-primary btn-block" id="edit-full-record">EDIT FULL RECORD</button>
						</div>
						<div class="f-hide-small">
						<div class="float-right">
							<button type="button" class="btn btn-primary btn-save">SAVE</button>
						</div><!-- end of float right -->

						<div class="clearfix"></div><div class="clear-20"></div>

						<h5>TAGS</h5>
							<hr>

						<fieldset>				

							<legend>STATUS</legend>
							<button type="button" class="btn btn-primary btn-tag">PROSPECT</button>
							<button type="button" class="btn btn-primary btn-tag">ACTIVE CLIENT</button>
							<button type="button" class="btn btn-primary btn-tag">PAST CLIENT</button>


							<legend>INTEREST AREAS</legend>

							<button type="button" class="btn btn-primary btn-tag">PROSPECT</button>
							<button type="button" class="btn btn-primary btn-tag">ACTIVE CLIENT</button>
							<button type="button" class="btn btn-primary btn-tag">PAST CLIENT</button>
							<button type="button" class="btn btn-primary btn-tag">PAST CLIENT</button>
							<button type="button" class="btn btn-primary btn-tag">PAST CLIENT</button>

						</fieldset>

						<hr>

						<fieldset>

							<legend>GENDER</legend>

							<button type="button" class="btn btn-primary btn-tag">MALE</button>
							<button type="button" class="btn btn-primary btn-tag">FEMALE</button>

						</fieldset>

						<hr>

						<fieldset>

							<legend>COUNTRY</legend>

							<div class="row">

								<div class="col-8 col-xl-12 col-md-8 col-lg-8">
									<input type="text" name="add-tag" placeholder="Autofill box, just start typing and press enter to add tag." class="form-control">
								</div>
								<div class="col-4 col-xl-6 col-md-4 col-lg-4">
									<button type="button" class="btn btn-primary">ADD TAG</button>
								</div>

							</div><!-- end or row -->

							<div class="clearfix"></div><div class="clear-15"></div>

							<button type="button" class="btn btn-primary btn-tag">GREAT BRITAIN</button>

						</fieldset>

						<hr>

						<fieldset>

							<legend>CLIENT VALUE &pound;</legend>

							<button type="button" class="btn btn-default btn-tag">< &pound;1000</button>
							<button type="button" class="btn btn-primary btn-tag">&pound;1000 - &pound;5000</button>
							<button type="button" class="btn btn-default btn-tag">&pound;5000 - &pound;15000</button>
							<button type="button" class="btn btn-default btn-tag">&pound;15000 - &pound;50000</button>
							<button type="button" class="btn btn-default btn-tag">> &pound;1000</button>

						</fieldset>

						<hr>

						<fieldset>

							<legend>UNIQUE TAGS</legend>

							<div class="row">

								<div class="col-8 col-xl-12 col-md-8 col-lg-8">
									<input type="text" name="add-tag" placeholder="Autofill box, just start typing and press enter to add tag." class="form-control">
								</div>
								<div class="col-4 col-xl-6 col-md-4 col-lg-4">
									<button type="button" class="btn btn-primary">ADD FIELD</button>
								</div>

							</div><!-- end or row -->

							<div class="clearfix"></div><div class="clear-15"></div>

							<button type="button" class="btn btn-primary btn-tag">FOOD &amp; DRINK</button>
							<button type="button" class="btn btn-primary btn-tag">EVENTS</button>
							<button type="button" class="btn btn-primary btn-tag">LUXURY ITEMS</button>
							<button type="button" class="btn btn-primary btn-tag">CONSTRUCTION</button>
							<button type="button" class="btn btn-primary btn-tag">WHOLESALE</button>
							<button type="button" class="btn btn-primary btn-tag">RETAIL</button>
							<button type="button" class="btn btn-primary btn-tag">YACHTS</button>
							<button type="button" class="btn btn-primary btn-tag">ELON MUSK</button>

						</fieldset>
							
						<h5>ADD CUSTOM FIELDS</h5>
							<hr>
							
							<div class="clearfix"></div><div class="clear-10"></div>
							<div class="row">
								<div class="col-12">
									<input type="text" name="custom-field" placeholder="Autofill box, just start typing and press enter to add tag." class="form-control">
								</div>
							</div>
							<div class="row">
								<div class="col-8 col-xl-12 col-md-8 col-lg-8">
									<select name="type_of_field" class="form-control" id="type_of_field">
											<option value="">Type of Field</option>
									</select>
								</div>
								<div class="col-4 col-xl-6 col-md-4 col-lg-4">
									<button type="button" class="btn btn-primary">ADD FIELD</button>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<label for="personality" class="align-middle label">Personality</label>
									<input type="text" name="personality" class="form-control" id="personality" placeholder="Personality">
								</div>
							</div><!-- end or row -->
							<div class="row">
								<div class="col-12">
									<label for="time_in_business" class="align-middle label">Time in Business (years)</label>
									<input type="text" name="time_in_business" class="form-control" id="time_in_business" placeholder="Time in Business (years)">
								</div>
							</div><!-- end or row -->
							
							<div class="clearfix"></div><div class="clear-6"></div>
							<fieldset>
								<div class="row">
									<div class="col-xl-5 col-lg-12 text-right">
										<button type="button" class="btn btn-primary  btn-save">SAVE</button>
										<button type="button" class="btn btn-primary cancel">CANCEL</button>
										
									</div>
									
								</div><!-- end of row -->
								
							</fieldset>
						</div><!-- f-hide-small  -->
							
						</div><!-- section left form -->

						<aside class="card-breakdown">

						<div class="profile-card">

							<a class="overlay_link" href="<?php echo base_url(); ?>connection"></a>

							<header class="profile-card bg-blue">
								<div class="row">
									<div class="col-md-8">
										<?php foreach ($contact_single['companies'] as $company) {
										 ?>

											<?php if (!empty($company->company_name)) { ?>
	                    <span><?php echo $company->company_name; ?></span>
	                    <?php } ?>
										<?php } ?>
									</div>
									<div class="col-md-4 text-right">
										<span><strong>INSPIRE</strong></span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 text-right">
										<span>SALES TO DATE: &pound;<?php echo $contact_single['sales_to_date']; ?></span>
									</div>
								</div>
							</header>

							<section class="bd-blue">
								<div class="row">
									<div class="col-sm-12">
										<h5><?php echo $contact_single['name']; ?></h5>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-4">
										 <?php if (!empty($contact_single['address'])) { ?>
											 <address>
											 <?php echo $contact_single['address']; ?>
											 </address>
										 <?php } ?>
									</div>
									<div class="col-sm-5">
										<table>
											<?php if (!empty($contact_single['job_title'])) { ?>
			                <tr>
				                <td><strong>Title:</strong></td>
			                 	<td><?php echo $contact_single['job_title']; ?></td>
	                    </tr>
	                    <?php } ?>

											<?php if (!empty($contact_single['phone'])) { ?>
		                  <tr>
				                <td><strong>Phone:</strong></td>
			                 	<td><?php echo $contact_single['phone']; ?></td>
	                    </tr>
	                    <?php } ?>

	                    <?php if (!empty($contact_single['email'])) { ?>
	                    <tr>
			                	<td><strong>Email:</strong></td>
			                	<td><a href="mailto:<?php echo $contact_single['email']; ?>" target="_blank"><?php echo $contact_single['email']; ?></a></td>
	                    </tr>
	                    <?php } ?>

	                    <?php if (!empty($contact_single['website'])) { ?>
	                    <tr>
			                 	<td><strong>Web:</strong></td>
			                  	<td><a href="<?php echo $contact_single['website']; ?>" target="_blank"><?php echo $contact_single['website']; ?></a></td>
	                    </tr>
	                    <?php } ?>
		                </table>
									</div>

									<div class="col-sm-3 text-right">
										<img src="<?php echo $contact_single['grav']; ?>" alt="<?php echo $contact_single['name']; ?>">
									</div><!-- end of col-sm-4 -->
								</div>
							</section>
						</div><!-- end of profile card -->
						<?php $this->load->view('layout/planned-past'); ?>
					</aside>
							
				</div><!-- end of row -->
					
			</section>
							
		</div><!-- end of profile card -->
<?php
	$this->load->view('layout/footer');
?>