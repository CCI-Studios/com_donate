<?php

class ComDonateControllerMembership extends ComDefaultControllerDefault
{
	
	public function __construct(KConfig $config)
	{
		parent::__construct($config);
		
		$this->registerCallback('after.add', array($this, 'doProcessing'));
	}
	
	
	public function doProcessing(KCommandContext $context)
	{
		if ($context->result) {
			$this->setRedirect('index.php?option=com_donate&view=membership&layout=processing&id='. $context->result->id);
		}
	}	
}