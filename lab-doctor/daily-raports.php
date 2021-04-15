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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doktor | Raport ditor</title>
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
                <p>Doktor | Rezultatet e sotme</p>
            </div>
            <div class="container-fullw">
            <div class="panel-body no-padding" style="margin-top: 20px;">
                    <div class="panel-heading">
                        <h5 class="panel-title panel-white text-center">Publikimet e mija te dates <b><?php echo date('d.m.Y') ?></b></h5>
                    </div>
                    <p id="Deleteerror" style="color:red;"></p>
                    <table class="data-list min-height">
                        <tbody>
                            <tr class="table-head ">
                                <td class="rezidh">Nr.</td>
                                <td class="rezdesch">ID e pacientit</td>
                                <td class="rezdateh">Pershkrimi</td>
                                <td class="rezdepth">Data e krijimit</td>
                                <td class="actionsh">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="data-list">
                    <tbody id="Analyzes">
                        <?php
                        $userid=$_SESSION['id'];
            $query2 = mysqli_query($con,"SELECT analyzes.id,analyzes.patientId,analyzes.releaseDate,patients.name,patients.surname,patients.patientID,pricing_list.name as analysedesc from patients,analyzes,pricing_list WHERE analyzes.patientId=patients.id and analyzes.analyse_id=pricing_list.id and pricing_list.status='1' and analyzes.status='1' and analyzes.userId='$userid' and DATE(analyzes.releaseDate) = CURDATE() ORDER BY id DESC");
             if (!$query2) {
                die(mysqli_error($con).$query2);
                 }else{
                     $count=1;
                    while ($data2 = mysqli_fetch_array($query2)) {
                        $count
                        ?>
                        <tr>
                                <td class="rezid">
                                <?php echo $count; ?>
                                </td>
                                <td class="rezdesc">
                                <?php echo htmlentities($data2['patientID']) ?>
                                </td>
                                <td class="rezdate">
                                <?php echo htmlentities($data2['analysedesc']) ?>
                                </td>
                                <td class="rezdept">
                                <?php echo htmlentities($data2['releaseDate']) ?>
                                </td>
                                <td class="actions">
                                    <span class="edit-data">
                                                <a href="edit-result.php?id=<?php echo $data2['id'] ?>&edit=analyze">
                                                    <img src="img/edit-icon.png"> </a>
                                            </span>
                                    <span class="delete-data">
                                                <a href="#" onclick="deleteanalyze(<?php echo $data2['id'] ?>);">
                                                    <img src="img/delete-icon.png">
                                                </a>
                                            </span>
                                </td>
                            </tr>
                        <?php
                        $count++;
                    }
                 }
            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
 function deleteanalyze($id) {
            $confirm = confirm('A jeni te sigurte qe deshironi ta fshini analizen?');
        if($confirm)
        {
            table = 'analyzes';
            $.ajax({
                    method: "POST",
                    url: "includes/delete.inc.php",
                    data: {
                        id: $id,
                        table: table
                    }
                })
                .done(function(response) {
                    if (response == "error") {
                        $('#Deleteerror').html("Fshierja nuk lejohet!");
                    } else {
                        $('#Deleteerror').html("Fshierja u krye me sukses");
                        $("#Analyzes").html(response);
                    }
                });
            return false;
        }else{
            $('#Deleteerror').html("Fshierja u anulua.");
        }            
        }
</script>