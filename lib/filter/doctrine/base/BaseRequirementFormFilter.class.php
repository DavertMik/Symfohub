<?php

/**
 * Requirement filter form base class.
 *
 * @package    symfohub
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRequirementFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'repository_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Repository'), 'add_empty' => true)),
      'type'          => new sfWidgetFormChoice(array('choices' => array('' => '', 'symfony' => 'symfony', 'doctrine' => 'doctrine', 'propel' => 'propel', 'view' => 'view', 'nosql' => 'nosql', 'javascript' => 'javascript', 'license' => 'license'))),
      'value'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'repository_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Repository'), 'column' => 'id')),
      'type'          => new sfValidatorChoice(array('required' => false, 'choices' => array('symfony' => 'symfony', 'doctrine' => 'doctrine', 'propel' => 'propel', 'view' => 'view', 'nosql' => 'nosql', 'javascript' => 'javascript', 'license' => 'license'))),
      'value'         => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('requirement_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Requirement';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'repository_id' => 'ForeignKey',
      'type'          => 'Enum',
      'value'         => 'Text',
    );
  }
}
