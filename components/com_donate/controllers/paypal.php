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
					$this->_sendDonationThankyou($item);
					$this->_sendDonationNotification($item);
				}
				
				if ($item->volunteer) {
					$this->_sendVolunteerNotification($item);
				}
			}

			return "success";
		} else {
			return "error";
		}
	}
	
	protected function _sendMembershipThankyou($membership)
	{
		$subject = "Thank you for becoming a Coalition on the Niagara Escarpment Member";
		$body = "<p>Your transaction has been successfully completed!</p>".
			"<p>The Coalition on the Niagara Escarpment greatly appreciates your support and hopes you will continue to be in active in your usage of our website and ongoing protection of the Escarpment.</p>".
			"<p>Thank you!</p>";
		
		$this->_sendEmail($membership->email, $subject, $body,
			($membership->gift)? JPATH_SITE.'/media/com_donate/CONE_GiftCertificate.pdf' : null
		);
	}
	
	protected function _sendMembershipNotification($membership)
	{
		$params = JComponentHelper::getParams('com_donate');
		$email = $params->get('notification_email');
		
		$subject = 'New Membership registration';
		$body = "<p>There is a new membership registration:</p>".
			"<p>Name: {$membership->last_name}, {$membership->first_name}<br/>".
			"Occupation/Organization: {$membership->occupation}<br/>".
			"Phone: {$membership->phone}<br/>".
			"Email: {$membership->email}</p>".
			"<p>Address: {$membership->address1}<br/>".
			"Address: {$membership->address2}<br/>".
			"City: {$membership->city}<br/>".
			"Province: {$membership->province}<br/>".
			"Postal Code: {$membership->province}</p>".
			"<p>Membership Cost: {$membership->amount}<br/>".
			"Donation: {$membership->donation}<br/>".
			"Autorenew: {$membership->renew}<br/>".
			"Gift: {$membership->gift}<br/>".
			"Volunteer: {$membership->volunteer}</p>";
		
		$this->_sendEmail($email, $subject, $body);
	}
	
	protected function _sendDonationThankyou($donation)
	{
		$subject = "Thank you for your donation";
		$body = "<p>Your donation to the coalition on the Niagara Escapmemt was successfully recieved, thank you</p>";
		
		if ($donation->gift) {
			$body .= "<p>A printable file is attached to this email which you can use to share with the person you have donated in the name of.</p>";
		}
		
		$body .= "<p>Thank you!</p>";
		
		$this->_sendEmail(
			$donation->email,
			$subject,
			$body,
			($donation->gift)? JPATH_SITE.'/media/com_donate/CONE_GiftCertificate.pdf' : null
		);
	}
	
	protected function _sendDonationNotification($donation)
	{
		$params = JComponentHelper::getParams('com_donate');
		$email = $params->get('notification_email');
		
		$subject = "A new donation has been made";
		$body = "<p>There is a new donation:</p>".
					"<p>Name: {$membership->last_name}, {$membership->first_name}<br/>".
					"Occupation/Organization: {$membership->occupation}<br/>".
					"Phone: {$membership->phone}<br/>".
					"Email: {$membership->email}</p>".
					"<p>Address: {$membership->address1}<br/>".
					"Address: {$membership->address2}<br/>".
					"City: {$membership->city}<br/>".
					"Province: {$membership->province}<br/>".
					"Postal Code: {$membership->province}</p>".
					"<p>Donation: {$membership->donation}<br/>".
					"Gift: {$membership->gift}<br/>".
					"Volunteer: {$membership->volunteer}</p>";
		
		$this->_sendEmail(
			$email,
			$subject,
			$body
		);
	}
	
	protected function _sendVolunteerNotification($item)
	{
		$params = JComponentHelper::getParams('com_donate');
		$email = $params->get('notification_email');
		
		$subject = "New volunteer";
		$body = "<p>There is a new volunteer requiresting details:</p>".
			"<p>Name: {$item->last_name}, {$item->first_name}<br />".
			"Email address: {$item->email}<br/>".
			"Phone number: {$item->phone}</p>";
			
		$this->_sendEmail($email, $subject, $body);
	}
	
	
	protected function _sendEmail($to, $subject, $body, $attachment = null, $fromName = null, $fromEmail = null)
	{
		
		if (!$fromName) {
			$fromName = 'Coalition on the Nigara Escarpment';
		}
		
		if (!$fromEmail) {
			$fromEmail = 'info@niagaraescarpment.org';
		}
		
		JUtility::sendMail(
			$fromEmail, $fromName, $to, $subject, $body, 1, null, null, $attachment
		);
	}
}