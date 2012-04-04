$(document).ready(function($)
{
	console.log('ready');


	$('#orangeButton').click(function()
	{

		// post tile numbers to save them on the servert
		$.post('/api/vote/', {votes: poo}, function(e)
			{
				var response = ($.parseJSON(e));
				if (response.success == true) {
					window.post_22_fb = response.data.post;
				}
			});
	});


	$('#post').click(function(){
		publish();
	});

	function publish() {
		if (window.post_2_fb != 'undefined') {
			var text = "Check dungville.com to see where I think THE Cow will shit";
		} else {
			var text = window.post_2_fb;
		}
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
					$.get('/api/facebook/'+response.post_id);
				} else {
					console.log('not published');
				}
			}
		);
	}

});