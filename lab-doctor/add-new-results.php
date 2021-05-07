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
    <script>
        $(document).ready(function() {
            $('#widget li').on('click', function() {
                $(this).removeClass('new-ntf');
            });
        });
    </script>
    <style>
        /*the container must be positioned relative:*/
        .autocomplete {
            position: relative;
            display: inline-block;
        }

        input {
            border: 1px solid transparent;
            background-color: #f1f1f1;
            padding: 10px;
            font-size: 16px;
        }

        input[type=text] {
            background-color: #f1f1f1;
            width: 100%;
        }

        input[type=submit] {
            background-color: DodgerBlue;
            color: #fff;
            cursor: pointer;
        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }

        /*when hovering an item:*/
        .autocomplete-items div:hover {
            background-color: #e9e9e9;
        }

        /*when navigating through the items using the arrow keys:*/
        .autocomplete-active {
            background-color: DodgerBlue !important;
            color: #ffffff;
        }
    </style>
    </style>
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
                <p>Doktor | Rezultate të reja</p>
            </div>
            <div class="container-fullw">
                <?php
                $query = mysqli_query($con, "SELECT * FROM `pricing_list` WHERE description='Analyse' and status='1'");
                if (!$query) {
                    die(mysqli_error($con) . $query);
                } else {
                    $data = mysqli_fetch_array($query);
                    if ($data > 0) {
                ?>
                        <div class="panel-body">
                            <div class="panel-heading">
                                <h5 class="panel-title">Shto nje rezultat te analizave</h5>
                            </div>
                            <div class="panel-form">
                                <form method="POST" id="AddAnalyseFrom" enctype="multipart/form-data" autocomplete="off">
                                    <div class="form-group">
                                        <div class="input-group my-3">
                                            <input type="text" class="form-control" disabled placeholder="Ngarkoni analizen" id="file">
                                            <div class="input-group-append">
                                                <button type="button" class="browse btn btn-primary">Ngarkoni...</button>
                                            </div>
                                        </div>
                                        <span id="Fileerror" style="color: red;"></span>
                                        <input type="file" id="file2" name="file2" class="file" accept=".doc,.docx,.pdf,.xlsx,.jpg, .jpeg, .png">
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title" for="analyse">
                                            Zgjedh analizen:
                                        </label>
                                        <select name="analyze" class="form-control doctorposition" required="true">
                                            <option value="0" selected value="">Zgjidh llojin e analizes</option>
                                            <?php
                                            $query2 = mysqli_query($con, "SELECT * FROM `pricing_list` WHERE description='Analyse' and status='1'");
                                            if (!$query2) {
                                                die(mysqli_error($con) . $query2);
                                            } else {
                                                while ($data2 = mysqli_fetch_array($query2)) {
                                            ?>
                                                    <option value="<?php echo htmlentities($data2['id']) ?>"><?php echo htmlentities($data2['name']) ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <span id="Analyseerror" style="color: red;"></span>
                                    </div>
                                    <div class="div-inlineflex">
                                        <div class="form-group autocomplete">
                                            <label class="input-title">Id e pacientit</label>
                                            <input type="text" id="myInput" name="idPatient" class="form-control" placeholder="Sheno id e pacientit">
                                            <span id="Patienterror" style="color: red;"></span>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="form-group" style="margin-top: 10px;">
                                        <button type="submit" class="btn btn-primary">Regjistro</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                <?php

                    } else {
                        echo "Per momentin nuk egziston asnje analize. Kontaktoni administratorin e sistemit.";
                    }
                }
                ?>

            </div>
        </div>
    </div>
</body>

</html>
<script>
    function autocomplete(inp, arr) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) {
                return false;
            }
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function(e) {
                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.getElementsByTagName("input")[0].value;
                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                }
            }
        });

        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }

        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }

        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function(e) {
            closeAllLists(e.target);
        });
    }

    <?php
    $php_array = array();
    $query5 = mysqli_query($con, "SELECT patients.id, patients.name, patients.surname, patients.patientID FROM patients WHERE patients.status='1'");
    if (!$query5) {
        die(mysqli_error($con) . $query5);
    } else {
        while ($data5 = mysqli_fetch_array($query5)) {
            $php_array[] = $data5['patientID'] . "-".$data5['id'] . "-" . $data5['name'] . "-" . $data5['surname'];
        }
    }
    ?>
    var js_array = [<?php echo '"' . implode('","', $php_array) . '"' ?>];
    autocomplete(document.getElementById("myInput"), js_array);
</script>

<script>
    $("#AddAnalyseFrom").submit(function(e) {
        e.preventDefault();
        $('#Fileerror').html("");
        $('#Analyseerror').html("");
        $('#Patienterror').html("");
        var myform = document.getElementById("AddAnalyseFrom");
        var fd = new FormData(myform);
        $.ajax({
                url: "includes/add-analyse.inc.php",
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
                    case "104":
                        $message = "Zgjidh ndonjeren nga analizat.";
                        $('#Analyseerror').html($message);
                        document.getElementById('Analyseerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                        case "105":
                        $message = "Sheno ID e pacientit dhe zgjedh ndonjeren nga opsionet e meposhtme.";
                        $('#Patienterror').html($message);
                        document.getElementById('Patienterror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                        case "106":
                        $message = "Ky pacient nuk egziston.";
                        $('#Patienterror').html($message);
                        document.getElementById('Patienterror').scrollIntoView({
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