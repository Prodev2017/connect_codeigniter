<?php
  $this->load->view('layout/header');
?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo base_url() ?>assets/js/ContactAdd.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" media="screen" />

<form id="formAddOpportunity" action="<?php echo base_url(); ?>opportunities/add_opportunity" method="POST">
<div class="main-section-full">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="pull-left">
            <h4>Add an Opportunity</h4>
          </div>
          <div class="pull-right">
            <a href="<?php echo base_url('opportunities');?>" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Cancel</a>
          </div>
        </div><!-- .card-header -->
        <div class="card-body">
            <div class="form-group">
              <label for="name">Opportunity Name:</label>
              <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
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
            </div>
            <div>
              <p>
                <button id="to-hide-btn1" type ="button" onclick="contactOpportunity()"  class="btn btn-primary" style="margin:auto; display:block;"> Add a Contact Opportunity <i class=""></i></button>
              </p>
              <p>
                <button id="to-hide-btn2" type ="button" onclick="companyOpportunity()"  class="btn btn-primary" style="margin:auto;  display:block;"> Add a Company Opportunity <i class=""></i></button>
              </p>
            </div>
            <section id="contact-op-card-block" style="display:none;">
              <div class="md-group-add-on">
                      <p>Drag contacts from the All Contacts table into the Company Contacts table and press save to store changes.</p>
                      <div class="gray-table-container margin-bottom-10px margin-top-10px">
                            <div class="margin-left-right-10px margin-top-10px">
                              <h4>Opportunity's Contacts </h4>
                              <table id="crm-contactsforopportunity1" class="table">
                                <thead>
                                  <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                  </tr>
                                </thead>
                                <tbody id="sortable1" class="connectedSortable">
                                </tbody>
                              </table>
                            </div>
                      </div>
                      <div class="gray-table-container margin-bottom-10px margin-top-10px">
                          <div class="margin-left-right-10px margin-top-10px">
                              <h4>All Contacts </h4>
                              <table id="crm-contactsforopportunity2" class="table">
                                <thead>
                                  <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                  </tr>
                                </thead>
                                <tbody id="sortable2" class="connectedSortable">
                                  <?php if(!empty($available_contacts)):?>
                                      <?php foreach($available_contacts as $available_contact):?>
                                        <tr id="<?php echo $available_contact->id ?>">
                                          <td><?php echo $available_contact->first_name; ?></td>
                                          <td><?php echo $available_contact->last_name; ?></td>
                                          <td><?php echo $available_contact->email; ?></td>
                                      <?php endforeach;?>
                                    <?php endif;?>
                                </tbody>
                              </table>
                          </div>
                      </div>
              </div>
            </section><!-- #contact-op-card-block -->
            <section id="company-op-card-block"  style="display:none;">
              <div class="md-group-add-on">
                      <p>Drag contacts from the All Contacts table into the Company Contacts table and press save to store changes.</p>
                      <div class="gray-table-container margin-bottom-10px margin-top-10px">
                            <div class="margin-left-right-10px margin-top-10px">
                              <h4>Opportunity's Companies </h4>
                              <table id="crm-companiesforopportunity1" class="table">
                                <thead>
                                  <tr>
                                    <th>Name</th>
                                  </tr>
                                </thead>
                                <tbody id="sortable3" class="connectedSortable">
                                </tbody>
                              </table>
                            </div>
                      </div>
                      <div class="gray-table-container margin-bottom-10px margin-top-10px">
                          <div class="margin-left-right-10px margin-top-10px">
                              <h4>All Companies </h4>
                              <table id="crm-companiesforopportunity2" class="table">
                                <thead>
                                  <tr>
                                    <th>Name</th>
                                  </tr>
                                </thead>
                                <tbody id="sortable4" class="connectedSortable">
                                  <?php if(!empty($available_companies)):?>
                                      <?php foreach($available_companies as $available_company):?>
                                        <tr id="<?php echo $available_company->id ?>">
                                          <td><?php echo $available_company->company_name; ?></td>
                                      <?php endforeach;?>
                                  <?php endif;?>
                                </tbody>
                              </table>
                          </div>
                      </div>
              </div>
          </section><!-- #company-op-card-block -->
        </div><!-- .card-body -->
        <div class="card-footer">
          <div class="pull-right">
            <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Save</button>
          </div>
        </div><!-- .card-footer -->
      </div><!-- .card -->
    </div><!-- .col-12 -->
  </div><!-- .row -->
</div><!-- main-section-full -->
</form>
<script>

function contactOpportunity() {

  $("#company-op-card-block").hide();
  $("#contact-op-card-block").show();

  $("#to-hide-btn1").hide();
  $("#to-hide-btn2").hide();
}

function companyOpportunity() {
  $("#company-op-card-block").show();
  $("#contact-op-card-block").hide();

  $("#to-hide-btn1").hide();
  $("#to-hide-btn2").hide();
}
//});
</script>



<script type="text/javascript" src="https://cdn.datatables.net/v/ju-1.11.4/jq-2.2.4/dt-1.10.15/datatables.min.js"></script>

<script>
    $(document).ready(function() {

        t1 = $('#crm-contactsforopportunity1').DataTable({"sDom":"rtlfip"});
        t2 = $('#crm-contactsforopportunity2').DataTable({"sDom":"rtlfip"});
        t3 = $('#crm-companiesforopportunity1').DataTable({"sDom":"rtlfip"});
        t4 = $('#crm-companiesforopportunity2').DataTable({"sDom":"rtlfip"});
        //$("#crm-contactsforcompany1_wrapper.dataTables_length").appendTo("#crm-contactsforcompany1_wrapper.dataTables_info");

    } );

    $( function() {
      $( "#sortable1, #sortable2" ).sortable({
        connectWith: ".connectedSortable",
        start: function(event, ui){
          //alert(ui.item);
        },
        receive:  function( event, ui ) {

                if(event.target.id == "sortable1"){

                  t2.row(ui.item).remove().draw();
                  t1.row.add(ui.item).draw();
                }
                else{
                  t1.row(ui.item).remove().draw();
                  t2.row.add(ui.item).draw();
                }


        }
      }).disableSelection();
      $( "#sortable3, #sortable4" ).sortable({
        connectWith: ".connectedSortable",
        start: function(event, ui){
          //alert(ui.item);
        },
        receive:  function( event, ui ) {

                if(event.target.id == "sortable3"){

                  t4.row(ui.item).remove().draw();
                  t3.row.add(ui.item).draw();
                }
                else{
                  t3.row(ui.item).remove().draw();
                  t4.row.add(ui.item).draw();
                }


        }
      }).disableSelection();

      $('#formAddOpportunity').submit( function(event){
        event.preventDefault();
        var formAddOpportunity = document.getElementById("formAddOpportunity");
        var contacts = document.getElementById("sortable1");
        var companies = document.getElementById("sortable3");

        var countElem = 0;
        var countContacts = 0;
        while(countElem < contacts.childNodes.length){
          if(contacts.childNodes[countElem] == "[object HTMLTableRowElement]"){
            if(contacts.childNodes[countElem].firstChild != "[object HTMLTableCellElement]"){
              var contact = document.createElement("input");
              contact.setAttribute("name", "contacts_id["+countContacts+"]");
              contact.setAttribute("value", contacts.childNodes[countElem].getAttribute("id"));
              contact.setAttribute("type", "hidden");
              formAddOpportunity.appendChild(contact);
              countContacts++;
            }
          }
          countElem++;
        }
        var countElem = 0;
        var countCompanies = 0;
        while(countElem < companies.childNodes.length){
          if(companies.childNodes[countElem] == "[object HTMLTableRowElement]"){
            if(companies.childNodes[countElem].firstChild != "[object HTMLTableCellElement]"){
              var company = document.createElement("input");
              company.setAttribute("name", "companies_id["+countCompanies+"]");
              company.setAttribute("value", companies.childNodes[countElem].getAttribute("id"));
              company.setAttribute("type", "hidden");
              formAddOpportunity.appendChild(company);
              countCompanies++;
            }
          }
          countElem++;
        }

        this.submit();

      });
    } );
    /**/
</script>
<?php
  //Load Footer
  $this->load->view('layout/footer');
?>
