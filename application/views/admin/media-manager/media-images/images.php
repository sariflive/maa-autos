<!-- start media images search -->
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
                    echo form_open('admin/media_images/manage/search', $attributes);
                ?>
					<div class="form_sep">
						<div class="row">
							<div class="col-md-4">
								<?php $search_type = $this->input->get("type"); ?>
								<label for="question">Type</label>
								<select name="type" id="search_type" class="select2">
									<option value="">--SELECT--</option>
									<?php 
										$types = get_enum_values('media', 'type');
										foreach ($types as $key => $value) {
											if($value) {
												$selected_type = ($value == $search_type) ? ' selected' : '';
												echo "<option value=\"{$value}\"{$selected_type}>{$value}</option>";
											}
										}
									?>
								</select>
							</div>
							<div class="col-md-4 text-center">
								<br />
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
						</div>
					</div>
                <?php echo form_close(); ?>
                <!-- end search form -->
			</div>
		</div>
	</div>
</div>
<!-- //end media images search -->

<div class="row">
    <!-- start media images list -->
	<div class="col-md-8 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h4 class="panel-title martop5">Media Images</h4>
				</div>
                <div class="pull-right">
                	<?php if($mode == 'edit') { ?>
                	<a class="btn btn-sm btn-default" data-container="body" data-toggle="tooltip" data-placement="top" href="<?php echo site_url("admin/media_images/manage"); ?>" data-title="Add New">Add New</a>
                	<?php } ?>
                </div>
                <div class="clearfix"></div>
			</div>
			<div class="panel-body">
                <!-- open bulk delete form -->
                <?php
                    $attributes = array('method' => 'post', 'id'=>'frmBulkDel');
                    echo form_open('admin/media_images/manage/bulk_delete', $attributes);
                ?>
                    <!-- start media images list table -->
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
								<th></th>
								<th data-hide="phone">Type</th>
								<th data-hide="phone" valign="top">File Link (Copy)</th>
								<th data-hide="phone">Action</th>
							</tr>
						</thead>
                        <!-- //end table head -->
                        
                        <!-- start table body -->
						<tbody>
							<?php
							$i = 0;
							if(count($media_images) > 0) {
								foreach ($media_images as $key => $row) {
									$alphaID = alphaID($row['ID']);
									$status = ($row['status'] == '1') ? "Enbled" : 'Disabled';
									$status_label = ($row['status'] == '1') ? "label-success" : 'label-danger';

									$media_image = (file_exists("{$row['url']}")) ? base_url() . "{$row['url']}" : base_url() ."images/no-image/no_img_180.png"; 
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
								<td>
									<img class="img-bordered-default height60 width80 thumbnail" src="<?php echo $media_image; ?>" />
								</td>
								<td><?php echo $row['type']; ?></td>
								<td><textarea class="form-control autosize_textarea imglink" cols="30" rows="3"><?php echo $media_image; ?></textarea></td>
								<td>
									<div class="btn-group">
									    <!-- edit button -->
										<a href="<?php echo site_url("admin/media_images/manage/edit/{$alphaID}"); ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" data-title="Edit"><i class="fa fa-edit"></i></a>
										<!-- single delete button -->
										<button class="btn btn-danger btn-sm btnDel" data-url="<?php echo site_url("admin/media_images/manage/delete"); ?>" id="<?php echo $alphaID; ?>" data-toggle="tooltip" data-placement="top" data-title="Delete"><i class="fa fa-trash"></i></button>
									</div>
								</td>
							</tr>
							<?php
							$i++;
								}
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
                    <!-- end media images list table -->
                <?php echo form_close(); ?>
                <!-- end bulk delete form -->
			</div>
		</div>
	</div>
    <!-- end media images list -->
	
	<!-- start media image manage -->
	<div class="col-md-4 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h4 class="panel-title martop5"><?php echo ucfirst($mode); ?> Media Images</h4>
				</div>
                <div class="pull-right">
                	<?php if($mode == 'edit') { ?>
                    <a class="btn btn-sm btn-default" data-container="body" data-toggle="tooltip" data-placement="top" href="<?php echo site_url("admin/media_images/manage"); ?>" data-title="Add New">Add New</a>
                	<?php } ?>
                </div>
                <div class="clearfix"></div>
			</div>
			<div class="panel-body">
                <!-- open media image manage form -->
                <?php
                    $attributes = array('method' => 'post', 'class' => "validate-form", 'id' => 'validate-media', 'name' => 'validate-media');
                    echo form_open_multipart("admin/media_images/manage/{$mode}/{$media_id}", $attributes);
                ?>
					<div class="form_sep">
                        <?php
                           $attributes = array('class' => 'req');
                           echo form_label('Title', 'title', $attributes);
                         ?>
                        <?php
                            $input_data = array(
                                  'name'         => 'title',
                                  'id'           => 'title',
                                  'value'        => (isset($media_data['title'])) ? $media_data['title'] : set_value("title"),
                                  'type'         => 'text',
                                  'class'        => 'form-control',
                                  'data-required'=> 'true',
                                  'placeholder'  => 'Enter title',
                                );
                            echo form_input($input_data);
                        ?>
					</div>
					<div class="form_sep">
						<?php $type = (isset($media_data['type'])) ? $media_data['type'] : ''; ?>
                        <?php
                           $attributes = array('class' => 'req');
                           echo form_label('Type', 'type', $attributes);
                         ?>
						<select name="type" id="type" class="select2">
							<?php 
								$types = get_enum_values('media', 'type');
								foreach ($types as $key => $value) {
									if($value) {
										$selected_type = ($value == $type) ? ' selected' : '';
										echo "<option value=\"{$value}\"{$selected_type}>{$value}</option>";
									}
								}
							?>
						</select>
					</div>
					
					<?php $media_image = (isset($media_data['url']) && file_exists("{$media_data['url']}")) ? base_url() . "{$media_data['url']}" : base_url() ."images/no-image/no_img_180.png"; ?>
					<div class="form_sep">
	                    <div class="fileinput fileinput-new" data-provides="fileinput">
	                        <div class="fileinput-new thumbnail height150 width200">
	                            <img src="<?php echo $media_image; ?>" alt="Profile Image">
	                        </div>
	                        <div class="fileinput-preview fileinput-exists thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
	                        <div>
	                            <span class="btn btn-default btn-file">
	                            	<span class="fileinput-new">Select image</span>
	                            	<span class="fileinput-exists">Change</span>
                                    <?php
                                        $input_data = array(
                                                'name'         => 'userfile',
                                                'id'           => 'userfile',
                                                'value'        => '',
                                                'type'         => 'file',
                                            );
                                        echo form_input($input_data);
                                    ?>
	                            </span>
	                            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
	                        </div>
	                    </div>
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
                <!-- //end media image manage form -->
			</div>
		</div>
	</div>
	<!-- //end media image manage -->
</div>