<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<meta charset=utf-8>
	<link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">


	<meta http-equiv=X-UA-Compatible content="IE=edge,chrome=1">

	<title>Dungville, meet Klara our favourite Dutch cow</title>
	<meta name=description content="">


	<meta name="viewport" content="width=device-width, initial-scale=0.5, maximum-scale=1"/> <!--320-->



	<link rel=stylesheet href='/css/style.css'>

	<link rel=stylesheet href='/css/homepage.css'>


	<link rel="stylesheet" media="screen and (max-width: 800px)" href="/css/mobile.css" />
	<link rel="stylesheet" href="/css/jquery.modal.css" type="text/css" media="screen" />
	<link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>

	</head>
	<body>

		<script>
		  window.fbAsyncInit = function() {
		    FB.init({
		      appId      : '213452642097110', // App ID
		      status     : true, // check login status
		      cookie     : true, // enable cookies to allow the server to access the session
		      xfbml      : true  // parse XFBML
		    });

		    // Additional initialization code here
		  };
		</script>



		<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
		<div id="overlay" style="display:none;"> </div>
		<div id="fb-root"></div>

		<div id="container">
			<div id="logo">
				<img src="/img/header_logo.png">
			</div>

			<div id="intro">
				<p class="center bold">During the TNW conference 2012 Klara will be our special guest on friday April 26th.</span>
				<p class="center">Klara does a <a href="" target="_blank" class="inline">"number 2"</a> around three times a day. You can predict which companies on the field she will hit.</span>
			</div>
 			<div id="grid">
				<?php
				echo $content;
				?>
			</div>
			<div id="bet" style="display:none;">
				<img src="/img/place_bet.png" class="center" id="bet_now">
			</div>
			<div id="companies">
				<p class="center big divide">Sponsors</p>

				<ul style="list-style:none;width:100%;">

				<?php foreach($companies->result() as $company):?>
				<li style="width:32%;float:left;">
					<p class="center">
						<img src="/img/companies/logo/<?=$company->logo;?>" height="20" style="margin-right: 25px;">
						<a href="<?=$company->url;?>" target="_blank"><?=$company->name;?></a> (<a href="http://twitter.com/<?=$company->twitter;?>" target="_blank">@</a>)
					</p>
				</li>
				<?php endforeach;?>

				</ul>
			</div>

			<div id="votes">
				<p class="center big divide">Your competition</p>
			</div>

			<div id="about">
				<p class="center divide">Created with passion, love and care by:</p>

				<p class="center" id="logo">
					<a href="http://thenextweb.com"><img src="/img/tnw.png"></a>
					<a href="http://natwerk.nl"><img src="/img/natwerk.png"></a>
				</p>
		</div>

		<div id="footer">
			<div id="follow">
				<p class="center">
				<a href="https://twitter.com/dungville" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @dungville</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</p>
			</div>
		</div>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="/js/libs/jquery-1.7.2.min.js"><\/script>')</script>

		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>

		<script src='/js/grid.js'></script>
	 	<script src='/js/dennis.js'></script>

		<script src="/js/jquery.modal.js" type="text/javascript" charset="utf-8"></script>


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
		var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-729494-16']);
		  _gaq.push(['_setDomainName', 'dungville.com']);
		  _gaq.push(['_trackPageview']);
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
			g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g,s)}(document,'script'));
		</script>
		</body>
		</html>