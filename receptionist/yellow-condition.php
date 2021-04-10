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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Receptionist | Regjistrim i pacientëve</title>
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
                <p>Receptionist | Regjistrim i pacientëve</p>
            </div>
            <div class="container-fullw">
                <div class="panel-body no-padding" style="border: 1px solid yellow;">
                    <div class="panel-heading">
                        <h5 class="panel-title panel-white text-center">Rast urgjent</h5>
                    </div>
                    <form method="POST" id="YellowConditionFrom" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="example-datetime-local-input" class="input-title" style="margin-top: 7px;">Data:</label>
                            <div class="col-10">
                                <input type="datetime" readonly="readonly" class="form-control" id="Reg-date" name="reg_date" value="<?php echo date(" Y-m-d H:i:sa "); ?>">
                            </div>
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
                                <input type="text" id="NamePatient" name="namePatient" class="form-control" placeholder="Sheno emrin e pacientit">
                                <span id="Nameerror" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label class="input-title">Mbiemri:</label>
                                <input type="text" id="SurnamePatient" name="surnamePatient" class="form-control" placeholder="Sheno mbiemrin e pacientit">
                                <span id="Surnameerror" style="color: red;"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="patientId" class="input-title" style="margin-top: 7px;">ID:</label>
                            <input type="number" id="IdPatient" name="idPatient" class="form-control" placeholder="Sheno ID">
                            <span id="IDerror" style="color: red;"></span>
                        </div>
                        <div class="div-inlineflex">
                            <div class="form-group">
                                <label class="input-title">Datelindja</label>
                                <input type="date" class="form-control" id="Patientstart-date" name="patientstart_date" />
                                <span id="Birthdayerror" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label class="input-title">Gjinia</label>
                                <div class="input-title-btn">
                                    <input type="radio" name="patgender" value="m" checked> Mashkull<br>
                                    <input type="radio" name="patgender" value="f"> Femër
                                </div>
                                <span id="Gendererror" style="color: red;"></span>
                            </div>
                        </div>
                        <div class="div-inlineflex">
                            <div class="form-group">
                                <label class="input-title">Shteti</label>
                                <input type="text" class="form-control" id="StateAddress" name="stateaddress" placeholder="Shteti">
                                <span id="Statedayerror" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label class="input-title">Qyteti</label>
                                <input type="text" class="form-control" id="CityAddress" name="cityaddress" placeholder="Qyteti">
                                <span id="Citydayerror" style="color: red;"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="input-title">Adresa e rruges</label>
                            <input type="text" class="form-control" id="StreetAddress" name="streetAddress" placeholder="Adresa e rrugës">
                            <span id="Streetaddresserror" style="color: red;"></span>
                        </div>
                        <div class="form-group">
                            <label class="input-title">Numri i telefonit</label>
                            <input class="form-control" id="phone-number" name="phone-number">
                            <span id="Pronenumbererror" style="color: red;"></span>
                        </div>
                        <div class="form-group">
                            <label class="input-title">Emaili</label>
                            <input type="text" class="form-control" id="Patemail" name="patemail" placeholder="Emaili">
                            <span id="Emailerror" style="color: red;"></span>
                        </div>
                        <div class="form-group">
                            <label class="input-title" for="PatientRoom">
                                Shtrati:
                            </label>
                            <select name="PatientRoom" class="form-control patient-room">
                                <option value="0" selected value="">Asnje</option>
                                <?php
                                $query = mysqli_query($con, "SELECT beds.id as bedid, rooms.id as roomid, departaments.id as depid, departaments.depname FROM beds, rooms, departaments WHERE rooms.id=beds.roomId and rooms.depId=departaments.id and (beds.bedstatus=1 and rooms.roomstatus=1 and departaments.depname like '%urgjenc%' and departaments.depstatus=1) and patientId is NULL");
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
                        </div>
                        <div class="form-group">
                            <label class="input-title" for="PatientDept">
                                Grupi i gjakut:
                            </label>
                            <select name="PatientBloodtype" class="form-control patient-departament">
                                <option value="0" selected="">Zgjidh grupin e gjakut</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>
                        <div>
                            <h5 class="panel-title panel-white text-center">Kontakt ne rast emergjence</h5>
                            <div class="div-inlineflex">
                                <div class="form-group">
                                    <label class="input-title" for="PatientName">
                                        Emri i kontaktit:
                                    </label>
                                    <input type="text" id="Name2" name="name2" class="form-control" placeholder="Sheno emrin " />
                                    <span id="Nameerror2" style="color: red;"></span>
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Mbiemri:</label>
                                    <input type="text" name="surname2" id="Surname2" class="form-control" placeholder="Sheno mbiemrin">
                                    <span id="Surnameerror2" style="color: red;"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="input-title">Afersia</label>
                                <input type="text" id="C2" name="c2" class="form-control" placeholder="Sheno afersine">
                                <span id="Error2" style="color: red;"></span>
                            </div>

                            <div class="div-inlineflex">
                                <div class="form-group">
                                    <label class="input-title">Shteti</label>
                                    <input type="text" class="form-control" id="StateAddress2" name="stateaddress2" placeholder="Shteti">
                                    <span id="Statedayerror2" style="color: red;"></span>
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Qyteti</label>
                                    <input type="text" class="form-control" id="CityAddress2" name="cityaddress2" placeholder="Qyteti">
                                    <span id="Citydayerror2" style="color: red;"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="input-title">Adresa e rruges</label>
                                <input type="text" class="form-control" id="StreetAddress2" name="streetAddress2" placeholder="Adresa e rrugës">
                                <span id="Streetaddresserror2" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label class="input-title">Numri i telefonit</label>
                                <input class="form-control" id="phone-number2" name="phone-number2">
                                <span id="Pronenumbererror2" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="Cond" name="cond" value="yellow">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 10px;">
                            <button type="submit" class="btn btn-primary">Regjistro</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    $("#YellowConditionFrom").submit(function(e) {
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
        $('#Nameerror2').html("");
        $('#Surnameerror2').html("");
        $('#Error2').html("");
        $('#Statedayerror2').html("");
        $('#Citydayerror2').html("");
        $('#Streetaddresserror2').html("");
        $('#Pronenumbererror2').html("");
        var myform = document.getElementById("YellowConditionFrom");
        var fd = new FormData(myform);
        $.ajax({
                url: "includes/add-patient.inc.php",
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                method: 'POST'
            })
            .done(function(response) {
                $message = "";
                switch (response) {
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
                        $message = "Emri duhet te permbaje vetem shkronja!";
                        $('#Nameerror2').html($message);
                        document.getElementById('Nameerror2').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "11":
                        $message = "Mbiemri duhet te permbaje vetem shkronja!";
                        $('#Surnameerror2').html($message);
                        document.getElementById('Surnameerror2').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "12":
                        $message = "Duhet te permbaje vetem shkronja.";
                        $('#Error2').html($message);
                        document.getElementById('Error2').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "13":
                        $message = "Shenoni shtetin!";
                        $('#Statedayerror2').html($message);
                        document.getElementById('Statedayerror2').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "14":
                        $message = "Shenoni qytetin!";
                        $('#Citydayerror2').html($message);
                        document.getElementById('Citydayerror2').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "15":
                        $message = "Shenoni adresen!";
                        $('#Streetaddresserror2').html($message);
                        document.getElementById('Streetaddresserror2').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "16":
                        $message = "Shenoni numrin e telefonit!";
                        $('#Pronenumbererror2').html($message);
                        document.getElementById('Pronenumbererror2').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "17":
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