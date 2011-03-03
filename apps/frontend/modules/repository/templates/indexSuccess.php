<?php echo title('Symfony Repositories'); ?>

<?php if ($filters = $sf_user->getAttribute('filter')): ?>
<ul class="notice">
	<li>Current filters:</li>
<?php foreach ($filters as $filter => $value): ?>
<?php $value = $filters->getRaw($filter); ?>
	<li><?php echo $filter; ?> <strong><?php echo implode(' ,',$value); ?></strong></li>
<?php endforeach; ?>
	<li class="last"><?php echo link_to('Reset filters' ,'repository/reset'); ?></li>
</ul>


<?php else: ?>
<div class="filters">
<form action="<?php echo url_for('repository'); ?>" method="post">

    <?php $form = new ListFilter; ?>
    <div class="filter"><?php echo $form['symfony']->renderRow(); ?> <?php echo $form['view']->renderRow(); ?></div>
    <div class="filter"><?php echo $form['doctrine']->renderRow(); ?> <?php echo $form['propel']->renderRow(); ?></div>
    <div class="filter"><?php echo $form['license']->renderRow(); ?></div>
  <div class="filter"><?php echo $form['type']->renderRow(); ?></div>
    <div class="apply">
        <input type="submit" value="Apply filter" />
    </div>
</form>
    <div class="clear"></div>
</div>
<?php endif; ?>

<div class="action" style="opacity: 0.7"><?php echo link_to('+ Add Repository','repository_new'); ?></div>
<h2>Recently added or updated</h2>

<?php include_partial('repository/repositories', array('repositories' => $repositories, 'requirements' => $requirements)) ?>

<?php include_partial('global/pager', array( 'url' => 'repository', 'pager' => $pager )) ?>


