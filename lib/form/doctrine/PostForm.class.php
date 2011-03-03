<?php

/**
 * Post form.
 *
 * @package    symfohub
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PostForm extends BasePostForm
{
  public function configure()
  {
    $this->validatorSchema['title'] = new sfValidatorString(array('max_length' => 255, 'required' => true));
    $this->widgetSchema['repository_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Repository'), 'add_empty' => false));
	  $this->useFields(array('id','repository_id','title','body','is_recommendation'));
  }
}
