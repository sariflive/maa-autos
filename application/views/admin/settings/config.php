<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h4 class="panel-title martop5">Configaration</h4>
				</div>
                <div class="pull-right">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal" data-title="Add New">Add Config</button>
                </div>
                <div class="clearfix"></div>		
			</div>
			<div class="panel-body">
				<div class="panel panel-tab rounded shadow">
				    <div class="panel-heading no-padding">
				        <ul class="nav nav-tabs">
							<?php
							$i = 1;
							if(count($configs) > 0) {
				        		foreach ($configs as $row) {
				        			if(!empty($row)) {
				        			$active = ($i == 1) ? ' class="active"' : '';
				        	?>
				            <li<?php echo $active; ?>>
				                <a href="#tab1-<?php echo $i; ?>" data-toggle="tab">
				                    <i class="fa fa-check-circle"></i>
				                    <span><?php echo $row; ?></span>
				                </a>
				            </li>
				           	<?php
				           		$i++;
									}
								}
							} ?>
				        </ul>
				    </div>
				
				    <div class="panel-body">
				        <div class="tab-content">
				        	<?php
				        	$ii = 1;
				        	if(count($configs) > 0) {
				        		foreach ($configs as $group) {
				        			if(!empty($group)) {
									$active = ($ii == 1) ? ' in active' : '';
									$group_details = get_rows(array('group'=>$group), array('TABLE'=>'config', 'LIMIT'=>1000));
				        	?>
				            <div class="tab-pane fade<?php echo $active; ?>" id="tab1-<?php echo $ii; ?>">
								<table id="user" class="table table-bordered table-striped" style="clear: both">
									<tbody>
										<?php
				                    	if(count($group_details) > 0) {
				                        	foreach ($group_details as $config) {
				                        		$alphaID = alphaID($config['ID']);
				                        ?>	                            	
										<tr id="<?php echo $alphaID; ?>">
											<td style="width:35%;"><?php echo ucwords(str_replace('_',' ',$config['option'])); ?></td>
											<td style="width:65%">
													<?php if($config['write'] == 1) { ?>
													<a href="#" data-url="<?php echo site_url("admin/settings/config_ajax_update"); ?>" class="edVal" id="value" data-type="text" data-pk="<?php echo $alphaID; ?>" data-original-title="Enter Value" name="value">
													<?php } ?>	
													<?php echo $config['value']; ?>
													<?php if($config['write'] == 1) { ?>
													</a >
				                            		<?php } ?>	
												</a>
											</td>
				
											<td>
												<?php if($config['delete'] == 1) { ?>
													<button class="btn btn-danger btn-sm btnDel" data-url="<?php echo site_url("admin/settings/config_delete"); ?>" id="<?php echo $alphaID; ?>" data-toggle="tooltip" data-placement="top" data-title="Delete"><span class="fa fa-trash-o"></span></button>	
												<?php } else echo 'N/A'; ?>											
											</td>
											 								
										</tr>
										<?php 
												} 
										}
										else echo "<tr><td colspan=\"4\">No Result Found</td></tr>";
										?>
									</tbody>
								</table>
				            </div>
				            <?php
				            $ii++;
				            }
								}
							} ?>
				        </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- config manage modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">Add Configuration</h4>
			</div>
            <!-- open config manage form -->
            <?php
                $attributes = array('method' => 'post', 'class' => "validate-form", 'id' => 'Configuration-Form', 'name' => 'Configuration-Form');
                echo form_open("admin/settings/config_manage", $attributes);
            ?>
    			<div class="modal-body">
    				<div class="row">
    					<div class="col-md-12">
    						<div class="form-group">
    							<label for="group"> Group</label>
    							<select class="select2" id="group" name="group">
    								<?php if(count($configs) > 0) {
    									foreach ($configs as $key => $row) {
    										if(!empty($row) && $row != 'System') {
    								?>
    								<option value="<?php echo $row; ?>"><?php echo $row; ?></option>
    		           				<?php }
    									}
    								} ?>
    							</select>
    						</div>
    					</div>
    				</div>
    				<div class="row">
    					<div class="col-md-12">
    						<div class="form-group">
                                <?php
                                   $attributes = array('class' => 'req');
                                   echo form_label('Option', 'option', $attributes);
                                 ?>
                                <?php
                                    $input_data = array(
                                          'name'         => 'option',
                                          'id'           => 'option',
                                          'value'        => '',
                                          'type'         => 'text',
                                          'class'        => 'form-control',
                                          'data-required'=> 'true',
                                          'placeholder'  => 'Enter option',
                                        );
                                    echo form_input($input_data);
                                ?>
    						</div>
    					</div>
    				</div>
    				<div class="row">
    					<div class="col-md-12">
    						<div class="form-group">
                                <?php
                                   $attributes = array('class' => 'req');
                                   echo form_label('Value', 'value', $attributes);
                                 ?>
                                <?php
                                    $input_data = array(
                                          'name'         => 'value',
                                          'id'           => 'value',
                                          'value'        => '',
                                          'type'         => 'text',
                                          'class'        => 'form-control',
                                          'data-required'=> 'true',
                                          'placeholder'  => 'Enter value',
                                        );
                                    echo form_input($input_data);
                                ?>
    						</div>
    					</div>
    				</div>
    			</div>
    			<div class="modal-footer">
    				<div id="post_response" class="text-left"></div>
    				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
            <!-- end config manage form -->
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->