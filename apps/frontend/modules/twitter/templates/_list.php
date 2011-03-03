<?php use_helper('Text') ?>
<?php $first = true; foreach ($tweets as $tweet): ?>
<div class="tweet <?php if ($first) { echo 'first'; $first = false; } ?>">
  <img src="<?php echo $tweet->avatar; ?>" class="avatar" width="20" height="20" />
  <strong><?php echo $tweet->screen_name; ?>:</strong>
  <?php echo auto_link_text($tweet->getRaw('parsed_text')); ?>
  
</div>
<?php endforeach; ?>