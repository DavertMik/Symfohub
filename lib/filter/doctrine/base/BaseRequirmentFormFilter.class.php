<?php

/**
 * Requirment filter form base class.
 *
 * @package    symfohub
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRequirmentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'repostory_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Repository'), 'add_empty' => true)),
      'type'         => new sfWidgetFormChoice(array('choices' => array('' => '', 'symfony' => 'symfony', 'orm' => 'orm', 'javascript' => 'javascript'))),
      'name'         => new sfWidgetFormFilterInput(),
      'version'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'repostory_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Repository'), 'column' => 'id')),
      'type'         => new sfValidatorChoice(array('required' => false, 'choices' => array('symfony' => 'symfony', 'orm' => 'orm', 'javascript' => 'javascript'))),
      'name'         => new sfValidatorPass(array('required' => false)),
      'version'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('requirment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Requirment';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'repostory_id' => 'ForeignKey',
      'type'         => 'Enum',
      'name'         => 'Text',
      'version'      => 'Text',
    );
  }
}
