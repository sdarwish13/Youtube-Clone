<!DOCTYPE html>
<html>

    <head>
        <title>Youtube video playlist</title>
        <meta charset="UTF-8">
        <link href="watchvideoPlaylist.css" rel="stylesheet" type="text/css">
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
                    $watchlater = $_REQUEST["watchlater"];
                    $shuffle = $_REQUEST["shuffle"];
                ?>
                <input type="button" id="vidImage" onclick="window.location.href='upload_vid.php?fname=<?= $fname?>&lname=<?= $lname?>&email=<?= $email?>'">
                <input type="button" id="gridImage">
                <input type="button" id="bellImage">
                <input type="button" id="profileImage" onclick="openNav()" value="<?= $fname[0], $lname[0]?>">
            </div>

            <div id="mySidenav" class="sidenav">
                   <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <hr>
                    <input type="button" id="details_sideNavImg" name="details_sideNavImg" onclick="window.location.href='upload_vid.php?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?> '">
                    <span class="details_sideNav"> Your Channel</span>
                    <br>
                    <hr>
                    <button id="details_sideNavImg_lang" value="" name="details_sideNavImg_lang" ></button>
                    <span class="details_sideNav">Language: English</span>
                    <br>
                    <hr>
                    <button id="details_sideNavImg_loc" value="" name="details_sideNavImg_loc" ></button>
                    <span class="details_sideNav"> Location: Lebanon</span>
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
            <?php
                $db = new PDO("mysql:dbname=278project", "root","");
                $vid_id_link;
            ?>
            <div id="videoBox">
                <div>
                <?php
                    $rows0 = $db->query("SELECT * FROM Channel WHERE owner='$email'");
                    foreach($rows0 as $row)
                    {
                        $id_linked = $row["id"];
                    }
                    
                    if($watchlater=="true")
                    {
                        if($shuffle=="true")
                        {
                            $later = $db->query("SELECT * FROM WatchLater WHERE viewer=$id_linked ORDER BY RAND()");
                            $des ="";
                            $vidTitle="";
                            foreach($later as $late)
                            {
                                $vid = $late["video"];
                                $vid_id_link = $vid;
                                $rows4 = $db->query("SELECT * FROM VideoComment WHERE video=$vid");
                                $rows8 = $db->query("SELECT * FROM Views WHERE video=$vid");
                                $rows1 = $db->query("SELECT is_liked FROM Likes WHERE video=$vid AND viewer=$id_linked");
                                $rows12 = $db->query("SELECT is_liked FROM Likes WHERE video=$vid AND viewer=$id_linked");
                                $rows01 = $db->query("SELECT *, DATE_FORMAT(upload_date , '%b %d, %Y') AS upload_date FROM Video WHERE id=$vid");
                                foreach($rows01 as $row)
                                {
                                    $chan = $row["channel"];
                                    $rows2 = $db->query("SELECT name FROM Channel WHERE id=$chan");
                                    $rows3 = $db->query("SELECT subscriber FROM Subscription WHERE channel=$chan");
                                    ?>
                                        <video id="watchVideo" controls>
                                            <source src="<?= $row["location"], $row["fileName"]?>" type="video/mp4">
                                        </video>

                                    <?php
                                    $des = $row["description"];
                                    $vidTitle = $row["title"];
                                    $date = $row["upload_date"];
                                    $channelId=$row["channel"];
                                    break;
                                }
                                break;
                            } 
                        }
                        else if($shuffle=="false")
                        {
                            $vid_id_link = $_REQUEST["id"];
                            $later = $db->query("SELECT * FROM WatchLater WHERE viewer=$id_linked ORDER BY later_datetime DESC");
                            $des ="";
                            $vidTitle="";
                            foreach($later as $late)
                            {
                                $vid = $late["video"];
                                $rows4 = $db->query("SELECT * FROM VideoComment WHERE video=$vid_id_link");
                                $rows8 = $db->query("SELECT * FROM Views WHERE video=$vid_id_link");
                                $rows1 = $db->query("SELECT is_liked FROM Likes WHERE video=$vid_id_link AND viewer=$id_linked");
                                $rows12 = $db->query("SELECT is_liked FROM Likes WHERE video=$vid_id_link AND viewer=$id_linked");
                                $rows01 = $db->query("SELECT *, DATE_FORMAT(upload_date , '%b %d, %Y') AS upload_date FROM Video WHERE id=$vid_id_link");
                                foreach($rows01 as $row)
                                {
                                    $chan = $row["channel"];
                                    $rows2 = $db->query("SELECT name FROM Channel WHERE id=$chan");
                                    $rows3 = $db->query("SELECT subscriber FROM Subscription WHERE channel=$chan");
                                    ?>
                                        <video id="watchVideo" controls>
                                            <source src="<?= $row["location"], $row["fileName"]?>" type="video/mp4">
                                        </video>

                                    <?php
                                    $des = $row["description"];
                                    $vidTitle = $row["title"];
                                    $date = $row["upload_date"];
                                    break;
                                }
                                break;
                            }
                        }
                    }
                    else if($watchlater=="false")
                    {
                        $playlist = $_REQUEST["playlist"];
                        if($shuffle=="true")
                        {
                            $play = $db->query("SELECT * FROM PlaylistVideos WHERE playlist=$playlist ORDER BY RAND()");
                            $des ="";
                            $vidTitle="";
                            foreach($play as $list)
                            {
                                $vid = $list["video"];
                                $vid_id_link = $vid;
                                $rows4 = $db->query("SELECT * FROM VideoComment WHERE video=$vid");
                                $rows8 = $db->query("SELECT * FROM Views WHERE video=$vid");
                                $rows1 = $db->query("SELECT is_liked FROM Likes WHERE video=$vid AND viewer=$id_linked");
                                $rows12 = $db->query("SELECT is_liked FROM Likes WHERE video=$vid AND viewer=$id_linked");
                                $rows01 = $db->query("SELECT *, DATE_FORMAT(upload_date , '%b %d, %Y') AS upload_date FROM Video WHERE id=$vid");
                                foreach($rows01 as $row)
                                {
                                    $chan = $row["channel"];
                                    $rows2 = $db->query("SELECT name FROM Channel WHERE id=$chan");
                                    $rows3 = $db->query("SELECT subscriber FROM Subscription WHERE channel=$chan");
                                    ?>
                                        <video id="watchVideo" controls>
                                            <source src="<?= $row["location"], $row["fileName"]?>" type="video/mp4">
                                        </video>

                                    <?php
                                    $des = $row["description"];
                                    $vidTitle = $row["title"];
                                    $date = $row["upload_date"];
                                    break;
                                }
                                break;
                            } 
                        }
                        else if($shuffle=="false")
                        {
                            $vid_id_link = $_REQUEST["id"];
                            $play = $db->query("SELECT * FROM PlaylistVideos WHERE playlist=$playlist ORDER BY playlist_datetime DESC");
                            $des ="";
                            $vidTitle="";
                            foreach($play as $list)
                            {
                                $vid = $list["video"];
                                $rows4 = $db->query("SELECT * FROM VideoComment WHERE video=$vid_id_link");
                                $rows8 = $db->query("SELECT * FROM Views WHERE video=$vid_id_link");
                                $rows1 = $db->query("SELECT is_liked FROM Likes WHERE video=$vid_id_link AND viewer=$id_linked");
                                $rows12 = $db->query("SELECT is_liked FROM Likes WHERE video=$vid_id_link AND viewer=$id_linked");
                                $rows01 = $db->query("SELECT *, DATE_FORMAT(upload_date , '%b %d, %Y') AS upload_date FROM Video WHERE id=$vid_id_link");
                                foreach($rows01 as $row)
                                {
                                    $chan = $row["channel"];
                                    $rows2 = $db->query("SELECT name FROM Channel WHERE id=$chan");
                                    $rows3 = $db->query("SELECT subscriber FROM Subscription WHERE channel=$chan");
                                    ?>
                                        <video id="watchVideo" controls>
                                            <source src="<?= $row["location"], $row["fileName"]?>" type="video/mp4">
                                        </video>

                                    <?php
                                    $des = $row["description"];
                                    $vidTitle = $row["title"];
                                    $date = $row["upload_date"];
                                    break;
                                }
                                break;
                            }
                        }
                    }

                           //for likes and dislikes
                           if(isset($_POST['likeImage'])) {

                            $insertlikes1 = $db->query("SELECT * FROM `Likes` WHERE `viewer` = $id_linked AND `video`=$vid_id_link ");
                            foreach($insertlikes1 as $insertlike1 ){
                                 $sqlLike = "UPDATE `Likes` SET is_liked='1' ";
                                 $db->exec($sqlLike);
                            }

                            $sqlLike12="INSERT INTO `Likes` (`viewer`, `video`, `is_liked`) VALUES ('$id_linked', '$vid_id_link', '1');";
                            $db->exec($sqlLike12);
                          
                        };
                        if(isset($_POST['dislikeImage'])) {
                            $sqlDislike = "UPDATE `Likes` SET is_liked='0' WHERE video=$vid_id_link AND viewer=$id_linked ";
                            $db->exec($sqlDislike);


                            $insertdislikes1 = $db->query("SELECT * FROM `Likes` WHERE `viewer` != $id_linked");
                            foreach($insertdislikes1 as $insertdislike1 ){
                                $sqldisLike12="INSERT INTO `Likes` (`viewer`, `video`, `is_liked`) VALUES ('$id_linked', '$vid_id_link', '0');"; 
                                $db->exec($sqldisLike12);

                            }
                        };
                        
                    //to display dislikes 
                    
                    $countDislikes=0; //dislikes count
                    foreach($rows12 as $row12){
                        if( $row12["is_liked"] == 0){
                            $countDislikes++;
                        }
                    };
                    //to display likes 
                    
                    $countLikes =0; //likes count
                    foreach($rows1 as $row1){
                        if( $row1["is_liked"] == 1 ){
                                $countLikes++;
                            }
                        };

                    #for channel name ( tuber name)
                    
                    $tuberName="";
                    foreach($rows2 as $row2){
                        $tuberName = $row2["name"];
                    };

                    #for subscribers( sub count)
                    
                    $subsCount=0;
                    
                    foreach($rows3 as $row3){
                        $subsCount++;
                    };

                    #for comment count
                    
                    $CommentCount=0;
                    $varCommentid=0;
                    foreach($rows4 as $row4){
                        $CommentCount++;
                        
                        
                    };       
                    #display video views
                    
                    $viewsCount=0;
                        foreach($rows8 as $row8){
                            $viewsCount++;
                    };

                
                ?>
                </div>
        
                <h2 class="vidTitle"> <?= $vidTitle?> </h2>

                <div id="viewCount">
                    <?= $viewsCount?> views 
                        &bull;
                    <?= $date?>
                </div>

                
              
                <div id="likeMenu">
                    <form method="post" id="formLike" > 
                        <button id="likeImage" value="likeImage" name="likeImage" ></button>
                        <span class="likes"> <?=$countLikes?> </span>
                        <button id="dislikeImage"  value="dislikeImage" name="dislikeImage"></button>
                        <span class="likes"> <?=$countDislikes?> </span>
                    </form>
                    <button id="shareImage"></button>
                    <span class="likes"> SHARE </span>
                    <button id="saveImage"></button>
                    <span class="likes"> SAVE </span>
                    <button id="dotsImage" onclick="myFunction()" class="popup">

                    <form action="" method="post">
                    <div> 
                        <span class="popuptext" id="myPopup">A Simple Popup!
                        <ul id="reportList">
                        <li> <input type="submit" placeholder="Report" value="Report" id="reportBtn" name="reportBtn" > </li>
                        </ul>
                        </span>
                    </div>
                    </form>
                    </button> 
                </div>
                <?php
                     if (isset($_POST['reportBtn'])){
                         $report = "INSERT INTO `Report` (`reporter`, `video`) VALUES ('$id_linked ', '$vid_id_link')";
                         $db->exec( $report);  
                     }


                ?>
               

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
                            // echo  $playlst["id"];
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
                            // $datetime =  DATE_FORMAT('%m-%d-%Y');
                            // $date=date("Y-m-d",strtotime($date));
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
                            // echo "this is privacy :", $privacy;
                        }

                        //    //add to a playlist on click
                  
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
                
                <div id="descriptionCont">
                    <input type="button" id="tuberImage">
                    <div id="tuberInfo">
                        <span class="tuberName"> <?= $tuberName ?>
                        </span>
                        <br>
                        <span class="tuberSubs"> <?=$subsCount ?> subscribers</span> 
                        <form action="" method="post" id="formSub">
                        <button id="subButton" name="subButton"> Subscribe</button>


                        <?php
                        // //on click sub to channel
                        if (isset($_POST['subButton'])){
                            $subs_table= "INSERT INTO `Subscription` (`subscriber`, `channel`) VALUES ('$id_linked', '$chan')";
                            $db->exec($subs_table);
                        }

                        ?>
                        </form>
                        <input type="button" id="notifImage">
                    </div>
                    <br>
                    <div id="description">
                        <?= $des ?>
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
                            
                        
                        
                            //to insert a comment
                            $commContent="";
                            if(isset($_POST['commentBtn']) ){
                                // $db = new PDO("mysql:dbname=278project", "root","");
                                $varComment = $_POST['commentInput'];
                                $comments = $db->query("SELECT * FROM VideoComment WHERE video=$vid_id_link")->rowCount();
                                $comments++;
                                $sql10 = "INSERT INTO `VideoComment` (`id`, `author`, `video`, `comment`) VALUES ( '$comments', $id_linked, $vid_id_link, '$varComment')";
                                $db->exec($sql10); 
                            };
                            //add reply to db 
                            if(isset($_POST['reply2commBtn'])){
                                $replyContent = $_POST['replyInput'];
                                $replies = $db->query("SELECT * FROM CommentReply WHERE video=$vid_id_link")->rowCount();
                                $test=$_POST['commentIDinput'];
                                $replies++;
                                $replySql="INSERT INTO `CommentReply` (`id`, `parent_id`, `author`, `video`, `reply`) VALUES ('$replies', '$test', $id_linked, $vid_id_link, '$replyContent')";
                                $db->exec($replySql); 
                                // echo" success reply saved to db!";
                                // echo "this is :" ,$replyContent;
                            }

                            //likes and dislike for comments 
                            if(isset($_POST['likeImageComm'])){  

                                $test1=$_POST['commentIDinput'];
                                $insertlikes1c = $db->query("SELECT * FROM `CommentLikes` WHERE  `CommentLikes`.`id` = $test1 AND `CommentLikes`.`video` = '$vid_id_link' AND `CommentLikes`.`viewer`='$id_linked';  ");
                                    foreach($insertlikes1c as $insertlike1c ){
                                        $sqlLikeComment1="UPDATE `CommentLikes` SET `is_liked` = '1'"; 
                                        $db->exec($sqlLikeComment1);      
                                }

                                $sqlCommLike12="INSERT INTO `CommentLikes` (`viewer`, `id`, `video`, `is_liked`) VALUES ('$id_linked', '$test1', '$vid_id_link', '1');"; 
                                $db->exec($sqlCommLike12);  
                            
                            };
                            if(isset($_POST['dislikeImageComm'])){

                                $test1=$_POST['commentIDinput'];
                                $insertlikes1cd = $db->query("SELECT * FROM `CommentLikes` WHERE `CommentLikes`.`id` = $test1 AND `CommentLikes`.`video` = '$vid_id_link ' AND `CommentLikes`.`viewer`='$id_linked'");
                                    foreach($insertlikes1cd as $insertlike1cd ){
                                        $sqldisLikeComment="UPDATE `CommentLikes` SET `is_liked` = '0'  "; 
                                        $db->exec($sqldisLikeComment);
                                }
                                $sqlCommdLike12="INSERT INTO `CommentLikes` (`viewer`, `id`, `video`, `is_liked`) VALUES ('$id_linked', '$test1', '$vid_id_link', '0');"; 
                                $db->exec($sqlCommdLike12);     
                            };

                            if(isset($_POST['viewReply'])){
                                $test2=$_POST['commentIDinput'];
                                $replyTables = $db->query("SELECT * FROM `CommentReply` WHERE `CommentReply`.`parent_id` = $test2 AND `CommentReply`.`video` = $vid_id_link;");
                                $replyContentDb="";
                                // $replyNam_db=$_POST['replyName_db'];
                                foreach($replyTables as $replyTable){
                                    $replyContentDb= $replyTable['reply'];
                                    ?>
                                    <div id="replyBox">
                                        <input type="button" id="tuberImage">
                                        <!-- <div id="replyName"> <?= $replyNam_db ?></div> -->
                                        <div id="replyContent"> <?= $replyContentDb ?></div>
                                        <div id="likeMenuReply"> 
                                        <button id="likeImageReply" name="likeImageReply"></button>
                                        <span class="likesReply"> </span>
                                        <button id="dislikeImageReply" name="dislikeImageReply"></button>
                                        <!-- <button id="reply"  onclick="replyBtn()"> REPLY</button> -->
                                    </div>
                                <?php
                            };
                        
                            }
                            $g = true;
                            if( $g == true){
                                $commentDbs = $db->query("SELECT * FROM VideoComment WHERE video=$vid_id_link ");
                                foreach($commentDbs as $commentDb){

                                    $commContent= $commentDb["comment"];
                                    $commentID= $commentDb["id"];

                                    #for comment author  name
                                    $author=$commentDb["author"]; //make author = var , id=author
                                    $rows5 = $db->query("SELECT name FROM Channel WHERE id= $author ");
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
                                    $commentLikes = $db->query("SELECT * FROM CommentLikes WHERE video=$vid_id_link AND id= $commentID AND is_liked=1");
                                    $likeCommCount=0;
                                    // $dislikeCommCount=0;
                                    foreach($commentLikes as $commentLike){
                                        if( $commentLike["is_liked"] == 1 ){
                                            $likeCommCount++;
                                        }
                                        // else if($commentLike["is_liked"] == 0){
                                        //     $dislikeCommCount++;
                                        // }
                                    };
                                    
                                    ?>
                                    <form action="" method="post">
                                    <div id="comment">
                                        <input type="button" id="tuberImage">
                                        <div id="commName">  <?=$commenterName?> </div>
                                        <div id="commContent"> <?=$commContent?></div>
                                        <div id="likeMenuComm"> 
                                        <button id="likeImageComm" name="likeImageComm"></button>
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
                            else
                            {
                                echo "No comments yet";
                            }
                            ?>
                        </div>
                    </form>
                </div>
            </div>

            <div id="upNext">
                <div id="idk">
                    <div id="playlistButtons">
                    <?php
                        if($watchlater=="true")
                        {
                            if($shuffle=="true")
                            {
                                $later = $db->query("SELECT * FROM WatchLater WHERE viewer=$id_linked ORDER BY RAND()");
                                foreach($later as $late)
                                {
                                    $vid = $late["video"];
                                    $rows01 = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE id=$vid");
                                    foreach($rows01 as $row)
                                    {
                                        $chan = $row["channel"];
                                        $rows2 = $db->query("SELECT name FROM Channel WHERE id=$chan");
                                        foreach($rows2 as $row2)
                                        {
                                            $channelName = $row2["name"];
                                        };
                                        ?>
                                            <button>
                                                <video id="watchVideos" width="150px" style="float:left;" >
                                                    <source src="<?= $row["location"], $row["fileName"]?>" type="video/mp4">
                                                </video>
                                                <div id="vidDetails" style="float:left;">
                                                
                                                    <h4><?= $row["title"]?></h4>
                                                    <p><?= $channelName?></p>
                                                    <p>
                                                        <?php 
                                                            $views = $db->query("SELECT * FROM Views WHERE video=$vid")->rowCount();
                                                        ?>
                                                        <span><?= $views?> views • </span>
                                                        <span><?= $row["upload_date"]?></span>
                                                    </p>
                                                </div>
                                            </button>
                                        <?php
                                    }
                                } 
                            }
                            else if($shuffle=="false")
                            {
                                $later = $db->query("SELECT * FROM WatchLater WHERE viewer=$id_linked ORDER BY later_datetime DESC");
                                foreach($later as $late)
                                {
                                    $vid = $late["video"];
                                    $rows01 = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE id=$vid");
                                    foreach($rows01 as $row)
                                    {
                                        $chan = $row["channel"];
                                        $rows2 = $db->query("SELECT name FROM Channel WHERE id=$chan");
                                        foreach($rows2 as $row2)
                                        {
                                            $channelName = $row2["name"];
                                        };
                                        ?>
                                            <button>
                                                <video id="watchVideos" width="150px" style="float:left;">
                                                    <source src="<?= $row["location"], $row["fileName"]?>" type="video/mp4">
                                                </video>
                                                <div id="vidDetails" style="float:left;">
                                                
                                                    <h4><?= $row["title"]?></h4>
                                                    <p><?= $channelName?></p>
                                                    <p>
                                                        <?php 
                                                            $views = $db->query("SELECT * FROM Views WHERE video=$vid")->rowCount();
                                                        ?>
                                                        <span><?= $views?> views • </span>
                                                        <span><?= $row["upload_date"]?></span>
                                                    </p>
                                                </div>
                                            </button>
                                        <?php
                                    }
                                }
                            }
                        }
                        else if($watchlater=="false")
                        {
                            $playlist = $_REQUEST["playlist"];
                            if($shuffle=="true")
                            {
                                $play = $db->query("SELECT * FROM PlaylistVideos WHERE playlist=$playlist ORDER BY RAND()");
                                foreach($play as $list)
                                {
                                    $vid = $list["video"];
                                    $rows01 = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE id=$vid");
                                    foreach($rows01 as $row)
                                    {
                                        $chan = $row["channel"];
                                        $rows2 = $db->query("SELECT name FROM Channel WHERE id=$chan");
                                        foreach($rows2 as $row2)
                                        {
                                            $channelName = $row2["name"];
                                        };
                                        ?>
                                            <button>
                                                <video id="watchVideos" width="150px" style="float:left;">
                                                    <source src="<?= $row["location"], $row["fileName"]?>" type="video/mp4">
                                                </video>
                                                <div id="vidDetails" style="float:left;">
                                                
                                                    <h4><?= $row["title"]?></h4>
                                                    <p><?= $channelName?></p>
                                                    <p>
                                                        <?php 
                                                            $views = $db->query("SELECT * FROM Views WHERE video=$vid")->rowCount();
                                                        ?>
                                                        <span><?= $views?> views • </span>
                                                        <span><?= $row["upload_date"]?></span>
                                                    </p>
                                                </div>
                                            </button>
                                        <?php
                                    }
                                } 
                            }
                            else if($shuffle=="false")
                            {
                                $play = $db->query("SELECT * FROM PlaylistVideos WHERE playlist=$playlist ORDER BY playlist_datetime DESC");
                                foreach($play as $list)
                                {
                                    $vid = $list["video"];
                                    $rows01 = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video WHERE id=$vid");
                                    foreach($rows01 as $row)
                                    {
                                        $chan = $row["channel"];
                                        $rows2 = $db->query("SELECT name FROM Channel WHERE id=$chan");
                                        foreach($rows2 as $row2)
                                        {
                                            $channelName = $row2["name"];
                                        };
                                        ?>
                                            <button>
                                                <video id="watchVideos" width="150px" style="float:left;">
                                                    <source src="<?= $row["location"], $row["fileName"]?>" type="video/mp4">
                                                </video>
                                                <div id="vidDetails" style="float:left;">
                                                
                                                    <h4><?= $row["title"]?></h4>
                                                    <p><?= $channelName?></p>
                                                    <p>
                                                        <?php 
                                                            $views = $db->query("SELECT * FROM Views WHERE video=$vid")->rowCount();
                                                        ?>
                                                        <span><?= $views?> views • </span>
                                                        <span><?= $row["upload_date"]?></span>
                                                    </p>
                                                </div>
                                            </button>
                                        <?php
                                    }
                                } 
                            }
                        } 
                    ?>
                        
                    </div>
                </div>

                <span class="upNexttxt">Up Next</span>
            
                <div id="next">
                    <?php
                    $rows6 = $db->query("SELECT *, DATE_FORMAT(upload_date , '%m-%d-%Y') AS upload_date FROM Video ORDER BY RAND()");
                    $varChannelIds= $db->query("SELECT channel FROM Video");

                    foreach($rows6 as $row6)
                    {   
                    ?>
                        <div id="details"> 
                            <video id="detailsImg" onclick="window.location.href = `watchvideo.php?fname=<?php echo $fname ?>&lname=<?php echo $lname ?>&email=<?php echo $email ?>&id=<?php echo $vid ?>`" >
                                <source src="test_uploads/<?php echo $row6["fileName"] ?>" type="video/mp4">
                            </video>    
                            <h3 id="test"> <?php echo $row6["title"] ?> </h3>
                            <?php 
                                $chan = $row6["channel"];
                                $channels = $db->query("SELECT * FROM Channel WHERE id=$chan");
                                foreach($channels as $channel)
                                {
                                    $vid = $row6["id"];
                                    $views = $db->query("SELECT * FROM Views WHERE video=$vid")->rowCount();
                                    ?>
                                    <h5><?php echo $channel["name"] ?>  </h5>
                                    <h5><?php echo $views ?> views 
                                    &bull;
                                    <?= $row6["upload_date"]?>
                                    </h5>
                                <?php
                                }
                            ?>
                        </div>
                    <?php
                    }
                    ?>     
                </div>
            </div>     
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