<?php include 'server/server.php' ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    session_start();

    // $_SESSION['user']      = $_SESSION['username'];
    $_SESSION['name']      = $conn->real_escape_string($_POST['name']);
    $_SESSION['amount']    = $conn->real_escape_string($_POST['amount']);
    $_SESSION['details']   = $conn->real_escape_string($_POST['details']);

    header('Location: model/save_pment.php');
}
?>

<?php 
    $id = $_GET['id'];

    $query = "SELECT * FROM tbl_special_permit WHERE id_special_permit = '$id'";
    $result = $conn->query($query);
    $s_permit = $result->fetch_assoc(); 

    $query1 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.id_position=tblposition.id_position WHERE tblposition.position NOT IN ('SK Chairrman')
                AND `status`='Incumbent' ORDER BY `order` ASC";
    $result1 = $conn->query($query1);
    $officials = array();
    while($row = $result1->fetch_assoc()){
        $officials[] = $row; 
    }

    $c = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.id_position=tblposition.id_position WHERE tblposition.position='Captain' OR tblposition.position='Barangay Chairman'";
    $captain = $conn->query($c)->fetch_assoc();

    $s = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.id_position=tblposition.id_position WHERE tblposition.position='Secretary'";
    $sec = $conn->query($s)->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Special Permit -  Barangay Management System</title>
</head>
<style type="text/css">
    .border {
        border-right: 1px solid black !important;
    }

    body{
        color: black;
    }

    #cont {
        position: relative;
        top: 0;
        left: 0;
    }

    #head {
        position: relative;
        top: 30px;
        left: 0;
/*        border: 1px green solid;*/
    }

    #brgylogo {
        position: absolute;
        top: 50px;
        left: 40px;
/*        border: 1px red solid;*/
    }

    #bg-brgylogo {
        position: absolute;
        top: 300px;
        left: 1px;
        width: 1000px;
        height: 1000px;
        opacity: 0.2;
/*        border: 1px red solid;*/
    }

    p { 
       padding: 0px; 
       margin: 0px; 
    } 
    .vl {
       border-left: 1px solid black;
       height: 100%;
       position: absolute;
       left: 50%;
       margin-left: 130px;
       top: -9px;
    }
</style>
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
								<h2 class="text-white fw-bold">Generate Certificate</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt--2">
						<div class="col-md-12">

                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>

                            <div class="alert alert-warning" role="alert">
                                    <b>DON'T REFRESH</b> this page!
                            </div>

                            <div class="card" id="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Special Permit</div>
										<div class="card-tools">
											<button class="btn btn-info btn-sm" onclick="printDiv('printThis')">
												<i class="fa fa-print"></i>
												Print Certificate
											</button>
										</div>
									</div>
								</div>
								<div class="card-body bg-brgylogo m-5" id="printThis">
                                    <div class="d-flex flex-wrap justify-content-center" style="border-bottom:1px solid black">
                                        <div class="container">
                                            <div class="row" id="cont">
                                                <img id="brgylogo" style="width:130px; height: 130px;" src="assets/uploads/<?= $brgy_logo ?>" class="img-fluid" />

                                                <img id="bg-brgylogo" src="assets/uploads/<?= $brgy_logo ?>" />

                                                <div class="col-12 p-3 text-center" id="head">
                                                    <!-- <span class="mb-0 fw-bold" style="font-size: 20px; font-family: Book Antiqua;">Republic of the Philippines</span><br>
                                                    <span class="mb-0 fw-bold" style="font-size: 20px; font-family: Book Antiqua;">City of <?= ucwords($town) ?></span><br>
                                                    <span class="mb-0 fw-bold" style="font-size: 20px; font-family: Book Antiqua;"><?= ucwords($brgy) ?></span>
                                                    <p class="fw-bold" style="font-size: 20px; padding-right: 0px; font-family: Book Antiqua;">OFFICE OF THE BARANGAY CHAIRMAN</p> -->

                                                    <p class="fw-bold" style="font-size: 20px; font-family: Book Antiqua; line-height: 23px;">Republic of the Philippines<br>City of <?= ucwords($town) ?><br><?= ucwords($brgy) ?><br><br>OFFICE OF THE BARANGAY CHAIRMAN</p>

                                                    <!-- <h3 class="mb-0 fw-bold" style="font-size: 20px; font-family: Book Antiqua;">Republic of the Philippines</h3>
                                                    <h3 class="mb-0 fw-bold" style="font-size: 20px; font-family: Book Antiqua;">City of <?= ucwords($town) ?></h3>
                                                    <h3 class="mb-0 fw-bold" style="font-size: 20px; font-family: Book Antiqua;"><?= ucwords($brgy) ?></h3><br>
                                                    <h3 class="mb-0 fw-bold" style="font-size: 20px; padding-right: 0px; font-family: Book Antiqua;">OFFICE OF THE BARANGAY CHAIRMAN</h3> -->

                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
									</div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            <div class="text-center border border-top-0 border-left-0 border-bottom-0" style="margin-top: -9px;">
                                                <!-- <img style="margin-top: 10px;" src="assets/uploads/resident_profile/<?= $resident['picture'] ?>" class="img-fluid" width="200" /> --><br><br>
                                                <div class="text-left">
                                                    <h3 class="mt-3 mb-0" style="line-height: 20px; font-family: Book Antiqua;"><span class="fw-bold"><u>Barangay Officials</u></span><br><h5 style="font-family: Georgia;"><?= ucwords($brgy) ?></h5></h3><br>
                                                    <?php if(!empty($officials)):?>
                                                        <?php foreach($officials as $row): ?>
                                                            <h3 class="mb-0" style="line-height: 20px; font-family: Georgia;"><span class="fw-bold text-uppercase font-italic">

                                                                <!-- <?php if($row['position'] == 'Secretary' || $row['position'] == 'Treasurer'): ?>
                                                                MS.  
                                                                <?php else: ?>
                                                                HON. 
                                                                <?php endif ?> -->

                                                                <?= $row['honorifics'] ?> <?= ucwords($row['name']) ?></span><br><h5 style="font-family: Georgia;"><i><?= ucwords($row['position']) ?></i></h5></h3>
                                                            <h5 class="mb-2 text-uppercase">&nbsp</h5>
                                                        <?php endforeach ?>
                                                    <?php endif ?>
                                                </div>
                                                <!-- <div class="vl"></div> -->
                                            </div>
                                            
                                        </div>

                                        <div class="col-md-8">
                                            <div class="text-center">
                                                <h2 class="mt-4 fw-bold"> </h2>
                                            </div>

                                            <br>
                                            <br>
                                            <br>

                                            <div class="text-center">
                                                <h1 class="mt-4 fw-bold mb-5" style="font-family: Book Antiqua; font-size: 30px;">S P E C I A L &nbsp &nbsp P E R M I T</h1>
                                            </div>

                                            <br>
                                            <br>
                                            <br>
                                            <br>

                                            <h2 class="mt-5 fw-bold" style="font-family: Book Antiqua;">
                                                TO WHOM IT MAY CONCERN:
                                            </h2>

                                            <h2 class="mt-3" style="font-family: Book Antiqua; text-indent: 90px; line-height: 50px; text-align: justify;">
                                                <!-- <span class="fw-bold text-uppercase">This is to certify</span> that <span class="fw-bold" style="font-size:25px"><?= ucwords($resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?></span>, of legal age, <span class="text-lowercase"><?= ucwords($resident['civilstatus']) ?></span>, <?= ucwords($resident['citizenship']) ?> Citizen, a resident of 
                                                <span><?= ucwords($resident['address']) ?>, <?= ucwords($brgy) ?>, <?= ucwords($resident['city']) ?> City</span>, Philippines, is known to me to be of good moral character and a law abiding citizen with no derogatory records whatsoever. -->

                                                <span class="fw-bold">PERMIT</span> is hereby granted to <span class="fw-bold text-uppercase"><?= $s_permit['grantee'] ?></span> with representative <span class="text-uppercase"><?= $s_permit['representative'] ?>, </span><?= $s_permit['action'] ?>. The installation will start from <?= date("F d, Y", strtotime($s_permit['start_date'])); ?> and will expire on <?= date("F d, Y", strtotime($s_permit['end_date'])) ?>.


                                            </h2>

                                            <h2 class="mt-3" style="font-family: Book Antiqua; text-indent: 90px; line-height: 50px; text-align: justify;">
                                                
                                            </h2>

                                            <h2 class="mt-3 mb-5" style="font-family: Book Antiqua; text-indent: 90px; line-height: 50px; text-align: justify;">
                                                Issued this <span class="fw-bold" style="font-size:25px"><?= date("F d/Y", strtotime($s_permit['issued_date'])); ?></span>, <?= $brgy ?>, City of <?= $town ?>.
                                            </h2>

                                            <br>
                                            <br>
                                            <br>
                                            <br>

                                            <div style="float: right;">
                                                <h2 style="font-family: Book Antiqua; text-align: center; line-height: 25px;" class="mt-5"><u><span class="fw-bold text-uppercase"><?= ucwords($captain['name']) ?></span></u><br><span style="text-align: center;">Barangay Chairman</span></h2>
                                                <p class="mr-3"></p>
                                            </div>
                                            

                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>

                                            <div style="margin-top: 10%;">
                                                <h5 style="font-family: Book Antiqua; text-align: left; line-height: 20px;">Issued On<span style="font-family: Book Antiqua; margin-left: 30px;"><u><?= date("m-d-y") ?></u></span><br>Amount<span style="font-family: Book Antiqua; margin-left: 42px;"><u>P <?= number_format($_SESSION['amount'],2) ?></u></span></h5>
                                                <p class="mr-3"></p>
                                            </div>
                                        </div>

                                        <!-- <div class="col-md-12">
                                            <div class="p-3 text-right mr-3">
                                                <h2 style="line-height: 20px;"><span class="fw-bold text-uppercase"><?= ucwords($captain['name']) ?></span><br>Barangay Chairman</h2>
                                                <p class="mr-3"></p>
                                            </div>
                                            <div class="p-3 text-left">
                                                <h2 class="fw-bold mb-0 text-uppercase"><?= empty($sec['name']) ? 'Please Create Official with Secretary Position' : ucwords($sec['name']) ?></h2>
                                                <p class="ml-2">BARANGAY SECRETARY</p>
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-md-12 d-flex flex-wrap justify-content-end">
                                            <div class="p-3 text-center">
                                                <div class="border mb-3" style="height:150px;width:290px">
                                                    <p class="mt-5 mb-0 pt-5">Right Thumb Mark</p>
                                                </div>
                                                <h2 class="fw-bold mb-0"><?= ucwords($resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?></h2>
                                                <p>Tax Payer's Signature</p>
                                            </div>
                                        </div> -->
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

            <!-- Payment Modal -->
            <div class="modal fade" id="pment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Payment</h5>
                            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button> -->
                        </div>
                        <div class="modal-body">
                            <!-- <form method="POST" action="model/save_pment.php" > -->
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <div class="form-group">
                                    <label>Amount<span class="text-danger"><b> *</b></span></label>
                                    <input type="number" class="form-control" name="amount" placeholder="Enter amount to pay" required>
                                </div>
                                <div class="form-group">
                                    <label>Date Issued<span class="text-danger"><b> *</b></span></label>
                                    <input type="date" class="form-control" name="date" value="<?= date('Y-m-d') ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Payment Details(Optional)</label>
                                    <textarea class="form-control" placeholder="Enter Payment Details" name="details">Special Permit Payment</textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="name" value="<?= $s_permit['grantee'] ?>">
                            <button type="button" class="btn btn-secondary" onclick="goBack()">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			<?php if(!isset($_GET['closeModal'])){ ?>
            
                <script>
                    setTimeout(function(){ openModal(); }, 1000);
                </script>
            <?php } ?>
		</div>
		
	</div>
	<?php include 'templates/footer.php' ?>
    <script>
            function openModal(){
                $('#pment').modal('show');
            }
            
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;

                window.location.replace("special_permit.php");
            }
    </script>
</body>
</html>