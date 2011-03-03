<?php
/**
 * Author: davert
 * Date: 10 лист 2010
 *
 * Class ListFilter
 * Description:
 * 
 */
 
class BundleFilter extends BaseForm {

  public function setup()
  {
	  $this->setWidget('doctrine', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_bundle_doctrine'))));
	  $this->setValidator('doctrine', new sfValidatorChoice(array('choices' => $this->getChoices('app_bundle_doctrine'), 'multiple' => true)));
	  $this->setValidator('view', new sfValidatorChoice(array('choices' => $this->getChoices('app_symfony_view'), 'multiple' => true)));
	  $this->setWidget('view', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_symfony_view'))));
    $this->setValidator('nosql', new sfValidatorChoice(array('choices' => $this->getChoices('app_symfony_nosql'), 'multiple' => true)));
    $this->setWidget('nosql', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_symfony_nosql'))));
	  $this->setWidget('license', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_symfony_license'))));
	  $this->setValidator('license', new sfValidatorChoice(array('choices' => $this->getChoices('app_symfony_license'), 'multiple' => true)));

    $this->setWidget('type', new sfWidgetFormInputHidden(array('default' => 'bundle')));
    $this->setWidget('symfony', new sfWidgetFormInputHidden(array('default' => '2')));

    $this->widgetSchema->setNameFormat('filter[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

}
