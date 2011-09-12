<? defined('KOOWA') or die; ?>
<script src="media://lib_koowa/js/koowa.js" />
<style src="media://lib_koowa/css/koowa.css" />

<form action="<?= @route('id='. $donation->id) ?>" method="post" class="-koowa-form" id="mainform">
	<div style="float: left; width: 60%;">
		<fieldset>
			<legend>Personal Details:</legend>
			<table class="admintable">
				<tr>
					<td class="key">First Name:</td>
					<td><?= $donation->first_name ?></td>
				</tr>
			
				<tr>
					<td class="key">Last Name:</td>
					<td><?= $donation->last_name ?></td>
				</tr>
				
				<tr>
					<td class="key">donation Type:</td>
					<td><?= $donation->type ?></td>
				</tr>
				
				<tr>
					<td class="key">Occupation or Organization:</td>
					<td><?= $donation->occupation ?></td>
				</tr>
				
				<tr>
					<td class="key">Phone Number:</td>
					<td><?= $donation->phone ?></td>
				</tr>
				
				<tr>
					<td class="key">Email Address:</td>
					<td><?= $donation->email ?></td>
				</tr>				
			</table>
		</fieldset>
		
		<fieldset>
			<legend><?= @text('Address:')?></legend>
			
			<table class="admintable">
				<tr>
					<td class="key">Address:</td>
					<td><?= $donation->address1 ?></td>
				</tr>
				
				<tr>
					<td class="key">Address:</td>
					<td><?= $donation->address2 ?></td>
				</tr>
				
				<tr>
					<td class="key">City:</td>
					<td><?= $donation->city ?></td>
				</tr>
				
				<tr>
					<td class="key">province:</td>
					<td><?= $donation->province ?></td>
				</tr>
				
				<tr>
					<td class="key">Postal Code:</td>
					<td><?= $donation->postal ?></td>
				</tr>
			</table>
		</fieldset>
	</div>
	
	<div style="float: left; width: 40%;">
		<fieldset>
			<legend>Payment Details</legend>
			
			<table class="admintable">
				<tr>
					<td class="key">Donation:</td>
					<td><?= $donation->donation ?></td>
				</tr>
				
				<tr>
					<td class="key">Confirmation Code:</td>
					<td><?= $donation->confirmation ?></td>
				</tr>
				
				<tr>
					<td class="key">Status:</td>
					<td><?= $donation->status ?></td>
				</tr>
			</table>	
		</fieldset>
		
		<fieldset>
			<legend><?= @text('Misc')?></legend>
			
			<table class="admintable">
				<tr>
					<td class="key">Gift:</td>
					<td><?= $donation->gift? 'Yes' : 'No' ?></td>
				</tr>
				
				<tr>
					<td class="key">Volunteer:</td>
					<td><?= $donation->volunteer? 'Yes' : 'No' ?></td>
				</tr>
			</table>
		</fieldset>
	</div>
	
	<div class="clear"></div>
</form>
