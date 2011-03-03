<?php title(array($post->getTitle(),  $post->repository_id ? $post->Repository : ''), 'blog') ; ?>

<?php if ($sf_user->isAdmin() || ($sf_user->getUsername() == $post->User->username)): ?>
<div class="action">
  <?php echo link_to('Edit','blog_edit',$post); ?>
</div>
<?php else: ?>

<?php if ($post->repository_id): ?>
  <div class="action"><?php echo link_to('Write about this repository','@blog_new?repository_id='.$post->repository_id); ?></div>
 <?php endif; ?>


<?php endif; ?>

<h1><?php echo $post->getTitle(); ?>
  <?php if ($post->repository_id): ?>
    <small>&laquo; <?php echo link_to($post->Repository,'repository_show',$post->Repository); ?></small>
    <?php endif; ?>
</h1>

	<div class="post"><p>



    <?php echo $post->getRaw('html'); ?>
    </p></div>

  <?php include_partial('blog/author', array('post' => $post)); ?>

<h2>Comments</h2>

<div id="disqus_thread"></div>
<script type="text/javascript">
  var disqus_identifier = '<?php echo $post->id ?>';
  (function() {
    var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
    dsq.src = 'http://symfohub.disqus.com/embed.js';
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
  })();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript=symfohub">comments powered by Disqus.</a></noscript>
