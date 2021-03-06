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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Kycjet</title>
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
                <p>Admin | Kycjet</p>
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
                <div class="panel-body no-padding">
                    <div class="panel-heading">
                        <h5 class="panel-title panel-white text-center">Kycjet</h5>
                    </div>
                    <table class="data-list min-height">
                        <tr class="table-head ">
                            <td class="logIdh">Nr.</td>
                            <td class="userIdh">Id</td>
                            <td class="uusernameh">Username</td>
                            <td class="logintimeh">Data e kycjes</td>
                            <td class="loginhourh">Ora e shkycjes</td>
                            <td class="statusLogh">Statusi</td>
                        </tr>
                    </table>
                    <table class="data-list">
                    <tbody id="User-logs">
                        <?php
                        $query=mysqli_query($con,"SELECT * from userlog ORDER BY id DESC");
                        
                        if (!$query) {
                            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                        } else {
                            $cnt=1;
                          while(($data=mysqli_fetch_array($query)) && $cnt<100)
                          {
                            ?>
                            <tr>
                            <td class="logId"><?php echo $cnt;?></td>
                            <td class="userId"><?php echo $data['userId'];?></td>
                            <td class="uusername"><?php echo $data['username'];?></td>
                            <td class="logintime"><?php echo $data['loginDate'];?></td>
                            <td class="loginhour"><?php echo $data['loginTime'];?></td>
                            <td class="statusLog
                            <?php
                            if($data['status']==1)
                            {
                                ?>
                                text-success">
                                <?php
                                echo "Sukses.";
                            }else{
                                ?>
                                text-danger">
                                <?php
                                echo "Pa sukses.";
                            }
                            ?>
                            </td>
                             </tr>
                            <?php  
                            $cnt=$cnt+1;
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
    $("#Refresh").on('click', function() {
        location.reload();
    });


    $("#search_form").submit(function(e) {
        e.preventDefault();
        username = $('#Search').val();
        table = 'session-logs';
        $.ajax({
                method: "POST",
                url: "includes/search.inc.php",
                data: {
                    name: username,
                    table: table
                }
            })
            .done(function(response) {
                if (response == "error") {
                    $('#Searcherror').html("Format i pa lejuar!");
                } else {
                    $('#Searcherror').html("");
                    $("#User-logs").html(response);
                }
            });
        return false;
    });
</script>