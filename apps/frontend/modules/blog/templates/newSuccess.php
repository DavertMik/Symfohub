
<?php if ($repository): ?>

<h1>
<?php echo $repository; ?>
</h1>
<?php title(array('New post',$repository),'blog'); ?>
        
<?php include_partial('repository/menu',array('page' => 'write', 'repository' => $repository)) ; ?>              
<?php else: ?>

<?php echo title('New post','blog'); ?>        
        
<?php endif; ; ?>

<div class="notice"><em>You can write your review of this repository or mention some tips on it's usage. If code from this repository was useful share your experiance with everyone!</em></div>

<?php if ($sf_user->isAuthenticated()): ?>
<?php include_partial('form', array('form' => $form, 'sf_user' => $sf_user)) ?>
<?php endif; ?>
