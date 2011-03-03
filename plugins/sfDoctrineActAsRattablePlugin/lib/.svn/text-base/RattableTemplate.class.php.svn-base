<?php

class Rattable extends Doctrine_Template
{
    /**
     * __construct
     *
     * @param string $array
     * @return void
     */
  public function __construct(array $options = array())
  {
    parent::__construct($options);
    $this->_plugin = new Doctrine_Rattable($this->_options);
    $this->addChild(new Doctrine_Template_Timestampable($this->_options));
  }

  /**
   * Initialize the Rattable plugin for the template
   *
   * @return void
   */
  public function setUp()
  {
    $this->_plugin->initialize($this->_table);
    $this->addListener(new sfDoctrineRecordListener());
  }

  /**
   * Get the plugin instance for the Rattable template
   *
   * @return void
   */
  public function getRattable()
  {
    return $this->_plugin;
  }

  /**
   *
   * @return array() with accorded rating
   */
  public function getRating()
  {
    $select_format = 'AVG(r.%s) %s';

    $q = $this->getRatesQuery();

    foreach ($this->getRattable()->getOption('criterias') as $column)
    {
      $select[] = sprintf($select_format, $column, $column);
    }

    $q->select(implode(', ', $select));

    $rates = $q->fetchArray();

    foreach ($rates[0] as $key => $value) {
      $rounded_rates[$key] = $this->round($value);
    }

    return $rounded_rates;
  }

  public function round($value)
  {
    $rounding = $this->getRattable()->getOption('rounding_rate');
    return (round($value/$rounding)*$rounding);
  }

  /**
   *
   * @return int number of votes
   */
  public function getRateCount()
  {
    return $this->getRatesQuery()->count();
  }

  /**
   *
   * @return boolean true if ok, false else
   */
  public function addRate($rate)
  {
    $related = $this->getRattable()->getOption('className');
    $rate_obj = new $related();
    $rate_obj->merge($rate, true);

    if(!$this->getRattable()->getOption('user'))
    {
      $fk = $this->getRattable()->getRatedObjectFk();
      $rate_obj->$fk = $this->getInvoker()->id;
    }
    else
    {
      $rate_obj->id = $this->getInvoker()->id;
    }

    $rate_obj->save();

    $this->getInvoker()->link('Rates', $rate_obj->id);
  }

  /**
   *
   * @return boolean true if ok, false else
   */
  public function removeRatings()
  {
    return $this->getRatesQuery()->delete()->execute();
  }

  public function getRatings($hydration = Doctrine::HYDRATE_RECORD)
  {
    return $this->getRatesQuery()->execute(array(), $hydration);
  }

  public function getRatesQuery()
  {
    return Doctrine_Query::create()
    ->from(get_class($this->getInvoker()) . 'Rate as r')
    ->where('r.' . $this->getRattable()->getRatedObjectFk() . ' = ?', array($this->getInvoker()->id));
  }

}