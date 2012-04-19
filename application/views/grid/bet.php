<div id="button">
	<p class="center bold">Click three spots you think the cow will "hit"</p>
</div>

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


<div id="betting_popup" class="modal">

	<div class="modal_content" id="step_1">
		<img src="/img/place_bet.png" class="center">

		<p class="center">You are betting on:</p>

		<p class="center divide" id="vote_text"></p>

		<p class="center">You can bet using Facebook or Twitter</p>

		<div id="voting_buttons" class="center">
			<p class="center divide">
				<img src="/img/twitter_vote.png" id="vote_with_twitter">
				<img src="/img/facebook_vote.png" id="vote_with_facebook">
			</p>
		</div>
		<div style="margin-left:25%;margin-right:25%;">

			<p class="center" style="padding-left:20px;">
				PS: You can win great prices!
			</p>
			<img width="90" src="/img/steak.png" style="float:right;margin-top:-60px;margin-right:15px;">

		</div>
	</div>

	<div class="modal_content" id="step_2" style="display:none;">
		<p class="center bold big divide">Thanks for voting</p>

		<div id="email_form">

			<p class="center">To win great prices and stay up to date on how Klara is doing please leave your e-mail address.</p>

			<p class="center" id="email_form_input">
				<input type="text" id="email" name="email">
				<input type="submit" value="Ok" id="confirm_email">
			</p>
			<p class="center error">
				Make sure your e-mail address is valid, please try again.
			</p>
			<p class="center">
				Your email will not be sold or spammed, promised!
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

		<p class="center">Did you try to vote more then one time? You should not do that ;-)</p>

		<p class="center">Why don't you invite your Facebook friends to play Dungville?</p>
		<p class="center">
			<img src="/img/invite.png" id="facebook_invite">
		</p>
		<p class="center">If you think this is a bug, please let <a href="mailto:dennis@thenextweb.com">us know</a></p>
	</div>

</div>


<div class="modal_content" id="number_2" style="display:none;">
	<p class="center big divide">What is a "number 2"?</p>

	<p class="center">
		According to the UrbanDictionary "number 2" is slang for <strong>poo</strong>.
	</p>

	<p class="center">
		Synonyms are: shit, dung, faeces, crap and dump.
	</p>


</div>


<div class="modal_content" id="claim_popup" style="display:none;">
	<img src="/img/claim.png" class="center">

	<p class="center bold"></p>
</div>


	<img src="/img/vlaai.png" class="bucket empty" id="bucket0" data-tile="empty" style="display:none;position:absolute;" />
	<img src="/img/vlaai.png" class="bucket empty" id="bucket1" data-tile="empty" style="display:none;position:absolute;" />
	<img src="/img/vlaai.png" class="bucket empty" id="bucket2" data-tile="empty" style="display:none;position:absolute;" />
