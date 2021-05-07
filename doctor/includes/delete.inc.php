<?php
include('config.php');
session_start();
error_reporting(0);
$myid = $_SESSION['id'];
$userid = $_POST['id'];
$table = $_POST['table'];

if (strcmp($table, "appointments") == 0) {
    $appointmentid = $userid;
    finishappointment2($con, $appointmentid, $myid);
} elseif (strcmp($table, "appointments-reject") == 0) {
    $appointmentid = $userid;
    rejectappointment2($con, $appointmentid, $myid);
}elseif (strcmp($table, "diagnosis") == 0) {
    $diagnosetid = $userid;
    finishdiagnose($con, $diagnosetid);
}  else {
    echo "error";
}
function  finishdiagnose($con, $diagnosetid)
{
    $patient=$_POST['patient'];
    $today=date(" Y-m-d");//
    $query=mysqli_query($con,"UPDATE diagnosis SET enddiagnoseDate='$today' WHERE id='$diagnosetid'");
    if(!$query)
    {
        die(mysqli_error($con) . $query);
    }else{
        ?>
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
        <?php
    }
}
function finishappointment2($con, $appointmentid, $myid)
{
    $query = mysqli_query($con, "UPDATE appointments SET status='finished' WHERE id='$appointmentid'");
    if (!$query) {
        die(mysqli_error($con) . $query);
    } else {
?>
        <tr>
            <th class="panel-title  date3">
                Data:
            </th>
            <th class="panel-title date3">
                Ora:
            </th>
            <th class="panel-title title4 ">
                Doktori:
            </th>
            <th class="panel-title title4 ">
                Pacienti:
            </th>
            <th class="panel-title title4 ">
                ID:
            </th>
            <th class="panel-title title4 ">
                Statusi:
            </th>
        </tr>
        <?php
        $querypast = mysqli_query($con, "SELECT appointments.id,appointments.date,appointments.starttime,appointments.endtime,appointments.doctorId as docid, users.name,users.surname,patients.id as patid, patients.patientID,patients.name as patname, patients.surname as patsurname, appointments.status from appointments,users,patients WHERE appointments.patientId=patients.id and appointments.doctorId=users.id and appointments.doctorId='$myid' and appointments.date<CURDATE() and (appointments.status='approved' OR appointments.status='finished') ORDER BY date ASC, starttime ASC LIMIT 50");
        $querytoday = mysqli_query($con, "SELECT appointments.id,appointments.date,appointments.starttime,appointments.endtime,appointments.doctorId as docid, users.name,users.surname,patients.id as patid, patients.patientID,patients.name as patname, patients.surname as patsurname, appointments.status from appointments,users,patients WHERE appointments.patientId=patients.id and appointments.doctorId=users.id and appointments.doctorId='$myid' and appointments.date=CURDATE() and appointments.status='approved' ORDER BY date ASC, starttime ASC");
        $querytodayfinished = mysqli_query($con, "SELECT appointments.id,appointments.date,appointments.starttime,appointments.endtime,appointments.doctorId as docid, users.name,users.surname,patients.id as patid, patients.patientID,patients.name as patname, patients.surname as patsurname, appointments.status from appointments,users,patients WHERE appointments.patientId=patients.id and appointments.doctorId=users.id and appointments.doctorId='$myid' and appointments.date=CURDATE() and appointments.status='finished' ORDER BY date ASC, starttime ASC");
        $querycomming = mysqli_query($con, "SELECT appointments.id,appointments.date,appointments.starttime,appointments.endtime,appointments.doctorId as docid, users.name,users.surname,patients.id as patid, patients.patientID,patients.name as patname, patients.surname as patsurname, appointments.status from appointments,users,patients WHERE appointments.patientId=patients.id and appointments.doctorId=users.id and appointments.doctorId='$myid' and appointments.date>CURDATE() and appointments.status='approved' ORDER BY date ASC, starttime ASC LIMIT 25");
        if (!$querytoday) {
            die(mysqli_error($con) . $querytoday);
        } else {
            while ($datatoday = mysqli_fetch_array($querytoday)) {
        ?>
                <tr>
                    <td class=" date3">
                        <?php echo htmlentities($datatoday['date']) ?>
                    </td>
                    <td class=" date3">
                        <?php echo htmlentities($datatoday['starttime']) ?>-<?php echo htmlentities($datatoday['endtime']) ?>
                    </td>
                    <td class="title4">
                        <?php echo htmlentities($datatoday['name']) ?> <?php echo htmlentities($datatoday['surname']) ?>
                    </td>
                    <td class="title4">
                        <?php echo htmlentities($datatoday['patname']) ?> <?php echo htmlentities($datatoday['patsurname']) ?>
                    </td>
                    <td class="title4">
                        <?php echo htmlentities($datatoday['patientID']) ?>
                    </td>
                    <td class="title4">
                        <button type="button" onclick="finishAppointment(<?php echo $datatoday['id'] ?>);" class="btn btn-success" style="font-size: 10px;">Perfundo</button>
                    </td>
                </tr>

            <?php
            }
        }
        if (!$querytodayfinished) {
            die(mysqli_error($con) . $querytodayfinished);
        } else {
            while ($datatodayfinished = mysqli_fetch_array($querytodayfinished)) {
            ?>
                <tr>
                    <td class=" date3">
                        <?php echo htmlentities($datatodayfinished['date']) ?>
                    </td>
                    <td class=" date3">
                        <?php echo htmlentities($datatodayfinished['starttime']) ?>-<?php echo htmlentities($datatodayfinished['endtime']) ?>
                    </td>
                    <td class="title4">
                        <?php echo htmlentities($datatodayfinished['name']) ?> <?php echo htmlentities($datatodayfinished['surname']) ?>
                    </td>
                    <td class="title4">
                        <?php echo htmlentities($datatodayfinished['patname']) ?> <?php echo htmlentities($datatodayfinished['patsurname']) ?>
                    </td>
                    <td class="title4">
                        <?php echo htmlentities($datatodayfinished['patientID']) ?>
                    </td>
                    <td class="title4">
                        Perfunduar
                    </td>
                </tr>

            <?php
            }
        }
        if (!$querycomming) {
            die(mysqli_error($con) . $querycomming);
        } else {
            while ($datecomming = mysqli_fetch_array($querycomming)) {
            ?>
                <tr>
                    <td class=" date3">
                        <?php echo htmlentities($datecomming['date']) ?>
                    </td>
                    <td class=" date3">
                        <?php echo htmlentities($datecomming['starttime']) ?>-<?php echo htmlentities($datecomming['endtime']) ?>
                    </td>
                    <td class="title4">
                        <?php echo htmlentities($datecomming['name']) ?> <?php echo htmlentities($datecomming['surname']) ?>
                    </td>
                    <td class="title4">
                        <?php echo htmlentities($datecomming['patname']) ?> <?php echo htmlentities($datecomming['patsurname']) ?>
                    </td>
                    <td class="title4">
                        <?php echo htmlentities($datecomming['patientID']) ?>
                    </td>
                    <td class="title4">
                        Aprovuar
                    </td>
                </tr>

            <?php
            }
        }
        if (!$querypast) {
            die(mysqli_error($con) . $querypast);
        } else {
            while ($datepast = mysqli_fetch_array($querypast)) {
            ?>
                <tr>
                    <td class=" date3">
                        <?php echo htmlentities($datepast['date']) ?>
                    </td>
                    <td class=" date3">
                        <?php echo htmlentities($datepast['starttime']) ?>-<?php echo htmlentities($datepast['endtime']) ?>
                    </td>
                    <td class="title4">
                        <?php echo htmlentities($datepast['name']) ?> <?php echo htmlentities($datepast['surname']) ?>
                    </td>
                    <td class="title4">
                        <?php echo htmlentities($datepast['patname']) ?> <?php echo htmlentities($datepast['patsurname']) ?>
                    </td>
                    <td class="title4">
                        <?php echo htmlentities($datepast['patientID']) ?>
                    </td>
                    <td class="title4">
                        Perfunduar
                    </td>
                </tr>
        <?php
            }
        }
    }
}

function rejectappointment2($con, $appointmentid, $myid)
{
    $query = mysqli_query($con, "UPDATE appointments SET status='rejected' WHERE id='$appointmentid'");
    if (!$query) {
        die(mysqli_error($con) . $query);
    } else {
        ?>
        <tr>
            <th class="panel-title  date3">
                Data:
            </th>
            <th class="panel-title date3">
                Ora:
            </th>
            <th class="panel-title title4 ">
                Doktori:
            </th>
            <th class="panel-title title4 ">
                Pacienti:
            </th>
            <th class="panel-title title4 ">
                ID:
            </th>
            <th class="panel-title title4 ">
                Statusi
            </th>
        </tr>
        <?php
                                            $querycomming = mysqli_query($con, "SELECT appointments.id,appointments.date,appointments.starttime,appointments.endtime,appointments.doctorId as docid, users.name,users.surname,patients.id as patid, patients.patientID,patients.name as patname, patients.surname as patsurname, appointments.status from appointments,users,patients WHERE appointments.patientId=patients.id and appointments.status='approved' and  appointments.doctorId=users.id and appointments.doctorId='$myid' and appointments.date>=CURDATE() and appointments.starttime>CURTIME() ORDER BY date ASC, starttime ASC");
                                            if (!$querycomming) {
            die(mysqli_error($con) . $querycomming);
        } else {
            while ($datacomming = mysqli_fetch_array($querycomming)) {
        ?>
                <tr>
                    <td class=" date3">
                        <?php echo htmlentities($datacomming['date']) ?>
                    </td>
                    <td class=" date3">
                        <?php echo htmlentities($datacomming['starttime']) ?>-<?php echo htmlentities($datacomming['endtime']) ?>
                    </td>
                    <td class="title4">
                        <?php echo htmlentities($datacomming['name']) ?> <?php echo htmlentities($datacomming['surname']) ?>
                    </td>
                    <td class="title4">
                        <?php echo htmlentities($datacomming['patname']) ?> <?php echo htmlentities($datacomming['patsurname']) ?>
                    </td>
                    <td class="title4">
                        <?php echo htmlentities($datacomming['patientID']) ?>
                    </td>
                    <td class="title4">
                        <button type="button" onclick="rejectAppointment(<?php echo $datacomming['id'] ?>);" class="btn btn-danger" style="font-size: 10px;">Anulo</button>
                    </td>
                </tr>

<?php
            }
        }
    }
}
?>