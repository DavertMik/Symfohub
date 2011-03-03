<?php

class RattableListener extends Doctrine_Record_Listener
{
  /**
     * Instance of Doctrine_Auditlog
     *
     * @var Doctrine_AuditLog
     */
  protected $_rattable;

    /**
     * Instantiate AuditLog listener and set the Doctrine_AuditLog instance to the class
     *
     * @param   Doctrine_AuditLog $auditLog
     * @return  void
     */
  public function __construct(Doctrine_Rattable $rattable)
  {
    $this->_rattable = $rattable;
  }
}