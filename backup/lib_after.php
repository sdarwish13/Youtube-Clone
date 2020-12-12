<!DOCTYPE html>
<html> <!-- Library page after sign in/ sign up -->
    <head>
        <title>Library - Youtube</title>
        <meta charset="UTF-8">
        <link href="lib_after.css" rel="stylesheet" type="text/css">
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
                
                <input type="button" id="vidImage" onclick="window.location.href = 'upload_vid.php?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?>'">
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
                <li id="homeBtn" onclick="window.location.href = 'homeAfter.php?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?>'">
                    <img src="images/home.png" alt="Home Image">
                    <p>Home</p>
                </li>
                <li id="subBtn" onclick="window.location.href = 'subAfter.php?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?>'">
                    <img src="images/sub.png" alt="Sub Image">
                    <p>Subscriptions</p>
                </li>
                <li id="libBtn" onclick="window.location.href = 'lib_after.php?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?>'">
                    <img src="images/lib.png" alt="Library Image">
                    <p>Library</p>
                </li>
                <li id="historyBtn" onclick="window.location.href = 'History.html?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?>'">
                    <img src="images/hist.png" alt="History Image">
                    <p>History</p>
                </li>
                <li id="urvidBtn" onclick="window.location.href = 'upload_vid.php?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?>'">
                    <img src="images/ur vid.png" alt="Your Vid Image">
                    <p>Your Videos</p>
                </li>
                <li id="laterBtn" onclick="window.location.href = 'later.html?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?>'">
                    <img src="images/later.png" alt="Later Image">
                    <p>Watch Later</p>
                </li>
            </ul>
        </div>

        <?php
            $db = new PDO("mysql:dbname=278project", "root","");
            $rows = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE private=0");
            $rows0 = $db->query("SELECT * FROM Channel WHERE owner='$email'");
            $rows01 = $db->query("SELECT * FROM Channel WHERE owner='$email'");

        ?>

        <div class="videos">
            <div id="subWrap">
                <div id="head">
                    <img src="images/libHist.png" alt="History Image" id="histImg">
                    <h3>History</h3>
                    <p id="all"><a href="History.html?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?>">SEE ALL</a></p>

                </div>
                <div id="center">
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
                                    <button id="videoBtn" onclick="window.location.href = `watchvideo.php?fname=<?php echo $fname ?>&lname=<?php echo $lname ?>&email=<?php echo $email ?>&id=<?php echo $vid ?>`">
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

            <div id="subWrap">
                <div id="head">
                    <img src="images/libLater.png" alt="History Image" id="histImg">
                    <h3>Watch Later</h3>
                    <p id="all"><a href="later.php?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?>">SEE ALL</a></p>
                </div>
                <div id="center">
                <?php
                    foreach($rows01 as $row)
                    {
                        $sar = $row["id"];
                        $rows1 = $db->query("SELECT * FROM WatchLater WHERE viewer=$sar");
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
                                    <button id="videoBtn" onclick="window.location.href = `watchvideo.php?fname=<?php echo $fname ?>&lname=<?php echo $lname ?>&email=<?php echo $email ?>&id=<?php echo $vid ?>`">
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

            <div id="subWrap">
                <div id="head">
                    <img src="images/libPlaylist.png" alt="History Image" id="histImg">
                    <h3>Playlists</h3>
                    <p id="all"><a href="History.html?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?>">SEE ALL</a></p>
                </div>
                <div id="center">
                    <button>
                        <img src="images/thumbnail.jpeg" alt="Video Thumbnail">
                        <h4>WhatsApp</h4>
                    </button>
                    <button>
                        <img src="images/thumbnail.jpeg">
                        <h4>AUST</h4>
                    </button>
                    <button>
                        <img src="images/thumbnail.jpeg">
                        <h4>Facebook</h4>
                    </button>
                    <button>
                        <img src="images/thumbnail.jpeg">
                        <h4>Gmail</h4>
                    </button>
                    <button>
                        <img src="images/thumbnail.jpeg">
                        <h4>Youtube</h4>
                    </button>
                    <button>
                        <img src="images/thumbnail.jpeg">
                        <h4>LinkedIn</h4>
                    </button>
                    <button>
                        <img src="images/thumbnail.jpeg">
                        <h4>Ogero</h4>
                    </button>
                    <button>
                        <img src="images/thumbnail.jpeg">
                        <h4>Duolingo</h4>
                    </button>
                    <button>
                        <img src="images/thumbnail.jpeg">
                        <h4>Outlook</h4>
                    </button>
                    <button>
                        <img src="images/thumbnail.jpeg">
                        <h4>Outlook</h4>
                    </button>
                </div>
            </div>
        </div>

    </body>
</html>