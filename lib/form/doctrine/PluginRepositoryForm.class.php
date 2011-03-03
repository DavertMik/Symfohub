<?php
/**
 * Author: davert
 * Date: 3 ñ³÷ 2011
 *
 * Class PluginRepositoryForm
 * Description:
 * 
 */
 
class PluginRepositoryForm extends RepositoryForm {

  public function configure() {
      parent::configure();

      $symfonyForm = new RequirementForm();
      $symfonyForm->type = 'symfony';
      $symfonyForm->setWidget('value', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_plugin_version'))));
      $symfonyForm->setValidator('value', new sfValidatorChoice(array('choices' => $this->getChoices('app_plugin_version'), 'multiple' => true, 'required' => true)));
      $this->embedForm('symfony', $symfonyForm);

      $doctrineForm = new RequirementForm();
      $doctrineForm->setWidget('value', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_plugin_doctrine'))));
      $doctrineForm->setValidator('value', new sfValidatorChoice(array('choices' => $this->getChoices('app_plugin_doctrine'), 'multiple' => true, 'required' => false)));
      $this->embedForm('doctrine', $doctrineForm);

      unset($this['view']);
  }

}
