<!DOCTYPE html>
<html lang="en">

<head>
    <title>Receptionist | Historia e regjistrimeve</title>
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
                <p>Receptionist | Historia e regjistrimeve</p>
            </div>
            <div class="container-fullw">
                <form class="search-form">
                    <div class="d-inline-flex panel-search">
                        <div class="input-group-prepend">
                            <img class="input-group-text" src="img/search-clipart-btn.png" width="38px" height="38px">
                        </div>
                        <input type="search" class="form-control type-text data-to-search" placeholder="Kerko sipas emrit ose ID">
                        <button type="submit" class="btn btn-primary btn-send">Kerko</button>
                    </div>
                </form>
                <div class="panel-body no-padding">
                    <div class="panel-heading">
                        <h5 class="panel-title panel-white text-center">Pacientët</h5>
                    </div>
                    <table class="data-list min-height">
                        <tr class="table-head ">
                            <td class="rid-h">ID</td>
                            <td class="rnameh2">Emri</td>
                            <td class="rsnameh2">Mbiemri</td>
                            <td class="rrecepsh">Personi pergjegjes</td>
                            <td class="rdateh">Data</td>
                            <td class="rtimeh">Ora</td>
                        </tr>
                    </table>
                    <table class="data-list datalist-3">
                        <tr>
                        <td class="rid">2435</td>
                            <td class="rname2">Alban</td>
                            <td class="rsname2">Berisha</td>
                            <td class="rreceps">Arjan Kuqi</td>
                            <td class="rdate">16.12.2021</td>
                            <td class="rtime">15:15</td>
                        </tr>
                        <td class="rid">2435</td>
                            <td class="rname2">Alban</td>
                            <td class="rsname2">Berisha</td>
                            <td class="rreceps">Arjan Kuqi</td>
                            <td class="rdate">16.12.2021</td>
                            <td class="rtime">15:15</td>
                        </tr> 
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>