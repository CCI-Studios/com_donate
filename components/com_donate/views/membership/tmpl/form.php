<? defined('KOOWA') or die; ?>
<script src="media://lib_koowa/js/koowa.js" />
<style src="media://com_donate/donate.css" />

<? if ($show_title): ?>
	<h1 class="component_title"><?= $title ?></h1>
<? endif; ?>

<? if ($description): ?>
	<p><?= $description ?></p>
<? endif; ?>

<? if ($type == '1'): ?>
<p>Benefits of an Individual Member of CONE</p>
<ul>
	<li>a subscription to our quarterly newsletter, ON THE EDGE</li>
	<li>a 'World Biosphere Reserve' magnetic decal</li>
	<li>a membership card which you can use at various locations throughout the Niagara
Escarpment regions through our Escarpment Enterprise Club</li>
	<li>recognition (with your permission) on our website and in our newsletter, ON THE EDGE</li>
</ul>
<? elseif ($type == '2'): ?>
<p>Benefits of being an Organization Member of CONE</p>
<ul>
	<li>a subscription to our quarterly newsletter, ON THE EDGE</li>
	<li>a 'World Biosphere Reserve' magnetic decal</li>
	<li>a membership card which you can use at various locations throughout the Niagara
Escarpment regions through our Escarpment Enterprise Club</li>
	<li>recognition (with your permission) on our website and in our newsletter, ON THE EDGE</li>
</ul>
<? endif;?>

<form action="<?= @route('id='. $membership->id) ?>" method="post" class="-koowa-form">
	<input type="hidden" name="type" value="<?= $type ?>" />
	
	<fieldset class="formsheet">
		<table>
			<legend>Contact Info:</legend>
			<? if ($type == '2'): ?>
			<tr>
				<td class="key"><label>Organization Name:</label></td>
				<td><input type="text" name="occupation" value="<?= $membership->occupation ?>" /></td>
			</tr>
			<? endif; ?>
	
			<tr>
				<td class="key"><label>First Name:</label></td>
				<td><input type="text" name="first_name" value="<?= $membership->first_name ?>" /></td>
			</tr>
		
			<tr>
				<td class="key"><label>Last Name:</label></td>
				<td><input type="text" name="last_name" value="<?= $membership->last_name ?>" /></td>
			</tr>
			
			<? if ($type == '1'): ?>
			<tr>
				<td class="key"><label>Occupation:</label></td>
				<td><input type="text" name="occupation" value="<?= $membership->occupation ?>" /></td>
			</tr>
			<? endif; ?>
		
			<tr>
				<td class="key"><label>Phone Number:</label></td>
				<td><input type="text" name="phone" value="<?= $membership->phone ?>" /></td>
			</tr>
		
			<tr>
				<td class="key"><label>Email Address:</label></td>
				<td><input type="text" name="email" value="<?= $membership->email ?>" /></td>
			</tr>
		</table>
	</fieldset>

	<fieldset class="formsheet">
		<legend>Address:</legend>
		
		<table class="formtable">
			<tr>
				<td class="key"><label>Address:</label></td>
				<td><input type="text" name="address1" value="<?= $membership->address1 ?>" /></td>
			</tr>
			
			<tr>
				<td class="key"><label>Address:</label></td>
				<td><input type="text" name="address2" value="<?= $membership->address2 ?>" /></td>
			</tr>
			
			<tr>
				<td class="key"><label>City:</label></td>
				<td><input type="text" name="city" value="<?= $membership->city ?>" /></td>
			</tr>
			
			<tr>
				<td class="key"><label>Province:</label></td>
				<td><input type="text" name="province" value="<?= $membership->province ?>" /></td>
			</tr>
			
			<tr>
				<td class="key"><label>Postal Code:</label></td>
				<td><input type="text" name="postal" value="<?= $membership->postal ?>" /></td>
			</tr>
		</table>
	</fieldset>
	
	<fieldset class="formsheet">
		<legend>Membership Details:</legend>
		
		<table class="formtable">
			<? if ($type == '1'): ?>
				<tr>
					<td class="key"><label>Membership Cost:</label></td>
					<td><?= @helper('listbox.individualAmount') ?></td>
				</tr>
			<? else: ?>
				<tr>
					<td class="key"><label>Membership Cost:</label></td>
					<td><?= @helper('listbox.organizationAmount') ?></td>
				</tr>
			<? endif; ?>
			
			<tr>
				<td class="key"><label>Would you like to also make a one time donation?:</label></td>
				<td><input type="text" name="donation" value="<?= $membership->donation ?>" /></td>
			</tr>
			
			<tr>
				<td class="key"><label>Would you like CONE to automatically renew you membership when it expires?:</label></td>
				<td><?= @helper('listbox.yesno', array('name'=>'renew')) ?></td>
			</tr>
			
			<tr>
				<td class="key"><label>Is this a Gift?:</label></td>
				<td><?= @helper('listbox.yesno', array('name'=>'gift')) ?></td>
			</tr>
			
			<tr>
				<td class="key"><label>Would you be interested in volunteering with CONE?:</label></td>
				<td><?= @helper('listbox.yesno', array('name'=>'volunteer')) ?></td>
			</tr>
			
			<tr>
				<td class="key"><label>How would you like to recieve our newsletter?:</label></td>
				<td><?= @helper('listbox.newsletterFormat') ?></td>
			</tr>
			
		</table>
	</fieldset>
	
	<input type="submit" />
</form>