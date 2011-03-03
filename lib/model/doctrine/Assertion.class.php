<?php

/**
 * Assertion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    symfohub
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Assertion extends BaseAssertion
{
  public function humanizeWorks() {
    switch ($this->works) {
      case 'yes': return 'yes';
      case 'patch': return 'works with my patch';
      case 'no': return 'no';
      case 'old': return 'this code is outdated';
      default: return $this->works;
    }
  }

  public function preInsert($event) {
     Doctrine::getTable('Assertion')->createQuery()->
      where('user_id = ?', $this->user_id)->
      andWhere('repository_id = ?', $this->repository_id)->
      delete()->execute();
  }

  public function postSave($event) {
    $this->Repository->calculateWorks();
  }

  public function postDelete($event) {
    $this->Repository->calculateWorks();
  }

}