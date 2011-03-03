<?php echo title('Search results for '.$sf_request->getParameter('q'),$type); ?>

<?php include_partial('repository/repositories', array('repositories' => $repositories, 'requirements' => $requirements)) ?>