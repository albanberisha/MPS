<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/logincheck.php');
check_login();
//Ending a php session after 1(60 min) hours of inactivity
$minutesBeforeSessionExpire = 60;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($minutesBeforeSessionExpire * 60))) {
    $uname=$_SESSION["login"];
    $onlnine=mysqli_query($con,"UPDATE users SET users.online=0 WHERE username='$uname'");
    session_unset();     // unset $_SESSION   
    session_destroy();   // destroy session data 
    $host = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = "../index.php";
    $_SESSION["login"] = "";
    header("Location: http://$host$uri/$extra");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Receptionist | Informata rreth dhomave</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type='text/javascript' src='https://code.jquery.com/jquery-1.11.0.js'></script>
    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script src="js/sidenavigation.js"></script>
    <script src="js/imagebrowse.js"></script>
    <script src="js/input-masks.js"></script>
    <script>
        function reportWindowSize() {
            var widthOutput = window.innerWidth;
            if (widthOutput < 960) {
                $('.centered-name-1').addClass('active');
                $('.dropdown-content-1').addClass('active');
                $(".closebtn").css("display", "none");
                $(".openbtn").css("display", "inline");
                $(".sidenav").css("width", "60px");
            }
        }

        window.onresize = reportWindowSize;
    </script>
</head>

<body onload="reportWindowSize()">
    <header>
        <?php include('includes/header.php'); ?>
        <hr style="margin-top:0px;">
    </header>
    <div class="" style="display: flex; margin-top: -16px; width: 100%;">
        <?php include('includes/sidebar.php'); ?>

        <div class="page" style="width: 100%;">
            <div class="card-header">
                <p>Receptionist | Informata rreth dhomave</p>
            </div>
            <div class="container-fullw">
                <div class="panel-body no-padding">
                    <div class="panel-heading">
                        <h5 class="panel-title panel-white text-center">Shtreterit dhe dhomat në spital</h5>
                    </div>
                    <div class="row" id="Rooms">
                        <?php
                        $query = mysqli_query($con, "SELECT beds.id, beds.patientId, patients.patientID as patID, patients.name, patients.surname,rooms.id as roomid,departaments.id as depid, departaments.depname from beds, patients,rooms,departaments where beds.patientId=patients.id and beds.roomId=rooms.id and rooms.depId=departaments.id and beds.bedstatus=1 UNION SELECT beds.id, beds.patientId, NULL,NULL,NULL,rooms.id as roomid,departaments.id as depid, departaments.depname from beds,rooms,departaments WHERE beds.patientId IS NULL and beds.roomId=rooms.id and rooms.depId=departaments.id and beds.bedstatus=1 ORDER by roomid ASC, id ASC");
                        if (!$query) {
                            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                        } else {
                            $previousroom = 1;
                            $thisdepartament="";
                            ?>
                            <div class="col-md-auto room">
                                <p class="roomnumber">Dhoma: <?php echo($previousroom); ?></p>
                                <div class="roomsplitter">
                                <?php
                            while (($data = mysqli_fetch_array($query))) {
                                $thisroom = $data['roomid'];
                                $thisdepartament=$data['depname'];
                                if ($thisroom != $previousroom ) {
                                  ?>
                                   </div>
                                    </div>
                                    <div class="col-md-auto room">
                                        <p class="roomnumber">Dhoma: <?php echo htmlentities($data['roomid']); ?></p>
                                        <div class="roomsplitter">
                                        <?php
                                    }
                                    $activebed = $data['patientId'];
                                    if ($activebed != NULL) {
                                        ?>
                                            <a href="view-patient.php?id=<?php echo $data['patientId'] ?>&view=patient" type="button" class="btn btn-secondary busy" data-toggle="tooltip" data-placement="bottom" title="Departamenti <?php echo htmlentities($data['depname']); ?>, Dhoma <?php echo htmlentities($data['roomid']); ?>. ID: <?php echo htmlentities($data['patID']); ?>, Emri dhe Mbiemri: <?php echo htmlentities($data['name']); ?> <?php echo htmlentities($data['surname']); ?>"><?php echo htmlentities($data['id']); ?></a>
                                        <?php
                                    } else {
                                        ?>
                                            <a href="register-patients.php" type="button" class="btn btn-secondary free" data-toggle="tooltip" data-placement="bottom" title="Departamenti <?php echo htmlentities($data['depname']); ?>, Dhoma <?php echo htmlentities($data['roomid']); ?>. E LIRE. "><?php echo htmlentities($data['id']); ?></a>

                                        <?php
                                    }
                                    $previousroom = $thisroom;
                                }
                                ?>
                                 
                                   </div>
                                   
                                 <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
