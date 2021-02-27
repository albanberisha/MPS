<?php
include('config.php');

?>
<div class="card">
    <div class="form-group">
        <?php
        $query = mysqli_query($con, "SELECT * from rooms");
        if (!$query) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {
            $data = mysqli_fetch_array($query);
            if ($data > 0) {
               ?>
                <form>
                    <div class="form-group">
                        <label class="input-title" for="DepRoom">
                            Zgjedh dhomen:
                        </label>
                        <select name="DepBed" class="form-control doctorposition" required="true">
                            <?php
                                    $query1 = mysqli_query($con, "SELECT * from rooms WHERE 	roomnumber IS NOT NULL");

                                while (($data1 = mysqli_fetch_array($query1))) {
                                    ?>
                                    <option value="<?php echo htmlentities($data1['id']); ?>"><?php echo htmlentities($data['id']) ?></option>
                                  <?php
                                }
                            ?>
                        </select>
                    </div>
                </form>
            <?php
            } else {
            ?>
                <p>Asnje dhome per tu shfaqur.</p>
        <?php
            }
        }
        ?>
    </div>
</div>