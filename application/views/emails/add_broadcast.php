<?php
  //Load Footer
  $this->
$this->load->view('layout/header');;
?>
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script src="https://code.jquery.com/jquery-1.12.4.js">
</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js">
</script>
<script src="<?php echo base_url() ?>assets/javascript/pages/ContactAdd.js">
</script>
<link href="http://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" media="screen" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/css/helpbtn.css" rel="stylesheet" type="text/css">
    <!-- Meta -->
    <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" name="viewport">
            <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
            <meta content="Phoenixcoded" name="description">
                <meta content=", Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app" name="keywords">
                    <meta content="Phoenixcoded" name="author">
                        <!-- Google font-->
                        <!--    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">-->
                        <body class="horizontal-fixed fixed">
                            <div class="wrapper">
                                <!-- Navbar-->
                                <div class="content-wrapper" style="margin-left:0px;">
                                    <div class="margin-bottom-50px">
                                    </div>
                                    <!-- Container-fluid starts -->
                                    <div class="container-fluid">
                                        <!--Simple Form wizard Start-->
                                        <div class="row">
                                            <div class="card media-contactBox">
                                                <div class="card-block ">
                                                    <div class="container">
                                                        <section>
                                                         <form action="<?php echo base_url(); ?>emails/send_broadcast" id="formAddForm" method="POST">
                                                              <div class="contact-details-front-img col-sm-12">

                                                              <input class="contact_ids" name="contact_ids" style="display:none;">
                                <h4>
                                    Send email broadcast
                                </h4>
                            </div>
                            <div class="clear" style="clear:both;"></div>
                            <br>
                             <div class="form-group">
                             <div class="md-input-wrapper">
                                                    <input class="md-form-control md-static" name="name" type="text">
                                                        <label class="block" for="nameS-2">
                                                           Broadcast Name
                                                        </label>
                                                    </input>
                                                </div>
                                                </div>
                             <div class="form-group">
                                        <label class="form-control-label">Template</label>
                                        <select class="form-control " name="template_id">
                                        <?php foreach ($templates as $template) { ?>
                                            <option value="<?php echo $template->id; ?>"><?php echo $template->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                                            <div class="md-group-add-on">
                                                                <div class="gray-table-container margin-bottom-10px margin-top-10px">
                                                                    <div class="margin-left-right-10px margin-top-10px">
                                                                    
                                                                        <h4 class="margin-bottom-10px;">
                                                                            Send email to:
                                                                        </h4>
                                                                        <table class="table table-striped nowrap table-responsive" id="crm-contactsforcompany1">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>
                                                                                        <?php echo lang('add_companies_fname'); ?>
                                                                                    </th>
                                                                                    <th>
                                                                                        <?php echo lang('add_companies_lname'); ?>
                                                                                    </th>
                                                                                    <th>
                                                                                        <?php echo lang('add_companies_email'); ?>
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="connectedSortable" id="sortable1">
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="gray-table-container margin-bottom-10px margin-top-10px">
                                                                    <div class="margin-left-right-10px margin-top-10px">
                                                                        <h4 class="margin-bottom-10px;">
                                                                            <?php echo lang('add_companies_all_contacts'); ?>
                                                                        </h4>
                                                                        <table class="table table-striped nowrap table-responsive" id="crm-contactsforcompany2">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>
                                                                                        <?php echo lang('add_companies_fname'); ?>
                                                                                    </th>
                                                                                    <th>
                                                                                        <?php echo lang('add_companies_lname'); ?>
                                                                                    </th>
                                                                                    <th>
                                                                                        <?php echo lang('add_companies_email'); ?>
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="connectedSortable" id="sortable2">
                                                                                <?php
                                                                if(!empty($available_contacts)) {
                                                                  foreach($available_contacts as $available_contact) {
                                                                    ?>
                                                                                <tr id="<?php echo $available_contact->id ?>">
                                                                                    <td>
                                                                                        <?php echo $available_contact->
                                                                                        first_name; ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?php echo $available_contact->
                                                                                        last_name; ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?php echo $available_contact->
                                                                                        email; ?>
                                                                                    </td>
                                                                                    <?php
                                                                  }
                                                                }
                                                              ?>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                              <div class="clear" style="clear:both;">
                                    </div>
                                    <br>
                                    <div class="col-sm-12" style="text-align: center;">
                                        <button class="addform btn btn-primary waves-effect waves-light btn-md gen-stage" style="margin-left:auto;margin-right:auto;display:inline-block;" type="button">
                                            <i class="icofont icofont-plus m-r-5">
                                            </i>
                                            Send Broadcast
                                        </button>
                                    </div>
                                                        </section>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Simple Form wizard Ends-->
                            </div>
                            <!-- Container-fluid ends -->
                            <script src="<?php echo base_url(); ?>assets/js/addressPhone.js" type="text/javascript">
                            </script>
                            <script src="https://cdn.datatables.net/v/ju-1.11.4/jq-2.2.4/dt-1.10.15/datatables.min.js" type="text/javascript">
                            </script>
                            <script>
$(document).ready(function() {
$( ".addform" ).click(function() {
var contacts = '';
$( "#sortable1 tr" ).each(function() {
  contacts = contacts+$( this ).attr('id')+',';
});
$('.contact_ids').val(contacts);
$('form').submit();
});


        t1 = $('#crm-contactsforcompany1').DataTable({"sDom":"<<'filter-left'f>r<t>lip>"});
        t2 = $('#crm-contactsforcompany2').DataTable({"sDom":"<<'filter-left'f>r<t>lip>"});
        //$("#crm-contactsforcompany1_wrapper.dataTables_length").appendTo("#crm-contactsforcompany1_wrapper.dataTables_info");

        $("#save-button-add-contacts").click(function() {
                $("#formAddCompany").submit( function(){
                  event.preventDefault();
                  var formAddCompany = document.getElementById("formAddCompany");
                  var contacts = document.getElementById("sortable1");

                  var countElem = 0;
                  var countContacts = 0;
                  while(countElem < contacts.childNodes.length){
                    if(contacts.childNodes[countElem] == "[object HTMLTableRowElement]"){
                      if(contacts.childNodes[countElem].firstChild != "[object HTMLTableCellElement]"){
                        var contact = document.createElement("input");
                        contact.setAttribute("name", "contacts_id["+countContacts+"]");
                        contact.setAttribute("value", contacts.childNodes[countElem].getAttribute("id"));
                        contact.setAttribute("type", "hidden");
                        formAddCompany.appendChild(contact);
                        countContacts++;
                      }
                    }
                    countElem++;
                  }
                  this.submit();
                });
        });
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



      // $('#formAddCompany').submit( function(event){
      //   event.preventDefault();
      //   var formAddCompany = document.getElementById("formAddCompany");
      //   var contacts = document.getElementById("sortable1");
      //
      //   var countElem = 0;
      //   var countContacts = 0;
      //   while(countElem < contacts.childNodes.length){
      //     if(contacts.childNodes[countElem] == "[object HTMLTableRowElement]"){
      //       if(contacts.childNodes[countElem].firstChild != "[object HTMLTableCellElement]"){
      //         var contact = document.createElement("input");
      //         contact.setAttribute("name", "contacts_id["+countContacts+"]");
      //         contact.setAttribute("value", contacts.childNodes[countElem].getAttribute("id"));
      //         contact.setAttribute("type", "hidden");
      //         formAddCompany.appendChild(contact);
      //         countContacts++;
      //       }
      //     }
      //     countElem++;
      //   }
      //
      // });
    } );
    /**/
    function addAddressAndPhone(){
      addPhone();
      addAddress();
    }

$(document).ready(function() {
        $('.new-contact-info-card').on('change','.md-form-control',function() {
                if($(this).val().length != 0) {
                        $(this).addClass("md-valid");
                }
        });
});
                            </script>
                            <?php
  //Load Footer
  $this->load->view('layout/footer');
?>
                        </body>
                    </meta>
                </meta>
            </meta>
        </meta>
    </meta>
</link>