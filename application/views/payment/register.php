<div id="opener">Open</div>
<div id="dialog" title="Basic dialog">
	<form method="post" action="/payment/register" enctype="multipart/form-data">

		<fieldset>
			<table>
				<tr>
					<td>
						<label for="company_name">Company Name:</label>
					</td>
					<td>
						<input type="text" name="company_name" value="<?php echo $company_name; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="company_url">Company Website:</label>
					</td>
					<td>
						<input type="text" name="company_url" value="<?php echo $company_url; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="company_logo">Company Logo:</label>
					</td>
					<td>
						<input type="file" name="company_logo" />
					</td>
				</tr>

				<tr>
					<td>

					</td>
					<td>
						<input type="submit" name="submit_register" value="Proceed to Payment" />
					</td>
				</tr>
			</table>
		</fieldset>

	</form>
</div>