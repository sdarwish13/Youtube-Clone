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

                    $emailLinks = $db->query("SELECT * FROM `Channel` WHERE owner='$email'");
                    // $replyTables = $db->query("SELECT * FROM `CommentReply` WHERE `CommentReply`.`parent_id` = $test2 AND `CommentReply`.`video` = '$vid_id_link ';");
                    $id_linked="";
                    foreach($emailLinks as $emailLink){
                        // $owner=$emailLink["owner"];
                        // if($email == $owner){
                            $id_linked = $emailLink["id"];
                        // }
                    // break;
                    }

                    $testing62s = $db->query("SELECT * FROM `Views` WHERE `viewer` != '$id_linked'");
                    foreach($testing62s as $testing62){
                        $view = "INSERT INTO `Views` (`viewer`, `video`) VALUES ('$id_linked ', '$vid_id_link')";
                        $db->exec($view);
                    }


                    
            

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

                <!-- <input type="button" id="vidImage"> -->
                <input type="button" id="vidImage" onclick="window.location.href='upload_vid.php?fname=<?php echo $fname?> &lname=<?php echo $lname?> &email=<?php echo $email?> '">
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
                   
                ?>

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
                            <video id="detailsImg" onclick="window.location.href = `watchvideo.php?fname=<?php echo $fname ?>&lname=<?php echo $lname ?>&email=<?php echo $email ?>&id=<?php echo $vid ?>`">
                                <source src="test_uploads/<?php echo $row6["fileName"] ?>" type="video/mp4">
                            </video>    
                            <h3 id="test"> <?php echo $row6["title"] ?> </h3>
                            <?php 

                                foreach($varChannelIds as $varChannelId)
                                {
                                    $ID = $varChannelId["channel"];
                                    $rows7 = $db->query("SELECT name FROM Channel WHERE id='$ID'");
                                    foreach($rows7 as $row7)
                                    {
                                        ?>
                                        <h5><?php echo $row7["name"] ?>  </h5>
                                        <?php
                                    }
                                break;
                                }
                                $chan = $row6["channel"];
                                $channels = $db->query("SELECT * FROM Channel WHERE id='$chan'");
                                foreach($channels as $channel)
                                {
                                    $vid = $row6["id"];
                                    $views = $db->query("SELECT * FROM Views WHERE video='$vid'")->rowCount();
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
                            } 

                            // $conn= new mysqli('localhost', 'root', '','278project');
                            //for likes and dislikes
                            if(isset($_POST['likeImage'])) {
                                $sqlLike = "UPDATE `Likes` SET is_liked='1' WHERE video=$vid_id_link AND viewer=$id_linked";
                                $db->exec($sqlLike);
                                // $conn->query($sqlLike);

                                // $sqlLike12="INSERT INTO `Likes` (`viewer`, `video`, `is_liked`) VALUES ('$id_linked', '$vid_id_link', '1');"; 
                                // $db->exec($sqlLike12);
                                // $conn->query($sqlLike12);

                                $insertlikes1 = $db->query("SELECT * FROM `Likes` WHERE `viewer` != $id_linked");
                                foreach($insertlikes1 as $insertlike1 ){
                                    $sqlLike12="INSERT INTO `Likes` (`viewer`, `video`, `is_liked`) VALUES ('$id_linked', '$vid_id_link', '1');";
                                    $db->exec($sqlLike12);
                                }
                               
                               
                            };
                            if(isset($_POST['dislikeImage'])) {
                                $sqlDislike = "UPDATE `Likes` SET is_liked='0' WHERE video=$vid_id_link AND viewer=$id_linked ";
                                $db->exec($sqlDislike);

                                // $dislikesCount1=$db->query("SELECT * FROM Likes")->rowCount();
                                // $dislikesCount1++;
                                // $sqldisLike12="INSERT INTO `Likes` (`viewer`, `video`, `is_liked`) VALUES ('$id_linked', '$vid_id_link', '0');"; 
                                // $db->exec($sqldisLike12);

                                $insertdislikes1 = $db->query("SELECT * FROM `Likes` WHERE `viewer` != $id_linked");
                                foreach($insertdislikes1 as $insertdislike1 ){
                                    $sqldisLike12="INSERT INTO `Likes` (`viewer`, `video`, `is_liked`) VALUES ('$id_linked', '$vid_id_link', '0');"; 
                                    $db->exec($sqldisLike12);

                                }
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
                            $rows2 = $db->query("SELECT name FROM Channel WHERE id='$channelId' ");
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
                        <script>
                            document.write( '&nbsp'+ new Date().toDateString()); 
                       </script>
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
                        <p>Save to...</p>
                        <br>
                       
                        <button id="addWatchLater" name="addWatchLater" value="Watch Later">Watch Later</button>
                        
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
                        <form action="" method="post" id="formSub">
                        <button id="subButton" name="subButton"> Subscribe</button>
                        </form>
                        <!-- <button id="subButton" name="subButton"> Subscribe</button> -->
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

                //on click sub to channel

            
                if (isset($_POST['subButton'])){
                    $subs_table= "INSERT INTO `Subscription` (`subscriber`, `channel`) VALUES ('$id_linked', '$channelId')";
                    $db->exec($subs_table);
                    // echo"successsss!";

                    // $testings21 = $db->query("SELECT * FROM `Subscription` WHERE `subscriber` = $id_linked");
                    // foreach($testings21 as $testing21){
                    //     $subs_table= " DELETE FROM `Subscription` WHERE `Subscription`.`subscriber` = '$id_linked' AND `Subscription`.`channel` = '$channelId'";
                    //     $db->exec($subs_table);
                    // }
                

                }
                // echo  "  this is sub ",$id_linked;
                // echo " this is channel id",$channelId;
              
                //to insert a comment
                $commContent="";
                if(isset($_POST['commentBtn']) ){
                    // $db = new PDO("mysql:dbname=278project", "root","");
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


                    echo" success reply saved to db!";
                    echo "this is :" ,$replyContent;
                }

                //likes and dislike for comments //need to insert if first time liking
                if(isset($_POST['likeImageComm'])){  

                    $test1=$_POST['commentIDinput'];
                    $sqlLikeComment1="UPDATE `CommentLikes` SET `is_liked` = '1' WHERE  `CommentLikes`.`id` = $test1 AND `CommentLikes`.`video` = '$vid_id_link' AND `CommentLikes`.`viewer`='$id_linked'; "; 
                    $db->exec($sqlLikeComment1);

                    $insertlikes1c = $db->query("SELECT * FROM `CommentLikes` WHERE `viewer` != '$id_linked'");
                        foreach($insertlikes1c as $insertlike1c ){
                         
                            $sqlCommLike12="INSERT INTO `CommentLikes` (`viewer`, `id`, `video`, `is_liked`) VALUES ('$id_linked', '$test1', '$vid_id_link', '1');"; 
                            $db->exec($sqlCommLike12);     
                    }


                   
                };
                if(isset($_POST['dislikeImageComm'])){

                    $test1=$_POST['commentIDinput'];
                    //WHERE `CommentLikes`.`viewer` = '3'
                    $sqldisLikeComment="UPDATE `CommentLikes` SET `is_liked` = '0' WHERE `CommentLikes`.`id` = $test1 AND `CommentLikes`.`video` = '$vid_id_link ' AND `CommentLikes`.`viewer`='$id_linked'; "; 
                    $db->exec($sqldisLikeComment);

                   $insertlikes1cd = $db->query("SELECT * FROM `CommentLikes` WHERE `viewer` != '$id_linked'");
                        foreach($insertlikes1cd as $insertlike1cd ){
                          
                            $sqlCommdLike12="INSERT INTO `CommentLikes` (`viewer`, `id`, `video`, `is_liked`) VALUES ('$id_linked', '$test1', '$vid_id_link', '0');"; 
                            $db->exec($sqlCommdLike12);     
                    }
                };

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
                            // else if($commentLike["is_liked"] == 0){
                            //     $dislikeCommCount++;
                            // }
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

   
//   document.querySelector('button.LikeI,').addEventListener("click", function() {
//     this.type = "submit";
//     });


    // var form = document.getElementById("myForm");
    // function handleForm(event) { event.preventDefault(); } 
    // form.addEventListener('submit', handleForm);

    
    // var commentBtn = document.getElementById("commentBtn");
    // commentBtn.onclick = createAddForm;
    // commentBtn.onclick="location.href=location.href";

    // var replyBtn = document.getElementById("reply");
    // replyBtn.onclick = createReplyForm;
    // // replyBtn.onclick ="location.href=location.href";

    // function createReplyForm(){
    //     var commentsBox = document.getElementById("commentsBox");

    //     var replyBox= document.createElement("div");
    //     replyBox.id="commment";

    //     var inputImageR = document.createElement("input");
    //     inputImageR.id= "tuberImage";
    //     inputImageR.type="button";

    //     var commNameR= document.createElement("div");
    //     commNameR.id="commName";

    //     var commentInputR  = "ghinaaaa test reply "
    //     // document.getElementById("commentInput");
    //     var commContentR = document.createElement("div");
    //     commContentR.id ="commContent";

    //     if(commentInputR.value.length > 0 ){
    //         commContentR.innerHTML=commentInputR.value;
            
    //     }
    //     else{
    //         console.log("empty comment");
    //         return;
    //     }

    //     var likeMenuCommR = document.createElement("div");
    //     likeMenuCommR.id="LikeMenuComm";

    //     var likeCommR = document.createElement("button");
    //     likeCommR.id="likeImageComm";

    //     var dislikeCommR = document.createElement("button");
    //     dislikeCommR.id="dislikeImageComm";


    //     var replyR= document.createElement("button");
    //     replyR.id="reply";
    //     replyR.innerHTML= "REPLY";

    //     replyBox.appendChild(inputImageR);
    //     replyBox.appendChild(commNameR);
    //     replyBox.appendChild(commContentR);
    //     replyBox.appendChild(likeMenuCommR);
    //     replyBox.appendChild(likeCommR);
    //     replyBox.appendChild(dislikeCommR);
    //     replyBox.appendChild(replyR);

    //     commentsBox.appendChild(replyBox);

    //     console.log("SUCCESS Comment!");
    //     document.getElementById('commentInput').value = ''

    // }

    // function createAddForm() {
    //     var commentsBox = document.getElementById("commentsBox");

    //     var comment= document.createElement("div");
    //     comment.id="commment";

    //     var inputImage = document.createElement("input");
    //     inputImage.id= "tuberImage";
    //     inputImage.type="button";

    //     var commName= document.createElement("div");
    //     commName.id="commName";

    //     var commentInput  = document.getElementById("commentInput");
    //     var commContent = document.createElement("div");
    //     commContent.id ="commContent";

    //     if(commentInput.value.length > 0 ){
    //         commContent.innerHTML=commentInput.value;
            
    //     }
    //     else{
    //         console.log("empty comment");
    //         return;
    //     }

    //     var likeMenuComm = document.createElement("div");
    //     likeMenuComm.id="LikeMenuComm";

    //     var likeComm = document.createElement("button");
    //     likeComm.id="likeImageComm";

    //     var dislikeComm = document.createElement("button");
    //     dislikeComm.id="dislikeImageComm";


    //     var reply = document.createElement("button");
    //     reply.id="reply";
    //     reply.innerHTML= "REPLY";

    //     comment.appendChild(inputImage);
    //     comment.appendChild(commName);
    //     comment.appendChild(commContent);
    //     comment.appendChild(likeMenuComm);
    //     comment.appendChild(likeComm);
    //     comment.appendChild(dislikeComm);
    //     comment.appendChild(reply);
        
    //     commentsBox.appendChild(comment);

    //     console.log("SUCCESS Comment!");
    //     // document.getElementById('commentInput').value = ''

    // }   
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