<?php include 'server/server.php' ?>
<?php
// $query = "SELECT * FROM tbl_cert_appearance";
$query = "SELECT *, tbl_cert_appearance.id_cert_appearance as id, tbl_users.id_user as user_id FROM tbl_cert_appearance JOIN tbl_users ON tbl_users.id_user=tbl_cert_appearance.id_user";
$result = $conn->query($query);

$cert_appearance = array();
while ($row = $result->fetch_assoc()) {
	$cert_appearance[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'templates/header.php' ?>
	<title>Certificate of Appearance Issuance - Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Certificate of Appearance</h2>
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
										<div class="card-title">Certificate of Appearance</div>
										<?php if (isset($_SESSION['username'])) : ?>
											<div class="card-tools">
												<a href="#add" data-toggle="modal" class="btn btn-info btn-sm">
													<i class="fa fa-plus"></i>&nbsp
													Generate Certificate
												</a>
											</div>
										<?php endif ?>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="specialPermitTable" class="display table table-striped">
											<thead>
												<tr>
													<th scope="col">Name</th>
													<th scope="col">Venue</th>
													<th scope="col">Purpose</th>
													<th scope="col">Date</th>
													<th scope="col">Date of Issue</th>
													<th scope="col">User</th>
													<?php if (isset($_SESSION['username'])) : ?>
														<th scope="col">Action</th>
													<?php endif ?>
												</tr>
											</thead>
											<tbody>
												<?php if (!empty($cert_appearance)) : ?>
													<?php foreach ($cert_appearance as $row) : ?>
														<tr>
															<td><?= ucwords($row['name']) ?></td>
															<td><?= $row['venue'] ?></td>
															<td><?= $row['purpose'] ?></td>
															<td><?= $row['date'] ?></td>
															<td><?= $row['created_at'] ?></td>
															<td><?= $row['user_username'] ?></td>
															<?php if (isset($_SESSION['username'])) : ?>
																<td>
																	<div class="form-button-action">
																		<a type="button" data-toggle="modal" href="#cert_appearance<?= $row['id_cert_appearance'] ?>" class="btn btn-link btn-primary" data-original-title="Generate Certificate of Appearance">
																			<i class="fas fa-file-alt"></i>
																		</a>
																		<?php include 'certificate_appearance_modal.php' ?>
																		<?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'administrator') : ?>
																			<!-- <a type="button" data-toggle="tooltip" href="model/remove_cert_appearance.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this special permit?');" class="btn btn-link btn-danger" data-original-title="Remove">
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
													<th scope="col">Name</th>
													<th scope="col">Venue</th>
													<th scope="col">Purpose</th>
													<th scope="col">Date</th>
													<th scope="col">Date of Issue</th>
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

			<!-- Appearance Modal -->
			<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Create Certificate of Appearance</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="POST" action="model/save_cert_appearance.php">
								<div class="form-group">
									<label>Name<span class="text-danger"><b> *</b></span></label>
									<input type="text" class="form-control" onkeypress="return onlyAlphabets(event)" placeholder="Enter Name" name="name" required>
								</div>
								<div class="form-group">
									<label>Venue<span class="text-danger"><b> *</b></span></label>
									<input type="text" class="form-control mb-2" onkeypress="return onlyAlphabets(event)" placeholder="Enter Venue" name="venue" required>
								</div>
								<div class="form-group">
									<label>Date<span class="text-danger"><b> *</b></span></label>
									<input type="date" class="form-control" name="date" required>
								</div>
								<div class="form-group">
									<label>Purpose<span class="text-danger"><b> *</b></span></label>
									<textarea class="form-control" onkeypress="return onlyAlphabets(event)" placeholder="Enter purpose" name="purpose" required></textarea>
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
			$('#specialPermitTable').DataTable();
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
	</script>
</body>

</html>