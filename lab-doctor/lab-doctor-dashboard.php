<?php
session_start();
error_reporting(0);
include('includes/config.php');
$myid = $_SESSION['id'];
?>
<script>
    $(document).ready(function() {
        setInterval(function() {

            $('#ActiveUsers').load('includes/active-users.php');
        }, 10000);
    });
</script>
<style>
.seenmessage
{
    border-left: 1px solid green;
    border-right: 1px solid green;
}
</style>
<div class="card-header">
    <p>Doktor | Paneli i aparaturave</p>
</div>
<div class="container-fullw">
    <div class="row">
        <div class="col-sm-4">
            <div class="col">
                <div class="panel panel-white text-center" onclick="window.open('results.php', '_self');">
                    <div class="panel-body wid">
                        <div class="fa-stack fa-2x image-wid">
                            <img src="img/lab-results-icon.svg">
                        </div>
                        <h2 class="StepTitle">Rezultatet laboratorike</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="col">
                <div class="panel panel-white no-radius text-center" onclick="window.open('add-new-results.php', '_self');">
                    <div class="panel-body wid">
                        <div class="fa-stack fa-2x image-wid">
                            <img src="img/new-results.svg">
                        </div>
                        <h2 class="StepTitle">Vendos rezultate te reja</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 users">
            <div class="panel panel-white no-radius text-center">
                <div class="panel-body">
                    <div>
                        <p class="wid-info text-center">Aktiv</p>
                        <hr class="divider" align="center">
                    </div>
                    <div class="active-users">
                        <div class="widget" id="widget">
                            <div class="active-now" id="ActiveUsers">
                            <?php include('includes/active-users.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id='MSEq'>
    </div>
</div>