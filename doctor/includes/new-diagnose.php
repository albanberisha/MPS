<?php
session_start();
error_reporting(0);
include('config.php');
$patient = null;
if (isset($_GET['diagnose'])) {
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
        <span id="Diagnosesuccess" style="color: green;"></span>
            <div class="form-group" id="Diagnose">
          
                <form method="POST" id="NewDiagnoseFrom" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="input-title" for="DepRoom">
                            Shenoni emrin e diagnozes
                        </label>
                        <input type="text" id="New-diagnose" name="new-diagnose" class="form-control" placeholder="Sheno emrin e diagnozes">
                    </div>
                    <span id="Diagnoseerror" style="color: red;"></span>
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
    $("#NewDiagnoseFrom").submit(function(e) {
        var patientid='<?php echo $patient ?>';
        e.preventDefault();
        $('#Diagnoseerror').html("");
        var myform = document.getElementById("NewDiagnoseFrom");
        var fd = new FormData(myform);
        fd.append('patientid',patientid);
        $.ajax({
                url: "includes/add-diagnose.inc.php",
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
                        $message = "Format i gabuar. Diagnoza nuk mund te jete e zbrazet!";
                        $('#Diagnoseerror').html($message);
                        document.getElementById('Diagnoseerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "111":
                        $message = "Format i gabuar.";
                        $('#Diagnoseerror').html($message);
                        document.getElementById('Diagnoseerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                        case "112":
                        $message = "Kjo diagnoze egziston dhe eshte aktive.";
                        $('#Diagnoseerror').html($message);
                        document.getElementById('Diagnoseerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    default:
                        alert("Diagnoza u shtua me sukses");
                        $('#Diagnosesuccess').html(response);
                }
            });
        return false;
    });
</script>