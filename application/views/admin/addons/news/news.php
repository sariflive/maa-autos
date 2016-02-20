<!-- start news search -->
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
                    echo form_open('admin/news/manage/search', $attributes);
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
                                    unset($input_data);
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
                                    unset($input_data);
                                ?>
							</div>
							<div class="col-md-3">
								<?php
									$search_group = $this->input->get("group");
									$selected_group = ($search_group) ? $search_group : '';
									$groups = options(array(), array('TABLE'=>'user_groups', 'LIMIT'=>'1000', 'ORDER_BY'=>'group', 'ORDER_TYPE'=>'asc', 'OPTION'=>'group', 'DEFAULT'=>$selected_group));
								?>
								<?php echo form_label('Group', 'group'); ?>
								<select name="group" id="search_group" class="select2">
									<option value="">--SELECT--</option>
									<?php echo $groups['option_list']; ?>
								</select>
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
                           unset($button_data);
                        ?>
					</div>
                <?php echo form_close(); ?>
                <!-- end search form -->
			</div>
		</div>
	</div>
</div>
<!-- end news search -->

<!-- start news list -->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h4 class="panel-title martop5">News List </h4>
				</div>
				<div class="pull-right">
					<a class="btn btn-sm btn-default" href="<?php echo site_url("admin/news/manage"); ?>" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Add New">Add New</a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
                <!-- open bulk delete form -->
                <?php
                    $attributes = array('method' => 'post', 'id'=>'frmBulkDel');
                    echo form_open('admin/news/manage/bulk_delete', $attributes);
                ?>
                    <!-- start news list table -->
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
								<th class="hidden-xs"></th>
								<th width="25%">Title</th>
								<th width="20%" data-hide="phone">URL</th>
								<th data-hide="phone,tablet">Tags</th>
								<th data-hide="phone,tablet">Publish Date</th>
								<th>Status</th>
								<th data-hide="phone,tablet">Action</th>
							</tr>
						</thead>
						<!-- end table head -->

						<!-- start table body -->
						<tbody>
							<?php if(count($news) > 0) {
								foreach ($news as $key => $row) {
									$alphaID = alphaID($row['ID']);
									$status = ($row['status'] == '1') ? "Enbled" : 'Disabled';
									$status_label = ($row['status'] == '1') ? "label-success" : 'label-danger';
									$news_image = (!empty($row['image']) && file_exists("./images/news/{$row['image']}")) ? base_url()."images/news/{$row['image']}" : base_url()."images/no-image/no_img_180.png";
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
								<td class="hidden-xs">
									<img class="img-bordered-default height80 thumbnail hidden-xs" src="<?php echo $news_image; ?>" alt="<?php echo $row['title']; ?>" title="<?php echo $row['title']; ?>" />
								</td>
								<td><?php echo $row['title']; ?></td>
								<td>
									<a target="_blank" href="<?php echo site_url("news/{$row['url']}"); ?>">
										<?php echo $row['url']; ?>
									</a>
								</td>
								<td><?php echo $row['tags']; ?></td>
								<td><?php echo date('dS F, Y', strtotime($row['publish_date'])); ?></td>
								<td>
									<a data-original-title="Select Status" data-url="<?php echo site_url("admin/news/status_update"); ?>" data-value="<?php echo $row['status']; ?>" data-pk="<?php echo $alphaID; ?>" data-type="select" data-name="status" name="status" class="rstatusopt" href="#">
										<label class="label <?php echo $status_label; ?> pointer"><?php echo $status; ?></label>
									</a>
								</td>
								<td>
									<div class="btn-group">
									    <!-- edit button -->
										<a href="<?php echo site_url("admin/news/manage/edit/{$alphaID}"); ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" data-title="Edit News"><i class="fa fa-edit"></i></a>
										<!-- single delete button -->
										<button class="btn btn-danger btn-sm btnDel" data-url="<?php echo site_url("admin/news/manage/delete"); ?>" id="<?php echo $alphaID; ?>" data-toggle="tooltip" data-placement="top" data-title="Delete"><i class="fa fa-trash"></i></button>
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
						<!-- //end table footer -->
					</table>
					<!-- end news list table -->
				</form>
			</div>
		</div>
	</div>	
</div>
<!-- start news list -->