<!DOCTYPE html>
<html> <!-- Home page before sign in/ sign up -->
    <head>
        <title>Youtube</title>
        <meta charset="UTF-8">
        <link href="homeBefore.css" rel="stylesheet" type="text/css">
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
                    <a href="subBefore.html">
                        <img src="images/sub.png" alt="Sub Image">
                        <p>Subscriptions</p>
                    </a>
                </li>
                <li id="libBtn">
                    <a href="lib_before.html">
                        <img src="images/lib.png" alt="Library Image">
                        <p>Library</p>
                    </a>
                </li>
                <li id="historyBtn">
                    <a href="History.html">
                        <img src="images/hist.png" alt="History Image">
                        <p>History</p>
                    </a>
                </li>
            </ul>
        </div>

        <?php
            $db = new PDO("mysql:dbname=278project", "root","");
            $rows = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE private=0 ORDER BY RAND()");
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
                    <button id="videoBtn" onclick="window.location.href = `watchvideo.php?id=<?php echo $row['id'] ?>`">
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