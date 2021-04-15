<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/logincheck.php');
check_login();
//Ending a php session after 1(60 min) hours of inactivity
$minutesBeforeSessionExpire = 60;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($minutesBeforeSessionExpire * 60))) {
    session_unset();     // unset $_SESSION   
    session_destroy();   // destroy session data 
    $host = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = "../index.php";
    $_SESSION["login"] = "";
    header("Location: http://$host$uri/$extra");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity
$patientid = null;
if (isset($_GET['activate'])) {
    $patientid = $_GET['id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Receptionist | Regjistro pacientët</title>
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
                <p>Receptionist | Regjistro pacientët</p>
            </div>
            <div class="container-fullw">
                <?php
                $query = mysqli_query($con, "SELECT patients.id from patients WHERE patients.status=1 and patients.id='$patientid' and patients.id NOT IN(Select patientId from beds where patientId IS NOT NULL)");
                if (!$query) {
                    die(mysqli_error($con) . $query);
                } else {
                    $data = mysqli_fetch_array($query);
                    if ($data > 0) {

                ?>
                        <div class="panel-body no-padding">
                            <div class="panel-heading">
                                <h5 class="panel-title panel-white text-center">Regjistro pacientët</h5>
                            </div>
                            <form method="POST" id="ActivatePatientFrom" enctype="multipart/form-data">
                                <?php
                                $query2 = mysqli_query($con, "SELECT patients.id, patients.registered, patients.name as patientname, patients.surname as patientsurname,patients.patientID,patients.birthday, patients.gender,patients.phone as patientphone, patients.state as patientstate,patients.city as patientcity, patients.street_address as patientstreet, patients.email, patients.blood_type, emergencycontacts.name as emergname, emergencycontacts.surname as emergsurname, emergencycontacts.relation, emergencycontacts.state as emergstate, emergencycontacts.city as emergcity, emergencycontacts.street_address as emergstreet,emergencycontacts.phone as emergphone from patients, emergencycontacts WHERE patients.id='$patientid' and emergencycontacts.patientId=patients.id");
                                if (!$query2) {
                                    die(mysqli_error($con) . $query2);
                                } else {
                                    $data2 = mysqli_fetch_array($query2);
                                    if ($data2 > 0) {
                                ?>
                                        <div class="form-group row">
                                            <label for="example-datetime-local-input" class="input-title" style="margin-top: 7px;">Regjistruar:</label>
                                            <div class="col-10">
                                                <input type="text" readonly="readonly" class="form-control" id="Docstart-date" name="docstart_date" value="<?php echo htmlentities($data2['registered']) ?>">
                                            </div>
                                            <div class="form-group">
                                <label class="input-title">Arsyeja</label>
                                <textarea class="form-control" rows="5" maxlength="200" id="Description" name="description" placeholder="Arsyeja"></textarea>
                                <span id="Descriptionerror" style="color: red;"></span>
                            </div>
                                            <div class="div-inlineflex">
                                                <div class="form-group">
                                                    <label class="input-title" for="PatientName">
                                                        Emri:
                                                    </label>
                                                    <input type="text" id="NamePatient" readonly="readonly" name="namePatient" class="form-control" placeholder="Sheno emrin e pacientit" value="<?php echo htmlentities($data2['patientname']) ?>">
                                                    <span id="Nameerror" style="color: red;"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label class="input-title">Mbiemri:</label>
                                                    <input type="text" id="SurnamePatient" readonly="readonly" name="surnamePatient" class="form-control" placeholder="Sheno mbiemrin e pacientit" value="<?php echo htmlentities($data2['patientsurname']) ?>">
                                                    <span id="Surnameerror" style="color: red;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="patientId" class="input-title" style="margin-top: 7px;">ID:</label>
                                                <input type="number" id="IdPatient" name="idPatient" readonly="readonly" class="form-control" placeholder="Sheno ID" value="<?php echo htmlentities($data2['patientID']) ?>">
                                                <span id="IDerror" style="color: red;"></span>
                                            </div>
                                            <div class="div-inlineflex">
                                                <div class="form-group">
                                                    <label class="input-title">Datelindja</label>
                                                    <input type="date" class="form-control" id="Patientstart-date" readonly="readonly" name="patientstart_date" value="<?php echo htmlentities($data2['birthday']) ?>" />
                                                    <span id="Birthdayerror" style="color: red;"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label class="input-title">Gjinia</label>
                                                    <div class="input-title-btn">
                                                        <?php
                                                        $gender = $data2['gender'];
                                                        if (strcmp($gender, 'm') == 0) {
                                                        ?>
                                                            <input type="radio" name="patgender" checked value="m" onclick="return false;"> Mashkull<br>
                                                            <input type="radio" name="patgender" value="f" onclick="return false;"> Femër
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <input type="radio" name="patgender" value="m" onclick="return false;"> Mashkull<br>
                                                            <input type="radio" name="patgender" checked value="f" onclick="return false;"> Femër
                                                        <?php
                                                        }
                                                        ?>

                                                    </div>
                                                    <span id="Gendererror" style="color: red;"></span>
                                                </div>
                                            </div>
                                            <div class="div-inlineflex">
                                                <div class="form-group">
                                                    <label class="input-title">Shteti</label>
                                                    <input type="text" class="form-control" id="StateAddress" readonly="readonly" name="stateaddress" placeholder="Shteti" value="<?php echo htmlentities($data2['patientstate']) ?>">
                                                    <span id="Statedayerror" style="color: red;"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label class="input-title">Qyteti</label>
                                                    <input type="text" class="form-control" id="CityAddress" readonly="readonly" readonly="readonly" name="cityaddress" placeholder="Qyteti" value="<?php echo htmlentities($data2['patientcity']) ?>">
                                                    <span id="Citydayerror" style="color: red;"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="input-title">Adresa e rruges</label>
                                                <input type="text" class="form-control" id="StreetAddress" name="streetAddress" readonly="readonly" placeholder="Adresa e rrugës" value="<?php echo htmlentities($data2['patientstreet']) ?>">
                                                <span id="Streetaddresserror" style="color: red;"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="input-title">Numri i telefonit</label>
                                                <input class="form-control" readonly="readonly" id="phone-number" name="phone-number" value="<?php echo htmlentities($data2['patientphone']) ?>">
                                                <span id="Pronenumbererror" style="color: red;"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="input-title">Emaili</label>
                                                <input type="text" class="form-control" readonly="readonly" id="Patemail" name="patemail" placeholder="Emaili" value="<?php echo htmlentities($data2['email']) ?>">
                                                <span id="Emailerror" style="color: red;"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="input-title">Gjendja</label>
                                                <div class="input-title-btn">
                                                    <div class="form-check">
                                                        <input class="" type="radio" name="cond" value="red">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            <a href="#" type="button" class="btn btn-secondary" style=" background: red; border:1px solid rgb(255, 142, 142); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast emergjent. Kerkohet intervenim i menjehershem per shpetim te jetes. Riskt te madh per humbje te jetes.">Kuqe</a>
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="" type="radio" name="cond" value="yellow">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            <a href="#" type="button" class="btn btn-secondary" style="background: yellow; border:1px solid rgb(199, 199, 105); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast urgjent. Kerkohen shume resurse mirpo jo rreizk per jeten. Rast potencial resioz">Verdhë</a>
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="" type="radio" name="cond"  value="green">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            <a href="#" type="button" class="btn btn-secondary" style="background: green; border:1px solid rgb(128, 253, 128); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast me pak urgjent. Intervenim standard.">Gjelbër</a>
                                                        </label>
                                                    </div>
                                                </div>
                                                <span id="Conditionerror" style="color: red;"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="input-title" for="PatientRoom">
                                                    Shtrati:
                                                </label>
                                                <select name="PatientRoom" class="form-control patient-room">
                                                    <option value="0" selected value="">Asnje</option>
                                                    <?php
                                                    $query = mysqli_query($con, "SELECT beds.id as bedid, rooms.id as roomid, departaments.id as depid, departaments.depname FROM beds, rooms, departaments WHERE rooms.id=beds.roomId and rooms.depId=departaments.id and (beds.bedstatus=1 and rooms.roomstatus=1 and departaments.depstatus=1) and patientId is NULL ORDER BY departaments.depname ");
                                                    if (!$query) {
                                                        die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                                                    } else {
                                                        while ($data = mysqli_fetch_array($query)) {
                                                    ?>
                                                            <option value="<?php echo htmlentities($data['bedid']) ?>">Shtrati <?php echo htmlentities($data['bedid']) ?>, Dhoma <?php echo htmlentities($data['roomid']) ?>, Departamenti <?php echo htmlentities($data['depname']) ?> </option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <span id="Bederror" style="color: red;"></span>

                                            </div>
                                            <div class="form-group">

                                                <label class="input-title" for="PatientBloodtype">
                                                    Grupi i gjakut:
                                                </label>
                                                <select name="PatientBloodtype" readonly="readonly" class="form-control patient-departament">
                                                    <?php
                                                    $patientBloodType = $data2['blood_type'];
                                                    if (strcmp($patientBloodType, "0") == 0) {
                                                    ?>
                                                        <option value="0" selected="">Zgjidh grupin e gjakut</option>
                                                        <?php
                                                    }
                                                    $blodTypes = array("A+", "A-", "B+", "B-", "O+", "O-", "AB+", "AB-");
                                                    for ($count = 0; $count < count($blodTypes); $count++) {
                                                        if (strcmp($blodTypes[$count], $patientBloodType) !== 0) {
                                                        ?>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <option value="<?php echo $blodTypes[$count]; ?>" selected><?php echo $blodTypes[$count]; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group" style="margin-top: 10px;">
                                                <button type="submit" class="btn btn-primary">Aktivizo pacientin</button>
                                            </div>
                                    <?php
                                    }
                                }
                                    ?>
                            </form>
                        </div>
            </div>
    <?php
                    } else {
                        echo "Te dhena te panjohura.";
                    }
                }
    ?>
        </div>
    </div>
    </div>
    </div>
</body>

</html>


<script>
    $("#ActivatePatientFrom").submit(function(e) {
        var patientId='<?php echo $patientid; ?>';

        e.preventDefault();
        $('#Conditionerror').html("");
        $('#Bederror').html("");
        var myform = document.getElementById("ActivatePatientFrom");
        var fd = new FormData(myform);
        fd.append('patientid',patientId);
        $.ajax({
                url: "includes/activate-patient.inc.php",
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                method: 'POST'
            })
            .done(function(response) {
                $message = "";
                error = response.substring(0, 2);
                switch (error) {
                    case "24":
                        $message = "Zgjidhni njeren nga opsionet!";
                        $('#Conditionerror').html($message);
                        document.getElementById('Conditionerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                        case "25":
                        $message = "Zgjidhni njeren nga dhomat!";
                        $('#Bederror').html($message);
                        document.getElementById('Bederror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "26":
                        $message = "Kjo dhome tashme eshte e zene. Beni refresh faqen!";
                        $('#Bederror').html($message);
                        document.getElementById('Bederror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    default:
                        alert("Te dhenat u ruajten me sukses");
                        window.location.href = response;

                }
            });
        return false;
    });
</script>