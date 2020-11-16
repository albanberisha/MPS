<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Te dhenat e spitalit</title>
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
                <p>Admin | Te dhenat e spitalit</p>
            </div>

            <div class=" container-fullw">
                <div class="panel-body">
                    <div class="panel-heading">
                        <h5 class="panel-title">Te dhenat e spitalit</h5>
                    </div>
                    <div class="panel-form">
                        <form>
                            <div class="circle form-group">
                                <div class="input-formimg">
                                    <img id="preview" class="circle" src="img/hospital.svg">
                                </div>
                            </div>
                            <div class="form-group">
                                <form method="post" id="image-form" style="width: 30px;">
                                    <div class="input-group my-3">
                                        <input type="text" class="form-control" style="display: none;" disabled placeholder="Ngarkoni fotografi" id="file">
                                        <div class="input-group-append">
                                            <button type="button" class="browse btn btn-primary btn-change">Ndryshoni logon</button>
                                        </div>
                                        <span class="text-info" style="margin-left: 90px;">*preferohet formati .svg </span>
                                    </div>
                                    <input type="file" name="img[]" class="file" accept=".svg">
                                </form>
                            </div>
                            <div class="div-inlineflex">
                                <div class="form-group">
                                    <label class="input-title">Emri i spitalit</label>
                                    <input type="text" id="nameHospital" class="form-control" value="Qendra Klinike Universitare e Kosoves">
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Shkurtesa</label>
                                    <input type="text" id="shortName" class="form-control" value="QKUK">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="input-title">Adresa</label>
                                <input type="text" class="form-control" id="adressAdmin" name="adresshospital" placeholder="Adresa">
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