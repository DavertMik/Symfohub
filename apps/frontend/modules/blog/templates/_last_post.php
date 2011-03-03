<?php use_helper('Text','Date'); ?>
<h2><?php echo link_to($post->title,'blog_show', $post); ?></h2>
<p>
  <?php preg_match('~<p>.*?</p>~',$post->getRaw('html'), $match);; ?>
<?php echo truncate_text($match[0], 200); ?>

</p>

<?php echo link_to('Read more','blog_show', $post); ?>