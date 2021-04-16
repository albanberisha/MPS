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
    <title>Doktor | Rezultatet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/sidenavigation.js"></script>
    <script src="js/imagebrowse.js"></script>
    <script>
        $(document).ready(function() {
            $('#widget li').on('click', function() {
                $(this).removeClass('new-ntf');
            });
        });
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
            if (widthOutput < 1120) {

            } else {}
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
                <p>Doktor | Rezultatet laboratorike</p>
            </div>
            <div class="container-fullw">
            <form class="search-form" id="search_form" method="post">
                    <div class="d-inline-flex panel-search">
                        <div class="input-group-prepend">
                            <img class="input-group-text" src="img/search-clipart-btn.png" width="38px" height="38px">
                        </div>
                        <input type="search" name="search-analyze" id="SearchAnalyze" class="form-control type-text data-to-search" placeholder="Sheno ID ose emrin e pacientit">
                        <button type="submit" class="btn btn-primary btn-send">Kerko</button>
                        <button type="button" id="Refresh" class="btn btn-primary btn-send"><img class="" src="../img/refresh.png" width="20px" height="20px">
                        </button>
                    </div>
                    <p id="Searcherror" style="color:red;"></p>
                </form>
                <div class="panel-body no-padding" style="margin-top: 20px;">
                    <div class="panel-heading">
                        <h5 class="panel-title panel-white text-center">Rezulatet</h5>
                    </div>
                    <p id="Deleteerror" style="color:red;"></p>
                    <table class="data-list min-height">
                        <tbody>
                            <tr class="table-head ">
                                <td class="rezidh">Numri personal</td>
                                <td class="rezdesch">Pershkrimi</td>
                                <td class="rezdateh">Data e krijimit</td>
                                <td class="rezdepth">Pacienti</td>
                                <td class="actionsh">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="data-list">
                        <tbody id="Results">
                        <?php
                        $userid=$_SESSION['id'];
            $query2 = mysqli_query($con,"SELECT analyzes.id, patients.id as patientId,patients.patientID as personalnumber,analyzes.analyse_id,pricing_list.name as analyzename,analyzes.releaseDate,patients.name, patients.surname from patients,analyzes,pricing_list where analyzes.patientId=patients.id and analyzes.analyse_id=pricing_list.id and analyzes.status='1' and patients.status='1' and pricing_list.status='1' ORDER BY analyzes.releaseDate DESC LIMIT 100");
             if (!$query2) {
                die(mysqli_error($con).$query2);
                 }else{
                     $count=1;
                    while ($data2 = mysqli_fetch_array($query2)) {
                        ?>
                        <tr>
                                <td class="rezid">
                                <?php echo htmlentities($data2['personalnumber']) ?>
                                </td>
                                <td class="rezdesc">
                                <?php echo htmlentities($data2['analyzename']) ?>
                                </td>
                                <td class="rezdate">
                                <?php echo htmlentities($data2['releaseDate']) ?>
                                </td>
                                <td class="rezdept">
                                <?php echo htmlentities($data2['name']) ?> <?php echo htmlentities($data2['surname']) ?> 
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
$("#Refresh").on('click', function()
        {
            location.reload();
        });
 function deleteanalyze($id) {
            $confirm = confirm('A jeni te sigurte qe deshironi ta fshini analizen?');
        if($confirm)
        {
            table = 'analyzes-report';
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
                        $("#Results").html(response);
                    }
                });
            return false;
        }else{
            $('#Deleteerror').html("Fshierja u anulua.");
        }            
        }
        $("#search_form").submit(function(e) {
            e.preventDefault();
            name = $('#SearchAnalyze').val();
            table = 'searchanalyse'
            $.ajax({
                    method: "POST",
                    url: "includes/search.inc.php",
                    data: {
                        name: name,
                        table: table
                    }
                })
                .done(function(response) {
                    if (response == "error") {
                        $('#Searcherror').html("Format i pa lejuar!");
                    } else {
                        $('#Searcherror').html("");
                        $("#Results").html(response);
                    }
                });
            return false;
        });
</script>