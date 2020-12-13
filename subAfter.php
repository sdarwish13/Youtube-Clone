<!DOCTYPE html>
<html> <!-- Subscription page after sign in/ sign up -->
    <head>
        <title>Subscriptions - Youtube</title>
        <meta charset="UTF-8">
        <link href="subAfter.css" rel="stylesheet" type="text/css">
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
				
					$fname = $_REQUEST["fname"];
					$lname = $_REQUEST["lname"];
					$email = $_REQUEST["email"];
				
				?>

                <input type="button" id="vidImage" onclick="window.location.href = 'upload_vid.php?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?>'">
                <input type="button" id="gridImage" onclick="openNav2()">
                <input type="button" id="bellImage">
                <button id="profileImage" onclick="openNav()">

				<?php
					print $fname[0];
					print $lname[0];
				?>

				</button>
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
                <span class="details_sideNav">Location: Lebanon</span>
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
        </div>

        <div class="vertNav">
            <ul>
                <li id="homeBtn">
                    <a href="homeAfter.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>">
                        <img src="images/home.png" alt="Home Image">
                        <p>Home</p>
                    </a>
                </li>
                <li id="subBtn">
                    <a href="subAfter.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>">
                        <img src="images/sub.png" alt="Sub Image">
                        <p>Subscriptions</p>
                    </a>
                </li>
                <li id="libBtn">
                    <a href="lib_after.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>">
                        <img src="images/lib.png" alt="Library Image">
                        <p>Library</p>
                    </a>
                </li>
                <li id="historyBtn">
                    <a href="history_after.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>">
                        <img src="images/hist.png" alt="History Image">
                        <p>History</p>
                    </a>
                </li>
                <li id="urvidBtn">
                    <a href="upload_vid.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>">
                        <img src="images/ur vid.png" alt="Your Vid Image">
                        <p>Your Videos</p>
                    </a>
                </li>
                <li id="laterBtn">
                    <a href="later.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>">
                        <img src="images/later.png" alt="Later Image">
                        <p>Watch Later</p>
                    </a>
                </li>
            </ul>
        </div>

        <div class="videos">
            <div id="subWrap">
                <?php
                    $db = new PDO("mysql:dbname=278project", "root","");
                    $rows = $db->query("SELECT * FROM Channel WHERE owner='$email'");

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
                
                <div id="center">
                    <?php
                        foreach($rows as $row)
                        {
                            $arr = array();
                            $cid = $row["id"];
                            $subs = $db->query("SELECT * FROM Subscription WHERE subscriber=$cid");
                            foreach($subs as $sub)
                            {
                                $arr[] = $sub["channel"];
                            }
                        }
                        $arr1 = implode(',', $arr);
                        $vids = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE channel IN ($arr1) AND private=0 ORDER BY DATE_FORMAT(upload_date , '%m-%d-%Y %h-%i-%s') DESC");
                        foreach($vids as $v)
                        {
                            if($v['upload_date']==date("m-d-Y"))
                            {
                                ?>
                                <h3>Today</h3>
                                <?php
                            }
                        break;
                        }
                        $vids = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE channel IN ($arr1) AND private=0 ORDER BY DATE_FORMAT(upload_date , '%m-%d-%Y %h-%i-%s') DESC");
                        foreach($vids as $row)
                        {
                            $vid = $row["id"];
                            $chan = $row["channel"];
                            $channels = $db->query("SELECT * FROM Channel WHERE id=$chan");
                            foreach($channels as $channel)
                            {
                                if($row['upload_date']==date("m-d-Y"))
                                {
                                    ?>
                                    <button onclick="window.location.href = `watchvideo.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>$id=<?php echo $row['id']?>`">
                                        <video id="watchVideo" width="100%">
                                            <source src="test_uploads/<?php echo $row["fileName"] ?>" type="video/mp4">
                                        </video>
                                        <div id="channelIm">
                                            <input type="button" id="channelImage" value="<?= $channel["name"][0]?>">
                                        </div>
                                        
                                        <h4><?php echo $row["title"] ?></h4>
                                        <p><?php echo $channel["name"] ?></p>
                                        <p>
                                            <?php 
                                                $views = $db->query("SELECT * FROM Views WHERE video=$vid")->rowCount();
                                            ?>
                                            <span><?php echo $views ?> views • </span>
                                            <span><?php echo $row['upload_date'] ?></span>
                                        </p>
                                    </button>
                                    <?php
                                }
                            }
                        }
                        $vids = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE channel IN ($arr1) AND private=0 ORDER BY DATE_FORMAT(upload_date , '%m-%d-%Y %h-%i-%s') DESC");
                        foreach($vids as $v)
                        {
                            if($v['upload_date']<date("m-d-Y"))
                            {
                                ?>
                                <h3>Older</h3>
                                <?php
                                break;
                            }
                        }
                        $vids = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE channel IN ($arr1) AND private=0 ORDER BY DATE_FORMAT(upload_date , '%m-%d-%Y %h-%i-%s') DESC");
                        foreach($vids as $row)
                        {
                            $vid = $row["id"];
                            $chan = $row["channel"];
                            $channels = $db->query("SELECT * FROM Channel WHERE id=$chan");
                            foreach($channels as $channel)
                            {
                                if($row['upload_date']<date("m-d-Y"))
                                {
                                    ?>
                                    <button id="videoBtn" onclick="window.location.href = `watchvideo.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>$id=<?php echo $row['id']?>`">
                                        <video id="watchVideo" width="100%">
                                            <source src="test_uploads/<?php echo $row["fileName"] ?>" type="video/mp4">
                                        </video>
                                        <div id="channelIm">
                                            <input type="button" id="channelImage" value="<?= $channel["name"][0]?>">
                                        </div>
                                        <h4><?php echo $row["title"] ?></h4>
                                        <p><?php echo $channel["name"] ?></p>
                                        <p>
                                            <?php 
                                                $views = $db->query("SELECT * FROM Views WHERE video=$vid")->rowCount();
                                            ?>
                                            <span><?php echo $views ?> views • </span>
                                            <span><?php echo $row['upload_date'] ?></span>
                                        </p>
                                    </button>
                                    <?php
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>

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
    </body>
</html>