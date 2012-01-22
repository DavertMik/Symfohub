<?php

/**
 * Repository form base class.
 *
 * @method Repository getObject() Returns the current form's model object
 *
 * @package    symfohub
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRepositoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInputText(),
      'owner'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Owner'), 'add_empty' => true)),
      'source'        => new sfWidgetFormInputText(),
      'parent'        => new sfWidgetFormInputText(),
      'description'   => new sfWidgetFormTextarea(),
      'forks'         => new sfWidgetFormInputText(),
      'watchers'      => new sfWidgetFormInputText(),
      'fork'          => new sfWidgetFormInputCheckbox(),
      'private'       => new sfWidgetFormInputCheckbox(),
      'homepage'      => new sfWidgetFormTextarea(),
      'has_wiki'      => new sfWidgetFormInputCheckbox(),
      'has_issues'    => new sfWidgetFormInputCheckbox(),
      'has_downloads' => new sfWidgetFormInputCheckbox(),
      'inner_rate'    => new sfWidgetFormInputText(),
      'type'          => new sfWidgetFormChoice(array('choices' => array('snippet' => 'snippet', 'bundle' => 'bundle', 'plugin' => 'plugin', 'application' => 'application', 'tool' => 'tool'))),
      'works'         => new sfWidgetFormChoice(array('choices' => array('yes' => 'yes', 'patch' => 'patch', 'no' => 'no', 'old' => 'old'))),
      'percent'       => new sfWidgetFormInputText(),
      'total'         => new sfWidgetFormInputText(),
      'is_verified'   => new sfWidgetFormInputCheckbox(),
      'is_recomended' => new sfWidgetFormInputCheckbox(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'rate'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'owner'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Owner'), 'required' => false)),
      'source'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'parent'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'   => new sfValidatorString(array('required' => false)),
      'forks'         => new sfValidatorInteger(array('required' => false)),
      'watchers'      => new sfValidatorInteger(array('required' => false)),
      'fork'          => new sfValidatorBoolean(array('required' => false)),
      'private'       => new sfValidatorBoolean(array('required' => false)),
      'homepage'      => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'has_wiki'      => new sfValidatorBoolean(array('required' => false)),
      'has_issues'    => new sfValidatorBoolean(array('required' => false)),
      'has_downloads' => new sfValidatorBoolean(array('required' => false)),
      'inner_rate'    => new sfValidatorInteger(array('required' => false)),
      'type'          => new sfValidatorChoice(array('choices' => array(0 => 'snippet', 1 => 'bundle', 2 => 'plugin', 3 => 'application', 4 => 'tool'), 'required' => false)),
      'works'         => new sfValidatorChoice(array('choices' => array(0 => 'yes', 1 => 'patch', 2 => 'no', 3 => 'old'), 'required' => false)),
      'percent'       => new sfValidatorInteger(array('required' => false)),
      'total'         => new sfValidatorInteger(array('required' => false)),
      'is_verified'   => new sfValidatorBoolean(array('required' => false)),
      'is_recomended' => new sfValidatorBoolean(array('required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
      'rate'          => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('repository[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Repository';
  }

}
