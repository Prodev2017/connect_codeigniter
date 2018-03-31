<?php
//Load Header
$this->load->view('layout/login_header');
?>

<body>
<title>rascal <?php echo lang('forgot_password_heading');?> </title>
<section class="login p-fixed d-flex text-center bg-primary common-img-bg">

  <!-- Container-fluid starts -->
  <div class="container-fluid">
    <div class="row">

    <?php echo form_open("auth/forgot_password");?>
    <div class="col-sm-12">
      <?php echo form_open("user/login");?>
        <div class="login-card card-block">
          <form class="md-float-material">
            <div class="text-center">
              <img src="<?php echo base_url(); ?>assets/images/connectablyLogoDark.png" alt="connectably logo" style="max-width:400px;max-height:120px;width: 100%;height: auto; align: center;">
            </div>
            <h3 class="text-center txt-primary">
              <div class="welcome-pages-heading" style=" font-family: 'Montserrat', sans-serif;">
              <h1><?php echo lang('forgot_password_heading');?></h1>
              <p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>
            </div>
              <!-- <p>?php echo lang('login_subheading');?></p> -->
            </h3>
            <div class="md-input-wrapper">
            </div>
            <div class="md-input-wrapper">
              <?php echo form_input($identity,'',"id='identity' class='md-form-control md-valid outline_no'");?>
              <label for="identity" class="block"> <?php echo (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label): sprintf(lang('forgot_password_identity_label'), $identity_label));?> </label>
              <span class="md-line"></span>
            </div>
            <div class="row">
              <div class="col-xs-10 offset-xs-1">
                <h1>
                  <button type="submit" class="btn btn-login btn-md btn-block waves-effect text-center m-b-20" style="font-family: 'Montserrat', 'Open Sans'; font-weight: 600;"><?php echo lang('forgot_password_submit_btn')?></button>
                    <?php echo form_close();?>
                </h1>
              </div>
            </div>
            <div class="card-footer">
              <div class="col-sm-12 col-xs-12 text-center">
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
  <!-- end of container-fluid-->

<div id="infoMessage"><?php echo $message;?></div>
<style type="text/css">

</style>
<?php
//Load Header
$this->load->view('layout/footer');
?>
