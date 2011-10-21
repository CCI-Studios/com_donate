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
			$id = intval(substr($post['invoice'], 1));
			
			if ($post['item_name'] == 'CONE Membership') {
				$item = KFactory::tmp('site::com.donate.model.memberships')
					->set('id', $id)
					->getItem();
			} elseif ($post['item_name'] == 'Donation') {
				$item = KFactory::tmp('site::com.donate.model.donations')
					->set('id', $id)
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
		$subject = "Thank you for becoming a member of the Coalition on the Niagara Escarpment";
		$body = "<p>Your transaction has been successfully completed.";
		if ($membership->gift) {
			$body .= " Attached to this email is a PDF of a CONE certificate for you to print, fill out and give to your gift recipient.";
		}
		$body .= "</p>";
		$body .= "<p>The Coalition on the Niagara Escarpment greatly appreciates your support!</p>";
		$body .= "<p>Thank you!</p>";
		
		$this->_sendEmail($membership->email, $subject, $body,
			($membership->gift)? JPATH_SITE.'/media/com_donate/CONE_GiftCertificate.pdf' : null
		);
	}
	
	protected function _sendMembershipNotification($membership)
	{
		$params = JComponentHelper::getParams('com_donate');
		$email = $params->get('notification_email');
		
		$subject = 'New Membership registration';
		$body = "<p>New CONE membership:</p>".
			"<p>Name: {$membership->last_name}, {$membership->first_name}<br/>".
			"Occupation/Organization: {$membership->occupation}<br/>".
			"Phone: {$membership->phone}<br/>".
			"Email: {$membership->email}</p>".
			"<p>Address: {$membership->address1}<br/>".
			"Address: {$membership->address2}<br/>".
			"City: {$membership->city}<br/>".
			"Province: {$membership->province}<br/>".
			"Postal Code: {$membership->postal}</p>";
		
		if ($membership->amount == 25) {
			$body .= "<p>Membership Type: Student/Senior ($25/year)</p>";
		} else if ($membership->amount == 35) {
			$body .= "<p>Membership Type: Individual ($35/year)</p>";
		} else if ($membership->amount == 40) {
			$body .= "<p>Membership Type: Family ($40/year)</p>";
		} else if ($membership->amount == 60) {
			$body .= "<p>Membership Type: Fewer than 75 Members ($60/year)</p>";
		} else if ($membership->amount == 75) {
			$body .= "<p>Membership Type: 75 to 150 Members ($75/year)</p>";
		} else if ($membership->amount == 120) {
			$body .= "<p>Membership Type: More than 150 Members ($120/year)</p>";
		}
		
		$body .= "Donation: {$membership->donation}<br/>";
		
		if ($membership->renew) {
			$body .= "Autorenew: Yes<br />";
		} else {
			$body .= "Autorenew: No<br />";
		}
		
		if ($membership->gift) {
			$body .= "Gift: Yes<br />";
		} else {
			$body .= "Gift: No<br />";
		}
		
		if ($membership->volunteer) {
			$body .= "Volunteer: Yes<br />";
		} else {
			$body .= "Volunteer: No<br />";
		}
		
		$body .= "Newsletter: {$membership->newsletter_format}<br/>";
		$body .= "Recognition in Publications: {$membership->recognized}</p>";
		
		$this->_sendEmail($email, $subject, $body);
	}
	
	protected function _sendDonationThankyou($donation)
	{
		$subject = "Thank you for your donation";
		$body = "<p>Your donation to the Coalition on the Niagara Escapmemt was successfully recieved.";
		if ($donation->gift) {
			$body .= " Attached to this email is a PDF of a CONE certificate for you to print, fill out and give to your gift recipient.";
		}
		$body .= "</p>";
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
					"<p>Name: {$donation->last_name}, {$donation->first_name}<br/>".
					"Occupation/Organization: {$donation->occupation}<br/>".
					"Phone: {$donation->phone}<br/>".
					"Email: {$donation->email}</p>".
					"<p>Address: {$donation->address1}<br/>".
					"Address: {$donation->address2}<br/>".
					"City: {$donation->city}<br/>".
					"Province: {$donation->province}<br/>".
					"Postal Code: {$donation->postal}</p>".
					"<p>Donation: {$donation->donation}<br/>";
		if ($donation->gift) {
			$body .= "Gift: Yes<br />";
		} else {
			$body .= "Gift: No<br />";
		}
		
		if ($donation->volunteer) {
			$body .= "Volunteer: Yes<br />";
		} else {
			$body .= "Volunteer: No<br />";
		}
		$body .= "</p>";
		
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
		$body = "<p>There is a new volunteer requesting details:</p>".
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