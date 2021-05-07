
<?php
session_start();
error_reporting(0);
include('config.php');
$patient = null;
if (isset($_GET['medicament'])) {
    $patient = $_GET['id'];
}
$query = mysqli_query($con, "SELECT patients.id from patients WHERE patients.status=1 and patients.id='$patient' UNION SELECT patients.id FROM patients WHERE patients.id='$patient' and patients.id IN( SELECT deaths.patientId FROM deaths)");
if (!$query) {
    die(mysqli_error($con) . $query);
} else {
    $data = mysqli_fetch_array($query);
    if ($data > 0) {
?>
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
<div class="card">
<span id="Medsuccess" style="color: green;"></span>
    <div class="form-group">
    <form method="POST" id="NewMedicamentFrom" autocomplete="off" enctype="multipart/form-data">
            <div class="form-group">
                <label class="input-title" for="NewMedicamentName">
                    Shenoni emrin e medikamentit
                </label>

                <input type="text" id="myInput" class="form-control" name="medname" placeholder="Sheno emrin e medikamentit">
                <span id="Nameerror" style="color: red;"></span>
            </div>
            <div style="margin-top: -15px; padding-bottom:10px; padding-left:10px">
                <span  style="display: inline-block;font-weight: bold;font-size: 13px;color: rgb(99, 99, 99);display: inline-block;">*Medikamentet qe nuk selektohen nga lista renese nuk jane ne stock.</span>
                </div>
           <div class="form-group" hidden>
                <input type="text" id="MedId" value="0" name="medID" class="form-control">
        
                <span id="Nameerror" style="color: red;"></span>
            </div>
            <div class="form-group">
                <label class="input-title" for="NewMedicamentUsage">
                    Shenoni perdorimin
                </label>
                <input type="text" id="Newmedicamentusage" name="newmedicamentusage" class="form-control" placeholder="Sheno perdorimin">
                <span id="MedUsagenerror" style="color: red;"></span>
            </div>
            <div class="form-group">
                <label class="input-title">Perdorim nga data:</label>
                <input type="date" class="form-control" id="UsageStartDay" name="usageStartDay">
                <span id="StartUsagenerror" style="color: red;"></span>
            </div>
            <div class="form-group">
                <label class="input-title">Perdorim deri me daten:</label>
                <input type="date" class="form-control" id="UsageEndDay" name="usageEndDay">
                <span id="EndUsagenerror" style="color: red;"></span>
            </div>
            <div class="form-group">
                <label class="input-title">Sasia e perdorimit ne dite (ne cope):</label>
                <input type="number" class="form-control" min="1" id="QuantityPerDay" name="quantityPerDay" placeholder="p.sh. 3">
                <span id="Quantityerror" style="color: red;"></span>
            </div>
            <div class="form-group" style="margin-top: 10px;">
                <button type="submit" class="btn btn-primary">Shto</button>
            </div>
        </form>
    </div>
</div>
<?php
    } else {
        echo "Te dhena te panjohura.";
    }
}
?>

<script>
    $("#NewMedicamentFrom").submit(function(e) {
        var patientid='<?php echo $patient ?>';
        e.preventDefault();
        $('#Nameerror').html("");
        $('#MedUsagenerror').html("");
        $('#StartUsagenerror').html("");
        $('#EndUsagenerror').html("");
        $('#Quantityerror').html("");


        var myform = document.getElementById("NewMedicamentFrom");
        var fd = new FormData(myform);
        fd.append('patientid',patientid);
        $.ajax({
                url: "includes/add-medicament.inc.php",
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                method: 'POST'
            })
            .done(function(response) {
                $message = "";
                switch (response) {
                    case "120":
                        $message = "Format i gabuar. Emri nuk mund te jete i zbrazet.";
                        $('#Nameerror').html($message);
                        document.getElementById('Nameerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                        case "121":
                        $message = "Format i gabuar. Perdorimi nuk mund te jete i zbrazet.";
                        $('#MedUsagenerror').html($message);
                        document.getElementById('MedUsagenerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                        case "122":
                        $message = "Dita nuk mund te jete e zbrazet.";
                        $('#StartUsagenerror').html($message);
                        document.getElementById('StartUsagenerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                        case "123":
                        $message = "Kjo date ka kaluar.";
                        $('#StartUsagenerror').html($message);
                        document.getElementById('StartUsagenerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                        case "124":
                        $message = "Data nuk mund te jete me e vogel se data e fillimit.";
                        $('#EndUsagenerror').html($message);
                        document.getElementById('EndUsagenerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                        case "125":
                        $message = "Sasia nuk mund te jete e zbrazet.";
                        $('#Quantityerror').html($message);
                        document.getElementById('Quantityerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    default:
                        alert("Medikamenti u shtua me sukses");
                        $('#Medsuccess').html(response);
                }
            });
        return false;
    });
</script>

<script>
    function autocomplete(inp, arr,arr2) {
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
    $php_array2 = array();
    $query5 = mysqli_query($con, "SELECT id,name from medicaments WHERE status='1' GROUP BY name");
    if (!$query5) {
        die(mysqli_error($con) . $query5);
    } else {
        while ($data5 = mysqli_fetch_array($query5)) {
            $php_array[] =$data5['name'];
            $php_array2[] =$data5['id'];
        }
    }
    ?>
    var js_array = [<?php echo '"' . implode('","', $php_array) . '"' ?>];
    var js_array2 = [<?php echo '"' . implode('","', $php_array2) . '"' ?>];
    autocomplete(document.getElementById("myInput"), js_array,js_array2);
</script>
