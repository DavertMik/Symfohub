<?php

/**
 * repository actions.
 *
 * @package    symfohub
 * @subpackage repository
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class repositoryActions extends sfActions {

  public function executeIndex(sfWebRequest $request) {
    $query = Doctrine::getTable('Repository')->createQuery('r INDEXBY r.id');

    $filters = $this->getUser()->getAttribute('filter', array());
    $dql = Doctrine_Core::getTable('Requirement')->
            createQuery()->
            select('repository_id');

    if (isset($filters['type'])) {
      $query->andWhereIn('type',$filters['type']);
      unset($filters['type']);
    }

    if (!empty($filters)) {
      foreach ($filters as $key => $filter) {
        foreach ($filter as $value) {
          $dql->orWhere('type = ? AND value = ?', array($key, $value));
        }
      }
      $ids = $dql->execute(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);

      if (!count($ids)) {
        $this->getUser()->setFlash('error', 'Sorry, no repositories met the requirements. Please, update your filters');
        $this->getUser()->getAttributeHolder()->remove('filter');
        $this->redirect('repository');
      }

      $query->andWhereIn('id', $ids);
    }
    $query->orderBy('updated_at DESC');

    $this->pager = new sfDoctrinePager(
      'Repository',
      sfConfig::get('app_max_repositories', 14)
    );
    $this->pager->setQuery($query);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();

    $this->repositories = $this->pager->getResults();
    $this->preloadRequirements($this->repositories->getKeys());
  }

  public function executeBundles(sfWebRequest $request) {
    $query = Doctrine::getTable('Repository')->createQuery('r INDEXBY r.id');
    $query->innerJoin('r.Owner')->where('type = ?','bundle');
    $query->orderBy('updated_at DESC');

    $this->pager = new sfDoctrinePager(
      'Repository',
      sfConfig::get('app_max_repositories', 14)
    );
    $this->pager->setQuery($query);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();

    $this->repositories = $this->pager->getResults();
    $this->preloadRequirements($this->repositories->getKeys());
  }

  public function executePlugins(sfWebRequest $request) {
    $query = Doctrine::getTable('Repository')->createQuery('r INDEXBY r.id');
    $query->where('type = ?','plugin');
    $query->innerJoin('r.Owner')->orderBy('updated_at DESC');

    $this->pager = new sfDoctrinePager(
      'Repository',
      sfConfig::get('app_max_repositories', 14)
    );
    $this->pager->setQuery($query);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();

    $this->repositories = $this->pager->getResults();
    $this->preloadRequirements($this->repositories->getKeys());
  }

  public function executeApps(sfWebRequest $request) {
    $query = Doctrine::getTable('Repository')->createQuery('r INDEXBY r.id');
    $query->where('type = ?','application');
    $query->innerJoin('r.Owner')->orderBy('inner_rate DESC');

    $this->pager = new sfDoctrinePager(
      'Repository',
      sfConfig::get('app_max_repositories', 14)
    );
    $this->pager->setQuery($query);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();

    $this->repositories = $this->pager->getResults();
    $this->preloadRequirements($this->repositories->getKeys());
  }


  public function executeShow(sfWebRequest $request) {
    $this->repository = $this->getRoute()->getObject();
    $this->forward404Unless($this->repository);
    $this->requirements = Doctrine::getTable('Requirement')->createQuery()->
            where('repository_id = ?', $this->repository->id)->
            orderBy('type DESC')->
            execute();
  }

  public function executeNew(sfWebRequest $request) {
    $this->form = new RepositoryUrlForm();
  }

  public function executeCreate(sfWebRequest $request) {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    if ($request->hasParameter('filter')) {
      $filters = $request->getParameter('filter');
      unset($filters['_csrf_token']);
      if (!empty($filters)) {
        $this->getUser()->setAttribute('filter', $filters);
        $this->forward('repository', 'index');
      }
      $this->redirect('repository');
    }

    if (!$request->hasParameter('repository')) $this->redirect('repository');

    $repoData = $request->getParameter('repository');
    $repo = Doctrine::getTable('Repository')->find($repoData['id']);
    $repo->fromArray($request->getParameter('repository'));
    $this->form = $this->matchForm($repo);
    $this->form->bind($request->getParameter('repository'));

    if ($this->form->isValid()) {
      $repository = $this->form->save();
      $repo = $this->getUser()->getAttribute('newRepo');
      $repository->fromArray(array_merge($repo->toArray(),$repository->toArray()));
      $repo->save();
      $this->redirect('@repository_show?name='.$repo->name);
    }
    $this->redirect('@repository_show?name='.$repo->name);
  }

  public function executeEdit(sfWebRequest $request) {
    $this->forward404Unless($repository = Doctrine_Core::getTable('Repository')->find(array($request->getParameter('id'))), sprintf('Object repository does not exist (%s).', $request->getParameter('id')));
    $this->form = $this->matchForm($repository);
  }

  public function executeUpdate(sfWebRequest $request) {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($repository = Doctrine_Core::getTable('Repository')->find(array($request->getParameter('id'))), sprintf('Object repository does not exist (%s).', $request->getParameter('id')));
    $this->form = $this->matchForm($repository);
    $this->form->bind($request->getParameter('repository'));
    if ($this->form->isValid()) {
      $repository = $this->form->save();
      $this->redirect('repository_show', $repository);
    }

    $this->setTemplate('edit');
  }

  public function executeCheck(sfWebRequest $request) {
    $url = $request->getParameter('url');
    if (!preg_match('~^https\\://github\\.com/([A-Za-z0-9\-]+)/([A-Za-z0-9\-]+)$~iu', $url, $matches)) {
      return $this->renderPartial('repository/error', array('error' => 'Url is incorrect'));
    }

    $repoOwner = $matches[1];
    $repoName = $matches[2];

    if (Doctrine::getTable('Repository')->createQuery()->where('owner = ?', $repoOwner)->andWhere('name = ?', $repoName)->count())
      return $this->renderPartial('repository/error', array('error' => 'Repository already on Symfohub'));

    if (Doctrine::getTable('Repository')->createQuery()->where('name = ?', $repoName)->count())
      return $this->renderPartial('repository/error', array('error' => 'Repository with that name already on Symfohub. If you are trying to add fork, contact current owner of repository or send an email to davert@mail.ua. If repository has moved we will fix that.'));


    try {
	    $repo = RepositoryTable::getInstance()->findOrCreateByNameAndOwnerName($repoName, $repoOwner);
    }
    catch (Exception $e) {
	    return $this->renderPartial('repository/error', array('error' => 'Repository '.$url.' does not exist'));
    }
    $this->getUser()->setAttribute('newRepo', $repo);
    $form = $this->matchForm($repo);

    return $this->renderPartial('repository/form', array('form' => $form));
  }

  public function executeReset() {
    $this->getUser()->getAttributeHolder()->remove('filter');
    $this->getUser()->setFlash('notice', 'Filters were reset');
    $this->redirect('repository');
  }

  public function executeTag(sfWebRequest $request) {
    $this->tag = $request->getParameter('tag');
    $this->type = $request->getParameter('type','');
    $this->forward404Unless(in_array($this->type,array('','plugin','bundle','application','tool','snippet')));
    $query = PluginTagTable::getObjectTaggedWithQuery('Repository', array($this->tag));
    if ($this->type) $query->andWhere('type = ?',$this->type);
    $query->orderBy('rate DESC, inner_rate DESC');
    $this->repositories = $query->execute();
    $this->preloadRequirements(array_map(function($a) { return $a['id']; }, $this->repositories->toArray()));
  }

  public function executeAddTag(sfWebRequest $request)
  {
      $repository = Doctrine::getTable('Repository')->find($request->getParameter('repository_id'));
      $this->forward404Unless($repository);
      $repository->addTag(explode(' ',$request->getParameter('tag')));
      $repository->save();
      return sfView::NONE;

  }

  public function executeDoc(sfWebRequest $request) {
    $this->repository = $this->getRoute()->getObject();
    $this->forward404Unless($this->repository);
  }

  public function executeAssertions(sfWebRequest $request)
  {
    $this->repository = $this->getRoute()->getObject();

    $this->ownerAssertion = Doctrine::getTable('Assertion')->createQuery('a')->
      innerJoin('a.User u')->
      where('repository_id = ?',$this->repository->id)->
      andWhere('u.username = ?',$this->repository->owner)->
      fetchOne();
    
    $this->assertions = Doctrine_Core::getTable('Assertion')
      ->createQuery('a')
      ->innerJoin('a.User u')
      ->where('repository_id = ?', $this->repository->id)
      ->andWhere('u.username <> ?',$this->repository->owner)
      ->orderBy('created_at DESC')
      ->execute();
  }

  public function executePost(sfWebRequest $request) {
    $this->forward404Unless($repository = Doctrine_Core::getTable('Repository')->find(array($request->getParameter('id'))), sprintf('Object repository does not exist (%s).', $request->getParameter('id')));
    $this->repository = $repository;

    $post = new Post;
    $post->repository_id = $repository->id;
    $this->form = new PostForm($post);
  }

  public function executeBlog(sfWebRequest $request) {
    $this->repository = $this->getRoute()->getObject();
    $this->forward404Unless($this->repository);

    $this->posts = Doctrine::getTable('Post')->createQuery('p')->
            innerJoin('p.User')->
            where('repository_id = ?', $this->repository->id)->
            orderBy('created_at DESC')->
            execute();
  }

  public function executeSearch(sfWebRequest $request) {
    $this->type = $request->getParameter('type','');
    $this->forward404Unless(in_array($this->type,array('','plugin','bundle','application','tool','snippet')));

    $ids = Doctrine::getTable('Repository')->search($request->getParameter('q'));
    $query = Doctrine::getTable('Repository')->createQuery('r INDEXBY id')->
      innerJoin('r.Owner o')->
      whereIn('id',$ids = array_map(function ($a) { return $a['id']; }, $ids))->
      orderBy('rate DESC, inner_rate DESC');

    if ($this->type) $query->addWhere('type = ?',$this->type);
    $this->repositories = $query->execute();

    $this->preloadRequirements($ids);
  }

  public function executeRate(sfWebRequest $request) {
    $this->forward404Unless($repository = Doctrine_Core::getTable('Repository')->find(array($request->getParameter('id'))), sprintf('Object repository does not exist (%s).', $request->getParameter('id')));

    $rates = array(
      'rate' => $request->getParameter('rate'),
      'do_git_hub_user_id' => $this->getUser()->getAttribute('id', 1)
    );

    $repository->addRate($rates);

    return $this->renderText(json_encode(
      array('rate' => $repository->getFormattedRate(), 'votes' => $repository->getRateCount())
    ));
  }

  public function executeDelete(sfWebRequest $request) {
    $request->checkCSRFProtection();

    $this->forward404Unless($repository = Doctrine_Core::getTable('Repository')->find(array($request->getParameter('id'))), sprintf('Object repository does not exist (%s).', $request->getParameter('id')));
    $repository->Documentation->delete();
    $repository->delete();

    $this->getUser()->setFlash('notice','Repository was succesfully deleted');

    $this->redirect('repository/index');
  }

  protected function preloadRequirements($repositories_ids) {
    $requirements = Doctrine::getTable('Requirement')->createQuery()->
            select('repository_id, type, GROUP_CONCAT(value) AS value')->
            whereIn('repository_id', $repositories_ids)->
            andWhereNotIn('type', array('javascript'))->
            groupBy('id, type')->
            orderBy('type DESC')->
            fetchArray();

    $this->requirements = array();
    foreach ($requirements as $rq) {
      $this->requirements[$rq['repository_id']][] = $rq;
    }
  }

  protected function matchForm($repo)
  {
    if ($repo->type == 'bundle') {
      return new BundleRepositoryForm($repo);
    } elseif ($repo->type == 'plugin') {
      return new PluginRepositoryForm($repo);
    } else {
      return new RepositoryForm($repo);
    }
  }

}
