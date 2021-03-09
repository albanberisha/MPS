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

$userid = null;
if (isset($_GET['edit'])) {
    $userid = $_GET['id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Ndrysho Detajet e Infermierit</title>
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
                <p>Admin | Ndrysho Detajet e Infermierit</p>
            </div>
            <div class=" container-fullw">
                <?php
                if ($userid == NULL) {
                    echo "Asgje per tu shfaqur";
                } else {
                    $_SESSION['userid'] = $userid;
                    $query = mysqli_query($con, "SELECT name, surname, birthday, gender, state, city, street_address, phone, departaments.depname, departaments.id as depid, email, username, last_updated, registered, photo from users, infirmiers, departaments where (users.id=infirmiers.userId and users.status=1) and infirmiers.depId=departaments.id and users.id='$userid'");
                    if (!$query) {
                        die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                    } else {
                        $data = mysqli_fetch_array($query);
                        if ($data > 0) {
                ?>
                            <div class="panel-body">
                                <div class="panel-heading">
                                    <h5 class="panel-title"><?php echo htmlentities($data['name']) ?> <?php echo htmlentities($data['surname']) ?></h5>
                                    <div class="info-panel">
                                        <div class="d-inline-flex">
                                            <h6 class="panel-title">Regjistruar me:</h6>
                                            <p class="reg-date"><?php echo htmlentities($data['registered']) ?></p>
                                        </div>
                                        <div class="d-inline-flex">
                                            <h6 class="panel-title">Hera e fundit e perditesimit:</h6>
                                            <p class="update-date"><?php echo htmlentities($data['last_updated']) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-form">
                                    <form id="EditInfirmierForm" enctype="multipart/form-data">
                                        <div class="circle form-group">
                                            <div class="input-formimg">
                                                <?php
                                                if ($data['photo'] == Null) {
                                                ?>
                                                    <img id="preview" class="circle" src="../img/empty-img.png">
                                                <?php
                                                } else {

                                                    echo '<img id="preview" class="circle" src="data:image/jpeg;base64,' . base64_encode($data['photo']) . '" />  ';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group my-3">
                                                <input type="text" class="form-control" disabled placeholder="Ngarkoni fotografi" id="file">
                                                <div class="input-group-append">
                                                    <button type="button" class="browse btn btn-primary">Ngarkoni...</button>
                                                </div>
                                            </div>
                                            <span id="Imageerror" style="color: red;"></span>
                                            <input type="file" id="file2" name="file2" class="file" accept="image/png">
                                        </div>

                                        <div class="div-inlineflex">
                                            <div class="form-group">
                                                <label class="input-title">Emri i infermierit</label>
                                                <input type="text" id="nameInf" name="nameInf" class="form-control" placeholder="Sheno emrin e infermierit" value="<?php echo htmlentities($data['name']) ?>">
                                                <span id="Nameerror" style="color: red;"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="input-title">Mbiemri i infermierit</label>
                                                <input type="text" id="surnameInf" name="surnameInf" class="form-control" placeholder="Sheno mbiemrin e infermierit" value="<?php echo htmlentities($data['surname']) ?>">
                                                <span id="Surnameerror" style="color: red;"></span>
                                            </div>
                                        </div>
                                        <div class="div-inlineflex">
                                            <div class="form-group">
                                                <label class="input-title">Datelindja</label>
                                                <input type="date" class="form-control" id="Infstart-date" name="infstart_date" value="<?php echo htmlentities($data['birthday']) ?>" />
                                                <span id="Birthdayerror" style="color: red;"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="input-title">Gjinia</label>
                                                <div class="input-title-btn">
                                                    <?php
                                                    $gender = $data['gender'];
                                                    if (strcmp($gender, 'm') == 0) {
                                                    ?>
                                                        <input type="radio" name="infgender" checked value="m"> Mashkull<br>
                                                        <input type="radio" name="infgender" value="f"> Femër
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <input type="radio" name="infgender" value="m"> Mashkull<br>
                                                        <input type="radio" name="infgender" checked value="f"> Femër
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <span id="Gendererror" style="color: red;"></span>
                                            </div>
                                        </div>
                                        <div class="div-inlineflex">
                                            <div class="form-group">
                                                <label class="input-title">Shteti</label>
                                                <input type="text" class="form-control" id="StateAddress" name="stateaddress" placeholder="Shteti" value="<?php echo htmlentities($data['state']); ?>">
                                                <span id="Statedayerror" style="color: red;"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="input-title">Qyteti</label>
                                                <input type="text" class="form-control" id="CityAddress" name="cityaddress" placeholder="Qyteti" value="<?php echo htmlentities($data['city']); ?>">
                                                <span id="Citydayerror" style="color: red;"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="input-title">Adresa e rruges</label>
                                            <input type="text" class="form-control" id="StreetAddress" name="streetAddress" placeholder="Adresa e rrugës" value="<?php echo htmlentities($data['street_address']); ?>">
                                            <span id="Streetaddresserror" style="color: red;"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="input-title">Numri i telefonit</label>
                                            <input class="form-control" id="phone-number" name="phone-number" value="<?php echo htmlentities($data['phone']) ?>">
                                            <span id="Pronenumbererror" style="color: red;"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="input-title" for="InfermierDepartament">
                                                Departamenti
                                            </label>
                                            <select name="Infermierdepartament" class="form-control">
                                                <option value="<?php echo htmlentities($data['depid']) ?>" selected><?php echo htmlentities($data['depname']) ?></option>
                                                <?php
                                                $depid = $data['depid'];
                                                $query3 = mysqli_query($con, "SELECT * FROM `departaments` where id!='$depid' and depstatus=1 ORDER BY depname");
                                                if (!$query3) {
                                                    die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                                                } else {
                                                    while ($data3 = mysqli_fetch_array($query3)) {
                                                ?>
                                                        <option value="<?php echo htmlentities($data3['id']) ?>"><?php echo htmlentities($data3['depname']) ?></option>

                                                <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="input-title">Emaili</label>
                                            <input type="email" readonly="readonly" class="form-control" name="infemail" placeholder="Emaili" value="<?php echo htmlentities($data['email']) ?>">
                                            <span id="Emailerror" style="color: red;"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="input-title">Username</label>
                                            <input type="text" class="form-control" name="infusername" placeholder="Username" value="<?php echo htmlentities($data['username']) ?>">
                                            <span id="Usernameerror" style="color: red;"></span>

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
$("#EditInfirmierForm").submit(function(e) {
        e.preventDefault();
        $('#Imageerror').html("");
        $('#Nameerror').html("");
        $('#Surnameerror').html("");
        $('#Birthdayerror').html("");
        $('#Gendererror').html("");
        $('#Statedayerror').html("");
        $('#Citydayerror').html("");
        $('#Streetaddresserror').html("");
        $('#Pronenumbererror').html("");
        $('#Usernameerror').html("");
        var myform = document.getElementById("EditInfirmierForm");
    var fd = new FormData(myform );
    $.ajax({
        url: "includes/update-infirmier.inc.php",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        method: 'POST'
    })
    .done(function(response) {
        $message="";
        switch(response) {
  case "1":
    $message="Kerkohen formatet: png, gif, jpeg, jpg. Si dhe madhesia e limituar.";
    $('#Imageerror').html($message);
    document.getElementById('Imageerror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
  case "2":
    $message="Emri duhet te permbaje vetem shkronja dhe nuk mund te jete i zbrazet!";
    $('#Nameerror').html($message);
    document.getElementById('Nameerror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
    case "3":
    $message="Mbiemri duhet te permbaje vetem shkronja dhe nuk mund te jete i zbrazet!";
    $('#Surnameerror').html($message);
    document.getElementById('Surnameerror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
    case "4":
    $message="Nuk duhet te jete i zbrazet!";
    $('#Birthdayerror').html($message);
    document.getElementById('Birthdayerror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
    case "5":
    $message="Zgjidhni njeren nga opsionet!";
    $('#Gendererror').html($message);
    document.getElementById('Gendererror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
    case "6":
    $message="Shenoni shtetin!";
    $('#Statedayerror').html($message);
    document.getElementById('Statedayerror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
    case "7":
    $message="Shenoni qytetin!";
    $('#Citydayerror').html($message);
    document.getElementById('Citydayerror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
    case "8":
    $message="Shenoni adresen!";
    $('#Streetaddresserror').html($message);
    document.getElementById('Streetaddresserror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
    case "9":
    $message="Shenoni numrin e telefonit!";
    $('#Pronenumbererror').html($message);
    document.getElementById('Pronenumbererror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
    case "15":
    $message="Username duhet te jete 5-20 karaktere, jo _ dhe . ne fillim apo ne fund!";
    $('#Usernameerror').html($message);
    document.getElementById('Usernameerror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
    case "16":
    $message="Ky username ekziston.";
    $('#Usernameerror').html($message);
    document.getElementById('Usernameerror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
  default: alert("Te dhenat u ndryshuan me sukses.");
  window.location.href=response;
}
        });
        return false;
    });

</script>