<div class="menu">
<ul class="<?php echo $repository['type']; ?>">
<li <?php if ($page=='index') echo 'class="active"' ?>><?php echo link_to(ucfirst($repository['type']), 'repository_show',$repository); ?></li>
  <li <?php if ($page=='doc') echo 'class="active"' ?> ><?php echo link_to('Documentation', 'repository_doc',$repository); ?></li>
  <li <?php if ($page=='assertions') echo 'class="active"' ?> ><?php echo link_to('Assertions', 'repository_assertion',$repository); ?></li>
<?php if ($repository->Posts->count()): ?>
  <li <?php if ($page=='blog') echo 'class="active"' ?>><?php echo link_to('Blog', 'repository_blog',$repository); ?></li>
  <?php endif; ?>
<li <?php if ($page=='write') echo 'class="active"' ?>><?php echo link_to('Write about it', '@blog_new?repository_id='.$repository->id); ?></li>
  
</ul>
</div>