<?php

/**
 * Documentation form base class.
 *
 * @method Documentation getObject() Returns the current form's model object
 *
 * @package    symfohub
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDocumentationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'repository_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Repository'), 'add_empty' => true)),
      'text'          => new sfWidgetFormTextarea(),
      'html'          => new sfWidgetFormTextarea(),
      'text_hash'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'repository_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Repository'), 'required' => false)),
      'text'          => new sfValidatorString(array('required' => false)),
      'html'          => new sfValidatorString(array('required' => false)),
      'text_hash'     => new sfValidatorString(array('max_length' => 32)),
    ));

    $this->widgetSchema->setNameFormat('documentation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documentation';
  }

}
