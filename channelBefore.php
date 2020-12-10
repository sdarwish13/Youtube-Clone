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
				  <h3>VIDEOS</h3>
				  <p>VIDEOS is the capital of France.</p> 
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