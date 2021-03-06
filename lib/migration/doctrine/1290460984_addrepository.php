<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addrepository extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('repository', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => 8,
              'autoincrement' => true,
              'primary' => true,
             ),
             'name' => 
             array(
              'type' => 'string',
              'length' => 255,
             ),
             'type' => 
             array(
              'type' => 'enum',
              'values' => 
              array(
              0 => 'snippet',
              1 => 'bundle',
              2 => 'application',
              ),
              'length' => NULL,
             ),
             'url' => 
             array(
              'type' => 'string',
              'length' => 255,
             ),
             'git' => 
             array(
              'type' => 'string',
              'length' => 255,
             ),
             'description' => 
             array(
              'type' => 'blob',
              'length' => NULL,
             ),
             'watchers' => 
             array(
              'type' => 'integer',
              'default' => 0,
              'length' => 8,
             ),
             'forks' => 
             array(
              'type' => 'integer',
              'default' => 0,
              'length' => 8,
             ),
             'author' => 
             array(
              'type' => 'string',
              'length' => 255,
             ),
             'is_verified' => 
             array(
              'type' => 'boolean',
              'default' => 0,
              'length' => 25,
             ),
             'is_recomeded' => 
             array(
              'type' => 'boolean',
              'default' => 0,
              'length' => 25,
             ),
             'created_at' => 
             array(
              'notnull' => true,
              'type' => 'timestamp',
              'length' => 25,
             ),
             'updated_at' => 
             array(
              'notnull' => true,
              'type' => 'timestamp',
              'length' => 25,
             ),
             'rate' => 
             array(
              'type' => 'float',
              'length' => NULL,
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
        $this->dropTable('repository');
    }
}