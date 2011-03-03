<?php echo title('Apps','app') ?>

<div class="action" style="opacity: 0.7"><?php echo link_to('+ Add Repository','repository_new'); ?></div>
<h2>Popular symfony applications</h2>

<?php include_partial('repository/repositories', array('repositories' => $repositories, 'requirements' => $requirements)) ?>

<?php include_partial('global/pager', array( 'url' => '@apps', 'pager' => $pager )) ?>


