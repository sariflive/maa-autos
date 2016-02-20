<!-- start blog manage -->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h4 class="panel-title martop5"><?php echo ucfirst($mode); ?> Blog</h4>
				</div>
                <div class="pull-right">
                	<?php if($mode == 'edit') { ?>
                    <a class="btn btn-sm btn-default" data-container="body" data-toggle="tooltip" data-placement="top" href="<?php echo site_url("admin/blogs/manage"); ?>" data-title="Add New">Add New</a>
                	<?php } ?>
                </div>
                <div class="clearfix"></div>
			</div>
			<div class="panel-body">
                <!-- open blog manage form -->
                <?php
                    $attributes = array('method' => 'post', 'class' => "validate-form", 'id' => 'validate-blog', 'name' => 'validate-blog');
                    echo form_open_multipart("admin/blogs/manage/{$mode}/{$blog_id}", $attributes);
                ?>
					<div class="form_sep">
						<div class="row">
							<div class="col-md-8">
                                <?php
                                    $attributes = array('class' => 'req');
                                    echo form_label('Title', 'title', $attributes);
        
                                    $input_data = array(
                                          'name'         => 'title',
                                          'id'           => 'title',
                                          'value'        => (isset($blog_data['title'])) ? $blog_data['title'] : set_value("title"),
                                          'type'         => 'text',
                                          'class'        => 'form-control',
                                          'data-required'=> 'true',
                                          'placeholder'  => 'Enter title',
                                          'data-url'     => site_url("admin/blogs/url"),
                                        );
                                    echo form_input($input_data);
                                ?>
							</div>
							<div class="col-md-4">
                                <?php
                                    $attributes = array('class' => 'req');
                                    echo form_label('Tags', 'tags', $attributes);
        
                                    $input_data = array(
                                          'name'         => 'tags',
                                          'id'           => 'tags',
                                          'value'        => (isset($blog_data['tags'])) ? $blog_data['tags'] : set_value("tags"),
                                          'type'         => 'text',
                                          'class'        => 'form-control',
                                          'data-required'=> 'true',
                                          'placeholder'  => 'Enter tags',
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
                                    $attributes = array('class' => 'req');
                                    echo form_label('URL', 'url', $attributes);
        
                                    $input_data = array(
                                          'name'         => 'url',
                                          'id'           => 'cur_url',
                                          'value'        => (isset($blog_data['url'])) ? $blog_data['url'] : set_value("url"),
                                          'type'         => 'text',
                                          'class'        => 'form-control',
                                          'data-required'=> 'true',
                                          'placeholder'  => 'Enter url',
                                        );
                                    echo form_input($input_data);
                                ?>
							</div>
							<div class="col-md-4">
                                <?php
                                    $attributes = array('class' => 'req');
                                    echo form_label('Date', 'date', $attributes);
        
                                    $input_data = array(
                                          'name'            => 'date',
                                          'id'              => 'date',
                                          'value'           => (isset($blog_data['date'])) ? $blog_data['date'] : set_value("date"),
                                          'type'            => 'text',
                                          'class'           => 'form-control datepicker',
                                          'placeholder'     => 'Date',
                                          'data-date-format'=> 'yyyy-mm-dd',
                                        );
                                    echo form_input($input_data);
                                ?>
							</div>
							<div class="col-md-4">
								<label for="status" class="req">Status</label>
								<select name="status" id="status" class="select2">
									<option value="1" <?php if(isset($blog_data['status']) && $blog_data['status'] == '1') echo 'selected'; elseif(set_value("status") == '1') echo 'selected'; ?>>Enabled</option>
									<option value="0" <?php if(isset($blog_data['status']) && $blog_data['status'] == '0') echo 'selected'; elseif(set_value("status") == '0') echo 'selected'; ?>>Disabled</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form_sep">
					    <div class="panel panel-default">
							<div class="panel-heading">Details</div>
					        <div class="panel-body">
			    				<textarea id="details" name="details"><?php if(isset($blog_data['details'])) echo $blog_data['details']; else echo set_value('details');?></textarea>
			    			</div>
					    </div>
					</div>
					<?php
						$blog_image = (isset($blog_data['image']) && !empty($blog_data['image']) && file_exists("./images/blog/{$blog_data['image']}")) ? base_url()."images/blog/{$blog_data['image']}" : base_url()."images/no-image/no_img_180.png";
					?>			
					<div class="form_sep">
	                    <div class="fileinput fileinput-new" data-provides="fileinput">
	                        <div class="fileinput-new thumbnail height150 width200">
	                            <img src="<?php echo $blog_image; ?>" alt="News Image">
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
                <!-- end blog manage form -->
			</div>
		</div>
	</div>
</div>
<!-- //end blog manage -->