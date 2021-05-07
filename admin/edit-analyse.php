<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/logincheck.php');
check_login();
//Ending a php session after 6(360 min) hours of inactivity
$minutesBeforeSessionExpire = 360;
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

$analyseid= null;
$analysename=null;
$oldprice=null;
if (isset($_GET['edit'])) {
    $analyseid= $_GET['id'];
    $query = mysqli_query($con, "SELECT * From pricing_list WHERE status=1 && id='$analyseid'");
    if (!$query) {
        die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
    } else {
        $data = mysqli_fetch_array($query);
        if($data>0)
        {
            $analysename=$data['name'];
            $oldprice=$data['price'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Ndrysho analizen</title>
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
                <p>Admin | Ndrysho analizen</p>
            </div>
            <div class=" container-fullw">
                <?php
                if ($analyseid== NULL) {
                    echo "Asgje per tu shfaqur";
                } else {
                    $query = mysqli_query($con, "SELECT * from pricing_list WHERE id='$analyseid' && status='1'");
                    if (!$query) {
                        die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                    } else {
                        $data = mysqli_fetch_array($query);
                        if ($data > 0) {
                ?>
                            <div class="card">
                                <div class="form-group">
                                    <form id="editanalyse_form" method="post">
                                        <div class="form-group">
                                            <label class="input-title" for="Analyse">
                                                Shenoni emrin e analizes
                                            </label>
                                            <input type="text" id="AnalyseName" class="form-control" placeholder="Sheno emrin e analizes" value="<?php echo htmlentities($data['name']) ?>">
                                            <p id="ResponseAnalyseEdit" style="color:red;"></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="input-title">
                                                Çmimi</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">€</span>
                                                </div>
                                                <input type="number" step="0.01" id="AnalysePrice" placeholder="Çmimi i analizes" value="<?php echo htmlentities($data['price']) ?>">
                                            </div>
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
                    ?>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
<script>
$('#editanalyse_form').submit(function(e){

    e.preventDefault();
    $('#ResponseAnalyseEdit').html("");
        ananame = $('#AnalyseName').val();
        anaprice = $('#AnalysePrice').val();
        oldname="<?php echo $analysename ?>";
        analyseid="<?php echo $analyseid ?>";
        oldprice="<?php echo $oldprice ?>";
              if(ananame.toLowerCase()==oldname.toLowerCase() && oldprice==anaprice)
        {
            $('#ResponseAnalyseEdit').html("Ky eshte aktualisht emri dhe qmimi i analizes");

        }else{
            var patt = new RegExp("^[a-zA-Z0-9_. -/]*$"); //only letters, numbers, - dhe /
            var res = patt.test(ananame);
            if(!res || !ananame || 0 === ananame.length)
            {
                $('#ResponseAnalyseEdit').html("Emri i analizes mund te permbaje: shkronja, numra, - dhe /.");
            }else{
                $confirm = confirm('A jeni te sigurte qe deshironi ta përditesoni analizen?');
                if ($confirm) {
                    $.ajax({
                            method: "POST",
                            url: "includes/update-analyse.inc.php",
                            data: {
                                id: analyseid,
                                name: ananame,
                                price: anaprice
                            }
                        })
                        .done(function(response) {
                            if (response == "error") {
                                $('#ResponseAnalyseEdit').html("Analiza ekziston!.");
                            } else {
                                alert("Perditesimi u krye me sukses.");
                                window.open('hospital-info.php','_self');                            }

                        });
                    return false;

                } else {
                    $('#ResponseAnalyseEdit').html("Perditesimi u anulua.");
                }
            }
        }});
</script>