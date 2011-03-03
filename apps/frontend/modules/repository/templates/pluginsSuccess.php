<?php echo title('Symfony Plugins','plugin') ?>

<div class="filters">
<form action="<?php echo url_for('repository'); ?>" method="post">

    <?php $form = new PluginFilter; ?>
  <div class="filter"><?php echo $form['symfony']->renderRow(); ?></div>
  <div class="filter"><?php echo $form['doctrine']->renderRow(); ?><?php echo $form['propel']->renderRow(); ?></div>
    <div class="filter"><?php echo $form['javascript']->renderRow(); ?></div>
    <div class="filter"><?php echo $form['license']->renderRow(); ?></div>
    <div class="apply">
      <?php echo $form->renderHiddenFields(); ?>
        <input type="submit" value="Apply filter" />
    </div>
</form>
    <div class="clear"></div>
</div>

<div class="action" style="opacity: 0.7"><?php echo link_to('+ Add Repository','repository_new'); ?></div>
<h2>Recently added or updated</h2>

<?php include_partial('repository/repositories', array('repositories' => $repositories, 'requirements' => $requirements)) ?>

<?php include_partial('global/pager', array( 'url' => '@plugins', 'pager' => $pager )) ?>

<div class="desc notice">
 Plugins are widely used in symfony 1.x projects. They can reduce cost development by providing the common web application features like
authentication, image manipulation, tagging, searching, seo tools, etc. Plugins must be installed <a href="http://www.symfony-project.org/gentle-introduction/1_4/en/17-Extending-Symfony#chapter_17_plug_ins" target="_blank">
  following the instructions from symfony official site
</a>.
You can also clone plugin repository in 'plugins' folder of your application and enable plugin in ProjectConfiguration.php.
</div>
        


