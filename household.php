<?php include 'server/server.php' ?>
<?php
$sql = "SELECT * FROM tblresident2";
$result = $conn->query($sql);

$resident = array();
while ($row = $result->fetch_assoc()) {
	$resident[] = $row;
}

$query1 = "SELECT * FROM tbl_household ORDER BY household_number ASC";
$result1 = $conn->query($query1);
$hosuehold = array();
while ($row = $result1->fetch_assoc()) {
	$household[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'templates/header.php' ?>
	<link rel="stylesheet" href="assets/js/plugin/dataTables.dateTime.min.css">
	<link rel="stylesheet" href="assets/js/plugin/datatables/Buttons-1.6.1/css/buttons.dataTables.min.css">
	<title>Household - Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Household Number</h2>
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
										<div class="card-title">Household Informations</div>
										<div class="card-tools">
											<!-- <button class="btn btn-info btn-sm"> 
				                                <i class="fa fa-print"></i>
				                                Print
				                            </button> -->

											<!-- <a href="#add" data-toggle="modal" class="btn btn-info btn-sm"><i class="fa fa-print"></i>&nbspPrint</a> -->
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="row mb-3 w-50">
										<!-- <div class="col">
											<label>Minimum Date</label>
											<input type="text" class="form-control" placeholder="Enter date" id="min">
										</div>
										<div class="col">
											<label>Maximum Date</label>
											<input type="text" class="form-control" placeholder="Enter date" id="max">
										</div> -->

										<div class="col-7">
											<div class="category-filter">
												<label>Household No.</label>
												<select id="categoryFilter" class="form-control">
													<option value="" selected>Show All</option>
													<?php foreach ($household as $row) : ?>
														<option value="<?= ucwords($row['household_number']) ?>"><?= $row['household_number'] ?></option>
													<?php endforeach ?>
												</select>
											</div>
										</div>
									</div>


									<div class="table-responsive">
										<table id="householdtable" class="display table table-striped">
											<thead>
												<tr class="text-center">
													<!-- <th scope="col" class="text-uppercase">Household No.</th> -->
													<th scope="col" class="text-uppercase">Last Name<br>(1.1)</th>
													<th scope="col" class="text-uppercase">First Name<br>(1.2)</th>
													<th scope="col" class="text-uppercase">Middle Name<br>(1.3)</th>
													<th scope="col" class="text-uppercase">Ext<br>(1.4)</th>
													<th scope="col" class="text-uppercase">No.<br>(2.1)</th>
													<th scope="col" class="text-uppercase">Street Name<br>(2.2)</th>
													<th scope="col" class="text-uppercase">Name of Subdivision/Zone/Sitio/Purok (if applicable)<br>(2.3)</th>
													<th scope="col" class="text-uppercase">Place of Birth<br>(3)</th>
													<th scope="col" class="text-uppercase">Date of Birth<br>(4)</th>
													<th scope="col" class="text-uppercase">Sex<br>(5)</th>
													<th scope="col" class="text-uppercase">Civil Status<br>(6)</th>
													<th scope="col" class="text-uppercase">Citizenship<br>(7)</th>
													<th scope="col" class="text-uppercase">Occupation<br>(8)</th>
													<th scope="col" class="text-uppercase">Family Head</th>
												</tr>
											</thead>
											<tbody>
												<?php if (!empty($resident)) : ?>
													<?php $no = 1;
													foreach ($resident as $row) : ?>
														<tr>
															<!-- <td>
															<?php
															$h_id = $row['householdnumber'];
															$queryHouseholdNumber = "SELECT * FROM tbl_household WHERE id_household='$h_id'";
															$resultHouseholdNumber = $conn->query($queryHouseholdNumber);
															$householdnum = $resultHouseholdNumber->fetch_assoc();

															echo $householdnum['household_number'];
															?>
														</td> -->
															<td><?= $row['lastname'] ?></td>
															<td><?= $row['firstname'] ?></td>
															<td><?= $row['middlename'] ?></td>
															<td><?= $row['ext'] ?></td>
															<td>
																<?php
																$h_id = $row['id_household'];
																$queryHouseholdNumber = "SELECT * FROM tbl_household WHERE id_household='$h_id'";
																$resultHouseholdNumber = $conn->query($queryHouseholdNumber);
																$householdnum = $resultHouseholdNumber->fetch_assoc();

																echo $householdnum['household_number'];
																?>
															</td>
															<td>
																<?php
																$h_id = $row['id_household'];
																$queryHouseholdNumber = "SELECT * FROM tbl_household WHERE id_household='$h_id'";
																$resultHouseholdNumber = $conn->query($queryHouseholdNumber);
																$householdnum = $resultHouseholdNumber->fetch_assoc();

																echo $householdnum['household_street_name'];
																?>
															</td>
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

																if (empty($householdnum['household_address'])) {
																	echo $pname['purok_name'];
																} else {
																	echo $pname['purok_name'] . ', ' . $householdnum['household_address'];
																}
																?>
															</td>
															<td><?= $row['birthplace'] ?></td>
															<td><?= $row['birthdate'] ?></td>
															<td><?= $row['sex'] ?></td>
															<td><?= ucwords($row['civilstatus']) ?></td>
															<td><?= $row['citizenship'] ?></td>
															<td><?= $row['occupation'] ?></td>
															<td>
																<?php
																if ($row['family_head'] == 'yes') {
																	echo ucwords($row['family_head']);
																} elseif ($row['family_head'] == 'no') {
																	echo ucwords($row['family_head']);
																} elseif (empty($row['family_head'])) {
																	echo "No";
																}
																?>
															</td>
														</tr>
													<?php $no++;
													endforeach ?>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr class="text-center">
													<!-- <th scope="col" class="text-uppercase">Household No.</th> -->
													<th scope="col" class="text-uppercase">Last Name<br>(1.1)</th>
													<th scope="col" class="text-uppercase">First Name<br>(1.2)</th>
													<th scope="col" class="text-uppercase">Middle Name<br>(1.3)</th>
													<th scope="col" class="text-uppercase">Ext<br>(1.4)</th>
													<th scope="col" class="text-uppercase">No.<br>(2.1)</th>
													<th scope="col" class="text-uppercase">Street Name<br>(2.2)</th>
													<th scope="col" class="text-uppercase">Name of Subdivision/Zone/Sitio/Purok (if applicable)<br>(2.3)</th>
													<th scope="col" class="text-uppercase">Place of Birth<br>(3)</th>
													<th scope="col" class="text-uppercase">Date of Birth<br>(4)</th>
													<th scope="col" class="text-uppercase">Sex<br>(5)</th>
													<th scope="col" class="text-uppercase">Civil Status<br>(6)</th>
													<th scope="col" class="text-uppercase">Citizenship<br>(7)</th>
													<th scope="col" class="text-uppercase">Occupation<br>(8)</th>
													<th scope="col" class="text-uppercase">Family Head</th>
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
		//var minDate, maxDate;

		// Custom filtering function which will search data in column four between two values
		// $.fn.dataTable.ext.search.push(
		// 	function( settings, data, dataIndex ) {
		// 		var min = minDate.val();
		// 		var max = maxDate.val();
		// 		var date = new Date( data[0] );

		// 		if (
		// 			( min === null && max === null ) ||
		// 			( min === null && date <= max ) ||
		// 			( min <= date   && max === null ) ||
		// 			( min <= date   && date <= max )
		// 		) {
		// 			return true;
		// 		}
		// 		return false;
		// 	}
		// );

		// $(document).ready(function() {
		// 	 Create date inputs
		// 	 minDate = new DateTime($('#min'), {
		// 		format: 'MMMM Do YYYY'
		// 	});
		// 	maxDate = new DateTime($('#max'), {
		// 		format: 'MMMM Do YYYY'
		// 	});

		// var table = $('#householdtable').DataTable({
		// "order": [[ 0, "desc" ]],
		// dom: 'Bfrtip',
		// buttons: [
		// 	'print'
		// ]
		// });

		//cment
		// Refilter the table
		// $('#min, #max').on('change', function () {
		// 	table.draw();
		// });


		$(document).ready(function() {

			$("#householdtable").dataTable({
				"searching": true,
				"order": [
					[4, "asc"]
				],
				dom: 'Bfrtip',
				buttons: [
					'copy', 'excel'
				]
			});

			//Get a reference to the new datatable
			var table = $('#householdtable').DataTable();
			//Take the category filter drop down and append it to the datatables_filter div. 
			//You can use this same idea to move the filter anywhere withing the datatable that you want.
			//$("#householdtable_filter.dataTables_filter").append($("#categoryFilter"));

			//Get the column index for the Category column to be used in the method below ($.fn.dataTable.ext.search.push)
			//This tells datatables what column to filter on when a user selects a value from the dropdown.
			//It's important that the text used here (Category) is the same for used in the header of the column to filter
			var categoryIndex = 4;
			$("#householdtable th").each(function(i) {
				if ($($(this)).html() == "Category") {
					categoryIndex = i;
					return false;
				}
			});

			//Use the built in datatables API to filter the existing rows by the Category column
			$.fn.dataTable.ext.search.push(
				function(settings, data, dataIndex) {
					var selectedItem = $('#categoryFilter').val()
					var category = data[categoryIndex];

					if (selectedItem === "" || selectedItem == category) {
						return true;
					}
					return false;
				}
			);

			//Set the change event for the Category Filter dropdown to redraw the datatable each time
			//a user selects a new filter.
			$("#categoryFilter").change(function(e) {
				table.draw();
			});

			table.draw();
		});
	</script>
</body>

</html>