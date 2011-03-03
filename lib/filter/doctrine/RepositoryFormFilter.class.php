<?php

/**
 * Repository filter form.
 *
 * @package    symfohub
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RepositoryFormFilter extends BaseRepositoryFormFilter
{
  public function configure()
  {

    $this->useFields(array('type'));
  }
}
