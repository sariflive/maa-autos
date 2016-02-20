<!-- start subscribers search -->
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
                    echo form_open('admin/subscribers/manage/search', $attributes);
                ?>
					<div class="form_sep">
						<div class="row">
							<div class="col-md-4">
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
							<div class="col-md-4">
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
							<div class="col-md-4">
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
<!-- end subscribers search -->

<div class="row">
    <!-- start faqs list -->
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h4 class="panel-title martop5">Subscribers</h4>
				</div>
                <div class="pull-right">
                	<?php if($mode == 'edit') { ?>
                	<a class="btn btn-sm btn-default" data-container="body" data-toggle="tooltip" data-placement="top" href="<?php echo site_url("admin/subscribers/manage"); ?>" data-title="Add New">Add New</a>
                	<?php } ?>
                </div>
                <div class="clearfix"></div>
			</div>
			<div class="panel-body">
			    <!-- open bulk delete form -->
                <?php
                    $attributes = array('method' => 'post', 'id'=>'frmBulkDel');
                    echo form_open('admin/subscribers/manage/bulk_delete', $attributes);
                ?>
                    <!-- start faqs list table -->
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
                                    ?>
								</th> 
								<th>Name</th>
								<th>E-mail</th>
								<th>Status</th>
								<th data-hide="phone">Action</th>
							</tr>
						</thead>
                        <!-- //end table head -->
                        
                        <!-- start table body -->
						<tbody>
							<?php if(count($subscribers) > 0) {
								foreach ($subscribers as $key => $row) {
									$alphaID = alphaID($row['ID']);
									$status = ($row['status'] == '1') ? "Enbled" : 'Disabled';
									$status_label = ($row['status'] == '1') ? "label-success" : 'label-danger';
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
                                    ?>
								</td>
								<td><?php echo $row['name']; ?></td>
								<td><?php echo $row['email']; ?></td>
								<td>
									<a data-original-title="Select Status" data-url="<?php echo site_url("admin/subscribers/status_update"); ?>" data-value="<?php echo $row['status']; ?>" data-pk="<?php echo $alphaID; ?>" data-type="select" data-name="status" name="status" class="rstatusopt" href="#">
										<label class="label <?php echo $status_label; ?> pointer"><?php echo $status; ?></label>
									</a>
								</td>
								<td>
									<div class="btn-group">
									    <!-- edit button -->
										<a href="<?php echo site_url("admin/subscribers/manage/edit/{$alphaID}"); ?>" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" data-title="Edit"><i class="fa fa-edit"></i></a>
										<!-- single delete button -->
										<button class="btn btn-danger btn-xs btnDel" data-url="<?php echo site_url("admin/subscribers/manage/delete"); ?>" id="<?php echo $alphaID; ?>" data-toggle="tooltip" data-placement="top" data-title="Delete"><i class="fa fa-trash"></i></button>
									</div>
								</td>
							</tr>
							<?php }
							} else echo '<tr><td colspan="5">'.admin_errors(3).'</td></tr>'; ?>
						</tbody>
                        <!-- //end table body -->

                        <!-- start table footer -->
						<tfoot>
							<tr>
								<td colspan="5">
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
                                        ?>
									</div>
									<!-- pagination -->
									<div class="pull-right"><?php echo $pagination; ?></div>
								</td>
							</tr>
						</tfoot>
						<!-- //end table footer -->
					</table>
                    <!-- //end subscriber list table -->
                <?php echo form_close(); ?>
                <!-- //end bulk delete form -->
			</div>
		</div>
	</div>
	<!-- end subscriber list -->
	
	<!-- start subscriber manage -->
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h4 class="panel-title martop5"><?php echo ucfirst($mode); ?> Subscriber</h4>
				</div>
                <div class="pull-right">
                	<?php if($mode == 'edit') { ?>
                    <a class="btn btn-sm btn-default" data-container="body" data-toggle="tooltip" data-placement="top" href="<?php echo site_url("admin/subscribers/manage"); ?>" data-title="Add New">Add New</a>
                	<?php } ?>
                </div>
                <div class="clearfix"></div>
			</div>
			<div class="panel-body">
                <!-- open subscriber manage form -->
                <?php
                    $attributes = array('method' => 'post', 'class' => "validate-form", 'id' => 'validate-subscriber', 'name' => 'validate-subscriber');
                    echo form_open("admin/subscribers/manage/{$mode}/{$subscriber_id}", $attributes);
                ?>
					<div class="form_sep">
                        <?php
                           $attributes = array('class' => 'req');
                           echo form_label('Name', 'name', $attributes);
                         ?>
                        <?php
                            $input_data = array(
                                  'name'         => 'name',
                                  'id'           => 'name',
                                  'value'        => (isset($subscriber_data['name'])) ? $subscriber_data['name'] : set_value("name"),
                                  'type'         => 'text',
                                  'class'        => 'form-control',
                                  'data-required'=> 'true',
                                  'placeholder'  => 'Enter Name',
                                );
                            echo form_input($input_data);
                        ?>
					</div>
					<div class="form_sep">
                        <?php
                           $attributes = array('class' => 'req');
                           echo form_label('E-mail', 'email', $attributes);
                         ?>
                        <?php
                            $input_data = array(
                                  'name'         => 'email',
                                  'id'           => 'email',
                                  'value'        => (isset($subscriber_data['email'])) ? $subscriber_data['email'] : set_value("email"),
                                  'type'         => 'email',
                                  'class'        => 'form-control',
                                  'data-required'=> 'true',
                                  'data-type'    => 'email',
                                  'placeholder'  => 'Enter email',
                                );
                            echo form_input($input_data);
                        ?>
					</div>
					<div class="form_sep">
						<label for="status" class="req">Status</label>
						<select name="status" id="status" class="select2">
							<option value="1" <?php if(isset($subscriber_data['status']) && $subscriber_data['status'] == '1') echo 'selected'; elseif(set_value("status") == '1') echo 'selected'; ?>>Enabled</option>
							<option value="0" <?php if(isset($subscriber_data['status']) && $subscriber_data['status'] == '0') echo 'selected'; elseif(set_value("status") == '0') echo 'selected'; ?>>Disabled</option>
						</select>
					</div>
					<div class="form_sep">
                        <?php
                            $button_data = array(
                                  'name'    => 'submit',
                                  'id'      => 'submit',
                                  'type'    => 'submit',
                                  'class'   => 'btn btn-primary',
                                  'content' => 'Save'
                                );
                           echo form_button($button_data);
                        ?>
					</div>
                 <?php echo form_close(); ?>
                <!-- end subscriber manage form -->
			</div>
		</div>
	</div>
	<!-- //end subscriber manage -->
</div>