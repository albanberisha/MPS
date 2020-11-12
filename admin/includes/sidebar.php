<div class="side-nav" id="side-nav">
    <script>
        function closeNav() {
            document.getElementById("mySidenav").style.width = "60px";
            document.getElementById("closebtn").style.display = "none";
            document.getElementById("openbtn").style.display = "inline";
        }

        function openNav() {
            document.getElementById("mySidenav").style.width = "fit-content";
            document.getElementById("openbtn").style.display = "none";
            document.getElementById("closebtn").style.display = "inline";
        }
    </script>

    <div id="mySidenav" class="sidenav">
        <span class="openbtn" id="openbtn" style="cursor:pointer;" onclick="openNav()">&#9776;</span>

        <a href="javascript:void(0)" class="closebtn" id="closebtn" onclick="closeNav()">&times;</a>
        <div class="dropdown-1" style="position: relative;">
            <button class="drop-button-1">
                    <div class="d-inline-flex">
                        <img class="clipart-logo" src="img/dashboard-clipart.png"
                            style="width: 25px; height: 25px; margin-top: 5px;">
                        <p class="centered-name-1 text-left font-weight-bold">Dashboard</p>
                    </div>
                </button>
        </div>

        <div class="dropdown-1" style="position: relative;">
            <button class="drop-button-1">
                    <div class="d-inline-flex">
                        <img class="clipart-logo" src="img/doc-clipart.png"
                            style="width: 25px; height: 25px; margin-top: 7px;">
                            <p class="centered-name-1 text-left font-weight-bold">Doktoret</p>
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
                        <p class="centered-name-1 text-left font-weight-bold">Infermieret</p>
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
                        <p class="centered-name-1 text-left font-weight-bold">Pacientët</p>
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
                        <p class="centered-name-1 text-left font-weight-bold">Stafi</p>
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
                        <p  id="name"class="centered-name-1 text-left font-weight-bold">Raportet ditore</p>
                    </div>
                </button>
        </div>
        <div class="dropdown-1" style="position: relative;">
            <button class="drop-button-1">
                    <div class="d-inline-flex">
                        <img class="clipart-logo" src="img/kuqjet-clipart.png"
                            style="width: 25px; height: 25px; margin-top: 5px;">
                        <p class="centered-name-1 text-left font-weight-bold">Kyçjet ditore</p>
                    </div>
                </button>
        </div>
        <div class="dropdown-1" style="position: relative;">
            <button class="drop-button-1">
                    <div class="d-inline-flex">
                        <img class="clipart-logo" src="img/medicaments-clipart.png"
                            style="width: 25px; height: 25px; margin-top: 5px;">
                        <p class="centered-name-1 text-left  font-weight-bold">Menaxho medikamentet</p>
                        <p> <i class="arrow down" style="margin-top: 14px;"></i></p>
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
                        <p class="centered-name-1 text-left font-weight-bold">Laboratori</p>
                    </div>
                </button>
        </div>
        <div class="dropdown-1" style="position: relative;">
            <button class="drop-button-1">
                    <div class="d-inline-flex">
                        <img class="clipart-logo" src="img/hospital-clipart.png"
                            style="width: 25px; height: 25px; margin-top: 5px;">
                        <p class="centered-name-1 text-left font-weight-bold">Te dhenat e spitalit</p>
                    </div>
                </button>
        </div>
        <div class="dropdown-1" style="position: relative;">
            <button class="drop-button-1">
                    <div class="d-inline-flex">
                        <img class="clipart-logo" src="img/charts-clipart.png"
                            style="width: 25px; height: 25px; margin-top: 5px;">
                        <p class="centered-name-1 text-left font-weight-bold">Statistika dhe analiza</p>
                    </div>
                </button>
        </div>
    </div>
</div>