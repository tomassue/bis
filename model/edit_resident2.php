<?php
include '../server/server.php';

if (!isset($_SESSION['username'])) {
	if (isset($_SERVER["HTTP_REFERER"])) {
		header("Location: " . $_SERVER["HTTP_REFERER"]);
	}
}

$id 				    = $conn->real_escape_string($_POST['id']);

$national_id 			= $conn->real_escape_string($_POST['national_id']);
$region					= $conn->real_escape_string($_POST['region']);
$city 					= $conn->real_escape_string($_POST['city']);
$province				= $conn->real_escape_string($_POST['province']);
$barangay 				= $conn->real_escape_string($_POST['barangay']);

$firstname				= $conn->real_escape_string($_POST['firstname']);
$middlename 			= $conn->real_escape_string($_POST['middlename']);
$lastname 				= $conn->real_escape_string($_POST['lastname']);
$ext 					= $conn->real_escape_string($_POST['ext']);
$alias 					= $conn->real_escape_string($_POST['alias']);
$birthdate 				= $conn->real_escape_string($_POST['birthdate']);
$birthplace 			= $conn->real_escape_string($_POST['birthplace']);
$sex 					= $conn->real_escape_string($_POST['sex']);
$civilstatus 			= $conn->real_escape_string($_POST['civilstatus']);
$citizenship 			= $conn->real_escape_string($_POST['citizenship']);
$occupation				= $conn->real_escape_string($_POST['occupation']);

// $household_number 		= $conn->real_escape_string($_POST['householdnumber']);
// $mystring = $household_number;
// $first = strtok($mystring, ' '); //SO MAO NI ANG PAG CUT SA STRING BEFORE MAG SPACE.
// $householdnumber = $first; //Ang natabo is ang ID lang atoang gikuha sa string.
$householdnumber 		= $conn->real_escape_string($_POST['householdnumber']);
$family_head 			= $conn->real_escape_string($_POST['family_head']);
$date_of_residence      = $conn->real_escape_string($_POST['date_of_residence']);

$email 					= $conn->real_escape_string($_POST['email']);
$phone 					= $conn->real_escape_string($_POST['phone']);
$vstatus 				= $conn->real_escape_string($_POST['vstatus']);
$identified_as 			= $conn->real_escape_string($_POST['identity']);
$organization 			= $conn->real_escape_string($_POST['organization']);
$pwd 		      		= $conn->real_escape_string($_POST['pwd']);
$indigent 				= $conn->real_escape_string($_POST['indigent']);

$deceased 				= $conn->real_escape_string($_POST['deceased']);
$remarks 				= $conn->real_escape_string($_POST['remarks']);

$user_id            	= $_SESSION['id'];

$residence_type 		= $conn->real_escape_string($_POST['residence_type']);

$profile 				= $conn->real_escape_string($_POST['profileimg']); // base 64 image
$profile2 				= $_FILES['img']['name'];

// change profile2 name
$newName = date('dmYHis') . str_replace(" ", "", $profile2);

// image file directory
$target = "../assets/uploads/resident_profile/" . basename($newName);

//CHECK IF THERE'S A DUPLICATE IN THE NATIONAL ID
$check = "SELECT id_resident FROM tblresident2 WHERE national_id='$national_id'";
$nat = $conn->query($check)->fetch_assoc();

//CHECK IF THERE'S A DUPLICATE IN TERMS OF THE EMAIL
$checkEmail = "SELECT id_resident FROM tblresident2 WHERE email='$email'";
$check_em = $conn->query($checkEmail)->fetch_assoc();

if ($nat['id_resident'] == $id || $nat == 0 || $national_id == "") {

	if ($check_em['id_resident'] == $id || $check_em == 0 || $email == "") {

		if (!empty($id) && !empty($user_id)) {

			if (!empty($profile) && !empty($profile2)) {

				$query = "UPDATE tblresident2 
						SET `national_id`='$national_id',
						`region`='$region',
						`city`='$city',
						`province`='$province',
						`barangay`='$barangay',
						`citizenship`='$citizenship',
						`picture`='$profile',
						`firstname`='$firstname',
						`middlename`='$middlename',
						`lastname`='$lastname',
						`ext`='$ext',
						`alias`='$alias',
						`birthplace`='$birthplace',
						`birthdate`='$birthdate',
						`sex`='$sex',
						`civilstatus`='$civilstatus',
						`id_household`='$householdnumber',
						`family_head`='$family_head',
						`date_of_residence`='$date_of_residence',
						`vstatus`='$vstatus',
						`identified_as`='$identified_as',
						`phone`='$phone',
						`email`='$email',
						`occupation`='$occupation', 
						`resident_type`='$deceased',
						`id_org`='$organization',
						`pwd`='$pwd',
						`indigent`='$indigent', 
						`remarks`='$remarks', 
						`id_user`='$user_id'
								WHERE id_resident=$id;";

				if ($conn->query($query) === true) {

					$_SESSION['message'] = 'Resident Information has been updated!';
					$_SESSION['success'] = 'success';
				}
			} else if (!empty($profile) && empty($profile2)) {

				// $query = "UPDATE tblresident2 SET national_id='$national_id',region='$region',city='$city',province='$province',barangay='$barangay',citizenship='$citi',`picture`='$profile', `firstname`='$fname', `middlename`='$mname', `lastname`='$lname',ext='$ext', `alias`='$alias', `birthplace`='$bplace', `birthdate`='$bdate', 
				// 		 `civilstatus`='$cstatus', `sex`='$sex', `purok`='$purok',residence_type='$residence_type',residence_remarks='$residence_remarks', `voterstatus`='$vstatus', `identified_as`='$indetity',organization='$organization',pwd='$pwd',`indigent`='$indigent',`phone`='$number', `email`='$email',`occupation`='$occu',h_num='$h_num',housenum='$housenum',streetname='$streetname', `address`='$address',
				// 		`resident_type`='$deceased', `remarks`='$remarks', `username`='$user_id'
				// 		WHERE id=$id;";

				$query = "UPDATE tblresident2 
							SET `national_id`='$national_id',
							`region`='$region',
							`city`='$city',
							`province`='$province',
							`barangay`='$barangay',
							`citizenship`='$citizenship',
							`picture`='$profile',
							`firstname`='$firstname',
							`middlename`='$middlename',
							`lastname`='$lastname',
							`ext`='$ext',
							`alias`='$alias',
							`birthplace`='$birthplace',
							`birthdate`='$birthdate',
							`sex`='$sex',
							`civilstatus`='$civilstatus',
							`id_household`='$householdnumber',
							`family_head`='$family_head',
							`date_of_residence`='$date_of_residence',
							`vstatus`='$vstatus',
							`identified_as`='$identified_as',
							`phone`='$phone',
							`email`='$email',
							`occupation`='$occupation', 
							`resident_type`='$deceased',
							`id_org`='$organization',
							`pwd`='$pwd',
							`indigent`='$indigent', 
							`remarks`='$remarks', 
							`id_user`='$user_id'
								WHERE id_resident=$id;";

				if ($conn->query($query) === true) {

					$_SESSION['message'] = 'Resident Information has been updated!';
					$_SESSION['success'] = 'success';
				}
			} else if (empty($profile) && !empty($profile2)) {

				// $query = "UPDATE tblresident2 SET national_id='$national_id',region='$region',city='$city',province='$province',barangay='$barangay',citizenship='$citi',`picture`='$newName', `firstname`='$fname', `middlename`='$mname', `lastname`='$lname',ext='$ext', `alias`='$alias', `birthplace`='$bplace', `birthdate`='$bdate', 
				// 			 `civilstatus`='$cstatus', `sex`='$sex', `purok`='$purok',residence_type='$residence_type',residence_remarks='$residence_remarks', `voterstatus`='$vstatus', `identified_as`='$indetity',organization='$organization',pwd='$pwd',`indigent`='$indigent', `phone`='$number', `email`='$email',`occupation`='$occu',h_num='$h_num',housenum='$housenum',streetname='$streetname', `address`='$address',
				// 			`resident_type`='$deceased', `remarks`='$remarks', `username`='$user_id'
				// 			WHERE id=$id;";

				$query = "UPDATE tblresident2 
						SET `national_id`='$national_id',
						`region`='$region',
						`city`='$city',
						`province`='$province',
						`barangay`='$barangay',
						`citizenship`='$citizenship',
						`picture`='$newName',
						`firstname`='$firstname',
						`middlename`='$middlename',
						`lastname`='$lastname',
						`ext`='$ext',
						`alias`='$alias',
						`birthplace`='$birthplace',
						`birthdate`='$birthdate',
						`sex`='$sex',
						`civilstatus`='$civilstatus',
						`id_household`='$householdnumber',
						`family_head`='$family_head',
						`date_of_residence`='$date_of_residence',
						`vstatus`='$vstatus',
						`identified_as`='$identified_as',
						`phone`='$phone',
						`email`='$email',
						`occupation`='$occupation', 
						`resident_type`='$deceased',
						`id_org`='$organization',
						`pwd`='$pwd',
						`indigent`='$indigent', 
						`remarks`='$remarks', 
						`id_user`='$user_id'
							WHERE id_resident=$id;";

				if ($conn->query($query) === true) {

					$_SESSION['message'] = 'Resident Information has been updated!!';
					$_SESSION['success'] = 'success';

					if (move_uploaded_file($_FILES['img']['tmp_name'], $target)) {

						$_SESSION['message'] = 'Resident Information has been updated!!';
						$_SESSION['success'] = 'success';
					}
				}
			} else {
				// $query = "UPDATE tblresident2 SET national_id='$national_id',region='$region',city='$city',province='$province',barangay='$barangay',citizenship='$citi',`firstname`='$fname', `middlename`='$mname', `lastname`='$lname',ext='$ext', `alias`='$alias', `birthplace`='$bplace', `birthdate`='$bdate', 
				// 		 `civilstatus`='$cstatus', `sex`='$sex', `purok`='$purok',residence_type='$residence_type',residence_remarks='$residence_remarks', `voterstatus`='$vstatus', `identified_as`='$indetity',organization='$organization',pwd='$pwd',`indigent`='$indigent', `phone`='$number', `email`='$email',`occupation`='$occu',h_num='$h_num',housenum='$housenum',streetname='$streetname', `address`='$address',
				// 			`resident_type`='$deceased', `remarks`='$remarks', `username`='$user_id'
				// 			WHERE id=$id;";


				$query = "UPDATE tblresident2 
						SET `national_id`='$national_id',
						`region`='$region',
						`city`='$city',
						`province`='$province',
						`barangay`='$barangay',
						`citizenship`='$citizenship',
						`firstname`='$firstname',
						`middlename`='$middlename',
						`lastname`='$lastname',
						`ext`='$ext',
						`alias`='$alias',
						`birthplace`='$birthplace',
						`birthdate`='$birthdate',
						`sex`='$sex',
						`civilstatus`='$civilstatus',
						`id_household`='$householdnumber',
						`family_head`='$family_head',
						`date_of_residence`='$date_of_residence',
						`vstatus`='$vstatus',
						`identified_as`='$identified_as',
						`phone`='$phone',
						`email`='$email',
						`occupation`='$occupation', 
						`resident_type`='$deceased',
						`id_org`='$organization',
						`pwd`='$pwd',
						`indigent`='$indigent', 
						`remarks`='$remarks', 
						`id_user`='$user_id'
								WHERE id_resident=$id;";

				if ($conn->query($query) === true) {

					$_SESSION['message'] = 'Resident Information has been updated!';
					$_SESSION['success'] = 'success';
				}
			}
		} else {

			$_SESSION['message'] = 'Please complete the form!';
			$_SESSION['success'] = 'danger';
		}
	} else {
		$_SESSION['message'] = 'Email is already taken. Please enter a unique email address!';
		$_SESSION['success'] = 'danger';
	}
} else {
	$_SESSION['message'] = 'National ID is already taken. Please enter a unique national ID!';
	$_SESSION['success'] = 'danger';
}
header("Location: ../resident2.php");

$conn->close();
