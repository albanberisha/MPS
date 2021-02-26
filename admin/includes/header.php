
<?php
session_start();
error_reporting(0);
include("includes/config.php");
?>
<style>
    .dropdown {
        overflow-wrap: break-word;
    }
    
    .dropbtn {
        padding-top: 10px;
        background-color: white;
        color: white;
        border: none;
        cursor: pointer;
        min-width: 100px;
        max-width: 250px;
        overflow-wrap: break-word;
    }
    
    .max-width-190 {
        min-width: 65px;
        max-width: 190px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
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
    
    .dropdown-content a:last-child {
        border-bottom: 1px solid #d6d6d6;
        border-radius: 0 0 0.5em 0.5em;
    }
    
    .dropdown-content a:first-child {
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
            <?php
            $query = "SELECT * FROM hospital_details";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_array($result);
            if($row['logo']==Null)
            {}else{
            echo '  
                     <img src="data:image/jpeg;base64,' . base64_encode($row['logo']) . '" height="50" width="50" />  
                     ';
            }
                     echo '<p class="text-primary content-name long-name">'.$row['name']."</p>";
                     echo '<p class="text-primary content-name capital-l">'.$row['initials'].'</p>
                     ';
            ?>
            </div>
            <div class="dropdown" style="float:right;"><button class="dropbtn">
                <div class="d-inline-flex text-xl-center">
                <?php
            $query = "SELECT * FROM users WHERE id='" . $_SESSION['id']. "'";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_array($result);


            echo '  
                     <img src="data:image/jpeg;base64,' . base64_encode($row['photo']) . '" height="30" width="30" style="border-radius: 50%;" />  
                     ';
                     echo '<p class="text-left centered-name max-width-190">';
                     if($row['name']==null)
                     {
                         echo 'Admin';
                     }else{
                         echo $row['name'];
                     }
                     echo'</p>';
            ?>
                        <p style="margin-top:-2px;">
                        <i class="arrow down"></i></p></div></button>
                <div class="dropdown-content">
                    <a href="my-profile.php">Shiko profilin</a>
                    <a href="includes/logout.inc.php">Dil</a>
                </div>
            </div>
        </div>
    </nav>
</header>
</body>

</html>