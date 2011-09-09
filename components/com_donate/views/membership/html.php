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
		
		return parent::display();
	}
}