<?php
	$feedback_sender_email = $this->config->item('feedback_sender_email');
	$sender_email_set_value = set_value("sender_email");
	$email_set_value = set_value("email");
	$subject_set_value = set_value("subject");
	$message_set_value = set_value("message");
?>
<!-- start reply feedback manage -->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title martop5">Reply Feedback</h4>
			</div>
			<div class="panel-body">
                <!-- open reply feedback manage form -->
                <?php
                    $attributes = array('method' => 'post', 'class' => "validate-form", 'id' => 'validate-feedback', 'name' => 'validate-feedback');
                    echo form_open("admin/feedbacks/manage/reply/{$feedback_id}", $attributes);
                ?>  
	    			<div class="form_sep">
                        <?php
                            $attributes = array('class' => 'req');
                            echo form_label('Sender Email', 'sender_email', $attributes);

                            $input_data = array(
                                  'name'         => 'sender_email',
                                  'id'           => 'sender_email',
                                  'value'        => ($sender_email_set_value) ? $sender_email_set_value : $feedback_sender_email,
                                  'type'         => 'email',
                                  'class'        => 'form-control',
                                  'data-required'=> 'true',
                                  'data-type'    => 'email',
                                  'placeholder'  => 'Sender Email',
                                );
                            echo form_input($input_data);
                        ?>
	    			</div>
	    			<div class="form_sep">
                        <?php
                            $attributes = array('class' => 'req');
                            echo form_label('Reply To', 'email', $attributes);

                            $input_data = array(
                                  'name'         => 'email',
                                  'id'           => 'email',
                                  'value'        => ($email_set_value) ? $email_set_value : $feedback['email'],
                                  'type'         => 'email',
                                  'class'        => 'form-control',
                                  'data-required'=> 'true',
                                  'data-type'    => 'email',
                                  'placeholder'  => 'Email',
                                );
                            echo form_input($input_data);
                        ?>
	    			</div>
	    			<div class="form_sep">
	    				<div class="row">
	    					<div class="col-md-6">
                                <?php
                                    echo form_label('CC', 'cc');

                                    $input_data = array(
                                          'name'         => 'cc',
                                          'id'           => 'cc',
                                          'value'        => set_value("cc"),
                                          'type'         => 'email',
                                          'class'        => 'form-control',
                                          'data-type'    => 'email',
                                          'placeholder'  => 'CC',
                                        );
                                    echo form_input($input_data);
                                ?>
	    					</div>
	    					<div class="col-md-6">
                                <?php
                                    echo form_label('BCC', 'bcc');

                                    $input_data = array(
                                          'name'         => 'bcc',
                                          'id'           => 'bcc',
                                          'value'        => set_value("bcc"),
                                          'type'         => 'email',
                                          'class'        => 'form-control',
                                          'data-type'    => 'email',
                                          'placeholder'  => 'BCC',
                                        );
                                    echo form_input($input_data);
                                ?>
	    					</div>
	    				</div>
	    			</div>
	    			<div class="form_sep">
                        <?php
                            $attributes = array('class' => 'req');
                            echo form_label('Subject', 'subject', $attributes);

                            $input_data = array(
                                  'name'         => 'subject',
                                  'id'           => 'subject',
                                  'value'        => (isset($feedback['subject'])) ? $feedback['subject'] : set_value("subject"),
                                  'type'         => 'text',
                                  'class'        => 'form-control',
                                  'data-required'=> 'true',
                                  'placeholder'  => 'Subject',
                                );
                            echo form_input($input_data);
                        ?>
	    			</div>	
	    			<div class="form_sep">
					    <div class="panel panel-default">
							<div class="panel-heading">Message</div>
					        <div class="panel-body">
			    				<textarea id="message" name="message">
			    					<?php if($message_set_value) echo $message_set_value; else { ?>
			    					Dear <?php echo $feedback['name']; ?>,<br /><br /><br />Thanking you,<br /><br /><br />---------------------------------------<br />
			    				<?php echo $feedback['message']; ?><br />
			    				Message ID # <?php echo $feedback_id; ?><br />Dated: <?php echo $feedback['date_timestamp']; ?>
			    				<?php } ?>
			    				</textarea>
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
                                  'content' => 'Reply'
                                );
                           echo form_button($button_data);
                        ?>
					</div>
                 <?php echo form_close(); ?>
                <!-- end reply feedback manage form -->
			</div>
		</div>
	</div>
</div>
<!-- //end reply feedback manage -->