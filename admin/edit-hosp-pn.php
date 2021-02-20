<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Ndrysho</title>
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
                <p>Admin | Ndrysho</p>
            </div>
            <div class=" container-fullw">
                <div class="card">
                    <div class="form-group">
                        <form>
                            <div class="form-group">
                                <label class="input-title">
                                    Çmimi per nje nate ne spital</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">€</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="Çmimi i analizes" value="20">
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
    </div>
</body>

</html>