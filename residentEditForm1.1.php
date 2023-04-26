<?php include 'server/server.php' ?>
<?php
$query = "SELECT * FROM tbl_org ORDER BY org_name ASC";
$result = $conn->query($query);
$org = array();
while ($row = $result->fetch_assoc()) {
	$org[] = $row;
}

$res_id = $_GET['res_id'];
$query2 = "SELECT * FROM tblresident2 WHERE id_resident='$res_id'";
$result2 = $conn->query($query2);
$res_info = $result2->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'templates/header.php' ?>
	<link rel="stylesheet" href="assets/js/plugin/dataTables.dateTime.min.css">
	<link rel="stylesheet" href="assets/js/plugin/datatables/Buttons-1.6.1/css/buttons.dataTables.min.css">
	<title>Edit Resident</title>
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
								<h2 class="text-white fw-bold">Edit Resident</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt--2">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Edit Resident</div>
									</div>
								</div>
								<div class="card-body">
									<form method="POST" action="model/edit_resident2.php" onclick="myFunction()" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to submit this form?');">
										<input type="hidden" name="size" value="1000000">
										<div class="row">

											<div class="col-md-3">
												<div class="form-group d-flex justify-content-center">
													<div id="my_camera1" style="width: 370px; height: 250;" class="text-center">
														<img src="<?= preg_match('/data:image/i', $res_info['picture']) ? $res_info['picture'] : 'assets/uploads/resident_profile/' . $res_info['picture'] ?>" alt="..." class="img img-fluid" width="250" id="image">
													</div>
												</div>

												<?php if (isset($_SESSION['username'])) : ?>
													<div class="form-group d-flex justify-content-center">
														<button type="button" class="btn btn-danger btn-sm mr-2" id="open_cam1">Open Camera</button>
														<button type="button" class="btn btn-secondary btn-sm ml-2" onclick="save_photo1()">Capture</button>
													</div>
													<div id="profileImage1">
														<input type="hidden" name="profileimg">
													</div>
													<div class="form-group">
														<input type="file" class="form-control" name="img" accept="image/*">
													</div>
												<?php endif ?>
												<div class="form-group text-center">
													<div class="selectgroup selectgroup-secondary selectgroup-pills">

														<?php if ($res_info['resident_type'] == 1) : ?>
															<label class="selectgroup-item">
																<input type="radio" name="deceased" value="1" class="selectgroup-input" checked="" id="alive">
																<span class="selectgroup-button selectgroup-button-icon"><i class="fa fa-walking"></i></span>
															</label>
															<p class="mt-1 mr-3"><b>Alive</b></p>
															<label class="selectgroup-item">
																<input type="radio" name="deceased" value="0" class="selectgroup-input" id="dead">
																<span class="selectgroup-button selectgroup-button-icon"><i class="fa fa-people-carry"></i></span>
															</label>
															<p class="mt-1 mr-3"><b>Deceased</b></p>

														<?php elseif ($res_info['resident_type'] == 0) : ?>
															<label class="selectgroup-item">
																<input type="radio" name="deceased" value="1" class="selectgroup-input" id="alive">
																<span class="selectgroup-button selectgroup-button-icon"><i class="fa fa-walking"></i></span>
															</label>
															<p class="mt-1 mr-3"><b>Alive</b></p>
															<label class="selectgroup-item">
																<input type="radio" name="deceased" value="0" class="selectgroup-input" checked="" id="dead">
																<span class="selectgroup-button selectgroup-button-icon"><i class="fa fa-people-carry"></i></span>
															</label>
															<p class="mt-1 mr-3"><b>Deceased</b></p>
														<?php endif ?>

													</div>
												</div>

												<div class="form-group">
													<label>National ID No.</label>
													<input type="text" class="form-control nationalIdFormat" name="national_id" placeholder="Ex. 0-9" oninput="this.value = this.value.replace(/[^0-9-]/g, '').replace(/(\..*)\./g, '$1');" value="<?= $res_info['national_id'] ?>">
												</div>

												<div class="form-group">
													<label>Region<span class="text-danger"><b> *</b></span></label>
													<input type="text" value="Region X" class="form-control" name="region" value="<?= $res_info['region'] ?>" required readonly>
												</div>
												<div class="form-group">
													<label>City/Municipal<span class="text-danger"><b> *</b></span></label>
													<input type="text" class="form-control" name="city" value="<?= $res_info['city'] ?>" required readonly>
												</div>
												<div class="form-group">
													<label>Province<span class="text-danger"><b> *</b></span></label>
													<input type="text" class="form-control" name="province" value="<?= $res_info['province'] ?>" required readonly>
												</div>
												<div class="form-group">
													<label>Barangay<span class="text-danger"><b> *</b></span></label>
													<input type="text" class="form-control" name="barangay" value="<?= $res_info['barangay'] ?>" required readonly>
												</div>
											</div>

											<div class="col-md-9">
												<label><b>I. </b>PERSONAL INFORMATION</label>
												<div class="row">
													<div class="col">
														<div class="form-group">
															<label>Firstname<span class="text-danger"><b> *</b></span></label>
															<input type="text" class="form-control" placeholder="Enter Firstname" name="firstname" oninput="this.value = this.value.replace(/[^A-z\s]/g, '').replace(/(\..*)\./g, '$1');" value="<?= $res_info['firstname'] ?>" required>
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label>Middlename</label>
															<input type="text" class="form-control" placeholder="Enter Middlename" name="middlename" oninput="this.value = this.value.replace(/[^A-z\s]/g, '').replace(/(\..*)\./g, '$1');" value="<?= $res_info['middlename'] ?>">
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label>Lastname<span class="text-danger"><b> *</b></span></label>
															<input type="text" class="form-control" placeholder="Enter Lastname" name="lastname" oninput="this.value = this.value.replace(/[^A-z\s]/g, '').replace(/(\..*)\./g, '$1');" value="<?= $res_info['lastname'] ?>" required>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col">
														<div class="form-group">
															<label>Extension Name</label>
															<select class="form-control" name="ext">
																<?php if (empty($res_info['ext'])) : ?>
																	<option selected disabled>Choose...</option>
																	<option value="">None</option>
																	<option value="Jr.">Jr.</option>
																	<option value="Sr.">Sr.</option>
																	<option value="I">I</option>
																	<option value="II">II</option>
																	<option value="III">III</option>
																	<option value="IV">IV</option>
																	<option value="V">V</option>
																	<option value="VI">VI</option>
																<?php else : ?>
																	<option selected value="<?= $res_info['ext'] ?>"><?= $res_info['ext'] ?></option>
																	<option value="">None</option>
																	<option value="Jr.">Jr.</option>
																	<option value="Sr.">Sr.</option>
																	<option value="I">I</option>
																	<option value="II">II</option>
																	<option value="III">III</option>
																	<option value="IV">IV</option>
																	<option value="V">V</option>
																	<option value="VI">VI</option>
																<?php endif ?>
															</select>
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label>Alias<span class="text-danger"><b> *</b></span></label>
															<input type="text" class="form-control" placeholder="Enter Alias" name="alias" oninput="this.value = this.value.replace(/[^A-z\s]/g, '').replace(/(\..*)\./g, '$1');" value="<?= $res_info['alias'] ?>" required>
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label>Birthdate<span class="text-danger"><b> *</b></span></label>
															<input type="date" class="form-control" placeholder="Enter Birthdate" name="birthdate" required id="date" onblur="getAge();" value="<?= $res_info['birthdate'] ?>">
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label>Place of Birth<span class="text-danger"><b> *</b></span></label>
															<input type="text" class="form-control" placeholder="Enter Birthplace" name="birthplace" value="<?= $res_info['birthplace'] ?>" required>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col">
														<div class="form-group">
															<label>Age</label>
															<input type="number" class="form-control" placeholder="" name="age" id="age" disabled>
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label>Sex<span class="text-danger"><b> *</b></span></label>
															<select class="form-control" required name="sex">
																<?php if ($res_info['sex'] == "Male") : ?>
																	<option value="<?= $res_info['sex'] ?>" selected><?= $res_info['sex'] ?></option>
																	<option value="Female">Female</option>
																<?php elseif ($res_info['sex'] == "Female") : ?>
																	<option value="<?= $res_info['sex'] ?>" selected><?= $res_info['sex'] ?></option>
																	<option value="Male">Male</option>
																<?php endif; ?>
																<!-- <option value="<?= $res_info['sex'] ?>" selected><?= $res_info['sex'] ?></option>
			                                                    <option value="Male">Male</option>
			                                                    <option value="Female">Female</option> -->
															</select>
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label>Civil Status<span class="text-danger"><b> *</b></span></label>
															<select class="form-control" required name="civilstatus">
																<?php if ($res_info['civilstatus'] == "single") : ?>
																	<option value="<?= $res_info['civilstatus'] ?>" selected><?= ucwords($res_info['civilstatus']) ?></option>
																	<option value="married">Married</option>
																	<option value="widow/er">Widow/er</option>
																	<option value="separated">Separated</option>
																<?php elseif ($res_info['civilstatus'] == "married") : ?>
																	<option value="<?= $res_info['civilstatus'] ?>" selected><?= ucwords($res_info['civilstatus']) ?></option>
																	<option value="single">Single</option>
																	<option value="widow/er">Widow/er</option>
																	<option value="separated">Separated</option>
																<?php elseif ($res_info["civilstatus"] == "widow/er") : ?>
																	<option value="<?= $res_info['civilstatus'] ?>" selected><?= ucwords($res_info['civilstatus']) ?></option>
																	<option value="single">Single</option>
																	<option value="married">Married</option>
																	<option value="separated">Separated</option>
																<?php elseif ($res_info["civilstatus"] == "separated") : ?>
																	<option value="<?= $res_info['civilstatus'] ?>" selected><?= ucwords($res_info['civilstatus']) ?></option>
																	<option value="single">Single</option>
																	<option value="married">Married</option>
																	<option value="widow/er">Widow/er</option>
																<?php endif; ?>
																<!-- <option value="<?= $res_info['civilstatus'] ?>" selected><?= ucwords($res_info['civilstatus']) ?></option>
			                                                    <option value="single">Single</option>
			                                                    <option value="married">Married</option>
			                                                    <option value="widow/er">Widow/er</option>
			                                                    <option value="separated">Separated</option> -->
															</select>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col">
														<div class="form-group">
															<label>Citizenship<span class="text-danger"><b> *</b></span></label>
															<input type="text" class="form-control" name="citizenship" oninput="this.value = this.value.replace(/[^A-z\s]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Enter citizenship" value="<?= $res_info['citizenship'] ?>" required>
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label>Profession/Occupation<span class="text-danger"><b> *</b></span></label>
															<input type="text" class="form-control" name="occupation" placeholder="Enter Profession/Occupation" value="<?= $res_info['occupation'] ?>" required>
														</div>
													</div>
												</div>
												<hr>
												<label>II. RESIDENCE ADDRESS</label>

												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<label>Household Number</span><span class="text-danger"><b> *</b></span></label>
															<input type="text" class="form-control householdnumber" id="householdnumber" onkeyup="GetDetail(this.value)" name="householdnumber" placeholder="Enter Household Number" value="<?= $res_info['id_household'] ?>" required>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>Family Head?</span><span class="text-danger"><b> *</b></span></label>
															<select class="form-control" name="family_head" required>
																<?php if ($res_info['family_head'] == '') : ?>
																	<option value="no" selected>No</option>
																	<option value="yes">Yes</option>
																<?php else : ?>
																	<option value="<?= $res_info['family_head'] ?>" selected><?= ucwords($res_info['family_head']) ?></option>
																	<option value="yes">Yes</option>
																	<option value="no">No</option>
																<?php endif; ?>
															</select>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>Since when did you reside in this barangay?<span class="text-danger"><b> *</b></span></label>
															<input type="date" class="form-control" placeholder="Enter Birthdate" name="date_of_residence" value="<?= $res_info['date_of_residence'] ?>" required>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label>Preview (Address)</span></label>
															<textarea disabled class="form-control" id="detailAdd"></textarea>
															<small class="form-text text-muted"><b>E.g., </b>House ownership, Boarder, Tenant</small>
														</div>
													</div>
												</div>
												<hr>
												<label><b>II. </b>OTHER INFORMATIONS</label>
												<div class="row">
													<div class="col">
														<div class="form-group">
															<label>Email Address</span></label>
															<input type="email" class="form-control" placeholder="Enter Email" name="email" value="<?= $res_info['email'] ?>">
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label>Contact Number</span></label>
															<input type="text" class="form-control" placeholder="Enter Contact Number" name="phone" pattern="\d{11}" value="<?= $res_info['phone'] ?>">
															<small class="form-text text-muted">Must be <b>11</b> numbers.</small>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col">
														<div class="form-group">
															<label>Voters Status<span class="text-danger"><b> *</b></span></label>
															<select class="form-control vstatus" required name="vstatus">
																<?php if ($res_info['vstatus'] == "Yes") : ?>
																	<option value="<?= $res_info['vstatus'] ?>" selected><?= $res_info['vstatus'] ?></option>
																	<option value="No">No</option>
																<?php elseif ($res_info['vstatus'] == "No") : ?>
																	<option value="<?= $res_info['vstatus'] ?>" selected><?= $res_info['vstatus'] ?></option>
																	<option value="No">No</option>
																<?php endif; ?>
																<!-- <option value="<?= $res_info['vstatus'] ?>" selected><?= $res_info['vstatus'] ?></option>
			                                                    <option value="Yes">Yes</option>
			                                                    <option value="No">No</option> -->
															</select>
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label>Identified As</label>
															<select class="form-control indetity" name="identity">
																<?php if (empty($res_info['identified_as'])) : ?>
																	<option disabled selected>Choose...</option>
																	<option value="Confirmed">Confirmed</option>
																	<option value="Unconfirmed">Unconfirmed</option>
																<?php elseif ($res_info['identified_as'] == "Confirmed") : ?>
																	<option value="<?= $res_info['identified_as'] ?>" selected><?= $res_info['identified_as'] ?></option>
																	<option value="Unconfirmed">Unconfirmed</option>
																<?php elseif ($res_info['identified_as'] == "Unconfirmed") : ?>
																	<option value="<?= $res_info['identified_as'] ?>" selected><?= $res_info['identified_as'] ?></option>
																	<option value="Confirmed">Confirmed</option>
																<?php endif ?>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col">
														<div class='form-group'>
															<label>Association/Organization<span class="text-danger"><b> *</b></span></label>
															<select class="form-control" name="organization" required>
																<?php
																$orgName = $res_info['id_org'];
																$queryOrg = "SELECT * FROM tbl_org WHERE id_org='$orgName'";
																$resultOrg = $conn->query($queryOrg);
																$org_Name = $resultOrg->fetch_assoc();
																?>

																<?php if ($res_info['id_org'] == 'none') : ?>
																	<option selected value="none"><?= ucwords($res_info['id_org']) ?></option>
																	<?php foreach ($org as $row) : ?>
																		<option value="<?= ucwords($row['id_org']) ?>"><?= $row['org_name'] ?></option>
																	<?php endforeach ?>
																	<option value="none">None</option>
																<?php else : ?>
																	<option selected value="<?= $res_info['id_org'] ?>"><?= $org_Name['org_name'] ?></option>
																	<?php foreach ($org as $row) : ?>
																		<option value="<?= ucwords($row['id_org']) ?>"><?= $row['org_name'] ?></option>
																	<?php endforeach ?>
																	<option value="none">None</option>
																<?php endif ?>
															</select>
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label>PWD<span class="text-danger"><b> *</b></span></label>
															<select class="form-control" required name="pwd">
																<?php if ($res_info['pwd'] == "Yes") : ?>
																	<option value="<?= $res_info['pwd'] ?>" selected><?= $res_info['pwd'] ?></option>
																	<option value="No">No</option>
																<?php elseif ($res_info['pwd'] == "No") : ?>
																	<option value="<?= $res_info['pwd'] ?>" selected><?= $res_info['pwd'] ?></option>
																	<option value="Yes">Yes</option>
																<?php endif; ?>
																<!-- <option value="<?= $res_info['pwd'] ?>" selected><?= $res_info['pwd'] ?></option>
			                                                    <option value="Yes">Yes</option>
			                                                    <option value="No">No</option> -->
															</select>
														</div>
													</div>
													<div class="col">
														<div class="form-group">
															<label>Indigent<span class="text-danger"><b> *</b></span></label>
															<select class="form-control" name="indigent" required>
																<?php if ($res_info['indigent'] == "Yes") : ?>
																	<option value="<?= $res_info['indigent'] ?>" selected><?= $res_info['indigent'] ?></option>
																	<option value="No">No</option>
																<?php elseif ($res_info['indigent'] == "No") : ?>
																	<option value="<?= $res_info['indigent'] ?>" selected><?= $res_info['indigent'] ?></option>
																	<option value="Yes">Yes</option>
																<?php endif; ?>
																<!-- <option value="<?= $res_info['indigent'] ?>" selected><?= $res_info['indigent'] ?></option>
			                                                    <option value="Yes">Yes</option>
			                                                    <option value="No">No</option> -->
															</select>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label>Other Remarks</label>
													<textarea class="form-control" name="remarks" placeholder="Enter remarks" id="remarks"><?= $res_info['remarks'] ?></textarea>
												</div>
											</div>

										</div>
										<div class="modal-footer">
											<input type="hidden" name="residence_type" value="new">
											<input type="hidden" name="id" value="<?= $res_info['id_resident'] ?>">
											<a href="resident2.php" class="btn btn-secondary">Cancel</a>
											<button type="submit" id="" class="btn btn-primary">Update</button>
										</div>
									</form>
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

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<!-- jQuery UI library -->
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

	<script src="assets/js/plugin/datatables/datatables.min.js"></script>
	<script src="assets/js/plugin/moment/moment.min.js"></script>
	<script src="assets/js/plugin/dataTables.dateTime.min.js"></script>
	<script src="assets/js/plugin/datatables/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="assets/js/plugin/datatables/Buttons-1.6.1/js/buttons.print.min.js"></script>

	<script>
		$('.nationalIdFormat').keyup(function() {
			var foo = $(this).val().split("-").join(""); // remove hyphens
			if (foo.length > 0) {
				foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
			}
			$(this).val(foo);
		});

		function getAge() {
			var birthdate = document.getElementById('date').value;
			birthdate = new Date(birthdate);
			var today = new Date();
			var age = Math.floor((today - birthdate) / (365.25 * 24 * 60 * 60 * 1000));
			document.getElementById('age').value = age;
		}

		$(function() {
			$("#householdnumber").autocomplete({
				source: 'backend-script_residentNew.php'
			});
		});

		// onkeyup event will occur when the user 
		// release the key and calls the function
		// assigned to this event
		function GetDetail(str) {
			if (str.length == 0) {
				document.getElementById("householdnumber").value = "";
				return;
			} else {

				// Creates a new XMLHttpRequest object
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {

					// Defines a function to be called when
					// the readyState property changes
					if (this.readyState == 4 &&
						this.status == 200) {

						// Typical action to be performed
						// when the document is ready
						var myObj = JSON.parse(this.responseText);

						// Returns the response data as a
						// string and store this array in
						// a variable assign the value 
						// received to first name input field

						document.getElementById("detailAdd").value = myObj[0];
					}
				};

				// xhttp.open("GET", "filename", true);
				xmlhttp.open("GET", "gfg.php?user_id=" + str, true);

				// Sends the request to the server
				xmlhttp.send();
			}
		}
	</script>
</body>

</html>