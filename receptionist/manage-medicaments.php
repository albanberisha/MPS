<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/logincheck.php');
check_login();
//Ending a php session after 1(60 min) hours of inactivity
$minutesBeforeSessionExpire = 60;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($minutesBeforeSessionExpire * 60))) {
    $uname=$_SESSION["login"];
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
    <title>Receptionist | Menaxho medikamentet</title>
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
                <p>Receptionist | Menaxho medikamentet</p>
            </div>
            <div class="container-fullw">
            <form class="search-form" id="search_form" method="post">
                    <div class="d-inline-flex panel-search">
                        <div class="input-group-prepend">
                            <img class="input-group-text" src="img/search-clipart-btn.png" width="38px" height="38px">
                        </div>
                        <input type="search" name="search-medicament" id="SearchMedicament" class="form-control type-text data-to-search" placeholder="Kerko sipas emrit">
                        <button type="submit" class="btn btn-primary btn-send">Kerko</button>
                        <button type="button" id="Refresh" class="btn btn-primary btn-send"><img class="" src="../img/refresh.png" width="20px" height="20px">
                        </button>
                    </div>
                    <p id="Searcherror" style="color:red;"></p>
                </form>
                <p id="Deleteerror" style="color:red;"></p>
                <div class="panel-body no-padding">
                    <div class="panel-heading">
                        <h5 class="panel-title panel-white text-center">Medikamentet</h5>
                    </div>
                    <table class="data-list min-height">
                        <tr class="table-head ">
                            <td class="midh">Nr.</td>
                            <td class="mednameh">Emri i medikamentit</td>
                            <td class="expdateh">Data e skadimit</td>
                            <td class="desch">Ne stock [Limiti per mungese]</td>
                            <td class="actionsh">
                            </td>
                        </tr>
                    </table>
                    <table class="data-list">
                        <tbody id="Medicaments">
                            <?php
                            $query = mysqli_query($con, "SELECT * from medicaments where status='1' ORDER BY quantity-lowStock ASC");
                            if (!$query) {
                                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                            } else {
                                $count = 1;
                                while (($data = mysqli_fetch_array($query))) {
                                    $today = date("Y-m-d");
                                    if ($data['expired_date'] <= $today) {
                            ?>
                                        <tr style="background-color: red; color:white;">
                                        <?php
                                    } elseif($data['lowStock']>=$data['quantity']) {
                                        ?>
                                        <tr style="color:red;">
                                        <?php
                                    }else{
                                        ?>
                                        <tr>
                                        <?php
                                    }
                                        ?>
                                            <td class="mid">
                                                <?php
                                                echo $count; ?>
                                            </td>
                                        <?php
                                        ?>
                                        <td class="medname">
                                            <?php echo htmlentities($data['name']); ?>
                                        </td>
                                        <td class="expdate">
                                            <?php
                                            $today = date("Y-m-d");
                                            echo htmlentities($data['expired_date']); ?>
                                        </td>
                                        <td class="desc">
                                        <?php echo htmlentities($data['quantity']); ?> [<?php echo htmlentities($data['lowStock']); ?>]
                                        </td>
                                        <td class=" actions">
                                            <span class="edit-data">
                                                <a href="edit-medicament.php?id=<?php echo $data['id'] ?>&edit=medicament">
                                                    <img src="img/edit-icon.png"> </a>
                                            </span>
                                            <span class="delete-data">
                                                <a href="#" onclick="deletemedicament(<?php echo $data['id'] ?>);">
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
        function deletemedicament($id) {
            $confirm = confirm('A jeni te sigurte qe deshironi ta fshini medikamentin?');
        if($confirm)
        {
            table = 'medicaments';
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
                        $("#Medicaments").html(response);
                    }
                });
            return false;
        }else{
            $('#Deleteerror').html("Fshierja u anulua.");
        }            
        }
        $("#Refresh").on('click', function()
        {
            location.reload();
        });

        $("#search_form").submit(function(e) {
            e.preventDefault();
            name = $('#SearchMedicament').val();
            table = 'medicaments';
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
                        $("#Medicaments").html(response);
                    }
                });
            return false;
        });
    </script>




