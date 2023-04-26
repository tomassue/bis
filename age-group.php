<?php include 'server/server.php' ?>
<?php
// $sql = "SELECT * FROM tblpayments ORDER BY `time` DESC";
// $result = $conn->query($sql);

// $query = "SELECT *, tblresident.id as id, tblpurok.id as purok_id, tbl_org.id as org_id FROM tblresident JOIN tblpurok ON tblpurok.id=tblresident.purok JOIN tbl_org ON tbl_org.id=tblresident.organization";
$query = "SELECT * FROM tblresident2 WHERE resident_type=1";
$result = $conn->query($query);
$resident = array();
while ($row = $result->fetch_assoc()) {
	$resident[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'templates/header.php' ?>
	<link rel="stylesheet" href="assets/js/plugin/dataTables.dateTime.min.css">
	<link rel="stylesheet" href="assets/js/plugin/datatables/Buttons-1.6.1/css/buttons.dataTables.min.css">
	<title>Age Group - Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Age Group</h2>
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
										<div class="card-title">Age Group</div>
										<div class="card-tools">
											<a href="#add" data-toggle="modal" class="btn btn-info btn-sm"><i class="fa fa-print"></i>&nbspPrint</a>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="row mb-3 w-50">
										<div class="col">
											<label>Minimum Age</label>
											<input type="text" class="form-control" id="min" name="min" placeholder="Enter Age">
										</div>
										<div class="col">
											<label>Maximum Age</label>
											<input type="text" class="form-control" id="max" name="max" placeholder="Enter Age">
										</div>
									</div>
									<div class="table-responsive">
										<table id="agegrouptable" class="display table table-striped">
											<thead>
												<tr>
													<th scope="col">No. </th>
													<th scope="col">Fullname</th>
													<th scope="col">Birthday</th>
													<th scope="col">Age</th>
													<th scope="col">Address</th>
													<th scope="col">PWD</th>
												</tr>
											</thead>
											<tbody>
												<?php if (!empty($resident)) : ?>
													<?php $no = 1;
													foreach ($resident as $row) : ?>
														<tr>
															<td><?= $no ?></td>

															<td><?= $row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['ext'] ?></td>
															<td><?= $row['birthdate'] ?></td>
															<?php
															$DateOfBirth = $row['birthdate'];

															$dob = new DateTime($DateOfBirth);
															$now = new DateTime();
															$diff = $now->diff($dob);
															?>
															<td><?= $diff->y; ?></td>
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

																echo $householdnum['household_street_name'] . ', ' . $pname['purok_name'] . ', ' . $householdnum['household_address'] . ', ' . $brgy;
																?>
															</td>
															<td><?= $row['pwd'] ?></td>
														</tr>
													<?php $no++;
													endforeach ?>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
													<th scope="col">No. </th>
													<th scope="col">Full Name</th>
													<th scope="col">Birthday</th>
													<th scope="col">Age</th>
													<th scope="col">Address</th>
													<th scope="col">PWD</th>
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

			<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Create Purok</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="POST" action="generate_age_group.php">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Minimum Age</label>
											<input type="number" class="form-control" id="min" name="min" placeholder="Enter minimum age">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Maximum Age</label>
											<input type="number" class="form-control" id="max" name="max" placeholder="Enter minimum age">
										</div>
									</div>
								</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" name="submit" class="btn btn-primary">Print</button>
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
	<script src="assets/js/plugin/moment/moment.min.js"></script>
	<script src="assets/js/plugin/dataTables.dateTime.min.js"></script>
	<script src="assets/js/plugin/datatables/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="assets/js/plugin/datatables/Buttons-1.6.1/js/buttons.print.min.js"></script>

	<!-- START ONLINE DATATABLES -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/datatables.min.css" />

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/datatables.min.js"></script>
	<!-- END ONLINE DATATABLES -->


	<script>
		// var minDate, maxDate;
		var minAge, maxAge;

		// Custom filtering function which will search data in column four between two values
		$.fn.dataTable.ext.search.push(
			function(settings, data, dataIndex) {
				// var min = minDate.val();
				var min = parseInt($('#min').val(), 10)
				// var max = maxDate.val();
				var max = parseInt($('#max').val(), 10);
				// var date = parseFloat(data[3]) || 0; // use data for the age column
				var age = parseFloat(data[3]) || 0; // use data for the age column

				// 	if (
				// 		( min === null && max === null ) ||
				// 		( min === null && date <= max ) ||
				// 		( min <= date   && max === null ) ||
				// 		( min <= date   && date <= max )
				// 	) {
				// 		return true;
				// 	}
				// 	return false;
				// }
				if (
					(isNaN(min) && isNaN(max)) ||
					(isNaN(min) && age <= max) ||
					(min <= age && isNaN(max)) ||
					(min <= age && age <= max)
				) {
					return true;
				}
				return false;
			}
		);

		// $(document).ready(function() {
		// 	 // Create date inputs
		// 	 minDate = new DateTime($('#min'), {
		// 		format: 'MMMM Do YYYY'
		// 	});
		// 	maxDate = new DateTime($('#max'), {
		// 		format: 'MMMM Do YYYY'
		// 	});

		var table = $('#agegrouptable').DataTable({
			"order": [
				[0, "asc"]
			],
			dom: 'Bfrtip',
			buttons: [
				'copy', 'excel'
			]
		});

		// Refilter the table cment dis awt
		// $('#min, #max').on('change', function () {
		// 	table.draw();
		// });


		$(document).ready(function() {
			var table = $('#agegrouptable').DataTable();


			// Event listener to the two range filtering inputs to redraw on input
			$('#min, #max').keyup(function() {
				table.draw();
			});
		});
	</script>
</body>

</html>