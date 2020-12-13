<?php

$localhost = "localhost"; #localhost
$dbusername = "root"; #username of phpmyadmin
$dbpassword = "";  #password of phpmyadmin
$dbname = "278project";  #database name
 

#connection string
$conn = mysqli_connect($localhost,$dbusername,$dbpassword,$dbname);

$fileName = $_FILES["file1"]["name"]; // The file name
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file1"]["type"]; // The type of file it is
$fileSize = $_FILES["file1"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true

foreach($conn->query('SELECT COUNT(*) FROM Video') as $row) {
	$videoid =  $row['COUNT(*)'] + 1;
}

setcookie("id", $videoid);

if (!$fileTmpLoc) { // if file not chosen
    echo "ERROR: Please browse for a file before clicking the upload button.";
    exit();
}
if(move_uploaded_file($fileTmpLoc, "test_uploads/$fileName")){
	$sql = "INSERT into Video(id, fileName,location) VALUES('$videoid', '$fileName','test_uploads/')";
	if(mysqli_query($conn,$sql)){
		echo "$fileName upload is complete"; 
    }
    else{
        echo "Error";
    }
} else {
    echo "move_uploaded_file function failed";
}
?>