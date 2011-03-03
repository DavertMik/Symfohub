<?php

/**
 * Rattable
 *
 */
class Doctrine_Rattable extends Doctrine_Record_Generator
{
  protected $_options = array(
                            'className'     => '%CLASS%Rate',
                            'tableName'     => false,
                            'generateFiles' => false,
                            'table'         => false,
                            'pluginTable'   => false,
                            'children'      => array(),
                            'options'       => array(),
                            'criterias'     => array('rate'),
                            'max_rate'      => 5,
                            'rounding_rate' => 1,
                            'with_comment'  => true,
                            'user'          => array('class' => 'sfGuardUser',
                                                     'type'  => 'integer',
                                                     'size'  => 4),
  );


    /**
     * __construct
     *
     * @param string $options
     * @return void
     */
  public function __construct($options)
  {
    $this->_options = Doctrine_Lib::arrayDeepMerge($this->_options, $options);
  }

  public function buildRelation()
  {
    $this->buildForeignRelation('Rates');
    $this->buildLocalRelation();
  }

    /**
     * buildDefinition
     *
     * @param object $Doctrine_Table
     * @return void
     */
  public function setTableDefinition()
  {
    if(is_int($this->_options['rounding_rate']))
    {
      $type = 'integer';
      $length = 4;
    }
    else
    {
      $type = 'float';
      $length = null;
    }

    $options['range'] = array(1 => $this->_options['max_rate']);

    foreach ($this->_options['criterias'] as $fieldName)
    {
      $this->hasColumn($fieldName, $type, $length, $options);
    }
    unset($options['range']);

    if($this->_options['with_comment'])
    {
      $this->hasColumn('comment', 'string', 4000, $options);
    }

    if($this->_options['user'])
    {
      $user = $this->_options['user'];
      $this->hasColumn(Doctrine_Inflector::tableize($user['class']) . '_id', $user['type'], $user['size'], array('primary' => true));
    }
    else
    {
      $this->hasColumn($this->getRatedObjectFk(), 'integer', null, array('primary' => true));
      $this->hasColumn('id', 'integer', null, array('primary' => true, 'autoincrement' => true));
    }

  }

  public function buildLocalRelation($alias = null)
  {
    // relation to the main object
    $options['foreign'] = $this->_options['table']->getIdentifier();
    $options['local'] = $this->getRatedObjectFk();
    $options['type'] = Doctrine_Relation::ONE;
    $options['onDelete'] = 'CASCADE';
    $options['onUpdate'] = 'CASCADE';
    $this->_table->getRelationParser()->bind($this->_options['table']->getComponentName(), $options);

    // relation to the user
    if($this->_options['user'])
    {
      $user = $this->_options['user'];

      $table = Doctrine::getTable($user['class']);
      $options['foreign'] = $table->getIdentifier();
      $options['local'] = Doctrine_Inflector::tableize($user['class']) . '_id';
      $options['type'] = Doctrine_Relation::ONE;

      $this->_table->getRelationParser()->bind($table->getComponentName() . ' as User', $options);
    }
  }

  public function getRatedObjectFk()
  {
    return ($this->_options['user']) ? 'id' : Doctrine_Inflector::tableize($this->_options['table']->getComponentName()) . '_id';
  }
}