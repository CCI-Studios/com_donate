<?php

class ComDonateViewMembershipHtml extends ComDefaultViewHtml
{
	
	public function display()
	{
		$params = JComponentHelper::getParams('com_donate');
		
		$this->assign('type', $params->get('type', '1'));
		$this->assign('description', $params->get('description'));
		$this->assign('title', $params->get('page_title'));
		$this->assign('show_title', $params->get('show_page_title'));
		
		if ($this->getLayout() == 'processing') {
			$item = $this->getModel()->getItem();
			
			$use_sandbox = $params->get('use_sandbox');
			$url = ($use_sandbox)? $params->get('paypal_sandbox_url') : $params->get('paypal_url');
			$url .= '/cgi-bin/webscr';
			$business = $params->get('business');

			if ($item->renew) {
				$data['cmd'] = '_xclick-subscriptions';
				if ((float)$item->donation) {
					$data['a1'] = ((float) $item->amount) + ((float) $item->donation);
					$data['p1'] = 1;
					$data['t1'] = 'Y';
				}
				
				$data['a3'] = ((float) $item->amount);
				$data['p3'] = 1;
				$data['t3'] = 'Y';
				$data['src'] = 1;
			} else {
				$data['cmd'] = '_xclick';
				$data['amount']	= ((float)$item->amount) + ((float)$item->donation);
			}
			$data['business'] 	= $business;
			$data['undefined_quantity'] = 1;
			$data['item_name'] 	= 'CONE Membership';
			$data['item_number'] = 1;
			$data['invoice'] = $item->id;
			$data['currency_code'] = $params->get('currency_code');
			$data['no_shipping'] = 1;
			
			$data['first_name'] = $item->first_name;
			$data['last_name'] = $item->last_name;
			$data['address1'] = $item->address1;
			$data['email'] = $item->email;
			
			$data['return']		= JURI::base() .'membership-thanks';
			$data['cancel_return'] = JURI::base() .'membership-cancel';

			$data['notify_url']	= JURI::base() .'index.php?option=com_donate&view=paypal';
			
			$this->assign('paypal_info', $data);
			$this->assign('paypal_url', $url);
		}
		
		return parent::display();
	}
}