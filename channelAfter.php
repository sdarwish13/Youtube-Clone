<!DOCTYPE html>
<html> <!-- Channel page after sign in/ sign up -->
    <head>
        <title>Youtube</title>
        <meta charset="UTF-8">
        <link href="channelAfter.css" rel="stylesheet" type="text/css">
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
					error_reporting(0);
					$fname = $_REQUEST["fname"];
					$lname = $_REQUEST["lname"];
					$email = $_REQUEST["email"];
                    $channelId = $_REQUEST["channelid"];

                    $myChans = $db->query("SELECT * FROM Channel WHERE owner='$email'");
                    foreach($myChans as $myChan)
                    {
                        $mychannelid = $myChan["id"];
                    }
				?>
				
                <input type="button" id="vidImage" onclick="window.location.href='upload_vid.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>'">
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
			
			<div id="displaythechannel">
                <?php
                $channels = $db->query("SELECT * FROM Channel WHERE id='$channelId'");
                foreach($channels as $channel)
                {  
                    ?>
                <button id="channelLogo">
                    <span style="font-size:xx-large;"><?= $channel["name"][0]?></span>
                </button>
                 
                    <div id="both">
                    <p id="marginfromtop"><?= $channel["name"]?></p>
                    <?php
                    $subs = $db->query("SELECT * FROM Subscription WHERE channel='$channelId'")->rowCount();
                    ?>
                    <p id="subscribercount"><?= $subs?> Subscribers</p>
                    </div>
                    <?php
                } 
                ?>
                
				<div class="tab">
					<button class="tablelinks" id="defaultOpen" onclick="opencity(event, 'HOME')">HOME</button>
					<button class="tablelinks" onclick="opencity(event, 'VIDEOS')">VIDEOS</button>
					<button class="tablelinks" onclick="opencity(event, 'ABOUT')">ABOUT</button>
                </div>
            </div>				  
            <div id="HOME" class="videos">
                <h3>HOME</h3>
                <?php
                $rows = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE private='0' AND channel='$channelId' ORDER BY RAND()");
                foreach($rows as $row)
                {
                    $vid = $row["id"];
                    $chan = $row["channel"];
                    $channels = $db->query("SELECT * FROM Channel WHERE id='$chan'");
                    foreach($channels as $channel)
                    {   
                    ?>
                        <button id="videoBtn" name="videoBtn" onclick="window.location.href='watchvideo.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>&id=<?= $vid?>'">
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
                                    $views = $db->query("SELECT * FROM Views WHERE video='$vid'")->rowCount();
                                ?>
                                <span><?php echo $views ?> views • </span>
                                <span><?php echo $row['upload_date'] ?></span>
                            </p>
                        </button>
                    
                    <?php
                    }                            
                }                    
                ?>
            </div>
                
            <div id="VIDEOS" class="videos">
                <h3>VIDEOS</h3>
                <?php
                $rows = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE private='0' AND channel='$channelId' ORDER BY upload_date DESC");
                foreach($rows as $row)
                {
                    $vid = $row["id"];
                    $chan = $row["channel"];
                    $channels = $db->query("SELECT * FROM Channel WHERE id='$chan'");
                    foreach($channels as $channel)
                    {   
                    ?>
                        <button id="videoBtn" name="videoBtn" onclick="window.location.href='watchvideo.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>&id=<?= $vid?>'">
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
                ?>
            </div>

            <div id="ABOUT" class="videos">
                <h3>ABOUT</h3>
                <?php
                $channels = $db->query("SELECT * FROM Channel WHERE id='$channelId'");
                foreach($channels as $channel)
                {   
                    ?>
                    <p><?php echo $channel["description"] ?></p>
                    <?php
                } 
                ?>
            </div>

            



			<script>
			document.getElementById("defaultOpen").click();
			function opencity(evt, cityName) {
			  var i, tabcontent, tablinks;
			  tabcontent = document.getElementsByClassName("videos");
			  for (i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			  }
			  tablinks = document.getElementsByClassName("tablinks");
			  for (i = 0; i < tablinks.length; i++) {
				tablinks[i].className = tablinks[i].className.replace(" active", "");
			  }
			  document.getElementById(cityName).style.display = "block";
			  evt.currentTarget.className += " active";
            }
            
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