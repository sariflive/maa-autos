<!-- start callback request list -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Callback Request</h3>
    </div>
    <div class="panel-body">
        <!-- start callback request list table -->
		<table class="table table-vam table-striped table-bordered" id="dt_gal">
		    <!-- start table head -->
			<thead>
				<tr>
					<th>Date</th>
					<th class="hidden-xs">Name</th>
					<th class="hidden-xs">Email</th>
					<th class="hidden-xs">Country</th>
					<th class="hidden-xs">Phone</th>
					<th class="hidden-xs">Message</th>
					<th class="hidden-sm hidden-xs">Status</th>
					<th>Action</th>
				</tr>
			</thead>
            <!-- //end table head -->
            
            <!-- start table body -->
			<tbody>
				<?php if(count($callback) > 0) {
					foreach ($callback as $key => $row) {
						$alphaID = alphaID($row['ID']);
						$status = ($row['status'] == '1') ? "Enbled" : 'Disabled';
						$status_label = ($row['status'] == '1') ? "label-success" : 'label-danger';
				?>
				<tr id="<?php echo $alphaID; ?>">
					<td><?php echo date('dS F, Y', strtotime($row['date'])); ?></td>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['country_name']; ?></td>
					<td><?php echo $row['phone']; ?></td>
					<td><?php echo $row['message']; ?></td>
					<td class="hidden-sm hidden-xs">
						<a data-original-title="Select Status" data-url="<?php echo site_url("admin/callback/status_update"); ?>" data-value="<?php echo $row['status']; ?>" data-pk="<?php echo $alphaID; ?>" data-type="select" data-name="status" name="status" class="rstatusopt" href="#">
							<label class="label <?php echo $status_label; ?> pointer"><?php echo $status; ?></label>
						</a>
					</td>
					<td>
						<div class="btn-group">
							<button class="btn btn-danger btn-sm btnDel" data-url="<?php echo site_url("admin/callback/manage/delete"); ?>" id="<?php echo $alphaID; ?>" data-toggle="tooltip" data-placement="top" data-title="Delete"><i class="fa fa-trash"></i></button>
						</div>
					</td>
				</tr>
				<?php }
				} else echo '<tr><td colspan="8">'.admin_errors(3).'</td></tr>'; ?>
			</tbody>
            <!-- //end table body -->

            <!-- start table footer -->
			<tfoot>
				<tr>
					<td colspan="8">
						<a class="btn btn-md btn-primary" href="<?php echo site_url("admin/callback"); ?>">All Callback Request</a>
					</td>
				</tr>
			</tfoot>
            <!-- //end table footer -->
		</table>
		<!-- //end callback request list table -->
    </div>
</div>
<!-- //end callback request list -->

<!-- start vehicle enquiries list -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Vehicle Enquiries</h3>
    </div>
    <div class="panel-body">
        <!-- start vehicle enquiries list table -->
		<table class="table table-vam table-striped table-bordered" id="dt_gal">
		    <!-- start table head -->
			<thead>
				<tr>
					<th>Date</th>
					<th class="hidden-xs">Vehicle Code</th>
					<th class="hidden-xs">Name</th>
					<th class="hidden-xs">Address</th>
					<th class="hidden-xs">Message</th>
					<th class="hidden-sm hidden-xs">Status</th>
					<th>Action</th>
				</tr>
			</thead>
            <!-- //end table head -->
            
            <!-- start table body -->
			<tbody>
				<?php if(count($enquiries) > 0) {
					foreach ($enquiries as $key => $row) {
						$alphaID = alphaID($row['ID']);
						$status = ($row['status'] == '1') ? "Enbled" : 'Disabled';
						$status_label = ($row['status'] == '1') ? "label-success" : 'label-danger';
						
						$vehicleID = alphaID($row['vehicle_ID']);
						$vehicle_url = site_url("admin/vehicles/manage/view/{$vehicleID}");
				?>
				<tr id="En<?php echo $alphaID; ?>">
					<td><?php echo date('dS F, Y', strtotime($row['date'])); ?></td>
					<td>
						<a target="_blank" data-title="View Vehicle Details" data-toggle="tooltip" data-placement="top" href="<?php echo $vehicle_url; ?>">
							<?php echo $row['vehicleCode']."<br /><small>{$row['vehicle_name']}</small>"; ?>
						</a>
					</td>
					<td><?php echo $row['name'].'<br />'.$row['email'].'<br />'.$row['phone']; ?></td>
					<td><?php echo $row['address']."<br/>{$row['country_name']}"; ?></td>
					<td><?php echo $row['comments']; ?></td>
					<td class="hidden-sm hidden-xs">
						<a data-original-title="Select Status" data-url="<?php echo site_url("admin/enquiries/status_update"); ?>" data-value="<?php echo $row['status']; ?>" data-pk="<?php echo $alphaID; ?>" data-type="select" data-name="status" name="status" class="rstatusopt" href="#">
							<label class="label <?php echo $status_label; ?> pointer"><?php echo $status; ?></label>
						</a>
					</td>
					<td>
						<div class="btn-group">
							<button class="btn btn-danger btn-sm btnDel" data-url="<?php echo site_url("admin/enquiries/manage/delete"); ?>" data-title="Delete" data-toggle="tooltip" data-placement="top" id="<?php echo $alphaID; ?>"><i class="fa fa-trash"></i></button>
							<a href="<?php echo site_url("admin/enquiries/manage/view/{$alphaID}"); ?>" class="btn btn-sm btn-primary" data-title="View" data-toggle="tooltip" data-placement="top"><i class="fa fa-tasks"></i></a>
							<a href="<?php echo site_url("admin/enquiries/manage/reply/{$alphaID}"); ?>" class="btn btn-sm btn-success" data-title="Reply" data-toggle="tooltip" data-placement="top"><i class="fa fa-mail-reply"></i></a>
						</div>
					</td>
				</tr>
				<?php }
				} else echo '<tr><td colspan="7">'.admin_errors(3).'</td></tr>'; ?>
			</tbody>
            <!-- //end table body -->

            <!-- start table footer -->
			<tfoot>
				<tr>
					<td colspan="7">
						<a class="btn btn-md btn-primary" href="<?php echo site_url("admin/enquiries"); ?>">All Vehicle Enquiries</a>
					</td>
				</tr>
			</tfoot>
            <!-- //end table footer -->
		</table>
        <!-- //end vehicle enquiries list table -->
    </div>
</div>
<!-- //end vehicle enquiries list -->