<?php

class ComDonateDispatcher extends ComDefaultDispatcher
{
	
	protected function _initialize(KConfig $config)
	{
		$config->append(array(
			'controller'	=> 'donations'	
		));
		
		
		parent::_initialize($config);
	}
}