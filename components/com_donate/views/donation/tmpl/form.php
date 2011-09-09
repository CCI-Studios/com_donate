<? defined('KOOWA') or die; ?>
<script src="media://lib_koowa/js/koowa.js" />
<style src="media://com_donate/donate.css" />

<? if ($show_title): ?>
	<h1 class="component_title"><?= $title ?></h1>
<? endif; ?>

<? if ($description): ?>
	<p><?= $description ?></p>
<? endif; ?>

<form action="<?= @route('id='. $donation->id) ?>" method="post" class="-koowa-form">
	
	<fieldset class="formsheet">
		<table>
			<legend>Contact Info:</legend>

			<tr>
				<td class="key"><label>First Name:</label></td>
				<td><input type="text" name="first_name" value="<?= $donation->first_name ?>" /></td>
			</tr>
		
			<tr>
				<td class="key"><label>Last Name:</label></td>
				<td><input type="text" name="last_name" value="<?= $donation->last_name ?>" /></td>
			</tr>
			
			<tr>
				<td class="key"><label>Occupation or Organization:</label></td>
				<td><input type="text" name="occupation" value="<?= $donation->occupation ?>" /></td>
			</tr>
		
			<tr>
				<td class="key"><label>Phone Number:</label></td>
				<td><input type="text" name="phone" value="<?= $donation->phone ?>" /></td>
			</tr>
		
			<tr>
				<td class="key"><label>Email Address:</label></td>
				<td><input type="text" name="email" value="<?= $donation->email ?>" /></td>
			</tr>
		</table>
	</fieldset>

	<fieldset class="formsheet">
		<legend>Address:</legend>
		
		<table class="formtable">
			<tr>
				<td class="key"><label>Address:</label></td>
				<td><input type="text" name="address1" value="<?= $donation->address1 ?>" /></td>
			</tr>
			
			<tr>
				<td class="key"><label>Address:</label></td>
				<td><input type="text" name="address2" value="<?= $donation->address2 ?>" /></td>
			</tr>
			
			<tr>
				<td class="key"><label>City:</label></td>
				<td><input type="text" name="city" value="<?= $donation->city ?>" /></td>
			</tr>
			
			<tr>
				<td class="key"><label>Province:</label></td>
				<td><input type="text" name="province" value="<?= $donation->province ?>" /></td>
			</tr>
			
			<tr>
				<td class="key"><label>Postal Code:</label></td>
				<td><input type="text" name="postal" value="<?= $donation->postal ?>" /></td>
			</tr>
		</table>
	</fieldset>
	
	<fieldset class="formsheet">
		<legend>Donation Details:</legend>
		
		<table class="formtable">
			<tr>
				<td class="key"><label>How much would you like to donate?:</label></td>
				<td><input type="text" name="donation" value="<?= $donation->donation ?>" /></td>
			</tr>
			
			<tr>
				<td class="key"><label>Is this a Gift?:</label></td>
				<td><?= @helper('listbox.yesno', array('name'=>'gift')) ?></td>
			</tr>
			
			<tr>
				<td class="key"><label>Would you be interested in volunteering with CONE?:</label></td>
				<td><?= @helper('listbox.yesno', array('name'=>'volunteer')) ?></td>
			</tr>
		</table>
	</fieldset>
	
	<input type="submit" />
</form>