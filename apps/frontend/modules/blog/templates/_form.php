<?php use_javascript('/markitup/jquery.markitup.js','last'); ?>
<?php use_javascript('/markitup/sets/markdown/set.js','last'); ?>

<?php use_stylesheet('/markitup/skins/jtageditor/style.css') ?>
<?php use_stylesheet('/markitup/sets/markdown/style.css') ?>

<form action="<?php echo url_for('blog/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>

    <?php if ($form->hasGlobalErrors()): ?>
    <div class="error"><?php echo $form->renderGlobalErrors() ?></div>
    <?php endif; ?>

  <?php if (!$form->getObject()->repository_id): ?>
  <strong>Select related repository:</strong> 
  <?php endif; ?>
  <?php echo $form['repository_id'] ?>
  <?php echo $form['_csrf_token'] ?>

  <?php if ($sf_user->isAdmin()): ?>
  <input type="checkbox" name="is_global" value="1" />In main blog (not related to repository)
  <?php endif; ?>


    <div><label for="blog_title">Title</label></div>
    <?php echo $form['title']->renderError() ?>
    <?php echo $form['title'] ?>
    <div>
        <?php echo $form['body']->renderError() ?>
        <?php echo $form['body'] ?>
    </div>

    <?php if ($sf_user->isAdmin()): ?>
  <div>
        Recommend this post
  <?php echo $form['is_recommendation'] ?>
  </div>
  <?php endif; ?>

    <?php if (!$form->getObject()->isNew()): ?>
    &nbsp;<?php echo link_to('Delete', 'blog/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
    <?php endif; ?>
    <input type="submit" value="Save" id="post_submit" />
</form>

<script type="text/javascript" >
   $(document).ready(function() {
      $("#post_body").markItUp(mySettings);
   });
</script>