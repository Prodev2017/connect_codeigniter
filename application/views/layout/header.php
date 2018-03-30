<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <title>Connectably</title>
        <meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/apple-touch-icon.png">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/redactor/redactor.min.css" />
	    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/timepicker/jquery.timepicker.css" />
		
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,700,700i|Roboto:300,300i,400,400i,700,700i" rel="stylesheet">

		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css?v=<?php echo VERSION;?>">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		<script>
			var base_url = "<?php echo base_url();?>";
		</script>
		
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
	
		<div class="main-menu <?php if($this->uri->segment(1)!="dashboard"){echo 'collapse';}?>">
			
			<div class="logo"><a href="<?php echo base_url(); ?>" title="connectably"></a></div>
			
			<div class="search mobile">
				<input type="text" placeholder="| Search" name="search">
				<div class="toggle-navigation"></div>
			</div>
					
			<div class="profile-current 
			<?php if(($this->uri->segment(1)=="connection")||($this->uri->segment(1)=="enquiries")){echo 'bg-blue';}
				  elseif($this->uri->segment(1)=="sales"){echo 'bg-red';}
				  elseif(($this->uri->segment(1)=="getting_paid")||($this->uri->segment(1)=="results")){echo 'bg-green';}
				  else{echo 'bg-blue';}
			?>
			">
				
				<div class="row">
<!-- 					<?
					php $user = $this->ion_auth->user()->row();
					$firstname = $this->ion_auth->user()->row()->first_name;
					$lastname = $this->ion_auth->user()->row()->last_name;
					$email = $this->ion_auth->user()->row()->email;
					$email = $this->ion_auth->user()->row()->email;
			    $default = 'https://www.tremark.co.uk/wp-content/uploads/2016/02/placeholder-male.png';
			    $size = 200;
			    $grav_url  = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . urlencode($default) . "&s=" . $size;
		     ?> -->
					<div class="col-xs-4">
						<img src="<?php $email = $this->ion_auth->user()->row()->email;
			    $default = 'https://www.tremark.co.uk/wp-content/uploads/2016/02/placeholder-male.png';
			    $size = 200;
			    $grav_url  = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . urlencode($default) . "&s=" . $size; echo $grav_url; ?>" class="img-circle" alt="firstname-lastname">
					</div><!-- end of col sm 4 -->
					<div class="col-lg-8">
						<span class="meta-name"><?php echo $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name." "; ?></span>
						<span class="meta-role"><?php if($this->ion_auth->user()->row()->job_title){
							echo $this->ion_auth->user()->row()->job_title;
							}else{
								echo "Logged In User";
							} ?>
						</span>
					</div><!-- end of col sm 8 -->
					<span class="meta-initials"><?php  $first = substr($this->ion_auth->user()->row()->first_name, 0, 1); $second=substr($this->ion_auth->user()->row()->last_name, 0, 1); echo $first[0].$second[0]; ?></span>
				</div><!-- end of row -->
			</div><!-- end of profile current -->
			
			<nav>
				
				<ul>
					<li class="nav_top nav-enquiries <?php if($this->uri->uri_string()=="enquiries"){echo 'active';}?>"><a href="<?php echo base_url(); ?>contacts/view"><span>Enquiries</span></a></li>
					<li class="nav-connection <?php if(($this->uri->segment(1)=="connection")||($this->uri->segment(2)=="details")){echo 'active';}?>">
						<a href="<?php echo base_url(); ?>contacts/view"><span>Connection</span></a>
						<ul class="<?php if(isset($sub_navigation)){echo 'sub_navigation';}?>">
							<?php if($this->uri->segment(1) == 'opportunities'):?>
							<li>
								<a href="<?php echo base_url(); ?>opportunities/create_note/<?php echo isset($opportunity_id) ? $opportunity_id : ''; ?>" <?php if($this->uri->segment(2)=="create_note"){echo 'class="active"';} elseif($this->uri->segment(2)=="index"){echo 'class="active"';} ?>>
									Create Note
								</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>opportunities/make_call/<?php echo isset($opportunity_id) ? $opportunity_id : ''; ?>" <?php if($this->uri->segment(2)=="make_call"){echo 'class="active"';}?>>
									Make Call
								</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>opportunities/book_meeting/<?php echo isset($opportunity_id) ? $opportunity_id : ''; ?>" <?php if($this->uri->segment(2)=="book_meeting"){echo 'class="active"';}?>>
									Book Meeting
								</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>opportunities/add_task/<?php echo isset($opportunity_id) ? $opportunity_id : ''; ?>" <?php if($this->uri->segment(2)=="add_task"){echo 'class="active"';}?>>
									Add Task
								</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>opportunities/send_email/<?php echo isset($opportunity_id) ? $opportunity_id : ''; ?>" <?php if($this->uri->segment(2)=="send_email"){echo 'class="active"';}?>>
									Send Email
								</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>opportunities/send_quote/<?php echo isset($opportunity_id) ? $opportunity_id : ''; ?>" <?php if($this->uri->segment(2)=="send_quote"){echo 'class="active"';}?>>
									Send Quote
								</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>opportunities/set_deadline/<?php echo isset($opportunity_id) ? $opportunity_id : ''; ?>" <?php if($this->uri->segment(2)=="set_deadline"){echo 'class="active"';}?>>
									Set Deadline
								</a>
							</li>
							<?php elseif($this->uri->segment(1) == 'contacts'):?>
							<li>
								<a href="<?php echo base_url(); ?>contacts/add_opportunity/<?php echo isset($contactid) ? $contactid : ''; ?>" <?php if($this->uri->segment(2)=="add_opportunity"){echo 'class="active"';} ?>>
									Add Opportunity
								</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>contacts/create_note/<?php echo isset($contactid) ? $contactid : ''; ?>" <?php if($this->uri->segment(2)=="create_note"){echo 'class="active"';}?>>
									Create Note
								</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>contacts/make_call/<?php echo isset($contactid) ? $contactid : ''; ?>" <?php if($this->uri->segment(2)=="make_call"){echo 'class="active"';}?>>
									Make Call
								</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>contacts/book_meeting/<?php echo isset($contactid) ? $contactid : ''; ?>" <?php if($this->uri->segment(2)=="book_meeting"){echo 'class="active"';}?>>
									Book Meeting
								</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>contacts/add_task/<?php echo isset($contactid) ? $contactid : ''; ?>" <?php if($this->uri->segment(2)=="add_task"){echo 'class="active"';}?>>
									Add Task
								</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>contacts/send_email/<?php echo isset($contactid) ? $contactid : ''; ?>" <?php if($this->uri->segment(2)=="send_email"){echo 'class="active"';}?>>
									Send Email
								</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>contacts/manage_tags/<?php echo isset($contactid) ? $contactid : ''; ?>" <?php if($this->uri->segment(2)=="manage_tags"){echo 'class="active"';}?>>
									Manage Tags
								</a>
							</li>
							<?php endif;?>
						</ul>
						<span class="nav-arrow"></span>
					</li>
					<li class="nav_top nav-sales <?php if($this->uri->uri_string()=="sales"){echo 'active';}?>"><a href="<?php echo base_url(); ?>contacts/view"><span>Sales</span></a></li>
					<li class="nav_top nav-getting-paid <?php if($this->uri->uri_string()=="getting_paid"){echo 'active';}?>"><a href="<?php echo base_url(); ?>contacts/view"><span>Getting Paid</span></a></li>
					<li class="nav_top nav-results <?php if($this->uri->uri_string()=="results"){echo 'active';}?>"><a href="<?php echo base_url(); ?>contacts/view"><span>Results</span></a></li>
					<li class="nav_top nav-logout bottom_postion <?php if($this->uri->uri_string()=="logouts"){echo 'active';}?>"><a href="<?php echo base_url(); ?>user/logout"><span>Logout</span></a></li>
				</ul>
				
			</nav>
		</div><!-- end of main menu -->
		
		<div class="menu-bar <?php if($this->uri->segment(1)!="dashboard"){echo 'collapse';}?>">
			
			<div class="container-fluid">

				<div class="row">
					<div class="custom-logo">
						<span><a href="<?php echo base_url(); ?>/dashboard">YOUR LOGO</a></span>
					</div><!-- end of custom logo -->

					<div class="menu-bar-items">

						<nav>
							<ul>
								<li class="icon-logo <?php if($this->uri->uri_string()==""){echo 'active';}?>">
									<a href="<?php echo base_url(); ?>" title="connectably"></a>
								</li>
								<li class="icon-people <?php if($this->uri->uri_string()=="contacts/add"){echo 'active';}?>">
									<a href="<?php echo base_url(); ?>contacts/add" title="people"></a>
								</li>
								<li class="icon-email <?php if($this->uri->segment(1)=="emails"){echo 'active';}?>">
									<a href="<?php echo base_url(); ?>emails?view=card" title="email"></a>
								</li>
								<li class="icon-list <?php if($this->uri->uri_string()=="contacts/view"){echo 'active';}?>">
									<a href="<?php echo base_url(); ?>contacts/view" title="list"></a>
								</li>
								<li class="icon-todo <?php if($this->uri->uri_string()=="to_do"){echo 'active';}?>">
									<a href="<?php echo base_url(); ?>to_do" title="todo"></a>
								</li>
								<li class="icon-settings <?php if($this->uri->uri_string()=="settings"){echo 'active';}?>">
									<a href="<?php echo base_url(); ?>settings" title="settings"></a>
								</li>
							</ul>
						</nav>

						
					</div><!-- end of menu bar items -->
					
					<div class="menu-bar-search">
						
						<nav>
							<ul>
								<li class="icon-search">
									<a href="<?php echo base_url(); ?>/contacts/view" title="search"></a>
								</li>
							</ul>
						</nav>
						
						<input type="text" placeholder="| SEARCH">
						
					</div><!-- end of search -->

				</div><!-- end of row -->
				
			</div><!-- end of container auto -->
			
			<div class="clearfix"></div>

		</div><!-- end of menu bar -->
		<?php if($this->uri->segment(1)=="emails"):?>
			<header class="title desktop bg-grey">
			
			<div class="container-fluid">
				
				<div class="row">
					<div class="text-center email-header">
						<h4>Email Template List Page</h4>	
						11 WELCOME | 22 RESPONSE | 33 NEWS
					</div>				

				</div><!-- end of row -->
				
			</div><!-- end of container fluid -->
			
			<div class="clearfix"></div>

		</header><!-- end of title -->	
		<?php else:?>
		<header class="title desktop <?php if(($this->uri->segment(1)=="connection")||($this->uri->segment(1)=="enquiries")){echo 'bg-blue';}
				  elseif($this->uri->segment(1)=="sales"){echo 'bg-red';}
				  elseif($this->uri->segment(1)=="dashboard"){echo 'bg-grey';}
				  elseif(($this->uri->segment(1)=="getting_paid")||($this->uri->segment(1)=="results")){echo 'bg-green';}
				  elseif(isset($opportunity) && !empty($opportunity->stage_id)){echo '';}
				  else{echo 'bg-blue';}
			?>
			" 
			<?php if(isset($opportunity->colour)):?>
			style="background-color:#<?php echo $opportunity->colour;?>;"
			<?php endif;?>
			>
			
			<div class="container-fluid">
				
				<div class="row">
		
					<div class="text-center client-value">
						<?php if(isset($opportunity->stage_name)):?>
						<span class="stage-name"><strong><?php echo $opportunity->stage_name;?></strong></span>
						<?php else:?>
						<span class="stage-name"><strong>Inspire</strong></span>
						<?php endif;?>

						<div class="clearfix"></div><hr>
						<span>VALUE: &pound;11,456.00</span>
					</div><!-- end of -->

					<div class="client-project">
						<?php if(isset($home)): ?>
							<h1><?php echo $workflow->workflow_name;?></h1>
							<span class="deals">2ND LINE</span>						
						<?php elseif($this->uri->uri_string()==""): ?>
							<h1>FULL NAV MASTER</h1>
							<span class="deals">2ND LINE</span>						
						<?php elseif($this->uri->uri_string()=="dashboard"): ?>
							<h1>DASHBOARD</h1>
							<span class="deals">2ND LINE</span>						
						<?php elseif($this->uri->segment(1) == 'contacts' && isset($contact_single)): ?>
							<h1><?php echo $contact_single['first_name'].' '.$contact_single['last_name'];?></h1>
							<span class="deals">12 DEALS – &pound;123,456</span>
						<?php elseif($this->uri->segment(1) == 'opportunities' && isset($opportunity)): ?>
							<h1><?php echo $opportunity->name;?></h1>
							<span class="deals">12 DEALS – &pound;123,456</span>
						<?php else: ?>
							<h1>APPLE CUPERTINO OFFICE REFURB</h1>
							<span class="deals">12 DEALS – &pound;123,456</span>
						<?php endif; ?>
					</div><!-- end of -->

				</div><!-- end of row -->
				
			</div><!-- end of container fluid -->
			
			<div class="clearfix"></div>

		</header><!-- end of title -->
		<?php endif;?>
		
		<header class="title mobile <?php if(($this->uri->segment(1)=="connection")||($this->uri->segment(1)=="enquiries")){echo 'bg-blue';}
				  elseif($this->uri->segment(1)=="sales"){echo 'bg-red';}
				  elseif(($this->uri->segment(1)=="getting_paid")||($this->uri->segment(1)=="results")){echo 'bg-green';}
				  else{echo 'bg-grey';}
			?>
			">
			
			<a href="/" class="overlay-link"></a>
			<h1>APPLE CUPERTINO OFFICE REFURB</h1>
			<span class="deals">12 DEALS – &pound;123,456</span>
			
			<div class="clearfix"></div>
			
		</header><!-- end of title -->
		
		<div class="search mobile">
			<input type="text" name="search" placeholder="| Search">
			<div class="toggle-navigation"></div>
		</div>
		
		<?php if(($this->uri->segment(1)!="sales_marketing_workflow")&&($this->uri->segment(1)!="")&&($this->uri->segment(1)!="contacts")&&($this->uri->segment(1)!="dashboard")&&($this->uri->segment(1)!="to_do")):?>
		<div class="client-value mobile">
			<span>INSPIRE: VALUE &pound;11,456.00</span>
		</div>
		<?php endif; ?>
		
		<?php if(($this->uri->segment(1)!="contacts")&&($this->uri->segment(1)!="to_do")):?>
		<nav class="mobile-nav mobile">
			<ul>
				<li class="mobile-nav-enquiries">
					<a href="<?php echo base_url(); ?>contacts/add"></a>
				</li>
				<li class="mobile-nav-connection <?php if($this->uri->segment(1)=="connection"){echo 'active';}?>">
					<a href="<?php echo base_url(); ?>contacts/view"></a>
				</li>
				<li class="mobile-nav-sales">
					<a href="<?php echo base_url(); ?>contacts/details/1"></a>
				</li>
				<li class="mobile-nav-paid">
					<a href="<?php echo base_url(); ?>to_do"></a>
				</li>
				<li class="mobile-nav-results">
					<a href="<?php echo base_url(); ?>dashboard"></a>
				</li>
			</ul>
		</nav>
		<?php else: ?>
			<?php if($this->uri->segment(2)!="view"):?>
				<div class="clear-m-20"></div>
			<?php endif;  ?>
		<?php endif; ?>