<!DOCTYPE html>
<html> <!-- History page after sign in/ sign up -->
    <head>
        <title>History- Youtube</title>
        <meta charset="UTF-8">
        <link href="history_after.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="horizNav">
            <div id="youtubelogo">
                <img src="images/youtube logo.png" alt="youtube logo" id="logo">
            </div>
            <div id="searchBox">
                <form action="" method="post">
                    <input type="text" id="searchText" name="searchinput" placeholder="Search" onclick="window.location.href='homeAfter.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>'">
                    <button id="searchBtn">
                        <img src="images/search logo.png" alt="Search">
                    </button>
                </form>
                
            </div>
            <div id="buttons">

                <?php
				    $db = new PDO("mysql:dbname=278project", "root","");
					$fname = $_REQUEST["fname"];
					$lname = $_REQUEST["lname"];
					$email = $_REQUEST["email"];

                    $myChans = $db->query("SELECT * FROM Channel WHERE owner='$email'");
                    foreach($myChans as $myChan)
                    {
                        $mychannelid = $myChan["id"];
                    }
                ?>
                
                <input type="button" id="vidImage" onclick="window.location.href = 'upload_vid.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>'">
                <input type="button" id="gridImage" onclick="openNav2()">
                <input type="button" id="bellImage">
                <button id="profileImage" onclick="openNav()">

				<?php
					print $fname[0];
					print $lname[0];
                ?>
                <?php

                    error_reporting(0);
                    if (empty($_POST["searchinput"]))
                    {
                        $searchinput = $_POST["searchinput"];
                        $rows = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE private=0 ORDER BY RAND()");				
                    }
                    else
                    {
                        $searchinput = $_POST["searchinput"];
                        $rows = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE private=0 AND title = '$searchinput'");
                    }
                ?>

				</button>
            </div>
        </div>

        <div class="vertNav">
            <ul>
                <li id="homeBtn" onclick="window.location.href = 'homeAfter.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>'">
                    <img src="images/home.png" alt="Home Image">
                    <p>Home</p>
                </li>
                <li id="subBtn" onclick="window.location.href = 'subAfter.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>'">
                    <img src="images/sub.png" alt="Sub Image">
                    <p>Subscriptions</p>
                </li>
                <li id="libBtn" onclick="window.location.href = 'lib_after.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>'">
                    <img src="images/lib.png" alt="Library Image">
                    <p>Library</p>
                </li>
                <li id="historyBtn" onclick="window.location.href = 'history_after.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>'">
                    <img src="images/hist.png" alt="History Image">
                    <p>History</p>
                </li>
                <li id="urvidBtn" onclick="window.location.href = 'upload_vid.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>'">
                    <img src="images/ur vid.png" alt="Your Vid Image">
                    <p>Your Videos</p>
                </li>
                <li id="laterBtn" onclick="window.location.href = 'later.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>'">
                    <img src="images/later.png" alt="Later Image">
                    <p>Watch Later</p>
                </li>
            </ul>
        </div>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <hr>
            <input type="button" id="profileImage" name="details_sideNavImg" value="<?= $fname[0], $lname[0]?>" onclick="window.location.href='channelAfter.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>&channelid=<?= $mychannelid?>'">
            <span class="details_sideNav" onclick="window.location.href='channelAfter.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>&channelid=<?= $mychannelid?>'">Your Channel</span>
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

        <?php
            
            $rows = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE private=0");
            $rows0 = $db->query("SELECT * FROM Channel WHERE owner='$email'");
            $rows01 = $db->query("SELECT * FROM Channel WHERE owner='$email'");

            $emailLinks = $db->query("SELECT * FROM `Channel` WHERE owner='$email'");
            $id_linked="";
            foreach($emailLinks as $emailLink){
                $id_linked = $emailLink["id"];
         
            }

        ?>

        <div class="videos">
            <div id="subWrap">
                <div id="head">
                    <img src="images/libHist.png" alt="History Image" id="histImg">
                    <h3>History</h3>
                    <form action="" method="post">
                        <button id="all" name="all">
                            <h2>
                                Clear All History
                            </h2>
                        </button>
                    </form>

                </div>
                <div id="center">
                    <?php
       
                        if(isset($_POST['all'])){
                            $historyTables = $db->query("SELECT * FROM `History` WHERE viewer= '$id_linked' ");
                            foreach($historyTables as $historyTable){
                                $deleteRow ="DELETE FROM `History` WHERE `History`.`viewer` = '$id_linked' ";
                                $db->exec($deleteRow);
                        }
                        ?>
                            <h2> Successfully cleared all history!</h2>
                        <?php
                        }

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
                                    <button id="videoBtn" onclick="window.location.href = `watchvideo.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>&id=<?php echo $vid?>`">
                                        <video id="watchVideo" width="100%">
                                            <source src="test_uploads/<?php echo $row2["fileName"] ?>" type="video/mp4">
                                        </video>
                                        <div id="channelIm">
                                            <input type="button" id="channelImage" value="<?= $channel["name"][0]?>">
                                        </div>
                                        
                                        <h4><?php echo $row2["title"] ?></h4>
                                        <p id="chanName"><?php echo $channel["name"] ?></p>
                                        <p id="vidDate">
                                            <?php 
                                                $views = $db->query("SELECT * FROM Views WHERE video=$vid")->rowCount();
                                            ?>
                                            <span><?php echo $views ?> views • </span>
                                            <span><?php echo $row2['upload_date'] ?></span>
                                        </p>
                                    </button>
                                    <?php
                                }
                            }
                        }
                    }
                    
                    ?>
                </div>
            </div>

       

         
        </div>

    </body>
    <script>
        function myFunction() {
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");
        }
    
        function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        }
        function closeNav2() {
        document.getElementById("mySidenav2").style.width = "0";
        }
        function openNav2() {
            document.getElementById("mySidenav2").style.width = "250px";
        }
    </script>
</html>