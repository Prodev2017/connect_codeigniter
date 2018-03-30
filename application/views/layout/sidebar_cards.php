<aside class="cards">
				
	<div class="col-xs-8 float-left">
		<h2>RESULTS</h2>
	</div>
	<div class="col-xl-4 float-right">
		<ul class="icon-views">
			<li>
				<a href="<?php echo base_url(); ?>contacts/view?cards">
					<img src="<?php echo base_url(); ?>assets/img/icon-cards.png" alt="view cards">
				</a>
			</li>
			<li>
				<a href="<?php echo base_url(); ?>contacts/view?list">
					<img src="<?php echo base_url(); ?>assets/img/icon-listview.png" alt="view list">
				</a>
			</li>
		</ul>
	</div>

	<div class="clearfix"></div>

	<nav class="alphabetical_filter">
		<ul>
			<li><a href="#">A</a></li>
			<li><a href="#">B</a></li>
			<li><a href="#">C</a></li>
			<li><a href="#">D</a></li>
			<li><a href="#">E</a></li>
			<li><a href="#">F</a></li>
			<li><a href="#">G</a></li>
			<li><a href="#">H</a></li>
			<li><a href="#">I</a></li>
			<li><a href="#">J</a></li>
			<li><a href="#">K</a></li>
			<li><a href="#">L</a></li>
			<li><a href="#">M</a></li>
			<li><a href="#">N</a></li>
			<li><a href="#">O</a></li>
			<li><a href="#">P</a></li>
			<li><a href="#">Q</a></li>
			<li><a href="#">R</a></li>
			<li><a href="#">S</a></li>
			<li><a href="#">T</a></li>
			<li><a href="#">U</a></li>
			<li><a href="#">V</a></li>
			<li><a href="#">W</a></li>
			<li><a href="#">X</a></li>
			<li><a href="#">Y</a></li>
			<li><a href="#">Z</a></li>
		</ul>
	</nav>

	<div class="clearfix"></div><div class="clear-10"></div>

  <?php 
  if (!empty($contacts)) {
  foreach ($contacts as $contact_single) { ?>

		<div class="profile-card">
			
			<a class="overlay_link" href="<?php echo base_url(); ?>contacts/add_opportunity/<?php echo $contact_single['id']; ?>"></a>

			<header class="profile-card bg-blue">
				<div class="row">
					<div class="col-md-8">
						 <?php if (!empty($contact_single['company'])) { ?>
						<span><?php echo $contact_single['company']; ?></span>
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

						<h5><a href="<?php echo base_url(); ?>connection" class="profile_name"><?php echo $contact_single['name']; ?></a></h5>

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

					<div class="col-sm-6">

						<table>
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

					<div class="col-sm-2 text-right">

						<img class="bottom" src="<?php echo $contact_single['grav']; ?>" alt="<?php echo $contact_single['name']; ?>">

					</div><!-- end of col-sm-4 -->

				</div>

			</section>

		</div><!-- end of profile card -->

	<?php }
	} ?>


	<!--
			
	<div class="clear-10"></div>
			
	<div class="profile-card">
		
		<a class="overlay_link" href="<?php echo base_url(); ?>connection"></a>

		<header class="profile-card bg-red">
			<div class="row">
				<div class="col-md-3">
					<span>APPLE inc</span>
				</div>
				<div class="col-md-4 text-center">
					<span><strong>QUOTE</strong></span>
				</div>
				<div class="col-md-5 text-right">
					<span>SALES TO DATE: &pound;11,456.00</span>
				</div>
			</div>
		</header>

		<section class="bd-red">

			<div class="row">

				<div class="col-sm-4">

					<h5><a href="<?php echo base_url(); ?>connection">TIM COOK</a></h5>

					<address>
						1 Infinite Loop,<br>
						Cupertino,<br>
						CA 95014,<br>
						USA
					</address>

				</div>

				<div class="col-sm-6">

					<div class="clear-30"></div>

					<table>

						<tr>
							<td><strong>Phone:</strong></td>
							<td>+1 408-606-5775</td>
						</tr>
						<tr>
							<td><strong>Email:</strong></td>
							<td><a href="mailto:tim.cook@apple.com" target="_blank">tim.cook@apple.com</a></td>
						</tr>
						<tr>
							<td><strong>Web:</strong></td>
							<td><a href="https://www.apple.com" target="_blank">www.apple.com</a></td>
						</tr>

					</table>

				</div>

				<div class="col-sm-2 text-right">

					<img class="bottom" src="<?php echo base_url(); ?>assets/img/profile-tim-cook@2x.png" alt="Tim Cook">

				</div><!-- end of col-sm-4 -->
    <!--
			</div>

		</section>

	</div><!-- end of profile card -->
    <!--

			
	<div class="clear-10"></div>
			
	<div class="profile-card">
		
		<a class="overlay_link" href="<?php echo base_url(); ?>connection"></a>

		<header class="profile-card bg-green">
			<div class="row">
				<div class="col-md-3">
					<span>APPLE inc</span>
				</div>
				<div class="col-md-4 text-center">
					<span><strong>BILLING</strong></span>
				</div>
				<div class="col-md-5 text-right">
					<span>SALES TO DATE: &pound;11,456.00</span>
				</div>
			</div>
		</header>

		<section class="bd-green">

			<div class="row">

				<div class="col-sm-4">

					<h5><a href="<?php echo base_url(); ?>connection">TIM COOK</a></h5>

					<address>
						1 Infinite Loop,<br>
						Cupertino,<br>
						CA 95014,<br>
						USA
					</address>

				</div>

				<div class="col-sm-6">

					<div class="clear-30"></div>

					<table>

						<tr>
							<td><strong>Phone:</strong></td>
							<td>+1 408-606-5775</td>
						</tr>
						<tr>
							<td><strong>Email:</strong></td>
							<td><a href="mailto:tim.cook@apple.com" target="_blank">tim.cook@apple.com</a></td>
						</tr>
						<tr>
							<td><strong>Web:</strong></td>
							<td><a href="https://www.apple.com" target="_blank">www.apple.com</a></td>
						</tr>

					</table>

				</div>

				<div class="col-sm-2 text-right">

					<img class="bottom" src="<?php echo base_url(); ?>assets/img/profile-tim-cook@2x.png" alt="Tim Cook">

				</div><!-- end of col-sm-4 -->
    <!--
			</div>

		</section>

	</div><!-- end of profile card -->

	<!--
			
	<div class="clear-10"></div>

	<div class="profile-card">
		
		<a class="overlay_link" href="<?php echo base_url(); ?>connection"></a>

		<header class="profile-card bg-blue">
			<div class="row">
				<div class="col-md-3">
					<span>APPLE inc</span>
				</div>
				<div class="col-md-4 text-center">
					<span><strong>INSPIRE</strong></span>
				</div>
				<div class="col-md-5 text-right">
					<span>SALES TO DATE: &pound;11,456.00</span>
				</div>
			</div>
		</header>

		<section class="bd-blue">

			<div class="row">

				<div class="col-sm-4">

					<h5><a href="<?php echo base_url(); ?>connection">TIM COOK</a></h5>

					<address>
						1 Infinite Loop,<br>
						Cupertino,<br>
						CA 95014,<br>
						USA
					</address>

				</div>

				<div class="col-sm-6">

					<div class="clear-30"></div>

					<table>

						<tr>
							<td><strong>Phone:</strong></td>
							<td>+1 408-606-5775</td>
						</tr>
						<tr>
							<td><strong>Email:</strong></td>
							<td><a href="mailto:tim.cook@apple.com" target="_blank">tim.cook@apple.com</a></td>
						</tr>
						<tr>
							<td><strong>Web:</strong></td>
							<td><a href="https://www.apple.com" target="_blank">www.apple.com</a></td>
						</tr>

					</table>

				</div>

				<div class="col-sm-2 text-right">

					<img class="bottom" src="<?php echo base_url(); ?>assets/img/profile-tim-cook@2x.png" alt="Tim Cook">

				</div><!-- end of col-sm-4 -->
    <!--
			</div>

		</section>

	</div><!-- end of profile card -->
	<!--
	<div class="clear-10"></div>

	<div class="profile-card">
		
		<a class="overlay_link" href="<?php echo base_url(); ?>connection"></a>

		<header class="profile-card bg-red">
			<div class="row">
				<div class="col-md-3">
					<span>APPLE inc</span>
				</div>
				<div class="col-md-4 text-center">
					<span><strong>INSPIRE</strong></span>
				</div>
				<div class="col-md-5 text-right">
					<span>SALES TO DATE: &pound;11,456.00</span>
				</div>
			</div>
		</header>

		<section class="bd-red">

			<div class="row">

				<div class="col-sm-4">

					<h5><a href="<?php echo base_url(); ?>connection">TIM COOK</a></h5>

					<address>
						1 Infinite Loop,<br>
						Cupertino,<br>
						CA 95014,<br>
						USA
					</address>

				</div>

				<div class="col-sm-6">

					<div class="clear-30"></div>

					<table>

						<tr>
							<td><strong>Phone:</strong></td>
							<td>+1 408-606-5775</td>
						</tr>
						<tr>
							<td><strong>Email:</strong></td>
							<td><a href="mailto:tim.cook@apple.com" target="_blank">tim.cook@apple.com</a></td>
						</tr>
						<tr>
							<td><strong>Web:</strong></td>
							<td><a href="https://www.apple.com" target="_blank">www.apple.com</a></td>
						</tr>

					</table>

				</div>

				<div class="col-sm-2 text-right">

					<img class="bottom" src="<?php echo base_url(); ?>assets/img/profile-tim-cook@2x.png" alt="Tim Cook">

				</div><!-- end of col-sm-4 -->
    <!--
			</div>

		</section>
		
	</div><!-- end of profile card -->
	
	<div class="clearfix"></div>

</aside>



