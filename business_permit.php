<?php include 'server/server.php' ?>
<?php
// $query = "SELECT * FROM tblpermit";
$query = "SELECT *, tblpermit.id_permit as id, tbl_users.id_user as user_id FROM tblpermit JOIN tbl_users ON tbl_users.id_user=tblpermit.id_user";
$result = $conn->query($query);

$permit = array();
while ($row = $result->fetch_assoc()) {
	$permit[] = $row;
}

$query_check_chairman = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.id_position=tblposition.id_position WHERE tblposition.position='Barangay Chairman' AND `archive` = '0'";
$check_chairman = $conn->query($query_check_chairman)->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'templates/header.php' ?>
	<title>Resident Certificate Issuance - Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Construction Clearance</h2>
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

							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Construction Clearance Issuance</div>
										<?php if (isset($_SESSION['username'])) : ?>
											<div class="card-tools">
												<a href="#add" data-toggle="modal" class="btn btn-info btn-sm">
													<i class="fa fa-plus"></i>&nbsp
													Business Permit
												</a>
											</div>
										<?php endif ?>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="residenttable" class="display table table-striped">
											<thead>
												<tr>
													<th scope="col">Business/Entity</th>
													<th scope="col">Location</th>
													<th scope="col">Date Applied</th>
													<th scope="col">User</th>
													<?php if (isset($_SESSION['username'])) : ?>
														<th scope="col">Action</th>
													<?php endif ?>
												</tr>
											</thead>
											<tbody>
												<?php if (!empty($permit)) : ?>
													<?php foreach ($permit as $row) : ?>
														<tr>
															<td><?= ucwords($row['name']) ?></td>
															<td><?= ucwords($row['location']) ?></td>
															<td><?= $row['applied'] ?></td>
															<td><?= $row['user_username'] ?></td>
															<?php if (isset($_SESSION['username'])) : ?>
																<td>
																	<div class="form-button-action">
																		<?php if (!isset($check_chairman['status'])) : ?>
																			<a type="button" onclick="showCheck_chairman_secretary()" data-toggle="modal" class="btn btn-link btn-danger" data-original-title="Generate Permit">
																				<i class="fas fa-file-alt"></i>
																			</a>
																		<?php elseif (isset($check_chairman['status'])) : ?>
																			<?php if ($check_chairman['status'] == 'Incumbent') : ?>
																				<a type="button" data-toggle="modal" href="#business_permit<?= $row['id_permit'] ?>" class="btn btn-link btn-primary" data-original-title="Generate Permit">
																					<i class="fas fa-file-alt"></i>
																				</a>
																				<?php include 'business_permit_modal.php' ?>
																			<?php else : ?>
																				<a type="button" onclick="showCheck_chairman_secretary()" data-toggle="modal" class="btn btn-link btn-danger" data-original-title="Generate Permit">
																					<i class="fas fa-file-alt"></i>
																				</a>
																			<?php endif ?>
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
													<th scope="col">Business/Entity</th>
													<th scope="col">Location</th>
													<th scope="col">Date Applied</th>
													<th scope="col">User</th>
													<?php if (isset($_SESSION['username'])) : ?>
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

			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->

			<!-- Modal -->
			<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Create Business Permit</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="POST" action="model/save_permit.php">
								<div class="form-group">
									<label>Business/Entity Name</label>
									<input type="text" class="form-control" placeholder="Enter Business Name" name="name" required>
								</div>
								<div class="form-group">
									<label>Location</label>
									<input type="text" class="form-control mb-2" placeholder="Enter Location" name="location" required>
								</div>
								<div class="form-group">
									<label>Date Applied Nature</label>
									<input type="date" class="form-control" name="applied" value="<?= date('Y-m-d'); ?>" required>
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

		</div>
	</div>
	<?php include 'templates/footer.php' ?>
	<script src="assets/js/plugin/datatables/datatables.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#residenttable').DataTable();
		});

		function showCheck_chairman_secretary() {
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