<?php include 'server/server.php' ?>

<?php if ($_SESSION['role'] == 'administrator') : ?>
	<?php
	// $query = "SELECT * FROM tbl_nature_of_case";
	$query  = "SELECT *, tbl_nature_of_case.noc_id as id, tbl_users.id_user as user_id FROM tbl_nature_of_case JOIN tbl_users ON tbl_users.id_user=tbl_nature_of_case.id_user";
	$result = $conn->query($query);

	$noc = array();
	while ($row = $result->fetch_assoc()) {
		$noc[] = $row;
	}
	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<?php include 'templates/header.php' ?>
		<title>Nature of Case - Barangay Management System</title>
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
									<h2 class="text-white fw-bold">Settings</h2>
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
											<div class="card-title">Nature of Case</div>
											<div class="card-tools">
												<!-- <a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm"> -->
												<a href="#add" data-toggle="modal" class="btn btn-info btn-sm">
													<i class="fa fa-plus"></i>&nbsp
													Nature of Case
												</a>
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
														<th scope="col">No.</th>
														<th scope="col">Name</th>
														<th scope="col">Details</th>
														<th scope="col">Username</th>
														<th scope="col">Updated</th>
													</tr>
												</thead>
												<tbody>
													<?php if (!empty($noc)) : ?>
														<?php $no = 1;
														foreach ($noc as $row) : ?>
															<tr>
																<td><?= $no ?></td>
																<td><?= $row['noc_name'] ?></td>
																<td><?= $row['noc_details'] ?></td>
																<td><?= $row['user_username'] ?></td>
																<td><?= $row['noc_updated_at'] ?></td>
																<td>
																	<div class="form-button-action">
																		<a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Title" onclick="editNoc(this)" data-noc_name="<?= $row['noc_name'] ?>" data-noc_details="<?= $row['noc_details'] ?>" data-id="<?= $row['noc_id'] ?>">
																			<i class="fa fa-edit"></i>
																		</a>
																		<!-- <a type="button" data-toggle="tooltip" href="model/remove_chair.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this title?');" 
																	class="btn btn-link btn-danger" data-original-title="Remove">
																	<i class="fa fa-times"></i>
																</a> -->
																	</div>
																</td>
															</tr>
														<?php $no++;
														endforeach ?>
													<?php else : ?>
														<tr>
															<td colspan="3" class="text-center">No Available Data</td>
														</tr>
													<?php endif ?>
												</tbody>
												<tfoot>
													<tr>
														<th scope="col">No.</th>
														<th scope="col">Name</th>
														<th scope="col">Details</th>
														<th scope="col">Username</th>
														<th scope="col">Updated</th>
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
				<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Add New Nature of Case</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="POST" action="model/save_nature_of_case.php">
									<div class="form-group">
										<label>Nature of Case</label>
										<input type="text" class="form-control" placeholder="Enter nature of case" name="noc_name" required>
									</div>
									<div class="form-group">
										<label>Details</label>
										<textarea class="form-control" name="noc_details" placeholder="Enter details here..."></textarea>
										<small id="noc_detailsHelp" class="form-text text-muted"><b>E.g., </b>Description of the nature of case</small>
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

				<!-- Modal -->
				<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Edit Nature of Case</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="POST" action="model/edit_nature_of_case.php">
									<div class="form-group">
										<label>Nature of Case</label>
										<input type="text" class="form-control" placeholder="Enter nature of case" name="noc_name" id="noc_name" required>
									</div>
									<div class="form-group">
										<label>Details</label>
										<textarea class="form-control" name="noc_details" id="noc_details" placeholder="Enter details here..."></textarea>
										<small id="noc_detailsHelp" class="form-text text-muted"><b>E.g., </b>Description of the nature of case</small>
									</div>

							</div>
							<div class="modal-footer">
								<input type="hidden" id="noc_id" name="noc_id">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Update</button>
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
	</body>

	</html>
<?php else : ?>
	<?php header("Location: index.php"); ?>
<?php endif; ?>