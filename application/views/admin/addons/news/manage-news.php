<!-- start news manage -->
<div class="row">
	<div class="col-md-8 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="pull-left">
					<h4 class="panel-title martop5"><?php echo ucfirst($mode); ?> News</h4>
				</div>
                <div class="pull-right">
                	<?php if($mode == 'edit') { ?>
                    <a class="btn btn-sm btn-default" data-container="body" data-toggle="tooltip" data-placement="top" href="<?php echo site_url("admin/faqs/manage"); ?>" data-title="Add New">Add New</a>
                	<?php } ?>
                </div>
                <div class="clearfix"></div>
			</div>
			<div class="panel-body">
                <!-- open news manage form -->
                <?php
                    $attributes = array('method' => 'post', 'class' => "validate-form", 'id' => 'validate-news', 'name' => 'validate-news');
                    echo form_open_multipart("admin/news/manage/{$mode}/{$news_id}", $attributes);
                ?>
					<div class="form_sep">
                        <?php
                            $attributes = array('class' => 'req');
                            echo form_label('Title', 'title', $attributes);

                            $input_data = array(
                                  'name'         => 'title',
                                  'id'           => 'title',
                                  'value'        => (isset($news_data['title'])) ? $news_data['title'] : set_value("title"),
                                  'type'         => 'text',
                                  'class'        => 'form-control',
                                  'data-required'=> 'true',
                                  'placeholder'  => 'Enter title',
                                  'data-url'     => site_url("admin/news/url"),
                                );
                            echo form_input($input_data);
                        ?>
					</div>
					<div class="form_sep">
						<label for="meta_keyword" class="req">Meta Keyword</label>
						<textarea id="meta_keyword" name="meta_keyword" class="form-control" data-required="true" placeholder="Enter meta keyword"><?php if(isset($news_data['meta_keyword'])) echo $news_data['meta_keyword']; else echo set_value("meta_keyword"); ?></textarea>
					</div>
					<div class="form_sep">
						<label for="title" class="req">Meta Description</label>
						<textarea id="meta_description" name="meta_description" class="form-control" data-required="true" placeholder="Enter meta description"><?php if(isset($news_data['meta_description'])) echo $news_data['meta_description']; else echo set_value("meta_description"); ?></textarea>
					</div>
					<div class="form_sep">
                        <?php
                            $attributes = array('class' => 'req');
                            echo form_label('Tags', 'tags', $attributes);

                            $input_data = array(
                                  'name'         => 'tags',
                                  'id'           => 'tags',
                                  'value'        => (isset($news_data['tags'])) ? $news_data['tags'] : set_value("tags"),
                                  'type'         => 'text',
                                  'class'        => 'form-control',
                                  'data-required'=> 'true',
                                  'placeholder'  => 'Enter tags',
                                );
                            echo form_input($input_data);
                        ?>
					</div>
					<div class="form_sep">
						<div class="row">
							<div class="col-md-5">
                                <?php
                                    $attributes = array('class' => 'req');
                                    echo form_label('URL', 'url', $attributes);
        
                                    $input_data = array(
                                          'name'         => 'url',
                                          'id'           => 'cur_url',
                                          'value'        => (isset($news_data['url'])) ? $news_data['url'] : set_value("url"),
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
                                    echo form_label('Publish Date', 'publish_date', $attributes);
        
                                    $input_data = array(
                                          'name'         => 'publish_date',
                                          'id'           => 'publish_date',
                                          'value'        => (isset($news_data['publish_date'])) ? $news_data['publish_date'] : set_value("publish_date"),
                                          'type'         => 'text',
                                          'class'        => 'form-control datepicker',
                                          'data-required'=> 'true',
                                          'placeholder'  => 'Enter publish date',
                                          'data-date-format'=> 'yyyy-mm-dd',
                                        );
                                    echo form_input($input_data);
                                ?>
							</div>
							<div class="col-md-3">
								<label for="status" class="req">Status</label>
								<select name="status" id="status" class="select2">
									<option value="1" <?php if(isset($news_data['status']) && $news_data['status'] == '1') echo 'selected'; elseif(set_value("status") == '1') echo 'selected'; ?>>Enabled</option>
									<option value="0" <?php if(isset($news_data['status']) && $news_data['status'] == '0') echo 'selected'; elseif(set_value("status") == '0') echo 'selected'; ?>>Disabled</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form_sep">
					    <div class="panel panel-default">
							<div class="panel-heading">Details</div>
					        <div class="panel-body">
			    				<textarea id="details" name="details"><?php if(isset($news_data['details'])) echo $news_data['details']; else echo set_value('details');?></textarea>
			    			</div>
					    </div>
					</div>
					<?php
						$news_image = (isset($news_data['image']) && !empty($news_data['image']) && file_exists("./images/news/{$news_data['image']}")) ? base_url()."images/news/{$news_data['image']}" : base_url()."images/no-image/no_img_180.png";
					?>			
					<div class="form_sep">
	                    <div class="fileinput fileinput-new" data-provides="fileinput">
	                        <div class="fileinput-new thumbnail height150 width200">
	                            <img src="<?php echo $news_image; ?>" alt="News Image">
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
                <!-- end news manage form -->
			</div>
		</div>
	</div>
</div>
<!-- //end news manage -->