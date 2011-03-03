<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addrequirment extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('requirment', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => 8,
              'autoincrement' => true,
              'primary' => true,
             ),
             'repostory_id' => 
             array(
              'type' => 'integer',
              'length' => 8,
             ),
             'type' => 
             array(
              'type' => 'enum',
              'values' => 
              array(
              0 => 'symfony',
              1 => 'orm',
              2 => 'javascript',
              ),
              'length' => NULL,
             ),
             'name' => 
             array(
              'type' => 'string',
              'length' => 255,
             ),
             'version' => 
             array(
              'type' => 'string',
              'length' => 5,
             ),
             ), array(
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'id',
             ),
             'charset' => 'UTF8',
             ));
    }

    public function down()
    {
        $this->dropTable('requirment');
    }
}