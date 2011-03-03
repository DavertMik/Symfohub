<?php

/**
 * TwitterTweetLastFetch form base class.
 *
 * @method TwitterTweetLastFetch getObject() Returns the current form's model object
 *
 * @package    symfohub
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTwitterTweetLastFetchForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'keyword'     => new sfWidgetFormInputText(),
      'screen_name' => new sfWidgetFormInputText(),
      'user_id'     => new sfWidgetFormInputText(),
      'fetched_at'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'keyword'     => new sfValidatorString(array('max_length' => 255)),
      'screen_name' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'user_id'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'fetched_at'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('twitter_tweet_last_fetch[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TwitterTweetLastFetch';
  }

}
