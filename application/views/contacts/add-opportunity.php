<?php
  $this->load->view('layout/header');
?>


<div class="main-section-subnav">
  <section class="tab-current">
        <h2>ADD AN OPPORTUNITY</h2>
        <form id="formAddOpportunity" action="<?php echo base_url(); ?>opportunities/add_opportunity" method="POST">
          <input type="hidden" name="page" value="contacts">
          <input type="hidden" name="contacts_id[]" value="<?php echo $contactid;?>">

          <?php foreach($contact_single['companies'] as $company):?>
          <input type="hidden" name="companies_id[]" value="<?php echo $company->id;?>">
          <?php endforeach;?>
          <fieldset>
            <label for="name">Opportunity Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
          </fieldset>
          <fieldset>
            <label for="colour">Colour:</label>
            <select name="colour" id="stage-colour" class="form-control">
              <option style="background:#9782BF;" value="9782BF">Purple</option>
              <option style="background:#6AA6D8;" value="6AA6D8">Blue</option>
              <option style="background:#4BB2B2;" value="4BB2B2">Turquoise</option>
              <option style="background:#9BBF80;" value="9BBF80">Green</option>
              <option style="background:#EACC4E;" value="EACC4E">Yellow</option>
              <option style="background:#DB8B3B;" value="DB8B3B">Orange</option>
              <option style="background:#E56B4E;" value="E56B4E">Red</option>
              <option style="background:#C660A7;" value="C660A7">Violet</option>
            </select>
          </fieldset>
          <fieldset>
            <label for="stage_id">Stage:</label>
            <select name="stage_id" id="stage_id" class="form-control">
              <?php foreach($stages as $stage):?>
                <option value="<?php echo $stage->stage_id;?>"><?php echo $stage->stage_name;?></option>
              <?php endforeach;?>
            </select>
          </fieldset>
          <fieldset>
            <div class="opportunity-switch">
              <div class="contact-opportunity">Person</div>
              <div class="switch-block">
                <label class="switch">
                  <input type="checkbox" value='1' name='include_company'>
                  <div class="slider round"></div>
                </label>
              </div>
              <div class="company-opportunity">Company</div>
            </div>
          </fieldset>
          <div class="float-right">
            <button type="submit" class="btn btn-primary">SAVE</button>
          </div><!-- end of float right -->
          <div class="clearfix"></div>
        </form>
        
  </section><!-- .tab-current -->
  <?php $this->load->view('layout/planned-past'); ?>
</div><!-- main-section-full -->


<?php
  $this->load->view('layout/sidebar');
  $this->load->view('layout/footer');
?>
