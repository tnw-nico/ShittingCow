$(document).ready(function($)
{
	$('div.voting_buttons').fadeTo(0,0.5);

	$('#post').click(function(){
		publish();
	});



	$('a#vote_with_facebook').click(function(){
		if (build_poo_array().length==3) {
			publish();
			return false;
		} else {
			no_valid_votes();
			return false;
		}
	});

	$('a#vote_with_twitter').click(function(){
		if (build_poo_array().length==3) {
			window.location ='/twitter/vote';
			return false;
		} else {
			no_valid_votes();
			return false;
		}
	});

	function publish() {
		if (window.post_2_fb == 'undefined') {
			var text = "Check dungville.com to see where I think THE Cow will shit";
		} else {
			var text = window.post_2_fb;
		}
		console.log(text);
		FB.ui(
			{
				method: 'feed',
				name: 'I think the cow is going to shit on A, B and C',
				link: 'http://sctest.local/',
				picture: 'http://fbrell.com/f8.jpg',
				caption: 'The shitting cow',
				description: text
			},
			function(response) {
				if (response && response.post_id) {
					$.get('/api/facebook/'+response.post_id,
						function(response){
							if (response.success == true)
							{
								facebook_vote_success();
							}
							else
							{
								facebook_vote_failed();
							}
					});
				} else {
					facebook_post_failed();
				}
			}
		);
	}
});



function facebook_vote_success(){
	alert('facebook vote is ok, please give us your email address');
}

function facebook_vote_failed(){
	alert('We fucked up, but posted to your wall anyway');
}

function facebook_post_failed(){
	alert('Could not post to facebook, please try again to vote');
}

function no_valid_votes(){
	alert('Please vote for three companies');
}