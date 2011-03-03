<?php

/**
 * Requirement form.
 *
 * @package    symfohub
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RequirementForm extends BaseRequirementForm
{
  public function configure()
  {
	  parent::configure();
	  $this->widgetSchema['type'] = new sfWidgetFormInputHidden();
  }
}
