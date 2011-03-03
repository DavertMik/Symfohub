<h1>Write post</h1>
<?php title('New post','blog'); ?>

<?php if ($sf_user->isAuthenticated()): ?>
<?php include_partial('blog/form', array('form' => $form)) ?>
<?php else: ?>
<div class="notice">Please <?php echo link_to('login','@do_github_login'); ?> with your GitHub account to write post on this repository</div>
<?php endif; ?>

