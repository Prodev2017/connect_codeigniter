<?php
	$this->load->view('layout/header');
?>
		
		<div class="main-section">

			<section class="tab-current">

				<h2>RESULTS</h2>

				[results content here]

				<div class="clearfix"></div>

			</section><!-- end of tab current -->
			
			<div class="planned-box">
			
				<section class="tab-planned">
					<span>Planned</span>
					<span class="oval"></span>
				</section><!-- end of tab planned -->
				
			</div><!-- end of planned box -->
			
			<section class="tab-past">
				<span>Past</span>
				<span class="oval"></span>
			</section><!-- end of tab past -->

		</div><!-- end of form block -->
									
<?php
	$this->load->view('layout/sidebar');
	$this->load->view('layout/footer');
?>