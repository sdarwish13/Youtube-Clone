<!DOCTYPE html>
<html> <!--  History page after sign in/ sign up -->
    <head>
        <title> History Page - Youtube</title>
        <meta charset="UTF-8">
     
        <link href="History.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        
    
        <div class="horizNav">
            <div id="youtubelogo">
                <img src="images/youtube logo.png" alt="youtube logo" id="logo">
            </div>
            <div id="searchBox">
                <form>
                    <input type="text" id="searchText" placeholder="Search">
                    <button id="searchBtn">
                        <img src="images/search logo.png" alt="Search">
                    </button>
                </form>   
                
            </div>
            <div id="buttons">
                <?php
                    $fname = $_REQUEST["fname"];
                    $lname = $_REQUEST["lname"];
                    $email = $_REQUEST["email"];
                ?>
                <input type="button" id="vidImage" onclick="window.location.href='upload_vid.php?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?> '"> 
                <input type="button" id="gridImage" onclick="openNav2()">
                <!-- <input type="button" id="bellImage"> -->
                <!-- <button id="gridImage"onclick="openNav()"> -->
                <input type="button" id="bellImage">
                <input type="button" id="profileImage" onclick="openNav()" value="<?php echo $fname[0]; echo $lname[0];?>">

				<!-- </button> -->
            </div>
        </div>
        <div id="mySidenav" class="sidenav">
                   <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <hr>
                    <input type="button" id="details_sideNavImg" name="details_sideNavImg" onclick="window.location.href='upload_vid.php?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?> '">
                    <span class="details_sideNav"> Your Channel</span>
                    <br>
                    <hr>
                    <button id="details_sideNavImg_lang" value="" name="details_sideNavImg_lang" ></button>
                    <span class="details_sideNav">Language: English</span>
                    <br>
                    <hr>
                    <button id="details_sideNavImg_loc" value="" name="details_sideNavImg_loc" ></button>
                    <span class="details_sideNav"> Location: Lebanon</span>
                    <hr>
            </div>
               <div id="mySidenav2" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav2()">&times;</a>
                <hr>
                <button id="details_sideNavImg1" value="" name="details_sideNavImg1" ></button>
                <span class="details_sideNav"  > YouTube Tv</span>
                <br>
                <hr>
                <button id="details_sideNavImg2" value="" name="details_sideNavImg2" ></button>
                <span class="details_sideNav" >YouTube Music</span>
                <br>
                <hr>
                <button id="details_sideNavImg3" value="" name="details_sideNavImg3"></button>
                <span class="details_sideNav"   > YouTube Kids</span>
                <hr>
        </div>

        <div class="vertNav">
            <ul>
                <li id="homeBtn">
                    <a href="homeAfter.php?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?>">
                        <img src="images/home.png" alt="Home Image">
                        <p>Home</p>
                    </a>
                </li>
                <li id="subBtn">
                    <a href="subAfter.php?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?>">
                        <img src="images/sub.png" alt="Sub Image">
                        <p>Subscriptions</p>
                    </a>
                </li>
                <li id="libBtn">
                    <a href="lib_after.php?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?>">
                        <img src="images/lib.png" alt="Library Image">
                        <p>Library</p>
                    </a>
                </li>
                <li id="historyBtn">
                    <a href="History.html?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?>">
                        <img src="images/hist.png" alt="History Image">
                        <p>History</p>
                    </a>
                </li>
                <li id="urvidBtn">
                    <a href="upload_vid.php?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?>">
                        <img src="images/ur vid.png" alt="Your Vid Image">
                        <p>Your Videos</p>
                    </a>
                </li>
                <li id="laterBtn">
                    <a href="later.html?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?>">
                        <img src="images/later.png" alt="Later Image">
                        <p>Watch Later</p>
                    </a>
                </li>
            </ul>
        </div>


        <?php
            $db = new PDO("mysql:dbname=278project", "root","");
            $rows = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE private=0");
            $rows0 = $db->query("SELECT * FROM Channel WHERE owner='$email'");
            $rows01 = $db->query("SELECT * FROM Channel WHERE owner='$email'");
        ?>
            <div class="laterVids">
            <ul>
            <?php
            foreach($rows0 as $row)
            {
                $sar = $row["id"];
                $rows1 = $db->query("SELECT * FROM History WHERE viewer=$sar ORDER BY view_datetime DESC");
                foreach($rows1 as $row1)
                {
                    $videoId = $row1["video"];
                    $rows2 = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE id='$videoId'");
                    foreach($rows2 as $row2)
                    {
                        $vid = $row2["id"];
                        $chan = $row2["channel"];
                        $channels = $db->query("SELECT * FROM Channel WHERE id=$chan");
                        foreach($channels as $channel)
                        {
                            ?>
                                  
                                <button onclick="window.location.href = `watchvideo.php?fname=<?php echo $fname ?>&lname=<?php echo $lname ?>&email=<?php echo $email ?>&id=<?php echo $vid ?>`">
                                <video id="watchVideo" width="30%">
                                    <source src="test_uploads/<?php echo $row2["fileName"] ?>" type="video/mp4">
                                </video>
                                    <div id="vidDetails">
                                        <h2> <?= $row2["title"] ?></h2>     
                                        <span class="desWatchLater">
                                        <?= $channel["name"] ?>  
                                            &bull; 
                                            <?php 
                                                $views = $db->query("SELECT * FROM Views WHERE video=$vid")->rowCount();
                                            ?> 
                                            <?php echo $views ?> views
                                            <br>
                                            <br>
                                            Decription: kdwkcdkncoienci 
                                        </span>          
                                    </div>
                                </button>
                            <?php
                        }
                    }
                }
            }
        ?>
         </ul>
        </div>
       
        <div id="historyInfo">
            <br>  
            <button id="searchBtnHis">
                <img src="images/search logo.png" alt="Search">
            </button> 
            <input type="text" placeholder="Search watch history..." class="searchHistory">
            <br>
            <br>
            <button id="clearHisBtn">
                <h2>
                    CLEAR ALL WATCH HISTORY
                </h2>
            </button>
        </div>

    </body>

    <script>
    function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    }
    function openNav2() {
    document.getElementById("mySidenav2").style.width = "250px";
    }

        function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    }
    function closeNav2() {
    document.getElementById("mySidenav2").style.width = "0";
    }

    </script>
</html>