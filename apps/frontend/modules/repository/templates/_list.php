<ul class="list">
	<?php foreach ($repositories as $repo): ?>
		<li><?php echo link_to($repo,'repository_show',$repo); ?>
			<div class="right"><?php echo image_tag('watchers.png') ?> <?php echo $repo->watchers; ?>
			<?php echo image_tag('forks.png'); ?> <?php echo $repo->forks; ?>
			</div>

      <div class="quiet"><?php echo $repo->description; ?></div>
		</li>
	<?php endforeach; ?>	
</ul>