// Mike van Rossum
$(function(){


	$('#grass').on({
		hover: function() {
			//$(this).toggleClass('hover');
		}
	}, 'td');

	//append facebook JS
	(function() {
		var e = document.createElement('script');
		e.type = 'text/javascript';
		e.src = document.location.protocol +
		'//connect.facebook.net/en_US/all.js';
		e.async = true;
		document.getElementById('fb-root').appendChild(e);
	}());

	var logged = false,
	published = false,
	user = {
		data: null, post: null
	},
	// this function triggers when the user is logged in
	login = function(d) {
		log('logged in!');
		logged = true;
		FB.api('/me', function(response) {
			user.data = response;
			log(user);
		});

	},
	logout = function() {
		log('logged out!')
	}

	// connect to the FB api
	window.fbAsyncInit = function() {

		FB.init({appId: '134017016692571', status: true, cookie: true, xfbml: true});

		/* All the events registered */
		FB.Event.subscribe('auth.login', function(response) {
			// do something with response
			login();
		});
		FB.Event.subscribe('auth.logout', function(response) {
			// do something with response
			logout();
		});

		FB.getLoginStatus(function(response) {
			if (response.authResponse) {
				// logged in and connected user, someone you know
				login();
			}
		});
	};

	// this function posts a message to the timeline but without a link (just plain text)
	// we do not want to use this function
	function graphStreamPublish(){
		var body = 'testing...' + new Date().getTime();
		FB.api('/me/feed', 'post', { message: body }, function(response) {
			if (!response || response.error) {
				console.log('Error occured');
				console.log(response);
			} else {
				console.log(response);
			}
		});
	}

	// this function posts a link to the timeline
	function publish() {
		FB.ui(
			{
				method: 'feed',
				name: 'I think the cow is going to shit on A, B and C',
				link: 'http://sctest.local/',
				picture: 'http://fbrell.com/f8.jpg',
				caption: 'The shitting cow',
				description: 'During the TNW conference in April a cow is going to shit!'
			},
			function(response) {
				if (response && response.post_id) {
					published = true;
					user.post = response;
					console.log(user);
				} else {
					console.log('not published');
				}
			}
		);
	}

	// bind on click
	$('#post').on('click', function() {
		console.log('clicked');
		publish();
	});
});