<?php

	include '../server/server.php';

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}


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

	$household_number 		= $conn->real_escape_string($_POST['householdnumber']);
	$family_head 			= $conn->real_escape_string($_POST['family_head']);
	$mystring = $household_number;
    $first = strtok($mystring, ' '); //SO MAO NI ANG PAG CUT SA STRING BEFORE MAG SPACE.
    $householdnumber = $first;//Ang natabo is ang ID lang atoang gikuha sa string.
    $date_of_residence      = $conn->real_escape_string($_POST['date_of_residence']);

	$email 					= $conn->real_escape_string($_POST['email']);
	$phone 					= $conn->real_escape_string($_POST['phone']);
	$vstatus 				= $conn->real_escape_string($_POST['vstatus']);
	$identified_as 			= $conn->real_escape_string($_POST['indetity']);
	$organization 			= $conn->real_escape_string($_POST['organization']);
	$pwd 		      		= $conn->real_escape_string($_POST['pwd']);
	$indigent 				= $conn->real_escape_string($_POST['indigent']);

	$user_id				= $_SESSION['id'];//FOR USERNAME

	$residence_type 		= $conn->real_escape_string($_POST['residence_type']);

	$profile 				= $conn->real_escape_string($_POST['profileimg']); // base 64 image
	$profile2 				= $_FILES['img']['name'];


	// change profile2 name
	$newName = date('dmYHis').str_replace(" ", "", $profile2);

	// image file directory
  	$target = "../assets/uploads/resident_profile/".basename($newName);

  	//CHECK IF THERE'S A DUPLICATE NATIONAL ID
	$check = "SELECT id FROM tblresident2 WHERE national_id='$national_id'";
	$nat = $conn->query($check)->num_rows;

	//CHECK IF THERE'S A DUPLICATE EMAIL
	$checkEmail = "SELECT id FROM tblresident2 WHERE email='$email'";
	$check_em = $conn->query($checkEmail)->num_rows;

	if($nat == 0 || $national_id == ""){

		if($check_em == 0 || $email == "") {

			if(!empty($firstname)){

				if(!empty($profile) && !empty($profile2)){

					$query = "INSERT INTO tblresident2 
					(`national_id`, 
						`region`, 
						`city`, 
						`province`, 
						`barangay`, 
						`citizenship`, 
						`picture`, 
						`firstname`, 
						`middlename`, 
						`lastname`, 
						`ext`, 
						`alias`, 
						`birthplace`, 
						`birthdate`, 
						`sex`, 
						`civilstatus`, 
						`residence_type`, 
						`id_household`, 
						`family_head`,
						`date_of_residence`, 
						`vstatus`, 
						`identified_as`, 
						`phone`, 
						`email`, 
						`occupation`, 
						`id_org`, 
						`pwd`, 
						`indigent`, 
						`id_user`) 
								VALUES 
								('$national_id', 
									'$region', 
									'$city', 
									'$province', 
									'$barangay', 
									'$citizenship', 
									'$profile', 
									'$firstname', 
									'$middlename', 
									'$lastname', 
									'$ext', 
									'$alias', 
									'$birthplace', 
									'$birthdate', 
									'$sex', 
									'$civilstatus', 
									'$residence_type', 
									'$householdnumber', 
									'$family_head',
									'$date_of_residence', 
									'$vstatus', 
									'$identified_as', 
									'$phone', 
									'$email', 
									'$occupation', 
									'$organization', 
									'$pwd', 
									'$indigent', 
									'$user_id')
								";

					if($conn->query($query) === true){

						$_SESSION['message'] = 'Resident Information has been saved!';
						$_SESSION['success'] = 'success';
					}

				}else if(!empty($profile) && empty($profile2)){

					// $query = "INSERT INTO tblresident (`national_id`, `region`,`city`,`province`,`barangay`, citizenship, `picture`, `firstname`, `middlename`, `lastname`,`ext`, `alias`, `birthplace`, `birthdate`,  `civilstatus`, `sex`, `purok`,`residence_type`,`residence_remarks`, `voterstatus`, `identified_as`,`organization`,`pwd`,`indigent`, `phone`, `email`,occupation,h_num,`housenum`,`streetname`, `address`,`username`) 
					// 			VALUES ('$national_id','$region','$city','$province','$barangay','$citizen','$profile','$fname','$mname','$lname','$ext','$alias','$bplace','$bdate','$cstatus','$sex','$purok','$residence_type','$residence_remarks','$vstatus','$indetity','$organization','$pwd','$indigent','$number','$email','$occupation','$h_num','$housenum','$streetname','$address','$user_id')";

					$query = "INSERT INTO tblresident2 
					(`national_id`, 
						`region`, 
						`city`, 
						`province`, 
						`barangay`, 
						`citizenship`, 
						`picture`, 
						`firstname`, 
						`middlename`, 
						`lastname`, 
						`ext`, 
						`alias`, 
						`birthplace`, 
						`birthdate`, 
						`sex`, 
						`civilstatus`, 
						`residence_type`, 
						`id_household`, 
						`family_head`,
						`date_of_residence`, 
						`vstatus`, 
						`identified_as`, 
						`phone`, 
						`email`, 
						`occupation`, 
						`id_org`, 
						`pwd`, 
						`indigent`, 
						`id_user`) 
								VALUES 
								('$national_id', 
									'$region', 
									'$city', 
									'$province', 
									'$barangay', 
									'$citizenship', 
									'$profile', 
									'$firstname', 
									'$middlename', 
									'$lastname', 
									'$ext', 
									'$alias', 
									'$birthplace', 
									'$birthdate', 
									'$sex', 
									'$civilstatus', 
									'$residence_type', 
									'$householdnumber', 
									'$family_head',
									'$date_of_residence', 
									'$vstatus', 
									'$identified_as', 
									'$phone', 
									'$email', 
									'$occupation', 
									'$organization', 
									'$pwd', 
									'$indigent', 
									'$user_id')";

					if($conn->query($query) === true){

						$_SESSION['message'] = 'Resident Information has been saved!';
						$_SESSION['success'] = 'success';
					}

				}else if(empty($profile) && !empty($profile2)){

					// $query = "INSERT INTO tblresident (`national_id`, `region`,`city`,`province`,`barangay`, citizenship, `picture`, `firstname`, `middlename`, `lastname`,`ext`, `alias`, `birthplace`, `birthdate`,  `civilstatus`, `sex`, `purok`,`residence_type`,`residence_remarks`, `voterstatus`, `identified_as`,`organization`,`pwd`,`indigent`, `phone`, `email`, occupation,h_num,`housenum`,`streetname`, `address`, `username`) 
					// 			VALUES ('$national_id','$region','$city','$province','$barangay','$citizen','$newName','$fname','$mname','$lname','$ext','$alias','$bplace','$bdate','$cstatus','$sex','$purok','$residence_type','$residence_remarks','$vstatus','$indetity','$organization','$pwd','$indigent','$number','$email','$occupation','$h_num','$housenum','$streetname','$address','$user_id')";

					$query = "INSERT INTO tblresident2 
					(`national_id`, 
						`region`, 
						`city`, 
						`province`, 
						`barangay`, 
						`citizenship`, 
						`picture`, 
						`firstname`, 
						`middlename`, 
						`lastname`, 
						`ext`, 
						`alias`, 
						`birthplace`, 
						`birthdate`, 
						`sex`, 
						`civilstatus`, 
						`residence_type`, 
						`id_household`, 
						`family_head`,
						`date_of_residence`, 
						`vstatus`, 
						`identified_as`, 
						`phone`, 
						`email`, 
						`occupation`, 
						`id_org`, 
						`pwd`, 
						`indigent`, 
						`id_user`) 
								VALUES ('$national_id', 
									'$region', 
									'$city', 
									'$province', 
									'$barangay', 
									'$citizenship', 
									'$newName', 
									'$firstname', 
									'$middlename', 
									'$lastname', 
									'$ext', 
									'$alias', 
									'$birthplace', 
									'$birthdate', 
									'$sex', 
									'$civilstatus', 
									'$residence_type', 
									'$householdnumber', 
									'$family_head',
									'$date_of_residence', 
									'$vstatus', 
									'$identified_as', 
									'$phone', 
									'$email', 
									'$occupation', 
									'$organization', 
									'$pwd', 
									'$indigent', 
									'$user_id')";

					if($conn->query($query) === true){

						$_SESSION['message'] = 'Resident Information has been saved!';
						$_SESSION['success'] = 'success';

						if(move_uploaded_file($_FILES['img']['tmp_name'], $target)){

							$_SESSION['message'] = 'Resident Information has been saved!';
							$_SESSION['success'] = 'success';
						}
					}

				}else{

					// $query = "INSERT INTO tblresident (`national_id`,`region`,`city`,`province`,`barangay`,citizenship, `picture`,`firstname`, `middlename`, `lastname`,`ext`, `alias`, `birthplace`, `birthdate`,  `civilstatus`, `sex`, `purok`,`residence_type`,`residence_remarks`, `voterstatus`, `identified_as`,`organization`,`pwd`,`indigent`, `phone`, `email`, occupation,h_num,`housenum`,`streetname`, `address`,`username`) 
					// 			VALUES ('$national_id','$region','$city','$province','$barangay','$citizen','person.png','$fname','$mname','$lname','$ext','$alias','$bplace','$bdate','$cstatus','$sex','$purok','$residence_type','$residence_remarks','$vstatus','$indetity','$organization','$pwd','$indigent','$number','$email','$occupation','$h_num','$housenum','$streetname','$address','$user_id')";

					$query = "INSERT INTO tblresident2 
					(`national_id`, 
						`region`, 
						`city`, 
						`province`, 
						`barangay`, 
						`citizenship`, 
						`picture`, 
						`firstname`, 
						`middlename`, 
						`lastname`, 
						`ext`, 
						`alias`, 
						`birthplace`, 
						`birthdate`, 
						`sex`, 
						`civilstatus`, 
						`residence_type`, 
						`id_household`, 
						`family_head`,
						`date_of_residence`, 
						`vstatus`, 
						`identified_as`, 
						`phone`, 
						`email`, 
						`occupation`, 
						`id_org`, 
						`pwd`, 
						`indigent`, 
						`id_user`) 
								VALUES 
								('$national_id', 
									'$region', 
									'$city', 
									'$province', 
									'$barangay', 
									'$citizenship', 
									'person.png', 
									'$firstname', 
									'$middlename', 
									'$lastname', 
									'$ext', 
									'$alias', 
									'$birthplace', 
									'$birthdate', 
									'$sex', 
									'$civilstatus', 
									'$residence_type', 
									'$householdnumber', 
									'$family_head',
									'$date_of_residence', 
									'$vstatus', 
									'$identified_as', 
									'$phone', 
									'$email', 
									'$occupation', 
									'$organization', 
									'$pwd', 
									'$indigent', 
									'$user_id')";


					if($conn->query($query) === true){

						$_SESSION['message'] = 'Resident Information has been saved!';
						$_SESSION['success'] = 'success';
					}
				}

			}else{

				$_SESSION['message'] = 'Please complete the form!';
				$_SESSION['success'] = 'danger';
			}

		} else {
			$_SESSION['message'] = 'Email is already taken. Please enter a unique email address!';
			$_SESSION['success'] = 'danger';
		}

	}else{
		$_SESSION['message'] = 'National ID is already taken. Please enter a unique national ID!';
		$_SESSION['success'] = 'danger';
	}

    header("Location: ../resident2.php");

	$conn->close();


?>