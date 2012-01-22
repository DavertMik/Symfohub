<?php

/**
 * Requirement form base class.
 *
 * @method Requirement getObject() Returns the current form's model object
 *
 * @package    symfohub
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRequirementForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'repository_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Repository'), 'add_empty' => true)),
      'type'          => new sfWidgetFormChoice(array('choices' => array('symfony' => 'symfony', 'doctrine' => 'doctrine', 'propel' => 'propel', 'view' => 'view', 'nosql' => 'nosql', 'javascript' => 'javascript', 'license' => 'license'))),
      'value'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'repository_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Repository'), 'required' => false)),
      'type'          => new sfValidatorChoice(array('choices' => array(0 => 'symfony', 1 => 'doctrine', 2 => 'propel', 3 => 'view', 4 => 'nosql', 5 => 'javascript', 6 => 'license'), 'required' => false)),
      'value'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('requirement[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Requirement';
  }

}
