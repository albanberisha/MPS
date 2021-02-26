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
                <div class="panel-body no-padding">
                    <div class="panel-heading">
                        <h5 class="panel-title panel-white text-center">Menaxho pacientët</h5>
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
                                    Emri:
                                </label>
                                <input type="text" id="namePatient" class="form-control" placeholder="Sheno emrin e pacientit" value="Alban">

                            </div>
                            <div class="form-group">
                                <label class="input-title">Mbiemri:</label>
                                <input type="text" id="surnamePatient" class="form-control" placeholder="Sheno mbiemrin e pacientit" value="Ramaj">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="patientId" class="input-title" style="margin-top: 7px;">ID:</label>
                            <input type="number" id="idPatient" class="form-control" placeholder="Sheno ID" value="12345">
                        </div>
                        <div class="div-inlineflex">
                            <div class="form-group">
                                <label class="input-title">Datelindja</label>
                                <input type="date" class="form-control" id="Patientstart-date" name="Patientstart_date" value="2018-07-22" />
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
                            <input class="form-control" id="phone-number" value="38349549509">
                        </div>
                        <div class="form-group">
                            <label class="input-title">Adresa</label>
                            <input type="text" class="form-control" id="adressPat" name="adresspat" placeholder="Adresa" value="Xheladin Hana, Aktash">
                        </div>
                        <div class="form-group">
                            <label class="input-title">Emaili</label>
                            <input type="email" class="form-control" name="patemail" placeholder="Emaili" required="required" value="A@gmail.com">
                        </div>
                        <div>
                        <div class="form-group">
                                <label class="input-title">Statusi</label>
                                <input type="email" readonly="readonly" class="form-control" name="docemail" value="Joaktiv" required="required">
                            </div>
                        </div>

                        <div>
                            <p>Nese joaktiv nuk shfaqen kto</p>
                            <div class="form-group">
                                <label class="input-title">Gjendja</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        <a href="" type="button" class="btn btn-secondary" style="background: yellow; border:1px solid rgb(199, 199, 105); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast urgjent. Kerkohen shume resurse mirpo jo rreizk per jeten. Rast potencial resioz">Verdhë</a>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        <a href="" type="button" class="btn btn-secondary" style=" background: red; border:1px solid rgb(255, 142, 142); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast emergjent. Kerkohet intervenim i menjehershem per shpetim te jetes. Riskt te madh per humbje te jetes.">Kuqe</a>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        <a href="" type="button" class="btn btn-secondary" style="background: green; border:1px solid rgb(128, 253, 128); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast me pak urgjent. Intervenim standard.">Gjelbër</a> </label>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="input-title" for="PatientDept">
                                    Departamenti:
                                </label>
                                <select name="PatientDept" class="form-control patient-departament" required="true">
                                    <option selected="">Departamenti i Urgjences</option>
                                    <option>Departamenti i Mushkerive</option>
                                    <option>Departamenti i Zemres</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="input-title" for="PatientRoom">
                                    Dhoma:
                                </label>
                                <select name="PatientRoom" class="form-control patient-departament" required="true">
                                    <option selected="">12</option>
                                    <option>16</option>
                                    <option>25</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                                <label class="input-title" for="PatientDept">
                                   Grupi i gjakut:
                                </label>
                                <select name="PatientDept" class="form-control patient-departament" required="true">
                                    <option selected="">A+</option>
                                    <option>A-</option>
                                </select>
                            </div>
                        <div>
                            <h5 class="panel-title panel-white text-center">Kontakt ne rast emergjence</h5>
                                <div class="div-inlineflex">
                                    <div class="form-group">
                                        <label class="input-title" for="PatientName">
                                            Emri i kontaktit:
                                        </label>
                                        <input type="text" id="namePatient" class="form-control" placeholder="Sheno emrin " />

                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Mbiemri:</label>
                                        <input type="text" id="surnamePatient" class="form-control" placeholder="Sheno mbiemrin">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Afersia</label>
                                    <input type="text" id="surnamePatient" class="form-control" placeholder="Sheno afersine">
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Numri i telefonit</label>
                                    <input class="form-control" id="phone-number" value="38349549509">
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Adresa</label>
                                    <input type="text" class="form-control" id="adressPat" name="adresspat" placeholder="Adresa" value="Xheladin Hana, Aktash">
                                </div>
                            </div>
                        <div class="form-group" style="margin-top: 10px;">
                            <button type="submit" class="btn btn-primary">Ndrysho</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>