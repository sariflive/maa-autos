<!-- start testimonial search -->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h4 class="panel-title martop5">Search</h4>
				</div>
                <div class="pull-right">
                    <button class="btn btn-sm btn-circle btn-default clickCollapse" data-action="collapse" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                </div>
                <div class="clearfix"></div>
			</div>
			<div class="panel-body">
                <!-- open search form -->
                <?php
                    $attributes = array('method' => 'get');
                    echo form_open('admin/testimonials/manage/search', $attributes);
                ?>
					<div class="form_sep">
						<div class="row">
							<div class="col-md-3">
								<?php $search_name = $this->input->get("name"); ?>
                                <?php echo form_label('Name', 'name'); ?>
                                <?php
                                    $input_data = array(
                                          'name'        => 'name',
                                          'id'          => 'search_name',
                                          'value'       => $search_name,
                                          'type'        => 'text',
                                          'class'       => 'form-control',
                                          'placeholder' => 'Name',
                                        );
                                    echo form_input($input_data);
                                ?>
							</div>
							<div class="col-md-3">
								<?php $search_email = $this->input->get("email"); ?>
                                <?php echo form_label('E-mail', 'email'); ?>
                                <?php
                                    $input_data = array(
                                          'name'        => 'email',
                                          'id'          => 'search_email',
                                          'value'       => $search_email,
                                          'type'        => 'email',
                                          'class'       => 'form-control',
                                          'placeholder' => 'E-mail Address',
                                        );
                                    echo form_input($input_data);
                                ?>
							</div>
							<div class="col-md-3">
								<?php $search_company_name = $this->input->get("company_name"); ?>
                                <?php echo form_label('Company Name', 'name'); ?>
                                <?php
                                    $input_data = array(
                                          'name'        => 'company_name',
                                          'id'          => 'search_company_name',
                                          'value'       => $search_company_name,
                                          'type'        => 'text',
                                          'class'       => 'form-control',
                                          'placeholder' => 'Company Name',
                                        );
                                    echo form_input($input_data);
                                ?>
							</div>
							<div class="col-md-3">
								<?php $search_status = $this->input->get("status"); ?>
								<label for="status">Status</label>
								<select name="status" id="search_status" class="select2">
									<option value="">--SELECT--</option>
									<option value="1" <?php if($search_status === '1') echo 'selected'; ?>>Enabled</option>
									<option value="0" <?php if($search_status === '0') echo 'selected'; ?>>Disabled</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form_sep">
                        <?php
                            $button_data = array(
                                  'name'    => 'search',
                                  'id'      => 'search_button',
                                  'type'    => 'submit',
                                  'class'   => 'btn btn-primary',
                                  'content' => 'Search'
                                );
                           echo form_button($button_data);
                        ?>
					</div>
                <?php echo form_close(); ?>
                <!-- end search form -->
			</div>
		</div>
	</div>
</div>
<!-- //end testimonial search -->

<!-- start testimonial list -->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h4 class="panel-title martop5">Testimonials List </h4>
				</div>
				<div class="pull-right">
					<a class="btn btn-sm btn-default" href="<?php echo site_url("admin/testimonials/manage"); ?>" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Add New">Add New</a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
                <!-- open bulk delete form -->
                <?php
                    $attributes = array('method' => 'post', 'id'=>'frmBulkDel');
                    echo form_open('admin/testimonials/manage/bulk_delete', $attributes);
                ?>
                    <!-- start testimonial list table -->
					<table class="table table-vam table-striped table-bordered FooTableOdd" id="dt_gal">
					    <!-- start table head -->
						<thead>
							<tr>
								<th class="table_checkbox" style="width:13px">
                                    <!-- bulk delete select all checkbox -->
                                    <?php
                                        $input_data = array(
                                              'name'        => 'select_rows',
                                              'data-tableid'=> 'dt_gal',
                                              'value'       => '',
                                              'type'        => 'checkbox',
                                              'class'       => 'select_rows ICheckOdd',
                                            );
                                        echo form_input($input_data);
                                        unset($input_data);
                                    ?>
								</th>
						        <th class="hidden-xs">Photo</th>
					        	<th>Testimonial</th>
					        	<th data-hide="phone">Name</th>
					        	<th data-hide="phone,tablet">Company Name</th>
					        	<th data-hide="phone,tablet">Contacts</th>
								<th>Status</th>
								<th data-hide="phone,tablet" width="11%">Action</th>
							</tr>
						</thead>
                        <!-- //end table head -->
                        
                        <!-- start table body -->
						<tbody>
							<?php if(count($testimonials) > 0) {
								foreach ($testimonials as $key => $row) {
									$alphaID = alphaID($row['ID']);
									$status = ($row['status'] == '1') ? "Enbled" : 'Disabled';
									$status_label = ($row['status'] == '1') ? "label-success" : 'label-danger';
									$tetimonial_image = (!empty($row['image']) && file_exists("./uploads/media/testimonials/{$row['image']}")) ? base_url()."uploads/media/testimonials/{$row['image']}" : base_url()."images/no-image/no_img_180.png";
							?>
							<tr id="<?php echo $alphaID; ?>">
								<td>
                                    <!-- bulk delete single select checkbox -->
                                    <?php
                                        $input_data = array(
                                              'name'        => 'row_sel[]',
                                              'value'       => $alphaID,
                                              'type'        => 'checkbox',
                                              'class'       => 'row_sel ICheckOdd',
                                            );
                                        echo form_input($input_data);
                                        unset($input_data);
                                    ?>
								</td>
			        			<td class="hidden-xs" style="width:10%">
									<a  title="<?php echo $row['name']; ?>">
										<img style="height:80px; width:80px" src="<?php echo $tetimonial_image; ?>" alt="<?php echo $row['name']; ?>">
									</a>
								</td>
			        			<td><?php echo substr($row['testimonial'], 0, 200);?></td>
			        			<td><?php echo $row['name']; ?><br /><?php echo $row['designation'];?></td>
			        			<td><?php echo $row['company_name']; ?></td>
			        			<td><?php if(!empty($row['phone']) || !empty($row['mobile']) || !empty($row['email']) || !empty($row['web'])) echo $row['phone']."<br />".$row['mobile']."<br />".$row['email']."<br />".$row['web']; else echo "N/A";?></td>
								<td>
									<a data-original-title="Select Status" data-url="<?php echo site_url("admin/testimonials/status_update"); ?>" data-value="<?php echo $row['status']; ?>" data-pk="<?php echo $alphaID; ?>" data-type="select" data-name="status" name="status" class="rstatusopt" href="#">
										<label class="label <?php echo $status_label; ?> pointer"><?php echo $status; ?></label>
									</a>
								</td>
								<td>
									<div class="btn-group">
									    <!-- edit button -->
										<a href="<?php echo site_url("admin/testimonials/manage/edit/{$alphaID}"); ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" data-title="Edit"><i class="fa fa-edit"></i></a>
										<!-- single delete button -->
										<button class="btn btn-danger btn-sm btnDel" data-url="<?php echo site_url("admin/testimonials/manage/delete"); ?>" id="<?php echo $alphaID; ?>" data-toggle="tooltip" data-placement="top" data-title="Delete"><i class="fa fa-trash"></i></button>
									</div>
								</td>
							</tr>
							<?php } 
							} else echo '<tr><td colspan="8">'.admin_errors(3).'</td></tr>'; ?>
						</tbody>
						<!-- //end table body -->

                        <!-- start table footer -->
						<tfoot>
							<tr>
								<td colspan="8">
									<div class="pull-left">
										<br />
                                        <!-- bulk delete button -->
                                        <?php
                                            $input_data = array(
                                                  'name'        => 'deleterows',
                                                  'data-tableid'=> 'dt_gal',
                                                  'value'       => 'Delete Selected',
                                                  'type'        => 'submit',
                                                  'class'       => 'btn btn-inverse btn-sm delete_rows_dt',
                                                );
                                            echo form_input($input_data);
                                            unset($input_data);
                                        ?>
									</div>
									<!-- pagination -->
									<div class="pull-right"><?php echo $pagination; ?></div>
								</td>
							</tr>
						</tfoot>
                        <!-- end table footer -->
                    </table>
                    <!-- end feedback list table -->
                <?php echo form_close(); ?>
                <!-- end bulk delete form -->
			</div>
		</div>
	</div>	
</div>
<!-- end testimonial list -->