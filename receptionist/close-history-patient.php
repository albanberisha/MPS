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

$userid = null;
if (isset($_GET['closehistory'])) {
    $userid = $_GET['id'];
}
?>
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
                <?php
                $exists=true;
                 $query = mysqli_query($con, "select patientId from beds where patientId='$userid' ");
                 if (!$query) {
                     die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                 } else {
                    $data = mysqli_fetch_array($query);
                    if ($data <= 0)
                    {
                        $exists=false;
                    }
                 }
                if ($userid == NULL || !$exists) {
                    echo "Asgje per tu shfaqur";
                } else {
                    $_SESSION['userid'] = $userid;
                ?>
                    <div class="panel-body no-padding">
                        <div class="main-body">
                            <div class="row gutters-sm">
                                <div class="col-md-12" style="margin-bottom: 10px;">
                                <div class="card">
                                        <button type="button" id="DeatInHospital" class="btn btn-primary" style="color:white; background-color: black;"><span style="font-size: 15px;">+</span> Rast Vdekje</button>
                                    </div>
                                    <div class="card">
                                        <button type="button" id="CloseHistory" class="btn btn-primary"><span style="font-size: 15px;">+</span> Mbyll Historine</button>
                                    </div>
                                    <div>
                                        <p class="panel-title mb-1">Printo formen e gatshme per mbyllje <a href="../documents/close-form.pdf">Printo</a>.</p>
                                    </div>

                                    <?php
                                    $query = mysqli_query($con, "SELECT beds.id as bednumber,beds.condition,rooms.id as roomnumber, departaments.id as depid, departaments.depname from beds, rooms,departaments where beds.roomId=rooms.id and rooms.depId=departaments.id and beds.patientId='$userid'");
                                    if (!$query) {
                                        die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                                    } else {
                                        $data = mysqli_fetch_array($query);
                                        if ($data > 0) {
                                    ?>
                                            <div class="card">
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
                                                                <th class="panel-title title5 ">
                                                                    Gjendja:
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <td class="title5">
                                                                    <?php echo htmlentities($data['depname']) ?>
                                                                </td>
                                                                <td class="title5">
                                                                    <?php echo htmlentities($data['roomnumber']) ?>
                                                                </td>
                                                                <td class="title5">
                                                                    <?php echo htmlentities($data['bednumber']) ?>
                                                                </td>
                                                                <td class="title5">
                                                                    <?php
                                                                    $condition = $data['condition'];
                                                                    switch ($condition) {
                                                                        case "red":
                                                                    ?>
                                                                            <a href="#" type="button" class="btn btn-secondary" style=" background: red; border:1px solid rgb(255, 142, 142); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast emergjent. Kerkohet intervenim i menjehershem per shpetim te jetes. Riskt te madh per humbje te jetes.">Kuqe</a>
                                                                        <?php
                                                                            break;
                                                                        case "yellow":
                                                                        ?>
                                                                            <a href="#" type="button" class="btn btn-secondary" style="background: yellow; border:1px solid rgb(199, 199, 105); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast urgjent. Kerkohen shume resurse mirpo jo rreizk per jeten. Rast potencial resioz">Verdhë</a>
                                                                        <?php
                                                                            break;
                                                                        default:
                                                                        ?>
                                                                            <a href="#" type="button" class="btn btn-secondary" style="background: green; border:1px solid rgb(128, 253, 128); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast me pak urgjent. Intervenim standard.">Gjelbër</a>

                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div style="padding-bottom: 0;">
                                            <h6 class="panel-title panel-white text-center col-header">Detajet e pacientit</h6>
                                        </div>
                                        <?php
                                        $query2 = mysqli_query($con, "SELECT patients.id, patients.patientID, patients.name, patients.surname, patients.gender, patients.phone, patients.blood_type, patients.state, patients.city, patients.street_address from patients where patients.id='$userid'");
                                        if (!$query2) {
                                            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                                        } else {
                                            $data2 = mysqli_fetch_array($query2);
                                            if ($data2 > 0) {
                                        ?>
                                                <div class="card-body card-top">
                                                    <div class="d-flex flex-column align-items-center text-center bottom-10">
                                                        <div class="mt-3">
                                                            <h4><?php echo htmlentities($data2['patientID']) ?></h4>
                                                            <p class="panel-title mb-1"><?php echo htmlentities($data2['name']) ?> <?php echo htmlentities($data2['surname']) ?></p>
                                                        </div>
                                                    </div>
                                                    <div style="display: table-row">
                                                        <div style="width: 49%; word-break: break-word; display: table-cell; padding-right: 1%;">
                                                            <div class="bottom-10">
                                                                <label style="margin-bottom: 0;"> <b>Gjinia:</b></label>
                                                                <p><?php echo htmlentities($data2['gender']) ?></p>
                                                            </div>
                                                            <div class="bottom-10">
                                                                <label style="margin-bottom: 0;"> <b>Grupi i gjakut:</b></label>
                                                                <p><?php echo htmlentities($data2['blood_type']) ?></p>
                                                            </div>
                                                        </div>
                                                        <div style="width: 49%; word-break: break-word; display: table-cell; padding-left: 1%">
                                                            <div class="bottom-10">
                                                                <label style="margin-bottom: 3px;"> <b>Numri i telefonit:</b></label>
                                                                <p><?php echo htmlentities($data2['phone']) ?></p>
                                                            </div>
                                                            <div class="bottom-10">
                                                                <label style="margin-bottom: 0;"> <b>Adresa:</b></label>
                                                                <p><?php echo htmlentities($data2['state']) ?>, <?php echo htmlentities($data2['city']) ?>, <?php echo htmlentities($data2['street_address']) ?></p>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card">
                                    <?php
                                        $query3 = mysqli_query($con, "SELECT name,surname,relation,phone, state,city,street_address from emergencycontacts where patientId='$userid'");
                                        if (!$query3) {
                                            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                                        } else {
                                            $data3 = mysqli_fetch_array($query3);
                                            if ($data3 > 0) {
                                        ?>
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
                                                        <?php echo htmlentities($data3['name']) ?>
                                                        </td>
                                                        <td class="title1">
                                                        <?php echo htmlentities($data3['surname']) ?>
                                                        </td>
                                                        <td class="title1">
                                                        <?php echo htmlentities($data3['relation']) ?>
                                                        </td>
                                                        <td class="title1">
                                                        <?php echo htmlentities($data3['phone']) ?>
                                                        </td>
                                                        <td class="title1">
                                                        <p><?php echo htmlentities($data3['state']) ?>  <?php echo htmlentities($data3['city']) ?>  <?php echo htmlentities($data3['street_address']) ?></p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                     <?php
                                            }
                                        }
                                     ?>
                                        <div style="padding-bottom: 0;">
                                            <h6 class="panel-title panel-white text-center col-header">Pranimet ne spital</h6>
                                        </div>
                                        <?php
                                        $query4 = mysqli_query($con, "SELECT receipts.id,receipts.entryDateTime,users.name, users.surname,receipts.reason,receipts.exitDateTime, receipts.bedId from receipts,users where receipts.patientId='$userid' and receipts.userInCharge=users.id ORDER BY receipts.id DESC");
                                        if (!$query4) {
                                            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                                        } else {
                                            $query5 = mysqli_query($con, "SELECT receipts.id,receipts.entryDateTime,departaments.depname,users.name, users.surname,receipts.reason,receipts.exitDateTime, receipts.bedId from receipts,rooms,beds,departaments,users where receipts.patientId='$userid' and receipts.bedId=beds.id and beds.roomId=rooms.id and rooms.depId=departaments.id and receipts.userInCharge=users.id ORDER BY receipts.id DESC");
                                            if (!$query5) {
                                                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                                            } else {
                                                ?>
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
                                                <?php
                                                $data5 = mysqli_fetch_array($query5);
                                                while ($data4 = mysqli_fetch_array($query4)) {
                                                    if($data4['bedId']!=NULL)
                                                    {
                                                        ?>
                                                        <tr>
                                                        <td class="title1 date">
                                                        <?php 
                                                        $timestamp = $data5['entryDateTime'];
                                                        $splitTimeStamp = explode(" ",$timestamp);
                                                        echo htmlentities($splitTimeStamp[0]) ?>
                                                        
                                                        </td>
                                                        <td class="title2">
                                                        <?php echo htmlentities($data5['depname']) ?>
                                                        </td>
                                                        <td class="title2">
                                                        <?php echo htmlentities($data5['name']) ?>  <?php echo htmlentities($data5['surname']) ?>
                                                        </td>
                                                        <td class="title2">
                                                        <?php echo htmlentities($data5['reason']) ?>
                                                        </td>
                                                        <td class="title1 date">
                                                        <?php 
                                                        $timestamp = $data5['exitDateTime'];
                                                        $splitTimeStamp = explode(" ",$timestamp);
                                                        $data=$splitTimeStamp[0];
                                                        if($data==NULL)
                                                        {
                                                            echo "-";
                                                        }else{
                                                        echo htmlentities($splitTimeStamp[0]);
                                                        }
                                                        ?>
                                                        </td>
                                                    </tr>
                                        
                                            <?php
                                                    }else{
                                                        ?>
                                                        <tr>
                                                        <td class="title1 date">
                                                        <?php 
                                                        $timestamp = $data4['entryDateTime'];
                                                        $splitTimeStamp = explode(" ",$timestamp);
                                                        echo htmlentities($splitTimeStamp[0]); ?>
                                                        </td>
                                                        <td class="title2">
                                                        -
                                                        </td>
                                                        <td class="title2">
                                                        <?php echo htmlentities($data4['name']) ?>  <?php echo htmlentities($data4['surname']) ?>
                                                        </td>
                                                        <td class="title2">
                                                        <?php echo htmlentities($data4['reason']) ?>
                                                        </td>
                                                        <td class="title1 date">
                                                        <?php 
                                                        $timestamp = $data4['exitDateTime'];
                                                        $splitTimeStamp = explode(" ",$timestamp);
                                                        $data=$splitTimeStamp[0];
                                                        if($data==NULL)
                                                        {
                                                            echo "-";
                                                        }else{
                                                        echo htmlentities($splitTimeStamp[0]);
                                                        }
                                                         ?>
                                                        </td>
                                                    </tr>
                                        
                                            <?php
                                                    }
                                                }
                                                ?>
                                                 </tbody>
                                            </table>
                                            </div>
                                                <?php
                                            }
                                        }
                                            
                                            ?>
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
                                                    <?php
                                                      $query7 = mysqli_query($con, "SELECT appointments.date,appointments.starttime,appointments.endtime,appointments.status,users.name,users.surname from appointments,users WHERE appointments.doctorId=users.id and appointments.patientId='$userid' order BY date ASC, starttime ASC limit 10");
                                                      if (!$query7) {
                                                    die(mysqli_error($con).$query7);
                                                      } else {
                                                          while($data7= mysqli_fetch_array($query7))
                                                          {
                                                              ?>
                                                              <tr>
                                                        <td class="title1 date">
                                                            <?php echo htmlentities($data7['date'])?>
                                                        </td>
                                                        <td class="title2">
                                                        <?php echo htmlentities($data7['name'])?> <?php echo htmlentities($data7['surname'])?>
                                                        </td>
                                                        <td class="title2">
                                                        <?php echo htmlentities($data7['starttime'])?>-<?php echo htmlentities($data7['endtime'])?>
                                                        </td>
                                                        <td class="title2">
                                                        <?php 
                                                            $status=$data7['status'];
                                                            $statusi="";
                                                            switch($status)
                                                            {
                                                                case "approved":
                                                                    $statusi="Aprovuar";
                                                                    break;
                                                                    case "finished":
                                                                        $statusi="Pefunduar";
                                                                        break;
                                                                        case "rejected":
                                                                            $statusi="refuzuar";
                                                                            break;
                                                                            default:
                                                                                $statusi="";
                                                            }
                                                            echo $statusi;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                              <?php
                                                          }
                                                      }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    $(document).ready(function() {
        $("#CloseHistory").click(function() {
            window.open('payment.php?id=<?php echo $userid ?>&payment=patient','_self');
        });
        $("#DeatInHospital").click(function() {
            window.open('death-form.php?id=<?php echo $userid ?>&death=patient','_self');
        });
    });
    
</script>