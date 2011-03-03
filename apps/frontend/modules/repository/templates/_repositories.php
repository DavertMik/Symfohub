<?php $i=0;
$requirements = $sf_data->getRaw('requirements');
foreach ($repositories as $repository): ?>
    <?php if (($i+1) % 2) echo '<div class="clear repoline">'; ?>

<div class="repo <?php echo 'rcol'.(($i % 2)+1)?> <?php echo $repository->getType() ?>">

  <div class="right type">
    <strong><?php echo $repository->getType() ?></strong>
  </div>
	<h3><?php echo link_to($repository->getName(),'repository_show',$repository); ?></h3>

  <img class="avatar" src="<?php echo $repository->getOwner()->getAvatar(); ?>" alt="<?php echo $repository['author']; ?>" width="40" height="40" />

  <div class="descr"><?php echo $repository->getDescription() ?></div>
  <div class="small"><strong><?php echo $repository->getAuthor() ?></strong>, updated on <?php echo $repository->getUpdatedAt() ?></div>

  <?php if ($sf_user->isAdmin()): ?>
  <a href="#" onclick="$(this).next().toggle(); return false;">Add tags</a>
  <div style="display: none">
  <form action="<?php echo url_for('repository/addTag'); ?>">
    <input type="text" name="tag" value="" />
    <input type="hidden" name="repository_id" value="<?php echo $repository->id; ?>">
    <a href="#" class="tags_save">Save</a>
  </form>
  </div>
  <?php endif; ?>

  <?php /*
  <div class="small">
    <?php $tags = $repository->getTags(); foreach ($tags as $tag): ?>

        <?php echo link_to($tag, sprintf('@repository_tag?tag=%s',$tag)); ?>

        <?php endforeach; ?>

  </div>*/
 ?>

    <div class="right">

    <strong><small>
          <img src="/images/watchers.png" alt="watchers" title="watchers" />
         <?php echo $repository->getWatchers() ?>
         <img src="/images/forks.png" alt="forks" title="forks" />
         <?php echo $repository->getForks() ?>
 </small></strong>

  </div>

    <?php if ($repository->rate > 0): ?>
    <h4>Community rate: <?php echo $repository->rate; ?></h4>
    <?php else: ?>
    <h4>Not rated by community</h4>
    <?php endif; ?>



	<div class="status clear">



      <?php if (isset($requirements[$repository->id])) foreach ($requirements[$repository->id] as $rq): ?>



            <?php if (in_array($rq['type'], array('symfony','propel','doctrine'))): ?>
            <span class="rq">
            <img src="/images/<?php echo $rq['type']; ?>.png" alt="<?php echo $rq['type']; ?>" title="<?php echo $rq['type']; ?>" />
            <strong>
                <?php echo $rq['value']; ?>
            </strong>
		    </span>
            <?php else: ?>
            <div class="right rq">
                <?php echo $rq['value']; ?>
            </div>
            <?php endif; ?>

			<?php endforeach; ?>


	</div>
</div>

          <?php if ($i % 2) echo '</div>'; ?>

<?php $i++; endforeach; ?>

    <?php if ($i % 2) echo '</div>'; ?>