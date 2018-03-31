<?php $this->load->view('layout/header');?>
	<div class="main-section-full settings">
		<div class="card">
			<div class="card-header main-header">
				<a href="<?php echo base_url('settings');?>">Account Settings</a> <i class="fa fa-chevron-right" aria-hidden="true"></i> <span id="current-page"> Workflows </span>
			</div>
			<div class="card-body">
				<div id="workflows" class="card-block">
					<div class="row">
						<div class="col-12">
							<div class="pull-left">
								<h4>Workflows</h4>
							</div>
							<div class="pull-right">
								<button type="button" onclick="load_modal('<?php echo base_url().'ajax/modal?m=workflow-new';?>')" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> New Workflow </button>
							</div>
							<div class="clearfix"></div>
            				<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Name</th>
										<th>Order</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($workflows as $row):?>
									<tr>
										<td><?php echo $row->workflow_name;?></td>
										<td><?php echo $row->workflow_order;?></td>
										<td class="text-center">
											<a href="<?php echo base_url(),'settings/workflows/'.$row->workflow_id;?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> View Stages</a>
											<a href="#" class="btn btn-info btn-sm" onclick="load_modal('<?php echo base_url().'ajax/modal?m=workflow-edit&id=',$row->workflow_id;?>')"><i class="fa fa-pencil"></i> Edit</a>
											<?php if(count($workflows)>1):?>
											<a href="#" class="btn btn-danger btn-sm delete" data-id="<?php echo $row->workflow_id; ?>">Delete</a>
											<?php endif;?>
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
				url:base_url+'settings/delete_workflow/'+id,
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
						// now check how many workflows are left. We need at least one of them to be there
						var rows = $("tbody tr");
						if(rows.length==1){
							$(".delete").remove();
						}
						
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
