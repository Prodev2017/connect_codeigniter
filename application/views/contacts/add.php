<?php
	$this->load->view('layout/header');
?>

		<div class="main-section-full">

			<h2>ADD NEW CONTACT</h2>
			<div class="desktop">
				<p>Two line explanation in here telling people how this works and what they can expect in return. Always using the adage; put shit  in – get shit back out… </p>
			</div><!-- end of desktop -->

			<div class="clearfix"></div><div class="clear-10"></div>

		  <form id="addcontact" name="addcontact" action="add_contact" method="post">

				<div class="row">

					<div class="col-xl-2 col-lg-12">
						<label for="first_name" class="align-middle">
							First name
						</label>
					</div>
					<div class="col-xl-4  col-lg-12">
						<input type="text" id="first_name" name="first_name" class="form-control">
					</div>
					<div class="col-xl-2  col-lg-12 text-right">
						<label for="last_name" class="align-middle">
							Last name
						</label>
					</div>
					<div class="col-xl-4 col-lg-12">
						<input type="text" id="last_name" name="last_name" class="form-control">
					</div>

				</div><!-- end of row -->

				<div class="row">

					<div class="col-xl-2  col-lg-12">
						<label for="company" class="align-middle">
							Company
						</label>
					</div>
					<div class="col-xl-4 col-lg-12">
						<input type="text" id="company" name="company" class="form-control">
					</div>
					<div class="col-xl-2  col-lg-12 text-right">
						<label for="reg_no" class="align-middle">
							Reg No
						</label>
					</div>
					<div class="col-xl-4 col-lg-12">
						<input type="text" id="reg_no" name="reg_no" class="form-control">
					</div>

				</div><!-- end of row -->

				<div class="row">

					<div class="col-xl-2 col-lg-12">
						<label for="address" class="align-middle">
							Address Line 1
						</label>
					</div>

					<div class="col-xl-10 col-lg-12">
						<input type="text" id="address" name="address_line1" class="form-control">
					</div>

				</div><!-- end of row -->

				<div class="row">

					<div class="col-xl-2 col-lg-12">
						<label for="address_line2" class="align-middle">
							Address Line 2
						</label>
					</div>

					<div class="col-xl-10 col-lg-12">
						<input type="text" id="address_line2" name="address_line2" class="form-control">
					</div>

				</div><!-- end of row -->

				<div class="row">

					<div class="col-xl-2 col-lg-12">
						<label for="address_line3" class="align-middle">
							Address Line 3
						</label>
					</div>

					<div class="col-xl-10 col-lg-12">
						<input type="text" id="address_line3" name="address_line3" class="form-control">
					</div>

				</div><!-- end of row -->

				<div class="row">

					<div class="col-xl-2 col-lg-12">
						<label for="city" class="align-middle">
							Town / City
						</label>
					</div>

					<div class="col-xl-10 col-lg-12">
						<input type="text" id="city" name="city" class="form-control">
					</div>

				</div><!-- end of row -->

				<div class="row">

					<div class="col-xl-2 col-lg-12">
						<label for="address_line4" class="align-middle">
							County
						</label>
					</div>

					<div class="col-xl-10 col-lg-12">
						<input type="text" id="address_line4" name="address_line4" class="form-control">
					</div>

				</div><!-- end of row -->

				<div class="row">
					<div class="col-xl-2 col-lg-12">
						<label for="postal_code" class="align-middle">
							Postcode
						</label>
					</div>
					<div class="col-xl-4 col-lg-12">
						<input type="text" id="postal_code" name="postal_code" class="form-control">
					</div>

					<div class="col-xl-2 col-lg-12 text-right">
						<label for="country" class="align-middle">
							Country
						</label>
					</div>

					<div class="col-xl-4 col-lg-12">
						<input type="text" id="country" name="country" class="form-control">
					</div>

				</div><!-- end of row -->

				<div class="row">

					<div class="col-xl-2 col-lg-12">
						<label for="email" class="align-middle">Email</label>
					</div>

					<div class="col-xl-4 col-lg-12">
						<input type="text" id="email" name="email" class="form-control">
					</div>
					<div class="col-xl-2 col-lg-12 text-right">
						<label for="website" class="align-middle">
							Website
						</label>
					</div>
					<div class="col-xl-4 col-lg-12">
						<input type="text" id="website" name="website" class="form-control">
					</div>

				</div><!-- end of row -->


				<div class="float-right">
					<button type="button" class="btn btn-primary savebutton" >SAVE</button>
				</div><!-- end of float right -->

				<div class="clearfix"></div><div class="clear-20"></div>

				<h5>TAGS</h5>
					<hr>

				<fieldset>
					<legend>STATUS</legend>
					<button type="radio" class="btn btn-primary btn-tag">PROSPECT</button>
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

				<h5>CUSTOM FIELDS</h5>
				<hr>

				<div class="clearfix"></div><div class="clear-10"></div>

				<div class="row">
					<div class="col-xl-3 col-lg-12">
						<label for="personality" class="align-middle">Personality</label>
					</div>
					<div class="col-xl-6 col-lg-12">
						<input type="text" name="personality" class="form-control" id="personality">
					</div>
					<div class="col-xl-3 col-lg-12">
						<button type="button" class="btn btn-primary btn-block">ADD FIELD</button>
					</div>

				</div><!-- end or row -->

				<div class="row">
					<div class="col-xl-3 col-lg-12">
						<label for="personality">Sector(s)</label>
					</div>
					<div class="col-xl-2 col-lg-12">
						<input type="checkbox" name="public_sector" id="public_sector">
						<label for="public_sector">Public sector</label>
					</div>
					<div class="col-xl-2 col-lg-12">
						<input type="checkbox" name="government" id="government">
						<label for="government">Government</label>
					</div>
					<div class="col-xl-2 col-lg-12">
						<input type="checkbox" name="agriculture" id="agriculture">
						<label for="agriculture">Agriculture</label>
					</div>
					<div class="col-xl-2 col-lg-12">
						<input type="checkbox" name="finance" id="finance">
						<label for="finance">Finance</label>
					</div>

				</div><!-- end or row -->

				<div class="clearfix"></div><div class="clear-6"></div>

				<div class="row">
					<div class="col-xl-3 col-lg-12">
						<label for="vehicles">Vehicles</label>
					</div>
					<div class="col-xl-2 col-lg-12">
						<input type="radio" name="vehicles" id="hgv">
						<label for="hgv">HGV</label>
					</div>
					<div class="col-xl-2 col-lg-12">
						<input type="radio" name="vehicles" id="lgv">
						<label for="lgv">LGV</label>
					</div>

				</div><!-- end or row -->

				<div class="clearfix"></div><div class="clear-10"></div>
				<hr>

				<fieldset>

					<legend>ADD FIELDS</legend>

					<div class="row">

						<div class="col-xl-3 col-lg-12">
							<label for="name_of_field" class="align-middle">Name of field</label>
						</div>

						<div class="col-xl-4 col-lg-12">
							<input type="text" class="form-control" name="name_of_field">
						</div>

					</div><!-- end of row -->

					<div class="clearfix"></div><div class="clear-10"></div>

					<div class="row">

						<div class="col-xl-3 col-lg-12">
							<label for="type_of_field" class="align-middle">Type of field</label>
						</div>

						<div class="col-xl-4 col-lg-12">
							<select name="type_of_field" class="form-control" id="type_of_field">
								<option value=""></option>
							</select>
						</div>

						<div class="col-xl-5 text-right">
							<button type="button" class="btn btn-primary savebutton" id="savebutton">CANCEL</button>
							<button type="button" class="btn btn-primary savebutton" id="savebutton">SAVE</button>
						</div>

					</div><!-- end of row -->

				</fieldset>

			</form>
<?php
	$this->load->view('layout/footer');
?>
<script>
	var unsaved=true;
	
	$(document).ready(() => {
		$("#savebutton").click(function(){
			var firstname=document.forms["addcontact"]["first_name"].value;
			var last_name=document.forms["addcontact"]["last_name"].value;
			var company=document.forms["addcontact"]["company"].value;
			var reg_no=document.forms["addcontact"]["reg_no"].value;
			var address_line1=document.forms["addcontact"]["address_line1"].value;
			var address_line2=document.forms["addcontact"]["address_line2"].value;
			var address_line3=document.forms["addcontact"]["address_line3"].value;
			var city=document.forms["addcontact"]["city"].value;
			var address_line4=document.forms["addcontact"]["address_line4"].value;
			var postal_code=document.forms["addcontact"]["postal_code"].value;
			var country=document.forms["addcontact"]["country"].value;
			var email=document.forms["addcontact"]["email"].value;
			var website=document.forms["addcontact"]["website"].value;
			
			var atpos = email.indexOf("@");
      var dotpos = email.lastIndexOf(".");
     	if (firstname =="") {

     	}
      if (atpos < 1 || ( dotpos - atpos < 2 ))
      {
        alert("Please enter correct email ID")
        document.myForm.EMail.focus() ;
        return false;
      }

		  unsaved = false;
		  alert(firstname);
		  console.log("4");
		  //$("#addcontact").submit();
		  console.log("1");
		});
		console.log("2");
		if(!unsaved)
		{
			console.log("3");

			$(window).on("beforeunload", function(e) {
				return 'Are you sure you want to leave?';
			});
		}

	});
</script>