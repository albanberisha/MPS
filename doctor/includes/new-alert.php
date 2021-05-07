<?php
session_start();
error_reporting(0);
include('config.php');
$patient = null;
if (isset($_GET['alert'])) {
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
<span id="Alertsuccess" style="color: green;"></span>
    <div class="form-group">
    <form method="POST" id="NewAlertFrom" enctype="multipart/form-data">
            <div class="form-group">
                <label class="input-title" for="NewAction">
                    Shenoni emrin e paralajmerimit
                </label>
                <input type="text" id="New-action" name="new-alert" class="form-control" placeholder="Sheno emrin e paralajmerimit">
            </div>
            <span id="Alerterror" style="color: red;"></span>
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
    $("#NewAlertFrom").submit(function(e) {
        var patientid='<?php echo $patient ?>';
        e.preventDefault();
        $('#Alerterror').html("");
        var myform = document.getElementById("NewAlertFrom");
        var fd = new FormData(myform);
        fd.append('patientid',patientid);
        $.ajax({
                url: "includes/add-alert.inc.php",
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                method: 'POST'
            })
            .done(function(response) {
                $message = "";
                switch (response) {
                    case "110":
                        $message = "Format i gabuar. Paralajmerimi nuk mund te jete e zbrazet!";
                        $('#Alerterror').html($message);
                        document.getElementById('Alerterror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "111":
                        $message = "Format i gabuar.";
                        $('#Alerterror').html($message);
                        document.getElementById('Alerterror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                        case "112":
                        $message = "Ky paralajmerim egziston.";
                        $('#Alerterror').html($message);
                        document.getElementById('Alerterror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    default:
                        alert("Paralajmerimi u shtua me sukses");
                        $('#Alertsuccess').html(response);
                }
            });
        return false;
    });
</script>