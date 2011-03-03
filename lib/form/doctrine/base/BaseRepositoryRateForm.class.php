<?php

/**
 * RepositoryRate form base class.
 *
 * @method RepositoryRate getObject() Returns the current form's model object
 *
 * @package    symfohub
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRepositoryRateForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'rate'               => new sfWidgetFormInputText(),
      'comment'            => new sfWidgetFormTextarea(),
      'do_git_hub_user_id' => new sfWidgetFormInputHidden(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'rate'               => new sfValidatorNumber(array('required' => false)),
      'comment'            => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'do_git_hub_user_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('do_git_hub_user_id')), 'empty_value' => $this->getObject()->get('do_git_hub_user_id'), 'required' => false)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('repository_rate[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepositoryRate';
  }

}
