<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/logincheck.php');
check_login();
//Ending a php session after 6(360 min) hours of inactivity
$minutesBeforeSessionExpire = 360;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($minutesBeforeSessionExpire * 60))) {$uname=$_SESSION["login"];
    $onlnine=mysqli_query($con,"UPDATE users SET users.online=0 WHERE username='$uname'");
    
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
    <title>Admin | Menaxho Stafin</title>
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
                <p>Admin | Menaxho Stafin</p>
            </div>
            <div class="container-fullw">
                <form class="search-form" id="search_form" method="post">
                    <div class="d-inline-flex panel-search">
                        <div class="input-group-prepend">
                            <img class="input-group-text" src="img/search-clipart-btn.png" width="38px" height="38px">
                        </div>
                        <input type="search" name="search-staff" id="Search" class="form-control type-text data-to-search" placeholder="Kerko sipas emrit">
                        <button type="submit" class="btn btn-primary btn-send">Kerko</button>
                        <button type="button" id="Refresh" class="btn btn-primary btn-send"><img class="" src="img/refresh.png" width="20px" height="20px">
                        </button>
                    </div>
                    <p id="Searcherror" style="color:red;"></p>
                </form>
                <p id="Deleteerror" style="color:red;"></p>
                <div class="panel-body no-padding">
                    <div class="panel-heading">
                        <h5 class="panel-title panel-white text-center">Infermieret</h5>
                    </div>
                    <table class="data-list min-height">
                        <tr class="table-head ">
                            <td class="sidh">Nr.</td>
                            <td class="snameh">Emri</td>
                            <td class="ssnameh">Mbiemri</td>
                            <td class="sposf">Pozita</td>
                            <td class="actionsh">
                            </td>
                        </tr>
                    </table>
                    <table class="data-list">
                        <tbody id="Staff">
                            <?php
                            $query = mysqli_query($con, " SELECT additional_staff.id, additional_staff.name, additional_staff.surname, hospital_additional_staff.name as pos_name from additional_staff, hospital_additional_staff where additional_staff.status=1 and additional_staff.position=hospital_additional_staff.id ");
                            if (!$query) {
                                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                            } else {
                                $count = 1;
                                while (($data = mysqli_fetch_array($query))) {
                            ?>
                                    <tr>
                                        <td class="sid">
                                            <?php echo $count; ?>
                                        </td>
                                        <td class="sname">
                                            <?php echo htmlentities($data['name']); ?>
                                        </td>
                                        <td class="ssname">
                                            <?php echo htmlentities($data['surname']); ?>
                                        </td>
                                        <td class="spos">
                                            <?php echo htmlentities($data['pos_name']); ?>

                                        </td>
                                        <td class=" actions">
                                            <span class="edit-data">
                                                <a href="edit-staf.php?id=<?php echo $data['id'] ?>&edit=staff">
                                                    <img src="img/edit-icon.png"> </a>
                                            </span>
                                            <span class="delete-data">
                                                <a href="#" onclick="deletestaf(<?php echo $data['id'] ?>);">
                                                    <img src="img/delete-icon.png">
                                                </a>
                                            </span>
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
    function deletestaf($id) {
        table = 'staff';
        $confirm = confirm('A jeni te sigurte qe deshironi ta fshini?');
        if ($confirm) {
            $.ajax({
                    method: "POST",
                    url: "includes/delete-user.inc.php",
                    data: {
                        id: $id,
                        table: table
                    }
                })
                .done(function(response) {
                    if (response == "error") {
                        $('#Deleteerror').html("Fshierja nuk lejohet!");
                    } else {
                        $('#Deleteerror').html("Fshierja u krye me sukses.");
                        $("#Staff").html(response);
                    }
                });
            return false;
        } else {
            $('#Deleteerror').html("Fshierja u anulua.");

        }
    }
    $("#Refresh").on('click', function() {
        location.reload();
    });


    $("#search_form").submit(function(e) {
        e.preventDefault();
        recname = $('#Search').val();
        table = 'staff'
        $.ajax({
                method: "POST",
                url: "includes/search.inc.php",
                data: {
                    name: recname,
                    table: table
                }
            })
            .done(function(response) {
                if (response == "error") {
                    $('#Searcherror').html("Format i pa lejuar!");
                } else {
                    $('#Searcherror').html("");
                    $("#Staff").html(response);
                }
            });
        return false;
    });
</script>