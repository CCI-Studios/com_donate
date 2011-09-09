<?php

class ComDonateControllerToolbarMemberships extends ComDefaultControllerToolbarDefault
{
	
	public function getCommands()
	{
		$this->addSeparator()
			->addModal(array(
				'label' => 'Preferences',
				'href' => 'index.php?option=com_config&controller=component&component=com_donate')
			);
		
		return parent::getCommands();
	}
}