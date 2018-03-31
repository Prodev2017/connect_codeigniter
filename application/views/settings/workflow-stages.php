<?php $this->load->view('layout/header');?>
	<div class="main-section-full settings">
		<div class="card">
			<div class="card-header main-header">
				<a href="<?php echo base_url('settings');?>">Account Settings</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>  <a href="<?php echo base_url();?>settings/workflows"> Workflows</a>  <i class="fa fa-chevron-right" aria-hidden="true"></i> Stages
			</div>
			<div class="card-body">
				<div id="workflows" class="card-block">
					<div class="row">
						<div class="col-12">
							<div class="pull-left">
								<h4><strong><?php echo $workflow->workflow_name;?></strong></h4>
							</div>
							<div class="pull-right">
								<button type="button" onclick="load_modal('<?php echo base_url().'ajax/modal?m=stage-new&workflow_id='.$workflow->workflow_id;?>')" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> New Stage </button>
							</div>
							<div class="clearfix"></div>
            				<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Name</th>
										<th>Order</th>
                                        <th>Colour</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($stages as $row):?>
									<tr>
										<td><?php echo $row->stage_name;?></td>
										<td><?php echo $row->stage_order;?></td>
                                        <td>
                                            <div class="color-display" style="background-color:#<?php echo $row->colour; ?>">
                                            </div>
                                        </td>
										<td class="text-center">
											<a href="#" class="btn btn-info btn-sm" onclick="load_modal('<?php echo base_url().'ajax/modal?m=stage-edit&id='.$row->stage_id;?>')"><i class="fa fa-pencil"></i> Edit</a>
											<a href="#" class="btn btn-danger btn-sm delete" data-id="<?php echo $row->stage_id; ?>">Delete</a>
										</td>
									</tr>
									<?php endforeach;?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="card-block-footer">
						<div class="row">
							<div class="col-12">
								
								<a href="<?php echo base_url();?>settings/users"><button class="btn btn-primary"> Back</button></a>
								<a href="<?php echo base_url();?>settings/stages"><button class="btn btn-primary pull-right"> Next</button></a>
							</div>
						</div>
					</div>
				</div><!-- #workflows -->
			</div><!-- .card-body -->
		</div><!-- .card -->
	</div><!-- main-section-full -->
	<script>
		$(".delete").on("click",function(){
			var confirm = window.confirm("Do you really want to delete this?");
			if(!confirm){
				return false;
			}
			var id = $(this).data('id');
			var $self = $(this);
			$.ajax({
				url:base_url+'settings/delete_stage/'+id,
				dataType:'json',
				beforeSend:function(){
					$self.attr('disabled','disabled');
				},
				complete:function(){
					$self.removeAttr('disabled');
				},
				success:function(data){
					if(data.success){
						$self.parent().parent().remove();
					}
					else{
						alert(data.message);
						// a better alert system can be used here
					}
				}
			})
		})
	</script>
<?php $this->load->view('layout/footer');?>
