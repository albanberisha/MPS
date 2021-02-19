<!DOCTYPE html>
<html lang="en">

<head>
    <title>Receptionist | Informata rreth dhomave</title>
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
                <p>Receptionist | Informata rreth pdhomave</p>
            </div>
            <div class="container-fullw">
                <div class="panel-body no-padding">
                    <div class="panel-heading">
                        <h5 class="panel-title panel-white text-center">Dhomat në spital</h5>
                    </div>
                    <div class="form-group">
                                <label class="input-title" for="HospitalDepartaments">
                                    Departamentet
                                </label>
                                <select name="hospitalDepartaments" class="form-control" required="true">
                                    <option selected="" value="">Selekto departamentin</option>
                                    <option>Urgjence</option>
                                    <option>Emergjence</option>
                                    <option>Urologji</option>
                                </select>
                            </div>
                    <div class="row">
                        <div class="col-md-auto room">
                            <a href="#" type="button" class="btn btn-secondary free" data-toggle="tooltip" data-placement="bottom" title="Dhoma 1. E lire.">1</a>
                        </div>
                        <div class="col-md-auto room">
                            <a href="view-patient.php" type="button" class="btn btn-secondary busy" data-toggle="tooltip" data-placement="bottom" title="Dhoma 1. ID13454 Alban Trollaj.">2</a>
                        </div>
                        <div class="col-md-auto room">
                            <a href="view-patient.php" type="button" class="btn btn-secondary busy" data-toggle="tooltip" data-placement="bottom" title="Dhoma 2. ID13454 Alban Trollaj.">3</a>
                        </div>
                        <div class="col-md-auto room">
                            <a href="view-patient.php" type="button" class="btn btn-secondary busy" data-toggle="tooltip" data-placement="bottom" title="Dhoma 2. ID13454 Alban Trollaj.">4</a>
                        </div>
                        <div class="col-md-auto room">
                            <a href="#" type="button" class="btn btn-secondary free" data-toggle="tooltip" data-placement="bottom" title="Dhoma 3. E lire.">5</a>
                        </div>
                        <div class="col-md-auto room">
                            <a href="#" type="button" class="btn btn-secondary free" data-toggle="tooltip" data-placement="bottom" title="Dhoma 4. E lire.">6</a>
                        </div>
                        <div class="col-md-auto room">
                            <a href="#" type="button" class="btn btn-secondary free" data-toggle="tooltip" data-placement="bottom" title="Dhoma 5. E lire.">7</a>
                        </div>
                        <div class="col-md-auto room">
                            <a href="#" type="button" class="btn btn-secondary free" data-toggle="tooltip" data-placement="bottom" title="Dhoma 6. E lire.">8</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>