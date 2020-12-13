<!DOCTYPE html>
<html> <!-- Channel page before sign in/ sign up -->
    <head>
        <title>Youtube</title>
        <meta charset="UTF-8">
        <link href="channelBefore.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="horizNav">
            <div id="youtubelogo">
                <img src="images/youtube logo.png" alt="youtube logo" id="logo">
            </div>
            <div id="searchBox">
                <form action="" method="post">
                    <input type="text" id="searchText" name="searchinput" placeholder="Search" onclick="window.location.href='homeBefore.php'">
                    <button id="searchBtn">
                        <img src="images/search logo.png" alt="Search">
                    </button>
                </form>
                
            </div>
            <div id="buttons">
                <input type="button" id="vidImage" onclick="window.location.href='signin.php'">
                <input type="button" id="gridImage">
                <input type="button" id="settingsImage">
                <a href="signin.php">
                    <button id="signinBtn">SIGN IN</button> 
                </a>
            </div>
        </div>

        <div class="vertNav">
            <ul>
                <li id="homeBtn">
                    <a href="homeBefore.php">
                        <img src="images/home.png" alt="Home Image">
                        <p>Home</p>
                    </a>
                </li>
                <li id="subBtn">
                    <a href="subBefore.php">
                        <img src="images/sub.png" alt="Sub Image">
                        <p>Subscriptions</p>
                    </a>
                </li>
                <li id="libBtn">
                    <a href="lib_before.php">
                        <img src="images/lib.png" alt="Library Image">
                        <p>Library</p>
                    </a>
                </li>
                <li id="historyBtn">
                    <a href="historyBefore.php">
                        <img src="images/hist.png" alt="History Image">
                        <p>History</p>
                    </a>
                </li>
            </ul>
        </div>

		 <?php
            $db = new PDO("mysql:dbname=278project", "root","");
            $rows = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE private=0 ORDER BY RAND()");
            $channelId = $_REQUEST["channelid"];

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
                        <button id="videoBtn" name="videoBtn" onclick="window.location.href='watchvideoBefore.php?id=<?= $vid?>'">
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
                        <button id="videoBtn" name="videoBtn" onclick="window.location.href='watchvideoBefore.php?id=<?= $vid?>'">
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
			</script>
		
    </body>

</html>