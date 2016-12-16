<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is a webpage that presents different kinds of graphs and gives the user the possibility to create their own graphs. Features Facebook-login and
	user account creation on the site">
    <meta name="author" content="Joel Suomalainen">
	<meta name="keywords" content="WEB GRAPHING VISUALIZATION PLOTLY STATISTICS GRAPHS GRPHING GRAFING GRAF VISUALIZE DATA ANALYTICS ANALYSIS WEBGRAPH ONLINE ">
	<meta name="robots" content="noindex,nofollow">

    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

    <title>Webgraph - visualize your data on the web!</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/one-page-wonder.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<?php
	session_start();
	require_once("utils_webgraph.php");

	if ($_GET["p"] === "login") {
		require("login_webgraph.php");
	}

	else if ($_GET["p"] === "register") {
		require("register_webgraph.php");
	}
?>

<!-- Adding the Facebook SDK required to implement the login feature -->
	<script>
	  window.fbAsyncInit = function() {
		FB.init({
		  appId      : 'xx',
		  xfbml      : true,
		  version    : 'v2.8'
		});
	  };

	  (function(d, s, id){
		 var js, fjs = d.getElementsByTagName(s)[0];
		 if (d.getElementById(id)) {return;}
		 js = d.createElement(s); js.id = id;
		 js.src = "//connect.facebook.net/en_US/sdk.js";
		 fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
	</script>
<!-- Function enables embedding a Facebook like or share button! -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/fi_FI/sdk.js#xfbml=1&version=v2.8&appId=1842733045938985";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Webgraph</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#about">Line Graph</a>
                    </li>
                    <li>
                        <a href="#services">Bar Graph</a>
                    </li>
                    <li>
                        <a href="#contact">Heatmap</a>
                    </li>
					<li><a href="login_webgraph.php">Login</a></li>
					<li><a href="register_webgraph.php">Register</a></li>
					<li><a href="logout_webgraph.php">Logout</a></li>
					 
                </ul>
				
			<!-- Checking if user has a session going on -->
			<?php 
					if(isset($_SESSION["username"])) {
						print "<p>User logged in: <strong>{$_SESSION['username']}</strong></p>";
					}
					else {
						print "<p style='color:red;'>No current session</p>";
					}
			?>
				<div class="fb-login-button" data-max-rows="1" data-size="large" data-show-faces="false" data-auto-logout-link="true"></div>
				<div class="fb-share-button" data-href="http://suomalainen.me/webgraph.php" data-layout="box_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fsuomalainen.me%2Fwebgraph.php&amp;src=sdkpreparse">Jaa</a></div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Full Width Image Header -->
    <header class="header-image">
        <div class="headline">
            <div class="container">
                <h1>Webgraph</h1>
                <h2>Your number one place for data visualization on the web!</h2>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="container">

        <hr class="featurette-divider">

        <!-- First Featurette -->
        <div class="featurette" id="about">
          
            <h2 class="featurette-heading">Here you will be able to visualize your data as a 
                <span class="text-muted">line graph!</span>
            </h2>
            <p class="lead">Line graphs are a great way to visualize change!</p>
	    <div id="testidata" style"width:600px;height:250px;"></div>

		<p> Input 5 values for x and for y that you want to visualize as a line graph (doesn't work properly at the moment :/ )</p>
		<form id="values">
		  <p>X-values</p>
		  <input type="number" name="x1" class="graph">
		  <input type="number" name="x2" class="graph">
		  <input type="number" name="x3" class="graph">
		  <input type="number" name="x4" class="graph">
		  <input type="number" name="x5" class="graph">
		  <br></br><p>Y-values</p>
		  <input type="number" name="y1" class="graph">
		  <input type="number" name="y2" class="graph">
		  <input type="number" name="y3" class="graph">
		  <input type="number" name="y4" class="graph">
		  <input type="number" name="y5" class="graph">
		<!--  <button onclick="graphFunction()">Graph it!</button>  -->
		</form>
		 
		
		<!-- Plot user input using the plotly.js -->

		<script>
		//function graphFunction() {
	   	     testeri = document.getElementById('testidata');
		/*	 numValues = [];								Didn't work properly..
			 var values = document.getElementByClassName('graph');
			 for (var i = 0; i < values.length; i++) {
				 var x = values[i].innerHTML;
				 numValues.push(parseInt(x));
				 console.log(numValues(x));/
			 }*/
		     Plotly.plot( testeri, [{
		     x: [1, 2, 3, 4, 5],
		     y: [12, 32, 1, 4, 3] }], {
		     margin: { t: 0 } } );
		//}
	  	    
	    </script>

		
        </div>

        <hr class="featurette-divider">

        <!-- Second Featurette -->
        <div class="featurette" id="services">
            <h2 class="featurette-heading">Here is an example of data visualization as a
                <span class="text-muted">bargraph!</span>
            </h2>
            <p class="lead">Bar graphs are great for comparisons between groups or to track large change over time. Here are presented the 20 biggest payers of corporate tax in Finland in 2014.</p>
			
			<!-- Using the predefined graph at the plotly site and displaying it -->
			<div>
			<a href="https://plot.ly/~baladas/3/" target="_blank" title="" style="display: block; text-align: center;"><img src="https://plot.ly/~baladas/3.png" alt="" style="max-width: 100%;width: 600px;"  width="600" onerror="this.onerror=null;this.src='https://plot.ly/404.png';" /></a>
			<script data-plotly="baladas:3"  src="https://plot.ly/embed.js" async></script>
			</div>

        </div>

        <hr class="featurette-divider">

        <!-- Third Featurette -->
        <div class="featurette" id="contact">
            <h2 class="featurette-heading">Here is an example of data visualization as a
                <span class="text-muted">heatmap!</span>
            </h2>
            <p class="lead">This is a great way to visulize weather data as we have done here!</p>
			
		  <div id="myDiv"><!-- A basic heatmap --></div>
			<script>
    var data = [
  {
    z: [[1, 20, 30, 50, 1], [20, 1, 60, 80, 30], [30, 60, 1, -10, 20]],
    x: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
    y: ['Morning', 'Afternoon', 'Evening'],
    type: 'heatmap'
  }
];

Plotly.newPlot('myDiv', data);
  </script>	
        </div>

        <hr class="featurette-divider">

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Joel Suomalainen 2016</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
