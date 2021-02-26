<?php

include('config.php');

function savedata($con, $hname, $hinitials, $hstate, $hcity, $hstreet, $hlogo)
{
    $alert = "Te dhenat u ruajten me sukses.";
    $today = date("Y-m-d");
    $query = mysqli_query($con, "SELECT * FROM hospital_details WHERE id='1'");
    $data = mysqli_fetch_array($query);
    $lastupdated = $data['lastUpdate'];
    $today = date("Y-m-d");
    //if ($lastupdated == $today) 
    if(false)
        {$alert="Mund te ndryshoni te dhenat vetem nje here brenda dites.";
            echo "<script>
            alert('".$alert."');
            window.location.href='hospital-info.php';
      </script>";
    }else{
        if (empty($hlogo)) {
            $query = mysqli_query($con, "UPDATE hospital_details SET name='$hname', initials='$hinitials', state='$hstate', city='$hcity', street_address='$hstreet', lastUpdate='$today'  WHERE id='1'");
        } else {
            $logo = addslashes($hlogo);
            $query = mysqli_query($con, "UPDATE hospital_details SET name='$hname', initials='$hinitials', state='$hstate', city='$hcity', street_address='$hstreet', logo='$logo', lastUpdate='$today'  WHERE id='1'");
        }
        $data = mysqli_fetch_array($query);
        if (!$query) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_errno($query));
        } else {
            $extra = "hospital-info.php"; //
                $host = $_SERVER['HTTP_HOST'];
                $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                echo "<script>
            alert('".$alert."');
            window.location.href='http://".$host.$uri."/".$extra."?edit=success';
         </script>";
         exit(0);
        }
    }
}






if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $file = $_FILES['file']['tmp_name'];
        $fileContent = file_get_contents($_FILES['file']['tmp_name']);
        $fileType = $_FILES['file']['type'];
        $h_name = $_POST['hospitalName'];
        $h_initials = $_POST['initials'];
        $h_state = $_POST['stateaddress'];
        $h_city = $_POST['cityaddress'];
        $h_street = $_POST['streetAddress'];

        function validation($form_data)
        {
            $form_data = trim(stripcslashes(htmlspecialchars($form_data)));
            return $form_data;
        }

        $name = validation($h_name);
        $initials = validation($h_initials);
        $state = validation($h_state);
        $city = validation($h_city);
        $street = validation($h_street);


        if (($fileType != 'image/png' && $fileType != 'image/gif' && $fileType != 'image/jpeg' && $fileType != 'image/jpg') && !empty($fileContent)) {
            $image_error = $fileType . " nuk preferohet. Kerkohen formatet: png, gif, jpeg, jpg!";
        } elseif ($_FILES['file']['size'] > 10485760) { //10 MB (size is also in bytes)
            $image_error = " Keni tejkaluar madhesine e mundshme!";
        } elseif (empty($name)) {
            $hospitalname_error = "Emri i nuk mund te jete i zbrazet";
        } else {
            savedata($con, $name, $initials, $state, $city, $street, $fileContent);
        }
    }
}
?>
<div class=" container-fullw">
    <div class="panel-body">
        <div class="panel-heading">
            <h5 class="panel-title">Te dhenat e spitalit</h5>
        </div>
        <div class="panel-form">
            <form method="POST" id="HospitalFrom" enctype="multipart/form-data">
                <?php
                $query = mysqli_query($con, "SELECT * FROM hospital_details where id='1'");
                while ($hospitaldata = mysqli_fetch_array($query)) {
                ?>
                    <div class="circle form-group">
                        <div class="input-formimg">

                            <?php
                            if ($hospitaldata['logo'] == Null) {
                            } else {
                                echo ' <img id="preview" class="circle" src="data:image/jpeg;base64,' . base64_encode($hospitaldata['logo']) . '" />  ';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <div class="input-formimg">
                            <input type="file" id="file" name="file" accept="image/*" />
                        </div>
                        <div class="input-formimg">
                            <span style="color: red;"><?php echo  @$image_error; ?></span>
                        </div>
                    </div>
                    <div class="div-inlineflex">
                        <div class="form-group">
                            <label class="input-title">Emri i spitalit</label>
                            <input type="text" id="NameHospital" name="hospitalName" class="form-control" placeholder="Sheno emrin e spitalit." value="<?php echo htmlentities($hospitaldata['name']); ?>">
                            <span style="color: red;"><?php echo @$hospitalname_error; ?></span>
                        </div>
                        <div class="form-group">
                            <label class="input-title">Shkurtesa</label>
                            <input type="text" id="ShortName" name="initials" class="form-control" placeholder="Sheno inicialet e spitalit." value="<?php echo htmlentities($hospitaldata['initials']); ?>">
                            <span style="color: red;"><?php echo @$initials_error; ?></span>
                        </div>
                    </div>
                    <div class="div-inlineflex">
                        <div class="form-group">
                            <label class="input-title">Shteti</label>
                            <input type="text" class="form-control" id="StateAddress" name="stateaddress" placeholder="Shteti" value="<?php echo htmlentities($hospitaldata['state']); ?>">
                            <span style="color: red;"><?php echo @$state_error; ?></span>
                        </div>
                        <div class="form-group">
                            <label class="input-title">Qyteti</label>
                            <input type="text" class="form-control" id="CityAddress" name="cityaddress" placeholder="Qyteti" value="<?php echo htmlentities($hospitaldata['city']); ?>">
                            <span style="color: red;"><?php echo @$city_error; ?></span>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="input-title">Adresa e rruges</label>
                        <input type="text" class="form-control" id="StreetAddress" name="streetAddress" placeholder="Adresa e rrugës" value="<?php echo htmlentities($hospitaldata['street_address']); ?>">
                        <span style="color: red;"><?php echo @$streetaddress_error; ?></span>
                    </div>
                <?php
                }
                ?>
                <div class="form-group" style="margin-top: 10px;">
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Ndrysho</button>
                </div>
            </form>
        </div>
    </div>
</div>