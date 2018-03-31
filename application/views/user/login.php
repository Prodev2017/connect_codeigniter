<?php include 'config.php'; ?>
<?php
//Load Header
$this->load->view('layout/login_header');
?>

<body>
<title> Connectably - Login </title>
<section class="login p-fixed d-flex text-center bg-primary common-img-bg">

    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-12">
              <?php echo form_open("user/login");?>
                <div class="login-card card-block">
                  <form class="md-float-material">
                      <div class="text-center">
                        <img src="<?php echo base_url(); ?>assets/images/connectablyLogoDark.png" alt="connectably logo" style="max-width:400px;max-height:120px;width: 100%;height: auto; align: center;">
                         <?php if (!empty($_GET['new_regist'])) { ?>
                        <div class="row card-block">
                          <div class="panel panel-danger">
                            <div class="panel-heading bg-danger">
                               Welcome! Thanks for registering, please sign in here.
                            </div>
                          </div>
                        </div>
                         <?php } ?>
                      </div>
                      <h3 class="text-center txt-primary">
                        <div class="welcome-pages-heading" style=" font-family: 'Roboto', sans-serif;">
                        <h1><?php echo lang('login_heading');?></h1>
                      </div>
                        <!-- <p>?php echo lang('login_subheading');?></p> -->
                      </h3>
                      <div id="infoMessage"><?php echo $message;?></div>
                      <div class="md-input-wrapper">
                        <input type="text"  data-validation="length" data-validation-length="min2" class="md-form-control md-valid outline_no" name="identity">
                        <?php echo lang('login_identity_label', 'identity');?>
                        <span class="md-line"></span>
                      </div>

                      <div class="md-input-wrapper">
                        <input type="password"  data-validation="length" data-validation-length="min2" class="md-form-control md-valid outline_no" name="password">
                        <?php echo lang('login_password_label', 'password');?>
                        <span class="md-line"></span>
                      </div>

                      <div class="row">
                        <div class="col-sm-6 col-xs-12">
                          <p class="remember_color">
                            <?php echo lang('login_remember_label', 'remember');?>
                            <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
                          </p>
                        </div>
                        <div class="col-sm-6 col-xs-12 forgot-phone text-right">
                          <p><a href="<?php echo base_url();?>user/forgot_password"><?php echo lang('login_forgot_password');?></a></p>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-10 offset-xs-1">
                          <h1>
                            <button type="submit" class="btn btn-login btn-md btn-block text-center m-b-20" style="font-family: 'Roboto', 'Open Sans'; font-weight: 600;"><?php echo lang('login_submit_btn')?></button>
                              <?php echo form_close();?>
                          </h1>
                        </div>
                      </div>

                      <div class="card-footer">
                        <div class="row">
                          <div class="col-sm-12 col-xs-12 text-center">
                            <span class="text-muted"><?php echo lang('no_account', 'signup');?></span>
                               <a href="<?php echo base_url(); ?>user/create_user" class="f-w-600 p-l-5"><?php echo lang('sign_up');?> </a>
                          </div>
                        </div>
                      </div>
                  </form>
                  <!-- end of form -->
                </div>
                <!-- end of login-card -->
             </div>
            <!-- end of col-sm-12 -->
        </div>
        <!--end of row -->
     </div>
    <!-- end of container-fluid -->

  </section>

