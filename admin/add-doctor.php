<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Shto Doktorr</title>
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
                <p>Admin | Shto Doktorr</p>
            </div>
            <div class=" container-fullw">
                <div class="panel-body">
                    <div class="panel-heading">
                        <h5 class="panel-title">Shto nje doktorr</h5>
                    </div>
                    <div class="panel-form">
                        <form>
                            <div class="circle form-group">
                                <div class="input-formimg">
                                    <img id="preview" class="circle" src="img/empty-img.png">
                                </div>
                            </div>
                            <div class="form-group">
                                <form method="post" id="image-form">
                                    <div class="input-group my-3">
                                        <input type="text" class="form-control" disabled placeholder="Ngarkoni fotografi" id="file">
                                        <div class="input-group-append">
                                            <button type="button" class="browse btn btn-primary">Ngarkoni...</button>
                                        </div>
                                    </div>
                                    <input type="file" name="img[]" class="file" accept="image/*">
                                </form>
                            </div>
                            <div class="form-group">
                                <label class="input-title" for="DoctorPositon">
                                   Pozita
                                </label>
                                <select name="Doctorposition" class="form-control doctorposition" required="true">
                                    <option selected>Doktorr</option>
                                    <option >Doktorr laboratori</option>
                                                                                                    
                                </select>
                            </div>
                            <div class="div-inlineflex">
                                <div class="form-group">
                                    <label class="input-title">Emri i doktorrit</label>
                                    <input type="text" id="nameDoc" class="form-control" placeholder="Sheno emrin e doktorrit">
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Mbiemri i doktorrit</label>
                                    <input type="text" id="surnameDoc" class="form-control" placeholder="Sheno mbiemrin e doktorrit">
                                </div>
                            </div>
                            <div class="div-inlineflex">
                                <div class="form-group">
                                    <label class="input-title">Datelindja</label>
                                    <input type="date" class="form-control" id="Docstart-date" name="docstart_date" />
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Gjinia</label>
                                    <div class="input-title-btn">
                                        <input type="radio" name="docgender" value="male" checked> Mashkull<br>
                                        <input type="radio" name="docgender" value="female"> Femër
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="input-title">Adresa</label>
                                <input type="text" class="form-control" id="adressDoc" name="adressdoc" placeholder="Adresa">
                            </div>
                            <div class="form-group">
                                <label class="input-title">Numri i telefonit</label>
                                <input class="form-control" id="phone-number" data-inputmask="'alias': 'phonebe'">
                            </div>
                            <div class="form-group">
                                <label class="input-title" for="DoctorSpecialization">
                                   Specializimi
                                </label>
                                <select name="Doctorspecialization" class="form-control" required="true">
                                    <option value="">Selekto Specializimin</option>
                                    <option>Alban</option>
                                                                                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="input-title" for="DoctorDepartament">
                                   Departamenti
                                </label>
                                <select name="Doctordepartament" class="form-control" required="true">
                                    <option value="">Selekto departamentin</option>
                                    <option>Lindjet</option>
                                                                                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="input-title">Adresa e klinikes</label>
                                <input type="text" id="adressKDoc" class="form-control" placeholder="Sheno adresen e klinikes se doktorrit">
                            </div>
                            <div class="form-group">
                                <label class="input-title">Tarifa e konsultes me mjekun</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">&#8364</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="Tarifa e konsultes me mjekun">
                                </div>
                            </div>
                            <div class="register-div-info">

                                <h6 class="panel-title">Forma per regjistrim</h6>
                                <hr style="margin-bottom: 0px;">

                                <div class="form-group">
                                    <label class="input-title">Emaili</label>
                                    <input type="email" class="form-control" name="docemail" placeholder="Emaili" required="required">
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Username</label>
                                    <input type="text" class="form-control" name="docusername" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Paswordi</label>
                                    <input type="password" class="form-control" name="docpassword" placeholder="Paswordi" required="required">
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Perserit paswordin</label>
                                    <input type="password" class="form-control" name="docconfirm_password" placeholder="Perserit paswordin" required="required">
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
    </div>
</body>

</html>
