<div id=grass class=clearfix>

	<div id=bettingOptions>
		<p style="float: right">
			Select your fields below and <a class=smallButton href='#'>finalize your bet</a>
		</p>
		<p style="float: right; padding-right: 40px;" id="droppablenull">
			<img src="/img/red_flag.png" id="draggable0" class="draggableCoin" />
			<img src="/img/red_flag.png" id="draggable1" class="draggableCoin" />
			<img src="/img/red_flag.png" id="draggable2" class="draggableCoin" />
			<img src="/img/red_flag.png" id="draggable3" class="draggableCoin" />
			<img src="/img/red_flag.png" id="draggable4" class="draggableCoin" />
			<img src="/img/red_flag.png" id="draggable5" class="draggableCoin" />
		</p>
		<p style="clear: both;"></p>
	</div>
	<div id=claimingOptions style='display:none'>
		aa
	</div>
	<?php
	echo '<table>';
	foreach ($grid as $row) {
		echo '<tr>';
		foreach ($row as $tile) {
			echo '<td id="droppable'. $tile['id'] .'" style="width: 60px; height: 60px;">'. $tile['id'] .'</td>';
	//		echo '<div id="droppable'. $tile['id'] .'" class="droppable" style="float:left; width: 60px; height: 60px;">'. $tile['id'] .'</div>';
		}
		echo '</tr>';
	//	echo '<div style="clear:both"></div>';
	}
	echo '</table>';
	echo '</div>';

	echo $popup;
	?>