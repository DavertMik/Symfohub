<?php
/**
 * Author: davert
 * Date: 3 �� 2011
 *
 * Class BundleRepositoryForm
 * Description:
 * 
 */
 
class BundleRepositoryForm extends RepositoryForm {

  public function configure() {
      parent::configure();

      $symfonyForm = new RequirementForm();
      $symfonyForm->type = 'symfony';
      $symfonyForm->setWidget('value', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_bundle_version'))));
      $symfonyForm->setValidator('value', new sfValidatorChoice(array('choices' => $this->getChoices('app_bundle_version'), 'multiple' => true, 'required' => true)));
      $this->embedForm('symfony', $symfonyForm);

      $doctrineForm = new RequirementForm();
      $doctrineForm->setWidget('value', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_bundle_doctrine'))));
      $doctrineForm->setValidator('value', new sfValidatorChoice(array('choices' => $this->getChoices('app_bundle_doctrine'), 'multiple' => true, 'required' => false)));
      $this->embedForm('doctrine', $doctrineForm);
      unset($this['propel']);
  }


}
