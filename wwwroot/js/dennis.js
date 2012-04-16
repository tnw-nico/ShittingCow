$(document).ready(function($)
{
	$('div#button img').fadeTo(0,0.5);

	$('#post').click(function(){
		publish();
	});


	$('div#button img').click(function(){
		if (build_poo_array().length==3) {
			overlay_in();
			open_bet();
			return false;
		} else {
			no_valid_votes();
			return false;
		}
	});

	$('img#vote_with_facebook').click(function(){
		overlay_in();
		if (build_poo_array().length==3) {
			publish();
			return false;
		} else {
			no_valid_votes();
			return false;
		}
	});

	$('td.hasLogo').click(function(){
		add_bucket($(this).attr('id').replace('droppable', ''));
		build_poo_array();
		check_bets();
	});

	$('a#facebook_invite').click(function() {
		make_fb_request();
	});


	$('input#confirm_email').click(function(){
		if(validateEmail($('input#email').val()) === true) {
			$.post('/api/email', {email: $('input#email').val()}, function(response){
				open_email_thankyou();
			});
		} else {
			alert('Please provide us with a valid address');
		}
		return false;
	});

	$('img#vote_with_twitter').click(function(){
		overlay_in();
		if (build_poo_array().length==3) {
			newwindow=window.open('/twitter/vote','name','height=750,width=450');
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


function make_fb_request() {
  FB.ui({method: 'apprequests',
    message: 'My Great Request', display: "iframe"
  }, console.log(response));
}


function facebook_vote_success(){
	open_email();
}

function facebook_vote_failed(){
	open_error();
}

function facebook_post_failed(){
	alert('FB Could not post to facebook, please try again to vote');
}

function twitter_vote_success(){
	open_email();
}

function twitter_vote_failed(){
	open_error();
}

function twitter_post_failed(){
	alert('TW Could not post to twitter, please try again to vote');
}

function no_valid_votes(){
	alert('Please vote for three companies');
}

function overlay_in(){
	//$('div#overlay').fadeIn();
}
function overlay_out(){
	//$('div#overlay').fadeOut();
}
function open_email(){
	$('div#step_1').slideUp(function(){
		$('div#step_2').slideDown();
	});
}
function open_error(){
	$('div#step_1').slideUp(function(){
		$('div#error').slideDown();
	});
}

function open_email_thankyou(){
	$('div#email_form').slideUp(function(){
		$('div#follow').clone().appendTo('div#follow_div');
		$('div#email_thankyou').slideDown();
	});
}

function open_bet(){
	$.modal.close();
	$('#betting_popup').modal({zIndex:150000});
}

function validateEmail(email) {
    var re = /^([\w]+)(.[\w]+)*@([\w]+)(.[\w]{2,3}){1,2}$/;
    return re.test(email);
}

function get_moveable_bucket() {
	var moveable_bucket = false;
	for (bucket in poo) {
		if (bucket === null) {
			moveable_bucket = bucket;
		}
	}

	if (moveable_bucket === false) {
		console.log(build_poo_array());
	}
}

function find_right_bucket() {
	var bucket_list = ($("img.bucket.empty"));

	if (bucket_list.length == 0) {
		var list = new Array("bucket0", "bucket1", "bucket2");

		for (t in list) {
			if(jQuery.inArray(list[t], last) == -1) {
				if (last.length == 2) {
					last.shift();
				}
				last.push(list[t]);
				return list[t];
			}
		}

	} else {
		var id = bucket_list.first().attr("id");
		if (last.length == 2) {
			last.shift();
		}
		last.push(id);
		return id;
	}
}

function add_bucket(to, from){
	var bucket = "#"+find_right_bucket();
	var tile = $('td#droppable'+to);
	droppedOffset = tile.offset();
	$(bucket).offset({top: droppedOffset.top + (30 - (draggableHeight/2)), left: droppedOffset.left + (40 - (draggableWidth /2))});
	$(bucket).fadeIn().removeClass("empty").attr("data-tile" , to);
}
