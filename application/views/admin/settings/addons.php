<!-- start addons search -->
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
                    echo form_open('admin/settings/addons/search', $attributes);
                ?>
					<div class="form_sep">
						<div class="row">
							<div class="col-md-4">
								<?php $search_addon = $this->input->get("addon"); ?>
                                <?php echo form_label('Addon', 'addon'); ?>
                                <?php
                                    $input_data = array(
                                          'name'        => 'addon',
                                          'id'          => 'search_addon',
                                          'value'       => $search_addon,
                                          'type'        => 'text',
                                          'class'       => 'form-control',
                                          'placeholder' => 'Addon',
                                        );
                                    echo form_input($input_data);
                                ?>
							</div>
							<div class="col-md-4">
								<?php $search_group = $this->input->get("group"); ?>
                                <?php echo form_label('Group', 'group'); ?>
                                <?php
                                    $input_data = array(
                                          'name'        => 'group',
                                          'id'          => 'search_group',
                                          'value'       => $search_group,
                                          'type'        => 'text',
                                          'class'       => 'form-control',
                                          'placeholder' => 'Group',
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
<!-- end addons search -->

<div class="row">
    <!-- start addons list -->
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h4 class="panel-title martop5">Addons List</h4>
				</div>
                <div class="pull-right">
                	<?php if($mode == 'edit') { ?>
                    <a class="btn btn-sm btn-default" href="<?php echo site_url("admin/settings/addons"); ?>" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Add New">Add New</a>
                	<?php } ?>
                </div>
                <div class="clearfix"></div>
			</div>
			<div class="panel-body">
                <!-- open bulk delete form -->
                <?php
                    $attributes = array('method' => 'post', 'id'=>'frmBulkDel');
                    echo form_open('admin/settings/addons/bulk_delete', $attributes);
                ?>
                    <!-- start addons list table -->
					<table class="table table-vam table-striped table-bordered" id="dt_gal">
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
								<th>Addon</th>
								<th class="hidden-xs">Group</th>
								<th class="hidden-sm hidden-xs">Status</th>
								<th>Action</th>
							</tr>
						</thead>
                        <!-- //end table head -->
                        
                        <!-- start table body -->
						<tbody>
							<?php if(count($addons) > 0) {
								foreach ($addons as $key => $row) {
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
								<td><?php echo $row['addon']; ?></td>
								<td class="hidden-xs"><?php echo $row['group']; ?></td>
								<td class="hidden-sm hidden-xs">
									<a data-original-title="Select Status" data-url="<?php echo site_url("admin/settings/addons_status_update"); ?>" data-value="<?php echo $row['status']; ?>" data-pk="<?php echo $alphaID; ?>" data-type="select" data-name="status" name="status" class="rstatusopt" href="#">
										<label class="label <?php echo $status_label; ?> pointer"><?php echo $status; ?></label>
									</a>
								</td>
								<td>
									<div class="btn-group">
									    <!-- edit button -->
										<a href="<?php echo site_url("admin/settings/addons/edit/{$alphaID}"); ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" data-title="Edit"><i class="fa fa-edit"></i></a>
										<!-- single delete button -->
										<button class="btn btn-danger btn-sm btnDel" data-url="<?php echo site_url("admin/settings/addons/delete"); ?>" id="<?php echo $alphaID; ?>" data-toggle="tooltip" data-placement="top" data-title="Delete"><i class="fa fa-trash"></i></button>
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
						<!-- end table footer -->
					</table>
                    <!-- end addons list table -->
                <?php echo form_close(); ?>
                <!-- end bulk delete form -->
			</div>
		</div>
	</div>
    <!-- end addons list -->

    <!-- start addon manage -->
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h4 class="panel-title martop5"><?php echo ucfirst($mode); ?> Addon</h4>
				</div>
                <div class="pull-right">
                	<?php if($mode == 'edit') { ?>
                    <a class="btn btn-sm btn-default" href="<?php echo site_url("admin/settings/addons"); ?>" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Add New">Add New</a>
                	<?php } ?>
                </div>
                <div class="clearfix"></div>
			</div>
			<div class="panel-body">
                <!-- open addon manage form -->
                <?php
                    $attributes = array('method' => 'post', 'class' => "validate-form", 'id' => 'validate-addon', 'name' => 'validate-addon');
                    echo form_open("admin/settings/addons/{$mode}/{$addon_id}", $attributes);
                ?>
					<div class="form_sep">
                        <?php
                           $attributes = array('class' => 'req');
                           echo form_label('Addon', 'addon', $attributes);

                           $input_data = array(
                                  'name'         => 'addon',
                                  'id'           => 'addon',
                                  'value'        => (isset($addon_data['addon'])) ? $addon_data['addon'] : set_value("addon"),
                                  'type'         => 'text',
                                  'class'        => 'form-control',
                                  'data-required'=> 'true',
                                  'placeholder'  => 'Enter addon',
                                );
                           echo form_input($input_data);
                        ?>
					</div>
					<div class="form_sep">
                        <?php
                           $attributes = array('class' => 'req');
                           echo form_label('Group', 'group', $attributes);
                         ?>
                        <?php
                            $input_data = array(
                                  'name'         => 'group',
                                  'id'           => 'group',
                                  'value'        => (isset($addon_data['group'])) ? $addon_data['group'] : set_value("group"),
                                  'type'         => 'text',
                                  'class'        => 'form-control',
                                  'data-required'=> 'true',
                                  'placeholder'  => 'Enter group',
                                );
                            echo form_input($input_data);
                        ?>
					</div>
					<div class="form_sep">
						<label for="description ">Description</label>
						<textarea id="description" name="description" class="form-control" placeholder="Enter description"><?php if(isset($addon_data['group'])) echo $addon_data['group']; else echo set_value("group"); ?></textarea>
					</div>
					<div class="form_sep">
						<label for="status" class="req">Status</label>
						<select name="status" id="status" class="select2" data-required="true">
							<option value="1" <?php if(isset($addon_data['status']) && $addon_data['status'] == '1') echo 'selected'; elseif(set_value("status") == '1') echo 'selected'; ?>>Enabled</option>
							<option value="0" <?php if(isset($addon_data['status']) && $addon_data['status'] == '0') echo 'selected'; elseif(set_value("status") == '0') echo 'selected'; ?>>Disabled</option>
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
                <!-- end faqs manage form -->
			</div>
		</div>
	</div>
    <!-- end addon manage -->
</div>