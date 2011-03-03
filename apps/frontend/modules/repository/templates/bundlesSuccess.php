<?php echo title('Symfony2 Bundles','bundle') ?>

<div class="filters">
<form action="<?php echo url_for('repository'); ?>" method="post">

    <?php $form = new BundleFilter; ?>
  <div class="filter"><?php echo $form['doctrine']->renderRow(); ?> </div>
  <div class="filter"><?php echo $form['nosql']->renderRow(); ?></div>
      <div class="filter"><?php echo $form['view']->renderRow(); ?></div>
    <div class="filter"><?php echo $form['license']->renderRow(); ?></div>
    <div class="apply">
      <input type="hidden" name="filter[symfony]" value="2" />
      <input type="hidden" name="filter[type]" value="bundle" />
        <input type="submit" value="Apply filter" />
    </div>
</form>
    <div class="clear"></div>
</div>

<div class="action" style="opacity: 0.7"><?php echo link_to('+ Add Repository','repository_new'); ?></div>
<h2>Recently added or updated</h2>

<?php include_partial('repository/repositories', array('repositories' => $repositories, 'requirements' => $requirements)) ?>

<?php include_partial('global/pager', array( 'url' => '@bundles', 'pager' => $pager )) ?>


