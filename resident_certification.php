<?php include 'server/server.php' ?>
<?php
/*$query = "SELECT * FROM tblresident";
    $result = $conn->query($query);*/

/*$query = "SELECT * tblresident JOIN tblpurok ON tblresident.purok=tblpurok.id";
    $result = $conn->query($query);

    $resident = array();
	while($row = $result->fetch_assoc()){
		$resident[] = $row; 
	}*/

// $query = "SELECT *, tblresident.id as id, tblpurok.id as purok_id, tbl_org.id as org_id FROM tblresident JOIN tblpurok ON tblpurok.id=tblresident.purok JOIN tbl_org ON tbl_org.id=tblresident.organization ";
$query = "SELECT * FROM tblresident2";
$result = $conn->query($query);
$resident = array();
while ($row = $result->fetch_assoc()) {
	$resident[] = $row;
}

$query1 = "SELECT * FROM tblpurok ORDER BY `purok_name`";
$result1 = $conn->query($query1);

$purok = array();
while ($row = $result1->fetch_assoc()) {
	$purok[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'templates/header.php' ?>
	<title>Barangay Clearance - Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Barangay Clearance</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt--2">
						<div class="col-md-12">

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
														<i class="fas fa-file-alt text-primary"></i>
													</div>
												</div>
												<div class="col-7 col-stats">
													<div class="numbers">
														<p class="card-category">More than 6 months</p>
														<h4 class="card-title"></h4>
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
														<i class="fas fa-file-alt text-warning"></i>
													</div>
												</div>
												<div class="col-7 col-stats">
													<div class="numbers">
														<p class="card-category">Less than 6 months</p>
														<h4 class="card-title"></h4>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Card With Icon States Background -->

							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">
											Resident Clearance Issuance
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="residenttable" class="display table table-striped">
											<thead>
												<tr>
													<th scope="col">Fullname</th>
													<th scope="col">National ID</th>
													<th scope="col">Alias</th>
													<th scope="col">Birthdate</th>
													<th scope="col">Age</th>
													<th scope="col">Civil Status</th>
													<th scope="col">Sex</th>
													<th scope="col">Purok</th>
													<?php if (isset($_SESSION['username'])) : ?>
														<?php if ($_SESSION['role'] == 'administrator') : ?>
															<th scope="col">Date of Residence</th>
															<th scope="col">House Type</th>
														<?php endif ?>
														<th scope="col">Action</th>
													<?php endif ?>
												</tr>
											</thead>
											<tbody>
												<?php if (!empty($resident)) : ?>
													<?php $no = 1;
													foreach ($resident as $row) : ?>
														<tr>
															<td>
																<div class="avatar avatar-xs">
																	<img src="<?= preg_match('/data:image/i', $row['picture']) ? $row['picture'] : 'assets/uploads/resident_profile/' . $row['picture'] ?>" alt="Resident Profile" class="avatar-img rounded-circle">
																</div>
																<?= ucwords($row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename']) ?>
															</td>
															<td><?= $row['national_id'] ?></td>
															<td><?= $row['alias'] ?></td>
															<td><?= $row['birthdate'] ?></td>
															<td>
																<?php

																//Calculation 1
																/* $bday = new DateTime($row['birthdate']); // Your date of birth
																$today = new Datetime(date('y.m.d'));
																$diff = $bday->diff($today);

																//Calculation for Age
																$final_age = $diff->y;*/

																$DateOfBirth = $row['birthdate'];

																$dob = new DateTime($DateOfBirth);
																$now = new DateTime();
																$diff = $now->diff($dob);

																echo $diff->y;
																?>
															</td>
															<td><?= ucwords($row['civilstatus']) ?></td>
															<td><?= $row['sex'] ?></td>
															<td>
																<?php
																$h_id = $row['id_household'];
																$queryHouseholdNumber = "SELECT * FROM tbl_household WHERE id_household='$h_id'";
																$resultHouseholdNumber = $conn->query($queryHouseholdNumber);
																$householdnum = $resultHouseholdNumber->fetch_assoc();

																$p_name = $householdnum['id_purok'];
																$queryPurokName = "SELECT * FROM tblpurok WHERE id_purok='$p_name'";
																$resultPurokName = $conn->query($queryPurokName);
																$pname = $resultPurokName->fetch_assoc();

																echo $pname['purok_name'];
																?>
															</td>
															<?php if (isset($_SESSION['username'])) : ?>
																<?php if ($_SESSION['role'] == 'administrator') : ?>
																	<td><?= date("d F Y", strtotime($row['date_of_residence'])) ?></td>
																	<td>
																		<?php
																		$h_id = $row['id_household'];
																		$queryHouseholdNumber = "SELECT * FROM tbl_household WHERE id_household='$h_id'";
																		$resultHouseholdNumber = $conn->query($queryHouseholdNumber);
																		$householdnum = $resultHouseholdNumber->fetch_assoc();

																		echo ucwords($householdnum['household_type']);
																		?>
																	</td>
																<?php endif ?>
																<td>
																	<div class="form-button-action">
																		<?php
																		$currentTime = date('Y-m-d');
																		$dateOfresidence = date('Y-m-d', strtotime("+6 months", strtotime($row['date_of_residence'])));
																		?>
																		<?php if ($currentTime >= $dateOfresidence) : ?>
																			<!-- <a type="button" data-toggle="tooltip" href="generate_brgy_cert.php?id=<?= $row['id_resident'] ?>" class="btn btn-link btn-primary" data-original-title="Generate Certificate">
																				<i class="fas fa-file-alt"></i>
																			</a> -->
																			<a type="button" data-toggle="modal" href="#payment_brgy_cert" class="btn btn-link btn-primary" data-original-title="Generate Certificate">
																				<i class="fas fa-file-alt"></i>
																			</a>
																		<?php elseif ($currentTime < $dateOfresidence) : ?>
																			<!-- <a type="button" data-toggle="tooltip" href="generate_brgy_cert.php?id=<?= $row['id_resident'] ?>" class="btn btn-link btn-warning" onclick="return confirm('This resident has not lived in this barangay for more than six months. Do you want to proceed?')" data-original-title="Generate Certificate">
																				<i class="fas fa-file-alt"></i>
																			</a> -->
																			<a type="button" data-toggle="modal" href="#payment_brgy_cert" class="btn btn-link btn-warning" onclick="return confirm('This resident has not lived in this barangay for more than six months. Do you want to proceed?')" data-original-title="Generate Certificate">
																				<i class="fas fa-file-alt"></i>
																			</a>
																		<?php endif ?>
																	</div>
																</td>
															<?php endif ?>

														</tr>
													<?php $no++;
													endforeach ?>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
													<th scope="col">Fullname</th>
													<th scope="col">National ID</th>
													<th scope="col">Alias</th>
													<th scope="col">Birthdate</th>
													<th scope="col">Age</th>
													<th scope="col">Civil Status</th>
													<th scope="col">Sex</th>
													<th scope="col">Purok</th>
													<?php if (isset($_SESSION['username'])) : ?>
														<?php if ($_SESSION['role'] == 'administrator') : ?>
															<th scope="col">Date of Residence</th>
															<th scope="col">House Type</th>
														<?php endif ?>
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
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="payment_brgy_cert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Create Purok</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="POST" action="#">
								<div class="form-group">
									<label>Name</label>
									<input type="text" class="form-control" placeholder="Enter Purok Name" name="purok" required>
								</div>
								<div class="form-group">
									<label>Purok Details(Optional)</label>
									<textarea class="form-control" placeholder="Set Bounderies for each Purok" name="details"></textarea>
								</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Create</button>
						</div>
						</form>
					</div>
				</div>
			</div>

			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
		</div>

	</div>
	<?php include 'templates/footer.php' ?>
	<script src="assets/js/plugin/datatables/datatables.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#residenttable').DataTable();
		});
	</script>
</body>

</html>