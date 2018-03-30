<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" media="screen" />

<?php
//Load Header
$this->load->view('layout/header');
?>


<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<body class="horizontal-fixed fixed">

<div class="container-fluid">
    <!-- Main content starts -->
    <div >
        <!-- Row end -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-header-text d-inline-block m-b-0 f-w-600">
                            Broadcasts
                        </h5>
                        <a href="<?php echo base_url(); ?>emails/add_broadcast"> <button type="button" class="btn btn-primary waves-effect waves-light f-right md-trigger" data-modal="modal-13"> <i class="icofont icofont-plus m-r-5"></i>  Send broadcast
                            </button> </a>

                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="table-content crm-table">
                                <div class="project-table">
                                    <table id="crm-contact" class="table table-striped nowrap table-responsive">

                                        <thead>

                                        <tr>
                                            <th width="80%">Name</th>
                                            <th width="20%" class="text-center">Template</th>
                                            <th width="20%" class="text-center">Contacts</th>
                                            <th width="20%" class="text-center">Date</th>
                                        </tr>

                                        </thead>

                                        <tbody>

                                        <?php
                                        if(!empty($broadcasts_all)) {
                                            foreach($broadcasts_all as $broadcast_single) {
                                                ?>
                                                <tr>
                                                    <!--First name -->
                                                   <td><?php echo $broadcast_single->name; ?></td>
                                                    <td><?php echo $template_by_id[$broadcast_single->template_id]->name; ?></td>
                                                    <td><?php echo count(array_diff(explode(',', $broadcast_single->contacts), array(''))); ?></td>
                                                    <td><?php echo $broadcast_single->date; ?></td>
                                                    
                                                  
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="md-overlay"></div>

        <script type="text/javascript" src="https://cdn.datatables.net/v/ju-1.11.4/jq-2.2.4/dt-1.10.15/datatables.min.js"></script>

        <script>

            $(document).ready(function() {

                $('#crm-contact').DataTable();

            } );

        </script>

        <?php
        //Load Header
        $this->load->view('layout/footer');
        ?>
