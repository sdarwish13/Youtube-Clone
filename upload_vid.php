<!DOCTYPE html>

<html>
	<head>
		<title>Channel videos - Upload</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="upload_vid.css">
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
                <button id="buttonme">
					<i style="color:red;font-size:16px;" class="fa fa-upload"></i> Upload 
				</button>
                <input type="button" id="profileImage" value="<?php echo $fname['0']; echo $lname['0'];?>" onclick="openNav()">
			</div>
			
			<div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <hr>
                <input type="button" id="profileImage" name="details_sideNavImg" value="<?= $fname[0], $lname[0]?>" onclick="window.location.href='homeAfter.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>'">
                <span class="details_sideNav" onclick="window.location.href='homeAfter.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>'">Youtube Home</span>
                <br>
                <hr>
                <button id="details_sideNavImg_lang" value="" name="details_sideNavImg_lang" ></button>
                <span class="details_sideNav">Language: English</span>
                <br>
                <hr>
                <button id="details_sideNavImg_loc" value="" name="details_sideNavImg_loc" ></button>
                <span class="details_sideNav">Location: Lebanon</span>
                <hr>
            </div>
		</div>
		

		<div class="vertNav">
            <ul>
                <li>
                    <input type="button" id="profileImage" value="<?php echo $fname['0']; echo $lname['0'];?>">
				</li>
				<li id="urvidBtn">
                    <a href="upload_vid.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>">
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
                    <a href="analytics.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>">
                        <img src="images/analytics.png" alt="Analytics Image">
                        <p>Analytics</p>
                    </a>
                </li>
				
            </ul>
        </div>
		
		
		<div class="videos">
			<p id="channel_videos">Channel videos</p>
		
			
			<div id="sorting">
				<div id="checkboxvid">
					<label class="checkbox_vid">
						<input type="checkbox" name="checkvideos"/>Videos
					</label>
				</div>
				<div id="visibility">
					<span>Visibility</span>
				</div>
				<div id="restrictions">
					<span>Restrictions</span>
				</div>
				<div id="date">
					<span>Date</span>
				</div>
				<div id="views">
					<span>Views</span>
				</div>
				<div id="comments">
					<span>Comments</span>
				</div>
				<div id="likes">
					<span>Likes (vs. dislikes)</span>
				</div>
			</div>
			
			
				
				<?php
				
					$db = new PDO("mysql:dbname=278project", "root","");
					$sql =$db->query("SELECT id FROM Channel WHERE owner LIKE '%$email%'");
						foreach($sql as $row){
							$channel = $row["id"];
						};
					$rows = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video");
					foreach($rows as $row){
						$vid = $row["id"];
						if ($channel == $row["channel"]){
							$print_title = $row["title"];
							$print_description = $row["description"];
							if ($row["private"] == 1){
								$print_visibility = "Private";
							}elseif($row["private"] == 0){
								$print_visibility = "Public";
							}
							if ($row["restriction"] == 1){
								$print_restriction = "Yes";
							}elseif($row["restriction"] == 0){
								$print_restriction = "None";
							}
						   $print_date = $row["upload_date"];
						   $print_views = $db->query("SELECT * FROM Views WHERE video=$vid")->rowCount();
						   $print_comments = $db->query("SELECT * FROM VideoComment WHERE video=$vid")->rowCount();
						   $print_likes = $db->query("SELECT * FROM Likes WHERE video=$vid AND is_liked=1")->rowCount();
						   $print_dislikes = $db->query("SELECT * FROM Likes WHERE video=$vid AND is_liked=0")->rowCount();
							
							?>
								<div id="video_display">
									<div id="checkboxvid">
									<video width="100%" style="float:left;">
										<source src="test_uploads/<?php echo $row["fileName"] ?>" type="video/mp4">
									</video >
									</div>
									<div id="visibility">
										<span> <?php print "$print_visibility" ?> </span>
									</div>
									<div id="restrictions">
										<span> <?php print "$print_restriction" ?> </span>
									</div>
									<div id="date">
										<span> <?php print "$print_date" ?> </span>
									</div>
									<div id="views">
										<span><?= $print_views ?> Views</span>
									</div>
									<div id="comments">
										<span><?= $print_comments ?> Comments</span>
									</div>
									<div id="likes">
										<span><?= $print_likes ?> Likes/<?= $print_dislikes ?> dislikes</span>
									</div>
							</div>
							<?php
						
						}
					}
				
				?>
				
			
			
		</div>
		
			
				<!-- The Modal -->
				<div id="myModal" class="modal">

				  <!-- Modal content -->
				  <div class="modal-content">
						<div id="header">
							<p id="upload_vid_p">Upload videos</p>
							<span class="close">&times;</span>
							
						</div>
						<div id="upload_image_div">
							<img id="upload_image"style="height:75px;width:75px;"src="images/upload.png" alt="upload image">
							
							<p id="drag_drop_p">Drag and drop video files to upload</p>
							
							<p id="private_until_p">Your videos will be private until you publish them.</p>
							
							<!--<input type="file" id="actual-btn" hidden/>
							<label id="select_files" style="font-size:16px" for="actual-btn">SELECT FILES </label>
							<p id="donthaveanaccount">Dont have an account? <a href="upload_form.html">Sign up</a></p>
							-->
							
							<button id="select_files" style="font-size:16px" onclick="window.location.href='upload_form.php?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?> '">SELECT FILES </button>
							
							
							<p class="footer_p">By sumitting your videos to Youtube, you acknowledge that you agree to Youtube's <a href="https://www.youtube.com/t/terms">Term's Service </a>and  <a href="https://www.youtube.com/howyoutubeworks/policies/community-guidelines/">Community Guidelines.</a></p>
							
							<p class="footer_p">Please make sure that you do not violate others' copyright orr privacy rights. <a href="https://www.youtube.com/howyoutubeworks/policies/copyright/">Learn more</a></p>
						</div>
					
				  	</div>

				</div>

		
		
		
			<script>
			// Get the modal
			var modal = document.getElementById("myModal");

			// Get the button that opens the modal
			var btn = document.getElementById("buttonme");

			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("close")[0];

			// When the user clicks the button, open the modal 
			btn.onclick = function() {
			  modal.style.display = "block";
			}

			// When the user clicks on <span> (x), close the modal
			span.onclick = function() {
			  modal.style.display = "none";
			}

			// When the user clicks anywhere outside of the modal, close it
			window.onclick = function(event) {
			  if (event.target == modal) {
				modal.style.display = "none";
			  }
			}
			
			function openwindow(){
				window.open("upload_form.html", "_self");
			}

			function myFunction() {
			var popup = document.getElementById("myPopup");
			popup.classList.toggle("show");
			}
		
			function openNav() {
			document.getElementById("mySidenav").style.width = "250px";
			}

			function closeNav() {
			document.getElementById("mySidenav").style.width = "0";
			}
			function closeNav2() {
			document.getElementById("mySidenav2").style.width = "0";
			}
			function openNav2() {
				document.getElementById("mySidenav2").style.width = "250px";
			}

			</script>
		
		
	</body>
</html>