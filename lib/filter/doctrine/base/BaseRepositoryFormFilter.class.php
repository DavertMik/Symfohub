<?php

/**
 * Repository filter form base class.
 *
 * @package    symfohub
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRepositoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'          => new sfWidgetFormFilterInput(),
      'owner'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Owner'), 'add_empty' => true)),
      'source'        => new sfWidgetFormFilterInput(),
      'parent'        => new sfWidgetFormFilterInput(),
      'description'   => new sfWidgetFormFilterInput(),
      'forks'         => new sfWidgetFormFilterInput(),
      'watchers'      => new sfWidgetFormFilterInput(),
      'fork'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'private'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'homepage'      => new sfWidgetFormFilterInput(),
      'has_wiki'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'has_issues'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'has_downloads' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'inner_rate'    => new sfWidgetFormFilterInput(),
      'type'          => new sfWidgetFormChoice(array('choices' => array('' => '', 'snippet' => 'snippet', 'bundle' => 'bundle', 'plugin' => 'plugin', 'application' => 'application', 'tool' => 'tool'))),
      'works'         => new sfWidgetFormChoice(array('choices' => array('' => '', 'yes' => 'yes', 'patch' => 'patch', 'no' => 'no', 'old' => 'old'))),
      'percent'       => new sfWidgetFormFilterInput(),
      'total'         => new sfWidgetFormFilterInput(),
      'is_verified'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_recomended' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'rate'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'          => new sfValidatorPass(array('required' => false)),
      'owner'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Owner'), 'column' => 'id')),
      'source'        => new sfValidatorPass(array('required' => false)),
      'parent'        => new sfValidatorPass(array('required' => false)),
      'description'   => new sfValidatorPass(array('required' => false)),
      'forks'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'watchers'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fork'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'private'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'homepage'      => new sfValidatorPass(array('required' => false)),
      'has_wiki'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'has_issues'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'has_downloads' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'inner_rate'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'type'          => new sfValidatorChoice(array('required' => false, 'choices' => array('snippet' => 'snippet', 'bundle' => 'bundle', 'plugin' => 'plugin', 'application' => 'application', 'tool' => 'tool'))),
      'works'         => new sfValidatorChoice(array('required' => false, 'choices' => array('yes' => 'yes', 'patch' => 'patch', 'no' => 'no', 'old' => 'old'))),
      'percent'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'total'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_verified'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_recomended' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'rate'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('repository_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Repository';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'name'          => 'Text',
      'owner'         => 'ForeignKey',
      'source'        => 'Text',
      'parent'        => 'Text',
      'description'   => 'Text',
      'forks'         => 'Number',
      'watchers'      => 'Number',
      'fork'          => 'Boolean',
      'private'       => 'Boolean',
      'homepage'      => 'Text',
      'has_wiki'      => 'Boolean',
      'has_issues'    => 'Boolean',
      'has_downloads' => 'Boolean',
      'inner_rate'    => 'Number',
      'type'          => 'Enum',
      'works'         => 'Enum',
      'percent'       => 'Number',
      'total'         => 'Number',
      'is_verified'   => 'Boolean',
      'is_recomended' => 'Boolean',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
      'rate'          => 'Number',
    );
  }
}
