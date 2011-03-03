<?php

/**
 * RepositoryIndex form base class.
 *
 * @method RepositoryIndex getObject() Returns the current form's model object
 *
 * @package    symfohub
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRepositoryIndexForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'keyword'  => new sfWidgetFormInputHidden(),
      'field'    => new sfWidgetFormInputHidden(),
      'position' => new sfWidgetFormInputHidden(),
      'id'       => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'keyword'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('keyword')), 'empty_value' => $this->getObject()->get('keyword'), 'required' => false)),
      'field'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('field')), 'empty_value' => $this->getObject()->get('field'), 'required' => false)),
      'position' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('position')), 'empty_value' => $this->getObject()->get('position'), 'required' => false)),
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('repository_index[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepositoryIndex';
  }

}
