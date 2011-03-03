<?php

/**
 * assertion actions.
 *
 * @package    symfohub
 * @subpackage assertion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class assertionActions extends sfActions
{

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AssertionForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $assert = new Assertion();
    $assert->repository_id = $request->getParameter('repository_id');
    $assert->comment = $request->getParameter('comment');
    $assert->works = $request->getParameter('works');
    $assert->user_id = $this->getUser()->getId();
    $assert->save();
    return sfView::NONE;
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($assertion = Doctrine_Core::getTable('Assertion')->find(array($request->getParameter('id'))), sprintf('Object assertion does not exist (%s).', $request->getParameter('id')));
    $this->form = new AssertionForm($assertion);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($assertion = Doctrine_Core::getTable('Assertion')->find(array($request->getParameter('id'))), sprintf('Object assertion does not exist (%s).', $request->getParameter('id')));
    $this->form = new AssertionForm($assertion);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($assertion = Doctrine_Core::getTable('Assertion')->find(array($request->getParameter('id'))), sprintf('Object assertion does not exist (%s).', $request->getParameter('id')));
    $assertion->delete();

    $this->redirect('assertion/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $assertion = $form->save();

      $this->redirect('assertion/edit?id='.$assertion->getId());
    }
  }
}
