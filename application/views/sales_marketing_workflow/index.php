<?php
	$this->load->view('layout/header');
?>
		
		<div class="main-section-full mobile-transparent">

			<div class="sales-marketing-workflow">
				
				<div class="workflow">
					<?php $i=1; foreach($stages as $stage):?>
					<div class="workflow-item" style="background-color:#<?php echo $stage['colour'];?>">
						<div class="workflow-item-content-lg">
							<h3><?php echo $stage['stage_name'];?></h3>
							<span class="opportunities-count"> <?php echo count($stage['opportunities']);?></span><span>OPPORTUNITIES</span>
							<?php if($i<count($stages)):?>
							<span class="arrow" style="border-color:transparent transparent transparent #<?php echo $stage['colour'];?> !important"></span>
							<?php endif;?>
						</div>
						<div class="workflow-item-content-sm opportunities-count">
							<?php echo count($stage['opportunities']);?>
						</div>
					</div>
					<?php $i++; endforeach;?>
					
					<div class="clearfix"></div>
					
				</div><!-- end of workflow -->
				
				<div class="money-container">
				<div class="clearfix"></div>
				
				<div class="money welcome">
					<span>&pound;123,456</span>
				</div>
				
				<div class="money inspire">
					<span>&pound;123,456</span>
				</div>
				
				<div class="money meet">
					<span>&pound;123,456</span>
				</div>
				
				<div class="money quote active">
					<span>&pound;123,456</span>
				</div>
				
				<div class="money follow-up">
					<span>&pound;123,456</span>
				</div>
				
				<div class="money billing">
					<span>&pound;123,456</span>
				</div>
				</div><!-- .money-container -->
				
				<div class="projects-container">
					<?php foreach($stages as $stage):?>
						<div class="projects welcome">
							<?php if($stage['opportunities']):?>
								<?php foreach($stage['opportunities'] as $opportunity):?>
								<div class="project">
									<header>
										<span><a href="<?php echo base_url().'opportunities/create_note/'.$opportunity['id'];?>"><?php echo $opportunity['name']; ?></a></span>
									</header>
									
									<div class="details">
										<?php if($opportunity['company']):?>
										<span> <a href="<?php echo base_url().'companies/edit/'.$opportunity['company']['id'];?>"> <?php echo  $opportunity['company']['company_name'];?></a></span>
										<?php endif;?>
										<span>Value: &pound;111,111</span> 
										<span class="status green"></span>
									</div>
									
								</div><!-- end of project -->
								<?php endforeach;?>
							<?php endif;?>
							
						</div><!-- end of projects / welcome -->
					<?php endforeach;?>
				
				<div class="clearfix"></div>
				</div><!-- .projects-container -->
								
			</div><!-- end of sales marketing workflow -->
									
<?php
	$this->load->view('layout/footer');
?>