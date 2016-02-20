<!-- start showroom search -->
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
                    echo form_open('admin/showrooms/showroomslist', $attributes);
                ?>
					<div class="form_sep">
						<div class="row">
							<div class="col-md-3">
                            <?php
                                $search_dealership_name = $this->input->get("dealership_name");
                                echo form_label('Dealership Name', 'dealership_name');

                                $input_data = array(
                                      'name'        => 'dealership_name',
                                      'id'          => 'search_dealership_name',
                                      'value'       => $search_dealership_name,
                                      'type'        => 'text',
                                      'class'       => 'form-control',
                                      'placeholder' => 'Dealership Name',
                                    );
                                echo form_input($input_data);
                            ?>
							</div>
							<div class="col-md-3">
                            <?php
                                $search_email = $this->input->get("email");
                                echo form_label('E-mail', 'email');

                                $input_data = array(
                                      'name'        => 'email',
                                      'id'          => 'search_email',
                                      'value'       => $search_email,
                                      'type'        => 'text',
                                      'class'       => 'form-control',
                                      'placeholder' => 'E-mail',
                                    );
                                echo form_input($input_data);
                            ?>
							</div>
							<div class="col-md-3">
                            <?php
                                $search_address = $this->input->get("address");
                                echo form_label('Address', 'address');

                                $input_data = array(
                                      'name'        => 'address',
                                      'id'          => 'search_address',
                                      'value'       => $search_address,
                                      'type'        => 'text',
                                      'class'       => 'form-control',
                                      'placeholder' => 'Address',
                                    );
                                echo form_input($input_data);
                            ?>
							</div>
							<div class="col-md-3">
                            <?php
                                $search_city = $this->input->get("city");
                                echo form_label('City', 'city');

                                $input_data = array(
                                      'name'        => 'city',
                                      'id'          => 'search_city',
                                      'value'       => $search_city,
                                      'type'        => 'text',
                                      'class'       => 'form-control',
                                      'placeholder' => 'City',
                                    );
                                echo form_input($input_data);
                            ?>
							</div>
						</div>
					</div>
					<div class="form_sep">
						<div class="row">
							<div class="col-md-3">
                            <?php
                                $search_state = $this->input->get("state");
                                echo form_label('State', 'state');

                                $input_data = array(
                                      'name'        => 'state',
                                      'id'          => 'search_state',
                                      'value'       => $search_state,
                                      'type'        => 'text',
                                      'class'       => 'form-control',
                                      'placeholder' => 'State',
                                    );
                                echo form_input($input_data);
                            ?>
							</div>
							<div class="col-md-3">
                            <?php
                                $search_zipcode = $this->input->get("zipcode");
                                echo form_label('Zip Code', 'zipcode');

                                $input_data = array(
                                      'name'        => 'zipcode',
                                      'id'          => 'search_zipcode',
                                      'value'       => $search_zipcode,
                                      'type'        => 'text',
                                      'class'       => 'form-control',
                                      'placeholder' => 'Zip Code',
                                    );
                                echo form_input($input_data);
                            ?>
							</div>
							<div class="col-md-3">
								<?php $search_country = $this->input->get("country"); ?>
								<label for="country">Country</label>
								<select name="country" id="search_country" class="select2">
									<option value="">--SELECT--</option>
									<?php $options = options(array(), array('TABLE'=>'countries', 'LIMIT'=>1000, 'OPTION_VALUE'=>'ID', 'OPTION'=>'name', 'DEFAULT'=>$search_country, 'ORDER_BY'=>'name', 'ORDER_TYPE'=>'asc')); echo $options['option_list']; ?>
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
                        ?>
					</div>
                 <?php echo form_close(); ?>
                <!-- end showroom manage form -->
			</div>
		</div>
	</div>
</div>
<!-- end showroom search -->

<!-- start showrooms list -->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h4 class="panel-title martop5">Showrooms List</h4>
				</div>
                <div class="pull-right">
                	<a class="btn btn-sm btn-default" data-container="body" data-toggle="tooltip" data-placement="top" href="<?php echo site_url("admin/showrooms/manage"); ?>" data-title="Add New Rule">Add New</a>
                </div>
                <div class="clearfix"></div>
			</div>
			<div class="panel-body">
                <!-- open bulk delete form -->
                <?php
                    $attributes = array('method' => 'post', 'id'=>'frmBulkDel');
                    echo form_open('admin/showrooms/manage/bulk_delete', $attributes);
                ?>
                    <!-- start showroom list table -->
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
								<th>Dealership Name</th>
								<th data-hide="phone,tablet">Address</th>
								<th data-hide="phone">Contact</th>
								<th>Status</th>
								<th data-hide="phone,tablet">Action</th>
							</tr>
						</thead>
                        <!-- //end table head -->
                        
                        <!-- start table body -->
						<tbody>
							<?php if(count($showrooms) > 0) {
								foreach ($showrooms as $key => $row) {
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
								<td><?php echo $row['dealership_name']; ?></td>
								<td>
									<?php echo $row['address'].', '.$row['city'].' - '.$row['zipcode']; ?>
									<br />
									<?php if(!empty($row['state'])) echo $row['state'].', '; echo $row['country_name']; ?>
								</td>
								<td>
									<?php echo $row['email'].'<br />'.$row['phone']; ?>
								</td>
								<td>
									<a data-original-title="Select Status" data-href="<?php echo site_url("admin/showrooms/status_update"); ?>" data-value="<?php echo $row['status']; ?>" data-pk="<?php echo $alphaID; ?>" data-type="select" data-name="status" name="status" class="rstatusopt" href="#">
										<label class="label <?php echo $status_label; ?> pointer"><?php echo $status; ?></label>
									</a>
								</td>
								<td>
									<div class="btn-group">
									    <!-- edit button -->
										<a href="<?php echo site_url("admin/showrooms/manage/edit/{$alphaID}"); ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" data-title="Edit"><i class="fa fa-edit"></i></a>
										<!-- single delete button -->
										<button class="btn btn-danger btn-sm btnDel" data-href="<?php echo site_url("admin/showrooms/manage/delete"); ?>" id="<?php echo $alphaID; ?>" data-toggle="tooltip" data-placement="top" data-title="Delete"><i class="fa fa-trash"></i></button>
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
										<input type="submit" class="btn btn-inverse btn-sm delete_rows_dt" data-tableid="dt_gal" value="Delete Selected" />
									</div>
									<div class="pull-right"><?php echo $pagination; ?></div>
								</td>
							</tr>
						</tfoot>
                        <!-- end table footer -->
					</table>
                    <!-- end showroom list table -->
                <?php echo form_close(); ?>
                <!-- end bulk delete form -->
			</div>
		</div>
	</div>
</div>
<!-- end showrooms list -->