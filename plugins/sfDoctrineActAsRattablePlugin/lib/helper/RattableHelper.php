<?php

use_helper('I18N', 'Tag', 'Date');


/**
 * Return a rating tag based on a personnalized microformat hReview

 * <div class="rating">
 *   <p class="criteria">
 *     rating_name :
 *     <span class="rating" >value</span>/<span class="max_rate">max_rate</span>
 *   </p>
 *   ...
 *   <p>rated by user_id</p>
 *   <p class="dtreviewed">formated_date</p>
 * </div>
 *
 * custom_user_helper get User as parameter
 *
 * @param <type> $object
 * @param <type> $rating
 * @param array $options (custom_user_helper, with_date, with_user)
 * @return string div
 */
function rating($object, $rating = null, $options = array())
{
  if(is_null($rating))
  {
    $rating = $object->getRating();
  }

  $toReturn = '';

  foreach($object->getRattable()->getOption('criterias') as $criteria)
  {
    $rate      = content_tag('span', $rating[$criteria], array('class' => 'rating'));
    $max_rate  = content_tag('span', $object->getRattable()->getOption('max_rate'), array('class' => 'max_rate'));
    $toReturn .= content_tag('p', sprintf('%s %s/%s', __($criteria) , $rate , $max_rate), array('class' => 'criteria'));
  }

  if($object->getRattable()->getOption('user') && isset($options['with_user']) && $options['with_user'] == true && (is_object($rating) || isset($rating['User'])))
  {
    if(isset($options['custom_user_helper']))
    {
      $toReturn .= call_user_func($options['custom_user_helper'], $rating['User']);
    }
    else
    {
      $toReturn .= content_tag('p', __('rated by %user%', array('%user%' => $rating['User'])));
    }
  }

  if(isset($options['with_date']) && $options['with_date'] == true)
  {
    $toReturn .= content_tag('p', format_date($rating['created_at']), array('class' => 'dtrevewed'));
  }

  return content_tag('div', $toReturn, array('class' => 'rating'));
}

/**
 * Return a rating list
 *
 * <div class="ratings">
 *   rating div @see rating
 * </div>
 *
 * @param Rattable $object
 * @param array/rattable object $ratings
 * @return string div
 */
function ratings($object, $ratings = null, $options = array())
{
  $options = array_merge(array('with_date' => true, 'with_user' => true), $options);
  
  if(is_null($ratings))
  {
    $ratings = $object->getRatings();
  }

  if(count($ratings) > 0)
  {
    $toReturn = '';

    foreach ($ratings as $rating)
    {
      $toReturn .= rating($object, $rating, $options);
    }

    return content_tag('div', $toReturn, array('class' => 'ratings'));
  }
  else
  {
    echo __('This %object% has never been rated', array('%object%' => get_class($object)));
  }

}