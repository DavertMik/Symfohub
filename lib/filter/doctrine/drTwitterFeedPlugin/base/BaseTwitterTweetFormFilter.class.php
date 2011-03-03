<?php

/**
 * TwitterTweet filter form base class.
 *
 * @package    symfohub
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTwitterTweetFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'keyword'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'screen_name' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'avatar'      => new sfWidgetFormFilterInput(),
      'user_id'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'parsed_text' => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fetched_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'keyword'     => new sfValidatorPass(array('required' => false)),
      'screen_name' => new sfValidatorPass(array('required' => false)),
      'avatar'      => new sfValidatorPass(array('required' => false)),
      'user_id'     => new sfValidatorPass(array('required' => false)),
      'parsed_text' => new sfValidatorPass(array('required' => false)),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'fetched_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('twitter_tweet_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TwitterTweet';
  }

  public function getFields()
  {
    return array(
      'keyword'     => 'Text',
      'screen_name' => 'Text',
      'avatar'      => 'Text',
      'user_id'     => 'Text',
      'native_id'   => 'Text',
      'parsed_text' => 'Text',
      'created_at'  => 'Date',
      'fetched_at'  => 'Date',
    );
  }
}
