<?php

/**
 * doGitHubUser form base class.
 *
 * @method doGitHubUser getObject() Returns the current form's model object
 *
 * @package    symfohub
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasedoGitHubUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'username' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Repositories'), 'add_empty' => true)),
      'email'    => new sfWidgetFormInputText(),
      'is_admin' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'username' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Repositories'), 'required' => false)),
      'email'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_admin' => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'doGitHubUser', 'column' => array('username')))
    );

    $this->widgetSchema->setNameFormat('do_git_hub_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'doGitHubUser';
  }

}
