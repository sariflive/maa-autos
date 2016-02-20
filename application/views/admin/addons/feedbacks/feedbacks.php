<!-- start feedback search -->
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
                    echo form_open('admin/feedbacks/manage/search', $attributes);
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
								<?php $search_subject = $this->input->get("subject"); ?>
                                <?php echo form_label('Subject', 'subject'); ?>
                                <?php
                                    $input_data = array(
                                          'name'        => 'subject',
                                          'id'          => 'search_subject',
                                          'value'       => $search_subject,
                                          'type'        => 'text',
                                          'class'       => 'form-control',
                                          'placeholder' => 'Subject',
                                        );
                                    echo form_input($input_data);
                                    unset($input_data);
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
<!-- end feedback search -->

<!-- start feedback list -->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">feedbacks List </h4>
			</div>
			<div class="panel-body">
			    <!-- open bulk delete form -->
                <?php
                    $attributes = array('method' => 'post', 'id'=>'frmBulkDel');
                    echo form_open('admin/feedbacks/manage/bulk_delete', $attributes);
                ?>
                    <!-- start feedback list table -->
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
								<th>Date</th>
								<th data-hide="phone">Name/E-mail</th>
								<th data-hide="phone,tablet">Subject</th>
								<th data-hide="phone,tablet">Action</th>
							</tr>
						</thead>
						<!-- //end table head -->
						
						<!-- start table body -->
						<tbody>
							<?php if(count($feedbacks) > 0) {
								foreach ($feedbacks as $key => $row) {
									$alphaID = alphaID($row['ID']);
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
								<td><?php echo date('dS F, Y', strtotime($row['date_timestamp'])); ?></td>
								<td><?php echo $row['name'].'<br /><a href="mailto:'.$row['email'].'">'.$row['email'].'</a>'; ?></td>
								<td><?php echo $row['subject']; ?></td>
								<td>
									<div class="btn-group">
									    <!-- view details button -->
										<a href="<?php echo site_url("admin/feedbacks/manage/view/{$alphaID}"); ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" data-title="View Feedback"><i class="fa fa-tasks"></i></a>
										<!-- reply button -->
										<a href="<?php echo site_url("admin/feedbacks/manage/reply/{$alphaID}"); ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" data-title="Reply Feedback"><i class="fa fa-mail-reply"></i></a>
										<!-- single delete button -->
										<button class="btn btn-danger btn-sm btnDel" data-url="<?php echo site_url("admin/feedbacks/manage/delete"); ?>" id="<?php echo $alphaID; ?>" data-toggle="tooltip" data-placement="top" data-title="Delete"><i class="fa fa-trash"></i></button>
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
<!-- end feedback list -->