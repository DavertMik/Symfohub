<?php

/**
 * Assertion form.
 *
 * @package    symfohub
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AssertionForm extends BaseAssertionForm
{
  public function configure()
  {
    $workingState = array('' => '', 'yes' => 'Works','patch' => 'Requires customization', 'no' => 'Not working', 'old' => 'Deprecated');
    $this->widgetSchema['works']->setOption('choices', $workingState);
    $this->useFields(array('works','comment'));
  }
}
