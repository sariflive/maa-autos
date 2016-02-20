<!-- start blog comments search -->
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
			        echo form_open('admin/blogs/commentslist', $attributes);
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
								<?php $search_title = $this->input->get("title"); ?>
								<?php echo form_label('Title', 'title'); ?>
                                <?php
                                    $input_data = array(
                                          'name'        => 'title',
                                          'id'          => 'search_title',
                                          'value'       => $search_title,
                                          'type'        => 'text',
                                          'class'       => 'form-control',
                                          'placeholder' => 'Title',
                                        );
                                    echo form_input($input_data);
                                ?>
							</div>
							<div class="col-md-3">
								<?php $search_date = $this->input->get("date"); ?>
								<?php echo form_label('Date', 'date'); ?>
                                <?php
                                    $input_data = array(
                                          'name'            => 'date',
                                          'id'              => 'search_date',
                                          'value'           => $search_date,
                                          'type'            => 'text',
                                          'class'           => 'form-control datepicker',
                                          'placeholder'     => 'Date',
                                          'data-date-format'=> 'yyyy-mm-dd',
                                        );
                                    echo form_input($input_data);
                                ?>
							</div>
							<div class="col-md-3">
								<?php $search_status = $this->input->get("status"); ?>
								<?php echo form_label('Status', 'status'); ?>
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
				<!-- close form-->
			</div>
		</div>
	</div>
</div>
<!-- end blog comments search -->

<!-- start blog comments list -->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h4 class="panel-title martop5">Blog Comments</h4>
				</div>
                <div class="pull-right">
                	<a class="btn btn-sm btn-default" data-container="body" data-toggle="tooltip" data-placement="top" href="<?php echo site_url("admin/blogs/comment"); ?>" data-title="Add New">Add New</a>
                </div>
                <div class="clearfix"></div>
			</div>
			<div class="panel-body">
			    <!-- open bulk delete form -->
                <?php
                    $attributes = array('method' => 'post', 'id'=>'frmBulkDel');
                    echo form_open('admin/blogs/comment/bulk_delete', $attributes);
                ?>
                    <!-- start blog comments list table -->
					<table class="table table-vam table-striped table-bordered FooTableOddd" id="dt_gal">
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
								<th>Date</th>
								<th data-hide="phone">Name</th>
								<th data-hide="phone">E-mail</th>
								<th data-hide="phone,tablet">Blog</th>
								<th data-hide="phone,tablet">Comments</th>
								<th>Status</th>
								<th data-hide="phone,tablet">Action</th>
							</tr>
						</thead>
						<!-- end table head -->
						
						<!-- start table body -->
						<tbody>
							<?php if(count($comments) > 0) {
								foreach ($comments as $key => $row) {
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
								<td><?php echo date('dS F, Y', strtotime($row['date'])); ?></td>
								<td><?php echo $row['name']; ?></td>
								<td><?php echo $row['email']; ?></td>
								<td><?php echo $row['title']; ?></td>
								<td><?php echo substr(nl2br($row['comment']),0,120); ?></td>
								<td>
									<a data-original-title="Select Status" data-value="<?php echo $row['status']; ?>" data-pk="<?php echo $alphaID; ?>" data-url="<?php echo site_url("admin/blogs/comment_status_update"); ?>" data-type="select" data-name="status" name="status" class="rstatusopt" href="#">
										<label class="label <?php echo $status_label; ?> pointer"><?php echo $status; ?></label>
									</a>
								</td>
								<td>
									<div class="btn-group">
									     <!-- edit button -->
										<a href="<?php echo site_url("admin/blogs/comment/edit/{$alphaID}"); ?>" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" data-title="Edit"><i class="fa fa-edit"></i></a>
										<!-- single delete button -->
										<button class="btn btn-danger btn-xs btnDel" data-url="<?php echo site_url("admin/blogs/comment/delete"); ?>" id="<?php echo $alphaID; ?>" data-toggle="tooltip" data-placement="top" data-title="Delete"><i class="fa fa-trash"></i></button>
									</div>
								</td>
							</tr>
							<?php }
							} else echo '<tr><td colspan="8">'.admin_errors(3).'</td></tr>'; ?>
						</tbody>
						<!-- end table body -->

                        <!-- start table foot -->
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
                                        ?>
									</div>
									<!-- pagination -->
									<div class="pull-right"><?php echo $pagination; ?></div>
								</td>
							</tr>
						</tfoot>
						<!-- end table foot -->
					</table>
					<!-- end blog comments list table -->
				<?php echo form_close(); ?>
				<!-- close bulk delete form -->
			</div>
		</div>
	</div>
</div>
<!-- end blog comments list -->