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
            <button class="drop-button-1" onclick="window.open('dashboard.php', '_self');">
                <div class="d-inline-flex">
                    <img class="clipart-logo" src="img/dashboard-clipart.png" style="width: 25px; height: 25px; margin-top: 5px;">
                    <p class="centered-name-1 text-left font-weight-bold">Dashboard</p>
                </div>
            </button>
        </div>
        <div class="dropdown-1" style="position: relative;">
            <button class="drop-button-1" onclick="window.open('', '_self');">
                <div class="d-inline-flex">
                    <img class="clipart-logo" src="img/raports-clipart.png" style="width: 25px; height: 25px;">
                    <p class="centered-name-1 text-left font-weight-bold">Historia e regjistrimeve</p>
                </div>
            </button>

        </div>
    </div>
</div>