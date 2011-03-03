<?php use_helper('jQuery') ?>

<div class="assigned-tags">
  <h5>Tags</h5>
	<?php if (count($object->getTags())): ?>
		<ul>
			<?php foreach ($object->getTags() as $tag): ?>
				<li>
				<span><?php echo $tag ?></span>
				<?php echo jq_link_to_remote('Remove', array(
					'url' => url_for('taggable_remove_tag', array('object_id' => $object->id, 'object_class' => get_class($object), 'tags' => $tag)),
					'complete' => '$(".assigned-tags").parent().html(XMLHttpRequest.responseText);'
					), array(
						'class' => 'a-btn icon a-close-small no-label nobg',
						'title' => 'Remove "'.$tag.'"', 
					))?>
			</li>
			<?php endforeach ?>
		</ul>
	<?php endif ?>
</div>

<div class="add-tags">
	<?php echo jq_form_remote_tag(array(
		'url' => url_for('taggable_add_tag', array('object_id' => $object->id, 'object_class' => get_class($object))),
		'complete' => '$(".assigned-tags").parent().html(XMLHttpRequest.responseText); $("#taggable-add-tag-form input.add-text").focus();',
	), array('id' => 'taggable-add-tag-form', )) ?>
	<input class="add-text tag-input" name="tags" type="text" />
	<input type="submit" class="a-btn icon a-submit a-add" value="Add" />
	<div class="add-tags-help">
		You can add multiple tags at once separated with commas.
	</div>
	</form>
</div>

<?php if (count($popular_tags)): ?>
	<div class="popular-tags">
	  <h5>Popular Tags</h5>
	  <ul>
	    <?php $n=1; foreach ($popular_tags as $tag => $count): ?>
				<li>
					<?php echo jq_link_to_remote($tag, array(
						'url' => url_for('taggable_add_tag', array('object_id' => $object->id, 'object_class' => get_class($object), 'tags' => $tag)),
						'complete' => '$(".assigned-tags").parent().html(XMLHttpRequest.responseText);'
						), array(
							'class' => ''
						))?>
				</li>
	    <?php $n++; endforeach ?>
	  </ul>
	</div>
<?php endif ?>