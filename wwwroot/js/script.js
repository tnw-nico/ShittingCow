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

	
});