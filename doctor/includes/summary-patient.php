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
            <div class="col-md-12" style="margin-bottom: 10px;">
                <div class="card">
                    <?php
                    $query2 = mysqli_query($con, "SELECT deaths.patientId,deaths.deathDay, deaths.deathTime,deaths.deathCause FROM deaths WHERE patientId='$patient'");
                    if (!$query2) {
                        die(mysqli_error($con) . $query2);
                    } else {
                        $data2 = mysqli_fetch_array($query2);
                        if ($data2 > 0) {
                    ?>
                            <div style="padding-bottom: 0;">
                                <h6 class="panel-title panel-white text-center col-header">Lokacioni i pacientit ne ambientet e spitalit</h6>
                            </div>
                            <div class="card-body card-top">
                                <table class="data-list min-height dignosis color-none">
                                    <tbody>
                                        <tr>
                                            <th class="">
                                                Statusi:
                                            </th>
                                            <th class="">
                                                Data e vdekjes:
                                            </th>
                                            <th class="">
                                                Ora e vdekjes:
                                            </th>
                                            <th class="">
                                                Shkaku i vdekjes:
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="title5">
                                                Vdekur
                                            </td>
                                            <td class="title5">
                                                <?php echo htmlentities($data2['deathDay']) ?>
                                            </td>
                                            <td class="title5">
                                                <?php echo htmlentities($data2['deathTime']) ?>
                                            </td>
                                            <td class="title5">
                                                <?php echo htmlentities($data2['deathCause']) ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        } else {
                            $query3 = mysqli_query($con, "SELECT patients.id FROM patients where patients.id='$patient' and patients.status='1' and patients.id NOT IN(SELECT patientId FROM beds where patientId='$patient')");
                            if (!$query3) {
                                die(mysqli_error($con) . $query3);
                            } else {
                                $data3 = mysqli_fetch_array($query3);
                                if ($data3 > 0) {
                            ?>
                                    <div style="padding-bottom: 0;">
                                        <h6 class="panel-title panel-white text-center col-header">Lokacioni i pacientit ne ambientet e spitalit</h6>
                                    </div>
                                    <div class="card-body card-top">
                                        <table class="data-list min-height dignosis color-none">
                                            <tbody>
                                                <tr>
                                                    <th class="">
                                                        Statusi:
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td class="title5">
                                                        Jo aktiv
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                } else {
                                    $query4 = mysqli_query($con, "SELECT beds.id as bednumber,beds.condition,rooms.id as roomnumber, departaments.id as depid, departaments.depname from beds, rooms,departaments where beds.roomId=rooms.id and rooms.depId=departaments.id and beds.patientId='$patient'");
                                    if (!$query4) {
                                        die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                                    } else {
                                        $data4 = mysqli_fetch_array($query4);
                                        if ($data4 > 0) {
                                    ?>
                                            <div style="padding-bottom: 0;">
                                                <h6 class="panel-title panel-white text-center col-header">Lokacioni i pacientit ne ambientet e spitalit</h6>
                                            </div>

                                            <div class="card-body card-top">
                                                <table class="data-list min-height dignosis color-none">
                                                    <tbody>
                                                        <tr>
                                                            <th class="panel-title title5">
                                                                Departamenti:
                                                            </th>
                                                            <th class="panel-title title5 ">
                                                                Dhoma:
                                                            </th>
                                                            <th class="panel-title title5 ">
                                                                Shtrati:
                                                            </th>
                                                            <th class="panel-title title5 ">
                                                                Gjendja:
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <td class="title5">
                                                                <?php echo htmlentities($data4['depname']) ?>
                                                            </td>
                                                            <td class="title5">
                                                                <?php echo htmlentities($data4['roomnumber']) ?>
                                                            </td>
                                                            <td class="title5">
                                                                <?php echo htmlentities($data4['bednumber']) ?>
                                                            </td>
                                                            <td class="title5">
                                                                <?php
                                                                $condition = $data4['condition'];
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
                                                    </tbody>
                                                </table>
                                            </div>
                    <?php
                                        }
                                    }
                                }
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="row gutters-sm " id="pdf">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div style="padding-bottom: 0;">
                            <h3 class="panel-title panel-white text-center col-header" style="font-size: 20px;">Detajet e pacientit</h3>
                        </div>
                        <?php
                        $query2 = mysqli_query($con, "SELECT patients.id, patients.patientID, patients.name, patients.surname, patients.gender, patients.phone, patients.blood_type, patients.state, patients.city, patients.street_address from patients where patients.id='$patient'");
                        if (!$query2) {
                            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                        } else {
                            $data2 = mysqli_fetch_array($query2);
                            if ($data2 > 0) {
                        ?>
                                <div class="card-body card-top">
                                    <div class="d-flex flex-column align-items-center text-center bottom-10">
                                        <div class="mt-3">
                                            <h4><?php echo htmlentities($data2['patientID']) ?></h4>
                                            <h4 class="panel-title mb-1"><?php echo htmlentities($data2['name']) ?> <?php echo htmlentities($data2['surname']) ?></h4>
                                        </div>
                                    </div>
                                    <div class="d-flex div-inlineflex" style="display: table-row">
                                        <div class="d-flex flex-column " style="width: 49%; word-break: break-word; display: table-cell; padding-right: 1%;">
                                            <div class="bottom-10">
                                                <label style="margin-bottom: 0;"> <b>Gjinia:</b></label>
                                                <p><?php echo htmlentities($data2['gender']) ?></p>
                                            </div>
                                            <div  class="bottom-10">
                                                <label style="margin-bottom: 0;"> <b>Grupi i gjakut:</b></label>
                                                <p><?php echo htmlentities($data2['blood_type']) ?></p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column " style="width: 49%; word-break: break-word; display: table-cell; padding-left: 1%">
                                            <div class="bottom-10">
                                                <label style="margin-bottom: 3px;"> <b>Numri i telefonit:</b></label>
                                                <p><?php echo htmlentities($data2['phone']) ?></p>
                                            </div>
                                            <div class="bottom-10">
                                                <label style="margin-bottom: 0;"> <b>Adresa:</b></label>
                                                <p><?php echo htmlentities($data2['state']) ?>, <?php echo htmlentities($data2['city']) ?>, <?php echo htmlentities($data2['street_address']) ?></p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                        <div style="padding-bottom: 0;">
                            <h3 class="panel-title panel-white text-center col-header" style="font-size: 20px;">Paralajmerime</h3>
                            <div class="card-body card-top">
                                <?php
                                $query3 = mysqli_query($con, "SELECT id,description from alerts WHERE patientId='$patient' and status='1'");
                                if (!$query3) {
                                    die(mysqli_error($con) . $query3);
                                } else {
                                ?>
                                    <table class="data-list staf alerts">
                                        <tbody>
                                            <?php
                                            $message = "Asnje per tu shfaqur.";
                                            while ($data3 = mysqli_fetch_array($query3)) {
                                                $message = "";
                                            ?>
                                                <tr>
                                                    <td class="row-info bulletp">
                                                        &#9642;
                                                    </td>
                                                    <td class="row-info">
                                                        <?php echo htmlentities($data3['description']) ?>
                                                    </td>
                                                </tr>

                                            <?php

                                            }
                                            echo $message;
                                            ?>

                                        </tbody>
                                    </table>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div style="padding-bottom: 0;">
                            <h3 class="panel-title panel-white text-center col-header" style="font-size: 20px;">Diagnozat</h3>
                        </div>
                        <div class="card-body card-top">
                            <?php
                            $query4 = mysqli_query($con, "SELECT id,description,diagnosedate,enddiagnoseDate from diagnosis where patientId='$patient' and status='1'");
                            if (!$query4) {
                                die(mysqli_error($con) . $query4);
                            } else {
                            ?>
                                <table class="data-list min-height dignosis color-none">
                                    <tbody>
                                        <tr>
                                            <th class="Pdiagnoseh">Diagnoza</th>
                                            <th class="DiagnoseYearh">Data</th>
                                            <th class="GiagnoseStatush">Perfunduar</th>
                                        </tr>
                                        <?php
                                        $message = "Asnje per tu shfaqur.";
                                        while ($data4 = mysqli_fetch_array($query4)) {
                                            $message = "";
                                        ?>
                                            <tr>
                                                <td class="Pdiagnose">
                                                    <?php echo htmlentities($data4['description']) ?>
                                                </td>
                                                <td class="DiagnoseYear">
                                                    <?php echo htmlentities($data4['diagnosedate']) ?>
                                                </td>
                                                <td class="GiagnoseStatus">
                                                    <?php
                                                    $status = $data4['enddiagnoseDate'];
                                                    if ($status == NULL) {
                                                    ?>
                                                        Vazhdon
                                                    <?php
                                                    } else {
                                                    ?>

                                                    <?php
                                                        echo htmlentities($status);
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        <tr>
                                        <td>
                                        <?php
                                        echo $message;
                                        ?>
                                        </td></tr>
                                        
                                    </tbody>
                                </table>

                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                    <?php
                        $query3 = mysqli_query($con, "SELECT name,surname,relation,phone, state,city,street_address from emergencycontacts where patientId='$patient'");
                        if (!$query3) {
                            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                        } else {
                            $data3 = mysqli_fetch_array($query3);
                            if ($data3 > 0) {
                        ?>
                                <div style="padding-bottom: 0;">
                                <h3 class="panel-title panel-white text-center col-header" style="font-size: 20px;">Kontakt ne rast emergjence</h3>
                                </div>
                                <div class="card-body card-top">
                                    <table class="data-list min-height dignosis color-none">
                                        <tbody>
                                            <tr>
                                                <th class="panel-title title1">
                                                    Emri
                                                </th>
                                                <th class="panel-title title1 ">
                                                    Mbiemri
                                                </th>
                                                <th class="panel-title title1 ">
                                                    Afersia
                                                </th>
                                                <th class="panel-title title1">
                                                    Telefoni
                                                </th>
                                                <th class="panel-title title1">
                                                    Adresa
                                                </th>
                                            </tr>
                                            <tr>
                                                <td class="title1">
                                                <?php
                                                $name=$data3['name'];
                                                if($name==NULL)
                                                {
                                                    echo "-";
                                                }else{
                                                    echo htmlentities($data3['name']);
                                                }
                                                ?>
                                                </td>
                                                <td class="title1">
                                                <?php
                                                $surname=$data3['surname'];
                                                if($surname==NULL)
                                                {
                                                    echo "-";
                                                }else{
                                                    echo htmlentities($data3['surname']);
                                                }
                                                ?>
                                                </td>
                                                <td class="title1">
                                                <?php
                                                $relation=$data3['relation'];
                                                if($relation==NULL)
                                                {
                                                    echo "-";
                                                }else{
                                                    echo htmlentities($data3['relation']);
                                                }
                                                ?>
                                                </td>
                                                <td class="title1">
                                                    <?php echo htmlentities($data3['phone']) ?>
                                                </td>
                                                <td class="title1">
                                                    <p><?php echo htmlentities($data3['state']) ?> <?php echo htmlentities($data3['city']) ?> <?php echo htmlentities($data3['street_address']) ?></p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        <?php
                            }
                        }
                        ?>
                        <div style="padding-bottom: 0;">
                            <h3 class="panel-title panel-white text-center col-header" style="font-size: 20px;">Medikamentet</h3>
                        </div>
                        <div class="card-body card-top">
                            <table class="data-list min-height dignosis color-none">
                                <tbody>
                                    <tr>
                                        <th class="panel-title title1">
                                            Data:
                                        </th>
                                        <th class="panel-title title1 ">
                                            Medikamenti:
                                        </th>
                                        <th class="panel-title title1 ">
                                            Pershkrimi:
                                        </th>
                                        <th class="panel-title title1 ">
                                            Perdorimi:
                                        </th>
                                        <th class="panel-title title1">
                                            Perdorimi deri me:
                                        </th>
                                    </tr>
                                    <?php
                        $query5 = mysqli_query($con, "SELECT med_history.id,med_history.startUseDate,medicaments.id as medId, medicaments.name as medname,medicaments.description as meddesc,med_history.medUsage,med_history.endUseDate from med_history,medicaments where med_history.patientId='$patient' and med_history.medicamentId=medicaments.id ORDER BY med_history.startUseDate DESC");
                        if (!$query5) {
                            die(mysqli_error($con).$query5);
                        } else {
                            $message = "Asnje per tu shfaqur.";
                            while($data5=mysqli_fetch_array($query5))
                            {$message="";
                                ?>
                                <tr>
                                <td class="title1">
                                    <?php  echo htmlentities($data5['startUseDate']) ?>
                                </td>
                                <td class="title1">
                                <?php  echo htmlentities($data5['medname']) ?>
                                </td>
                                <td class="title1">
                                <?php  echo htmlentities($data5['meddesc']) ?>
                                </td>
                                <td class="title1">
                                <?php  echo htmlentities($data5['medUsage']) ?>
                                </td>
                                <td class="title1">
                                <?php  echo htmlentities($data5['endUseDate']) ?>
                                </td>
                            </tr>

                                <?php

                            }
                            echo "<tr><td>". $message."</td></tr>";
                        }
                        ?>
                                </tbody>
                            </table>
                        </div>
                        <div style="padding-bottom: 0;">
                            <h3 class="panel-title panel-white text-center col-header" style="font-size: 20px;">Pranimet ne spital</h3>
                        </div>
                        <?php
                        $query4 = mysqli_query($con, "SELECT receipts.id,receipts.entryDateTime,users.name, users.surname,receipts.reason,receipts.exitDateTime, receipts.bedId from receipts,users where receipts.patientId='$patient' and receipts.userInCharge=users.id ORDER BY receipts.id DESC");
                        if (!$query4) {
                            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                        } else {
                        ?>
                                <div class="card-body card-top">
                                    <table class="data-list min-height dignosis color-none">
                                        <tbody>
                                            <tr>
                                                <th class="panel-title title1 date">
                                                    Data:
                                                </th>
                                                <th class="panel-title title2 ">
                                                </th>
                                                <th class="panel-title title2 ">
                                                    Pranuesi:
                                                </th>
                                                <th class="panel-title title2 ">
                                                    Arsyeja:
                                                </th>
                                                <th class="panel-title title1 date">
                                                    Dalja:
                                                </th>
                                            </tr>
                                            <?php
                                           
                                            while ($data4 = mysqli_fetch_array($query4)) {
                                            ?>
                                                    <tr>
                                                        <td class="title1 date">
                                                            <?php
                                                            $timestamp = $data4['entryDateTime'];
                                                            $splitTimeStamp = explode(" ", $timestamp);
                                                            echo htmlentities($splitTimeStamp[0]) ?>

                                                        </td>
                                                        <td class="title2">
                                                        </td>
                                                        <td class="title2">
                                                            <?php echo htmlentities($data4['name']) ?> <?php echo htmlentities($data4['surname']) ?>
                                                        </td>
                                                        <td class="title2">
                                                            <?php echo htmlentities($data4['reason']) ?>
                                                        </td>
                                                        <td class="title1 date">
                                                            <?php
                                                            $timestamp = $data4['exitDateTime'];
                                                            $splitTimeStamp = explode(" ", $timestamp);
                                                            $data = $splitTimeStamp[0];
                                                            if ($data == NULL) {
                                                                echo "-";
                                                            } else {
                                                                echo htmlentities($splitTimeStamp[0]);
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>

                                                <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                        <div style="padding-bottom: 0;">
                            <h3 class="panel-title panel-white text-center col-header" style="font-size: 20px;">Terminet</h3>
                        </div>
                        <div class="card-body card-top">
                            <table class="data-list min-height dignosis color-none">
                                <tbody>
                                    <tr>
                                        <th class="panel-title title1 date">
                                            Data:
                                        </th>
                                        <th class="panel-title title2 ">
                                            Doktori:
                                        </th>
                                        <th class="panel-title title2 ">
                                            Ora:
                                        </th>
                                        <th class="panel-title title2 ">
                                            Statusi:
                                        </th>
                                    </tr>
                                    <?php
                        $query6 = mysqli_query($con, "SELECT appointments.id,appointments.date,appointments.starttime,appointments.starttime,appointments.endtime,users.id,users.name as username,users.surname as usersurname,appointments.status from appointments,users where appointments.patientId='$patient' and appointments.doctorId=users.id ORDER BY date DESC, starttime DESC");
                        if (!$query6) {
                            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                        } else {
                            $message = "Asnje per tu shfaqur.";
                            while($data6=mysqli_fetch_array($query6))
                            {$message="";
                                ?>
                                <tr>
                                        <td class="title1 date">
                                        <?php echo htmlentities($data6['date']) ?>
                                        </td>
                                        <td class="title2">
                                        <?php echo htmlentities($data6['username']) ?> <?php echo htmlentities($data6['usersurname']) ?>
                                        </td>
                                        <td class="title2">
                                        <?php echo htmlentities($data6['starttime']) ?> - <?php echo htmlentities($data6['endtime']) ?>
                                        </td>
                                        <td class="title2">
                                        <?php
                                                    $status = $data6['status'];
                                                    $statusi = "";
                                                    switch ($status) {
                                                        case "approved":
                                                            $statusi = "Aprovuar";
                                                            break;
                                                        case "finished":
                                                            $statusi = "Pefunduar";
                                                            break;
                                                        case "rejected":
                                                            $statusi = "Refuzuar";
                                                            break;
                                                        default:
                                                            $statusi = "";
                                                    }
                                                    echo $statusi;
                                                    ?>
                                        </td>
                                    </tr>

                                <?php
                            }
                            echo "<tr><td>". $message."</td></tr>";
                            }
                        
                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" onclick="printDiv('pdf','Title')" id="PaymentBill" class="btn btn-success btn-lg btn-block">
                Printo  <span class="glyphicon glyphicon-chevron-right"></span>
            </button>
        </div>
<?php
    } else {
        echo "Te dhena te panjohura.";
    }
}
?>