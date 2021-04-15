<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/logincheck.php');
check_login();
//Ending a php session after 6(360 min) hours of inactivity
$minutesBeforeSessionExpire = 360;
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

$patient = null;
if (isset($_GET['edit'])) {
    $patient = $_GET['id'];
    $_SESSION['patientid'] = $patient;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Receptionist | Menaxho pacientët</title>
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
                <p>Receptionist | Menaxho pacientët</p>
            </div>
            <div class="container-fullw">
                <?php
                $query = mysqli_query($con, "SELECT patients.id from patients WHERE patients.status=1 and patients.id='$patient' UNION SELECT patients.id FROM patients WHERE patients.id='$patient' and patients.id IN( SELECT deaths.patientId FROM deaths)");
                if (!$query) {
                    die(mysqli_error($con) . $query);
                } else {
                    $data = mysqli_fetch_array($query);
                    if ($data > 0) {
                ?>
                        <div class="panel-body no-padding">
                            <div class="panel-heading">
                                <h5 class="panel-title panel-white text-center">Menaxho pacientët</h5>
                            </div>
                            <form method="POST" id="EditPatientFrom" enctype="multipart/form-data">
                                <?php
                                $query2 = mysqli_query($con, "SELECT patients.id, patients.registered, patients.name as patientname, patients.surname as patientsurname,patients.patientID,patients.birthday, patients.gender,patients.phone as patientphone, patients.state as patientstate,patients.city as patientcity, patients.street_address as patientstreet, patients.email, patients.blood_type, emergencycontacts.name as emergname, emergencycontacts.surname as emergsurname, emergencycontacts.relation, emergencycontacts.state as emergstate, emergencycontacts.city as emergcity, emergencycontacts.street_address as emergstreet,emergencycontacts.phone as emergphone from patients, emergencycontacts WHERE patients.id='$patient' and emergencycontacts.patientId=patients.id");
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
                                        </div>
                                        <div class="div-inlineflex">
                                            <div class="form-group">
                                                <label class="input-title" for="PatientName">
                                                    Emri:
                                                </label>
                                                <input type="text" id="NamePatient" name="namePatient" class="form-control" placeholder="Sheno emrin e pacientit" value="<?php echo htmlentities($data2['patientname']) ?>">
                                                <span id="Nameerror" style="color: red;"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="input-title">Mbiemri:</label>
                                                <input type="text" id="SurnamePatient" name="surnamePatient" class="form-control" placeholder="Sheno mbiemrin e pacientit" value="<?php echo htmlentities($data2['patientsurname']) ?>">
                                                <span id="Surnameerror" style="color: red;"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="patientId" class="input-title" style="margin-top: 7px;">ID:</label>
                                            <input type="number" id="IdPatient" name="idPatient" class="form-control" placeholder="Sheno ID" value="<?php echo htmlentities($data2['patientID']) ?>">
                                            <span id="IDerror" style="color: red;"></span>
                                        </div>
                                        <div class="div-inlineflex">
                                            <div class="form-group">
                                                <label class="input-title">Datelindja</label>
                                                <input type="date" class="form-control" id="Patientstart-date" name="patientstart_date" value="<?php echo htmlentities($data2['birthday']) ?>" />
                                                <span id="Birthdayerror" style="color: red;"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="input-title">Gjinia</label>
                                                <div class="input-title-btn">
                                                    <?php
                                                    $gender = $data2['gender'];
                                                    if (strcmp($gender, 'm') == 0) {
                                                    ?>
                                                        <input type="radio" name="patgender" checked value="m"> Mashkull<br>
                                                        <input type="radio" name="patgender" value="f"> Femër
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <input type="radio" name="patgender" value="m"> Mashkull<br>
                                                        <input type="radio" name="patgender" checked value="f"> Femër
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
                                                <input type="text" class="form-control" id="StateAddress" name="stateaddress" placeholder="Shteti" value="<?php echo htmlentities($data2['patientstate']) ?>">
                                                <span id="Statedayerror" style="color: red;"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="input-title">Qyteti</label>
                                                <input type="text" class="form-control" id="CityAddress" name="cityaddress" placeholder="Qyteti" value="<?php echo htmlentities($data2['patientcity']) ?>">
                                                <span id="Citydayerror" style="color: red;"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="input-title">Adresa e rruges</label>
                                            <input type="text" class="form-control" id="StreetAddress" name="streetAddress" placeholder="Adresa e rrugës" value="<?php echo htmlentities($data2['patientstreet']) ?>">
                                            <span id="Streetaddresserror" style="color: red;"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="input-title">Numri i telefonit</label>
                                            <input class="form-control" id="phone-number" name="phone-number" value="<?php echo htmlentities($data2['patientphone']) ?>">
                                            <span id="Pronenumbererror" style="color: red;"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="input-title">Emaili</label>
                                            <input type="text" class="form-control" id="Patemail" name="patemail" placeholder="Emaili" value="<?php echo htmlentities($data2['email']) ?>">
                                            <span id="Emailerror" style="color: red;"></span>
                                        </div>
                                        <?php
                                        $patientstatus = -1;
                                        $query3 = mysqli_query($con, "SELECT deaths.patientId,deaths.deathDay, deaths.deathTime,deaths.deathCause FROM deaths WHERE patientId='$patient'");
                                        if (!$query3) {
                                            die(mysqli_error($con) . $query3);
                                        } else {
                                            $data3 = mysqli_fetch_array($query3);
                                            if ($data3 > 0) {
                                                $patientstatus = 0;
                                        ?>
                                                <div>
                                                    <div class="form-group">
                                                        <label class="input-title">Statusi</label>
                                                        <input type="text" readonly="readonly" class="form-control" name="patientstatus" value="Vdekur">
                                                    </div>
                                                </div>
                                                <div>
                                                    <?php
                                                } else {
                                                    $patientstatus = 0;
                                                    $query4 = mysqli_query($con, "SELECT patients.id FROM patients where patients.id='$patient' and patients.status='1' and patients.id NOT IN(SELECT patientId FROM beds where patientId='$patient')");
                                                    if (!$query4) {
                                                        die(mysqli_error($con) . $query4);
                                                    } else {
                                                        $data4 = mysqli_fetch_array($query4);
                                                        if ($data4 > 0) {
                                                    ?>
                                                            <div class="form-group">
                                                                <label class="input-title">Statusi</label>
                                                                <div class="form-group">
                                                                    <div class="div-inlineflex marg-in">
                                                                        <input type="text" readonly="readonly" class="form-control" name="patientstatus" value="Jo aktiv">
                                                                        <button type="button" id="Register" class="btn btn-primary btn-send">Regjistro</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        } else {
                                                            $patientstatus = 1;
                                                            $query5 = mysqli_query($con, "SELECT beds.id as bednumber,beds.condition,rooms.id as roomnumber, departaments.id as depid, departaments.depname from beds, rooms,departaments where beds.roomId=rooms.id and rooms.depId=departaments.id and beds.patientId='$patient'");
                                                            if (!$query5) {
                                                                die(mysqli_error($con) . $query5);
                                                            } else {
                                                                $data5 = mysqli_fetch_array($query5);
                                                                if ($data5 > 0) {
                                                            ?>
                                                                    <div class="form-group">
                                                                        <label class="input-title">Gjendja</label>
                                                                        <div class="input-title-btn">
                                                                            <?php
                                                                            $condition = $data5['condition'];
                                                                            switch ($condition) {
                                                                                case "red":
                                                                            ?>
                                                                                    <div class="form-check">
                                                                                        <input class="" type="radio" name="cond" value="red" checked>
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
                                                                                        <input class="" type="radio" name="cond" value="green">
                                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                                            <a href="#" type="button" class="btn btn-secondary" style="background: green; border:1px solid rgb(128, 253, 128); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast me pak urgjent. Intervenim standard.">Gjelbër</a>
                                                                                        </label>
                                                                                    </div>
                                                                                <?php
                                                                                    break;
                                                                                case "yellow":
                                                                                ?>
                                                                                    <div class="form-check">
                                                                                        <input class="" type="radio" name="cond" value="red">
                                                                                        <a href="#" type="button" class="btn btn-secondary" style=" background: red; border:1px solid rgb(255, 142, 142); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast emergjent. Kerkohet intervenim i menjehershem per shpetim te jetes. Riskt te madh per humbje te jetes.">Kuqe</a>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input class="" type="radio" name="cond" value="yellow" checked>
                                                                                        <a href="#" type="button" class="btn btn-secondary" style="background: yellow; border:1px solid rgb(199, 199, 105); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast urgjent. Kerkohen shume resurse mirpo jo rreizk per jeten. Rast potencial resioz">Verdhë</a>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input class="" type="radio" name="cond" value="green">
                                                                                        <a href="#" type="button" class="btn btn-secondary" style="background: green; border:1px solid rgb(128, 253, 128); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast me pak urgjent. Intervenim standard.">Gjelbër</a>
                                                                                    </div>
                                                                                <?php
                                                                                    break;
                                                                                default:
                                                                                ?>
                                                                                    <div class="form-check">
                                                                                        <input class="" type="radio" name="cond" value="red">
                                                                                        <a href="#" type="button" class="btn btn-secondary" style=" background: red; border:1px solid rgb(255, 142, 142); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast emergjent. Kerkohet intervenim i menjehershem per shpetim te jetes. Riskt te madh per humbje te jetes.">Kuqe</a>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input class="" type="radio" name="cond" value="yellow">
                                                                                        <a href="#" type="button" class="btn btn-secondary" style="background: yellow; border:1px solid rgb(199, 199, 105); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast urgjent. Kerkohen shume resurse mirpo jo rreizk per jeten. Rast potencial resioz">Verdhë</a>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input class="" type="radio" name="cond" value="green" checked>
                                                                                        <a href="#" type="button" class="btn btn-secondary" style="background: green; border:1px solid rgb(128, 253, 128); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast me pak urgjent. Intervenim standard.">Gjelbër</a>
                                                                                    </div>
                                                                            <?php
                                                                            }
                                                                            ?>

                                                                        </div>
                                                                        <span id="Conditionerror" style="color: red;"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="input-title" for="PatientRoom">
                                                                            Shtrati:
                                                                        </label>
                                                                        <select name="PatientRoom" class="form-control patient-room">
                                                                            <?php
                                                                            $query = mysqli_query($con, "SELECT beds.id as bedid, rooms.id as roomid, departaments.id as depid, departaments.depname FROM beds, rooms, departaments WHERE beds.patientId='$patient' and rooms.id=beds.roomId and rooms.depId=departaments.id and (beds.bedstatus=1 and rooms.roomstatus=1 and departaments.depstatus=1)  ORDER BY departaments.depname ");
                                                                            if (!$query) {
                                                                                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                                                                            } else {
                                                                                $data = mysqli_fetch_array($query);
                                                                                if ($data > 0) {
                                                                            ?>
                                                                                    <option value="<?php echo htmlentities($data['bedid']) ?>">Shtrati <?php echo htmlentities($data['bedid']) ?>, Dhoma <?php echo htmlentities($data['roomid']) ?>, Departamenti <?php echo htmlentities($data['depname']) ?> </option>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <option value="0" selected value="">Asnje</option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
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
                                                                        <span id="Roomerror" style="color: red;"></span>
                                                                    </div>
                                            <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                            <div class="form-group">

                                                <label class="input-title" for="PatientBloodtype">
                                                    Grupi i gjakut:
                                                </label>
                                                <select name="PatientBloodtype" class="form-control patient-departament">
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
                                                            <option value="<?php echo $blodTypes[$count]; ?>"><?php echo $blodTypes[$count]; ?></option>
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
                                            <div>
                                                <h5 class="panel-title panel-white text-center">Kontakt ne rast emergjence</h5>
                                                <div class="div-inlineflex">
                                                    <div class="form-group">
                                                        <label class="input-title" for="PatientName">
                                                            Emri i kontaktit:
                                                        </label>
                                                        <input type="text" id="Name2" name="name2" class="form-control" placeholder="Sheno emrin " value="<?php echo htmlentities($data2['emergname']) ?>" />
                                                        <span id="Nameerror2" style="color: red;"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="input-title">Mbiemri:</label>
                                                        <input type="text" name="surname2" id="Surname2" class="form-control" placeholder="Sheno mbiemrin" value="<?php echo htmlentities($data2['emergsurname']) ?>">
                                                        <span id="Surnameerror2" style="color: red;"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="input-title">Afersia</label>
                                                    <input type="text" id="C2" name="c2" class="form-control" placeholder="Sheno afersine" value="<?php echo htmlentities($data2['relation']) ?>">
                                                    <span id="Error2" style="color: red;"></span>
                                                </div>
                                                <div class="div-inlineflex">
                                                    <div class="form-group">
                                                        <label class="input-title">Shteti</label>
                                                        <input type="text" class="form-control" id="StateAddress2" name="stateaddress2" placeholder="Shteti" value="<?php echo htmlentities($data2['emergstate']) ?>">
                                                        <span id="Statedayerror2" style="color: red;"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="input-title">Qyteti</label>
                                                        <input type="text" class="form-control" id="CityAddress2" name="cityaddress2" placeholder="Qyteti" value="<?php echo htmlentities($data2['emergcity']) ?>">
                                                        <span id="Citydayerror2" style="color: red;"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="input-title">Adresa e rruges</label>
                                                    <input type="text" class="form-control" id="StreetAddress2" name="streetAddress2" placeholder="Adresa e rrugës" value="<?php echo htmlentities($data2['emergstreet']) ?>">
                                                    <span id="Streetaddresserror2" style="color: red;"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label class="input-title">Numri i telefonit</label>
                                                    <input class="form-control" id="phone-number2" name="phone-number2" value="<?php echo htmlentities($data2['emergphone']) ?>">
                                                    <span id="Pronenumbererror2" style="color: red;"></span>
                                                </div>
                                                <div class="form-group" style="margin-top: 10px;">
                                                    <button type="submit" class="btn btn-primary">Ndrysho</button>
                                                </div>
                                            </div>
                            </form>
                        </div>
        <?php
                                    }
                                }
                            } else {
                                echo "Te dhena te panjohura.";
                            }
                        }
        ?>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    $("#Register").on('click', function() {
        window.open('reg-patient.php?id=<?php echo $patient ?>&activate=patient', '_self');
    });

    $("#EditPatientFrom").submit(function(e) {
       var patientstatus='<?php echo $patientstatus ?>';
       e.preventDefault();
        $('#Nameerror').html("");
        $('#Surnameerror').html("");
        $('#IDerror').html("");
        $('#Birthdayerror').html("");
        $('#Gendererror').html("");
        $('#Statedayerror').html("");
        $('#Citydayerror').html("");
        $('#Streetaddresserror').html("");
        $('#Pronenumbererror').html("");
        $('#Emailerror').html("");
        $('#Conditionerror').html("");
        $('#Roomerror').html("");
        $('#Nameerror2').html("");
        $('#Surnameerror2').html("");
        $('#Error2').html("");
        $('#Statedayerror2').html("");
        $('#Citydayerror2').html("");
        $('#Streetaddresserror2').html("");
        
        $('#Pronenumbererror2').html("");
        var myform = document.getElementById("EditPatientFrom");
        var fd = new FormData(myform);
        fd.append('patientstatuss',patientstatus);
        $.ajax({
                url: "includes/edit-patient1.inc.php",
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                method: 'POST'
            })
            .done(function(response) {
                $message = "";
                error=response.substring(0,2);
                switch (error) {
                    case "1":
                        $message = "Emri duhet te permbaje vetem shkronja dhe nuk mund te jete i zbrazet!";
                        $('#Nameerror').html($message);
                        document.getElementById('Nameerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "2":
                        $message = "Mbiemri duhet te permbaje vetem shkronja dhe nuk mund te jete i zbrazet!";
                        $('#Surnameerror').html($message);
                        document.getElementById('Surnameerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "3":
                        $message = "Nuk duhet te jete i zbrazet!";
                        $('#Birthdayerror').html($message);
                        document.getElementById('Birthdayerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "4":
                        $message = "Zgjidhni njeren nga opsionet!";
                        $('#Gendererror').html($message);
                        document.getElementById('Gendererror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "5":
                        $message = "Shenoni shtetin!";
                        $('#Statedayerror').html($message);
                        document.getElementById('Statedayerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "6":
                        $message = "Shenoni qytetin!";
                        $('#Citydayerror').html($message);
                        document.getElementById('Citydayerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "7":
                        $message = "Shenoni adresen!";
                        $('#Streetaddresserror').html($message);
                        document.getElementById('Streetaddresserror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "8":
                        $message = "Shenoni numrin e telefonit!";
                        $('#Pronenumbererror').html($message);
                        document.getElementById('Pronenumbererror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "9":
                        $message = "Format i gabuar!";
                        $('#Emailerror').html($message);
                        document.getElementById('Emailerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "10":
                        $message = "Kjo dhome tashme eshte e zene. Beni refresh faqen!";
                        $('#Roomerror').html($message+response);
                        document.getElementById('Roomerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;



                    case "11":
                        $message = "Emri duhet te permbaje vetem shkronja!";
                        $('#Nameerror2').html($message);
                        document.getElementById('Nameerror2').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "12":
                        $message = "Mbiemri duhet te permbaje vetem shkronja!";
                        $('#Surnameerror2').html($message);
                        document.getElementById('Surnameerror2').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "13":
                        $message = "Duhet te permbaje vetem shkronja.";
                        $('#Error2').html($message);
                        document.getElementById('Error2').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "15":
                        $message = "Shenoni shtetin!";
                        $('#Statedayerror2').html($message);
                        document.getElementById('Statedayerror2').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "16":
                        $message = "Shenoni qytetin!";
                        $('#Citydayerror2').html($message);
                        document.getElementById('Citydayerror2').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "17":
                        $message = "Shenoni adresen!";
                        $('#Streetaddresserror2').html($message);
                        document.getElementById('Streetaddresserror2').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "18":
                        $message = "Shenoni numrin e telefonit!";
                        $('#Pronenumbererror2').html($message);
                        document.getElementById('Pronenumbererror2').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "19":
                        $message = "Shenoni ID e pacientit!";
                        $('#IDerror').html($message);
                        document.getElementById('IDerror').scrollIntoView({
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