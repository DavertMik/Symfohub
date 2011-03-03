<?php

/**
 * Documentation filter form base class.
 *
 * @package    symfohub
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDocumentationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'repository_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Repository'), 'add_empty' => true)),
      'text'          => new sfWidgetFormFilterInput(),
      'html'          => new sfWidgetFormFilterInput(),
      'text_hash'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'repository_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Repository'), 'column' => 'id')),
      'text'          => new sfValidatorPass(array('required' => false)),
      'html'          => new sfValidatorPass(array('required' => false)),
      'text_hash'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('documentation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documentation';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'repository_id' => 'ForeignKey',
      'text'          => 'Text',
      'html'          => 'Text',
      'text_hash'     => 'Text',
    );
  }
}
