<!DOCTYPE html>
<html>

    <head>
        <title>Youtube Watch Video</title>
        <meta charset="UTF-8">
        <link href="watchvideo.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="horizNav">
            <div id="youtubelogo">
                <img src="images/youtube logo.png" alt="youtube logo" id="logo">
            </div>
            <div id="searchBox">
                <form action="" method="post">
                    <input type="text" id="searchText" name="searchinput" placeholder="Search" onclick="window.location.href='homeAfter.php?fname=<?= $fname?>&lname=<?= $lname?>&email=<?= $email?>'">
                    <button id="searchBtn">
                        <img src="images/search logo.png" alt="Search">
                    </button>
                </form>
                
            </div>
            <?php
                    $db = new PDO("mysql:dbname=278project", "root","");
                    
                    $fname = $_REQUEST["fname"];
                    $lname = $_REQUEST["lname"];
                    $email = $_REQUEST["email"];
                    $vid_id_link = $_REQUEST["id"];

                    $emailLinks = $db->query("SELECT * FROM `Channel` WHERE owner='$email'");
                    $id_linked="";
                    foreach($emailLinks as $emailLink){
                        $id_linked = $emailLink["id"];
                    }

                    $testing62s = $db->query("SELECT * FROM `Views` WHERE video !='$vid_id_link' ");
                    foreach($testing62s as $testing62){
                        $vid21=$testing62["video"];
                        if( $vid21 != $vid_id_link){
                            $view23 = "INSERT INTO `Views` (`viewer`, `video`) VALUES ('$id_linked ', '$vid_id_link')";
                            $db->exec($view23);
                        }
                        else{
                            echo " success!!!!!!!!!1";
                        }
                    }

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
                <input type="button" id="vidImage" onclick="window.location.href='upload_vid.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>'">
                <input type="button" id="gridImage" onclick="openNav2()">
                <input type="button" id="bellImage">
                <button id="profileImage" onclick="openNav()">

				<?php
					print $fname[0];
					print $lname[0];
				?>

				</button>
            </div>
           
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <hr>
                <input type="button" id="profileImage" name="details_sideNavImg" value="<?= $fname[0], $lname[0]?>" onclick="window.location.href='channelAfter.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>&channelid=<?= $mychannelid?>'">
                <span class="details_sideNav" onclick="window.location.href='channelAfter.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>&channelid=<?= $mychannelid?>'">Your Channel</span>
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
            <div id="mySidenav2" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav2()">&times;</a>
                <hr>
                <button id="details_sideNavImg1" value="" name="details_sideNavImg1" ></button>
                <span class="details_sideNav"  > YouTube Tv</span>
                <br>
                <hr>
                <button id="details_sideNavImg2" value="" name="details_sideNavImg2" ></button>
                <span class="details_sideNav" >YouTube Music</span>
                <br>
                <hr>
                <button id="details_sideNavImg3" value="" name="details_sideNavImg3"></button>
                <span class="details_sideNav"   > YouTube Kids</span>
                <hr>
            </div>
        </div>

        <div id="box">
            <div id="upNext">

                <span class="upNexttxt">
                    Up next 
                </span>

                <ul>
                    <?php
                        $rows6 = $db->query("SELECT * FROM Video WHERE id != '$vid_id_link'");
                        $varChannelIds= $db->query("SELECT channel FROM Video");
 
                        foreach($rows6 as $row6)
                        {   
                            $vid = $row6["id"];
                            ?>

                        <li>
                        <div id="details"> 
                            <video id="detailsImg" onclick="window.location.href = `watchvideo.php?fname=<?php echo $fname ?>&lname=<?php echo $lname ?>&email=<?php echo $email ?>&id=<?php echo $vid ?>`" >
                                <source src="test_uploads/<?php echo $row6["fileName"] ?>" type="video/mp4">
                            </video>    
                            <h3 id="test"> <?php echo $row6["title"] ?> </h3>
                            <?php 

                                foreach($varChannelIds as $varChannelId)
                                {
                                    $ID = $varChannelId["channel"];
                                    $rows7 = $db->query("SELECT name FROM Channel WHERE id='$ID'  ");
                                    foreach($rows7 as $row7)
                                    {
                                        ?>
                                        <h5><?php echo $row7["name"] ?></h5>
                                        <?php
                                    }
                                break;
                                }
                                $chan = $row6["channel"];
                                $channels = $db->query("SELECT * FROM Channel WHERE id='$chan'");
                                foreach($channels as $channel)
                                {
                                    $vid = $row6["id"];
                                    $dateVids = $row6["upload_date"];
                                    $views = $db->query("SELECT * FROM Views WHERE video='$vid'")->rowCount();
                                    ?>
                                    <h5><?php echo $views ?> views 
                                    &bull;
                                    <?php echo $dateVids ?>
                                    </h5>
                                <?php
                                }
                            ?>
                        </div>
                    </li>
                    <?php
                        }
                    ?>     
                </ul>
            </div>
            <div id="videoBox">
                <div>
                        <?php
                            //des and title and video playback
                            $rows = $db->query("SELECT * FROM Video WHERE id='$vid_id_link' ");
                            $des ="";
                            $vidTitle="";
                            foreach($rows as $row){
                                ?>
                                    <video id="watchVideo" controls>
                                        <source src="test_uploads/<?php echo $row["fileName"] ?>" type="video/mp4">
                                    </video>
                                <?php
                                $des = $row["description"];
                                $vidTitle= $row["title"];
                                $channelId=$row["channel"];
                                $vidDate = $row["upload_date"];
                            } 

                            //for likes and dislikes
                            if(isset($_POST['likeImage'])) {

                                $insertlikes1 = $db->query("SELECT * FROM `Likes` WHERE `viewer` = '$id_linked' AND `video`='$vid_id_link' ");
                                foreach($insertlikes1 as $insertlike1 ){
                                     $sqlLike = "UPDATE `Likes` SET is_liked='1' WHERE `viewer` = '$id_linked' AND `video`='$vid_id_link'  ";
                                     $db->exec($sqlLike);
                                }

                                $sqlLike12="INSERT INTO `Likes` (`viewer`, `video`, `is_liked`) VALUES ('$id_linked', '$vid_id_link', '1');";
                                $db->exec($sqlLike12);
                              
                            };
                            if(isset($_POST['dislikeImage'])) {
                               
        
                                $insertdislikes1 = $db->query("SELECT * FROM `Likes` WHERE `viewer` = '$id_linked' AND `video`='$vid_id_link' ");
                                foreach($insertdislikes1 as $insertdislike1 ){
                                    $sqlDislike = "UPDATE `Likes` SET is_liked='0' WHERE video=$vid_id_link AND viewer=$id_linked ";
                                    $db->exec($sqlDislike);

                                }
                                $sqldisLike12="INSERT INTO `Likes` (`viewer`, `video`, `is_liked`) VALUES ('$id_linked', '$vid_id_link', '0');"; 
                                $db->exec($sqldisLike12);
                            };

                            //to display dislikes 
                            $rows12 = $db->query("SELECT is_liked FROM Likes WHERE video='$vid_id_link'");
                            $countDislikes=0; //dislikes count
                            foreach($rows12 as $row12){
                                if( $row12["is_liked"] == 0){
                                    $countDislikes++;
                                }
                            };
                            //to display likes 
                            $rows1 = $db->query("SELECT is_liked FROM Likes WHERE video='$vid_id_link' ");
                            $countLikes =0; //likes count
                            foreach($rows1 as $row1){
                                if( $row1["is_liked"] == 1 ){
                                        $countLikes++;
                                }
                            };
                            #for channel name ( tuber name)
                            $rows2 = $db->query("SELECT name FROM Channel WHERE id='$channelId'");
                            $tuberName="";
                            foreach($rows2 as $row2){
                                $tuberName = $row2["name"];
                            };

                            #for subscribers( sub count)
                            $rows3 = $db->query("SELECT subscriber FROM Subscription WHERE channel='$channelId'");
                            $subsCount=0;
                            foreach($rows3 as $row3){
                                $subsCount++;
                            };

                            #for comment count
                            $rows4 = $db->query("SELECT * FROM VideoComment WHERE video='$vid_id_link'  ");
                            $CommentCount=0;
                            $varCommentid=0;
                            foreach($rows4 as $row4){
                                $CommentCount++;
                               
                               
                            };       
                            #display video views
                            $rows8 = $db->query("SELECT * FROM Views WHERE video='$vid_id_link'  ");
                            $viewsCount=0;
                                foreach($rows8 as $row8){
                                    $viewsCount++;
                            };
                            ?>
                </div>
                <h2 class="vidTitle"> <?= $vidTitle?> </h2>

                <div id="viewCount">
                    <?= $viewsCount?> views 
                        &nbsp;
                        &bull;
                        <?= $vidDate ?>
                </div>

                <div id="likeMenu">
                    <form action="" method="post" id="formLike"  > 
                    <button id="likeImage" value="likeImage" name="likeImage" ></button>
                    <span class="likes"> <?=$countLikes?> </span>
                    <button id="dislikeImage"  value="dislikeImage" name="dislikeImage"></button>
                    <span class="likes"> <?=$countDislikes?> </span>
                    </form>
                    <button id="shareImage" ></button>
                    <span class="likes"> SHARE </span>
                    <button id="saveImage"></button>
                    <span class="likes"> SAVE </span>
                    <!-- onclick report -->
                    <button id="dotsImage" onclick="myFunction()" class="popup">
                    <form action="" method="post">
                    <div> 
                        <span class="popuptext" id="myPopup">
                        <ul id="reportList">
                            
                                <li> <input type="submit" placeholder="Report" value="Report" id="reportBtn" name="reportBtn" > </li>
                        </ul>
                        </span>
                    </div>
                    </button> 

                </div>
                <?php
                     if (isset($_POST['reportBtn'])){
                         $report = "INSERT INTO `Report` (`reporter`, `video`) VALUES ('$id_linked ', '$vid_id_link')";
                         $db->exec( $report);  
                     }
                    ?>
                </form>

                <div id="myModal" class="modal">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <p>Share</p>
                        <div class="scrollHoriz">

                        <button id="iconButton">
                        <img id="iconImages"src="images/facebookIcon.png" alt="Avatar" style="width:70px" onclick="window.location.href='https://www.facebook.com/';">
                        <br>
                        <span> Facebook</span>
                        </button>

                        <button id="iconButton">
                        <img id="iconImages"src="images/twitterIcon.png"alt="Avatar" style="width:70px" onclick="window.location.href='https://twitter.com/';">
                        <br>
                        <span> Twitter</span>
                        </button>

                        <button id="iconButton">
                        <img id="iconImages"src="images/tumblricon.png"alt="Avatar" style="width:70px" onclick="window.location.href='https://www.tumblr.com/';">
                        <br>
                        <span> Tumblr</span>
                        </button>

                        <button id="iconButton">
                        <img id="iconImages"src="images/email.png"alt="Avatar" style="width:70px" onclick="window.location.href='https://w3docs.com';">
                        <br>
                        <span> Email</span>
                        </button>

                        <button id="iconButton">
                        <img id="iconImages"src="images/linkedIn.jpg"alt="Avatar" style="width:70px" onclick="window.location.href='https://www.linkedin.com/';">
                        <br>
                        <span> Linkedin</span>
                        </button>

                        <button id="iconButton">
                        <img id="iconImages"src="images/RedditIcon.png"alt="Avatar" style="width:70px" onclick="window.location.href='https://www.reddit.com/';">
                        <br>
                        <span> Reddit</span>
                        </button>
                        </div>
                    </div>
                </div>

                <div id="myModal1" class="modal">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <p>Save to...</p>
                        <br>
                        <form action="" method="post">
                        <button id="addWatchLater" name="addWatchLater" value="Watch Later">Watch Later</button>
                        <br>
                      
                        <?php
                        $playlists = $db->query("SELECT * FROM Playlist");
                        foreach($playlists as $playlst)
                        {
                            
                            ?>
                            <input type="radio" name="playlistForm" value="<?= $playlst["id"]?> ">
                            <label for=" <?= $playlst["id"]?>" > <?= $playlst["title"]?> </label>
                            <br>
                            <?php
                        }
                       
                        ?>
                        <button id="saveVidPlaylist" name="saveVidPlaylist"> Save into my selected playlist</button>
                       
                        <br>
                        <p>Create a new playlist:</p>
                        
                          <select name="privacy" id="privacy">
                            <option value="0"> public
                            </option>
                            <option value="1"> private</option>
                        </select>
                          <input type="text" name="playlistTitle" id="playlistTitle" placeholder="Add a title for new playlist">
                          <button name="createplaylistBtn" id="createplaylistBtn"> Add a new playlist</button>
                          <br>
                          <?php
                        //on click add  to watch later 
                        if (isset($_POST['addWatchLater'])){
                            $datetime = date('Y-m-d H:i:s');
                            $watchlaters = "INSERT INTO `WatchLater` (`viewer`, `video`, `later_datetime`) VALUES ('$id_linked ', '$vid_id_link', '$datetime') ";
                            $db->exec($watchlaters);
                            echo $datetime;
                        }

                        //add a new playlist on click
                        if (isset($_POST['createplaylistBtn'])){
                            $playlists = $db->query("SELECT * FROM Playlist")->rowCount();
                            $playlists++;

                            $playlist_title= $_POST['playlistTitle'];
                            $privacy = $_REQUEST["privacy"];

                            $playlistmake = "INSERT INTO `Playlist` (`id`, `owner`, `title`, `private`) VALUES ('$playlists', '$id_linked', '$playlist_title', '$privacy') ";
                            $db->exec($playlistmake);
                        }

                        //add to a playlist on click
                  
                        if(isset($_POST['saveVidPlaylist'])){
                            $datetime = date('Y-m-d H:i:s');
                            $form21 = $_POST['playlistForm'];
                            $playlistAdd = "INSERT INTO `PlaylistVideos` (`video`, `playlist`, `playlist_datetime`) VALUES ('$vid_id_link', '$form21', '$datetime') ";
                            $db->exec($playlistAdd);
                        }
                          ?>
                        </form>
                    </div>
                </div>   
            </div>

            <div id="descriptionCont">
                <input type="button" id="tuberImage" value="<?= $tuberName[0] ?>" onclick="window.location.href='channelAfter.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>&channelid=<?= $channelId?>'">
                <div id="tuberInfo">
                        <span class="tuberName" onclick="window.location.href='channelAfter.php?fname=<?php echo $fname?>&lname=<?php echo $lname?>&email=<?php echo $email?>&channelid=<?= $channelId?>'"> <?= $tuberName ?>
                        </span>
                        <br>
                        <span class="tuberSubs"> <?=$subsCount ?> subscribers</span> 
                        <form action="" method="post" id="formSub">
                        <button id="subButton" name="subButton"> Subscribe</button>
                        </form>
                        <input type="button" id="notifImage">
                </div>
                <br>
                <div id="description">
                    <?= $des ?>
                </div>
            </div>
          
            <form action="" method="post">
            <div id="commentsBox">

                <span class="commentsBoxS"> <?=$CommentCount ?> comments</span>
                <input type="text" name="commentInput" id="commentInput" placeholder="Add a public comment">
                <div id="commentBtns">
                    <button id="cancelCommBtn" onclick="document.getElementById('commentInput').value = ''">CANCEL</button>
                    <button id="commentBtn" name="commentBtn" onclick="commentBtn()">COMMENT</button>

                </div>
                <?php

                // //on click sub to channel
                if (isset($_POST['subButton'])){
                    $subs_table= "INSERT INTO `Subscription` (`subscriber`, `channel`) VALUES ('$id_linked', '$channelId')";
                    $db->exec($subs_table);
                }
               
                //to insert a comment
                $commContent="";
                if(isset($_POST['commentBtn']) ){
                    $varComment = $_POST['commentInput'];
                    $comments = $db->query("SELECT * FROM VideoComment")->rowCount();
                    $comments++;
                    $sql10 = "INSERT INTO `VideoComment` (`id`, `author`, `video`, `comment`) VALUES ( '$comments', '$id_linked', '$vid_id_link ', '$varComment')";
                    $db->exec($sql10); 
                };
                 //add reply to db 
                if(isset($_POST['reply2commBtn'])){
                    $replyContent = $_POST['replyInput'];
                    $replies= $db->query("SELECT * FROM CommentReply")->rowCount();
                    $test=$_POST['commentIDinput'];
                    $replies++;
                    $replySql="INSERT INTO `CommentReply` (`id`, `parent_id`, `author`, `video`, `reply`) VALUES ('$replies', '$test', '$id_linked', '$vid_id_link ', '$replyContent')";
                    $db->exec($replySql); 
                }

                //likes and dislike for comments 
                if(isset($_POST['likeImageComm'])){  

                    $test1=$_POST['commentIDinput'];
                    $insertlikes1c = $db->query("SELECT * FROM `CommentLikes` WHERE  `CommentLikes`.`id` = $test1 AND `CommentLikes`.`video` = '$vid_id_link' AND `CommentLikes`.`viewer`='$id_linked';  ");
                        foreach($insertlikes1c as $insertlike1c ){
                            $sqlLikeComment1="UPDATE `CommentLikes` SET `is_liked` = '1' WHERE  `CommentLikes`.`id` = $test1 AND `CommentLikes`.`video` = '$vid_id_link' AND `CommentLikes`.`viewer`='$id_linked';"; 
                            $db->exec($sqlLikeComment1);      
                    }

                    $sqlCommLike12="INSERT INTO `CommentLikes` (`viewer`, `id`, `video`, `is_liked`) VALUES ('$id_linked', '$test1', '$vid_id_link', '1');"; 
                    $db->exec($sqlCommLike12); 

                };
                if(isset($_POST['dislikeImageComm'])){

                    $test1=$_POST['commentIDinput'];
                   $insertlikes1cd = $db->query("SELECT * FROM `CommentLikes` WHERE `CommentLikes`.`id` = $test1 AND `CommentLikes`.`video` = '$vid_id_link ' AND `CommentLikes`.`viewer`='$id_linked'");
                        foreach($insertlikes1cd as $insertlike1cd ){
                            $sqldisLikeComment="UPDATE `CommentLikes` SET `is_liked` = '0' WHERE `CommentLikes`.`id` = $test1 AND `CommentLikes`.`video` = '$vid_id_link ' AND `CommentLikes`.`viewer`='$id_linked' "; 
                            $db->exec($sqldisLikeComment);
                    }
                    $sqlCommdLike12="INSERT INTO `CommentLikes` (`viewer`, `id`, `video`, `is_liked`) VALUES ('$id_linked', '$test1', '$vid_id_link', '0');"; 
                    $db->exec($sqlCommdLike12);     
                };

                if(isset($_POST['viewReply'])){
                    $test2=$_POST['commentIDinput'];
                    $replyTables = $db->query("SELECT * FROM `CommentReply` WHERE `CommentReply`.`parent_id` = $test2 AND `CommentReply`.`video` = '$vid_id_link '");
                    $replyContentDb="";
                    foreach($replyTables as $replyTable){
                        $replyContentDb= $replyTable['reply'];
                        $authorReply = $replyTable['author'];

                                $channelTables4 = $db->query("SELECT * FROM `Channel` WHERE name='$authorReply' ");
                                $authorName34="";
                                foreach($channelTables4 as $channelTable4){
                                    $authorName34 = $channelTable4["name"];
                                }

                        ?>
                        <div id="replyBox">
                            <input type="button" id="tuberImage">
                            <div id="replyName"> <?= $authorName34?></div>
                            <div id="replyContent"> <?= $replyContentDb ?></div>
                            <div id="likeMenuReply"> 
                            <button id="likeImageReply" name="likeImageReply"></button>
                            <span class="likesReply"> </span>
                            <button id="dislikeImageReply" name="dislikeImageReply"></button>
                        </div>
                    <?php
                };
              
                }
                $g = true;
                if( $g == true){
                    $commentDbs = $db->query("SELECT * FROM VideoComment WHERE video='$vid_id_link' ");
                    foreach($commentDbs as $commentDb){

                        $commContent= $commentDb["comment"];
                        $commentID= $commentDb["id"];

                        #for comment author  name
                         $author=$commentDb["author"]; //make author = var , id=author
                         $rows5 = $db->query("SELECT name FROM Channel WHERE id= '$author' ");
                         $commenterName="";
                         $replyName="";
                         foreach($rows5 as $row5){
                             $commenterName = $row5["name"];
                             $replyName = $row5["name"];
                             ?>
                             <form action=""> 
                              <input type="hidden" value="<?= $replyName?>"  name="replyName_db"  >
                             </form>
                             <?php
                         };
                         
                        // echo $commentID;
                        $commentLikes = $db->query("SELECT * FROM CommentLikes WHERE video='$vid_id_link'  AND id= '$commentID' AND is_liked='1'");
                        $likeCommCount=0;
                        // $dislikeCommCount=0;
                        foreach($commentLikes as $commentLike){
                            if( $commentLike["is_liked"] == 1 ){
                                $likeCommCount++;
                            }
                        };
                        
                        ?>
                         <form action="" method="post" >
                         <div id="comment">
                            <input type="button" id="tuberImage">
                            <div id="commName">  <?=$commenterName?> </div>
                            <div id="commContent"> <?=$commContent?></div>
                            <div id="likeMenuComm"> 
                            <button id="likeImageComm" name="likeImageComm" ></button>
                            <span class="likesComm"> <?=$likeCommCount?> </span>
                            <button id="dislikeImageComm" name="dislikeImageComm"></button>
                            <button id="reply" name="reply"> REPLY</button>
                            <input type="hidden" value="<?= $commentID ?>"  name="commentIDinput"  >
                            <br>
                            <button id="viewReply" name="viewReply"> View reply </button>
                            </div>
                        </div>

                        <?php

                        if(isset($_POST['reply'])){
                            ?>
                            <input type="text" name="replyInput" id="replyInput" placeholder="Add a public reply">
                          
                           <div id="replyBtns">
                                <button id="cancelReplyBtn" onclick="document.getElementById('replyInput').value = ''">CANCEL</button>
                                <button id="reply2commBtn" name="reply2commBtn">REPLY</button>
                            </div>
                            <?php
                            };
                            ?>
                        </form>
                        <?php
                };
                }
                else{
                    echo "No comments yet";
                }
                ?>
            </div>
            </form>

</body>

<script>
    // When the user clicks on div, open the popup
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

            // Get the modal
        var modal = document.getElementById("myModal");
        // Get the button that opens the modal
        var btn = document.getElementById("shareImage");
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

        // Get the modal for reprt
        var modal1 = document.getElementById("myModal1");
        // Get the button that opens the modal
        var btn1 = document.getElementById("saveImage");
        // Get the <span> element that closes the modal
        var span1 = document.getElementsByClassName("close")[0];
        // When the user clicks the button, open the modal 
        btn1.onclick = function() {
        modal1.style.display = "block";
        }
        // When the user clicks on <span> (x), close the modal
        span1.onclick = function() {
        modal1.style.display = "none";
        }
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal1) {
            modal1.style.display = "none";
        }
        }
        </script>

</html>