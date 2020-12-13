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
                <form action="" method="post">
                    <input type="text" id="searchText" name="searchinput" placeholder="Search" onclick="window.location.href='homeAfter.php?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?> '">
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
			error_reporting(0);
            $db = new PDO("mysql:dbname=278project", "root","");
			if (empty($_POST["searchinput"])){
				$searchinput = $_POST["searchinput"];
				$rows = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE private=0 ORDER BY RAND()");				
			}else{
				$searchinput = $_POST["searchinput"];
				$rows = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE private=0 AND title = '$searchinput'");
			}
        ?>
        <div class="videos">
            <?php
                foreach($rows as $row)
                {
                    $vid = $row["id"];
                    $chan = $row["channel"];
                    $channels = $db->query("SELECT * FROM Channel WHERE id=$chan");
                    foreach($channels as $channel)
                    {
                        ?>
                        <button id="videoBtn" onclick="window.location.href = `watchvideo.php?fname=<?php echo $fname ?>&lname=<?php echo $lname ?>&email=<?php echo $email ?>&id=<?php echo $vid ?>`">
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
    </body>
</html>