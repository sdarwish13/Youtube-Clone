<!DOCTYPE html>
<html> <!--  History page after sign in/ sign up -->
    <head>
        <title> History Page - Youtube</title>
        <meta charset="UTF-8">
        <!-- <script src="home.js"></script> -->
        <link href="History.css" rel="stylesheet" type="text/css">
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
                <a href="upload_vid.html" id="upload">
                    <input type="button" id="vidImage" onclick="window.location.href = ''">
                </a>
                <input type="button" id="gridImage">
                <input type="button" id="bellImage">
                <button id="profileImage" onclick="openNav()">

				<?php
					print $fname[0];
					print $lname[0];
				?>

				</button>
            </div>
        </div>

        <div class="vertNav">
            <ul>
                <li id="homeBtn" onclick="window.location.href = ''">
                    <a href="homeAfter.html">
                        <img src="images/home.png" alt="Home Image">
                        <p>Home</p>
                    </a>
                </li>
                <li id="subBtn" onclick="window.location.href = ''">
                    <a href="subAfter.html">
                        <img src="images/sub.png" alt="Sub Image">
                        <p>Subscriptions</p>
                    </a>
                </li>
                <li id="libBtn" onclick="window.location.href = ''">
                    <a href="home.html">
                        <img src="images/lib.png" alt="Library Image">
                        <p>Library</p>
                    </a>
                </li>
                <li id="historyBtn" onclick="window.location.href = ''">
                    <a href="home.html">
                        <img src="images/hist.png" alt="History Image">
                        <p>History</p>
                    </a>
                </li>
                <li id="urvidBtn" onclick="window.location.href = ''">
                    <a href="home.html">
                        <img src="images/ur vid.png" alt="Your Vid Image">
                        <p>Your Videos</p>
                    </a>
                </li>
                <li id="laterBtn" onclick="window.location.href = ''">
                    <a href="home.html">
                        <img src="images/later.png" alt="Later Image">
                        <p>Watch Later</p>
                    </a>
                </li>
            </ul>
        </div>

        <?php
            $db = new PDO("mysql:dbname=278project", "root","");
            $rows = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE private=0");
            $rows0 = $db->query("SELECT * FROM Channel WHERE owner='$email'");
            $rows01 = $db->query("SELECT * FROM Channel WHERE owner='$email'");
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
                                    <input type="button" id="channelImage">
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
        <!-- <div id="laterVids">
            <button>
                <img src="images/videoimg.jpg" alt="Video Thumbnail">
                <div id="vidDetails">
                    <h2> Video title</h2>     
                    <span class="desWatchLater">
                        Youtuber name  
                        &bull;  
                        1.2M
                        <br>
                        <br>
                        Decription: kdwkcdkncoienci 
                    </span>          
                </div>
            </button>
            <button>
                <img src="images/videoimg.jpg" alt="Video Thumbnail">
                <div id="vidDetails">
                    <h2> Video title</h2>     
                    <span class="desWatchLater">
                        Youtuber name  
                        &bull;  
                        1.2M
                        <br>
                        <br>
                        Decription: kdwkcdkncoienci 
                    </span>          
                </div>
            </button>
            <button>
                <img src="images/videoimg.jpg" alt="Video Thumbnail">
                <div id="vidDetails">
                    <h2> Video title</h2>     
                    <span class="desWatchLater">
                        Youtuber name  
                        &bull;  
                        1.2M
                        <br>
                        <br>
                        Decription: kdwkcdkncoienci 
                    </span>          
                </div>
            </button>
            <button>
                <img src="images/videoimg.jpg" alt="Video Thumbnail">
                <div id="vidDetails">
                    <h2> Video title</h2>     
                    <span class="desWatchLater">
                        Youtuber name  
                        &bull;  
                        1.2M
                        <br>
                        <br>
                        Decription: kdwkcdkncoienci 
                    </span>          
                </div>
            </button>
            <button>
                <img src="images/videoimg.jpg" alt="Video Thumbnail">
                <div id="vidDetails">
                    <h2> Video title</h2>     
                    <span class="desWatchLater">
                        Youtuber name  
                        &bull;  
                        1.2M
                        <br>
                        <br>
                        Decription: kdwkcdkncoienci 
                    </span>          
                </div>
            </button>
            <button>
                <img src="images/videoimg.jpg" alt="Video Thumbnail">
                <div id="vidDetails">
                    <h2> Video title</h2>     
                    <span class="desWatchLater">
                        Youtuber name  
                        &bull;  
                        1.2M
                        <br>
                        <br>
                        Decription: kdwkcdkncoienci 
                    </span>          
                </div>
            </button>
            <button>
                <img src="images/videoimg.jpg" alt="Video Thumbnail">
                <div id="vidDetails">
                    <h2> Video title</h2>     
                    <span class="desWatchLater">
                        Youtuber name  
                        &bull;  
                        1.2M
                        <br>
                        <br>
                        Decription: kdwkcdkncoienci 
                    </span>          
                </div>
            </button>
            <button>
                <img src="images/videoimg.jpg" alt="Video Thumbnail">
                <div id="vidDetails">
                    <h2> Video title</h2>     
                    <span class="desWatchLater">
                        Youtuber name  
                        &bull;  
                        1.2M
                        <br>
                        <br>
                        Decription: kdwkcdkncoienci 
                    </span>          
                </div>
            </button>
            <button>
                <img src="images/videoimg.jpg" alt="Video Thumbnail">
                <div id="vidDetails">
                    <h2> Video title</h2>     
                    <span class="desWatchLater">
                        Youtuber name  
                        &bull;  
                        1.2M
                        <br>
                        <br>
                        Decription: kdwkcdkncoienci 
                    </span>          
                </div>
            </button>
            <button>
                <img src="images/videoimg.jpg" alt="Video Thumbnail">
                <div id="vidDetails">
                    <h2> Video title</h2>     
                    <span class="desWatchLater">
                        Youtuber name  
                        &bull;  
                        1.2M
                        <br>
                        <br>
                        Decription: kdwkcdkncoienci 
                    </span>          
                </div>
            </button>
        </div> -->
        <div id="historyInfo">
            <br>  
            <button id="searchBtnHis">
                <img src="images/search logo.png" alt="Search">
            </button> 
            <input type="text" placeholder="Search watch history..." class="searchHistory">
            <br>
            <br>
            <button id="clearHisBtn">
                <h2>
                    CLEAR ALL WATCH HISTORY
                </h2>
            </button>
        </div>

    </body>
</html>