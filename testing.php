<?php
				
					try {
						/**
						$conn = new PDO("mysql:host=localhost;dbname=278project","root","");
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$sql = "SELECT email FROM signup WHERE fname LIKE '%$email%'";
						$conn->exec($sql);
						echo $sql;
						**/
						$db = new PDO("mysql:dbname=278project", "root", "");
						$rows = $db->query("SELECt * FROM signup WHERE email LIKE '.com%'");
						foreach ($rows as $row){
							?> <p>First name: <?= $row["fname"]?>,Last name: <?= $row["lname"]?></p>
							<?php
						}
					} catch(PDOException $e){
						echo $sql . "<br>" . $e->getMessage();
					}
				
				$conn = null;
			
			?>