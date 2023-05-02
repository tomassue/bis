<?php include 'server/server.php' ?>
<?php
// $query = "SELECT * FROM tbl_special_permit";
$query = "SELECT *, tbl_special_permit.id_special_permit  as id, tbl_users.id_user as user_id FROM tbl_special_permit JOIN tbl_users ON tbl_users.id_user=tbl_special_permit.id_user";
$result = $conn->query($query);

$permit = array();
while ($row = $result->fetch_assoc()) {
	$permit[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'templates/header.php' ?>
	<title>Special Permit Issuance - Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Special Permit</h2>
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
										<div class="card-title">Special Permit</div>
										<?php if (isset($_SESSION['username'])) : ?>
											<div class="card-tools">
												<a href="#add" data-toggle="modal" class="btn btn-info btn-sm">
													<i class="fa fa-plus"></i>
													Special Permit
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
													<th scope="col">Grantee</th>
													<th scope="col">Representative</th>
													<th scope="col">Action</th>
													<th scope="col">Date Applied</th>
													<th scope="col">Date of Issue</th>
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
															<td><?= ucwords($row['grantee']) ?></td>
															<td><?= $row['representative'] ?></td>
															<td><?= $row['action'] ?></td>
															<td><?= $row['start_date'] . '-' . $row['end_date'] ?></td>
															<td><?= $row['issued_date'] ?></td>
															<td><?= $row['user_username'] ?></td>
															<?php if (isset($_SESSION['username'])) : ?>
																<td>
																	<div class="form-button-action">
																		<a type="button" data-toggle="modal" href="#special_permit<?= $row['id_special_permit'] ?>" class="btn btn-link btn-primary" data-original-title="Generate Special Permit">
																			<i class="fas fa-file-alt"></i>
																		</a>
																		<?php include 'special_permit_modal.php' ?>
																		<?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'administrator') : ?>
																			<!-- <a type="button" data-toggle="tooltip" href="model/remove_special_permit.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this special permit?');" class="btn btn-link btn-danger" data-original-title="Remove">
																	<i class="fa fa-times"></i> -->
																			</a>
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
													<th scope="col">Grantee</th>
													<th scope="col">Representative</th>
													<th scope="col">Action</th>
													<th scope="col">Date Applied</th>
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

			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->

			<!-- Add Modal -->
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
							<form method="POST" action="model/save_special_permit.php">
								<div class="form-group">
									<label>Grantee<span class="text-danger"><b> *</b></span></label>
									<input type="text" class="form-control" onkeypress="return onlyAlphabets(event)" placeholder="Enter Business Name" name="grantee" required>
								</div>
								<div class="form-group">
									<label>Representative<span class="text-danger"><b> *</b></span></label>
									<input type="text" class="form-control mb-2" onkeypress="return onlyAlphabets(event)" placeholder="Enter Owner Name" name="representative" required>
								</div>
								<div class="form-group">
									<label>Action<span class="text-danger"><b> *</b></span></label>
									<textarea class="form-control" name="action" placeholder="To function..." required></textarea>
									<small class="form-text text-muted text-dark">NOTE: Don't put a period (.) at the end of the sentence.</small>
								</div>
								<div class="form-group">
									<label>Starting Date<span class="text-danger"><b> *</b></span></label>
									<input type="date" class="form-control" name="start_date" required>
								</div>
								<div class="form-group">
									<label>Expiration Date<span class="text-danger"><b> *</b></span></label>
									<input type="date" class="form-control" name="end_date" required>
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