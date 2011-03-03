<?php

/**
 * Repository form.
 *
 * @package    symfohub
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RepositoryForm extends BaseRepositoryForm {
	public function configure() {

    $this->setWidget('url', new sfWidgetFormInputHidden(array('default' => $this->getObject()->getUrl())));
    $this->setValidator('url', new sfValidatorString(array('required' => true)));

		$this->setWidget('object_tag', new sfWidgetFormInput(array('default' => $this->getObject()->getObjectTag())));
		$this->setValidator('object_tag', new sfValidatorString(array('required' => false)));

//    $this->setWidget('owner', new sfWidgetFormInput());

		$this->useFields(array('id', 'url', 'name', 'description', 'type', 'object_tag'));

		$symfonyForm = new RequirementForm();
		$symfonyForm->type = 'symfony';
		$symfonyForm->setWidget('value', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_symfony_version'))));
		$symfonyForm->setValidator('value', new sfValidatorChoice(array('choices' => $this->getChoices('app_symfony_version'), 'multiple' => true, 'required' => false)));
		$this->embedForm('symfony', $symfonyForm);

		$doctrineForm = new RequirementForm();
		$doctrineForm->setWidget('value', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_symfony_doctrine'))));
		$doctrineForm->setValidator('value', new sfValidatorChoice(array('choices' => $this->getChoices('app_symfony_doctrine'), 'multiple' => true, 'required' => false)));
		$this->embedForm('doctrine', $doctrineForm);

		$propelForm = new RequirementForm();
		$propelForm->setWidget('value', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_symfony_propel'))));
		$propelForm->setValidator('value', new sfValidatorChoice(array('choices' => $this->getChoices('app_symfony_propel'), 'multiple' => true, 'required' => false)));
		$this->embedForm('propel', $propelForm);

		$nosqlForm = new RequirementForm();
		$nosqlForm->setWidget('value', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_symfony_nosql'))));
		$nosqlForm->setValidator('value', new sfValidatorChoice(array('choices' => $this->getChoices('app_symfony_nosql'), 'multiple' => true, 'required' => false)));
		$this->embedForm('nosql', $nosqlForm);

//		$jsForm = new RequirementForm();
//		$jsForm->setWidget('value', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_symfony_javascript'))));
//		$jsForm->setValidator('value', new sfValidatorChoice(array('choices' => $this->getChoices('app_symfony_javascript'), 'multiple' => true, 'required' => false)));
//		$this->embedForm('javascript', $jsForm);

		$viewForm = new RequirementForm();
		$viewForm->setWidget('value', new sfWidgetFormSelectCheckbox(array('choices' => $this->getChoices('app_symfony_view'))));
		$viewForm->setValidator('value', new sfValidatorChoice(array('choices' => $this->getChoices('app_symfony_view'), 'multiple' => true, 'required' => false)));
		$this->embedForm('view', $viewForm);    

		$licenseForm = new RequirementForm();
		$licenseForm->setWidget('value', new sfWidgetFormSelectRadio(array('choices' => $this->getChoices('app_symfony_license'))));
		$licenseForm->setValidator('value', new sfValidatorChoice(array('choices' => $this->getChoices('app_symfony_license'), 'required' => false)));
		$this->embedForm('license', $licenseForm);

    $this->embedForm('assertion', new AssertionForm());
	}

	protected function updateDefaultsFromObject() {
		$defaults = $this->getDefaults();

		// update defaults for the main object
		if ($this->isNew()) {
			$defaults = $defaults + $this->getObject()->toArray(false);
			$this->setDefaults($defaults);
			return;
		}
		else
		{
			$defaults = $this->getObject()->toArray(false) + $defaults;
		}

		foreach ($this->embeddedForms as $name => $form)
		{
			switch ($name) {
				case 'symfony':
				case 'doctrine':
				case 'propel':
				case 'javascript':
					$names = Doctrine::getTable('Requirement')->createQuery()->
									select('value')->
									where('repository_id = ?', $this->getObject()->getId())->
									andWhere('type = ?', $name)->
									execute(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);
					$defaults[$name] = array('value' => $names);
					break;
				case 'license':
					$lic = Doctrine::getTable('Requirement')->createQuery()->
									select('value')->
									where('repository_id = ?', $this->getObject()->getId())->
									andWhere('type = ?', $name)->
									fetchOne(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);
					$defaults[$name] = array('value' => $lic);
					break;
        case 'assertion':
          $assert = Doctrine::getTable('Assertion')->createQuery('a')->
            innerJoin('a.User u')->
            where('repository_id = ?',$this->getObject()->getId())->
            andWhere('user_id = ?',$this->getObject()->Owner->id)->
            fetchOne();
          if (!$assert) break;
          $defaults[$name] = array('works' => $assert['works'], 'comment' => $assert['comment']);
          break;
			}
		}
		$this->setDefaults($defaults);
	}


	public function updateObjectEmbeddedForms($values, $forms = null) {
		if (null === $forms) {
			$forms = $this->embeddedForms;
		}

		$repo = $this->getObject();
		Doctrine::getTable('Requirement')->createQuery()->
						where('repository_id = ?', $repo->id)->
						delete()->
						execute();


		foreach ($forms as $name => $form)
		{
			if (!isset($values[$name]) || !is_array($values[$name])) {
				continue;
			}
//			throw new Exception(json_encode($values[$name]));
      if ($name == 'assertion') {
        $assertion = new Assertion();
        $assertion->works = $values[$name]['works'];
        $assertion->comment = $values[$name]['comment'];
        $assertion->repository_id = $repo->id;
        $assertion->user_id = $repo->Owner->id;
        $assertion->save();
        continue;
      }

			$vals = $values[$name]['value'];
			if (!$vals) continue;
			if (!is_array($vals)) $vals = array($vals);
			foreach ($vals as $value) {
				$req = new Requirement();
				$req->setRepository($repo);
				$req->setType($name);
				$req->setValue($value);
				$req->save();
			}
		}

	}
}
