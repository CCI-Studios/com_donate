<?php

class ComDonateControllerBehaviorExecutable extends ComDefaultControllerBehaviorExecutable
{
	
	public function canAdd()
	{
		return true;
	}
	
	public function canEdit()
	{
		return true;
	}
	
	protected function _checkToken(KCommandContext $context)
	{		
		return true;
	}
}