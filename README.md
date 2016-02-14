<html>
	<head>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<style>
			body {
				font-family: 'Open Sans', sans-serif;
			}
			ul > li {
				font-size: 15px;
			}
			ul > li > ul > li {
				font-size: 12px;
			}
			h2 {
				text-align: center;
			}
		</style>
	</head>
	<body>
		
		<div>
			<h2>In class project for Database.</h2>
			
			<h5>Technologies used for the project:</h5>
			<ul>
				<li>R language and R studio is used for fetching Tweets from twitter based on some #hashtags.
					<ul><li>Some of the #hashtags were: #markzuckerburg, #donaldtrump, #cybermonday, #twitteranalytics.</li></ul>
				</li><br>
				<li>For web we used HTML, PHP, CSS, JavaScript, J Query, Bootstrap</li><br>
				<li>MYSQL as our default Database</li><br>
			</ul>
		</div>
		</div>
			<h5>Some of the basic query in here are:</h5>

			<code>
				SELECT text,retweetCount FROM `tweet` AS t INNER JOIN tweetpopularity AS tp ON t.tweetId = tp.tweetId WHERE NOT tp.retweetCount = 'NULL' AND tp.retweetCount > 1000 AND tp.retweetCount <5000 LIMIT 10
			</code>
			<br><br>
			<code>
				SELECT MAX(tweetpopularity.retweetCount) AS MaxRetweetCount, tweet.text from tweet 
				INNER JOIN tweetpopularity ON tweet.tweetId = tweetpopularity.tweetId GROUP BY tweet.text 
				ORDER BY MaxRetweetCount DESC LIMIT 10 OFFSET 10
			</code>
			<br><br>
			<code>
				SELECT tweet.text, tweetpopularity.favoriteCount FROM `tweetpopularity` 
				INNER JOIN tweet ON tweetpopularity.tweetId = tweet.tweetId 
				where favoriteCount != 0 group by favoriteCount limit 10 offset 10
			</code>
		</div>
	</body>
</html>