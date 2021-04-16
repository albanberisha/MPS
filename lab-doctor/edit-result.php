<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/logincheck.php');
check_login();
//Ending a php session after 6(360 min) hours of inactivity
$minutesBeforeSessionExpire = 360;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($minutesBeforeSessionExpire * 60))) {
    session_unset();     // unset $_SESSION   
    session_destroy();   // destroy session data 
    $host = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = "../index.php";
    $_SESSION["login"] = "";
    header("Location: http://$host$uri/$extra");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity
$analyzeid = null;
if (isset($_GET['edit'])) {
    $analyzeid = $_GET['id'];
}
$analyzepath=null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doktor | Rezultate te reja</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/sidenavigation.js"></script>
    <script src="js/imagebrowse.js"></script>

</head>

<body>
    <header>
        <?php include('includes/header.php'); ?>
        <hr style="margin-top:0px;">
    </header>
    <div class="" style="display: flex; margin-top: -16px; width: 100%;">
        <?php include('includes/sidebar.php'); ?>

        <div class="page" style="width: 100%;">
            <div class="card-header">
                <p>Doktor | Rezultate të reja</p>
            </div>
            <div class="container-fullw">

                <div class="panel-body">
                    <div class="panel-heading">
                        <h5 class="panel-title">Ndrysho rezultatin</h5>
                    </div>
                    <div class="panel-form">
                        <?php
                        if ($analyzeid == NULL) {
                            echo "Asgje per tu shfaqur.";
                        } else {
                            $query = mysqli_query($con, "SELECT analyzes.id, analyzes.documentPath,analyzes.patientId as patientid,analyzes.analyse_id as analyzeid,patients.patientID as personalnumber, pricing_list.name as analysename from analyzes, patients,pricing_list WHERE analyzes.id='$analyzeid' and analyzes.status='1' and analyzes.patientId=patients.id and analyzes.analyse_id=pricing_list.id");
                            if (!$query) {
                                die(mysqli_error($con) . $query);
                            } else {
                                $data = mysqli_fetch_array($query);
                                if ($data > 0) {
                                    $analyzepath=$data['documentPath'];
                        ?>
                                    <form method="POST" id="EditAnalyseFrom" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="input-group my-3">
                                                <input type="text" class="form-control" disabled placeholder="<?php echo htmlentities($data['documentPath']) ?>" id="file">
                                                <div class="input-group-append">
                                                    <button type="button" class="browse btn btn-primary">Ngarkoni...</button>
                                                </div>
                                            </div>
                                            <span id="Fileerror" style="color: red;"></span>
                                            <input type="file" id="file2" name="file2" class="file" accept=".doc,.docx,.pdf,.xlsx,.jpg, .jpeg, .png">
                                        </div>
                                        <div class="form-group">
                                        <label class="input-title" for="analyse">
                                            Lloji i analizes:
                                        </label>
                                        <select name="analyze" class="form-control doctorposition" required="true">
                                            <option value="<?php echo htmlentities($data['analyzeid']) ?>" selected value=""><?php echo htmlentities($data['analysename']) ?></option>
                                        </select>
                                        <span id="Analyseerror" style="color: red;"></span>
                                    </div>
                                        <div class="div-inlineflex">
                                            <div class="form-group">
                                                <label class="input-title">Numri personal i pacientit</label>
                                                <input type="number" readonly="readonly" id="NamePat" name="personalnumberPat" class="form-control" value="<?php echo htmlentities($data['personalnumber']) ?>">
                                            </div>
                                        </div>
                                        <div class="div-inlineflex" hidden>
                                            <div class="form-group">
                                                <label class="input-title">Numri personal i pacientit</label>
                                                <input type="hidden" readonly="readonly" id="patientId" name="patientId" class="form-control" value="<?php echo htmlentities($data['patientid']) ?>">
                                            </div>
                                        </div>
                                        <div class="div-inlineflex" hidden>
                                            <div class="form-group">
                                                <label class="input-title">Numri personal i pacientit</label>
                                                <input type="hidden" readonly="readonly" id="analyseId" name="analyseId" class="form-control" value="<?php echo htmlentities($data['id']) ?>">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-top: 10px;">
                                            <button type="submit" class="btn btn-primary">Ndrysho</button>
                                        </div>
                                    </form>
                        <?php
                                } else {
                                    echo "Asgje per tu shfaqur.";
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


<script>
    $("#EditAnalyseFrom").submit(function(e) {
        e.preventDefault();
        $('#Fileerror').html("");
        var myform = document.getElementById("EditAnalyseFrom");
        var fd = new FormData(myform);
        $.ajax({
                url: "includes/edit-analyse.inc.php",
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                method: 'POST'
            })
            .done(function(response) {
                $message = "";
                error = response.substring(0, 3);
                switch (error) {
                    case "100":
                        $message = "Ngarkoni analizen.";
                        $('#Fileerror').html($message);
                        document.getElementById('Fileerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "101":
                        $message = "Kerkohen formatet: .doc, .docx, .xlsx, .pdf, .jpg, .jpeg, .png.";
                        $('#Fileerror').html($message);
                        document.getElementById('Fileerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "102":
                        $message = "Fajlli shume i madh.";
                        $('#Fileerror').html($message);
                        document.getElementById('Fileerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "103":
                        $message = "nje gabim ka ndodhur. Kontaktoni administratorin.";
                        $('#Fileerror').html($message);
                        document.getElementById('Fileerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    default:
                        alert("Te dhenat u ruajten me sukses");
                        window.location.href = response;
                }
            });
        return false;
    });
</script>