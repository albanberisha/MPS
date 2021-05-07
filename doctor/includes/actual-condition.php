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


        $query2 = mysqli_query($con, "SELECT patientId,id from beds WHERE bedstatus='1' and patientId='$patient'");
        if (!$query2) {
            die(mysqli_error($con) . $query2);
        } else {
            $data = mysqli_fetch_array($query2);
            if ($data > 0) {
                $bedid=$data['id'];
                $query3=mysqli_query($con,"SELECT actual_condition.bedId,actual_condition.userInCharge,actual_condition.date,actual_condition.time,actual_condition.heart_rate,actual_condition.blood_pressure,actual_condition.respiratory_rate,actual_condition.temperature,.actual_condition.oxygen_amount,actual_condition.weight,users.name,users.surname from actual_condition,users WHERE bedId='$bedid' and actual_condition.userInCharge=users.id ");
                if (!$query3) {
                    die(mysqli_error($con) . $query3);
                } else {
                    $data3 = mysqli_fetch_array($query3);
                    if ($data3 > 0) {
                        ?>
                <div class="main-body">
                    <div class="col-md-12" style="margin-bottom: 10px;">
                        <div class="card">
                            <button type="button" class="actualcond active1">Shenjat Vitale</button>
                            <div class="content1" style="display: block;">
                                <div class="panel-body">
                                    <div class="form-group vital-signs">
                                        <label class="input-title">Rrahjet e zemres:
                                            <input type="number" readonly="readonly" id="HartRate" class="form-control1 vitalsigns" value="<?php echo htmlentities($data3['heart_rate']) ?>"></label>
                                    </div>
                                    <div class="form-group vital-signs">
                                        <label class="input-title">Presioni i gjakut:
                                            <input type="number" readonly="readonly" id="Bloodpressure" class="form-control1 vitalsigns" style="min-width:120px" value="<?php echo htmlentities($data3['blood_pressure']) ?>"></label>
                                    </div>
                                    <div class="form-group vital-signs">
                                        <label class="input-title">Frekuenca e frymëmarrjes:
                                            <input type="number" readonly="readonly" id="Respiratoryrate" class="form-control1 vitalsigns" value="<?php echo htmlentities($data3['respiratory_rate']) ?>"></label>
                                    </div>
                                    <div class="form-group vital-signs">
                                        <label class="input-title">Temperatura:
                                            <input type="number" readonly="readonly" id="Temperature" class="form-control1 vitalsigns" value="<?php echo htmlentities($data3['temperature']) ?>"></label>
                                    </div>
                                    <div class="form-group vital-signs">
                                        <label class="input-title">Sasia e oksigjenit:
                                            <input type="number" readonly="readonly" id="OxygenSuration" class="form-control1 vitalsigns" value="<?php echo htmlentities($data3['oxygen_amount']) ?>"></label>
                                    </div>
                                    <div class="form-group vital-signs">
                                        <label class="input-title">Pesha:
                                            <input type="number" readonly="readonly" id="Weight" class="form-control1 vitalsigns" value="<?php echo htmlentities($data3['weight']) ?>"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <button type="button" class="actualcond active1">Personi pergjegjes per futjen e te dhenave</button>
                            <div class="content1" style="display: block;">
                                <div class="panel-body">
                                    <div class="div-inlineflex">
                                        <div class="form-group">
                                            <label class="input-title">Emri</label>
                                            <input type="text" id="nameInfo" readonly="readonly" value="<?php echo htmlentities($data3['name']) ?>" class="form-control" placeholder="Sheno emrin">
                                        </div>
                                        <div class="form-group">
                                            <label class="input-title">Mbiemri</label>
                                            <input type="text" id="surnameInfo" readonly="readonly" value="<?php echo htmlentities($data3['surname']) ?>" class="form-control" placeholder="Sheno mbiemrin">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="input-title">Data</label>
                                        <input type="date" readonly="readonly" class="form-control" id="Infostart-date" name="infotart_date" value="<?php echo htmlentities($data3['date']) ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Data</label>
                                        <input type="time" readonly="readonly" class="form-control" id="Infostart-time" name="time" value="<?php echo htmlentities($data3['time']) ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php
                    }else {
                        echo "Pacienti nuk ka regjistrim te gjendjes.";
                    }
                }
            } else {
                echo "Pacienti nuk eshte aktiv.";
            }
        }
    } else {
        echo "Te dhena te panjohura.";
    }
}
?>


<style>
    .actualcond {
        background-color: rgb(165, 165, 165);
        color: white;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: 2px solid rgb(59, 59, 59);
        border-radius: 0.2em;
        text-align: left;
        outline: none;
        font-size: 15px;
    }

    .active1,
    .actualcond:hover {
        background-color: rgb(92, 92, 92);
    }

    .content1 {
        padding: 0 18px;
        display: block;
        overflow: hidden;
        background-color: #f1f1f1;
    }
</style>

<script>
    var coll = document.getElementsByClassName("actualcond");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active1");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }
</script>