<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doctor | Terminet ne pritje</title>
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
                <p>Doctor | Terminet ne pritje</p>
            </div>
            <div class="container-fullw">
                <div class="main-body">
                    <div class="row gutters-sm">
                        <div class="col-md-12">
                            <div class="card">
                                <div style="padding-bottom: 0;">
                                    <h6 class="panel-title panel-white text-center col-header">Terminet ne pritje per aprovim</h6>
                                </div>
                                <div class="card-body card-top">
                                    <table class="data-list min-height dignosis color-none">
                                        <tbody>
                                            <tr>
                                                <th class="panel-title  date3">
                                                    Data:
                                                </th>
                                                <th class="panel-title date3">
                                                    Ora:
                                                </th>
                                                <th class="panel-title title4 ">
                                                    Doktori:
                                                </th>
                                                <th class="panel-title title4 ">
                                                    Pacienti:
                                                </th>
                                                <th class="panel-title title4 ">
                                                    ID:
                                                </th>
                                                <th class="panel-title title4 ">
                                                Statusi
                                                </th>
                                            </tr>
                                            <tr>
                                                <td class=" date3">
                                                    19.12.2020
                                                </td>
                                                <td class=" date3">
                                                    12:45
                                                </td>
                                                <td class="title4">
                                                    Dr. Argon Mustafa
                                                </td>
                                                <td class="title4">
                                                    Artan Lajqi
                                                </td>
                                                <td class="title4">
                                                    1234
                                                </td>
                                                <td class="title4">
                                                <button type="button" class="btn btn-success" style="font-size: 10px;">Aprovo</button>
                                                <button type="button" class="btn btn-danger" style="font-size: 10px;">Anulo</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class=" date3">
                                                    19.12.2020
                                                </td>
                                                <td class=" date3">
                                                    12:45
                                                </td>
                                                <td class="title4">
                                                    Dr. Argon Mustafa
                                                </td>
                                                <td class="title4">
                                                    Artan Lajqi
                                                </td>
                                                <td class="title4">
                                                    1234
                                                </td>
                                                <td class="title4">
                                                <button type="button" class="btn btn-success" style="font-size: 10px;">Aprovo</button>
                                                <button type="button" class="btn btn-danger" style="font-size: 10px;">Anulo</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class=" date3">
                                                    19.12.2020
                                                </td>
                                                <td class=" date3">
                                                    12:45
                                                </td>
                                                <td class="title4">
                                                    Dr. Argon Mustafa
                                                </td>
                                                <td class="title4">
                                                    Artan Lajqi
                                                </td>
                                                <td class="title4">
                                                    1234
                                                </td>
                                                <td class="title4">
                                                <button type="button" class="btn btn-success" style="font-size: 10px;">Aprovo</button>
                                                <button type="button" class="btn btn-danger" style="font-size: 10px;">Anulo</button>                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>