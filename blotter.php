<?php include 'server/server.php' ?>

<?php
$query  = "SELECT *, tblblotter.id_blotter as id, tbl_users.id_user as user_id FROM tblblotter JOIN tbl_users ON tbl_users.id_user=tblblotter.id_user";
$result = $conn->query($query);

$blotter = array();
while ($row = $result->fetch_assoc()) {
	$blotter[] = $row;
}

$query1 = "SELECT *, tblblotter.id_blotter as id, tbl_users.id_user as user_id FROM tblblotter JOIN tbl_users ON tbl_users.id_user=tblblotter.id_user WHERE tblblotter.blotter_status='Active' ";
$result1 = $conn->query($query1);
$active = $result1->num_rows;

$query2 = "SELECT *, tblblotter.id_blotter as id, tbl_users.id_user as user_id FROM tblblotter JOIN tbl_users ON tbl_users.id_user=tblblotter.id_user WHERE tblblotter.blotter_status='Scheduled' ";
$result2 = $conn->query($query2);
$scheduled = $result2->num_rows;

$query3 = "SELECT *, tblblotter.id_blotter as id, tbl_users.id_user as user_id FROM tblblotter JOIN tbl_users ON tbl_users.id_user=tblblotter.id_user WHERE tblblotter.blotter_status='Settled' ";
$result3 = $conn->query($query3);
$settled = $result3->num_rows;

$query5 = "SELECT *, tblblotter.id_blotter as id, tbl_users.id_user as user_id FROM tblblotter JOIN tbl_users ON tbl_users.id_user=tblblotter.id_user WHERE tblblotter.blotter_status='Forwarded to Lupon' ";
$result5 = $conn->query($query5);
$ftl = $result5->num_rows;

$query4 = "SELECT * FROM tblresident2 ORDER BY firstname ASC";
$result4 = $conn->query($query4);

$residents = array();
while ($row = $result4->fetch_assoc()) {
	$residents[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'templates/header.php' ?>
	<link rel="stylesheet" href="assets/js/plugin/dataTables.dateTime.min.css">
	<link rel="stylesheet" href="assets/js/plugin/datatables/Buttons-1.6.1/css/buttons.dataTables.min.css">
	<title>Blotter/Incident Complaint - Barangay Management System</title>

	<!-- Select2 CSS -->
	<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> -->
	<link rel="stylesheet" href="assets/css/select2.min.css" />
	<!-- <link rel="stylesheet" href="/path/to/select2.css"> -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
</head>

<body>
	<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<!-- Main Header -->
		<?php include 'templates/main-header.php' ?>
		<!-- End Main Header -->

		<!-- Sidebar -->
		<?php include 'templates/sidebar.php' ?>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-dark-gradient">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white fw-bold">Blotter/Incident Complaint</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<?php if (isset($_SESSION['message'])) : ?>
						<div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success'] == 'danger' ? 'bg-danger text-light' : null ?>" role="alert">
							<?php echo $_SESSION['message']; ?>
						</div>
						<?php unset($_SESSION['message']); ?>
					<?php endif ?>

					<!-- Card With Icon States Color -->
					<div class="row justify-content-center">
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fa fa-edit text-danger"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<a href="javascript:void(0)" id="activeCase" class="card-link text-muted">Active Case </a>
												<h4 class="card-title"><?= number_format($active) ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fa fa-edit text-success"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<a href="javascript:void(0)" id="settledCase" class="card-link text-muted">Settled Case </a>
												<h4 class="card-title"><?= number_format($settled) ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fa fa-edit text-secondary"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<a href="javascript:void(0)" id="flpCase" class="card-link text-muted">Forwarded to Lupon</a>
												<h4 class="card-title"><?= number_format($ftl) ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Card With Icon States Background -->

					<div class="row mt--2">
						<div class="col">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">All Resident</div>
										<?php if (isset($_SESSION['username'])) : ?>
											<div class="card-tools">
												<!-- <a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm"> -->
												<a href="#addBlotterForm" class="btn btn-info btn-sm">
													<i class="fa fa-plus"></i>&nbsp
													Blotter/Incident
												</a>
											</div>
										<?php endif ?>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="blottertable" class="display table table-striped">
											<thead>
												<tr>
													<th scope="col">Complainant</th>
													<th scope="col">Respondent</th>
													<th scope="col">Nature of Case</th>
													<th scope="col">Status</th>
													<th scope="col">Details</th>
													<th scope="col">Schedule</th>
													<th scope="col">User</th>
													<?php if (isset($_SESSION['username'])) : ?>
														<th scope="col">Created</th>
														<th scope="col">Updated</th>
														<th scope="col">Action</th>
													<?php endif ?>
												</tr>
											</thead>
											<tbody>
												<?php if (!empty($blotter)) : ?>
													<?php foreach ($blotter as $row) : ?>
														<tr>
															<td>
																<?php

																if ($row['comp_id'] !== "N/A") {

																	$comp_id = $row['comp_id'];
																	$sqlComplainant = "SELECT * FROM tblresident2 WHERE id_resident = '$comp_id'";
																	$queryComplainant = $conn->query($sqlComplainant);
																	$complainant = $queryComplainant->fetch_assoc();

																	$h_id = $complainant['id_household'];
																	$queryHouseholdNumber = "SELECT * FROM tbl_household WHERE id_household='$h_id'";
																	$resultHouseholdNumber = $conn->query($queryHouseholdNumber);
																	$householdnum = $resultHouseholdNumber->fetch_assoc();

																	$p_name = $householdnum['id_purok'];
																	$queryPurokName = "SELECT * FROM tblpurok WHERE id_purok='$p_name'";
																	$resultPurokName = $conn->query($queryPurokName);
																	$pname = $resultPurokName->fetch_assoc();

																	echo "<span class='fw-bold'>" . $complainant['firstname'] . ' ' . $complainant['middlename'] . ' ' . $complainant['lastname'] . "</span><br>" . $householdnum['household_street_name'] . ', ' . $householdnum['household_address'] . ', ' . $pname['purok_name'] . '<br>' . $complainant['phone'];
																} elseif ($row['comp_id'] == "N/A") {
																	echo "<span class='fw-bold'>" . $row['comp_nameNotResident'] . "</span><br><span class='font-italic'>" . $row['comp_addNotResident'] . '<br>' . $row['comp_cnumNotResident'] . '</span>';
																}
																?>
															</td>
															<td>
																<?php
																if (isset($row['resp_id'])) {

																	$resp_name = $row['resp_id'];
																	$sqlRespondent = "SELECT * FROM tblresident2 WHERE id_resident = '$resp_name'";
																	$queryRespondent = $conn->query($sqlRespondent);

																	foreach ($queryRespondent as $respondent) {
																		echo $f_name = $respondent['firstname'] . ' ' . $respondent['middlename'] . ' ' . $respondent['lastname'];
																	}
																}
																?>
															</td>
															<td>
																<?php
																if ($row['noc_id'] == 'Others') {
																	echo ucwords($row['noc_others']);
																} else {
																	$noc = $row['noc_id'];
																	$sqlNoc = "SELECT * FROM tbl_nature_of_case WHERE noc_id='$noc'";
																	$queryNoc = $conn->query($sqlNoc);
																	foreach ($queryNoc as $nocName) {
																		echo $nocName['noc_name'];
																	}
																}
																?>
															</td>
															<td>
																<?php if ($row['blotter_status'] == 'Settled') : ?>
																	<span class="badge badge-success">Settled</span>
																<?php elseif ($row['blotter_status'] == 'Active') : ?>
																	<span class="badge badge-danger">Active</span>
																<?php elseif ($row['blotter_status'] == 'Forwarded to Lupon') : ?>
																	<span class="badge badge-secondary">Forwarded to Lupon</span>
																<?php endif ?>
															</td>
															<td class="d-inline-block text-truncate" style="max-width: 100px;"><?= '<b>What happened: </b>' . '<br>' . $row['comp_what'] . '<br><br>' . '<b>Action: </b>' . '<br>' . $row['comp_what2'] ?></td>
															<td><!--BLOTTER SCHEDULES-->
																<?php
																$getIdBlotter = $row['id_blotter'];
																$queryGetSched = "SELECT * FROM tblblotter_schedule WHERE id_blotter = '$getIdBlotter' ORDER BY id_blotter_schedule DESC LIMIT 1";
																$resultGetSched = $conn->query($queryGetSched);
																$GetSched = $resultGetSched->fetch_assoc();
																?>
																<?= date("F j, Y", strtotime($GetSched['blotter_date'])) . ' ' . date("g:i a", strtotime($GetSched['blotter_time'])) ?>
															</td>
															<td><?= $row['user_username'] ?></td>
															<?php if (isset($_SESSION['username'])) : ?>
																<td><?= date("F j, Y, g:i a", strtotime($row['created_at_blotter'])) ?></td>
																<td><?= date("F j, Y, g:i a", strtotime($row['updated_at_blotter'])) ?></td>
																<td>
																	<div class="form-button-action">
																		<?php if ($row['blotter_status'] == 'Settled' || $row['blotter_status'] == "Forwarded to Lupon") : ?>
																			<a type="button" href="#edit" role="link" data-toggle="modal" class="btn btn-link <?php if ($row['blotter_status'] == 'Settled') {
																																									echo 'btn-success';
																																								} elseif ($row['blotter_status'] == 'Forwarded to Lupon') {
																																									echo 'btn-secondary';
																																								} ?> " title="The case is already settled. Are you sure you want to edit it?" onclick="alert('The case <?php if ($row['blotter_status'] == 'Settled') {
																																																																			echo "is already settled.";
																																																																		} elseif ($row['blotter_status'] == 'Forwarded to Lupon') {
																																																																			echo "was already forwarded to Lupon.";
																																																																		} ?> Are you sure you want to edit it?'); editBlotter1(this)" data-blotter_date="<?= $GetSched['blotter_date'] ?>" data-blotter_time="<?= $GetSched['blotter_time'] ?>" data-blotter_status="<?= $row['blotter_status'] ?>" data-user_username="<?= $row['id_user'] ?>" data-id="<?= $row['id_blotter'] ?>" disabled>

																			<?php elseif (date('Y-m-d g:i a') > $GetSched['blotter_date']) : ?>
																				<a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Blotter" onclick="editBlotter1(this)" data-blotter_date="<?= $GetSched['blotter_date'] ?>" data-blotter_time="<?= $GetSched['blotter_time'] ?>" data-blotter_status="<?= $row['blotter_status'] ?>" data-user_username="<?= $row['id_user'] ?>" data-id="<?= $row['id_blotter'] ?>">
																				<?php else : ?>
																					<a type="button" role="link" aria-disabled="true" data-toggle="modal" class="btn btn-link btn-warning" title="Unable to edit. You can edit this after or within the said schedule." onclick="alert('Unable to edit. You can edit this after or within the said schedule.')" data-blotter_date="<?= $GetSched['blotter_date'] ?>" data-blotter_time="<?= $GetSched['blotter_time'] ?>" data-blotter_status="<?= $row['blotter_status'] ?>" data-user_username="<?= $row['id_user'] ?>" data-id="<?= $row['id_blotter'] ?>" disabled>
																					<?php endif ?>
																					<?php if (isset($_SESSION['username'])) : ?>
																						<i class="fa fa-edit"></i>
																					<?php else : ?>
																						<i class="fa fa-eye"></i>
																					<?php endif ?>
																					</a>

																					<a type="button" href="blotter_reschedule_form.php?id=<?= $row['id_blotter'] ?>" class="btn btn-link <?php if ($row['blotter_status'] == 'Settled') {
																																																echo 'btn-success';
																																															} elseif ($row['blotter_status'] == 'Forwarded to Lupon') {
																																																echo 'btn-secondary';
																																															} ?>" title="Reschedule" disabled>
																						<i class="fas fa-calendar-alt"></i>
																					</a>

																					<a type="button" href="generate_blotter_report.php?id=<?= $row['id_blotter'] ?>" class="btn btn-link btn-info" title="View blotter details" disabled>
																						<i class="fa fa-eye"></i>
																					</a>
																					<!-- <a type="button" data-toggle="tooltip" href="generate_blotter_report.php?id=<?= $row['id'] ?>" class="btn btn-link btn-primary" data-original-title="Generate Report">
																	<i class="fas fa-file-alt"></i>
																</a> -->
																					<?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'administrator') : ?>
																						<!-- <a type="button" data-toggle="tooltip" href="model/remove_blotter.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this blotter?');" class="btn btn-link btn-danger" data-original-title="Remove">
																<i class="fa fa-times"></i>
															</a> -->
																					<?php endif ?>
																	</div>
																</td>
															<?php endif ?>
														</tr>
													<?php endforeach ?>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
													<th scope="col">Complainant</th>
													<th scope="col">Respondent</th>
													<th scope="col">Nature of Case</th>
													<th scope="col">Status</th>
													<th scope="col">Details</th>
													<th scope="col">Schedule</th>
													<th scope="col">User</th>
													<?php if (isset($_SESSION['username'])) : ?>
														<th scope="col">Created</th>
														<th scope="col">Updated</th>
														<th scope="col">Action</th>
													<?php endif ?>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row mt--2" id="addBlotterForm">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Add Blotter</div>
								</div>
								<div class="card-body">
									<form method="POST" action="model/save_blotter.php" onsubmit="return confirm('Are you sure you want to submit this form?');">

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<b>
														<h2>CASE INFORMATION<span class="text-danger"><b> *</b></span></h2>
													</b>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Nature of the Case<span class="text-danger"><b> *</b></span></label>
													<select class="form-control noc" name="noc" id="noc" required>
														<option disabled selected>Select Case</option>
														<?php
														$query5 = "SELECT * FROM tbl_nature_of_case ORDER BY noc_name ASC";
														$result5 = $conn->query($query5);

														$noc = array();
														while ($row = $result5->fetch_assoc()) {
															$noc[] = $row;
														}
														?>
														<?php foreach ($noc as $row) : ?>
															<option value="<?= $row['noc_id'] ?>"><?= $row['noc_name'] ?></option>
														<?php endforeach ?>
														<option value="Others">Others</option>
													</select>
													<small id="nocHelp" class="form-text text-muted">Note: If others, input the nature of case in the "Others" field.</small>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label for="noc_others">Others</label>
													<input type="text" class="form-control noc_others" id="noc_others" name="noc_others" disabled placeholder="Enter the nature of case" required>
												</div>
											</div>
										</div>

										<hr>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<b>
														<h2>COMPLAINANT'S INFORMATION</h2>
													</b>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="isResident">Is the complainant a resident?<span class="text-danger"><b> *</b></span></label>
													<select class="form-control isResident" name="isResident" id="isResident" required>
														<option disabled selected>Choose...</option>
														<option value="Yes">Yes</option>
														<option value="No">No</option>
													</select>
													<small id="nocHelp" class="form-text text-muted">Note: Choose YES if a resident. Otherwise, choose NO.</small>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<!-- <div class="form-group">
													<label for="comp_name">Complainant's Name</label>
													<input type="text" class="form-control comp_name" id="comp_name" name="comp_name" placeholder="Enter Complainant's Name" required disabled>
													<small class="form-text text-muted">Make sure to <b>SELECT ONLY</b> what was suggested in the dropdown.</small>
												</div> -->
												<div class="form-group">
													<label>Complainant's Name</span><span class="text-danger"><b> *</b></span></label>
													<select class="form-control js-states input-lg comp_name" style="width:100%;" id="comp_name" name="comp_name" required disabled>
														<?php foreach ($residents as $row2) : ?>
															<option value=""></option>
															<option value="<?= $row2['id_resident'] ?>"> <?= $row2['firstname'] . ' ' . $row2['middlename'] . ' ' . $row2['lastname'] ?> </option>
														<?php endforeach ?>
													</select>
													<small class="form-text text-muted">Make sure to <b>SELECT ONLY</b> what was suggested in the dropdown.</small>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md">
												<div class="form-group">
													<label for="comp_nameNotResident">Complainant's Name (IF NOT A RESIDENT)</label>
													<input type="text" class="form-control comp_nameNotResident" id="comp_nameNotResident" name="comp_nameNotResident" placeholder="Enter Complainant's Name" oninput="this.value = this.value.replace(/[^A-z\s.-]/g, '').replace(/(\..*)\./g, '$1');" required disabled>
												</div>
											</div>
											<div class="col-md">
												<div class="form-group">
													<label for="comp_addNotResident">Address (IF NOT A RESIDENT)</label>
													<input type="text" class="form-control comp_addNotResident" id="comp_addNotResident" name="comp_addNotResident" placeholder="Enter Complainant's Address" required disabled>
												</div>
											</div>
											<div class="col-md">
												<div class="form-group">
													<label for="comp_cnumNotResident">Contact Number (IF NOT A RESIDENT)</label>
													<input type="text" class="form-control comp_cnumNotResident" id="comp_cnumNotResident" name="comp_cnumNotResident" placeholder="Enter Complainant's Address" minlength="11" maxlength="11" oninput="this.value = this.value.replace(/[^0-9-]/g, '').replace(/(\..*)\./g, '$1');" pattern="\d{11}" required disabled>
												</div>
											</div>
										</div>

										<div class="form-group">
											<label>What happened?<span class="text-danger"><b> *</b></span></label>
											<textarea class="form-control comp_what" id="comp_what" name="comp_what" placeholder="Enter Blotter or Incident here..." name="details" required></textarea>
											<small id="info1Help" class="form-text text-muted">Note: Input a short statement about what happened.</small>
										</div>

										<div class="form-group">
											<label>What does the complainant want to do with the issue?<span class="text-danger"><b> *</b></span></label>
											<textarea class="form-control comp_what2" id="comp_what2" name="comp_what2" placeholder="Complainant's will..." name="details" required></textarea>
											<small id="info1Help" class="form-text text-muted">Note: Input a short statement about what does the complainant want to do with issue?</small>
										</div>

										<hr>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<b>
														<h2>RESPONDENT'S INFORMATION<span class="text-danger"><b> *</b></span></h2>
													</b>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<!-- <div class="form-group">
													<label for="resp_name">Respondent's Name<span class="text-danger"><b> *</b></span></label>
													<input type="text" class="form-control resp_name" id="resp_name" name="resp_name" placeholder="Enter Respondent's Name" required>
													<small class="form-text text-muted">Make sure to <b>SELECT ONLY</b> what was suggested in the dropdown.</small>
												</div> -->
												<div class="form-group">
													<label>Respondent's Name</span><span class="text-danger"><b> *</b></span></label>
													<select class="form-control js-states input-lg resp_name" style="width:100%;" id="resp_name" name="resp_name" required>
														<?php foreach ($residents as $row2) : ?>
															<option value=""></option>
															<option value="<?= $row2['id_resident'] ?>"> <?= $row2['firstname'] . ' ' . $row2['middlename'] . ' ' . $row2['lastname'] ?> </option>
														<?php endforeach ?>
													</select>
													<small class="form-text text-muted">Make sure to <b>SELECT ONLY</b> what was suggested in the dropdown.</small>
												</div>
											</div>
										</div>

										<hr>

										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<b>
														<h2>SCHEDULE FOR HEARING FOR MEDIATION<span class="text-danger"><b> *</b></span></h2>
													</b>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Booked Schedules<span class="text-danger"><b> *</b></span></label><br>
													<a type="button" data-toggle="modal" href="#check" class="btn btn-secondary" title="View Booked Schedules Blotter"">
														<i class=" far fa-calendar-times text-light"></i>
													</a>
													<small class="form-text text-muted">You can look at the booked schedules here to get an idea of when you'll allocate time in your schedule for mediation.</small>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Date<span class="text-danger"><b> *</b></span></label>
													<input type="date" class="form-control" name="blotter_date" id="blotter_date" value="<?= date('Y-m-d'); ?>" required>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Time<span class="text-danger"><b> *</b></span></label>
													<input type="time" class="form-control" name="blotter_time" required>
												</div>
											</div>
										</div>

								</div>
								<div class="card-action">
									<button class="btn btn-success">Submit</button>
									<a href="" class="btn btn-danger">Cancel</a>
								</div>
								</form>
							</div>
						</div>
					</div>

				</div>
			</div>

			<!-- Check Modal -->
			<div class="modal fade" id="check" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Not available time</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="alert alert-warning" role="alert">
								Below are the time lots that are <span class="fw-bold">not</span> available.
							</div>
							<div class="card-body">
								<table id="bookedSched" class="table table-hover">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">Date</th>
											<th scope="col">Time</th>
											<th scope="col">Status</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$queryCheckSched = "SELECT * FROM tblblotter JOIN tblblotter_schedule ON tblblotter_schedule.id_blotter=tblblotter.id_blotter WHERE tblblotter.blotter_status = 'Active'";
										$resultCheckSched = $conn->query($queryCheckSched);

										$bookedSched = array();
										while ($row = $resultCheckSched->fetch_assoc()) {
											$bookedSched[] = $row;
										}
										?>
										<?php if (!empty($bookedSched)) : ?>
											<?php
											$no = 1;
											foreach ($bookedSched as $row) :
											?>
												<tr>
													<td><?= $no ?></td>
													<td><?= date("F d, Y", strtotime($row['blotter_date'])) ?></td>
													<td><?= date("g:i a", strtotime($row['blotter_time'])) ?></td>
													<td><?= $row['blotter_status'] ?></td>
												</tr>
											<?php
												$no++;
											endforeach
											?>
									</tbody>
									<tfoot>
										<tr>
											<th scope="col">#</th>
											<th scope="col">Date</th>
											<th scope="col">Time</th>
											<th scope="col">Status</th>
										</tr>
									</tfoot>
								<?php endif ?>
								</table>
							</div>
						</div>
						<div class="modal-footer">
						</div>
					</div>
				</div>
			</div>
			<!-- End Check Modal -->

			<!-- Edit Modal -->
			<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Edit Blotter</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="POST" action="model/edit_blotter.php">
								<div class="row">
									<div class="col">
										<div class="form-group">
											<label>Status</label>
											<select class="form-control" name="blotter_status" id="blotter_status">
												<option disabled selected>Select Blotter Status</option>
												<option value="Active">Active</option>
												<option value="Settled">Settled</option>
												<option value="Forwarded to Lupon">Forwarded to Lupon</option>
												<!-- <option value="Scheduled">Scheduled</option> -->
											</select>
										</div>
									</div>
								</div>
						</div>
						<div class="modal-footer">
							<input type="hidden" id="id" name="id">
							<input type="hidden" id="blotterdate" name="blotter_date">
							<input type="hidden" id="blottertime" name="blotter_time">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<?php if (isset($_SESSION['username'])) : ?>
								<button type="submit" class="btn btn-primary">Update</button>
							<?php endif ?>
						</div>
						</form>

					</div>
				</div>
			</div>
			<!-- End Edit Modal -->

			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->

		</div>

	</div>
	<?php include 'templates/footer.php' ?>

	<!-- START -->
	<!-- I commented this out because it interferes with the nav-button when the screen is mobile. Comment this out if you encounter with the functions -->
	<!-- jQuery library -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

	<!-- jQuery UI library -->
	<!-- <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css"> -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script> -->
	<!-- END -->

	<script src="assets/js/plugin/datatables/datatables.min.js"></script>

	<!-- Select2 -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<script>
		$("#comp_name").select2({
			theme: "bootstrap4",
			placeholder: "Select Complainant's Name",
			allowClear: true
		});

		$("#resp_name").select2({
			theme: "bootstrap4",
			placeholder: "Select Respondent's Name",
			allowClear: true
		});

		$(document).ready(function() {
			$('#bookedSched').DataTable();
		});

		$(document).ready(function() {
			var oTable = $('#blottertable').DataTable({
				"order": [
					[5, "asc"]
				]
			});

			$("#activeCase").click(function() {
				var textSelected = 'Active';
				oTable.columns(3).search(textSelected).draw();
			});

			$("#settledCase").click(function() {
				var textSelected = 'Settled';
				oTable.columns(3).search(textSelected).draw();
			});
			// $("#scheduledCase").click(function(){
			// 	var textSelected = 'Scheduled';
			// 	oTable.columns(3).search(textSelected).draw();
			// });
			$("#flpCase").click(function() {
				var textSelected = 'Forwarded to Lupon';
				oTable.columns(3).search(textSelected).draw();
			});
		});

		$(function() {
			$("#comp_name").autocomplete({
				source: 'backend-script.php'
			});
		});

		$(function() {
			$("#resp_name").autocomplete({
				source: 'backend-script2.php' //FOR FETCHING RESIDENT FOR COMPLAIN
			});
		});

		//DISABLE PAST DATES INPUT
		var today = new Date().toISOString().split('T')[0];
		document.getElementsByName("blotter_date")[0].setAttribute('min', today);
	</script>
</body>

</html>