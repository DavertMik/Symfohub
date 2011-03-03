<?php

/**
 * Base project form.
 * 
 * @package    symfohub
 * @subpackage form
 * @author     Your name here 
 * @version    SVN: $Id: BaseForm.class.php 20147 2009-07-13 11:46:57Z FabianLange $
 */
class BaseForm extends sfFormSymfony
{
	protected function getChoices($key) {
		$values = sfConfig::get($key);
		return array_combine($values, $values);
	}	
}
