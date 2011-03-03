<ul>
<?php foreach ($comments as $comment): ?>
  <li>
<div><img src="/images/comments.png" alt=""><?php echo link_to($comment->title,$comment->threadInfo->link); ?> &laquo; <strong><?php echo $comment->author->name; ?></strong></div>
<p>
<?php echo $comment->message; ?>
</p>

  </li>
<?php endforeach; ?>
</ul>
