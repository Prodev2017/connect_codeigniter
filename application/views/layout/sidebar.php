<aside class="desktop">

	<div class="profile-card">

		<header class="profile-card <?php if(($this->uri->segment(1)=="connection")||($this->uri->segment(1)=="enquiries")){echo 'bg-blue';}
				  elseif($this->uri->segment(1)=="sales"){echo 'bg-red';}
				  elseif(($this->uri->segment(1)=="getting_paid")||($this->uri->segment(1)=="results")){echo 'bg-green';}
				  else{echo 'bg-grey';}
			?>
			">
			 <?php if (!empty($contact_single['company'])) { ?>
					<span><?php echo $contact_single['company']; ?></span>
			<?php } ?>
		</header>

		<section class="<?php if(($this->uri->segment(1)=="connection")||($this->uri->segment(1)=="enquiries")){echo 'bd-blue';}
				  elseif($this->uri->segment(1)=="sales"){echo 'bd-red';}
				  elseif(($this->uri->segment(1)=="getting_paid")||($this->uri->segment(1)=="results")){echo 'bd-green';}
				  else{echo 'bd-grey';}
			?>
			">

			<div class="row">

				<div class="col-sm-8">

					<h5><?php echo $contact_single['name']; ?></h5>

					<?php if (!empty($contact_single['address'])) { ?>
					<address>
						<?php echo $contact_single['address']; ?>
					</address>
					<?php } ?>

				</div><!-- end of col-sm-8 -->

				<div class="col-sm-4">

					<img class="bottom" src="<?php echo $contact_single['grav']; ?>" alt="<?php echo $contact_single['name']; ?>">

				</div><!-- end of col-sm-4 -->

				<div class="clearfix"></div><hr>

			</div><!-- end of row -->

			<div class="row">

				<div class="col-sm-12">

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

				</div><!-- end of col-sm-12 -->

			</div><!-- end of row -->

			<div class="row">

				<div class="col-sm-12">
					<div class="float-right">
						<a href="<?php echo base_url(); ?>contacts/details/<?php echo $contact_single['id']; ?>"><button type="button" class="btn btn-primary">EDIT</button></a>
					</div><!-- end of float right -->
				</div><!-- end of cols sm 12 -->

			</div><!-- end of row -->

		</section>

	</div><!-- end of profile card -->

	<div class="meta-block <?php if(($this->uri->segment(1)=="connection")||($this->uri->segment(1)=="enquiries")){echo 'bd-blue';}
				  elseif($this->uri->segment(1)=="sales"){echo 'bd-red';}
				  elseif(($this->uri->segment(1)=="getting_paid")||($this->uri->segment(1)=="results")){echo 'bd-green';}
				  else{echo 'bd-grey';}
			?>
			">

		<table>

			<tr>
				<td><strong>Sales to date:</strong></td>
				<td><strong>&pound;<?php echo $contact_single['sales_to_date']; ?></strong></td>
			</tr>
			<tr>
				<td><strong>Last 12 months:</strong></td>
				<td><strong>&pound;56,101</strong></td>
			</tr>

		</table>

	</div><!-- end of meta-block -->
	
	<div class="meta-block <?php if(($this->uri->segment(1)=="connection")||($this->uri->segment(1)=="enquiries")){echo 'bd-blue';}
				  elseif($this->uri->segment(1)=="sales"){echo 'bd-red';}
				  elseif(($this->uri->segment(1)=="getting_paid")||($this->uri->segment(1)=="results")){echo 'bd-green';}
				  else{echo 'bd-grey';}
			?>
			">

		<h5>CURRENT OPPORTUNITIES</h5>
		<table>
			<?php foreach($contact_single['opportunities'] as $opportunity):?>
				<tr>
					<td>
						<a href="<?php echo base_url().'opportunities/create_note/'.$opportunity['id'];?>">
							<?php echo $opportunity['name'];?>
						</a>
					</td>	
					<td><strong>&pound;3.30</strong></td>
				</tr>
			<?php endforeach;?>
		</table>

	</div><!-- end of meta-block -->

	<div class="meta-block <?php if(($this->uri->segment(1)=="connection")||($this->uri->segment(1)=="enquiries")){echo 'bd-blue';}
				  elseif($this->uri->segment(1)=="sales"){echo 'bd-red';}
				  elseif(($this->uri->segment(1)=="getting_paid")||($this->uri->segment(1)=="results")){echo 'bd-green';}
				  else{echo 'bd-grey';}
			?>
			">

		<h5>JOBS TO DATE</h5>

		<table>

			<tr>
				<td>Replace doormats</td>
				<td><strong>&pound;3.30</strong></td>
			</tr>
			<tr>
				<td>Make and fit new pipes</td>
				<td><strong>&pound;4.50</strong></td>
			</tr>
			<tr>
				<td>Fit new carpet to reception</td>
				<td><strong>&pound;11.11</strong></td>
			</tr>

		</table>

	</div><!-- end of meta-block -->

	<div class="meta-block <?php if(($this->uri->segment(1)=="connection")||($this->uri->segment(1)=="enquiries")){echo 'bd-blue';}
				  elseif($this->uri->segment(1)=="sales"){echo 'bd-red';}
				  elseif(($this->uri->segment(1)=="getting_paid")||($this->uri->segment(1)=="results")){echo 'bd-green';}
				  else{echo 'bd-grey';}
			?>
			">

		<h5>OTHER CONTACTS</h5>

		<span><strong>Marketing:</strong>&nbsp;Philip W. Schiller, VPWM</span><br>
		<span><strong>Design:</strong>&nbsp;Johnathan Ive, CDO</span><br>
		<span><strong>Software:</strong>&nbsp;Craig Federight, SVPSE</span>

	</div><!-- end of meta-block -->

	<div class="meta-block <?php if(($this->uri->segment(1)=="connection")||($this->uri->segment(1)=="enquiries")){echo 'bd-blue';}
				  elseif($this->uri->segment(1)=="sales"){echo 'bd-red';}
				  elseif(($this->uri->segment(1)=="getting_paid")||($this->uri->segment(1)=="results")){echo 'bd-green';}
				  else{echo 'bd-grey';}
			?>
			">

		<h5>NOTES</h5>

		<p>
			Recent conversations relating to new IOS launch indicate a strong possibility of a complete refit to SE department.
		</p>

	</div><!-- end of meta-block -->

</aside>