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



$hosppnoldprice = null;
$hospnid = null;
if (isset($_GET['edit'])) {
    $hospnid = $_GET['id'];
    $query = mysqli_query($con, "SELECT * From pricing_list WHERE status=1 && id='$hospnid'");
    if (!$query) {
        die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
    } else {
        $data = mysqli_fetch_array($query);
        if ($data > 0) {
            $hosppnoldprice = $data['price'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Ndrysho</title>
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
                <p>Admin | Ndrysho</p>
            </div>
            <div class=" container-fullw">
                <?php
                if ($hospnid == NULL) {
                    echo "Asgje per tu shfaqur";
                } else {
                    $query = mysqli_query($con, "SELECT * from pricing_list WHERE id='$hospnid' && status='1'");
                    if (!$query) {
                        die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                    } else {
                        $data = mysqli_fetch_array($query);
                        if ($data > 0) {
                ?>
                            <div class="card">
                                <div class="form-group">
                                    <form id="edithosppn_form" method="post">
                                        <div class="form-group">
                                            <label class="input-title">
                                                Çmimi per nje nate ne spital</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">€</span>
                                                </div>
                                                <input type="number" step="0.01" id="HospnPrice" class="form-control" placeholder="Çmimi i nates ne spital" value="<?php echo htmlentities($data['price']) ?>">
                                            </div>
                                            <p id="ResponseHospnEdit" style="color:red;"></p>

                                        </div>
                                        <div class="form-group" style="margin-top: 10px;">
                                            <button type="submit" class="btn btn-primary">Ndrysho</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                <?php
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    $('#edithosppn_form').submit(function(e) {

        e.preventDefault();
        $('#ResponseHospnEdit').html("");
        hospprice = $('#HospnPrice').val();
        oldprice = "<?php echo $hosppnoldprice ?>";
        hospnid = "<?php echo $hospnid ?>";
        if (oldprice == hospprice) {
            $('#ResponseHospnEdit').html("Ky eshte aktualisht qmimi!");
        } else {
            $confirm = confirm('A jeni te sigurte qe deshironi ta beni perditesimin?');
            if ($confirm) {
                $.ajax({
                        method: "POST",
                        url: "includes/update-hosp-pn.inc.php",
                        data: {
                            id: hospnid,
                            price: hospprice
                        }
                    })
                    .done(function(response) {
                            alert("Perditesimi u krye me sukses.");
                            window.open('hospital-info.php', '_self');
                    });
                return false;

            } else {
                $('#ResponseHospnEdit').html("Perditesimi u anulua.");
            }
        }
    });
</script>