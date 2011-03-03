<div class="author">
  <div class="col">
    <img class="avatar" src="<?php echo "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $post->User->email ) ) ) . "?s=40" ?>" alt="<?php echo $post->User->username; ?>" width="50" height="50" />
    Written by <strong><?php echo $post->User->username; ?></strong><br/>
    on <em><?php echo $post->getCreatedAt(); ?></em>

  </div>
  <div class="col2">
    <?php if ($post->repository_id > 0): ?>
    <strong><?php echo link_to($post->Repository,'repository_show',$post->Repository); ?></strong>
  <?php endif; ?>
    <br/>
    <?php echo link_to('Permalink', 'blog_show', $post); ?><br/>
    <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fsymfohub.com%2Fblog%2F<?php echo $post->id ?>&amp;layout=button_count&amp;show_faces=true&amp;width=80&amp;action=recommend&amp;font=tahoma&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:80px; height:21px;" allowTransparency="true"></iframe>

    <a href="http://twitter.com/share" class="twitter-share-button" data-text="'<?php echo $post->title; ?>' on Symfohub" data-count="horizontal" data-via="symfohub" data-related="symfohub:Symfony repositories on github!">Tweet</a>
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>

  </div>
  <div class="clear"></div>
</div>