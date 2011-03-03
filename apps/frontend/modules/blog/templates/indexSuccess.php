<div class="action">
  <?php echo link_to('Write post','blog_new'); ?>
</div>

<?php echo title('Blog','blog')  ?>

<div class="notice"><em>
  Here we write everything related to symfony, and related symfony repositories. <br/>Share your experience and tell us what you know about published here symfony plugins, bundles, snippets, etc.

</em></div>

<?php foreach($posts as $post): ?>

<h2><?php echo link_to($post, 'blog_show', $post); ?>
  <?php if ($post->repository_id): ?>
  <small>&laquo; <?php echo link_to($post->Repository,'repository_show',$post->Repository); ?></small>
  <?php endif; ?>
</h2>

<div class="post clear">
  <p><?php echo $post->getRaw('html'); ?></p>
</div>
<?php include_partial('blog/author', array('post' => $post )) ?>        

<?php endforeach; ?>

<?php include_partial('global/pager', array( 'url' => 'post', 'pager' => $pager )) ?>