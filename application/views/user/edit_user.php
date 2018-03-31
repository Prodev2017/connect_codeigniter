<?php
	$this->load->view('layout/header');
?>

		<div class="main-section-full section-width">

			
			<div class="desktop">
				<p>Two line explanation in here telling people how this works and what they can expect in return. Always using the adage; put shit  in – get shit back out… </p>
			</div><!-- end of desktop -->

			<section class="tab-current ">
				<h2>EDIT USER INFO</h2>
				<form>

					<fieldset>
						<legend>First Name</legend>
						<input type="text" class="form-control" name="first_name" id="first_name">
					</fieldset>

					<fieldset>
						<legend>Last Name</legend>
						<input type="text" class="form-control" name="last_name" id="last_name">
					</fieldset>

					<fieldset>
						<legend>Company Name</legend>
						<input type="text" class="form-control" name="company" id="company">
					</fieldset>

					<fieldset>
						<legend>Job Title</legend>
						<input type="text" class="form-control" name="job_title" id="job_title">
					</fieldset>

					<fieldset>
						<legend>Phone</legend>
						<input type="number" class="form-control" name="phone" id="phone">
					</fieldset>

					<fieldset>
						<legend>Password</legend>
						<input type="password" class="form-control" name="password" id="password">
					</fieldset>

					<fieldset>
						<legend>Confirm Password</legend>
						<input type="password" class="form-control" name="confirm_password" id="confirm_password">
					</fieldset>

					<div class="float-right">
						<button type="button" class="btn btn-primary cancel">CANCEL</button>
						<button type="button" class="btn btn-primary">SAVE</button>
					</div><!-- end of float right -->

				</form>

				<div class="clearfix"></div>

			</section><!-- end of tab current -->

		</div><!-- end of form block -->

		<!--   <form id="addcontact" name="addcontact" action="add_contact" method="post">

				<div class="row">

					<div class="col-xl-2 col-lg-12">
						<label for="first_name" class="align-middle">
							First name
						</label>
					</div>
					<div class="col-xl-4  col-lg-12">
						<input type="text" id="first_name" name="first_name" class="form-control">
					</div>

				</div>

				<div class="row">

					<div class="col-xl-2  col-lg-12 ">
						<label for="last_name" class="align-middle">
							Last name
						</label>
					</div>
					<div class="col-xl-4 col-lg-12">
						<input type="text" id="last_name" name="last_name" class="form-control">
					</div>

				</div>

				<div class="row">

					<div class="col-xl-2  col-lg-12">
						<label for="company" class="align-middle">
							Company
						</label>
					</div>
					<div class="col-xl-4 col-lg-12">
						<input type="text" id="company" name="company" class="form-control">
					</div>

				</div>

				<div class="row">

					<div class="col-xl-2  col-lg-12 ">
						<label for="job_title" class="align-middle">
							Job Title
						</label>
					</div>
					<div class="col-xl-4 col-lg-12">
						<input type="text" id="job_title" name="job_title" class="form-control">
					</div>

				</div>

				<div class="row">

					<div class="col-xl-2  col-lg-12 ">
						<label for="phonenumber" class="align-middle">
							Phone Number
						</label>
					</div>
					<div class="col-xl-4 col-lg-12">
						<input type="number" id="phone_number" name="phone_number" class="form-control">
					</div>

				</div>

				<div class="row">
					<div class="col-xl-2 col-lg-12">
						<label for="password" class="align-middle">
							Password
						</label>
					</div>
					<div class="col-xl-4 col-lg-12">
						<input type="password" id="password" name="password" class="form-control">
					</div>

				</div>

				<div class="row">

					<div class="col-xl-2 col-lg-12">
						<label for="confirm_password" class="align-middle">Confirm Password</label>
					</div>

					<div class="col-xl-4 col-lg-12">
						<input type="text" id="confirm_password" name="confirm_password" class="form-control">
					</div>

				</div>


				<div >
					<button type="button" class="btn btn-primary savebutton" >SAVE</button>
				</div>

		</form> -->
<?php
	$this->load->view('layout/sidebar');
	$this->load->view('layout/footer');
?>
<script>
	var unsaved=true;
	function validateClassInputBox() {
    if(document.getElementById("first_name").value.length != 0) {
            document.getElementById("first_name").className += " md-valid";
    }
    if(document.getElementById("last_name").value.length != 0) {
            document.getElementById("last_name").className += " md-valid";
    }
    if(document.getElementById("company").value.length != 0) {
            document.getElementById("company").className += " md-valid";
    }
    if(document.getElementById("phone").value.length != 0) {
            document.getElementById("phone").className += " md-valid";
    }
	}
	validateClassInputBox();

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