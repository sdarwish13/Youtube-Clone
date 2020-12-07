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
                <input type="button" id="vidImage" onclick="window.location.href='upload_vid.php'">
                <input type="button" id="gridImage">
                <input type="button" id="bellImage">
                <button id="profileImage">
<<<<<<< HEAD
=======
				<?php
					$input = $_COOKIE;
					print $input["fname"][0];
					print $input["lname"][0];
				?>
>>>>>>> 64fee5324a6fe98d3faa6b21f342ce6e17e4379e
				</button>
            </div>
        </div>

        <div class="vertNav">
            <ul>
                <li id="homeBtn">
                    <a href="homeAfter.php">
                        <img src="images/home.png" alt="Home Image">
                        <p>Home</p>
                    </a>
                </li>
                <li id="subBtn">
                    <a href="subAfter.php">
                        <img src="images/sub.png" alt="Sub Image">
                        <p>Subscriptions</p>
                    </a>
                </li>
                <li id="libBtn">
                    <a href="home.html">
                        <img src="images/lib.png" alt="Library Image">
                        <p>Library</p>
                    </a>
                </li>
                <li id="historyBtn">
                    <a href="home.html">
                        <img src="images/hist.png" alt="History Image">
                        <p>History</p>
                    </a>
                </li>
                <li id="urvidBtn">
                    <a href="home.html">
                        <img src="images/ur vid.png" alt="Your Vid Image">
                        <p>Your Videos</p>
                    </a>
                </li>
                <li id="laterBtn">
                    <a href="home.html">
                        <img src="images/later.png" alt="Later Image">
                        <p>Watch Later</p>
                    </a>
                </li>
            </ul>
        </div>

        <?php
            $db = new PDO("mysql:dbname=278project", "root","");
            $rows = $db->query("SELECT * FROM Video ORDER BY RAND()");
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
                    <button class="videoBtn" onClick="window.location.href='watchvideo.php?id=<?php echo $vid ?>'">
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
                    <?php
                    }
                }
            ?>
        </div>
    </body>
</html>