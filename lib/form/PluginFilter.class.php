<?php
/**
 * Author: davert
 * Date: 10 лист 2010
 *
 * Class ListFilter
 * Description:
 * 
 */
 
class PluginFilter extends BaseForm {

  public function setup()
  {
	  $this->setWidget('symfony', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_plugin_version'))));
	  $this->setValidator('symfony', new sfValidatorChoice(array('choices' => $this->getChoices('app_plugin_version'), 'multiple' => true)));
    $doctrine =  $this->getChoices('app_plugin_doctrine');
	  $this->setWidget('doctrine', new sfWidgetFormSelectCheckbox(array('choices' => $doctrine)));
	  $this->setValidator('doctrine', new sfValidatorChoice(array('choices' => $this->getChoices('app_symfony_doctrine'), 'multiple' => true)));
	  $this->setWidget('propel', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_symfony_propel'))));
	  $this->setValidator('propel', new sfValidatorChoice(array('choices' => $this->getChoices('app_symfony_propel'), 'multiple' => true)));
    $this->setWidget('javascript', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_plugin_javascript'))));
    $this->setValidator('javascript', new sfValidatorChoice(array('choices' => $this->getChoices('app_plugin_javascript'), 'multiple' => true)));
	  $this->setWidget('license', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_symfony_license'))));
	  $this->setValidator('license', new sfValidatorChoice(array('choices' => $this->getChoices('app_symfony_license'), 'multiple' => true)));
    $this->widgetSchema->setNameFormat('filter[%s]');
    
    $this->setWidget('type', new sfWidgetFormInputHidden(array('default' => 'plugin')));

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

}
