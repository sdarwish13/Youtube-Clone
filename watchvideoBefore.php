<!DOCTYPE html>
<html>

    <head>
        <title>Youtube video</title>
        <meta charset="UTF-8">
        <link href="watchvideo.css" rel="stylesheet" type="text/css">
        <!-- <script src="watchvideo.js">

        </script> -->
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
 <?php
                    $db = new PDO("mysql:dbname=278project", "root","");
                    
                    $fname = $_REQUEST["fname"];
                    $lname = $_REQUEST["lname"];
                    $email = $_REQUEST["email"];
                    $vid_id_link = $_REQUEST["id"];

                    // $emailLinks = $db->query("SELECT * FROM `Channel` WHERE owner='$email'");

                    // $replyTables = $db->query("SELECT * FROM `CommentReply` WHERE `CommentReply`.`parent_id` = $test2 AND `CommentReply`.`video` = '$vid_id_link ';");
                    // $id_linked="";
                    // foreach($emailLinks as $emailLink){
                    //     // $owner=$emailLink["owner"];
                    //     // if($email == $owner){
                    //         $id_linked = $emailLink["id"];
                     

                    //     // }
                    // // break;

                     
        
                    // }
                    // $view = "INSERT INTO `Views` (`viewer`, `video`) VALUES ('$id_linked ', '$vid_id_link')";
                    // $db->exec($view);

                    // echo $id_linked;
                    // echo $owner;
                    // echo "THis is email : ",$email;
                 


                    // $trueVar=true;
                    // if($trueVar==true){

                    //     $rows89= $db->query("SELECT * FROM `Channel` ");
                    //     foreach($rows89 as $row89){
                    //         $owner= $row89["owner"];
                    //         $id_from_channel=$rows89["id"];
                    //         if($email == $owner){




                    //         }
                           
                    //     }

                    // }

                  
                 
                
                ?>

            <div id="buttons">

                <input type="button" id="vidImage">
                <input type="button" id="gridImage">
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
                    <a href="#">About</a>
                    <a href="#">Services</a>
                    <a href="#">Clients</a>
                    <a href="#">Contact</a>
                </div>

        </div>

        <div id="box">

                <?php
                    $db = new PDO("mysql:dbname=278project", "root","");
                   
                ?>

            <div id="upNext">

                <span class="upNexttxt">
                    Up next 
                </span>

                <ul>
                    <?php
                        $rows6 = $db->query("SELECT * FROM Video");
                        $varChannelIds= $db->query("SELECT channel FROM Video");
 
                        foreach($rows6 as $row6)
                        {   
                            ?>

                        <li>
                        <div id="details"> 
                            <video id="detailsImg" >
                                <source src="test_uploads/<?php echo $row6["fileName"] ?>" type="video/mp4">
                            </video>    
                            <h3 id="test"> <?php echo $row6["title"] ?> </h3>
                            <?php 

                                foreach($varChannelIds as $varChannelId)
                                {
                                    $ID = $varChannelId["channel"];
                                    $rows7 = $db->query("SELECT name FROM Channel WHERE id=$ID");
                                    foreach($rows7 as $row7)
                                    {
                                        ?>
                                        <h5><?php echo $row7["name"] ?>  </h5>
                                        <?php
                                    }
                                break;
                                }
                                $chan = $row6["channel"];
                                $channels = $db->query("SELECT * FROM Channel WHERE id=$chan");
                                foreach($channels as $channel)
                                {
                                    $vid = $row6["id"];
                                    $views = $db->query("SELECT * FROM Views WHERE video=$vid")->rowCount();
                                    ?>
                                    <h5><?php echo $views ?> views 
                                    &bull;
                                    2 months ago
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
                            // $db = new PDO("mysql:dbname=278project", "root","");
                            $rows = $db->query("SELECT * FROM Video WHERE id=$vid_id_link ");
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
                                

                            } 

                            //for likes and dislikes
                            // if(isset($_POST['likeImage'])) {
                            //     $sqlLike = "UPDATE `Likes` SET is_liked='1' WHERE id=$vid_id_link ";
                            //     $db->exec($sqlLike);
                            // };
                            // if(isset($_POST['dislikeImage'])) {
                            //     $sqlDislike = "UPDATE `Likes` SET is_liked='0' WHERE id=$vid_id_link ";
                            //     $db->exec($sqlDislike);
                            // };
                             
                            //to display dislikes 
                            $rows12 = $db->query("SELECT is_liked FROM Likes WHERE id=$vid_id_link   ");
                            $countDislikes=0; //dislikes count
                            foreach($rows12 as $row12){
                                if( $row12["is_liked"] == 0){
                                    $countDislikes++;
                                }
                            };
                            //to display likes 
                            $rows1 = $db->query("SELECT is_liked FROM Likes WHERE id=$vid_id_link  ");
                            $countLikes =0; //likes count
                            foreach($rows1 as $row1){
                                if( $row1["is_liked"] == 1 ){
                                        $countLikes++;
                                    }
                                };

                            #for channel name ( tuber name)
                            $rows2 = $db->query("SELECT name FROM Channel WHERE id=$channelId ");
                            $tuberName="";
                            foreach($rows2 as $row2){
                                $tuberName = $row2["name"];
                            };

                            #for subscribers( sub count)
                            $rows3 = $db->query("SELECT subscriber FROM Subscription WHERE channel=$channelId");
                            $subsCount=0;
                            
                            foreach($rows3 as $row3){
                                $subsCount++;
                            };

                            #for comment count
                            $rows4 = $db->query("SELECT * FROM VideoComment WHERE video=$vid_id_link  ");
                            $CommentCount=0;
                            $varCommentid=0;
                            foreach($rows4 as $row4){
                                $CommentCount++;
                               
                               
                            };       
                            #display video views
                            $rows8 = $db->query("SELECT * FROM Views WHERE video=$vid_id_link  ");
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
                        <script>
                            document.write( '&nbsp'+ new Date().toDateString()); 
                       </script>
                </div>

                
              
                <div id="likeMenu">
                   
                    <button id="likeImage" value="likeImage" name="likeImage"onclick="window.location.href='signin.php'" ></button>
                    <span class="likes"> <?=$countLikes?> </span>
                    <button id="dislikeImage"  value="dislikeImage" name="dislikeImage"onclick="window.location.href='signin.php'"></button>
                    <span class="likes"> <?=$countDislikes?> </span>
                   
                    <button id="shareImage"></button>
                    <span class="likes"> SHARE </span>
                    <button id="saveImage"></button>
                    <span class="likes"> SAVE </span>
                    <!-- onclick report -->
                    <button id="dotsImage" onclick="myFunction()" class="popup">
                    <div> 
                        <span class="popuptext" id="myPopup">A Simple Popup!
                        <ul id="reportList">
                        <li> <input type="button" placeholder="Report" value="Report" id="reportBtn" > </li>
                        </ul>
                        </span>
                    </div>
                    </button> 
                    
                </div>
               

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
                        <p>Share</p>
                        <button id="iconButton">
                        <img id="iconImages"src="images/facebookIcon.png" alt="Avatar" style="width:70px" onclick="window.location.href='https://www.facebook.com/';">
                        <br>
                        <span> Facebook</span>
                        </button>
                    </div>
                </div>   

            </div>

            <div id="descriptionCont">
                <input type="button" id="tuberImage">
                <div id="tuberInfo">
                        <span class="tuberName"> <?= $tuberName ?>
                        </span>
                        <br>
                        <span class="tuberSubs"> <?=$subsCount ?> subscribers</span> 
                    
                        <button id="subButton" name="subButton" onclick="window.location.href='signin.php'" > Subscribe</button>
                 
                        <!-- <button id="subButton" name="subButton"> Subscribe</button> -->
                        <input type="button" id="notifImage">
                </div>
                <br>
                <div id="description">
                    <?= $des ?>
                </div>
            </div>

          
           
            
            <div id="commentsBox">

                <span class="commentsBoxS"> <?=$CommentCount ?> comments</span>
                <input type="text" name="commentInput" id="commentInput" placeholder="Add a public comment">
                <div id="commentBtns">
                    <button id="cancelCommBtn" onclick="document.getElementById('commentInput').value = ''">CANCEL</button>
                    <button id="commentBtn" name="commentBtn" onclick="window.location.href='signin.php'">COMMENT</button>
                </div>
                
                <?php
                

                ?>
               

                <?php
                if(isset($_POST['viewReply'])){
                    $test2=$_POST['commentIDinput'];
                    $replyTables = $db->query("SELECT * FROM `CommentReply` WHERE `CommentReply`.`parent_id` = $test2 AND `CommentReply`.`video` = '$vid_id_link ';");
                    $replyContentDb="";
                    $replyNam_db=$_POST['replyName_db'];
                    foreach($replyTables as $replyTable){
                        $replyContentDb= $replyTable['reply'];
                        ?>
                        <div id="replyBox">
                            <input type="button" id="tuberImage">
                            <div id="replyName"> <?= $replyNam_db ?></div>
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
                ?>
                
                
                <?php
                $g = true;
                if( $g == true){
                    $commentDbs = $db->query("SELECT * FROM VideoComment WHERE video=$vid_id_link  ");
                    foreach($commentDbs as $commentDb){

                        $commContent= $commentDb["comment"];
                        $commentID= $commentDb["id"];

                        #for comment author  name
                         $author=$commentDb["author"]; //make author = var , id=author
                         $rows5 = $db->query("SELECT name FROM Channel WHERE id= $author ");
                         $commenterName="";
                        ?>
                         
                      
                        <?php
                         $replyName="";
                         foreach($rows5 as $row5){
                             $commenterName = $row5["name"];
                             $replyName = $row5["name"];
                             ?>
                         
                            <form action="" method="post">
                            
                            <input type="hidden" value="<?= $replyName?>"  name="replyName_db">
                            </form>
                          
                             <?php
                         };
                         ?>
                       
                         
                         <?php
                         
                        // echo $commentID;
                        $commentLikes = $db->query("SELECT * FROM CommentLikes WHERE video=$vid_id_link  AND id= $commentID AND is_liked=1");
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

                     

                         <div id="comment">
                            <input type="button" id="tuberImage">
                            <div id="commName">  <?=$commenterName?> </div>
                            <div id="commContent"> <?=$commContent?></div>
                            <div id="likeMenuComm"> 
                            <button id="likeImageComm" name="likeImageComm" onclick="window.location.href='signin.php'"></button>
                            <span class="likesComm"> <?=$likeCommCount?> </span>
                            <button id="dislikeImageComm" name="dislikeImageComm" onclick="window.location.href='signin.php'"></button>
                            <button id="reply" name="reply" onclick="window.location.href='signin.php'"> REPLY</button>
                            <form action="" method="post">
                            <input type="hidden" value="<?= $commentID ?>"  name="commentIDinput"  >
                             <br>
                          
                            <button id="viewReply" name="viewReply"> View reply </button>
                            </form>

                            </div>
                        </div>
                       

                       
                        <?php
                };
                }
                else{
                    echo "No comments yet";
                }

                ?>
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
        var btn1 = document.getElementById("reportBtn");
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