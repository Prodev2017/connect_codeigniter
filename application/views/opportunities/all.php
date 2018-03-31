<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" media="screen" />

<?php
//Load Header
$this->load->view('layout/header');
?>
<div class="main-section-full">
    <!-- Main content starts -->
        <!-- Row end -->
        <div class="row">
                <div class="col-sm-12">
                <div class="card" style="padding:15px;">
                    <div class="card-header">
                        <div class="row">
                                <div class="col-12">
                                <div class="pull-left">
                                        <h4 class="d-inline">
                                                Opportunities
                                        </h4>
                                        <a href="<?php echo base_url(); ?>opportunities/add"  class="btn btn-primary" style="margin-left:15px;"> <i class="fa fa-plus"></i>  Add opportunity</a>
                                </div>
                                <div class="pull-right">
                                        <div>
                                                <button type="button" onclick="switchHideShow('.table-hide-container','.cards-hide-container');" class="btn btn-inverse-primary waves-effect waves-light md-trigger"><i class="toggle-view-btn-card fa fa-th" style="color:#4a5a6a;"> </i></button>
                                                <button type="button" onclick="switchHideShow('.cards-hide-container','.table-hide-container');" class="btn btn-inverse-primary waves-effect waves-light md-trigger"><i class="toggle-view-btn-table fa fa-th-list" style="color:#4a5a6a;"> </i></button>
                                                <i  class="fa fa-question help-icon" data-toggle="tooltip" data-placement="top" title="Fill in the opportunities details........."></i>
                                        </div>
                                </div>
                                </div>
                        </div>
                    </div>
                    <div class="card-block">
                    <div class="table-hide-container" style="display:none;">
                        <div class="row">
                                <div class="col-12">
                                        <div class="project-table table-responsive">
                                                <table id="crm-opportunity" class="table">
                                                <thead>
                                                        <tr>
                                                                <th>Name</th> <!-- name -->
                                                                <th>Stage</th> <!-- actions -->
                                                                <th>Outcome</th>
                                                                <th>Billing Contact</th>
                                                                <th>Company</th>
                                                                <th>Actions</th>
                                                        </tr>
                                                </thead>

                                                <tbody>

                                                <?php if(!empty($opportunities_all)):?>
                                                        <?php foreach($opportunities_all as $opportunity_single):?>
                                                                <tr>
                                                                <!--First name -->
                                                                <td><?php echo $opportunity_single->name ?></td>
                                                                <td><?php echo $opportunity_single->stage_string ?></td>
                                                                <td><?php echo $opportunity_single->outcome_string ?></td>
                                                                <td><?php echo $opportunity_single->billing_contact_string ?></td>
                                                                <td><?php echo $opportunity_single->company_string ?></td>
                                                                <td class="text-center">
                                                                        <?php echo '<a href="' . base_url() . 'opportunities/edit/' . $opportunity_single->id. '">Edit</a>'; ?>
                                                                </td>
                                                                </tr>
                                                        <?php endforeach;?>
                                                <?php endif;?>
                                                </tbody>
                                                </table>
                                        </div><!-- .project-table -->
                                </div>
                        </div><!-- row -->
                    </div><!-- .table-hide-conainer -->
                    <div class="cards-hide-container">
                                <div class="row">
                                <?php if(!empty($opportunities_all)):?>
                                        <?php foreach ($opportunities_all as $opportunity_single):?>
                                                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" id="card<?php echo $opportunity_single->id; ?>">
                                                                <div class="card o-card">
                                                                        <div style="padding-right:0;padding-top:0;">
                                                                                <?php if(strlen($opportunity_single->colour) != 0):?>
                                                                                        <div class="pull-right sticky" style="border-color: transparent #<?php echo $opportunity_single->colour;?> transparent transparent"> </div>
                                                                                <?php endif;?>
                                                                                <a style="margin-top:30px;" href="<?php echo base_url() . 'opportunities/edit/' . $opportunity_single->id; ?>"><?php echo $opportunity_single->name ?> </a>
                                                                                <p>Stage: <?php echo $opportunity_single->stage_string; ?></p>
                                                                                <p>Outcome: <?php echo $opportunity_single->outcome_string; ?></p>
                                                                                <p>Billing Contact: <?php echo $opportunity_single->billing_contact_string ?> </p>
                                                                                <p>Company: <?php echo $opportunity_single->company_string; ?> </p>

                                                                        </div>
                                                                        <a href="<?php echo base_url() . 'opportunities/edit/' . $opportunity_single->id; ?>"> <i class="fa fa-pencil-square-o edit-icon"   data-toggle="tooltip" data-placement="top" title="Edit"></i> </a>
                                                                </div>
                                                        </div>
                                        <?php endforeach;?>
                                <?php endif;?>
                                </div>

                                                                <!-- end of card -->
                        </div><!-- cards-hide-container -->
                    </div><!-- .card-block -->
                </div><!-- .card -->
                </div><!-- .col-sm-12 -->
        </div><!-- .row -->



</div><!-- main-section-full -->

        <!-- end of opportunity-mobi-back -->

        <div class="md-overlay"></div>

        <script type="text/javascript" src="https://cdn.datatables.net/v/ju-1.11.4/jq-2.2.4/dt-1.10.15/datatables.min.js"></script>

        <script>

            $(document).ready(function() {

                $('#crm-opportunity').DataTable();
                $('.cards-filter').DataTable({
                        'paging':false
                });

                $('.cards-hide-container thead').hide();
                $('.cards-hide-container tbody').hide();
                $('.cards-hide-container table').hide();

                $('.cards-hide-container').on('keyup', '.dataTables_filter input', function() {
                        tableLoop();
                });

                $(window).resize(function() {

                        if($(window).width() < 740) {
                                $('.cards-hide-container .dataTables_info').hide();
                        } else {
                                $('.cards-hide-container .dataTables_info').show();
                        }
                });
                if($(window).width() < 625) {
                        $('.cards-hide-container .dataTables_info').hide();
                } else {
                        $('.cards-hide-container .dataTables_info').show();
                }


            } );

            function tableLoop() {
                    $('.cardClass').each(function() {
                            $(this).hide();
                    });

                    $('.cards-hide-container tbody tr td').each(function() {
                            var cardToShow = $(this).attr('id');
                            $('#card'+cardToShow).show();
                    });
            }

            //function to switch between card view
            function switchHideShow(toHide, toShow) {
                    $(toHide).css('display','none');
                    $(toShow).css('display','block');
            }

        </script>


        <?php
        //Load Header
        $this->load->view('layout/footer');
        ?>
