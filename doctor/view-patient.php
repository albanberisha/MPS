<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doctor | Informata rreth pacientëve</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type='text/javascript' src='https://code.jquery.com/jquery-1.11.0.js'></script>
    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script src="js/sidenavigation.js"></script>
    <script src="js/imagebrowse.js"></script>
    <script src="js/input-masks.js"></script>
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
            <div class="">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav navbar-pat">
                            <li class="nav-item active">
                                <button type="button" id="Summary" class="left-marg  btn btn-primary">Detaje të përgjithshme</button>
                            </li>
                            <li class="nav-item active">
                                <button type="button" id="LabResults" class=" left-marg  btn btn-primary">Rezultatet laboratorike</button>
                            </li>
                            <li class="nav-item active">
                                <button type="button" id="Diagnosis" class="left-marg  btn btn-primary">Diagnozat</button>
                            </li> 
                            <li class="nav-item active">
                                <button type="button" id="Manage" class="left-marg  btn btn-primary">Menaxho</button>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="container-fullw" id="container-fullw">
            <?php include('includes/summary-patient.php'); ?>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    $(document).ready(function() {
        $("#Summary").click(function() {
            $("#container-fullw").load('includes/summary-patient.php');
        });
        $("#LabResults").click(function() {
            $("#container-fullw").load('includes/lab-results.php');
        });
        $("#Diagnosis").click(function() {
            $("#container-fullw").load('includes/diagnosis.php');
        });
        $("#Manage").click(function() {
            $("#container-fullw").load('includes/manage-patient.php');
        });
    });
</script>