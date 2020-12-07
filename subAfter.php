<!DOCTYPE html>
<html> <!-- Subscription page after sign in/ sign up -->
    <head>
        <title>Subscriptions - Youtube</title>
        <meta charset="UTF-8">
        <!-- <script src="home.js"></script> -->
        <link href="subAfter.css" rel="stylesheet" type="text/css">
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
                <input type="button" id="vidImage">
                <input type="button" id="gridImage">
                <input type="button" id="bellImage">
                <input type="button" id="profileImage">
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
                    <a href="lib_after.html">
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
                <li id="urvidBtn">
                    <a href="upload_vid.php">
                        <img src="images/ur vid.png" alt="Your Vid Image">
                        <p>Your Videos</p>
                    </a>
                </li>
                <li id="laterBtn">
                    <a href="later.html">
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
                    $rows = $db->query("SELECT *, DATE_FORMAT(upload_date , '%Y-%m-%d') AS upload_date FROM Video ORDER BY DATE_FORMAT(upload_date , '%Y-%m-%d %h-%i-%s') ASC");
                    $rows2 = $db->query("SELECT *, DATE_FORMAT(upload_date , '%Y-%m-%d') AS upload_date FROM Video ORDER BY DATE_FORMAT(upload_date , '%Y-%m-%d %h-%i-%s') DESC");
                ?>
                
                <div id="center">
                    <h3>Today</h3>
                    <?php
                        
                        foreach($rows as $row)
                        {
                            if($row['upload_date']==date("Y-m-d"))
                            {
                                ?>
                                <button onclick="window.location.href = `watchvideo.php?id=<?php echo $row['id'] ?>`">
                                    <video id="watchVideo" width="100%">
                                        <source src="test_uploads/<?php echo $row["fileName"] ?>" type="video/mp4">
                                    </video>
                                    <h4><?php echo $row["title"] ?></h4>
                                </button>
                                <?php
                            }
                        }
                        ?>
                        <h3>Older</h3>
                        <?php
                        foreach($rows2 as $row)
                        {
                            if($row['upload_date']!=date("Y-m-d"))
                            {
                                ?>
                                <button onclick="window.location.href = `watchvideo.php?id=<?php echo $row['id'] ?>`">
                                    <video id="watchVideo" width="100%">
                                        <source src="test_uploads/<?php echo $row["fileName"] ?>" type="video/mp4">
                                    </video>
                                    <h4><?php echo $row["title"] ?></h4>
                                </button>
                                <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>