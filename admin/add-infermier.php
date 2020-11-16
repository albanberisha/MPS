<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Shto infermier</title>
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
                <p>Admin | Shto infermier</p>
            </div>
            <div class=" container-fullw">
                <div class="panel-body">
                    <div class="panel-heading">
                        <h5 class="panel-title">Shto nje infermier</h5>
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

                            <div class="div-inlineflex">
                                <div class="form-group">
                                    <label class="input-title">Emri i infermierit</label>
                                    <input type="text" id="nameInf" class="form-control" placeholder="Sheno emrin e infermierit">
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Mbiemri i infermierit</label>
                                    <input type="text" id="surnameInf" class="form-control" placeholder="Sheno mbiemrin e infermierit">
                                </div>
                            </div>
                            <div class="div-inlineflex">
                                <div class="form-group">
                                    <label class="input-title">Datelindja</label>
                                    <input type="date" class="form-control" id="Infstart-date" name="infstart_date" />
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Gjinia</label>
                                    <div class="input-title-btn">
                                        <input type="radio" name="infgender" value="male" checked> Mashkull<br>
                                        <input type="radio" name="infgender" value="female"> Femër
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="input-title">Adresa</label>
                                <input type="text" class="form-control" id="adressInf" name="adressinf" placeholder="Adresa" >
                            </div>
                            <div class="form-group">
                                <label class="input-title">Numri i telefonit</label>
                                <input class="form-control" id="phone-number" data-inputmask="'alias': 'phonebe'">                             </div>
                            <div class="form-group">
                                <label class="input-title" for="InfermierDepartament">
                                   Departamenti
                                </label>
                                <select name="Infermierdepartament" class="form-control" required="true">
                                    <option value="">Selekto departamentin</option>
                                    <option>Lindjet</option>
                                                                                                    
                                </select>
                            </div>
                            <div class="register-div-info">

                                <h6 class="panel-title">Forma per regjistrim</h6>
                                <hr style="margin-bottom: 0px;">

                                <div class="form-group">
                                    <label class="input-title">Emaili</label>
                                    <input type="email" class="form-control" name="infemail" placeholder="Emaili" required="required">
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Username</label>
                                    <input type="text" class="form-control" name="infusername" placeholder="Username" required="required">
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Paswordi</label>
                                    <input type="password" class="form-control" name="infpassword" placeholder="Paswordi" required="required">
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Perserit paswordin</label>
                                    <input type="password" class="form-control" name="infconfirm_password" placeholder="Perserit paswordin" required="required">
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