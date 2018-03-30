<?php 
$this->load->view('layout/header');
?>

<div class="container-emails">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6">
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
                <div class="col-12 col-sm-12 col-md-6">
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
                        <div class="card-view">
                            <div class="header">
                                <div class="title">TITLE</div>
                                <div class="created-by">CREATED BY</div>
                                <div class="date-sent">DATE SENT</div>
                            </div>
                            <div class="email-cards">
                                <?php if(!empty($emails_all)):?>
                                    <?php $i=1; foreach($emails_all as $email_single):?>
                                                <div class="email-card email-item <?php if($i==1) echo 'active';?>" data-id="<?php echo $email_single->id;?>">
                                                    <div class="email-card-header">
                                                        <div class="title">
                                                            <?php echo $email_single->name;?>             
                                                        </div>
                                                        <div class="created-by">
                                                            M Sugden
                                                        </div>
                                                        <div class="date-sent">
                                                            18.11.2017
                                                        </div>
                                                    </div>
                                                    <div class="email-card-body">
                                                        <div class="left">
                                                            <div>
                                                                Last sent on : 18.11.2017
                                                            </div>
                                                            <div>
                                                                Sent by: Captain C Cook
                                                            </div>
                                                            <div>
                                                                Sent to: Apple inc
                                                            </div>
                                                            <div class="tags">
                                                                <button class="btn btn-tag">Events</button>
                                                                <button class="btn btn-tag">Construction</button>
                                                                <button class="btn btn-tag">Food &amp; Dring</button>
                                                                <button class="btn btn-tag">Luxury Items</button>
                                                                <button class="btn btn-tag">Wholesale</button>
                                                            </div>
                                                        </div>
                                                        <div class="right">
                                                            <a href="<?php echo base_url().'emails/edit_template/'.$email_single->id; ?>">
                                                            <i class="fa fa-pencil-square-o"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php $i++; endforeach;?>
                                <?php endif;?>
                            </div>
                        </div>
                </div>
            </div>
        </div>
</div>


<?php 
$this->load->view('layout/footer');
?>
<script>
    $(document).ready(function () {
        remove_editable_in_preview();
    });
</script>
