<?php
require "header.php";
?>


<div style="display:inline:block;">

    <div id="nav-side">
        <span class="close" style="cursor:pointer;" onclick="openNav()">&#9776;</span>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div class="dropdown-1" style="position: relative;">
                <button class="drop-button-1">
                    <div class="d-inline-flex">
                        <img class="clipart-logo" src="img/dashboard-clipart.png"
                            style="width: 25px; height: 25px; margin-top: 5px;">
                        <p class="centered-name-1 font-weight-bold">Dashboard</p>
                    </div>
                </button>
            </div>
            <div class="dropdown-1">
                <button class="drop-button-1">
                    <div class="d-inline-flex">
                        <img class="clipart-logo" src="img/doc-clipart.png"
                            style="width: 25px; height: 25px; margin-top: 7px;">
                        <p class="centered-name-1 font-weight-bold">Doktoret</p>
                        <p> <i class="arrow down" style="margin-top: 14px;"></i></p>
                    </div>
                </button>
                <div class="dropdown-content-1 font-weight-bold">
                    <a href="#">Shto doktorr</a>
                    <a href="#">Menaxho doktorret</a>
                </div>
            </div>
            <div class="dropdown-1" style="position: relative;">
                <button class="drop-button-1">
                    <div class="d-inline-flex">
                        <img class="clipart-logo" src="img/nurse-clipart.png"
                            style="width: 25px; height: 25px; margin-top: 7px;">
                        <p class="centered-name-1 font-weight-bold">Infermieret</p>
                        <p> <i class="arrow down" style="margin-top: 14px;"></i></p>
                    </div>
                </button>
                <div class="dropdown-content-1 font-weight-bold">
                    <a href="#">Shto infermier</a>
                    <a href="#">Menaxho infermieret</a>
                </div>
            </div>
            <div class="dropdown-1" style="position: relative;">
                <button class="drop-button-1">
                    <div class="d-inline-flex">
                        <img class="clipart-logo" src="img/patient-clipart.png" style="width: 25px; height: 25px;">
                        <p class="centered-name-1 font-weight-bold">Pacientët</p>
                        <p> <i class="arrow down" style="margin-top: 14px;"></i></p>
                    </div>
                </button>
                <div class="dropdown-content-1 font-weight-bold">
                    <a href="#">Shto pacient</a>
                    <a href="#">Menaxho pacientet</a>
                </div>

            </div>
            <div class="dropdown-1" style="position: relative;">
                <button class="drop-button-1">
                    <div class="d-inline-flex">
                        <img class="clipart-logo" src="img/staf-clipart.png"
                            style="width: 25px; height: 25px; margin-top: 5px;">
                        <p class="centered-name-1 font-weight-bold">Stafi</p>
                        <p> <i class="arrow down" style="margin-top: 14px;"></i></p>
                    </div>
                </button>
                <div class="dropdown-content-1 font-weight-bold">
                    <a href="#">Shto staf</a>
                    <a href="#">Menaxho stafin</a>
                </div>

            </div>
            <div class="dropdown-1" style="position: relative;">
                <button class="drop-button-1">
                    <div class="d-inline-flex">
                        <img class="clipart-logo" src="img/raports-clipart.png"
                            style="width: 25px; height: 25px; margin-top: 5px;">
                        <p class="centered-name-1 font-weight-bold">Raportet ditore</p>
                    </div>
                </button>
            </div>
            <div class="dropdown-1" style="position: relative;">
                <button class="drop-button-1">
                    <div class="d-inline-flex">
                        <img class="clipart-logo" src="img/kuqjet-clipart.png"
                            style="width: 25px; height: 25px; margin-top: 5px;">
                        <p class="centered-name-1 font-weight-bold">Kyçjet ditore</p>
                    </div>
                </button>
            </div>
            <div class="dropdown-1" style="position: relative;">
                <button class="drop-button-1">
                    <div class="d-inline-flex">
                        <img class="clipart-logo" src="img/medicaments-clipart.png"
                            style="width: 25px; height: 25px; margin-top: 5px;">
                        <p class="centered-name-1 font-weight-bold">Menaxho medikamentet</p>
                    </div>
                </button>
                <div class="dropdown-content-1 font-weight-bold">
                    <a href="#">Shto medikamente</a>
                    <a href="#">Menaxho medikamentet</a>
                </div>
            </div>
            <div class="dropdown-1" style="position: relative;">
                <button class="drop-button-1">
                    <div class="d-inline-flex">
                        <img class="clipart-logo" src="img/laboratory-clipart.png"
                            style="width: 25px; height: 25px; margin-top: 5px;">
                        <p class="centered-name-1 font-weight-bold">Laboratori</p>
                    </div>
                </button>
            </div>
            <div class="dropdown-1" style="position: relative;">
                <button class="drop-button-1">
                    <div class="d-inline-flex">
                        <img class="clipart-logo" src="img/hospital-clipart.png"
                            style="width: 25px; height: 25px; margin-top: 5px;">
                        <p class="centered-name-1 font-weight-bold">Te dhenat e spitalit</p>
                    </div>
                </button>
            </div>
            <div class="dropdown-1" style="position: relative;">
                <button class="drop-button-1">
                    <div class="d-inline-flex">
                        <img class="clipart-logo" src="img/charts-clipart.png"
                            style="width: 25px; height: 25px; margin-top: 5px;">
                        <p class="centered-name-1 font-weight-bold">Statistika dhe analiza</p>
                    </div>
                </button>
            </div>

        </div>
    </div>
    <div class="">
        <?php
          require "header.php";
            ?>
    </div>
</div>



<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("nav-side").style.width = "250px";

}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("nav-side").style.width = "0";
}
</script>



<table class="wigdets" style="width: 100%;">
                    <tr>
                        <td class="" style="width:100px;">
                            <div class="widget " style="width: max-content;">
                                <div>
                                    <p class="wid-info text-center">Data</p>
                                    <hr class="divider" align="center">
                                </div>
                                <div>
                                    <p class="widget-main-cal text-center">12/02/2020</p>
                                </div>
                            </div>
                        </td>
                        <td></td>
                        <td rowspan="3" class="" style="background-color: red; width: 250px;">
                            <div class="widget " style="height: 100%;">
                                <div>
                                    <p class="wid-info text-center">Aktiv</p>
                                    <hr class="divider" align="center">
                                </div>
                                <div class="aktiv">
                                    aa </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="widget">
                                <div>
                                    <p class="wid-info text-center">Rastet kritike</p>
                                    <hr class="divider" align="center">
                                </div>

                            </div>
                        </td>
                    </tr>

                </table>


                /*
.wrapper {
    background-color: #0E1318;
    height: 300px;
    overflow-x: scroll;
    overflow-y: hidden;
    margin: 0 auto;
}

.item {
    background-color: #00D9E1;
    padding: 0 10px;
    height: 240px;
    width: 250px;
    border-radius: 5px;
}

.wrapper {
    /* add this at the end */
/*
display: grid;
grid-template-columns: repeat(6, auto);
grid-gap: 0 50px;
padding: 30px 60px;
padding-right: 0;

}
.empty {
    width: 10px;
}
.wrapper {
    /* Add this at the end */
    
    -ms-overflow-style: none;
    /* IE and Edge */
    
    border-radius: 10px;
}
.wrapper::-webkit-scrollbar {}
.wrapper {
    grid-auto-flow: column;
    grid-template-columns: auto;
}


<td rowspan="2" class="" style="background-color: red; width: 250px;">
                        <div class="widget " style="height: 100%;">
                            <div>
                                <p class="wid-info text-center">Aktiv</p>
                                <hr class="divider" align="center">
                            </div>
                            <div class="aktiv">
                                aa </div>
                        </div>
                    </td>