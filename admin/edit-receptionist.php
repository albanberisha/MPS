<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Ndrysho Detajet e Recepsionistit</title>
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
        <?php include('includes/header.php');?>
        <hr style="margin-top:0px;">
    </header>
    <div class="" style="display: flex; margin-top: -16px; width: 100%;">
        <?php include('includes/sidebar.php');?>

        <div class="page" style="width: 100%;">
            <div class="card-header">
                <p>Admin | Ndrysho Detajet e Recepsionistit</p>
            </div>
            <div class=" container-fullw">
                <div class="panel-body">
                    <div class="panel-heading">
                        <h5 class="panel-title">Arbnor Berisha</h5>
                        <div class="info-panel">
                            <div class="d-inline-flex">
                                <h6 class="panel-title">Regjistruar me:</h6>
                                <p class="reg-date">21.12.2020</p>
                            </div>
                            <div class="d-inline-flex">
                                <h6 class="panel-title">Hera e fundit e perditesimit:</h6>
                                <p class="update-date">21.12.2020</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel-form">
                        <form>
                            <div class="circle form-group">
                                <div class="input-formimg">
                                    <img id="preview" class="circle" src="img/doctor.png">
                                </div>
                            </div>
                            <div class="form-group">
                                <form method="post" id="image-form">
                                    <div class="input-group my-3">
                                        <input type="text" class="form-control" disabled placeholder="Ndryshoni fotografine" id="file">
                                        <div class="input-group-append">
                                            <button type="button" class="browse btn btn-primary">Ngarkoni...</button>
                                        </div>
                                    </div>
                                    <input type="file" name="img[]" class="file" accept="image/*">
                                </form>
                            </div>

                            <div class="div-inlineflex">
                                <div class="form-group">
                                    <label class="input-title">Emri i recepsionistit</label>
                                    <input type="text" id="nameRec" class="form-control" placeholder="Sheno emrin e recepsionistit" value="Arbnor">
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Mbiemri i recepsionistit</label>
                                    <input type="text" id="surnameRec" class="form-control" placeholder="Sheno mbiemrin e recepsionistit" value="Berisha">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="input-title">Adresa</label>
                                <input type="text" class="form-control" id="adressRec" name="adressrec" placeholder="Adresa" value="MAti1, Prishtina">
                            </div>
                            <div class="div-inlineflex">
                                <div class="form-group">
                                    <label class="input-title">Datelindja</label>
                                    <input type="date" class="form-control" id="Recstart-date" name="recstart_date" value="2018-07-22" />
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Gjinia</label>
                                    <div class="input-title-btn">
                                        <input type="radio" name="recgender" value="male" checked> Mashkull<br>
                                        <input type="radio" name="recgender" value="female"> Femër
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="input-title">Numri i telefonit</label>
                                <input class="form-control" id="phone-number" value="38344567894">
                            </div>
                            <div class="form-group">
                                <label class="input-title">Emaili</label>
                                <input type="email" readonly="readonly" class="form-control" name="recemail" placeholder="Emaili" required="required" value="Arbnor@gmail.com">
                            </div>
                            <div class="form-group">
                                <label class="input-title">Username</label>
                                <input type="text" class="form-control" name="recusername" placeholder="Username" required="required" value="Arbnor17">
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