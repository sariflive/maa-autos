<!-- start blog comment manage -->
<div class="row">
	<div class="col-md-8 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h4 class="panel-title martop5"><?php echo ucfirst($mode); ?> Comment</h4>
				</div>
                <div class="pull-right">
                	<?php if($mode == 'edit') { ?>
                    <a class="btn btn-sm btn-default" data-container="body" data-toggle="tooltip" data-placement="top" href="<?php echo site_url("admin/blogs/comment"); ?>" data-title="Add New">Add Comment</a>
                	<?php } ?>
                </div>
                <div class="clearfix"></div>
			</div>
			<div class="panel-body">
                <!-- open blog comment manage form -->
                <?php
                    $attributes = array('method' => 'post', 'class' => "validate-form", 'id' => 'validate-comment', 'name' => 'validate-comment');
                    echo form_open("admin/blogs/comment/{$mode}/{$comment_id}", $attributes);
                ?>
					<div class="form_sep">
						<?php $selected_blog = (isset($comment_data['blogID'])) ? $comment_data['blogID'] : ''; ?>
						<label for="title" class="req">Blog</label>
						<select name="blog" id="blog" class="select2">
							<?php $options = options(array(), array('TABLE'=>'blogs', 'LIMIT'=>1000, 'OPTION_VALUE'=>'ID', 'OPTION'=>'title', 'DEFAULT'=>$selected_blog, 'ORDER_BY'=>'title', 'ORDER_TYPE'=>'asc')); echo $options['option_list']; ?>
						</select>
					</div>
					<div class="form_sep">
						<div class="row">
							<div class="col-md-6">
                                <?php
                                    $attributes = array('class' => 'req');
                                    echo form_label('Name', 'name', $attributes);
        
                                    $input_data = array(
                                          'name'         => 'name',
                                          'id'           => 'name',
                                          'value'        => (isset($comment_data['name'])) ? $comment_data['name'] : set_value("name"),
                                          'type'         => 'text',
                                          'class'        => 'form-control',
                                          'data-required'=> 'true',
                                          'placeholder'  => 'Enter name',
                                        );
                                    echo form_input($input_data);
                                ?>
							</div>
							<div class="col-md-6">
                                <?php
                                    $attributes = array('class' => 'req');
                                    echo form_label('E-mail', 'email', $attributes);

                                    $input_data = array(
                                          'name'         => 'email',
                                          'id'           => 'email',
                                          'value'        => (isset($comment_data['email'])) ? $comment_data['email'] : set_value("email"),
                                          'type'         => 'text',
                                          'class'        => 'form-control',
                                          'data-required'=> 'true',
                                          'data-type'    => 'email',
                                          'placeholder'  => 'Enter email',
                                        );
                                    echo form_input($input_data);
                                ?>
							</div>
						</div>
					</div>
					<div class="form_sep">
						<div class="row">
							<div class="col-md-6">
                                <?php
                                    $attributes = array('class' => 'req');
                                    echo form_label('Web site', 'website', $attributes);
        
                                    $input_data = array(
                                          'name'         => 'website',
                                          'id'           => 'website',
                                          'value'        => (isset($comment_data['website'])) ? $comment_data['website'] : set_value("website"),
                                          'type'         => 'text',
                                          'class'        => 'form-control',
                                          'data-required'=> 'true',
                                          'placeholder'  => 'Enter website',
                                        );
                                    echo form_input($input_data);
                                ?>
							</div>
							<div class="col-md-6">
								<label for="status" class="req">Status</label>
								<select name="status" id="status" class="select2">
									<option value="1" <?php if(isset($comment_data['status']) && $comment_data['status'] == '1') echo 'selected'; elseif(set_value("status") == '1') echo 'selected'; ?>>Enabled</option>
									<option value="0" <?php if(isset($comment_data['status']) && $comment_data['status'] == '0') echo 'selected'; elseif(set_value("status") == '0') echo 'selected'; ?>>Disabled</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form_sep">
						<label for="comment" class="req">Comment</label>
						<textarea id="comment" name="comment" class="form-control" rows="5" data-required="true" placeholder="Enter comment"><?php if(isset($comment_data['comment'])) echo $comment_data['comment']; else echo set_value("comment"); ?></textarea>
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
                <!-- end blog comment manage form -->
			</div>
		</div>
	</div>
</div>
<!-- //end blog comment manage -->