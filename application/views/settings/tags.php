<?php $this->load->view('layout/header');?>
	<div class="main-section-full settings">
		<div class="card">
			<div class="card-header main-header">
				<a href="<?php echo base_url('settings');?>">Account Settings</a> <i class="fa fa-chevron-right" aria-hidden="true"></i> <span id="current-page">  </span>
			</div>
			<div class="card-body">
				<div id="tags" class="card-block">
					<div class="row">
						<div class="col-12">
							<div id="accordion" role="tablist">
								<?php $i=1; foreach ($tags as $tag_single):?>
									<div class="card">
										<div class="card-header" role="tab" id="heading<?php echo $tag_single['tag_category_id']; ?>" style="color: #ffffff !important; background-color:#<?php echo $tag_single['tag_category_colour']; ?>;">
											<h5 class="mb-0">
												<a data-toggle="collapse" href="#collapse<?php echo $tag_single['tag_category_id']; ?>" role="button" aria-expanded="true" aria-controls="collapse<?php echo $tag_single['tag_category_id']; ?>">
												<?php echo $tag_single['tag_category_name']; ?>
												</a>
											</h5>
										</div>

										<div id="collapse<?php echo $tag_single['tag_category_id']; ?>" class="collapse <?php if($i==1) echo 'show';?>" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
											<div class="card-body">
												<!-- Form to select color -->
												<form action="<?php echo base_url(); ?>settings/tag_colour_settings" method="POST">
													<div class="color-selection">
														<label>Choose Tag Category Colour</label>
														<button type="button" class="btn btn-tag-colour" title="Red" style="width:30px; height: 30px; background-color:#e56b4e;" onclick="tagColourSave('e56b4e','<?php echo $tag_single['tag_category_id']; ?>')"> </button>
														<button type="button" class="btn btn-tag-colour" title="Orange" style="width:30px; height: 30px; background-color:#db8b3b;" onclick="tagColourSave('db8b3b','<?php echo $tag_single['tag_category_id']; ?>')"> </button>
														<button type="button" class="btn btn-tag-colour" title="Yellow" style="width:30px; height: 30px; background-color:#eacc4e;" onclick="tagColourSave('eacc4e','<?php echo $tag_single['tag_category_id']; ?>')"> </button>
														<button type="button" class="btn btn-tag-colour" title="Green" style="width:30px; height: 30px; background-color:#9bbf80;" onclick="tagColourSave('9bbf80','<?php echo $tag_single['tag_category_id']; ?>')"> </button>
														<button type="button" class="btn btn-tag-colour" title="Aqua" style="width:30px; height: 30px; background-color:#4bb2b2;" onclick="tagColourSave('4bb2b2','<?php echo $tag_single['tag_category_id']; ?>')"> </button>
														<button type="button" class="btn btn-tag-colour" title="Blue" style="width:30px; height: 30px; background-color:#6aa6d8;" onclick="tagColourSave('6aa6d8','<?php echo $tag_single['tag_category_id']; ?>')"> </button>
														<button type="button" class="btn btn-tag-colour" title="Purple" style="width:30px; height: 30px; background-color:#9782bf;" onclick="tagColourSave('9782bf','<?php echo $tag_single['tag_category_id']; ?>')" > </button>
														<button type="button" class="btn btn-tag-colour" title="Pink" style="width:30px; height: 30px; background-color:#c660a7;" onclick="tagColourSave('c660a7','<?php echo $tag_single['tag_category_id']; ?>')"> </button>
														<input style="display:none;" name="tag_category_id" value="<?php echo $tag_single['tag_category_id']; ?>"> </input>
														<button class="btn btn-primary waves-effect waves-light" style="margin-top:5px;"> SAVE</button>
													</div>
													<!-- This looks like an empty div but don't delete its used in javascript !!!!! -->
													<div class="tag-colour-container"></div>
												</form>
												<!-- End of Form to select color -->

												<!-- Sub Categories -->
													<div id="accordion-sub" role="tablist">
														<?php foreach ($tag_single['sub_category'] as $sub_category): ?>
														<div class="card">
															<div class="card-header" role="tab" id="headingsub-<?php echo $sub_category['tag_sub_category_id']; ?>">
																<h6 class="mb-0">
																	<a data-toggle="collapse" href="#collapsesub-<?php echo $sub_category['tag_sub_category_id']; ?>" role="button" aria-expanded="true" aria-controls="collapsesub-<?php echo $sub_category['tag_sub_category_id']; ?>">
																		Sub Category:  <?php echo $sub_category['tag_sub_category_name']; ?>
																	</a>
																</h6>
															</div>

															<div id="collapsesub-<?php echo $sub_category['tag_sub_category_id']; ?>" class="collapse" role="tabpanel" aria-labelledby="headingsub-<?php echo $sub_category['tag_sub_category_id']; ?>" data-parent="#accordion-sub">
																<div class="card-body">
																	<form class="form-inline">
																		<input type="text" class="form-control mb-2 mr-sm-2" id="tag" placeholder="">
																		<button type="submit" class="btn btn-info mb-2 btn-sm">ADD NEW TAG</button>
																	</form>
																</div>
															</div>
														</div>
														<?php endforeach;?>
													</div>
												<!-- End of Sub Categories -->
											</div>
										</div>
									</div>
								<?php $i++; endforeach;?>
							</div>
						</div>
					</div>
					<div class="card-block-footer">
						<div class="row">
							<div class="col-12">
								<a href="<?php echo base_url();?>settings/custom-fields"><button class="btn btn-primary"> Back</button></a>
								<a href="<?php echo base_url();?>settings/connected-apps"><button class="btn btn-primary pull-right"> Next</button></a>
							</div>
						</div>
					</div>
				</div><!-- #tags -->
			</div><!-- .card-body -->
		</div><!-- .card -->
	</div><!-- main-section-full -->
	<script>
        function tagColourSave(colour,id){
            $("#heading"+id).css('background-color','#'+colour+' !important');
        }
    </script>
<?php $this->load->view('layout/footer');?>
