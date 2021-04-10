<?php
include('config.php');

$patient_name = $_POST['name'];
$table = $_POST['table'];

if (strcmp($table, "patients") == 0) {
    searchpatient($con, $patient_name);
} elseif (strcmp($table, "ActivePatients") == 0) {
    searchActivepatient($con, $patient_name);
} elseif (strcmp($table, "searchpatients") == 0) {
    searchPpatient($con, $patient_name);
} elseif (strcmp($table, "ActivePatients2") == 0) {
    searchpatient2($con, $patient_name);
} else {
    echo "error";
}


function searchpatient($con, $patient_name)
{
    if (empty($patient_name) && $patient_name != 0) {
        echo "error";
    } else {
        $query = mysqli_query($con, "SELECT patients.id, patients.patientID, patients.name,patients.surname, patients.phone,patients.gender from patients where patients.status=1 and patients.patientID like '%$patient_name%' and patients.id IN (SELECT beds.patientId FROM beds)");
        $query2 = mysqli_query($con, "SELECT patients.id, patients.patientID, patients.name,patients.surname, patients.phone,patients.gender from patients where patients.status=1 and patients.patientID like '%$patient_name%' and patients.id NOT IN(SELECT patients.id from patients where patients.status=1 and patients.patientID like '%$patient_name%' and patients.id IN (SELECT beds.patientId FROM beds))");

        if (!$query || !$query2) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {

            if (mysqli_num_rows($query) > 0) {
?>
                <table class="data-list min-height">
                    <tbody>
                        <tr class="table-head ">
                            <td class="pid-h">ID</td>
                            <td class="pnameh">Emri</td>
                            <td class="psnameh">Mbiemri</td>
                            <td class="pcontacth">Kontakti</td>
                            <td class="pgenderh">Gjinia</td>
                            <td class="pstatush">Statusi</td>
                            <td class="actionsh">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="data-list staf">
                    <tbody>
                        <?php
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td class="pid">
                                    <?php echo htmlentities($data['patientID']); ?>

                                </td>
                                <td class="pname">
                                    <?php echo htmlentities($data['name']); ?>

                                </td>
                                <td class="psname">
                                    <?php echo htmlentities($data['surname']); ?>

                                </td>
                                <td class="pcontact">
                                    <?php echo htmlentities($data['phone']); ?>

                                </td>
                                <td class="pgender">
                                    <?php echo htmlentities($data['gender']); ?>

                                </td>
                                <td class="pstatus">
                                    Aktiv
                                </td>
                                <td class=" actions">
                                    <span class="edit-data">
                                        <a href="view-patient.php?id=<?php echo $data['id'] ?>&view=patient">
                                            <img src="img/eye-icon.png"> </a>
                                    </span>
                                </td>
                            </tr>
                        <?php
                        }
                        while ($data2 = mysqli_fetch_array($query2)) {
                        ?>
                            <tr>
                                <td class="pid">
                                    <?php echo htmlentities($data2['patientID']); ?>

                                </td>
                                <td class="pname">
                                    <?php echo htmlentities($data2['name']); ?>

                                </td>
                                <td class="psname">
                                    <?php echo htmlentities($data2['surname']); ?>

                                </td>
                                <td class="pcontact">
                                    <?php echo htmlentities($data2['phone']); ?>

                                </td>
                                <td class="pgender">
                                    <?php echo htmlentities($data2['gender']); ?>

                                </td>
                                <td class="pstatus">
                                    Jo Aktiv
                                </td>
                                <td class=" actions">
                                    <span class="edit-data">
                                        <a href="view-patient.php?id=<?php echo $data2['id'] ?>&view=patient">
                                            <img src="img/eye-icon.png"> </a>
                                    </span>
                                    <span class="delete-data">
                                        <a href="reg-patient.php?id=<?php echo $data2['id'] ?>&activate=patient">
                                            <img src="img/edit-icon.png"> </a>
                                    </span>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            } else {
                $query2 = mysqli_query($con, "SELECT patients.id, patients.patientID, patients.name,patients.surname, patients.phone,patients.gender from patients where patients.status=1 and patients.patientID like '%$patient_name%' and patients.id NOT IN(SELECT patients.id from patients where patients.status=1 and patients.patientID like '%$patient_name%' and patients.id IN (SELECT beds.patientId FROM beds))");
                if (!$query2) {
                    die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                } else {
                }
                if (mysqli_num_rows($query2) > 0) {
                ?>
                    <table class="data-list min-height">
                        <tbody>
                            <tr class="table-head ">
                                <td class="pid-h">ID</td>
                                <td class="pnameh">Emri</td>
                                <td class="psnameh">Mbiemri</td>
                                <td class="pcontacth">Kontakti</td>
                                <td class="pgenderh">Gjinia</td>
                                <td class="pstatush">Statusi</td>
                                <td class="actionsh">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="data-list staf">
                        <tbody>
                            <?php
                            while ($data2 = mysqli_fetch_array($query2)) {
                            ?>
                                <tr>
                                    <td class="pid">
                                        <?php echo htmlentities($data2['patientID']); ?>

                                    </td>
                                    <td class="pname">
                                        <?php echo htmlentities($data2['name']); ?>

                                    </td>
                                    <td class="psname">
                                        <?php echo htmlentities($data2['surname']); ?>

                                    </td>
                                    <td class="pcontact">
                                        <?php echo htmlentities($data2['phone']); ?>

                                    </td>
                                    <td class="pgender">
                                        <?php echo htmlentities($data2['gender']); ?>

                                    </td>
                                    <td class="pstatus">
                                        Jo aktiv
                                    </td>
                                    <td class=" actions">
                                        <span class="edit-data">
                                            <a href="view-patient.php?id=<?php echo $data2['id'] ?>&view=patient">
                                                <img src="img/eye-icon.png"> </a>
                                        </span>
                                        <span class="delete-data">
                                            <a href="reg-patient.php?id=<?php echo $data2['id'] ?>&activate=patient">
                                                <img src="img/edit-icon.png"> </a>
                                        </span>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                <?php
                } else {
                    echo 'error';
                }
            }
        }
    }
}


function  searchActivepatient($con, $patient_name)
{
    if (empty($patient_name) || (!preg_match("/^([a-zA-Z' ]+)$/", $patient_name))) {
        echo $error = "error";
    } else {
        $query = mysqli_query($con, "SELECT id, name, surname, phone, gender from patients where status='1' and name like '%$patient_name%' and id in (SELECT patientID
                            from beds)");
        if (!$query) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {
            $count = 1;
            while (($data = mysqli_fetch_array($query))) {
                ?>
                <tr>
                    <td class="pid">
                        <?php echo $count; ?>
                    </td>
                    <td class="pname">
                        <?php echo htmlentities($data['name']); ?>

                    </td>
                    <td class="psname">
                        <?php echo htmlentities($data['surname']); ?>
                    </td>
                    <td class="pcontact">
                        <?php echo htmlentities($data['phone']); ?>

                    </td>
                    <td class="pgender">
                        <?php echo htmlentities($data['gender']); ?>
                    </td>
                    <td class="pstatus">
                        Aktiv
                    </td>
                    <td class="actions">
                        <span class="edit-data">
                            <a href="close-history-patient.php?id=<?php echo $data['id'] ?>&closehistory=patient">
                                <img src="img/edit-icon.png">
                        </span>
                    </td>
                </tr>
            <?php
                $count++;
            }
        }
    }
}

function searchPpatient($con, $patient_name)
{
    if (empty($patient_name) || (!preg_match("/^([a-zA-Z' ]+)$/", $patient_name))) {
        echo $error = "error";
    } else {
        $query = mysqli_query($con, "SELECT receipts.id, receipts.patientId ,patients.patientID as patID, receipts.entryDateTime, users.name as username, users.surname as usersurname, patients.name as patientname, patients.surname as patientsurname, receipts.cond from receipts, users, patients where receipts.patientId=patients.id and receipts.userInCharge=users.id and patients.name like '%$patient_name%' ORDER BY receipts.id DESC");
        if (!$query) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {
            $count = 1;
            while (($data = mysqli_fetch_array($query))) {
                $timestamp = $data['entryDateTime'];
                $splitTimeStamp = explode(" ", $timestamp);
                $date = $splitTimeStamp[0];
                $time = $splitTimeStamp[1];
            ?>
                <tr>
                    <td class="rid"><?php echo $count; ?></td>
                    <td class="rname2"><?php echo htmlentities($data['patID']); ?></td>
                    <td class="rsname2"><?php echo htmlentities($data['patientname']); ?> <?php echo htmlentities($data['patientsurname']); ?></td>
                    <td class="rreceps"><?php echo htmlentities($data['username']); ?> <?php echo htmlentities($data['usersurname']); ?></td>
                    <td class="rdate"><?php echo $date; ?> <?php echo $time; ?></td>
                    <td class="rtime"><?php
                                        $condition = $data['cond'];
                                        switch ($condition) {
                                            case "red":
                                        ?>
                                <a href="#" type="button" class="btn btn-secondary" style=" background: red; border:1px solid rgb(255, 142, 142); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast emergjent. Kerkohet intervenim i menjehershem per shpetim te jetes. Riskt te madh per humbje te jetes.">Kuqe</a>
                            <?php
                                                break;
                                            case "yellow":
                            ?>
                                <a href="#" type="button" class="btn btn-secondary" style="background: yellow; border:1px solid rgb(199, 199, 105); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast urgjent. Kerkohen shume resurse mirpo jo rreizk per jeten. Rast potencial resioz">Verdhë</a>
                            <?php
                                                break;
                                            default:
                            ?>
                                <a href="#" type="button" class="btn btn-secondary" style="background: green; border:1px solid rgb(128, 253, 128); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast me pak urgjent. Intervenim standard.">Gjelbër</a>

                        <?php
                                        }
                        ?>
                    </td>
                </tr>
            <?php
                $count++;
            }
        }
    }
}


function searchpatient2($con, $patient_name)
{
    if (empty($patient_name) || (!preg_match("/^([a-zA-Z' ]+)$/", $patient_name))) {
        echo $error = "error";
    } else {
        $query = mysqli_query($con, "SELECT patients.id, patients.patientID, patients.name,patients.surname, patients.phone,patients.gender from patients where patients.status=1 and  patients.name like '%$patient_name%' and patients.id IN (SELECT beds.patientId FROM beds)");
        $query2 = mysqli_query($con, "SELECT patients.id, patients.patientID, patients.name,patients.surname, patients.phone,patients.gender from patients where patients.status=1 and  patients.name like '%$patient_name%' and  patients.patientID and patients.id NOT IN(SELECT patients.id from patients where patients.status=1 and patients.id IN (SELECT beds.patientId FROM beds))");
        if (!$query || !$query2) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {

            while ($data = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td class="pid">
                        <?php echo htmlentities($data['patientID']); ?>

                    </td>
                    <td class="pname">
                        <?php echo htmlentities($data['name']); ?>

                    </td>
                    <td class="psname">
                        <?php echo htmlentities($data['surname']); ?>

                    </td>
                    <td class="pcontact">
                        <?php echo htmlentities($data['phone']); ?>

                    </td>
                    <td class="pgender">
                        <?php echo htmlentities($data['gender']); ?>

                    </td>
                    <td class="pstatus">
                        Aktiv
                    </td>
                    <td class=" actions">
                    <span class="edit-data">
                                                <a href="create-appointment.php?id=<?php echo $data['id'] ?>&closehistory=patient">
                                                    <img src="img/edit-icon.png">
                                            </span>
                    </td>
                </tr>
            <?php
            }
            while ($data2 = mysqli_fetch_array($query2)) {
            ?>
                <tr>
                    <td class="pid">
                        <?php echo htmlentities($data2['patientID']); ?>

                    </td>
                    <td class="pname">
                        <?php echo htmlentities($data2['name']); ?>

                    </td>
                    <td class="psname">
                        <?php echo htmlentities($data2['surname']); ?>

                    </td>
                    <td class="pcontact">
                        <?php echo htmlentities($data2['phone']); ?>

                    </td>
                    <td class="pgender">
                        <?php echo htmlentities($data2['gender']); ?>

                    </td>
                    <td class="pstatus">
                        Jo Aktiv
                    </td>
                    <td class=" actions">
                        <span class="edit-data">
                                                <a href="create-appointment.php?id=<?php echo $data2['id'] ?>&closehistory=patient">
                                                    <img src="img/edit-icon.png">
                                            </span>
                    </td>
                </tr>
<?php
            }
        }
    }
}
