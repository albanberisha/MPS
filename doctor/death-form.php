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
                <div class="panel-body no-padding" style="border: 1px solid black;">
                    <div class="panel-heading">
                        <h5 class="panel-title panel-white text-center">Rast i vdekjes</h5>
                    </div>
                    <form>
                        <div class="form-group row">
                            <label for="example-datetime-local-input" class="input-title" style="margin-top: 7px;">Data:</label>
                            <div class="col-10">
                                <input type="date" readonly="readonly" class="form-control" id="Docstart-date" name="docstart_date" value="2020-07-22">
                            </div>
                        </div>
                        <div class="div-inlineflex">
                            <div class="form-group">
                                <label class="input-title" for="PatientName">
                                    Emri i të ndjerit:
                                </label>
                                <input type="text" id="namePatient" class="form-control" placeholder="Sheno emrin">

                            </div>
                            <div class="form-group">
                                <label class="input-title">Mbiemri i të ndjerit:</label>
                                <input type="text" id="surnamePatient" class="form-control" placeholder="Sheno mbiemrin">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="patientId" class="input-title" style="margin-top: 7px;">ID:</label>
                            <input type="number" id="idPatient" class="form-control" placeholder="Sheno ID">
                        </div>
                        <div class="div-inlineflex">
                            <div class="form-group">
                                <label class="input-title">Datelindja:</label>
                                <input type="date" class="form-control" id="Patientstart-date" name="Patientstart_date" />
                            </div>
                            <div class="form-group">
                                <label for="patientAge" class="input-title" style="margin-top: 7px;">Mosha:</label>
                                <input type="number" id="agePatient" class="form-control" placeholder="Sheno moshen">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="input-title">Numri i telefonit</label>
                            <input class="form-control" id="phone-number" data-inputmask="'alias': 'phonebe'">
                        </div>
                        <div class="form-group">
                            <label class="input-title">Adresa</label>
                            <input type="text" class="form-control" id="adressPat" name="adresspat" placeholder="Adresa">
                        </div>
                        <div class="div-inlineflex">
                            <div class="form-group">
                                <label class="input-title">Data e vdekjes:</label>
                                <input type="date" class="form-control" id="Patientstart-date" name="Patientstart_date" />
                            </div>
                            <div class="form-group">
                                <label for="patientTime" class="input-title" style="margin-top: 7px;">Ora e vdekjes:</label>
                                <input type="time" class="form-control" id="Patientstart-date" name="Patientstart_date" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="input-title">Spitali ku ka ndodhur vdekja:</label>
                            <input type="email" readonly="readonly" class="form-control" name="patientdeath" value="Qendra Klinike Universitare e Kosoves">
                        </div>
                        <div class="form-group">
                            <label class="input-title">Data e pranimit:</label>
                            <input type="date" class="form-control" id="Patientstart-date" name="Patientstart_date" />
                        </div>
                        <div class="form-group">
                            <label class="input-title">Gjinia:</label>
                            <div class="input-title-btn">
                                <input type="radio" name="patgender" value="male" checked> Mashkull<br>
                                <input type="radio" name="patgender" value="female"> Femër
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="input-title" for="DoctorRaporting">
                                Doktori qe e raportoj vdekjen:
                            </label>
                            <select name="DoctorRaporting" class="form-control doctorposition" required="true">
                                <option selected="">Avni </option>
                                <option>Hashim</option>
                            </select>
                        </div>
                        <div class="form-group">
                                <label class="input-title">Pershkrimi i ngjarjeve para vekjes:</label>
                                <textarea class="form-control" rows="5" id="description" placeholder="Te dhenat si: detajet e ndonje operacioni ose ndonje procedure para vdekjes se bashku me datat relevante."></textarea>
                            </div>
                            <div class="form-group">
                            <label class="input-title">Shkaku i vdekjes(nese dihet)</label>
                            <input type="text" class="form-control" id="deathCause" name="deathcause" placeholder="Shkaku i supozuar">
                        </div>
                        <div class="form-group" style="margin-top: 10px;">
                            <button type="submit" class="btn btn-primary">Mbaro</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>