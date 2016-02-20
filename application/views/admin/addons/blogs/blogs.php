<!-- start blog search -->
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
                    echo form_open('admin/blogs/blogslist', $attributes);
                ?>
					<div class="form_sep">
						<div class="row">
							<div class="col-md-3">
								<?php echo form_label('Name', 'name'); ?>
								<select name="name" id="search_name" class="select2">
									<option value="">--SELECT--</option>
									<?php
										$search_user = $this->input->get("name");
										$selected_user = ($search_user) ? $search_user : '';
										$users = users(array(), $selected_user); echo $users['user_list'];
									?>
								</select>
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
				<!-- //end search form -->
			</div>
		</div>
	</div>
</div>
<!-- //end blog search -->

<!-- start blogs list -->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h4 class="panel-title martop5">Blogs List </h4>
				</div>
				<div class="pull-right">
                    <a class="btn btn-sm btn-default" href="<?php echo site_url("admin/blogs/manage"); ?>" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Add New">Add New</a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
                <!-- open bulk delete form -->
                <?php
                    $attributes = array('method' => 'post', 'id'=>'frmBulkDel');
                    echo form_open('admin/blogs/manage/bulk_delete', $attributes);
                ?>
                    <!-- start blogs list table -->
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
								<th></th>
								<th>Name</th>
								<th width="25%" data-hide="phone,tablet">Title</th>
								<th data-hide="phone">Date</th>
								<th data-hide="phone">Total Comment</th>
								<th>Status</th>
								<th data-hide="phone,tablet">Action</th>
							</tr>
						</thead>
                        <!-- //end table head -->
                        
                        <!-- start table body -->
						<tbody>
							<?php if(count($blogs) > 0) {
								foreach ($blogs as $key => $row) {
									$alphaID = alphaID($row['ID']);
									$status = ($row['status'] == '1') ? "Enbled" : 'Disabled';
									$status_label = ($row['status'] == '1') ? "label-success" : 'label-danger';
									$user_name = $row['firstName'].' '.$row['lastName'];
									
									$total_comments = row_counter(array('blogID'=>$row['ID']), array('TABLE'=>'blog_comments'));
									$blog_image = (!empty($row['image']) && file_exists("./images/blog/{$row['image']}")) ? base_url()."images/blog/{$row['image']}" : base_url()."images/no-image/no_img_180.png";
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
									<img class="img-bordered-default height80 thumbnail hidden-sm hidden-xs" src="<?php echo $blog_image; ?>" alt="<?php echo $row['title']; ?>" title="<?php echo $row['title']; ?>" />
								</td>
								<td><?php echo $user_name; ?></td>
								<td><?php echo $row['title']; ?></td>
								<td><?php echo date('dS F, Y', strtotime($row['date'])); ?></td>
								<td>
									<button type="button" class="btn btn-link blogComment" id="<?php echo $alphaID; ?>" title="View Comment" data-toggle="modal" data-target="#myModal">
										<?php echo $total_comments; ?> Comment
									</button>
								</td>
								<td>
									<a data-original-title="Select Status" data-url="<?php echo site_url("admin/blogs/status_update"); ?>" data-value="<?php echo $row['status']; ?>" data-pk="<?php echo $alphaID; ?>" data-type="select" data-name="status" name="status" class="rstatusopt" href="#">
										<label class="label <?php echo $status_label; ?> pointer"><?php echo $status; ?></label>
									</a>
								</td>
								<td>
									<div class="btn-group">
									    <!-- view button -->
										<a class="btn btn-info btn-sm" target="_blank" href="<?php echo site_url("blog/{$row['url']}"); ?>" data-toggle="tooltip" data-placement="top" data-title="View Blog"><i class="fa fa-eye"></i></a>
										<!-- edit button -->
										<a href="<?php echo site_url("admin/blogs/manage/edit/{$alphaID}"); ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" data-title="Edit"><i class="fa fa-edit"></i></a>
										<!-- single delete button -->
										<button class="btn btn-danger btn-sm btnDel" id="<?php echo $alphaID; ?>" data-toggle="tooltip" data-placement="top" data-title="Delete"><i class="fa fa-trash"></i></button>
									</div>
								</td>
							</tr>
							<?php } 
							} else echo '<tr><td colspan="9">'.admin_errors(3).'</td></tr>'; ?>
						</tbody>
                        <!-- //end table body -->

                        <!-- start table footer -->
						<tfoot>
							<tr>
								<td colspan="9">
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
                    <!-- //end blogs list table -->
				<?php echo form_close(); ?>
                <!-- //end bulk delete form -->
			</div>
		</div>
	</div>	
</div>
<!-- //end blogs list -->

<!-- start modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title" id="myModalLabel">Blog Comments</h4>
      		</div>
      		<div class="modal-body" id="blogComment">
      			
      		</div>
     		 <div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      		</div>
    	</div>
  	</div>
</div>
<!-- //end modal -->