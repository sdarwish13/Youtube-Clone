<!DOCTYPE html>
<html> <!-- Home page after sign in/ sign up -->
    <head>
        <title>Youtube</title>
        <meta charset="UTF-8">
        <!-- <script src="home.js"></script> -->
        <link href="homeAfter.css" rel="stylesheet" type="text/css">
		
		
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
					error_reporting(0);
					$fname = $_REQUEST["fname"];
					$lname = $_REQUEST["lname"];
					$email = $_REQUEST["email"];
				
				?>
				
                <input type="button" id="vidImage" onclick="window.location.href='upload_vid.php?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?> '">
                <input type="button" id="gridImage">
                <input type="button" id="bellImage">
                <button id="profileImage">

				<?php
					print $fname[0];
					print $lname[0];
				?>

				</button>
            </div>
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
            $rows = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE private=0 ORDER BY RAND()");
        ?>
			
			<div id="displaythechannel">
			<button id="channelLogo"></button>
			<label id="marginfromtop">Channel Name</label>
			<label id="subscribercount">10k Subscribers</label>
				<div class="tab">
					<button class="tablelinks" id="defaultOpen" onclick="opencity(event, 'HOME')">HOME</button>
					<button class="tablelinks" onclick="opencity(event, 'VIDEOS')">VIDEOS</button>
					<button class="tablelinks" onclick="opencity(event, 'ABOUT')">ABOUT</button>
					
				</div>
				<div id="HOME" class="tabcontent">
				  <h3>HOME</h3>
				  <p>HOME is the capital city of England.</p>
				</div>
				<div id="VIDEOS" class="tabcontent">
				<!--	
				  <h3>VIDEOS</h3>
				  <p>VIDEOS is the capital of France.</p> 
				-->
				<?php
                foreach($rows as $row)
                {
                    $vid = $row["id"];
                    $chan = $row["channel"];
                    $channels = $db->query("SELECT * FROM Channel WHERE id=$chan");
                    foreach($channels as $channel)
                    {
                        ?>
                        <form action="watchvideo.php?fname=<?php echo $fname ?>&lname=<?php echo $lname ?>&email=<?php echo $email ?>&id=<?php echo $vid ?>" method="POST">
                            <button id="videoBtn" name="videoBtn">
                                <video id="watchVideo" width="100%">
                                    <source src="test_uploads/<?php echo $row["fileName"] ?>" type="video/mp4">
                                </video>
                                <div id="channelIm">
                                    <input type="button" id="channelImage">
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
                        </form>
                        <?php
                        if(isset($_POST["videoBtn"]))
                        {
                            echo $email;
                            // $acc = $db->query("SELECT * FROM Channel WHERE email=$email");
                            // $cid = $acc['id'];
                            $view = "INSERT INTO `Views` (`viewer`, `video`) VALUES (1, $vid);";
                            $db->exec($view);
                        }
                    }
                    
                }
            ?>
				</div>

				<div id="ABOUT" class="tabcontent">
				  <h3>ABOUT</h3>
				  <p>ABOUT is the capital of Japan.</p>
				</div>
			</div>
			<script>
			document.getElementById("defaultOpen").click();
			function opencity(evt, cityName) {
			  var i, tabcontent, tablinks;
			  tabcontent = document.getElementsByClassName("tabcontent");
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
			</script>
		


		
		
    </body>
</html>