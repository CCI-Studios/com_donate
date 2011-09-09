<? defined('KOOWA') or die; ?>
<?= @helper('behavior.mootools'); ?>
<script src="media://com_donate/paypal_submit.js" />

<p>Thank you for submitting your details, we are processing your transaction and will redirect you to Paypal momentarily.</p>

<form action="<?= $paypal_url ?>" method="post" id="paypal_form">
	<? foreach ($paypal_info as $key=>$value): ?>
		<input type="hidden" name="<?= $key ?>" value="<?= $value ?>" />
	<? endforeach; ?>
		
	<input type="submit" value="Processing your transaction, click to continue to Paypal" />
</form>