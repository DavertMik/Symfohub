<?php echo title('New Repository') ?>

<form action="<?php echo url_for('repository/create') ?>" method="post" id="repository_form">
<?php if (count($form->getGlobalErrors())): ?>
	<div class="error"><?php echo $form->renderGlobalErrors() ?></div>

  <?php else: ?>
  <div class="notice">Please, add a repository that includes symfony related code: plugins, bundles, applications, and even snippets are welcome.
    You will also need to provide additional information, like requirements, license type, tags, etc.</div>

  <?php endif; ?>



	<div>
	<?php echo $form['url']->renderLabel() ?></th>
	<?php echo $form['url']->renderError() ?>
	</div>
	<div>
	<?php echo $form['url'] ?>
	</div>

	<input type="button" value="Check" id="repository_check" data-url="<?php echo url_for('repository_check'); ?>" />
  <img src="/images/indicator.gif" alt="" style="display: none" id="indicator" />

	<div id="extra_form"></div>

</form>