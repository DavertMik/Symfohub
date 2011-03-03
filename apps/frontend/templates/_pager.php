<?php if ($pager->haveToPaginate()): ?>

	<?php $page = $pager->getPage() ?>

  <div class="pagination clear">
    <a href="<?php echo url_for($url) ?>?page=1">
			&laquo;
    </a>

    <a href="<?php echo url_for($url) ?>?page=<?php echo $pager->getPreviousPage() ?>">
      &larr;
    </a>

    <?php foreach ($pager->getLinks() as $page): ?>
      <?php if ($page == $pager->getPage()): ?>
        <span><?php echo $page ?></span>
      <?php else: ?>
        <a href="<?php echo url_for($url) ?>?page=<?php echo $page ?>"><?php echo $page ?></a>
      <?php endif; ?>
    <?php endforeach; ?>

    <a href="<?php echo url_for($url) ?>?page=<?php echo $pager->getNextPage() ?>">
      &rarr;
    </a>

    <a href="<?php echo url_for($url) ?>?page=<?php echo $pager->getLastPage() ?>">
      &raquo;
    </a>
  </div>
<?php endif; ?>

<div class="pagination_desc">
  Total: <strong><?php echo count($pager) ?></strong> 

  <?php if ($pager->haveToPaginate()): ?>
    - page <strong><?php echo $pager->getPage() ?>/<?php echo $pager->getLastPage() ?></strong>
  <?php endif; ?>
</div>