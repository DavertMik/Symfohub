<?php

/**
 * TwitterTweetLastFetch filter form base class.
 *
 * @package    symfohub
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTwitterTweetLastFetchFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'keyword'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'screen_name' => new sfWidgetFormFilterInput(),
      'user_id'     => new sfWidgetFormFilterInput(),
      'fetched_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'keyword'     => new sfValidatorPass(array('required' => false)),
      'screen_name' => new sfValidatorPass(array('required' => false)),
      'user_id'     => new sfValidatorPass(array('required' => false)),
      'fetched_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('twitter_tweet_last_fetch_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TwitterTweetLastFetch';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'keyword'     => 'Text',
      'screen_name' => 'Text',
      'user_id'     => 'Text',
      'fetched_at'  => 'Date',
    );
  }
}
