<div class="row">
    <!-- start languages list -->
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h4 class="panel-title martop5">Languages</h4>
				</div>
                <div class="pull-right">
                	<?php if($mode == 'edit') { ?>
                    <a class="btn btn-sm btn-default" data-container="body" data-toggle="tooltip" data-placement="top" href="<?php echo site_url("admin/settings/languages/manage"); ?>" data-title="Add New">Add</a>
                	<?php } ?>
                </div>
                <div class="clearfix"></div>
			</div>
			<div class="panel-body">
                <!-- open bulk delete form -->
                <?php
                    $attributes = array('method' => 'post', 'id'=>'frmBulkDel');
                    echo form_open('admin/settings/languages/bulk_delete', $attributes);
                ?>
                    <!-- start languages list table -->
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
								<th>Language</th>
								<th class="hidden-xs">Code</th>
								<th class="hidden-xs">Direction</th>
								<th class="hidden-sm hidden-xs">Status</th>
								<th>Action</th>
							</tr>
						</thead>
                        <!-- //end table head -->
                        
                        <!-- start table body -->
						<tbody>
							<?php if(count($languages) > 0) {
								foreach ($languages as $key => $row) {
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
								<td><?php echo $row['language']; ?></td>
								<td class="hidden-xs"><?php echo $row['lang']; ?></td>
								<td class="hidden-xs"><?php echo $row['direction']; ?></td>
								<td class="hidden-sm hidden-xs">
									<a data-original-title="Select Status" data-url="<?php echo site_url("admin/settings/language_status_update"); ?>" data-value="<?php echo $row['status']; ?>" data-pk="<?php echo $alphaID; ?>" data-type="select" data-name="status" name="status" class="rstatusopt" href="#">
										<label class="label <?php echo $status_label; ?> pointer"><?php echo $status; ?></label>
									</a>
								</td>
								<td>
									<div class="btn-group">
									    <!-- edit button -->
										<a href="<?php echo site_url("admin/settings/languages/edit/{$alphaID}"); ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" data-title="Edit"><i class="fa fa-edit"></i></a>
										<!-- single delete button -->
										<button class="btn btn-danger btn-sm btnDel" data-url="<?php echo site_url("admin/settings/languages/delete"); ?>" id="<?php echo $alphaID; ?>" data-toggle="tooltip" data-placement="top" data-title="Delete"><i class="fa fa-trash"></i></button>
									</div>
								</td>
							</tr>
							<?php }
							} else echo '<tr><td colspan="6">'.admin_errors(3).'</td></tr>'; ?>
						</tbody>
                        <!-- //end table body -->

                        <!-- start table footer -->
						<tfoot>
							<tr>
								<td colspan="6">
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
					<!-- end languages list table -->
				<?php echo form_close(); ?>
				<!-- end bulk delete form -->
			</div>
		</div>
	</div>
	<!-- end languages list -->
	
    <!-- start language manage -->
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h4 class="panel-title martop5"><?php echo ucfirst($mode); ?> Language</h4>
				</div>
                <div class="pull-right">
                	<?php if($mode == 'edit') { ?>
                    <a class="btn btn-sm btn-default" data-container="body" data-toggle="tooltip" data-placement="top" href="<?php echo site_url("admin/settings/languages/manage"); ?>" data-title="Add New">Add</a>
                	<?php } ?>
                </div>
                <div class="clearfix"></div>
			</div>
			<div class="panel-body">
                <!-- open language manage form -->
                <?php
                    $attributes = array('method' => 'post', 'class' => "validate-form", 'id' => 'validate-language', 'name' => 'validate-language');
                    echo form_open("admin/settings/languages/{$mode}/{$language_id}", $attributes);
                ?>
					<div class="form_sep">
                        <?php
                            $attributes = array('class' => 'req');
                            echo form_label('Language', 'language', $attributes);

                            $input_data = array(
                                  'name'         => 'language',
                                  'id'           => 'language',
                                  'value'        => (isset($language_data['language'])) ? $language_data['language'] : set_value("language"),
                                  'type'         => 'text',
                                  'class'        => 'form-control',
                                  'data-required'=> 'true',
                                  'placeholder'  => 'Enter language',
                                );
                            echo form_input($input_data);
                        ?>
					</div>
					<div class="form_sep">
                        <?php
                            $attributes = array('class' => 'req');
                            echo form_label('Language Code', 'lang', $attributes);

                            $input_data = array(
                                  'name'         => 'lang',
                                  'id'           => 'lang',
                                  'value'        => (isset($language_data['lang'])) ? $language_data['lang'] : set_value("lang"),
                                  'type'         => 'text',
                                  'class'        => 'form-control',
                                  'data-required'=> 'true',
                                  'placeholder'  => 'Enter language code',
                                );
                            echo form_input($input_data);
                        ?>
					</div>
					<div class="form_sep">
						<div class="row">
							<div class="col-md-6">
								<label for="direction" class="req">Direction</label>
								<select name="direction" id="direction" class="select2">
									<option value="ltr" <?php if(isset($language_data['direction']) && $language_data['direction'] == 'ltr') echo 'selected'; ?>>LTR</option>
									<option value="rtl" <?php if(isset($language_data['direction']) && $language_data['direction'] == 'rtl') echo 'selected'; ?>>RTL</option>
								</select>
							</div>
							<div class="col-md-6">
								<label for="status" class="req">Status</label>
								<select name="status" id="status" class="select2" data-required="true">
									<option value="1" <?php if(isset($language_data['status']) && $language_data['status'] == '1') echo 'selected'; elseif(set_value("status") == '1') echo 'selected'; ?>>Enabled</option>
									<option value="0" <?php if(isset($language_data['status']) && $language_data['status'] == '0') echo 'selected'; elseif(set_value("status") == '0') echo 'selected'; ?>>Disabled</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form_sep">
                        <?php
                            //form submit button
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
                <!-- end language manage form -->
			</div>
		</div>
	</div>
    <!-- end language manage -->
</div>