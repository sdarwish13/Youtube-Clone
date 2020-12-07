<!DOCTYPE html>

<html>
	<body>
		<?php

			$db  = new PDO("mysql:dbname=278project;hostname=localhost", "root", "");
			$rows = $db->query("SELECT * FROM Account");
			?> 
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
	</body>
</html>
