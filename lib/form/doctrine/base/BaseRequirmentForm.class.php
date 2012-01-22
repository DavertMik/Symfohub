<?php

/**
 * Requirment form base class.
 *
 * @method Requirment getObject() Returns the current form's model object
 *
 * @package    symfohub
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRequirmentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'repostory_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Repository'), 'add_empty' => true)),
      'type'         => new sfWidgetFormChoice(array('choices' => array('symfony' => 'symfony', 'orm' => 'orm', 'javascript' => 'javascript'))),
      'name'         => new sfWidgetFormInputText(),
      'version'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'repostory_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Repository'), 'required' => false)),
      'type'         => new sfValidatorChoice(array('choices' => array(0 => 'symfony', 1 => 'orm', 2 => 'javascript'), 'required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'version'      => new sfValidatorString(array('max_length' => 5, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('requirment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Requirment';
  }

}
