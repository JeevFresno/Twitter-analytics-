<?php

	class TwitterDB {
		
		function getDBConnection() {
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "tweets";
			$tweets = array();
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			mysqli_set_charset($conn, 'utf8mb4');
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			return $conn;
		}
		
		function closeDBConnection($conn) {
			$conn->close();
		}
		
		function getRetweetCountAndText() {
			$sql = "SELECT text,retweetCount FROM `tweet` AS t INNER JOIN tweetpopularity AS tp ON t.tweetId = tp.tweetId WHERE NOT tp.retweetCount = 'NULL' AND tp.retweetCount > 1000 AND tp.retweetCount <5000 LIMIT 10 ";
			$twitterDB = new TwitterDB();
			$conn = $twitterDB->getDBConnection();
			$result = $conn->query($sql);
			$tweets = array();
			
			if ($result->num_rows > 0) {
				// output data of each row
				$i = 0;
				while($row = $result->fetch_assoc()) {
					$tweets[$i]["text"] = htmlentities($row["text"]);
					$tweets[$i]["retweetCount"] = $row["retweetCount"];
					settype($tweets[$i]["retweetCount"], "integer");			
					$i++;
				}
			}
			$twitterDB->closeDBConnection($conn);
			return $tweets;
		}
		
		function getStatusSource() {
			$sql = "SELECT statusSource, COUNT(statusSource) AS statusCount FROM `tweetsource` GROUP BY statusSource DESC";
			$twitterDB = new TwitterDB();
			$conn = $twitterDB->getDBConnection();
			$result = $conn->query($sql);
			$tweets = array();
			
			if ($result->num_rows > 0) {
				// output data of each row
				$i = 0;
				while($row = $result->fetch_assoc()) {
					$regex = '#<\s*?a\b[^>]*>(.*?)</a\b[^>]*>#s';
					$code = preg_match($regex, $row["statusSource"], $matches);
					$tweets[$i]["statusSource"] = $matches[1];
					$tweets[$i]["statusCount"] = $row["statusCount"];
					settype($tweets[$i]["statusCount"], "integer");
					$i++;
				}
			}
			$twitterDB->closeDBConnection($conn);
			return $tweets;
		}
		
		function getTweetsOfDifferentDays() {
			$sql = "SELECT SUBSTRING(created,1,11) AS created, count(created) AS createdCount FROM tweet GROUP BY SUBSTRING(created,1,11)";
			$twitterDB = new TwitterDB();
			$conn = $twitterDB->getDBConnection();
			$result = $conn->query($sql);
			$tweets = array();
			
			if ($result->num_rows > 0) {
				// output data of each row
				$i = 0;
				while($row = $result->fetch_assoc()) {
					$created = explode(" ", $row["created"]);
					$tweets[$i]["created"] = "Date : " . $created[0] . "\t Time : " . $created[1] . " AM/PM";
					$tweets[$i]["createdCount"] = $row["createdCount"];
					settype($tweets[$i]["createdCount"], "integer");
					$i++;
				}
			}
			$twitterDB->closeDBConnection($conn);
			return $tweets;
		}
		
		function getMaxRetweetCount() {
			$sql = "SELECT MAX(tweetpopularity.retweetCount) AS MaxRetweetCount, tweet.text from tweet 
					INNER JOIN tweetpopularity ON tweet.tweetId = tweetpopularity.tweetId GROUP BY tweet.text 
					ORDER BY MaxRetweetCount DESC LIMIT 10 OFFSET 10";
			$twitterDB = new TwitterDB();
			$conn = $twitterDB->getDBConnection();
			$result = $conn->query($sql);
			$tweets = array();
			
			if ($result->num_rows > 0) {
				// output data of each row
				$i = 0;
				while($row = $result->fetch_assoc()) {
					$tweets[$i]["text"] = $row["text"];
					$tweets[$i]["MaxRetweetCount"] = $row["MaxRetweetCount"];
					settype($tweets[$i]["MaxRetweetCount"], "integer");
					$i++;
				}
			}
			$twitterDB->closeDBConnection($conn);
			return $tweets;
		}
		
		function getFavoriteCount() {
			$sql = "SELECT tweet.text, tweetpopularity.favoriteCount FROM `tweetpopularity` 
					INNER JOIN tweet ON tweetpopularity.tweetId = tweet.tweetId 
					where favoriteCount != 0 group by favoriteCount limit 10 offset 10";
			$twitterDB = new TwitterDB();
			$conn = $twitterDB->getDBConnection();
			$result = $conn->query($sql);
			$tweets = array();
			
			if ($result->num_rows > 0) {
				// output data of each row
				$i = 0;
				while($row = $result->fetch_assoc()) {
					$tweets[$i]["text"] = $row["text"];
					$tweets[$i]["favoriteCount"] = $row["favoriteCount"];
					settype($tweets[$i]["favoriteCount"], "integer");
					$i++;
				}
			}
			$twitterDB->closeDBConnection($conn);
			return $tweets;
		}
		
		function printArray($arr) {
			echo "<pre>";
			print_r($arr);
			echo"</pre>";
			die;
		}
	}
	
?>