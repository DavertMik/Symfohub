<?php

/**
 * TwitterTweet form base class.
 *
 * @method TwitterTweet getObject() Returns the current form's model object
 *
 * @package    symfohub
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTwitterTweetForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'keyword'     => new sfWidgetFormInputText(),
      'screen_name' => new sfWidgetFormInputText(),
      'avatar'      => new sfWidgetFormInputText(),
      'user_id'     => new sfWidgetFormInputText(),
      'native_id'   => new sfWidgetFormInputHidden(),
      'parsed_text' => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormInputText(),
      'fetched_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'keyword'     => new sfValidatorString(array('max_length' => 255)),
      'screen_name' => new sfValidatorString(array('max_length' => 255)),
      'avatar'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'user_id'     => new sfValidatorString(array('max_length' => 255)),
      'native_id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('native_id')), 'empty_value' => $this->getObject()->get('native_id'), 'required' => false)),
      'parsed_text' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'  => new sfValidatorPass(),
      'fetched_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('twitter_tweet[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TwitterTweet';
  }

}
