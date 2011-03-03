<?php
/**
 * Author: davert
 * Date: 10 лист 2010
 *
 * Class ListFilter
 * Description:
 * 
 */
 
class ListFilter extends BaseForm {

  public function setup()
  {
	  $this->setWidget('symfony', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_symfony_version'))));
	  $this->setValidator('symfony', new sfValidatorChoice(array('choices' => $this->getChoices('app_symfony_version'), 'multiple' => true)));
	  $this->setWidget('doctrine', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_symfony_doctrine'))));
	  $this->setValidator('doctrine', new sfValidatorChoice(array('choices' => $this->getChoices('app_symfony_doctrine'), 'multiple' => true)));
	  $this->setWidget('propel', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_symfony_propel'))));
	  $this->setValidator('propel', new sfValidatorChoice(array('choices' => $this->getChoices('app_symfony_propel'), 'multiple' => true)));
	  $this->setValidator('view', new sfValidatorChoice(array('choices' => $this->getChoices('app_symfony_view'), 'multiple' => true)));
	  $this->setWidget('view', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_symfony_view'))));
    $this->setValidator('nosql', new sfValidatorChoice(array('choices' => $this->getChoices('app_symfony_nosql'), 'multiple' => true)));
    $this->setWidget('nosql', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_symfony_nosql'))));
	  $this->setWidget('license', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_symfony_license'))));
	  $this->setValidator('license', new sfValidatorChoice(array('choices' => $this->getChoices('app_symfony_license'), 'multiple' => true)));

    $r = new RepositoryForm();
    $choices = $r->widgetSchema['type']->getOption('choices');
    unset($choices['']);
    $this->setWidget('type', new sfWidgetFormSelectCheckbox(array('choices' => $choices)));
    $this->setValidator('type', new sfValidatorChoice(array('choices' => $choices, 'multiple' => true)));

    $this->widgetSchema->setNameFormat('filter[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

}
