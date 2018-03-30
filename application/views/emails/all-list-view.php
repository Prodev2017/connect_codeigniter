<?php 
$this->load->view('layout/header');
?>

<div class="container-emails">
        <div class="col-12">
            <div class="row">
                <div class="col-sm-6">
                    <div class="email-preivew-section">
                        <div class="email-preview-header">
                            <div class="pull-left">
                                <h4>PREVIEW</h4>
                            </div>
                            <div class="pull-right">
                                <button class="btn btn-primary">DUPLICATE TEMPLATE</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="email-preview" id="email-preview">
                            <?php if($emails_all):?>
                                <?php echo base64_decode($emails_all[0]->html_template);?>
                            <?php endif;?>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="emails-list-header">
                        <div class="search-block">
                            <div>
                                SEARCH
                            </div>
                            <input type="text" placeholder="Keyword"> <button class="btn btn-primary">SEARCH</button>
                        </div> 
                        <div class="buttons-block">
                             <a href="<?php echo base_url('emails/add_template');?>" class="btn btn-primary">CREATE EMAIL</a>
                        </div>
                    </div>
                    <div class="mb-15">
                        <div class="pull-left">
                        Results
                        </div>
                        <div class="pull-right">
                            <a href="<?php echo base_url().'emails?view=card';?>">
                                <i class="fa fa-th" data-toggle="tooltip" data-placement="top" title="Card View"></i> 
                            </a>
                            <a href="<?php echo base_url().'emails?view=list';?>">
                                <i class="fa fa-th-list"  data-toggle="tooltip" data-placement="top" title="List View"></i>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>TITLE</th>
                                <th>CREATED BY</th>
                                <th>DATE SENT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($emails_all)):?>
                                <?php $i=1; foreach($emails_all as $email_single):?>
                                    <tr class="email-item  <?php if($i==1) echo 'active';?>" data-id="<?php echo $email_single->id;?>">
                                        <td><?php echo $email_single->name; ?></td>
                                        <td>
                                            Sigden
                                        </td>
                                        <td>
                                            18.11.2017
                                            <a href="<?php echo base_url().'emails/edit_template/'.$email_single->id; ?>">
                                            <i class="fa fa-pencil-square-o pull-right"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php $i++; endforeach;?>
                        <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>

<?php 
$this->load->view('layout/footer');
?>
<script>
    $(document).ready(function(){
        var editable_elements = document.querySelectorAll("[contenteditable=true]");
        console.log(editable_elements);
        for(var i=0; i<editable_elements.length; i++)
            editable_elements[i].setAttribute("contenteditable", false);
        });
</script>
