<?php
include('config.php');

?>
<div class="card">
    <div class="form-group">
        <form>
            <div class="form-group">
                <label class="input-title" for="DepRoom">
                    Zgjedh departamentin:
                </label>
                <select name="DepRoom" class="form-control doctorposition" required="true">
                <?php
                            $query = mysqli_query($con, "SELECT * from departaments WHERE depstatus=1");

                            if (!$query) {
                                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                            } else {
                                $cnt = 1;
                                while (($data = mysqli_fetch_array($query))) {
                                    ?>
                                    <option value="<?php echo htmlentities($data['id']) ?>"><?php echo htmlentities($data['depname']) ?></option>
                                    <?php
                                }}
                            ?>
                </select>
            </div>
            <div class="form-group" style="margin-top: 10px;">
                <button type="submit" class="btn btn-primary">Shto</button>
            </div>
        </form>
    </div>
</div>