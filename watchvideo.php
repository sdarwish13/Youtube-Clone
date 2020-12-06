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
            <div id="buttons">
                <input type="button" id="vidImage">
                <input type="button" id="gridImage">
                <input type="button" id="bellImage">
                <input type="button" id="profileImage">
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
                            <!-- <img src="images/videoimg.jpg" alt="youtube logo" id="detailsImg" > -->
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

                                $rows9 = $db->query("SELECT * from Views where video=1")->rowCount();
                                

                                //TO DISPLAY VIEWSSSSSSSS!!!!!!!!!

                                // for( $i=0; $i< 4 ; $i++){
                                //     $rows9 = $db->query("SELECT * FROM Views WHERE video=$i ");
                                //     $viewsCount1=0;

                                //     foreach($rows9 as $row9)
                                //         {
                                            
                                //         if($row9["video"] == $i){
                                //             $viewsCount1++;
                                //         }
                                            // ?>
                                            // <h5><?=$viewsCount1 ?>  views
                                            // &bull;
                                            // 2 months ago
                                            // </h5>
                                            // <?php
                                //         }
                                //     break;
                                // }
                                //TO DISPLAY VIEWSSSSSSSS!!!!!!!!!
                                


                                
                                  
                                

                            ?>
                            <!-- <img src="images/videoimg.jpg" alt="youtube logo" id="detailsImg" > -->
                            <!-- <h3> Video title</h3> -->
                            <!-- <h5> Youtuber name</h5> -->
                            <!-- <h5>
                                1.2M 
                                &bull;
                                2 months ago
                            </h5> -->
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
                            $db = new PDO("mysql:dbname=278project", "root","");
                            $rows = $db->query("SELECT * FROM Video WHERE id=1");
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
                            } 
                           

                            //for likes and dislikes
                            $sqlLike = "UPDATE `Likes` SET is_liked='1' WHERE id=1";
                            $sqlDislike = "UPDATE `Likes` SET is_liked='0' WHERE id=1";

                            $rows1 = $db->query("SELECT is_liked FROM Likes ");
                            $countLikes =0; //likes count
                            $countDislikes=0; //dislikes count
                            foreach($rows1 as $row1){
                                if( $row1["is_liked"] == 1 ){
                                    $countLikes++;
                                }
                                else if( $row1["is_liked"] == 0){
                                    $countDislikes++;
                                }
                            };

                            #for channel name ( tuber name)
                            $rows2 = $db->query("SELECT name FROM Channel WHERE id=1 ");
                            $tuberName="";
                            foreach($rows2 as $row2){
                                $tuberName = $row2["name"];
                            };

                            #for subscribers( sub count)
                            $rows3 = $db->query("SELECT subscriber FROM Subscription WHERE channel=1 ");
                            $subsCount=0;
                            
                            foreach($rows3 as $row3){
                                $subsCount++;
                            };

                            #for comment count
                            $rows4 = $db->query("SELECT * FROM VideoComment WHERE video=1 ");
                            $CommentCount=0;
                            foreach($rows4 as $row4){
                                $CommentCount++;
                            };
                            #for comment author  name
                            $var=1; //make author = var , id=author
                            $rows5 = $db->query("SELECT name FROM Channel WHERE id= $var");
                            $commenterName="";
                            foreach($rows5 as $row5){
                                $commenterName = $row5["name"];
                                
                            };

                            $rows8 = $db->query("SELECT * FROM Views WHERE video=1 ");
                            $viewsCount=0;
                                foreach($rows8 as $row8){
                                    $viewsCount++;
                            };
                        
                     
                          
                           
                            ?>
                </div>
            
                <!-- <iframe  id = "watchVideo" src="test_uploads" type="video/mp4"></iframe> -->

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
               
                    <button id="likeImage" onclick= "likeBtn()"></button>
                    <span class="likes"> <?= $countLikes ?> </span>
                    <button id="dislikeImage" onclick="dislikeBtn()"></button>
                    <span class="likes"> <?= $countDislikes ?></span>
                    <button id="shareImage"></button>
                    <span class="likes"> SHARE </span>
                    <button id="saveImage"></button>
                    <span class="likes"> SAVE </span>
                    <!-- onclick report -->
                    <button id="dotsImage"></button> 
                </div>   
            </div>

            <div id="descriptionCont">
                <input type="button" id="tuberImage">
                <div id="tuberInfo">
                        <span class="tuberName"> <?= $tuberName ?>
                        </span>
                        <br>
                        <span class="tuberSubs"> <?=$subsCount ?> subscribers</span> 
                        <button id="subButton" onclick=""> Subscribe</button>
                        <input type="button" id="notifImage">

                    
                </div>
                <br>
                <div id="description">
                    <?= $des ?>
                    <!-- Hey y'all come vibe w me today. Thanks to Missguided for sponsoring this video! Missguided is starting Cyber week early! Check out some of their amazing offers throughout this month and shop the links below #Missguided #Magiclinks . I've been struggling with staying motivated..but I've been making an effort to not break the chain which has been helping. -->

                </div>
            </div>
            <div id="commentsBox">

                <span class="commentsBoxS"> <?=$CommentCount ?> comments</span>

                <input type="text" name="commentInput" id="commentInput" placeholder="Add a public comment">

                <div id="commentBtns">
                    <button id="cancelCommBtn" onclick="document.getElementById('commentInput').value = ''">CANCEL</button>
                    <button id="commentBtn" onclick="commentBtn()">COMMENT</button>
                </div>

                <div id="comment">
                    <input type="button" id="tuberImage">
                    <div id="commName">  <?=$commenterName?> </div>
                    <div id="commContent"> </div>
                    <div id="likeMenuComm"> 
                        <button id="likeImageComm"></button>
                        <span class="likesComm"> 300 </span>
                        <button id="dislikeImageComm"></button>
                        <button id="reply"> REPLY</button>
                    </div>
                </div>
            </div>



</body>
<script>
    
    var commentBtn = document.getElementById("commentBtn");
    commentBtn.onclick = createAddForm;

    // var likeBtn = document.getElementById("likeBtn");
    // likeBtn.onclick=likeBtn;


    function likeBtn()
    {
            // var likeBtn=document.getElementbyId("likeImage")
            // likeBtn.style.background= "url("images/liked.png") no-repeat";
            <?php $db->exec($sqlLike); ?> 
           
    }
    function dislikeBtn()
    {
            <?php 
          
                $db->exec($sqlDislike); 
        
            ?>   
    }

    function createAddForm() {
        var commentsBox = document.getElementById("commentsBox");

        var comment= document.createElement("div");
        comment.id="commment";

        var inputImage = document.createElement("input");
        inputImage.id= "tuberImage";
        inputImage.type="button";

        var commName= document.createElement("div");
        commName.id="commName";

        var commentInput  = document.getElementById("commentInput");
        var commContent = document.createElement("div");
        commContent.id ="commContent";
        commContent.innerHTML=commentInput.value;
        
        var likeMenuComm = document.createElement("div");
        likeMenuComm.id="LikeMenuComm";

        var likeComm = document.createElement("button");
        likeComm.id="likeImageComm";

        var dislikeComm = document.createElement("button");
        dislikeComm.id="dislikeImageComm";


        var reply = document.createElement("button");
        reply.id="reply";
        reply.innerHTML= "REPLY";

        comment.appendChild(inputImage);
        comment.appendChild(commName);
        comment.appendChild(commContent);
        comment.appendChild(likeMenuComm);
        comment.appendChild(likeComm);
        comment.appendChild(dislikeComm);
        comment.appendChild(reply);
        
        commentsBox.appendChild(comment);

        console.log("SUCCESS Comment!");
        document.getElementById('commentInput').value = ''
        
    }   
     
      
            
            </script>

</html>