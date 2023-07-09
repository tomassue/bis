<?php include 'server/server.php' ?>
<?php
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

$query_check_chairman = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.id_position=tblposition.id_position WHERE tblposition.position='Barangay Chairman' AND `archive` = '0'";
$check_chairman = $conn->query($query_check_chairman)->fetch_assoc();
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
																		<?php if (!isset($check_chairman['status'])) : ?>
																			<a type="button" onclick="showCheck_chairman_secretary()" data-toggle="modal" class="btn btn-link btn-danger" data-original-title="Generate Certificate">
																				<i class="fas fa-file-alt"></i>
																			</a>
																		<?php elseif (isset($check_chairman['status'])) : ?>
																			<?php if ($check_chairman['status'] == 'Incumbent') : ?>
																				<?php if ($currentTime >= $dateOfresidence) : ?>
																					<a type="button" href="#purpose_brgy_cert<?= $row['id_resident'] ?>" data-toggle="modal" class="btn btn-link btn-primary" data-original-title="Generate Certificate">
																						<i class="fas fa-file-alt"></i>
																					</a>
																					<?php include 'resident_certification_modal.php'; ?>
																				<?php elseif ($currentTime < $dateOfresidence) : ?>
																					<a type="button" data-toggle="modal" href="#purpose_brgy_cert<?= $row['id_resident'] ?>" class="btn btn-link btn-warning" onclick="return showConfirmation(event)" data-original-title="Generate Certificate">
																						<i class="fas fa-file-alt"></i>
																					</a>
																					<?php include 'resident_certification_modal.php'; ?>
																				<?php endif ?>
																			<?php else : ?>
																				<a type="button" onclick="showCheck_chairman_secretary()" data-toggle="modal" class="btn btn-link btn-danger" data-original-title="Generate Certificate">
																					<i class="fas fa-file-alt"></i>
																				</a>
																			<?php endif ?>
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
			<!-- <div class="modal fade" id="purpose_brgy_cert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Create Purok</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="POST" action="generate_brgy_cert.php">
								<div class="form-group">
									<label>Amount<span class="text-danger"><b> *</b></span></label>
									<input type="text" class="form-control" placeholder="Enter amount" name="amount" onkeypress="return isNumberKey(event)" required></input>
								</div>
								<div class="form-group">
									<label>Date Issued<span class="text-danger"><b> *</b></span></label>
									<input type="date" class="form-control" name="date_issued" value="<?= date('Y-m-d') ?>" disabled></input>
								</div>
								<div class="form-group">
									<label>Transaction details<span class="text-danger"><b> *</b></span></label>
									<textarea class="form-control" onkeypress="return onlyAlphabets(event);" name="details" required>Barangay Clearance</textarea>
								</div>
								<hr>
								<div class="form-group">
									<label>Purpose<span class="text-danger"><b> *</b></span></label>
									<textarea class="form-control" onkeypress="return onlyAlphabets(event);" placeholder="E.g. employment" name="purpose" required></textarea>
								</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Create</button>
						</div>
						</form>
					</div>
				</div>
			</div> -->

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

		function isNumberKey(evt) {
			var charCode = (evt.which) ? evt.which : event.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
			return true;
		}

		function onlyAlphabets(evt) {
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8 || charCode == 9 || charCode == 32) {
				return true;
			}
			return false;
		}

		function showConfirmation(event) {
			var result = confirm("This resident has not lived in this barangay for more than six months. Do you want to proceed?");
			if (result) {
				return true; // Allow the default behavior (opening the modal)
			} else {
				event.stopPropagation(); // Prevent event propagation to stop modal from opening
				event.preventDefault(); // Prevent the default behavior of the anchor tag
				return false;
			}
		}

		function showCheck_chairman_secretary() {
			// swal("Please make sure the Barangay Chairman and the other officials are properly set in the Brgy Officials and Staff menu.", {
			// 	title: "Warning!",
			// 	buttons: false,
			// 	timer: 3000,
			// 	icon: "warning",
			// });
			const el = document.createElement('div')
			el.innerHTML = "Please make sure the Barangay Chairman and the other officials are properly set in the <a href='officials.php'>Brgy Officials and Staff</a>!"

			swal({
				title: "Warning!",
				content: el,
				buttons: false,
				timer: 4000,
				icon: "warning",
			})
		}
	</script>
</body>

</html>