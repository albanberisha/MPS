<!DOCTYPE html>
<html lang="en">

<head>
    <title>Receptionist | Mbyll historine</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type='text/javascript' src='https://code.jquery.com/jquery-1.11.0.js'></script>
    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script src="js/sidenavigation.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

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
    <script>
        var doc = new jsPDF();

        function saveDiv(divId, title) {
            doc.fromHTML(`<html><head><title>${title}</title></head><body>` + document.getElementById(divId).innerHTML + `</body></html>`);
            doc.save('div.pdf');
        }

        function printDiv(divId,
            title) {

            let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');

            mywindow.document.write(`<html><head><title>${title}</title>`);
            mywindow.document.write('</head><body >');
            mywindow.document.write(document.getElementById(divId).innerHTML);
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            mywindow.print();
            mywindow.close();

            return true;
        }
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
                <p>Receptionist | Mbyll historine</p>
            </div>
            <div class="container-fullw" id="container-fullw">
                <div class="panel-body no-padding">
                    <div class="main-body">
                        <div class="row gutters-sm">
                            <div class="col-md-12" style="margin-bottom: 10px;">
                                <div class="card">
                                    <button type="button" id="CloseHistory" class="btn btn-primary"><span style="font-size: 15px;">+</span> Mbyll Historine</button>
                                </div>
                                <div>
                                    <p class="panel-title mb-1">Printo formen e gatshme per mbyllje <a href="img/close-form.pdf">Printo</a>.</p>
                                </div>
                                <div class="card">
                                    <div style="padding-bottom: 0;">
                                        <h6 class="panel-title panel-white text-center col-header">Lokacioni i pacientit ne ambientet e spitalit</h6>
                                    </div>
                                    <div class="card-body card-top">
                                        <table class="data-list min-height dignosis color-none">
                                            <tbody>
                                                <tr>
                                                    <th class="">
                                                        Statusi:
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td class="title5">
                                                        Jo aktiv
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="padding-bottom: 0;">
                                        <h6 class="panel-title panel-white text-center col-header">Lokacioni i pacientit ne ambientet e spitalit</h6>
                                    </div>
                                    <div class="card-body card-top">
                                        <table class="data-list min-height dignosis color-none">
                                            <tbody>
                                                <tr>
                                                    <th class="panel-title title5">
                                                        Departamenti:
                                                    </th>
                                                    <th class="panel-title title5 ">
                                                        Dhoma:
                                                    </th>
                                                    <th class="panel-title title5 ">
                                                        Shtrati:
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td class="title5">
                                                        I zemres
                                                    </td>
                                                    <td class="title5">
                                                        7
                                                    </td>
                                                    <td class="title5">
                                                        14
                                                    </td>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div style="padding-bottom: 0;">
                                        <h6 class="panel-title panel-white text-center col-header">Detajet e pacientit</h6>
                                    </div>
                                    <div class="card-body card-top">
                                        <div class="d-flex flex-column align-items-center text-center bottom-10">
                                            <div class="mt-3">
                                                <h4>IDt678956789</h4>
                                                <p class="panel-title mb-1">Artan kuqi</p>
                                            </div>
                                        </div>
                                        <div style="display: table-row">
                                            <div style="width: 49%; word-break: break-word; display: table-cell; padding-right: 1%;">
                                                <div class="bottom-10">
                                                    <label style="margin-bottom: 0;"> <b>Gjinia:</b></label>
                                                    <p>Femer</p>
                                                </div>
                                                <div class="bottom-10">
                                                    <label style="margin-bottom: 0;"> <b>Grupi i gjakut:</b></label>
                                                    <p>A+</p>
                                                </div>
                                            </div>
                                            <div style="width: 49%; word-break: break-word; display: table-cell; padding-left: 1%">
                                                <div class="bottom-10">
                                                    <label style="margin-bottom: 3px;"> <b>Numri i telefonit:</b></label>
                                                    <p>84629786</p>
                                                </div>
                                                <div class="bottom-10">

                                                    <label style="margin-bottom: 0;"> <b>Adresa:</b></label>
                                                    <p>ATYASGhldsgjafdjkl;f aiusfhlj;kiubkn</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div style="padding-bottom: 0;">
                                        <h6 class="panel-title panel-white text-center col-header">Kontakt ne rast emergjence</h6>
                                    </div>
                                    <div class="card-body card-top">
                                        <table class="data-list min-height dignosis color-none">
                                            <tbody>
                                                <tr>
                                                    <th class="panel-title title1">
                                                        Emri:
                                                    </th>
                                                    <th class="panel-title title1 ">
                                                        Mbiemri:
                                                    </th>
                                                    <th class="panel-title title1 ">
                                                        Afersia:
                                                    </th>
                                                    <th class="panel-title title1">
                                                        Telefoni:
                                                    </th>
                                                    <th class="panel-title title1">
                                                        Adresa:
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td class="title1">
                                                        Arbon
                                                    </td>
                                                    <td class="title1">
                                                        Dina
                                                    </td>
                                                    <td class="title1">
                                                        Babai
                                                    </td>
                                                    <td class="title1">
                                                        0495669563
                                                    </td>
                                                    <td class="title1">
                                                        Shtupeq i vogel
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="padding-bottom: 0;">
                                        <h6 class="panel-title panel-white text-center col-header">Pranimet ne spital</h6>
                                    </div>
                                    <div class="card-body card-top">
                                        <table class="data-list min-height dignosis color-none">
                                            <tbody>
                                                <tr>
                                                    <th class="panel-title title1 date">
                                                        Data:
                                                    </th>
                                                    <th class="panel-title title2 ">
                                                        Departamenti:
                                                    </th>
                                                    <th class="panel-title title2 ">
                                                        Pranuesi:
                                                    </th>
                                                    <th class="panel-title title2 ">
                                                        Arsyeja:
                                                    </th>
                                                    <th class="panel-title title1 date">
                                                        Dalja:
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td class="title1 date">
                                                        19.12.2020
                                                    </td>
                                                    <td class="title2">
                                                        Urologji
                                                    </td>
                                                    <td class="title2">
                                                        Dr. Argon Mustafa
                                                    </td>
                                                    <td class="title2">
                                                        Probleme me veshka
                                                    </td>
                                                    <td class="title1 date">
                                                        02.02.2021
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="title1 date">
                                                        21.12.2020
                                                    </td>
                                                    <td class="title2">
                                                        I zemres
                                                    </td>
                                                    <td class="title2">
                                                        Tension i larte
                                                    </td>
                                                    <td class="title2">
                                                        Br. Arbon Ramaj
                                                    </td>
                                                    <td class="title1 date">
                                                        -
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="title1 date">
                                                        19.12.2020
                                                    </td>
                                                    <td class="title2">
                                                        Paracetamoll
                                                    </td>
                                                    <td class="title2">
                                                        Per dhimbje koke
                                                    </td>
                                                    <td class="title2">
                                                        2 here ne dite
                                                    </td>
                                                    <td class="title1 date">
                                                        24.12.2020
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="padding-bottom: 0;">
                                        <h6 class="panel-title panel-white text-center col-header">Terminet</h6>
                                    </div>
                                    <div class="card-body card-top">
                                        <table class="data-list min-height dignosis color-none">
                                            <tbody>
                                                <tr>
                                                    <th class="panel-title title1 date">
                                                        Data:
                                                    </th>
                                                    <th class="panel-title title2 ">
                                                        Doktori:
                                                    </th>
                                                    <th class="panel-title title2 ">
                                                        Ora:
                                                    </th>
                                                    <th class="panel-title title2 ">
                                                        Statusi:
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td class="title1 date">
                                                        19.12.2020
                                                    </td>
                                                    <td class="title2">
                                                        Dr. Argon Mustafa
                                                    </td>
                                                    <td class="title2">
                                                        12:45
                                                    </td>
                                                    <td class="title2">
                                                        Perfunduar
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="title1 date">
                                                        19.12.2020
                                                    </td>
                                                    <td class="title2">
                                                        Dr. Argon Mustafa
                                                    </td>
                                                    <td class="title2">
                                                        12:45
                                                    </td>
                                                    <td class="title2">
                                                        Perfunduar
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="title1 date">
                                                        19.12.2020
                                                    </td>
                                                    <td class="title2">
                                                        Dr. Argon Mustafa
                                                    </td>
                                                    <td class="title2">
                                                        12:45
                                                    </td>
                                                    <td class="title2">
                                                        Perfunduar
                                                    </td>
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
    </div>
</body>

</html>

<script>
    $(document).ready(function() {
        $("#CloseHistory").click(function() {
            $("#container-fullw").load('includes/payment.php');
        });
    });
</script>