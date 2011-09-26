<?php

class ComDonateTemplateHelperListbox extends ComDefaultTemplateHelperListbox
{
	
	public function organizationAmount($config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'name'		=> 'amount',
		));
		
		$options = array();
		
		$options[] = $this->option(array('text'=>'Fewer than 75 Members ($60/Year)', 'value'=>'60'));
		$options[] = $this->option(array('text'=>'75 to 150 Members ($75/Year)', 'value'=>'75'));
		$options[] = $this->option(array('text'=>'More than 150 Members ($120/Year)', 'value'=>'120'));
		
		$config->options = $options;
		return $this->optionlist($config);
	}
	
	public function individualAmount($config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'name'		=> 'amount',
		));
				
		$options = array();
		
		$options[] = $this->option(array('text'=>'Individual ($35/Year)', 'value'=>'35'));
		$options[] = $this->option(array('text'=>'Student/Senior ($25/Year)', 'value'=>'25'));
		$options[] = $this->option(array('text'=>'Family ($40/Year)', 'value'=>'40'));
		
		$config->options = $options;
		return $this->optionlist($config);
	}
	
	public function yesno($config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'name' => '',
		))->append(array(
			'selected'	=> $config->{$config->name}
		));
		
		$options = array();
		$options[] = $this->option(array('text'=>'Yes', 'value'=>'1'));
		$options[] = $this->option(array('text'=>'No', 'value'=>'0'));
		
		$config->options = $options;
		return $this->optionlist($config);
	}
	
	public function newsletterFormat($config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'name' => 'newsletter_format',
		))->append(array(
			'selected'	=> $config->{$config->name}
		));
		
		$options = array();
		$options[] = $this->option(array('text'=>'Email', 'value'=>'Email'));
		$options[] = $this->option(array('text'=>'Mail', 'value'=>'Mail'));
		$options[] = $this->option(array('text'=>'Do not send', 'value'=>'None'));
		
		$config->options = $options;
		return $this->optionlist($config);
	}
	

	
}