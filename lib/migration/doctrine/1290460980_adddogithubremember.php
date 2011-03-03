<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Adddogithubremember extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('do_git_hub_remember', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => 8,
              'autoincrement' => true,
              'primary' => true,
             ),
             'remember_key' => 
             array(
              'type' => 'string',
              'length' => 32,
             ),
             'user_id' => 
             array(
              'type' => 'integer',
              'length' => 8,
             ),
             'access_token' => 
             array(
              'type' => 'string',
              'length' => 50,
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
        $this->dropTable('do_git_hub_remember');
    }
}