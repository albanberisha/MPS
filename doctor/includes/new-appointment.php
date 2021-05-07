<?php
session_start();
error_reporting(0);
include('config.php');
$patient = null;
if (isset($_GET['appointment'])) {
    $patient = $_GET['id'];
}
$query = mysqli_query($con, "SELECT patients.id from patients WHERE patients.status=1 and patients.id='$patient' UNION SELECT patients.id FROM patients WHERE patients.id='$patient' and patients.id IN( SELECT deaths.patientId FROM deaths)");
if (!$query) {
    die(mysqli_error($con) . $query);
} else {
    $data = mysqli_fetch_array($query);
    if ($data > 0) {
?>
        <div class="card">
        <span id="Appointmentsuccess" style="color: green;"></span>
            <div class="form-group">
                <form method="POST" id="AddApointmentFrom" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="input-title" for="NewAction">
                            Shenoni daten e temrinit:
                        </label>
                        <input type="date" class="form-control" id="ApointmentDate" name="apointmentDate" />
                        <span id="ApointmentDateerror" style="color: red;"></span>
                    </div>
                    <div class="form-group">
                        <p id="textm" style="display: block;">
                            <label for="patientTime" class="input-title" style="margin-top: 7px;">Ora e filimit te terminit:</label>
                            <input type="time" class="form-control" id="ApointmentStartTime" name="apointmentStartTime">
                            <span id="ApointmentStartTimeerror" style="color: red;"></span>
                        </p>
                    </div>
                    <div class="form-group">
                        <p id="textm" style="display: block;">
                            <label for="patientTime" class="input-title" style="margin-top: 7px;">Ora e mbarimit te terminit:</label>
                            <input type="time" class="form-control" id="ApointmentEndTime" name="apointmentEndTime">
                            <span id="ApointmentEndTimeerror" style="color: red;"></span>
                        </p>
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
    $("#AddApointmentFrom").submit(function(e) {
        e.preventDefault();
        var patientid='<?php echo $patient ?>';
        $('#ApointmentDateerror').html("");
        $('#ApointmentStartTimeerror').html("");
        $('#ApointmentEndTimeerror').html("");
        var myform = document.getElementById("AddApointmentFrom");
        var fd = new FormData(myform);
        fd.append('patientid',patientid);
        $.ajax({
                url: "includes/create-appointments.inc.php",
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                method: 'POST'
            })
            .done(function(response) {
                $message = "";
                error=response.substring(0,2);
                switch (error) {
                    case "11":
                        $message = "Data nuk mund te jete e zbrazet!";
                        $('#ApointmentDateerror').html($message);
                        document.getElementById('ApointmentDateerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "12":
                        $message = "Kjo date ka kaluar!";
                        $('#ApointmentDateerror').html($message);
                        document.getElementById('ApointmentDateerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "13":
                        $message = "Ora nuk mund te jete e zbrazet!";
                        $('#ApointmentStartTimeerror').html($message);
                        document.getElementById('ApointmentStartTimeerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "14":
                        $message = "Ora ka kaluar!";
                        $('#ApointmentStartTimeerror').html($message);
                        document.getElementById('ApointmentStartTimeerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "15":
                        $message = "Tashme egziston nje temrmin ne kete ore!<br> Termini me i afert i mundshem lidhur me oren e dhene eshte: "+response.substring(2,response.length);
                        $('#ApointmentStartTimeerror').html($message);
                        document.getElementById('ApointmentStartTimeerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                        case "16":
                        $message = "Ora nuk mund te jete e zbrazet!";
                        $('#ApointmentEndTimeerror').html($message);
                        document.getElementById('ApointmentEndTimeerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "17":
                        $message = "Shtypni oren me te madhe se ora e terminit!";
                        $('#ApointmentEndTimeerror').html($message);
                        document.getElementById('ApointmentEndTimeerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "18":
                        $message = "Tashme egziston nje temrmin ne kete ore!<br> Maksimumi sa mund te zgjat termini eshte deri ne oren: "+response.substring(2,response.length);
                        $('#ApointmentEndTimeerror').html($message);
                        document.getElementById('ApointmentEndTimeerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    default:
                    alert(response);
                        $('#Appointmentsuccess').html(response);
                }
            });
        return false;
    });
</script>