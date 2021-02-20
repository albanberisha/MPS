<!DOCTYPE html>
<html lang="en">

<head>
    <title>Receptionist | Cakto nje termin</title>
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
                <p>Receptionist | Cakto nje termin</p>
            </div>
            <div class="container-fullw">
                <div class="panel-body no-padding" style="border: 1px solid green;">
                    <form>
                        <div class="div-inlineflex">
                            <div class="form-group">
                                <label class="input-title" for="PatientName">
                                    Emri:
                                </label>
                                <input type="text" readonly="readonly" id="namePatient" class="form-control" placeholder="Sheno emrin e pacientit" value="artan"> 

                            </div>
                            <div class="form-group">
                                <label class="input-title">Mbiemri:</label>
                                <input type="text" readonly="readonly" id="surnamePatient" class="form-control" placeholder="Sheno mbiemrin e pacientit" value="berisha">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="patientId" class="input-title" style="margin-top: 7px;">ID:</label>
                            <input type="number" readonly="readonly" id="idPatient" class="form-control" placeholder="Sheno ID" value="12435">
                        </div>
                        <div class="div-inlineflex">
                            <div class="form-group">
                                <label class="input-title">Datelindja</label>
                                <input type="date" readonly="readonly" class="form-control" id="Patientstart-date" name="Patientstart_date" value="12/24/14" />
                            </div>
                            <div class="form-group">
                                <label class="input-title">Gjinia</label>
                                <div class="input-title-btn">
                                    <input type="radio" name="patgender" value="male" checked> Mashkull<br>
                                    <input type="radio" name="patgender" value="female"> Femër
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="input-title">Numri i telefonit</label>
                            <input class="form-control" readonly="readonly" id="phone-number" value="045234543">
                        </div>
                        <div class="form-group">
                            <label class="input-title">Adresa</label>
                            <input type="text" readonly="readonly" class="form-control" id="adressPat" name="adresspat" placeholder="Adresa" value="Zllakuqan">
                        </div>
                        <div class="form-group">
                            <label class="input-title">Emaili</label>
                            <input type="email" readonly="readonly" class="form-control" name="patemail" placeholder="Emaili" required="required" value="A@gmail.com">
                        </div>
                        <div class="form-group">
                            <label class="input-title" for="PatientDept">
                                Doktori:
                            </label>
                            <select name="PatientDept" class="form-control patient-departament" required="true">
                                <option selected="">Arti Sadikaj</option>
                                <option>Arbnor rugova</option>
                                <option>Halil Muja</option>
                            </select>
                        </div>
                        <div class="form-group">
                                    <label class="input-title">Data</label>
                                    <input type="date" class="form-control" id="Docstart-date" name="docstart_date">
                                </div>
                                <div class="form-group">
                                <p id="textm" style="display: block;">
                                            <label for="patientTime" class="input-title" style="margin-top: 7px;">Ora:</label>
                                            <input type="time" class="form-control" id="Patientstart-dateM" name="Patientstart_datem">
                                        </p>
                                </div>
                                
                        <div class="form-group" style="margin-top: 10px;">
                            <button type="submit" class="btn btn-primary">Bej kerkes per termin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>