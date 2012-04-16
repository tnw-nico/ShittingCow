<div id="grass" class="clearfix">


	<table id="field">
		<?php $letters = array("Z", "A", "B", "C", "D", "E", "F", "G", "H"); ?>
		<tr id="header">
			<th></th>

			<?php foreach($grid[1] as $head):?>
				<th class="circle"><p><?=$head["x"];?></th>
			<?php endforeach;?>
		</tr>

		<?php foreach ($grid as $row):?>
			<tr>
				<td class="first">
					<p><?=$letters[$row[1]["y"]];?></p>
				</td>
				<?php foreach ($row as $cell):?>
					<?php
						$extra_class = " free";
						if (isset($cell['company'])) {
							$extra_class = " hasLogo";
						}
					?>
					<td id="droppable<?=$cell["id"];?>" class="tile <?=$extra_class;?> " align="center">
					<?php
					if (isset($cell['company'])) {
						echo '<img src="/img/companies/logo/'. $cell['company']['logo'] .'" />';
					} else {
						echo '<img src="/img/free.png"/>';
					}
					?>
					</td>
				<?php endforeach;?>
			</tr>
		<?php endforeach;?>
	</table>



</div>

<div id="button">
	<p class="center bold">Pick three spots you think the cow will "hit"</p>

<!-- 	<img src="/img/place_bet.png" class="center">
 --></div>

<div id="betting_popup" class="modal">

	<div class="modal_content" id="step_1">
		<img src="/img/place_bet.png" class="center">

		<p class="center divide">If all three companies you picked are hit by Klara's dung you can win one of the three full conference passes to The Next Web Latin America.</p>

		<p class="center bold">You are betting on:</p>

		<p class="center divide">Facebook, Dropbox and Twitter</p>

		<p class="center">You can bet using Facebook or Twitter</p>

		<div id="voting_buttons" class="center">
			<p class="center">
				<img src="/img/twitter_vote.png" id="vote_with_twitter">
				<img src="/img/facebook_vote.png" id="vote_with_facebook">
			</p>
		</div>
	</div>

	<div class="modal_content" id="step_2" style="display:none;">
		<p class="center bold big divide">Thanks for voting</p>

		<div id="email_form">

			<p class="center">To win of one of the full conference passes for TNW Latin America please leave your e-mail address.</p>

			<p class="center">
				<input type="text" id="email" name="email">
				<input type="submit" value="Ok" id="confirm_email">
			</p>

			<p class="center">
				Your email will not be sold or spammend, promised!
			</p>
		</div>

		<div id="email_thankyou" style="display:none;">
			<p class="center">You are done! Make sure to follow @dungville on Twitter to stay up to date.</p>

			<p class="center divide">
				<div id="follow_div"></div>
			</p>
		</div>
	</div>

	<div class="modal_content" id="error" style="display:none;">
		<p class="center bold big divide">Sorry, something went wrong</p>

		<p class="center">If you think this is a bug, please let <a href="mailto:dennis@thenextweb.com">us know</a></p>
	

	</div>

</div>

	<img src="/img/vlaai.png" class="bucket empty" id="bucket0" data-tile="empty" style="display:none;position:absolute;" />
	<img src="/img/vlaai.png" class="bucket empty" id="bucket1" data-tile="empty" style="display:none;position:absolute;" />
	<img src="/img/vlaai.png" class="bucket empty" id="bucket2" data-tile="empty" style="display:none;position:absolute;" />
