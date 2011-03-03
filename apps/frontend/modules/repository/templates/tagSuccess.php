<?php echo title('Category: symfony '.ucfirst($tag), $type) ?>

<?php include_partial('repository/repositories', array('repositories' => $repositories, 'requirements' => $requirements)) ?>