<?php
//Load Header
$this->load->view('layout/header');
?>
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
</script>
    <div class="clearfix"></div>
    <div class="main-section-full" style="margin-top:50px;">
        <div class="row justify-content-md-center">
            <div class="col-12 col-sm-8 col-md-6">
                <h3>Add New Template</h3>
                <hr>
                <form action="<?php echo base_url(); ?>emails/add_email_template" id="formAddForm" method="POST">
                    <div class="form-group">
                        <label for="name">Template Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Next</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
</body>
<?php
  //Load Header
  $this->load->view('layout/footer');
  ?>

