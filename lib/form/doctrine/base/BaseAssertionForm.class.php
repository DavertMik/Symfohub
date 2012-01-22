<?php

/**
 * Assertion form base class.
 *
 * @method Assertion getObject() Returns the current form's model object
 *
 * @package    symfohub
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAssertionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'repository_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Repository'), 'add_empty' => true)),
      'user_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'works'         => new sfWidgetFormChoice(array('choices' => array('yes' => 'yes', 'patch' => 'patch', 'no' => 'no', 'old' => 'old'))),
      'comment'       => new sfWidgetFormTextarea(),
      'body'          => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'repository_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Repository'), 'required' => false)),
      'user_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
      'works'         => new sfValidatorChoice(array('choices' => array(0 => 'yes', 1 => 'patch', 2 => 'no', 3 => 'old'), 'required' => false)),
      'comment'       => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'body'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('assertion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Assertion';
  }

}
