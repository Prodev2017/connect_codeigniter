<?php
	$this->load->view('layout/header');
?>
		<div class="main-section-cards">
					
			<?php 
		  if (!empty($contacts)) {
		  foreach ($contacts as $contact_single) { ?>
				<div class="client-to-do" attr-id="<?php echo $contact_single['id'];?>">
					<div class="hide" style="display:none">
						<?php
						foreach($contact_single as $key=>$ttl)
						{
							echo '<div class="'.$key.'">'.$ttl.'</div>';
						}
						?>
					</div>
					<header>
						<span class="toggle red toggle-close"></span>
						<span><?php echo $contact_single['name']; ?> - Discuss proposal <span class="client-to-do-meta"> <strong>DUE DATE: 11.11.17 | PRIORITY: <span class="text-red">HIGH</span></strong></span></span>
						<span class="icon-add-todo fa fa-pencil-square-o"></span>
					</header>
					<div class="to-do-checklist">
							<ul>
								<li>
									<input type="checkbox" name="to-do-1" id="to_do_1"><label for="to_do_1">Discuss proposal and timelines for new office refurb.</label>
								</li>
								<li>
									<input type="checkbox" name="to-do-1" id="to_do_2"><label for="to_do_2">Discuss proposal and timelines for new office refurb.</label>
								</li>
								<li>
									<input type="checkbox" name="to-do-1" id="to_do_3"><label for="to_do_3">Discuss proposal and timelines for new office refurb.</label>
								</li>
								<li>
									<input type="checkbox" name="to-do-1" id="to_do_4"><label for="to_do_4">Discuss proposal and timelines for new office refurb.</label>
								</li>
							</ul>
					</div><!-- end of to do checklist -->
					
				</div><!-- end of client to do -->
			<?php }
			} ?>

			
			<div class="clearfix"></div><div class="clear-30"></div>

			<aside class="card-breakdown todo">

				<div class="profile-card">

					<a class="overlay_link" href="<?php echo base_url(); ?>connection"></a>

					<header class="profile-card bg-blue">
						<div class="row">
							<div class="col-md-8">
								<span>APPLE inc</span>
							</div>
							<div class="col-md-4 text-right">
								<span><strong>INSPIRE</strong></span>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-right">
								<span>SALES TO DATE: &pound;</span><span class="target-sales"></span>
							</div>
						</div>
					</header>

					<section class="bd-blue">

						<div class="row">

							<div class="col-sm-12">

								
							</div>
						
						</div>
						<div class="row">
							<div class="col-8 col-md-9">
								<div class="row">
								<div class="col-sm-4">
									<h5><a  class="target-name"></a></h5>
									<address class="target-address">
									</address>

								</div>

								<div class="col-sm-5">

									<table>

										<tr>
											<td><strong id="web_title"></strong></td>
											<td class="target-title"></td>
										</tr>
										<tr>
											<td><strong id="web_phone"></strong></td>
											<td class="target-phone"></td>
										</tr>
										<tr>
											<td><strong id="web_email"></strong></td>
											<td><a href="mailto:tim.cook@apple.com" class="target-email" target="_blank"></a></td>
										</tr>
										<tr>
											<td><strong id="web_html"></strong></td>
											<td><a  target="_blank" class="target-web"></a></td>
										</tr>

									</table>

								</div>
								</div>
							</div>
							<div class="col-4 col-md-3 text-right">
									<img   class="target-grav">
									<div class="social-profiles">
										<div class="linkedin">
											<a href=""><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
										</div>
										<div class="twitter">
											<a href=""><i class="fa fa-twitter"  aria-hidden="true"></i></a>
										</div>
										<div class="facebook">
											<a href=""><i class="fa fa-facebook"  aria-hidden="true"></i></a>
										</div>
									</div>
							</div>

						</div>

					</section>

				</div><!-- end of profile card -->

				<?php $this->load->view('layout/planned-past'); ?>
				
			</aside>
<?php
	$this->load->view('layout/footer');
?>

<script>
		$(document).ready(function(){
			$(".client-to-do").click(function() {
					if ($(this).hasClass('active')){

					var id = $(this).attr("attr-id");
					var name = $(".name", this).html();
					var address = $(".address", this).html();
					var email = $(".email", this).html();
					var phone = $(".phone", this).html();
					var web = $(".web", this).html();
					var title = $(".job_title", this).html();
					var sales= $(".sales_to_date", this).html();
					var grav= $(".grav", this).html();

					/* input */
					$(".target-name").html(name);
					$(".target-address").html(address);
					$(".target-email").html(email);
					if (web) {
						$("#web_html").html("Web:");
					}
					else {
						$("#web_html").html("");
					}
					if (email) {
						$("#web_email").html("Email:");
					}
					else {
						$("#web_email").html("");
					}
					if (phone) {
						$("#web_phone").html("Phone:");
					}
					else {
						$("#web_phone").html("");
					}
					if (title) {
						$("#web_title").html("Title:");
					}
					else {
						$("#web_title").html("");
					}
					if (grav) {
						$(".target-grav").attr("src", grav);
						$(".target-grav").attr("alt", name);
					}
					$(".target-phone").html(phone);
					$(".target-web").html(web);
					$(".target-title").html(title);
					$(".target-sales").html(sales);
					$(".target-name").attr("href", "connection/index/"+id);
					$(".target-web").attr("href", 'http://'+ web);
					$(".target-email").attr("href", 'mailto:'+email);
				}

			});
		});
</script>