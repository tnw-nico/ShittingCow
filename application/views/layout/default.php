<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<meta charset=utf-8>


	<meta http-equiv=X-UA-Compatible content="IE=edge,chrome=1">

	<title></title>
	<meta name=description content="">


	<meta name=viewport content="width=device-width">



	<link rel=stylesheet href='/css/style.css'>





	</head>
	<body>

		<script>
		  window.fbAsyncInit = function() {
		    FB.init({
		      appId      : '134017016692571', // App ID
		      status     : true, // check login status
		      cookie     : true, // enable cookies to allow the server to access the session
		      xfbml      : true  // parse XFBML
		    });

		    // Additional initialization code here
		  };
		</script>



		<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

		<div id=fb-root></div>
		<fb:login-button autologoutlink="true" scope=""></fb:login-button>
		<a href='#' id=post>post to facebook!</a>

		<div id=container>

			<h1 class=ir id=title>
				Where the cow shits
			</h1>

			<div id=about class=clearfix>
				<img id=cow src='img/cow.png' alt='the shitting cow' width=197 height=199>
				<div id=info>
					<p>
						During the TNW Conference in April, there will be a cow on a nearby field.
						A cow that shits about 3 times a day. The field will be full of logo’s of the owner of each part. You’ll be able to see on a live camera feed where the cow will take a dump.
					</p>
					<p>
						Claim your part of the field or place your bet on where the cow will leave it’s fecal matter.
					</p>
				</div>
			</div>

			<div id=buttons class=clearfix>
				<a href='#' class='bigButton non-active' id=blueButton>Claim your field</a>
				<div class=betweenButton>OR</div>
				<a href='#' class='bigButton active' id=orangeButton>Place your bet</a>
			</div>


			<?php
			echo $content;
			?>

		</div>




		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="/js/libs/jquery-1.7.2.min.js"><\/script>')</script>

		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>

<!-- 		<script src='/js/script.js'></script>
 -->		<script src='/js/grid.js'></script>

 	<script src='/js/dennis.js'></script>
		<script>
		  // Load the SDK Asynchronously
		  (function(d){
		     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
		     if (d.getElementById(id)) {return;}
		     js = d.createElement('script'); js.id = id; js.async = true;
		     js.src = "//connect.facebook.net/en_US/all.js";
		     ref.parentNode.insertBefore(js, ref);
		   }(document));
		</script>


		<script>
		var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
			g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g,s)}(document,'script'));
			</script>
		</body>
		</html>