<?php
session_start();
error_reporting(0);
include('config.php');
$patient = null;
if (isset($_GET['view'])) {
    $patient = $_GET['id'];
}
$query = mysqli_query($con, "SELECT patients.id from patients WHERE patients.status=1 and patients.id='$patient' UNION SELECT patients.id FROM patients WHERE patients.id='$patient' and patients.id IN( SELECT deaths.patientId FROM deaths)");
if (!$query) {
    die(mysqli_error($con) . $query);
} else {
    $data = mysqli_fetch_array($query);
    if ($data > 0) {
?>
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-12">
                    <div class="card">
                        <div class="form-group">
                            <label class="input-title" for="PatientDiagnose">
                                Shto nje diagnoze:
                            </label>
                            <div style="margin-bottom: 10px;">
                                <button type="button" id="NewDiagnose" class="left-marg  btn btn-primary"><span style="font-size: 15px;">&#43;</span> Shto</button>
                            </div>
                            <div id="New-diagnose">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="input-title" for="Patientalert">
                                Shto nje paralajmerim:
                            </label>
                            <div style="margin-bottom: 10px;">
                                <button type="button" id="Newalert" class="left-marg  btn btn-primary">
                                    <span style="font-size: 15px;">&#43;</span> Shto</button>
                            </div>
                            <div id="New-alert">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="input-title" for="Patientmedicament">
                                Shto nje medikament:
                            </label>
                            <div style="margin-bottom: 10px;">
                                <button type="button" id="NewMedicament" class="left-marg  btn btn-primary"><span style="font-size: 15px;">&#43;</span> Shto</button>
                            </div>
                            <div id="New-medicament">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="input-title" for="Patientappointment">
                                Cakto nje termin:
                            </label>
                            <div style="margin-bottom: 10px;">
                                <button type="button" id="NewAppointment" class="left-marg  btn btn-primary"><span style="font-size: 15px;">&#43;</span> Cakto</button>
                            </div>
                            <div id="New-appointment">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php

    } else {
        echo "Te dhena te panjohura.";
    }
}
?>
<script>
    $(document).ready(function() {
        $("#NewDiagnose").click(function() {
            $("#New-diagnose").load('includes/new-diagnose.php?id=<?php echo $patient ?>&diagnose=patient');
            $("#New-alert").html("");
            $("#New-medicament").html("");
            $("#New-appointment").html("");
        });
        $("#Newalert").click(function() {
            $("#New-alert").load('includes/new-alert.php?id=<?php echo $patient ?>&alert=patient');
            $("#New-diagnose").html("");
            $("#New-medicament").html("");
            $("#New-appointment").html("");
        });
        $("#NewMedicament").click(function() {
            $("#New-medicament").load('includes/new-medicament.php?id=<?php echo $patient ?>&medicament=patient');
            $("#New-alert").html("");
            $("#New-diagnose").html("");
            $("#New-appointment").html("");
        });
        $("#NewAppointment").click(function() {
            $("#New-appointment").load('includes/new-appointment.php?id=<?php echo $patient ?>&appointment=patient');
            $("#New-alert").html("");
            $("#New-diagnose").html("");
            $("#New-medicament").html("");
        });
    });
</script>