<!DOCTYPE html>

<html>
	<body>
		<?php

			$db  = new PDO("mysql:dbname=278project;hostname=localhost", "root", "");
			$rows = $db->query("SELECT * FROM Account");
			?> 
			<h1>Registered Accounts</h1>
			<table width="50%">
			<tr>
			<th style="border: 1px solid black;">First Name</th>
			<th style="border: 1px solid black;">Last Name</th>
			<th style="border: 1px solid black;">Email</th>
			<th style="border: 1px solid black;">Password</th>
			<th style="border: 1px solid black;">Action</th>
			</tr>
			<?php
			foreach($rows as $row){
				?>
				<tr>
					<td style="border: 1px solid black;">		
					<?php
					print $row["fname"];
					?>
					</td>
					<td style="border: 1px solid black;">
					<?php
					print $row["lname"];
					?>
					</td>
					<td style="border: 1px solid black;">
					<?php
					print $row["email"];
					?>
					</td>
					<td style="border: 1px solid black;">
					<?php
					print $row["pass"];
					?>
					</td>
					<td style="border: 1px solid black;">
					<a href="deleteAccount.php?email=<?=$row['email']?>" onclick="javascript:return confirm('Are you sure you want to delete this book?');"> Delete </a>
					</td>
					</td>
					
				</tr>
					<?php
			}

		?>
			</table>
			
			<h1>Reported Videos</h1>
			<table width="50%">
			<tr>
			<th style="border: 1px solid black;">Title</th>
			<th style="border: 1px solid black;">Channel</th>
			<th style="border: 1px solid black;">Description</th>
			<th style="border: 1px solid black;">Status</th>
			<th style="border: 1px solid black;">Restriction</th>
			<th style="border: 1px solid black;">Action</th>
			</tr>
			<?php
			$videos = $db->query("SELECT * FROM Report");
			foreach($videos as $row){
				$theid= $row["video"];
				$vidloop = $db->query("SELECT * FROM Video WHERE id=$theid ");
				foreach ($vidloop as $innerrow){
				?>
				<tr>
					<td style="border: 1px solid black;">		
					<?php
					print $innerrow["title"];
					?>
					</td>
					<td style="border: 1px solid black;">
					<?php
					$thename = $innerrow["channel"];
					$channelname = $db->query("SELECT name FROM Channel WHERE id = $thename");
					foreach ($channelname as $names){
						print $names["name"];						
					}
					?>
					</td>
					<td style="border: 1px solid black;">
					<?php
					print $innerrow["description"];
					?>
					</td>
					<td style="border: 1px solid black;">
					<?php
					if ($innerrow["private"] == 1){
						print "Private";						
					}else{
						print "Public";
					}
					?>
					</td>
					<td style="border: 1px solid black;">
					<?php
					if($innerrow["restriction"] == 1){
						print "Restricted";
					}else{
						print "None";
					}
					?>
					</td>
					<td style="border: 1px solid black;">
					<a href="deleteVideo.php?id=<?=$innerrow['id']?>" onclick="javascript:return confirm('Are you sure you want to delete this book?');"> Delete </a>
					</td>
					</td>
					
				</tr>
					<?php
					
				}
			}

		?>

			</table>
	</body>
</html>
