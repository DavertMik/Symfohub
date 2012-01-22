<?php

/**
 * doGitHubUser filter form base class.
 *
 * @package    symfohub
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasedoGitHubUserFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'username' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Repositories'), 'add_empty' => true)),
      'email'    => new sfWidgetFormFilterInput(),
      'is_admin' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'username' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Repositories'), 'column' => 'id')),
      'email'    => new sfValidatorPass(array('required' => false)),
      'is_admin' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('do_git_hub_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'doGitHubUser';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'username' => 'ForeignKey',
      'email'    => 'Text',
      'is_admin' => 'Boolean',
    );
  }
}
