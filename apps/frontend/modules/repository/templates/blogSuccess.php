<?php echo title(array($repository['name'],'Blog'),$repository->type); ?>

<?php include_partial('repository/menu', array('repository' => $repository, 'page' => 'blog')) ?>

<div class="action"><?php echo link_to('Write about this repository','@blog_new?repository_id='.$repository->id); ?></div>
        
<?php foreach ($posts as $post): ?>

<h2><?php echo link_to($post, 'blog_show', $post); ?></h2>

<div class="post clear">
  <p><?php echo $post->getRaw('html'); ?></p>
</div>
<?php include_partial('blog/author', array('post' => $post )) ?>

<?php endforeach; ?>