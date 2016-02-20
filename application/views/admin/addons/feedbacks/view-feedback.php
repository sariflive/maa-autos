<!-- start view feedback -->
<div class="row">
	<div class="col-md-6">
	    <!-- start contact information -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Contact Info</h4>
			</div>
			<div class="panel-body">
		        <table class="table table-bordered">
				    <tbody>
				    	<tr>
							<td>Name</td>
							<td>:</td>
							<td><?php if(!empty($feedback['name'])) echo $feedback['name']; else echo "N/A"?></td>	
						</tr>
				    	<tr>
							<td>Email</td>
							<td>:</td>
							<td><?php if(!empty($feedback['email'])) echo $feedback['email']; else echo "N/A"; ?></td>	
						</tr>
				    	<tr>
							<td>Subject</td>
							<td>:</td>
							<td><?php if(!empty($feedback['subject'])) echo $feedback['subject']; else echo "N/A"; ?></td>	
						</tr>
				    	<tr>
							<td>Date</td>
							<td>:</td>
							<td><?php if(!empty($feedback['date_timestamp'])) echo date('dS F, Y', strtotime($feedback['date_timestamp'])); else echo "N/A"; ?></td>	
						</tr>
				    	<tr>
							<td>IP</td>
							<td>:</td>
							<td><?php if(!empty($feedback['IP'])) echo $feedback['IP']; else echo "N/A"; ?></td>	
						</tr>
				    	<tr>
							<td>Browser</td>
							<td>:</td>
							<td><?php if(!empty($feedback['browser'])) echo $feedback['browser']; else echo "N/A"; ?></td>	
						</tr>																												
					</tbody>
				</table>
			</div>
		</div>
		<!-- //end contact information -->
	</div>
	<div class="col-md-6">
	    <!-- start message details -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Message</h4>
			</div>
			<div class="panel-body">
				<?php if(!empty($feedback['message'])) echo $feedback['message']; else echo "N/A"; ?>
			</div>
		</div>
		<!-- //end message details -->
	</div>
</div>
<!-- //end view feedback -->