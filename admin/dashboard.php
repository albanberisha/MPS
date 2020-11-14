<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin|dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/sidenavigation.js"></script>
    <script src="js/imagebrowse.js"></script>
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
                <p>Admin | Dashboard</p>
            </div>
            <div class="widget-inline">
                <div class="widget-block">
                    <div class="widget">
                        <div>
                            <p class="wid-info text-center">Data</p>
                            <hr class="divider" align="center">
                        </div>
                        <div>
                            <p class="widget-main-cal text-center">12/02/2020</p>
                        </div>
                    </div>
                    <div class="widget">
                        <div>
                            <p class="wid-info text-center">Data</p>
                            <hr class="divider" align="center">
                        </div>
                        <div>
                            <p class="widget-main-cal text-center">12/02/2020</p>
                        </div>
                    </div>
                </div>
                <div class="active-users">
                    <div class="widget">
                        <div>
                            <p class="wid-info text-center">Aktiv</p>
                            <hr class="divider" align="center">
                        </div>
                        <div class="active1">
                            aa </div>
                    </div>
                </div>
            </div>


            <table class="wigdets" style="width: 100%;">
                <tr>
                    <td class="" style="width:100px;">
                        <div class="widget " style="width: max-content;">
                            <div>
                                <p class="wid-info text-center">Data</p>
                                <hr class="divider" align="center">
                            </div>
                            <div>
                                <p class="widget-main-cal text-center">12/02/2020</p>
                            </div>
                        </div>
                    </td>
                    <td rowspan="3" class="" style="background-color: red; width: 250px;">
                        <div class="widget " style="height: 100%;">
                            <div>
                                <p class="wid-info text-center">Aktiv</p>
                                <hr class="divider" align="center">
                            </div>
                            <div class="aktiv">
                                aa </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="widget">
                            <div>
                                <p class="wid-info text-center">Rastet kritike</p>
                                <hr class="divider" align="center">
                            </div>

                        </div>
                    </td>
                </tr>

            </table>
        </div>
    </div>
</body>

</html>