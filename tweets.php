<html>
<head>
<?php	
	include('TwitterDB.php');
	include('Chart.php');
	$twitterDB = new TwitterDB();
	//$twitterDB->printArray($_SERVER);
	$chart = new Chart('PieChart');
	$options=array();
	if(!empty($_GET) && isset($_GET) && array_key_exists('charts', $_GET) && !empty($_GET['charts'])) {
		$flag = false;
		if($_GET['charts'] == 'retweetcount-vs-text') {
			$flag = true;
			$data = $twitterDB->getRetweetCountAndText();
			$chart->load($data, 'array');
			$options = array('title' => 'How many times a tweet is retweeted limited to 10.', 'is3D' => true, 'width' => 500, 'height' => 400);
		} else if($_GET['charts'] == 'different-days') {
			$flag = true;
			$data = $twitterDB->getTweetsOfDifferentDays();
			$chart->load($data, 'array');
			$options = array('title' => 'Different days tweets analytics', 'is3D' => true, 'width' => 500, 'height' => 400);
		} else if($_GET['charts'] == 'status-source') {
			$flag = true;
			$data = $twitterDB->getStatusSource();
			$chart->load($data, 'array');
			$options = array('title' => 'Different types of sources used to tweet', 'is3D' => true, 'width' => 500, 'height' => 400);
		} else if($_GET['charts'] == 'favorite-count') {
			$flag = true;
			$data = $twitterDB->getFavoriteCount();
			$chart->load($data, 'array');
			$options = array('title' => 'Favorite count', 'is3D' => true, 'width' => 500, 'height' => 400);
		} else if($_GET['charts'] == 'max-retweet-count') {
			$flag = true;
			$data = $twitterDB->getMaxRetweetCount();
			$chart->load($data, 'array');
			$options = array('title' => 'Max retweet analytics', 'is3D' => true, 'width' => 500, 'height' => 400);
		}
		if($flag) {
			echo $chart->draw('my_div', $options);
		}
	}
?>
<link href="css/bootstrap.min.css" rel="stylesheet">   
<!-- Custom styles for this template -->
<link href="css/twitter.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
     <div class="row">
    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1" class=""></li>
        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
		<li data-target="#myCarousel" data-slide-to="3" class=""></li>
		<li data-target="#myCarousel" data-slide-to="" class=""></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide" src="images/twitter-analytics.png" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
           

            </div>
          </div>
        </div>
        <div class="item">
          <img class="second-slide" src="images/Cyber-Monday2.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <p>Twitter Analytics on Biggest Online Shopping Day of the Year !</p>
             
            </div>
          </div>
        </div>
		<div class="item">
          <img class="second-slide" src="images/Fresno.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <p> Twitter Analytics on the largest inland city in California - Fresno !</p>
             
            </div>
          </div>
        </div>
		<div class="item">
          <img class="second-slide" src="images/TrumpImg.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <p>Twitter Analytics on US politics!</p>
             
            </div>
          </div>
        </div>
        <div class="item">
          <img class="third-slide" src="images/Mark-Zuckerberg.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
           
              <p>Twitter Analytics on Co-Founder of Facebook </p>
         
            </div>
          </div>
        </div>
		
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->
	
	<div class="row">
		<div class="col-xs-6 col-sm-3 sidebar" id="sidebar">
			<div class="list-group">
				<a href="<?php echo $_SERVER["SCRIPT_NAME"]; ?>?charts=different-days" class="different-days list-group-item">Different Days Analytics</a>
				<a href="<?php echo $_SERVER["SCRIPT_NAME"]; ?>?charts=retweetcount-vs-text" class="retweetcount-vs-text list-group-item">Retweet vs Text Analytics</a>
				<a href="<?php echo $_SERVER["SCRIPT_NAME"]; ?>?charts=status-source" class="status-source list-group-item">Status Source Analytics</a>
				<a href="<?php echo $_SERVER["SCRIPT_NAME"]; ?>?charts=favorite-count" class="favorite-count list-group-item">Favorite Count Analytics</a>
				<a href="<?php echo $_SERVER["SCRIPT_NAME"]; ?>?charts=max-retweet-count" class="max-retweet-count list-group-item">Max Retweet Count Analytics</a>
				
			</div>
		</div>
		<div class="pull-right my_div" id="my_div"></div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/jquery-2.1.4.min.js" ></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="js/twitter.js"></script>
</body>
</html>