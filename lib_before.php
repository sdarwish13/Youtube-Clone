<!DOCTYPE html>
<html> <!-- Library page before sign in/ sign up -->
    <head>
        <title>Youtube</title>
        <meta charset="UTF-8">
        <link href="lib_before.css" rel="stylesheet" type="text/css">
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
                <button id="signinBtn" onclick="window.location.href = 'signin.php'">SIGN IN</button> 
            </div>
        </div>

        <div class="vertNav">
            <ul>
                <li id="homeBtn" onclick="window.location.href = 'homeBefore.php'">
                    <img src="images/home.png" alt="Home Image">
                    <p>Home</p>
                </li>
                <li id="subBtn" onclick="window.location.href = 'subBefore.php'">
                    <img src="images/sub.png" alt="Sub Image">
                    <p>Subscriptions</p>
                </li>
                <li id="libBtn" onclick="window.location.href = 'lib_before.php'">
                    <img src="images/lib.png" alt="Library Image">
                    <p>Library</p>
                </li>
                <li id="historyBtn" onclick="window.location.href = 'historyBefore.php'">
                    <img src="images/hist.png" alt="History Image">
                    <p>History</p>
                </li>
            </ul>
        </div>

        <div id="noLib">
            <img src="images/lib.png" alt="Lib Image">
            <h2>Enjoy your favourite videos</h2>
            <p>Sign in to see updates from your favourite YouTube channels</p>
            <button id="signinBtn" onclick="window.location.href = 'signin.php'">SIGN IN</button> 
        </div>
    </body>
</html>