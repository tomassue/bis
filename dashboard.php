<?php include 'server/server.php' ?>
<?php

$query = "SELECT * FROM tblresident2 WHERE resident_type=1";
$result = $conn->query($query);
$total = $result->num_rows;

$query1 = "SELECT * FROM tblresident2 WHERE sex='Male' AND resident_type=1";
$result1 = $conn->query($query1);
$male = $result1->num_rows;

$query2 = "SELECT * FROM tblresident2 WHERE sex='Female' AND resident_type=1";
$result2 = $conn->query($query2);
$female = $result2->num_rows;

$query3 = "SELECT * FROM tblresident2 WHERE vstatus='Yes' AND resident_type=1";
$result3 = $conn->query($query3);
$totalvoters = $result3->num_rows;

$query4 = "SELECT * FROM tblresident2 WHERE vstatus='No' AND resident_type=1";
$non = $conn->query($query4)->num_rows;

$query5 = "SELECT * FROM tblpurok";
$purok = $conn->query($query5)->num_rows;

$query6 = "SELECT * FROM tblprecinct";
$precinct = $conn->query($query6)->num_rows;

$query7 = "SELECT * FROM tblblotter";
$blotter = $conn->query($query7)->num_rows;

$date = date('Y-m-d');
$query_trans = "SELECT * FROM tbl_transactions WHERE date(date_transact) = '$date'";
$result_trans = $conn->query($query_trans)->num_rows;
if ($result_trans > 0) {
	$query8 = "SELECT SUM(tblpayments.amounts) as am FROM tbl_transactions JOIN tblpayments ON tblpayments.id_payments=tbl_transactions.id_payments WHERE date(tbl_transactions.date_transact) ='$date'";
	$revenue = $conn->query($query8)->fetch_assoc();
} else {
}

$query9 = "SELECT * FROM tbl_household";
$household = $conn->query($query9)->num_rows;

$query10 = "SELECT * FROM tblresident2 WHERE id_org='1'";
$sc = $conn->query($query10)->num_rows;

$query11 = "SELECT * FROM tblresident2 WHERE pwd='Yes'";
$pwd = $conn->query($query11)->num_rows;

$query12 = "SELECT * FROM tblresident2 WHERE resident_type=0";
$deceased = $conn->query($query12)->num_rows;

$query13 = "SELECT * FROM tblresident2 WHERE indigent='Yes'";
$indigent = $conn->query($query13)->num_rows;

$query14 = "SELECT * FROM tbl_household WHERE household_type='apartment'";
$apartment = $conn->query($query14)->num_rows;

$query15 = "SELECT * FROM tbl_household WHERE household_type='residential'";
$residential = $conn->query($query15)->num_rows;

$query16 = "SELECT * FROM tbl_household WHERE household_type='boarding house'";
$board_house = $conn->query($query16)->num_rows;

$query17 = "SELECT * FROM tblpurok";
$result17 = $conn->query($query17);
$purok_list = array();
while ($row = $result17->fetch_assoc()) {
	$purok_list[] = $row;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'templates/header.php' ?>
	<title>Dashboard - Barangay Management System</title>
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
								<h2 class="text-white fw-bold">Dashboard</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--2">
					<?php if (isset($_SESSION['message'])) : ?>
						<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success'] == 'danger' ? 'bg-danger text-light' : null ?>" role="alert">
							<?php echo $_SESSION['message']; ?>
						</div>
						<?php unset($_SESSION['message']); ?>
					<?php endif ?>
					<div class="row">

						<!---------------------START ALERT CONTAINER FOR NEW SYSTEM SETTINGS----------------------------------->
						<?php
						$query_zone = "SELECT * FROM tblpurok";
						$count_zone = $conn->query($query_zone)->num_rows;

						$query_householdnumber = "SELECT * FROM tbl_household";
						$count_householdnumber = $conn->query($query_householdnumber)->num_rows;

						$query_org = "SELECT * FROM tbl_org";
						$count_org = $conn->query($query_org)->num_rows;

						$query_position = "SELECT * FROM tblposition";
						$count_position = $conn->query($query_position)->num_rows;

						$query_chairmanship = "SELECT * FROM tblchairmanship";
						$count_chairmanship = $conn->query($query_chairmanship)->num_rows;

						$query_noc = "SELECT * FROM tbl_nature_of_case";
						$count_noc = $conn->query($query_noc)->num_rows;

						$query_official = "SELECT * FROM tblofficials";
						$count_official = $conn->query($query_official)->num_rows;
						?>
						<?php if ($count_zone == 0 || $count_householdnumber == 0 || $count_org == 0 || $count_position == 0 || $count_chairmanship == 0 || $count_noc == 0 || $count_official == 0) : ?>
							<div class="col-md-12">
								<div class="card full-height alert alert-danger">
									<div class="card-body">
										<div class="card-title"><b>NOTICE!</b></div>
										<div class="card-category">Before using the system, certain things are need to be done to avoid any error. If you are not an administrator, have the administrator do these recommendations first.</div>
										<div class="card-body">
											<span class="fw-bold">Kindly locate settings (sidebar) then add data to these items:</span>
											<ul class="list-group pt-4">
												<li class="list-group-item">Click&nbsp<u><a href="#barangay" data-toggle="modal" style="color: black">Barangay Info</a></u>&nbspto edit or update barangay information.</li>
												<?php if ($count_zone > 0) : ?>
													<li class="list-group-item"><del>Click&nbsp<u><a href="purok.php" style="color: black">Zone</a></u>&nbspto add or edit zone/purok information.</li></del>
												<?php else : ?>
													<li class="list-group-item">Click&nbsp<u><a href="purok.php" style="color: black">Zone</a></u>&nbspto add or edit zone/purok information.</li>
												<?php endif; ?>

												<?php if ($count_householdnumber > 0) : ?>
													<li class="list-group-item"><del>Click&nbsp<u><a href="household_number.php" style="color: black">Household Number</a></u>&nbspto edit or update household number.&nbsp<b>Zone and Household Number is very important since it will be used to assign an address to each resident you are about to register.</b></del></li>
												<?php else : ?>
													<li class="list-group-item">Click&nbsp<u><a href="household_number.php" style="color: black">Household Number</a></u>&nbspto edit or update household number.&nbsp<b>Zone and Household Number is very important since it will be used to assign an address to each resident you are about to register.</b></li>
												<?php endif; ?>

												<?php if ($count_org > 0) : ?>
													<li class="list-group-item"><del>Click&nbsp<u><a href="organization_or_association.php" style="color: black">Organization/Association</a></u>&nbspto add or edit any recognized organization/association. For example,&nbsp<b>senior citizens</b>&nbspand&nbsp<b>SK</b>.</del></li>
												<?php else : ?>
													<li class="list-group-item">Click&nbsp<u><a href="organization_or_association.php" style="color: black">Organization/Association</a></u>&nbspto add or edit any recognized organization/association. For example,&nbsp<b>senior citizens</b>&nbspand&nbsp<b>SK</b></li>
												<?php endif; ?>

												<!-- <?php if ($count_position > 0) : ?>
											  	<li class="list-group-item"><del>Click&nbsp<u><a href="position.php" style="color: black">Positions</a></u>&nbspto add or edit positions you have in your barangay. For instance, barangay chairman, barangay kagawad, barangay secretary, etc..</li></del>
											  <?php else : ?>
											  	<li class="list-group-item">Click&nbsp<u><a href="position.php" style="color: black">Positions</a></u>&nbspto add or edit positions you have in your barangay. For instance, barangay chairman, barangay kagawad, barangay secretary, etc..</li>
											  <?php endif; ?> -->

												<?php if ($count_chairmanship > 0) : ?>
													<li class="list-group-item"><del>Click&nbsp<u><a href="chairmanship.php" style="color: black">Chairmanship</a></u>&nbspto add or edit chairmanship. For example, Committee on Education, Committee on Agriculture, etc..</li></del>
												<?php else : ?>
													<li class="list-group-item">Click&nbsp<u><a href="chairmanship.php" style="color: black">Chairmanship</a></u>&nbspto add or edit chairmanship. For example, Committee on Education, Committee on Agriculture, etc..</li>
												<?php endif; ?>

												<?php if ($count_noc > 0) : ?>
													<li class="list-group-item"><del>Click&nbsp<u><a href="nature_of_case.php" style="color: black">Nature of Case</a></u>&nbspto add or edit nature of case information. This is mainly needed when adding a blotter. For example, Light coercion, Physical Injury, Sexual Harrassment, etc.</del></li>
												<?php else : ?>
													<li class="list-group-item">Click&nbsp<u><a href="nature_of_case.php" style="color: black">Nature of Case</a></u>&nbspto add or edit nature of case information. This is mainly needed when adding a blotter. For example, Light coercion, Physical Injury, Sexual Harrassment, etc.</li>
												<?php endif; ?>
											</ul>
										</div>
									</div>
								</div>
							</div>
						<?php else : ?>
							<!---------------------END ALERT CONTAINER FOR NEW SYSTEM SETTINGS----------------------------------->


							<!--------------------------------------------------------------------- STARTS CHARTS HERE --------------------------------------------------------------->

							<div class="col-md-12">
								<div class="card full-height">
									<div class="card-body">
										<div class="card-title">Resident Count</div>
										<div class="card-category">Overall count of various categories a resident is associated with.</div>
										<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
											<div class="px-2 pb-2 pb-md-0 text-center">
												<div id="circles-1"></div>
												<a href="resident_info2.php?state=all" class="card-link" style="color:black;">
													<h6 class="fw-bold mt-3 mb-0">Total Population</h6>
												</a>
											</div>
											<div class="px-2 pb-2 pb-md-0 text-center">
												<div id="circles-2"></div>
												<a href="resident_info2.php?state=male" class="card-link" style="color:black;">
													<h6 class="fw-bold mt-3 mb-0">Male</h6>
												</a>
											</div>
											<div class="px-2 pb-2 pb-md-0 text-center">
												<div id="circles-3"></div>
												<a href="resident_info2.php?state=female" class="card-link" style="color:black;">
													<h6 class="fw-bold mt-3 mb-0">Female</h6>
												</a>
											</div>
											<div class="px-2 pb-2 pb-md-0 text-center">
												<div id="circles-4"></div>
												<a href="resident_info2.php?state=senior-citizens" class="card-link" style="color:black;">
													<h6 class="fw-bold mt-3 mb-0">Senior Citizens</h6>
												</a>
											</div>
											<div class="px-2 pb-2 pb-md-0 text-center">
												<div id="circles-5"></div>
												<a href="resident_info2.php?state=pwd" class="card-link" style="color:black;">
													<h6 class="fw-bold mt-3 mb-0">PWD</h6>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Male and Female (Percentage)</div>
									</div>
									<div class="card-body">
										<div class="chart-container">
											<canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Numbers of House Types by Household</div>
									</div>
									<div class="card-body">
										<div class="chart-container">
											<canvas id="barChart"></canvas>
										</div>
									</div>
								</div>
							</div>

					</div>
					<!--------------------------------------------------------------------- ENDS CHARTS HERE ---------------------------------------------------------------->

					<!-- 					<div class="row">

						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-primary bubble-shadow-small"  style="background-color:black;"	>
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<a href="resident_info2.php?state=all" class="card-link"><p class="card-category">Population</p></a>
												<h4 class="card-title"><?= number_format($total) ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-primary bubble-shadow-small"  style="background-color:black;"	>
												<i class="flaticon-user"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<a href="resident_info2.php?state=male" class="card-link"><p class="card-category">Male</p> </a>
												<h4 class="card-title"><?= number_format($male) ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-primary bubble-shadow-small"  style="background-color:black;"	>
												<i class="icon-user-female"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<a href="resident_info2.php?state=female" class="card-link"><p class="card-category">Female</p></a>
												<h4 class="card-title"><?= number_format($female) ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-primary bubble-shadow-small"  style="background-color:black;"	>
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<a href="resident_info2.php?state=senior-citizens" class="card-link"><p class="card-category">Senior Citizens</p></a>
												<h4 class="card-title"><?= number_format($sc) ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->

					<div class="row">

						<!-- <div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-primary bubble-shadow-small"  style="background-color:black;"	>
												<i class="fa fa-blind"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<a href="resident_info2.php?state=pwd" class="card-link"><p class="card-category">PWD</p></a>
												<h4 class="card-title"><?= number_format($pwd) ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> -->

						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-primary bubble-shadow-small" style="background-color:black;">
												<i class="fa fa-home"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<a href="household.php" class="card-link">
													<p class="card-category">Household</p>
												</a>
												<h4 class="card-title"><?= number_format($household) ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-primary bubble-shadow-small" style="background-color:black;">
												<i class="fa fa-people-carry"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<a href="resident_info2.php?state=deceased" class="card-link">
													<p class="card-category">Deceased</p>
												</a>
												<h4 class="card-title"><?= number_format($deceased) ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-primary bubble-shadow-small" style="background-color:black;">
												<i class="fas fa-user-friends"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<a href="resident_info2.php?state=indigent" class="card-link">
													<p class="card-category">Indigent</p>
												</a>
												<h4 class="card-title"><?= number_format($indigent) ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-primary bubble-shadow-small" style="background-color:black;">
												<i class="fas fa-fingerprint"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<a href="resident_info2.php?state=voters" class="card-link">
													<p class="card-category">Voters</p>
												</a>
												<h4 class="card-title"><?= number_format($totalvoters) ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>

					<?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'administrator') : ?>
						<div class="row">

							<div class="col-sm-6 col-md-3">
								<div class="card card-stats card-round">
									<div class="card-body ">
										<div class="row align-items-center">
											<div class="col-icon">
												<div class="icon-big text-center icon-primary bubble-shadow-small" style="background-color:black;">
													<i class="fas fa-question"></i>
												</div>
											</div>
											<div class="col col-stats ml-3 ml-sm-0">
												<div class="numbers">
													<a href="resident_info2.php?state=non_voters" class="card-link">
														<p class="card-category">Non Voters</p>
													</a>
													<h4 class="card-title"><?= number_format($non) ?></h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- <div class="col-md-4">
							<div class="card card-stats card-round" style="background-color:black;">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="flaticon-users" style="color:white;"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase" style="color:white;">Non Voters</h2>
												<h3 class="fw-bold text-uppercase" style="color:white;"><?= number_format($non) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="resident_info.php?state=non_voters" class="card-link text-light">Total Non Voters </a>
								</div>
							</div>
						</div> -->

							<!-- 
						THIS IS FOR THE PRECINCT NUMBER
						<div class="col-md-4">
							<div class="card card-stats card-round" style="background-color:black;">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="fas fa-list" style="color:white;"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase" style="color:white;">Precinct Number</h2>
												<h3 class="fw-bold" style="color:white;"><?= number_format($precinct) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="purok_info.php?state=precinct" class="card-link text-light">Precint Information</a>
								</div>
							</div>
						</div> -->

							<div class="col-sm-6 col-md-3">
								<div class="card card-stats card-round">
									<div class="card-body ">
										<div class="row align-items-center">
											<div class="col-icon">
												<div class="icon-big text-center icon-primary bubble-shadow-small" style="background-color:black;">
													<i class="fas fa-street-view"></i>
												</div>
											</div>
											<div class="col col-stats ml-3 ml-sm-0">
												<div class="numbers">
													<a href="purok_info.php?state=purok" class="card-link">
														<p class="card-category">Zone Number</p>
													</a>
													<h4 class="card-title"><?= number_format($purok) ?></h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- <div class="col-md-4">
							<div class="card card-stats card-round" style="background-color:black;">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="icon-direction" style="color:white;"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase" style="color:white;">Zone Number</h2>
												<h3 class="fw-bold text-uppercase" style="color:white;"><?= number_format($purok) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="purok_info.php?state=purok" class="card-link text-light">Purok Information</a>
								</div>
							</div>
						</div> -->

							<div class="col-sm-6 col-md-3">
								<div class="card card-stats card-round">
									<div class="card-body ">
										<div class="row align-items-center">
											<div class="col-icon">
												<div class="icon-big text-center icon-primary bubble-shadow-small" style="background-color:black;">
													<i class="far fa-file"></i>
												</div>
											</div>
											<div class="col col-stats ml-3 ml-sm-0">
												<div class="numbers">
													<a href="blotter.php" class="card-link">
														<p class="card-category">Blotter</p>
													</a>
													<h4 class="card-title"><?= number_format($blotter) ?></h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- <div class="col-md-4">
							<div class="card card-stats card-round" style="background-color:black;">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="icon-layers" style="color:white;"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase" style="color:white;">Blotter</h2>
												<h3 class="fw-bold text-uppercase" style="color:white;"><?= number_format($blotter) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="blotter.php" class="card-link text-light">Blotter Information</a>
								</div>
							</div>
						</div> -->

							<div class="col-sm-6 col-md-3">
								<div class="card card-stats card-round">
									<div class="card-body ">
										<div class="row align-items-center">
											<div class="col-icon">
												<div class="icon-big text-center icon-primary bubble-shadow-small" style="background-color:black;">
													<i class="fas fa-money-bill-alt"></i>
												</div>
											</div>
											<div class="col col-stats ml-3 ml-sm-0">
												<div class="numbers">
													<a href="revenue.php" class="card-link">
														<p class="card-category">Revenue - by day</p>
													</a>
													<!-- <h4 class="card-title">P <?= number_format($revenue['am'], 2) ?></h4> -->
													<?php if ($result_trans > 0) : ?>
														<h4 class="card-title">₱ <?= number_format($revenue['am'], 2) ?></h4>
													<?php else : ?>
														<h4 class="card-title">₱ 0.00</h4>
													<?php endif; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- THIS IS FOR REVENUE -->
							<!-- <div class="col-md-4">
							<div class="card card-stats card-round" style="background-color:black;">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="fas fa-money-bill-alt" style="color:white;"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase" style="color:white;">Revenue - by day</h2>
												<h3 class="fw-bold text-uppercase" style="color:white;">P <?= number_format($revenue['am'], 2) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="revenue.php" class="card-link text-light">All Revenues</a>
								</div>
							</div>
						</div> -->
						</div>
					<?php endif ?>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title fw-bold">LGU Mission Statement</div>
									</div>
								</div>
								<div class="card-body">
									<p><?= !empty($db_txt) ? $db_txt : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque in ipsum id orci porta dapibus. Donec rutrum congue leo eget malesuada. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Quisque velit nisi, pretium ut lacinia in, elementum id enim.' ?></p>
									<div class="text-center">
										<img class="img-fluid" src="<?= !empty($db_img) ? 'assets/uploads/' . $db_img : 'assets/img/bg-abstract.png' ?>" />
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>
					</div>
				</div>
			</div>
			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->

		</div>

	</div>
	<?php include 'templates/footer.php' ?>
	<script>
		Circles.create({
			id: 'circles-1',
			radius: 45,
			value: <?= number_format($total) ?>,
			maxValue: 100000,
			width: 7,
			text: <?= number_format($total) ?>,
			colors: ['#f1f1f1', '#FF9E27'],
			duration: 400,
			wrpClass: 'circles-wrp',
			textClass: 'circles-text',
			styleWrapper: true,
			styleText: true
		})

		Circles.create({
			id: 'circles-2',
			radius: 45,
			value: <?= number_format($male) ?>,
			maxValue: 100000,
			width: 7,
			text: <?= number_format($male) ?>,
			colors: ['#f1f1f1', '#2BB930'],
			duration: 400,
			wrpClass: 'circles-wrp',
			textClass: 'circles-text',
			styleWrapper: true,
			styleText: true
		})

		Circles.create({
			id: 'circles-3',
			radius: 45,
			value: <?= number_format($female) ?>,
			maxValue: 100000,
			width: 7,
			text: <?= number_format($female) ?>,
			colors: ['#f1f1f1', '#F25961'],
			duration: 400,
			wrpClass: 'circles-wrp',
			textClass: 'circles-text',
			styleWrapper: true,
			styleText: true
		})

		Circles.create({
			id: 'circles-4',
			radius: 45,
			value: <?= number_format($sc) ?>,
			maxValue: 100000,
			width: 7,
			text: <?= number_format($sc) ?>,
			colors: ['#f1f1f1', '#F25961'],
			duration: 400,
			wrpClass: 'circles-wrp',
			textClass: 'circles-text',
			styleWrapper: true,
			styleText: true
		})

		Circles.create({
			id: 'circles-5',
			radius: 45,
			value: <?= number_format($pwd) ?>,
			maxValue: 100000,
			width: 7,
			text: <?= number_format($pwd) ?>,
			colors: ['#f1f1f1', '#F25961'],
			duration: 400,
			wrpClass: 'circles-wrp',
			textClass: 'circles-text',
			styleWrapper: true,
			styleText: true
		})

		var pieChart = document.getElementById('pieChart').getContext('2d');
		var barChart = document.getElementById('barChart').getContext('2d');

		var myPieChart = new Chart(pieChart, {
			type: 'pie',
			data: {
				datasets: [{
					data: [<?= number_format($male) ?>, <?= number_format($female) ?>],
					backgroundColor: ["#1d7af3", "#f3545d"],
					borderWidth: 0
				}],
				labels: ['Male', 'Female']
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					position: 'bottom',
					labels: {
						fontColor: 'rgb(154, 154, 154)',
						fontSize: 11,
						usePointStyle: true,
						padding: 20
					}
				},
				pieceLabel: {
					render: 'percentage',
					fontColor: 'white',
					fontSize: 14,
				},
				tooltips: false,
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		})

		var myBarChart = new Chart(barChart, {
			type: 'bar',
			data: {
				labels: ["Residential", "Boarding Houses", "Apartments"],
				datasets: [{
					label: "Count",
					backgroundColor: 'rgb(23, 125, 255)',
					borderColor: 'rgb(23, 125, 255)',
					data: [<?= number_format($residential) ?>, <?= number_format($board_house) ?>, <?= number_format($apartment) ?>],
				}],
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true
						}
					}]
				},
			}
		});
	</script>
</body>

</html>