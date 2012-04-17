var poo = new Array(null, null, null);

var dragged = "";
var dropped = "";

var draggableHeight = 40;
var draggableWidth = 40;

var last = new Array();

$(function() {
	$( "[id^=draggable]" ).draggable({revert: "invalid"});

	$( "[id^=droppable]" ).each(function(data) {
		var temp = "#droppable"+ (data + 1);
		if ( $(temp).hasClass("hasLogo") == false) {
			$(temp).droppable({disabled: true});
		}
	})


	$( "[id^=droppable]" ).droppable({
		activeClass: "ui-state-hover",
		hoverClass: "ui-state-active",
		drop: function( event, ui ) {

			dragged = ui.draggable.attr('id');
			dropped = $(this).attr('id');
			var droppedOffset = $(this).offset();

			//$("#"+ dropped).droppable({ disabled: true });

			dragged = dragged.replace('draggable', '');
			dropped = dropped.replace('droppable', '');


			$("#droppable"+ poo[dragged]).droppable({disabled: false});


			$("#droppable"+ poo[dragged]).removeClass('hover');

			if (dropped == "null") {
				poo.splice(dragged, 1);
			} else {
				$("#draggable"+ dragged).offset({top: droppedOffset.top + (10 - (draggableHeight/2)), left: droppedOffset.left + (10 - (draggableWidth /2))});
				poo[dragged] = dropped;
				$(this).addClass('hover');
				$("#droppable"+ dropped).droppable({disabled: true});
			}
			check_bets();
			console.log(poo);
		},
		 over: function(e, ui){
			$(this).addClass('hover');
			$(ui.helper).addClass('hover');
		},
		out: function (e, ui){
			$(this).removeClass('hover');
			$(ui.helper).removeClass('hover');
		}
	});

	$( "#dialog" ).dialog({
		autoOpen: false,
		show: "blind",
		hide: "explode"
	});

	$( "#opener" ).click(function() {
		$( "#dialog" ).dialog( "open" );
		return false;
	});
});

function bet() {

	if (poo.length == 3) {
		$.post("/api/bet", {tiles: poo},
		function(data) {
			alert("You're about to vote on: " + data);
		});
	} else {
		alert('Darn No!');
	}

}

function check_bets()
{

	var poo_post = build_poo_array();
	if (poo_post.length == 3)
	{
		$.post('/api/vote/', {votes: poo_post}, function(response)
			{
				if (response.success == true) {
					window.post_2_fb = response.data.post;
					open_bet();
				}
			});
	}

}

function build_poo_array()
{
	var tiles = $("img.bucket:not(img.empty)");
	var poo_post = new Array();

	$("img.bucket:not(img.empty)").each(function(e){
		poo_post.push(parseInt($(this).attr("data-tile")));
		console.log($(this));
	});

	return poo_post;
}


function claim() {
	var landsClaimed = 0;
	for (item in poo) {
		if (poo[item] != null) {
			landsClaimed++;
		}
	}

	if (landsClaimed >= 2) {
		$.post("/api/bet", {tiles: poo},
		function(data) {
			alert("You're about to claim: " + data);
		});
	} else {
		alert('Darn No!');
	}
}