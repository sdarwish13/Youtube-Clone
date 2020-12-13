<!DOCTYPE html>

<html>
	<head>
		<title>Channel videos - Upload</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="analytics.css">
	</head>
	
	<body id="body">

		<div class="horizNav">
            <div id="youtubelogo">
                <img src="images/youtube studio.png" alt="youtube logo" id="logo">
            </div>
            <div id="searchBox">
                <form>
                    <img src="images/search logo.png" alt="Search">
                    <input type="text" id="searchText" placeholder="Search">
				</form>
            </div>
            <div id="buttons">
				<?php
				
					$fname = $_REQUEST["fname"];
					$lname = $_REQUEST["lname"];
					$email = $_REQUEST["email"];
				
				?>
                <input type="button" id="profileImage" value="<?php echo $fname['0']; echo $lname['0']; ?>">
            </div>
		</div>
		

		<div class="vertNav">
            <ul>
                <li>
                    <input type="button" id="profileImage" value="<?php echo $fname['0']; echo $lname['0']; ?>">
				</li>
				<li id="urvidBtn">
                    <a href="upload_vid.php?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?>">
                        <img src="images/ur vid.png" alt="Your Vid Image">
                        <p>Your Videos</p>
                    </a>
                </li>
                <li id="playlistBtn">
                    <a href="playlists.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>">
                        <img src="images/playlist.png" alt="Playlist Image">
                        <p>Playlists</p>
                    </a>
                </li>
				<li id="analyticsBtn">
                    <a href="home.html">
                        <img src="images/analytics.png" alt="Analytics Image">
                        <p>Analytics</p>
                    </a>
                </li>
            </ul>
        </div>
		
		
		<div class="videos">
			<p id="channel_videos">Channel Analytics</p>
		
			
			<div id="sorting">
				<div id="checkboxvid">
					<label class="checkbox_vid">
						<input type="checkbox" name="checkvideos"/>Videos
					</label>
				</div>
				<div id="views">
					<span>Total number of Views</span>
				</div>
			</div>
			
			
				
				<?php
					$videosarray = array();
					$db = new PDO("mysql:dbname=278project", "root","");
					$sql =$db->query("SELECT id FROM Channel WHERE owner LIKE '%$email%'");
						foreach($sql as $row){
							$channel = $row["id"];
						};
					$rows = $db->query("SELECT * FROM Video");
					foreach($rows as $row){
						$videochannel = $row["id"];
						$views1 = $db->query("SELECT * FROM Views WHERE video='$videochannel'")->rowCount();
								$videosarray[$videochannel] = $views1;
								$themax = array_search(max($videosarray),$videosarray);
								$theview = max($videosarray);
								
							?>
							<?php
						}
						
				?>
					<?php
						
						foreach($videosarray as $displaying){
							$themax = array_search(max($videosarray),$videosarray);
							$theview = max($videosarray);
							$rows = $db->query("SELECT * FROM Video WHERE id='$themax'");
							foreach($rows as $row){
								?>
								<div id="video_display">
									<div id="checkboxvid">
									<video width="100%" style="float:left;">
										<source src="test_uploads/<?php echo $row["fileName"] ?>" type="video/mp4">
									</video >
									</div>
									
									<div id="views">
										<span><?= $theview ?> Views</span>
									</div>
									
							</div>
							<?php 
						}
						unset($videosarray[$themax]);
					}
					?>
				
			
			
		</div>
		
			
		
		
	</body>
</html>