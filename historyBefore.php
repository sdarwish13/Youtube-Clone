<!DOCTYPE html>
<html> <!-- History page before sign in/ sign up -->
    <head>
        <title>History Before</title>
        <meta charset="UTF-8">
        <link href="historyBefore.css" rel="stylesheet" type="text/css">
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
            <?php
                $db = new PDO("mysql:dbname=278project", "root","");
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
            <div id="buttons">
                <input type="button" id="vidImage" onclick="window.location.href = 'signin.php'">
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
                    <a href="Hsitory.html">
                        <img src="images/hist.png" alt="History Image">
                        <p>History</p>
                    </a>
                </li>
            </ul>
        </div>

        <div id="noSub">
            <img src="images/hist.png" alt="Sub Image">
            <h2>Keep track of what you watch</h2>
            <p>Watch history isn't viewable when you're signed out.</p>
            <a href="signin.php">
                <button id="signinBtn">SIGN IN</button> 
            </a>
        </div>
    </body>
</html>