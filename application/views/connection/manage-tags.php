<?php
	$this->load->view('layout/header');
?>
		
		<div class="main-section-subnav">

			<section class="tab-current">

				<h2>MANAGE TAGS</h2>

				<form>
					
					<fieldset>
					
						<legend>STATUS</legend>
						
						<button type="button" class="btn btn-primary btn-tag">PROSPECT</button>
						<button type="button" class="btn btn-primary btn-tag">ACTIVE CLIENT</button>
						<button type="button" class="btn btn-primary btn-tag">PAST CLIENT</button>
						
					</fieldset>
										
					<fieldset>
					
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
						
							<div class="col-xl-9 col-lg-12">
								<input type="text" name="add-tag" placeholder="Autofill box, just start typing and press enter to add tag." class="form-control">
							</div>
							<div class="col-xl-3 col-lg-12">
								<button type="button" class="btn btn-primary btn-block">ADD TAG</button>
							</div>
							
						</div><!-- end or row -->
						
						<div class="clearfix"></div><div class="clear-15"></div>
						
						<button type="button" class="btn btn-primary btn-tag">GREAT BRITAIN</button>
						<button type="button" class="btn btn-primary btn-tag">WALES</button>
						<button type="button" class="btn btn-primary btn-tag">FRANCE</button>
						
					</fieldset>
					
					<hr>
					
					<fieldset>
					
						<legend>CLIENT VALUE &pound;</legend>
						
						<button type="button" class="btn btn-primary btn-tag">< &pound;1000</button>
						<button type="button" class="btn btn-primary btn-tag">&pound;1000 - &pound;5000</button>
						<button type="button" class="btn btn-primary btn-tag">&pound;5000 - &pound;15000</button>
						<button type="button" class="btn btn-primary btn-tag">&pound;15000 - &pound;50000</button>
						<button type="button" class="btn btn-primary btn-tag">> &pound;1000</button>
						
					</fieldset>
					
					<hr>
						
					<fieldset>
					
						<legend>UNIQUE TAGS</legend>
						
						<div class="row">
						
							<div class="col-xl-9 col-lg-12">
								<input type="text" name="add-tag" placeholder="Autofill box, just start typing and press enter to add tag." class="form-control">
							</div>
							<div class="col-xl-3 col-lg-12">
								<button type="button" class="btn btn-primary btn-block">ADD FIELD</button>
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
						
				</form>

				<div class="clearfix"></div>

			</section><!-- end of tab current -->
			
			<?php $this->load->view('layout/planned-past'); ?>

		</div><!-- end of form block -->
									
<?php
	$this->load->view('layout/sidebar');
	$this->load->view('layout/footer');
?>