
    <style>
        .dropbtn {
            padding-top: 10px;
            background-color: white;
            color: white;
            border: none;
            cursor: pointer;
        }
        
        .dropdown-content {
            background-color: #ffffff;
            display: none;
            position: absolute;
            right: 0;
            min-width: 100px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 0 0 0.5em 0.5em;
            width: 100%;
        }
        
        .dropbtn:hover,
        .dropdown:hover .dropbtn {
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        }
        
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:first-child
        {
            border-bottom: 1px solid #d6d6d6;
        }
        
        .dropdown-content a:hover {
            background-color: #ececec;
        }
        
        .dropdown:hover .dropdown-content {
            display: block;
        }
        
        .dropdown:hover .dropbtn {
            background-color: #ececec;
            border-radius: 0.5em 0.5em 0 0;
        }
    </style>

    <header class="top-head">
        <nav class="header-main">
            <div class="content">
                <div class="float-left d-inline-flex">
                    <img src="img/hospital.svg" width="50px" height="50px" />
                    <p class="text-primary content-name">Spitali QKUK</p>
                </div>
                <div class="dropdown" style="float:right;">

                    <button class="dropbtn">
                        <div class="float-right d-inline-flex text-xl-center">
                           <img src="img/doctor.png" width="30px" height="30px" style="border-radius: 50%;" />
                           <p class="centered-name">Alban Berisha</p>
                           <p> <i class="arrow down"></i></p>
                      </div>
                </button>
                    <div class="dropdown-content">
                        <a href="#">Shiko profilin</a>
                        <a href="#">Dil</a>
                    </div>

                </div>

        </nav>
    </header>
</body>

</html>