<?php

class ComDonateControllerToolbarMenubar extends ComDefaultControllerToolbarMenubar
{
	
	public function getCommands()
	{
		$name = $this->getIdentifier()->name;
		
		$this->addCommand('donations', array(
			'href'		=> 'index.php?option=com_donate&view=donations',
			'active'	=> ($name == 'donate')
		));
		
		$this->addCommand('memberships', array(
			'href'		=> 'index.php?option=com_donate&view=memberships',
			'active'	=> ($name == 'membership')
		));
		
		
		return parent::getCommands();
	}
	
}