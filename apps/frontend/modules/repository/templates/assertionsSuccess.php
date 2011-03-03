<?php use_helper('Date') ; ?>
<?php echo title(array($repository['name'],'ssertions'),$repository->type); ?>
<?php if ($repository['works']) include_partial('repository/status', array('repository' => $repository, 'sf_user' => $sf_user)) ?>

<?php include_partial('repository/menu', array('repository' => $repository, 'page' => 'assertions')) ?>


<h2>Does this <?php echo $repository->type; ?> work?</h2>

<?php if ($ownerAssertion): ?>

<h3>Owner asserts</h3>
<div class="assert_owner">
<?php include_partial('assertion/assertion', array('assertion' => $ownerAssertion)); ?>
  </div>

<h3>Developers assert</h3>
<?php endif; ?>

<?php foreach ($assertions as $assertion): ?>

<?php include_partial('assertion/assertion', array('assertion' => $assertion)); ?>

<?php endforeach; ?>
