<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" media="screen" />

<?php
//Load Header
$this->load->view('layout/header');
?>


<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="main-section-full">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="email-templates">
                    <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox"></th>
                            <th>TITLE</th>
                            <th>CREATED BY</th>
                            <th>DATE CREATED</th>
                            <th>DATE MODIFIED</th>
                            <th class="text-center">
                                <a href="<?php echo base_url().'emails?view=card';?>">
                                    <i class="fa fa-th"  data-toggle="tooltip" data-placement="top" title="Card View"></i> 
                                </a>
                                <a href="<?php echo base_url().'emails?view=list';?>">
                                    <i class="fa fa-th-list"  data-toggle="tooltip" data-placement="top" title="List View"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($emails_all)):?>
                                <?php foreach($emails_all as $email_single):?>
                                    <tr>
                                        <th class="text-center"><input type="checkbox"></th>
                                        <td><?php echo $email_single->name; ?></td>
                                        <td>N Sugden</td>
                                        <td>11.11.2017</td>
                                        <td>18.11.2017</td>
                                        <td class="text-center">
                                            <a href="<?php echo base_url().'emails/edit_template/'.$email_single->id; ?>" class="btn btn-primary">VIEW/EDIT</a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>       

<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/ju-1.11.4/jq-2.2.4/dt-1.10.15/datatables.min.js"></script>

<script>

    $(document).ready(function() {

        $('#email-templates').DataTable();

    } );

</script> -->

<?php
//Load Header
$this->load->view('layout/footer');
?>
