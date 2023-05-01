<?php include 'server/server.php' ?>
<?php
$sql = "SELECT *, 
	tbl_users.id_user as user_id
	FROM tbl_transactions 
	JOIN tbl_users ON tbl_users.id_user=tbl_transactions.id_user 
	ORDER BY tbl_transactions.date_transact DESC";
// $sql = "SELECT * FROM tbl_transactions";
$result = $conn->query($sql);

$transactions = array();
while ($row = $result->fetch_assoc()) {
	$transactions[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'templates/header.php' ?>
	<link rel="stylesheet" href="assets/js/plugin/dataTables.dateTime.min.css">
	<link rel="stylesheet" href="assets/js/plugin/datatables/Buttons-1.6.1/css/buttons.dataTables.min.css">
	<title>Transactions - Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Transactions</h2>
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
										<div class="card-title">Transactions</div>
									</div>
								</div>
								<div class="card-body">
									<div class="row mb-3 w-50">
										<div class="col">
											<label>Start Date</label>
											<input type="text" class="form-control" placeholder="Enter date" id="min">
										</div>
										<div class="col">
											<label>End Date</label>
											<input type="text" class="form-control" placeholder="Enter date" id="max">
										</div>
									</div>
									<div class="table-responsive">
										<table id="transactiontable" class="display table table-striped">
											<thead>
												<tr>
													<th scope="col">Date</th>
													<th scope="col">Transaction No.</th>
													<th scope="col">Name</th>
													<th scope="col">Details</th>
													<th scope="col">Amount Paid</th>
													<th scope="col">Username</th>
												</tr>
											</thead>
											<tbody>
												<?php if (!empty($transactions)) : ?>
													<?php $no = 1;
													foreach ($transactions as $row) : ?>
														<tr>
															<?php
															$transact_date = strtotime($row['date_transact']);
															$date_transact = date("F j, Y, g:i a", $transact_date);
															?>
															<td><?= $date_transact ?></td>
															<td><?= $row['transact_no'] ?></td>
															<td><?= $row['recipient_name'] ?></td>
															<td><?= $row['details_transact'] ?></td>
															<td>
																<?php
																if ($row['id_payments'] == '0') {
																	echo 'None';
																} else {
																	$id_payments = $row['id_payments'];

																	$query_payment = "SELECT * FROM tblpayments WHERE `id_payments`='$id_payments'";
																	$result_payment = $conn->query($query_payment);
																	$payment = $result_payment->fetch_assoc();

																	echo $payment['amounts'];
																}
																?>
															</td>
															<td><?= $row['user_username'] ?></td>
														</tr>
													<?php $no++;
													endforeach ?>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
													<th scope="col">Date</th>
													<th scope="col">Transaction No.</th>
													<th scope="col">Name</th>
													<th scope="col">Details</th>
													<th scope="col">Amount Paid</th>
													<th scope="col">Username</th>
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
	<script>
		var minDate, maxDate;

		// Custom filtering function which will search data in column four between two values
		$.fn.dataTable.ext.search.push(
			function(settings, data, dataIndex) {
				var min = minDate.val();
				var max = maxDate.val();
				var date = new Date(data[0]);

				if (
					(min === null && max === null) ||
					(min === null && date <= max) ||
					(min <= date && max === null) ||
					(min <= date && date <= max)
				) {
					return true;
				}
				return false;
			}
		);

		$(document).ready(function() {
			// Create date inputs
			minDate = new DateTime($('#min'), {
				format: 'MMMM Do YYYY'
			});
			maxDate = new DateTime($('#max'), {
				format: 'MMMM Do YYYY'
			});

			var table = $('#transactiontable').DataTable({
				"order": [
					[0, "desc"]
				],
				dom: 'Bfrtip',
				buttons: [
					'print'
				]
			});

			// Refilter the table
			$('#min, #max').on('change', function() {
				table.draw();
			});
		});
	</script>
</body>

</html>