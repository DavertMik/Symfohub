<?php

/**
 * blog actions.
 *
 * @package    symfohub
 * @subpackage blog
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class blogActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $query = Doctrine_Core::getTable('Post')
      ->createQuery('a')
      ->leftJoin('a.Repository')
      ->innerJoin('a.User')
      ->orderBy('created_at DESC');


    $this->pager = new sfDoctrinePager(
      'Post',
      sfConfig::get('app_max_repositories', 10)
    );
    $this->pager->setQuery($query);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();

    $this->posts = $this->pager->getResults();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->repository = Doctrine::getTable('Repository')->find($request['repository_id']);

    $post = new Post;
    if ($this->repository) $post->Repository = $this->repository;
    $this->form = new PostForm($post);
    if ($this->repository) $this->form->setWidget('repository_id', new sfWidgetFormInputHidden());
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PostForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->forward404Unless($post = Doctrine_Core::getTable('Post')->find(array($request->getParameter('id'))), sprintf('Object post does not exist (%s).', $request->getParameter('id')));
	  $this->post = $post;
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($post = Doctrine_Core::getTable('Post')->find(array($request->getParameter('id'))), sprintf('Object post does not exist (%s).', $request->getParameter('id')));
    $this->form = new PostForm($post);
    $this->form->setWidget('repository_id', new sfWidgetFormInputHidden());
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($post = Doctrine_Core::getTable('Post')->find(array($request->getParameter('id'))), sprintf('Object post does not exist (%s).', $request->getParameter('id')));
    $this->form = new PostForm($post);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($post = Doctrine_Core::getTable('Post')->find(array($request->getParameter('id'))), sprintf('Object post does not exist (%s).', $request->getParameter('id')));
    $post->delete();

    $this->redirect('blog/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $values = $request->getParameter($form->getName());
    if ($request->getParameter('is_global')) {
      unset($values['repository_id']);
    }
    $form->bind($values, $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $new = $form->getObject()->isNew();
      $form->save();
      $post = $form->getObject();
      if ($new) $post->setUserId($this->getUser()->getId());
      $post->save();
      $this->redirect('blog/show?id='.$post->getId());
    }
  }
}
