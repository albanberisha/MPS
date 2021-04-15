<!DOCTYPE html>
<html lang="en">

<head>
    <title>Receptionist | Menaxho doktoret</title>
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
    <script>
        function myFunction() {
            var checkBoxm = document.getElementById("myCheckm");
            var checkBoxt = document.getElementById("myCheckt");
            var checkBoxw = document.getElementById("myCheckw");
            var checkBoxth = document.getElementById("myCheckth");
            var checkBoxf = document.getElementById("myCheckf");
            var checkBoxsa = document.getElementById("myChecksa");
            var checkBoxsu = document.getElementById("myChecksu");
            var textm = document.getElementById("textm");
            var textt = document.getElementById("textt");
            var textw = document.getElementById("textw");
            var textth = document.getElementById("textth");
            var textf = document.getElementById("textf");
            var textsa = document.getElementById("textsa");
            var textsu = document.getElementById("textsu");
            if (checkBoxm.checked == true) {
                textm.style.display = "block";
            } else {
                textm.style.display = "none";
            }
            if (checkBoxt.checked == true) {
                textt.style.display = "block";
            } else {
                textt.style.display = "none";
            }
            if (checkBoxw.checked == true) {
                textw.style.display = "block";
            } else {
                textw.style.display = "none";
            }
            if (checkBoxth.checked == true) {
                textth.style.display = "block";
            } else {
                textth.style.display = "none";
            }
            if (checkBoxf.checked == true) {
                textf.style.display = "block";
            } else {
                textf.style.display = "none";
            }
            if (checkBoxsa.checked == true) {
                textsa.style.display = "block";
            } else {
                textsa.style.display = "none";
            }
            if (checkBoxsu.checked == true) {
                textsu.style.display = "block";
            } else {
                textsu.style.display = "none";
            }
        }
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
                <p>Receptionist | Menaxho doktoret</p>
            </div>

            <div class=" container-fullw">
                <div class="panel-body">
                    <div class="panel-heading">
                        <h5 class="panel-title">Alban Berisha</h5>
                    </div>
                    <div class="panel-form">
                        <form>
                            <div class="circle form-group">
                                <div class="input-formimg">
                                    <img id="preview" class="circle" src="img/doctor.png">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="input-title" for="DoctorPositon">
                                    Specializim
                                </label>
                                <input type="text" readonly="readonly" class="form-control" name="docspec" value="Urolog" required="required">
                            </div>
                            <div class="div-inlineflex">
                                <div class="form-group">
                                    <label class="input-title">Ditet e punes</label>
                                    <div class="input-title-btn">
                                        <label for="myCheckm">E Hene:</label>
                                        <input type="checkbox" class="Monday" id="myCheckm" onclick="myFunction()">
                                        <p id="textm" style="display:none">
                                            <label for="patientTime" class="input-title" style="margin-top: 7px;">Ora e fillimit:</label>
                                            <input type="time" class="form-control" id="Patientstart-dateM" name="Patientstart_datem">
                                            <label for="patientTime" class="input-title" style="margin-top: 7px;">Ora e mbarimit:</label>
                                            <input type="time" class="form-control" id="Patientend-dateM" name="Patientend_datem">
                                        </p><br>
                                        <label for="myCheckt">E Marte:</label>
                                        <input type="checkbox" class="Tuesday" id="myCheckt" onclick="myFunction()">
                                        <p id="textt" style="display:none">
                                            <label for="patientTime" class="input-title" style="margin-top: 7px;">Ora e fillimit:</label>
                                            <input type="time" class="form-control" id="Patientstart-dateT" name="Patientstart_datet">
                                            <label for="patientTime" class="input-title" style="margin-top: 7px;">Ora e mbarimit:</label>
                                            <input type="time" class="form-control" id="Patientend-dateT" name="Patientend_datet">
                                        </p><br>
                                        <label for="myCheckw">E Merkure:</label>
                                        <input type="checkbox" class="Wednesday" id="myCheckw" onclick="myFunction()">
                                        <p id="textw" style="display:none">
                                            <label for="patientTime" class="input-title" style="margin-top: 7px;">Ora e fillimit:</label>
                                            <input type="time" class="form-control" id="Patientstart-dateW" name="Patientstart_datew">
                                            <label for="patientTime" class="input-title" style="margin-top: 7px;">Ora e mbarimit:</label>
                                            <input type="time" class="form-control" id="Patientend-dateW" name="Patientend_datew">
                                        </p><br>
                                        <label for="myCheckth">E Ejte:</label>
                                        <input type="checkbox" class="Thursday" id="myCheckth" onclick="myFunction()">
                                        <p id="textth" style="display:none">
                                            <label for="patientTime" class="input-title" style="margin-top: 7px;">Ora e fillimit:</label>
                                            <input type="time" class="form-control" id="Patientstart-dateTh" name="Patientstart_dateth">
                                            <label for="patientTime" class="input-title" style="margin-top: 7px;">Ora e mbarimit:</label>
                                            <input type="time" class="form-control" id="Patientend-dateTh" name="Patientend_dateth">
                                        </p><br>
                                        <label for="myCheckf">E Premte:</label>
                                        <input type="checkbox" class="Friday" id="myCheckf" onclick="myFunction()">
                                        <p id="textf" style="display:none">
                                            <label for="patientTime" class="input-title" style="margin-top: 7px;">Ora e fillimit:</label>
                                            <input type="time" class="form-control" id="Patientstart-dateF" name="Patientstart_datef">
                                            <label for="patientTime" class="input-title" style="margin-top: 7px;">Ora e mbarimit:</label>
                                            <input type="time" class="form-control" id="Patientend-dateF" name="Patientend_datef">
                                        </p><br>
                                        <label for="myChecksa">E Shtune:</label>
                                        <input type="checkbox" class="Saturday" id="myChecksa" onclick="myFunction()">
                                        <p id="textsa" style="display:none">
                                            <label for="patientTime" class="input-title" style="margin-top: 7px;">Ora e fillimit:</label>
                                            <input type="time" class="form-control" id="Patientstart-dateSa" name="Patientstart_datesa">
                                            <label for="patientTime" class="input-title" style="margin-top: 7px;">Ora e mbarimit:</label>
                                            <input type="time" class="form-control" id="Patientend-dateSa" name="Patientend_datesa">
                                        </p><br>
                                        <label for="myChecksu">E Diel:</label>
                                        <input type="checkbox" class="Sunday" id="myChecksu" onclick="myFunction()">
                                        <p id="textsu" style="display:none">
                                            <label for="patientTime" class="input-title" style="margin-top: 7px;">Ora e fillimit:</label>
                                            <input type="time" class="form-control" id="Patientstart-dateSu" name="Patientstart_datesu">
                                            <label for="patientTime" class="input-title" style="margin-top: 7px;">Ora e mbarimit:</label>
                                            <input type="time" class="form-control" id="Patientend-dateSu" name="Patientend_datesu">
                                        </p><br>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="input-title" for="DoctorDepartament">
                                    Departamenti
                                </label>
                                <select name="Doctordepartament" class="form-control" required="true">
                                    <option value="">Selekto departamentin</option>
                                    <option selected>Lindjet</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label class="input-title" for="DoctorPosition">
                                    Pozita
                                </label>
                                <select name="Doctorposition" class="form-control" required="true">
                                    <option selected value="">Selekto poziten</option>
                                    <option >Doktor</option>
                                    <option >Kujdestarë</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin-top: 10px;">
                                <button type="submit" class="btn btn-primary">Ndrysho</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>