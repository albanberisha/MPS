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
                        <button type="button" id="Newalert" class="left-marg  btn btn-primary"><span style="font-size: 15px;">&#43;</span> Shto</button>
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

<script>
    $(document).ready(function() {
        $("#NewDiagnose").click(function() {
            $("#New-diagnose").load('includes/new-diagnose.php');
        });
        $("#Newalert").click(function() {
            $("#New-alert").load('includes/new-alert.php');
        });
        $("#NewMedicament").click(function() {
            $("#New-medicament").load('includes/new-medicament.php');
        });
        $("#NewAppointment").click(function() {
            $("#New-appointment").load('includes/new-appointment.php');
        });
    });
</script>