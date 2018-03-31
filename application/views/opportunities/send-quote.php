<?php
	$this->load->view('layout/header');
?>
		
		<div class="main-section-subnav">

			<section class="tab-current">

				<h2>SEND QUOTE</h2>

				<form>
					
					<input type="text" class="form-control" placeholder="Quote title:">
					
					<div class"row">
													
							<select class="form-control" id="quote_template">
								<option value="--">Quote Template</option>
							</select>
																			
					</div><!-- end of row -->
									
					<div class="row">
						
						<div class="col-xl-4 col-lg-12">
							<input type="text" class="form-control datepicker" placeholder="Send date:">
						</div>
						
						<div class="col-xl-4 col-lg-12">
							<input type="text" class="form-control" placeholder="Scheduled time:">
						</div>
						
						<div class="col-xl-4 col-lg-12">
							<input type="text" class="form-control datepicker" placeholder="Deadline:">
						</div>
						
					</div><!-- end of row -->
															
					<textarea class="form-control wysiwyg"></textarea>
					
					<fieldset>
						<legend>PRODUCT SELECTOR</legend>
						
						<div class="quote_builder">
						
							<div class="quote-row">

								<div class="quote_item">

									<label for="item">
										ITEM
									</label>
									<div class="clearfix"></div>
									<input type="text" name="item" class="form-control">

								</div>

								<div class="quote_description">

									<label for="description">
										DESCRIPTION
									</label>
									<div class="clearfix"></div>
									<input type="text" name="description" class="form-control">

								</div>

								<div class="quote_quantity">

									<label for="quantity">
										QUANTITY
									</label>
									<div class="clearfix"></div>
									<input type="text" name="quantity" class="form-control">

								</div>

								<div class="quote_unitprice">

									<label for="unit_price">
										UNIT PRICE
									</label>
									<div class="clearfix"></div>
									<span class="label-left" for="unit_price">
										&pound;
									</span>
									<span class="form-right">
										<input type="text" class="form-control" id="unit_price">
									</span>

								</div>

								<div class="quote_subtotal">

									<label for="sub_total">
										SUB TOTAL
									</label>
									<div class="clearfix"></div>
									<span class="label-left" for="sub_total">
										&pound;
									</span>
									<span class="form-right">
										<input type="text" class="form-control" id="sub_total">
									</span>

								</div>

								<div class="quote_managerows">
									<div class="float-right">
										<div class="remove_row"></div>
										<div class="add_row"></div>
									</div><!-- end of float right -->

								</div>

								<div class="clearfix"></div>

							</div><!-- end of quote row -->

							<div class="clearfix"></div>
							
						</div><!-- end of quote builder -->
																			
						<div class="quote_overview">
							
							<div class="quote_total">
							
								<label class="label-left" for="quote_total">
									Total
								</label>
								<span class="form-right">
									<input type="text" class="form-control" id="quote_total">
								</span>

							</div>
							
						</div><!-- end of quote overview -->
						
					</fieldset>

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
	$this->load->view('layout/sidebar-opportunities');
	$this->load->view('layout/footer');
?>