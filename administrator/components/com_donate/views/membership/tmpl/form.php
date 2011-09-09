<? defined('KOOWA') or die; ?>
<script src="media://lib_koowa/js/koowa.js" />
<style src="media://lib_koowa/css/koowa.css" />

<form action="<?= @route('id='. $membership->id) ?>" method="post" class="-koowa-form" id="mainform">
	<div style="float: left; width: 60%;">
		<fieldset>
			<legend>Personal Details:</legend>
			<table class="admintable">
				<tr>
					<td class="key">First Name:</td>
					<td><?= $membership->first_name ?></td>
				</tr>
			
				<tr>
					<td class="key">Last Name:</td>
					<td><?= $membership->last_name ?></td>
				</tr>
				
				<tr>
					<td class="key">Membership Type:</td>
					<td><?= $membership->type ?></td>
				</tr>
				
				<tr>
					<td class="key">Occupation or Organization:</td>
					<td><?= $membership->occupation ?></td>
				</tr>
				
				<tr>
					<td class="key">Phone Number:</td>
					<td><?= $membership->phone ?></td>
				</tr>
				
				<tr>
					<td class="key">Email Address:</td>
					<td><?= $membership->email ?></td>
				</tr>				
			</table>
		</fieldset>
		
		<fieldset>
			<legend><?= @text('Address:')?></legend>
			
			<table class="admintable">
				<tr>
					<td class="key">Address:</td>
					<td><?= $membership->address1 ?></td>
				</tr>
				
				<tr>
					<td class="key">Address:</td>
					<td><?= $membership->address2 ?></td>
				</tr>
				
				<tr>
					<td class="key">City:</td>
					<td><?= $membership->city ?></td>
				</tr>
				
				<tr>
					<td class="key">province:</td>
					<td><?= $membership->province ?></td>
				</tr>
				
				<tr>
					<td class="key">Postal Code:</td>
					<td><?= $membership->postal ?></td>
				</tr>
			</table>
		</fieldset>
	</div>
	
	<div style="float: left; width: 40%;">
		<fieldset>
			<legend>Payment Details</legend>
			
			<table class="admintable">
				<tr>
					<td class="key">Membership Price:</td>
					<td><?= $membership->amount ?></td>
				</tr>
				
				<tr>
					<td class="key">Donation:</td>
					<td><?= $membership->donation ?></td>
				</tr>
				
				<tr>
					<td class="key">Renew:</td>
					<td><?= $membership->renew? 'Yes' : 'No' ?></td>
				</tr>
				
				<tr>
					<td class="key">Confirmation Code:</td>
					<td><?= $membership->confirmation ?></td>
				</tr>
				
				<tr>
					<td class="key">Status:</td>
					<td><?= $membership->status ?></td>
				</tr>
			</table>	
		</fieldset>
		
		<fieldset>
			<legend><?= @text('Misc')?></legend>
			
			<table class="admintable">
				<tr>
					<td class="key">Gift:</td>
					<td><?= $membership->gift? 'Yes' : 'No' ?></td>
				</tr>
				
				<tr>
					<td class="key">Volunteer:</td>
					<td><?= $membership->volunteer? 'Yes' : 'No' ?></td>
				</tr>
			</table>
		</fieldset>
	</div>
	
	<div class="clear"></div>
</form>
