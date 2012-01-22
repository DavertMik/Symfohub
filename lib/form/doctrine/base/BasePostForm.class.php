<?php

/**
 * Post form base class.
 *
 * @method Post getObject() Returns the current form's model object
 *
 * @package    symfohub
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePostForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'repository_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Repository'), 'add_empty' => true)),
      'user_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'title'             => new sfWidgetFormInputText(),
      'body'              => new sfWidgetFormTextarea(),
      'html'              => new sfWidgetFormTextarea(),
      'is_recommendation' => new sfWidgetFormInputCheckbox(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'repository_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Repository'), 'required' => false)),
      'user_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
      'title'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'body'              => new sfValidatorString(array('required' => false)),
      'html'              => new sfValidatorString(array('required' => false)),
      'is_recommendation' => new sfValidatorBoolean(array('required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('post[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Post';
  }

}
