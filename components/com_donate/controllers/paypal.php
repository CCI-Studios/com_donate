<?php

class ComDonateControllerPaypal extends ComDefaultControllerResource
{
	
	public function _actionPost(KCommandContext $context)
	{
		jimport('joomla.error.log');
		$log = &JLog::getInstance('com_donate.log.php');
		
		$params = JComponentHelper::getParams('com_donate');
		$use_sandbox = $params->get('use_sandbox');
		$url = ($use_sandbox)? $params->get('paypal_sandbox_url') : $params->get('paypal_url');
		$url .= '/cgi-bin/websrc';
		
		$post = KRequest::get('post', 'raw');
		$post['cmd'] = '_notify-validate';
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => http_build_query($post),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER => false,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_FOLLOWLOCATION => true,
		));
		
		$response = curl_exec($curl);
		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		
		if ($status == 200 && $response == 'VERIFIED') {		
			if ($post['item_name'] == 'CONE Membership') {
				$item = KFactory::tmp('site::com.donate.model.memberships')
					->set('id', $post['invoice'])
					->getItem();
			} elseif ($post['item_name'] == 'Donation') {
				$item = KFactory::tmp('site::com.donate.model.donations')
					->set('id', $post['invoice'])
					->getItem();
			}

			$item->status = 1;
			$item->confirmation = $post['txn_id'];
			if ($item->save()) {
				if ($post['item_name'] === 'CONE Membership') {
					$this->_sendMembershipThankyou($item);
					$this->_sendMembershipNotification($item);
				} elseif ($post['item_name'] === 'Donation') {
					$this->_sendMembershipThankyou($item);
					$this->_sendMembershipNotification($item);
				}
			}
			
			return "success";
		} else {
			return "error";
		}
	}
	
	protected function _sendMembershipThankyou($membership)
	{
		$this->_sendEmail(
			$membership->email,
			'Thank you for becoming a Coalition on the Niagara Escarpment Member',
			"<p>Your transaction has been successfully completed!</p>
			<p>The Coalition on the Niagara Escarpment greatly appreciates your support and hopes you will continue to be in active in your usage of our website and ongoing protection of the Escarpment.</p>
			<p>Thank you!</p>",
			($membership->gift)? JPATH_SITE.'media/com_donate/CONE_GiftCertificate.pdf' : null
		);
	}
	
	protected function _sendMembershipNotification($membership)
	{
		$params = JComponentHelper::getParams('com_donate');
		$email = $params->get('notification_email');
		
		$this->_sendEmail(
			$email,
			'Someone has registered online.',
			"{$membership->last_name}, {$membership->first_name}"
		);
	}
	
	protected function _sendDonationThankyou($membership)
	{
		
	}
	
	protected function _sendDonationNotification($membership)
	{
		
	}
	
	
	protected function _sendEmail($to, $subject, $body, $attachment = null, $fromName = null, $fromEmail = null)
	{
		if (!$fromName) {
			$fromName = 'Coalition on the Nigara Escarpment';
		}
		
		if (!$fromEmail) {
			$fromEmail = 'info@niagaraescarpment.org'
		}
		
		JUtility::sendMail(
			$fromEmail, $fromName, $to, $subject, $body, 1, null, null, $attachment);
		);
	}
}