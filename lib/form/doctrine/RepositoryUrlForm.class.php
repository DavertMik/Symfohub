<?php
/**
 * Author: davert
 * Date: 3 лист 2010
 *
 * Class RepositoryUrlForm
 * Description:
 * 
 */
 
class RepositoryUrlForm extends BaseRepositoryForm
{
  public function configure()
  {
    $this->setWidget('url', new sfWidgetFormInput());
    $this->setValidator('url', new sfValidatorString(array('required' => true)));
	  $this->useFields(array('url'));
	  $this->widgetSchema['url']->setDefault('https://github.com/');
  }
}
