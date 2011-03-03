<?php

/**
 * taggableComplete actions.
 *
 * @package    sfDoctrineActAsTaggable
 * @subpackage taggableComplete
 * @author     Tom Boutell, P'unk Avenue, www.punkave.com
 */
class taggableCompleteComponents extends sfComponents
{
	public function executeTagWidget()
	{
		if(empty($this->object))
		{
			$object_id = $this->getVarHolder()->get('object_id', false);
			$object_class = $this->getVarHolder()->get('object_class', false);
		
			if(!$object_id || !$object_class)
				throw new sfException("Must pass both object_id and object_class as option to this component.");
		
			$this->object = Doctrine::getTable($object_class)->findOneBy('id', $object_id);
		}
		else
		{
			$object_class = get_class($this->object);
			$object_id = $this->object->id;
		}
		
		if(!$this->object)
			throw new sfException("Object with specified parameters does not exist.");

   	$this->popular_tags = TagTable::getAllTagNameWithCount(null, array('model' => $object_class, 'sort_by_popularity' => true, 'limit' => 10));
		foreach($this->object->getTags() as $tag)
		{
			unset($this->popular_tags[$tag]);
		}
	}
}