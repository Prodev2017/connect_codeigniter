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

	<table class="table table-striped">
	  <thead>
		<tr>
		  <th>FIRST NAME</th>
		  <th>LAST NAME</th>
		  <th>EMAIL ADDRESS</th>
		  <th>MOBILE NUMBER</th>
		</tr>
	  </thead>
	  <tbody>

	  	<?php 
        if (!empty($contacts)) {
	  	foreach ($contacts as $contact_single) { ?>

		<tr class="profile-row">
		  <td><a href="<?php echo base_url(); ?>contacts/add_opportunity/<?php echo $contact_single['id']; ?>" class="profile_name"><?php echo $contact_single['first_name']; ?></a></td>
		  <td><a href="<?php echo base_url(); ?>contacts/add_opportunity/<?php echo $contact_single['id']; ?>"><?php echo $contact_single['last_name']; ?></a></td>
		  <td><a href="<?php echo base_url(); ?>contacts/add_opportunity/<?php echo $contact_single['id']; ?>"><?php echo $contact_single['email']; ?></a></td>

		  <td><?php if (!empty($contact_single['phone'])) { ?><a href="<?php echo base_url(); ?>contacts/add_opportunity/<?php echo $contact_single['id']; ?>"><?php echo $contact_single['phone']; ?></a><?php } ?></td>
		</tr>

		<?php }
		} ?>

	

	  </tbody>
	</table>

	<div class="clearfix"></div>
	
</aside>