<!-- start testimonial manage -->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h4 class="panel-title martop5"><?php echo ucfirst($mode); ?> News</h4>
				</div>
                <div class="pull-right">
                	<?php if($mode == 'edit') { ?>
                    <a class="btn btn-sm btn-default" data-container="body" data-toggle="tooltip" data-placement="top" href="<?php echo site_url("admin/testimonials/manage"); ?>" data-title="Add New">Add New</a>
                	<?php } ?>
                </div>
                <div class="clearfix"></div>
			</div>
			<div class="panel-body">
                <!-- open blog manage form -->
                <?php
                    $attributes = array('method' => 'post', 'class' => "validate-form", 'id' => 'validate-testimonial', 'name' => 'validate-testimonial');
                    echo form_open_multipart("admin/testimonials/manage/{$mode}/{$testimonial_id}", $attributes);
                ?>
				    <div class="form_sep">
					    <div class="row">
						    <div class="col-md-4">
                                <?php
                                    $attributes = array('class' => 'req');
                                    echo form_label('Name', 'name', $attributes);

                                    $input_data = array(
                                          'name'         => 'name',
                                          'id'           => 'name',
                                          'value'        => (isset($testimonial_data['name'])) ? $testimonial_data['name'] : set_value("name"),
                                          'type'         => 'text',
                                          'class'        => 'form-control',
                                          'data-required'=> 'true',
                                          'placeholder'  => 'Enter name',
                                        );
                                    echo form_input($input_data);
                                ?>
							</div>
						    <div class="col-md-4">
                                <?php
                                    $attributes = array('class' => 'req');
                                    echo form_label('Company Name', 'company_name', $attributes);

                                    $input_data = array(
                                          'name'         => 'company_name',
                                          'id'           => 'company_name',
                                          'value'        => (isset($testimonial_data['company_name'])) ? $testimonial_data['company_name'] : set_value("company_name"),
                                          'type'         => 'text',
                                          'class'        => 'form-control',
                                          'data-required'=> 'true',
                                          'placeholder'  => 'Enter company name',
                                        );
                                    echo form_input($input_data);
                                ?>
							</div>
						    <div class="col-md-4">
                                <?php
                                    $attributes = array('class' => 'req');
                                    echo form_label('Designation', 'designation', $attributes);

                                    $input_data = array(
                                          'name'         => 'designation',
                                          'id'           => 'designation',
                                          'value'        => (isset($testimonial_data['designation'])) ? $testimonial_data['designation'] : set_value("designation"),
                                          'type'         => 'text',
                                          'class'        => 'form-control',
                                          'data-required'=> 'true',
                                          'placeholder'  => 'Enter designation',
                                        );
                                    echo form_input($input_data);
                                ?>
						  </div>
					    </div>
				    </div>
				    <div class="form_sep">
					    <div class="row">
						    <div class="col-md-4">
                                <?php
                                    echo form_label('Phone', 'phone');

                                    $input_data = array(
                                          'name'         => 'phone',
                                          'id'           => 'phone',
                                          'value'        => (isset($testimonial_data['phone'])) ? $testimonial_data['phone'] : set_value("phone"),
                                          'type'         => 'text',
                                          'class'        => 'form-control',
                                          'placeholder'  => 'Enter phone',
                                        );
                                    echo form_input($input_data);
                                ?>
						    </div>
						    <div class="col-md-4">
                                <?php
                                    echo form_label('Mobile', 'mobile');

                                    $input_data = array(
                                          'name'         => 'mobile',
                                          'id'           => 'mobile',
                                          'value'        => (isset($testimonial_data['mobile'])) ? $testimonial_data['mobile'] : set_value("mobile"),
                                          'type'         => 'text',
                                          'class'        => 'form-control',
                                          'placeholder'  => 'Enter mobile',
                                        );
                                    echo form_input($input_data);
                                ?>
						    </div>
						    <div class="col-md-4">
                                <?php
                                    $attributes = array('class' => 'req');
                                    echo form_label('E-mail', 'email', $attributes);

                                    $input_data = array(
                                          'name'         => 'email',
                                          'id'           => 'email',
                                          'value'        => (isset($testimonial_data['email'])) ? $testimonial_data['email'] : set_value("email"),
                                          'type'         => 'email',
                                          'data-required'=> 'true',
                                          'data-type'    => 'email',
                                          'class'        => 'form-control',
                                          'placeholder'  => 'Enter mobile',
                                        );
                                    echo form_input($input_data);
                                ?>
						    </div>
					    </div>
				    </div>
					<div class="form_sep">
						<div class="row">
						    <div class="col-md-4">
                                <?php
                                    echo form_label('Web', 'web');

                                    $input_data = array(
                                          'name'         => 'web',
                                          'id'           => 'web',
                                          'value'        => (isset($testimonial_data['web'])) ? $testimonial_data['web'] : set_value("web"),
                                          'type'         => 'text',
                                          'class'        => 'form-control',
                                          'placeholder'  => 'Enter web',
                                        );
                                    echo form_input($input_data);
                                ?>
						    </div>
						    <div class="col-md-4">
                                <?php
                                    $attributes = array('class' => 'req');
                                    echo form_label('Publish Date', 'publish_date', $attributes);

                                    $input_data = array(
                                          'name'            => 'publish_date',
                                          'id'              => 'publish_date',
                                          'value'           => (isset($testimonial_data['publish_date'])) ? $testimonial_data['publish_date'] : set_value("publish_date"),
                                          'type'            => 'text',
                                          'class'           => 'form-control datepicker',
                                          'placeholder'     => 'Enter publish date',
                                          'data-date-format'=> 'yyyy-mm-dd',
                                        );
                                    echo form_input($input_data);
                                ?>
						    </div>
							<div class="col-md-4">
								<label for="status" class="req">Status</label>
								<select name="status" id="status" class="select2">
									<option value="1" <?php if(isset($testimonial_data['status']) && $testimonial_data['status'] == '1') echo 'selected'; elseif(set_value("status") == '1') echo 'selected'; ?>>Enabled</option>
									<option value="0" <?php if(isset($testimonial_data['status']) && $testimonial_data['status'] == '0') echo 'selected'; elseif(set_value("status") == '0') echo 'selected'; ?>>Disabled</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form_sep">
					    <div class="panel panel-default">
							<div class="panel-heading">Testimonial</div>
					        <div class="panel-body">
			    				<textarea id="testimonial" name="testimonial"><?php if(isset($testimonial_data['testimonial'])) echo $testimonial_data['testimonial']; else echo set_value('testimonial');?></textarea>
			    			</div>
					    </div>
					</div>
					<?php
						$tetimonial_image = (isset($testimonial_data['image']) && !empty($testimonial_data['image']) && file_exists("./uploads/media/testimonials/{$testimonial_data['image']}")) ? base_url()."uploads/media/testimonials/{$testimonial_data['image']}" : base_url()."images/no-image/no_img_180.png";
					?>
					<div class="form_sep">
	                    <div class="fileinput fileinput-new" data-provides="fileinput">
	                        <div class="fileinput-new thumbnail height150 width200">
	                            <img src="<?php echo $tetimonial_image; ?>" alt="Tetimonial Image">
	                        </div>
	                        <div class="fileinput-preview fileinput-exists thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
	                        <div>
	                            <span class="btn btn-primary btn-file">
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
                <!-- end testimonial manage form -->
			</div>
		</div>
	</div>
</div>
<!-- //end testimonial manage -->