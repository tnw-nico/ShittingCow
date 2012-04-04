<div id=grass class=clearfix>

	<div id=bettingOptions>
		<p style="float: right">
			Select your fields below and <a class=smallButton href='#'>finalize your bet</a>
		</p>
		<p style="float: right; padding-right: 40px;">
			<img src="/img/poo.png" id="draggable0" class="draggableCoin" />
			<img src="/img/poo.png" id="draggable1" class="draggableCoin" />
			<img src="/img/poo.png" id="draggable2" class="draggableCoin" />
		</p>
		<p style="clear: both;"></p>
	</div>
	<div id=claimingOptions style='display:none'>
	</div>
	<?php
	echo '<table>';
	foreach ($grid as $row) {
		echo '<tr>';
		foreach ($row as $tile) {
			$extra_class = "";
			if (isset($tile['company'])) {
				$extra_class = " hasLogo";
			}
			echo '<td id="droppable'. $tile['id'] .'" class="tile '. $extra_class .'">';

			if (isset($tile['company'])) {
				echo '<img src="/img/companies/logo/'. $tile['company']['logo'] .'" />';
			}

			echo '</td>';
	//		echo '<div id="droppable'. $tile['id'] .'" class="droppable" style="float:left; width: 60px; height: 60px;">'. $tile['id'] .'</div>';
		}
		echo '</tr>';
	//	echo '<div style="clear:both"></div>';
	}
	echo '</table>';
	echo '</div>';
	?>