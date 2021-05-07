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
                        <div style="padding-bottom: 0;">
                            <h6 class="panel-title panel-white text-center col-header">Rezultatet nga laboratori</h6>
                        </div>
                        <div class="card-body card-top">
                        <p id="Deletesucces" style="color:green;"></p>
                        <p id="Deleteerror" style="color:red;"></p>
                            <table class="data-list min-height dignosis color-none">
                                <tbody id="Diagnosis2">
                                    <tr>
                                        <th class="panel-title date1">
                                            Nr.
                                        </th>
                                        <th class="panel-title title4 ">
                                            Diagnoza
                                        </th>
                                        <th class="panel-title title4 ">
                                            Doktori
                                        </th>
                                        <th class="panel-title title4 ">
                                            Data
                                        </th>
                                        <th class="panel-title title4 ">
                                            Statusi
                                        </th>
                                        <th class="panel-title title4 ">
                                            Data e perfundimit:
                                        </th>
                                    </tr>
                                    <?php
                                    $query4 = mysqli_query($con, "SELECT diagnosis.id,diagnosis.description,users.id as userid,users.name as username, users.surname as usersurname,diagnosis.diagnosedate, diagnosis.enddiagnoseDate from diagnosis,users where diagnosis.userInCharge=users.id and diagnosis.status='1' and diagnosis.patientId='$patient' ORDER BY diagnosis.diagnosedate DESC");
                                    if (!$query4) {
                                        die(mysqli_error($con) . $query4);
                                    } else {
                                        $count = 1;
                                        $message = "Asnje per tu shfaqur.";
                                        while ($data4 = mysqli_fetch_array($query4)) {
                                            $message = "";
                                    ?>
                                            <tr>
                                                <td class=" did">
                                                    <?php echo $count ?>
                                                </td>
                                                <td class="title4">
                                                    <?php echo htmlentities($data4['description']) ?>
                                                </td>
                                                <td class="title4">
                                                    <?php echo htmlentities($data4['username']) ?> <?php echo htmlentities($data4['usersurname']) ?>
                                                </td>
                                                <td class="title4">
                                                    <?php echo htmlentities($data4['diagnosedate']) ?>
                                                </td>

                                                <?php
                                                $diagnoseEndDate = $data4['enddiagnoseDate'];
                                                if ($diagnoseEndDate == NULL) {
                                                ?>
                                                    <td class="title4">
                                                        Vazhdon
                                                    </td>
                                                    <td class="title4">
                                                        <button type="submit" onclick="finishDiagnose(<?php echo $data4['id'] ?>);" class="btn btn-primary">Perfundo</button>
                                                    </td>
                                                <?php
                                                } else {
                                                ?>
                                                    <td class="title4">
                                                        Perfunduar
                                                    </td>
                                                    <td class="title4">
                                                        <?php
                                                        echo $diagnoseEndDate;
                                                        ?>
                                                    </td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                        <?php
                                            $count++;
                                        }
                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                echo $message;
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }

                                    ?>

                                </tbody>
                            </table>
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
 function finishDiagnose($id) {
    patientid=<?php echo $patient ?>;
            $confirm = confirm('A jeni te sigurte qe deshironi ta perfundoni diagnosen?');
        if($confirm)
        {
            table = 'diagnosis';
            $.ajax({
                    method: "POST",
                    url: "includes/delete.inc.php",
                    data: {
                        id: $id,
                        table: table,
                        patient:patientid
                    }
                })
                .done(function(response) {
                    if (response == "error") {
                        $('#Deleteerror').html("Perfundimi nuk lejohet!");
                        $('#Deletesucces').html("");
                    } else {
                        $('#Deletesucces').html("Diagnosa u perfundua.");
                        $('#Deleteerror').html("");
                        $("#Diagnosis2").html(response);
                    }
                });
            return false;
        }else{
            $('#Deleteerror').html("Operacioni u anulua.");
            $('#Deletesucces').html("");
        }            
        }

</script>