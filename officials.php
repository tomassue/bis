<?php include 'server/server.php' ?>
<?php
if (isset($_SESSION['role'])) {
	if ($_SESSION['role'] == 'staff') {
		$off_q = "SELECT *,tblofficials.id_officials as id, tblposition.id_position as pos_id FROM tblofficials JOIN tblposition ON tblposition.id_position=tblofficials.id_position  WHERE `status`='Incumbent' AND `archive`='0' ORDER BY tblposition.order ASC ";
	} else {
		$off_q = "SELECT *,tblofficials.id_officials as id, tblposition.id_position as pos_id FROM tblofficials JOIN tblposition ON tblposition.id_position=tblofficials.id_position WHERE `archive`='0' ORDER BY tblposition.order ASC, `status` ASC ";
	}
} else {
	$off_q = "SELECT *,tblofficials.id_officials as id, tblposition.id_position as pos_id FROM tblofficials JOIN tblposition ON tblposition.id_position=tblofficials.id_position  WHERE `status`='Incumbent' AND `archive`='0' ORDER BY tblposition.order DESC ";
}

$res_o = $conn->query($off_q);

$official = array();
while ($row = $res_o->fetch_assoc()) {
	$official[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'templates/header.php' ?>
	<title>ABIS | Brgy Officials and Staff</title>
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
								<h2 class="text-white fw-bold">Barangay Officials</h2>
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
					<div class="row mt--2">

						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="d-flex flex-wrap pb-2 justify-content-between">
										<div class="px-2 pb-2 pb-md-0 text-center">
											<img src="assets/uploads/<?= $brgy_logo ?>" class="img-fluid" width="100">
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<h2 class="fw-bold mt-3"><?= ucwords($brgy) ?></h2>
											<h4 class="fw-bold mt-3"><i><?= ucwords($town) ?></i></h4>
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<img src="assets/img/brgy-logo.png" class="img-fluid" width="100" style="visibility:hidden;">
										</div>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Current Barangay Officials</div>
										<?php if (isset($_SESSION['username'])) : ?>
											<div class="card-tools">
												<?php if ($_SESSION['role'] == 'administrator') : ?>
													<a href="model/archive_officials.php" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to archive the BRGY OFFICIALS?')">
														<i class="fas fa-file-archive"></i>&nbsp
														Archive
													</a>
												<?php endif; ?>
												<!-- <a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm"> -->
												<a href="#add" data-toggle="modal" class="btn btn-info btn-sm">
													<i class="fa fa-plus"></i>&nbsp
													Official
												</a>
											</div>
										<?php endif ?>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped">
											<thead>
												<tr>
													<th scope="col">Fullname</th>
													<th scope="col">Chairmanship</th>
													<th scope="col">Position</th>
													<?php if (isset($_SESSION['username'])) : ?>
														<?php if ($_SESSION['role'] == 'administrator') : ?>
															<th>Status</th>
														<?php endif ?>
														<th>Action</th>
													<?php endif ?>
												</tr>
											</thead>
											<tbody>
												<?php if (!empty($official)) : ?>
													<?php foreach ($official as $row) : ?>
														<tr>
															<td class="text-uppercase"><?= $row['honorifics'] ?> <?= $row['name'] ?></td>
															<td style="width: 50%;">
																<?php
																$id_official = $row['id_officials'];
																$query_get_chair = "SELECT * FROM tblofficials_chairmanships JOIN tblchairmanship ON tblchairmanship.id_chairmanship=tblofficials_chairmanships.id_chairmanship WHERE `id_officials` = '$id_official'";
																$result_get_chair = $conn->query($query_get_chair);

																$get_chair = array();
																while ($chair_row = $result_get_chair->fetch_assoc()) {
																	$get_chair[] = $chair_row;
																}

																if (!empty($get_chair)) {
																	foreach ($get_chair as $get_chair_row) {
																?>
																		<span class="badge badge-pill badge-secondary mt-1 mb-1"><?= $get_chair_row['title'] ?></span>
																<?php
																	}
																}
																?>
															</td>
															<td><?= $row['position'] ?></td>
															<?php if (isset($_SESSION['username'])) : ?>
																<?php if ($_SESSION['role'] == 'administrator') : ?>
																	<td><?= $row['status'] == 'Incumbent' ? '<span class="badge badge-primary">Incumbent</span>' : '<span class="badge badge-danger">Inactive</span>' ?></td>
																<?php endif ?>
																<td>
																	<a type="button" href="#edit<?= $row['id_officials'] ?>" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Position">
																		<i class="fa fa-edit"></i>
																	</a>
																	<?php include 'officials_edit_form_modal.php' ?>

																	<!--This is for removing-->
																	<!-- <?php if ($_SESSION['role'] == 'administrator') : ?> -->
																	<!-- <a type="button" data-toggle="tooltip" href="model/remove_official.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this official?');" class="btn btn-link btn-danger" data-original-title="Remove">
																		<i class="fa fa-times"></i>
																	</a> -->
																	<!-- <?php endif ?> -->
																</td>
															<?php endif ?>
														</tr>
													<?php endforeach ?>
												<?php else : ?>
													<tr>
														<td colspan="5" class="text-center">No Available Data</td>
													</tr>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
													<th scope="col">Fullname</th>
													<th scope="col">Chairmanship</th>
													<th scope="col">Position</th>
													<?php if (isset($_SESSION['username'])) : ?>
														<?php if ($_SESSION['role'] == 'administrator') : ?>
															<th>Status</th>
														<?php endif ?>
														<th>Action</th>
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
			<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Create Official</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="POST" action="model/save_official.php">
								<div class="form-group">
									<label>Fullname<span class="text-danger"><b> *</b></span></label>
									<div class="row">
										<div class="col-md-3">
											<small id="housenumHelp" class="form-text text-muted"><b>Ex. </b>Hon. or Ms.</small>
											<select class="form-control" id="honorifics" name="honorifics" required>
												<option value="Hon.">Hon.</option>
												<option value="Ms.">Ms.</option>
											</select>
										</div>
										<div class="col-md-9">
											<small id="housenumHelp" class="form-text text-muted"><b>Ex. </b>John J. Doe</small>
											<input type="text" class="form-control" placeholder="Enter Fullname" name="name" required oninput="this.value = this.value.replace(/[^A-z\s.-]/g, '').replace(/(\..*)\./g, '$1');">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Chairmanship</label>
									<div class="overflow-auto" style="max-height: 300px; margin-bottom: 10px; overflow:scroll; -webkit-overflow-scrolling: touch;">
										<div class="selectgroup selectgroup-pills">
											<?php foreach ($chair as $row) : ?>
												<label class="selectgroup-item">
													<input type="checkbox" name="chairmanship[]" value="<?= $row['id_chairmanship'] ?>" class="selectgroup-input">
													<span class="selectgroup-button"><?= $row['title'] ?></span>
												</label>
											<?php endforeach ?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Position<span class="text-danger"><b> *</b></span></label>
									<select class="form-control" id="pillSelect" required name="position">
										<option disabled selected>Select Official Position</option>
										<?php foreach ($position as $row) : ?>
											<option value="<?= $row['id_position'] ?>"><?= $row['position'] ?></option>
										<?php endforeach ?>
									</select>
								</div>
								<div class="form-group">
									<label>Term Start<span class="text-danger"><b> *</b></span></label>
									<input type="date" class="form-control" name="start" required>
								</div>
								<div class="form-group">
									<label>Term End<span class="text-danger"><b> *</b></span></label>
									<input type="date" class="form-control" name="end" required>
								</div>
								<div class="form-group">
									<label>Status<span class="text-danger"><b> *</b></span></label>
									<select class="form-control" id="pillSelect" required name="status">
										<option value="Incumbent">Incumbent</option>
										<option value="Inactive">Inactive</option>
									</select>
								</div>

						</div>
						<div class="modal-footer">
							<input type="hidden" id="pos_id" name="id">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Create</button>
						</div>
						</form>
					</div>
				</div>
			</div>

			<!-- Modal -->
			<!-- <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Edit Official</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="POST" action="model/edit_official.php">
								<div class="form-group">
									<label>Fullname</label>
									<div class="row">
										<div class="col-md-4">
											<small id="housenumHelp" class="form-text text-muted"><b>Ex. </b>Hon. or Ms.</small>
											<select class="form-control" id="honorifics" name="honorifics" required>
												<option value="Hon.">Hon.</option>
												<option value="Ms.">Ms.</option>
											</select>
										</div>
										<div class="col-md-8">
											<small id="housenumHelp" class="form-text text-muted"><b>Ex. </b>John J. Doe</small>
											<input type="text" class="form-control" placeholder="Enter Fullname" id="name" name="name" required>
										</div>
									</div>
									
								</div>
								<div class="form-group">
									<label>Chairmanship<span class="text-danger"><b> *</b></span></label>
									<div class="overflow-auto" style="max-height: 300px; margin-bottom: 10px; overflow:scroll; -webkit-overflow-scrolling: touch;">
										<div class="selectgroup selectgroup-pills">
											<?php foreach ($chair as $row) : ?>
												<label class="selectgroup-item">
													<input type="checkbox" name="chairmanship[]" value="<?= $row['id_chairmanship'] ?>" class="selectgroup-input">
													<span class="selectgroup-button"><?= $row['title'] ?></span>
												</label>
											<?php endforeach ?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Position</label>
									<select class="form-control" id="position" required name="position">
										<option disabled selected>Select Official Position</option>
										<?php foreach ($position as $row) : ?>
											<option value="<?= $row['id_position'] ?>">Brgy. <?= $row['position'] ?></option>
										<?php endforeach ?>
									</select>
								</div>
								<div class="form-group">
									<label>Term Start</label>
									<input type="date" class="form-control" id="start" name="start" required>
								</div>
								<div class="form-group">
									<label>Term End</label>
									<input type="date" class="form-control" id="end" name="end" required>
								</div>
								<div class="form-group">
									<label>Status</label>
									<select class="form-control" id="status" required name="status">
										<option value="Incumbent">Incumbent</option>
										<option value="Inactive">Inactive</option>
									</select>
								</div>

						</div>
						<div class="modal-footer">
							<input type="text" id="off_id" name="id">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Update</button>
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
</body>

</html>