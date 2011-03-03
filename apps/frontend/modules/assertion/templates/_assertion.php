<div class="assert assert_<?php echo $assertion['works']; ?>">
  <div class="avatar"><img src="<?php echo $assertion->User->getAvatar(); ?>" alt="" /></div>
  <div class="body"><strong><?php echo $assertion->User->username; ?></strong> said <span><?php echo $assertion->humanizeWorks(); ?></span> <?php echo distance_of_time_in_words(strtotime($assertion->getCreatedAt())); ?> ago</div>
  <?php if ($assertion->comment): ?>
  <div class="small quiet"><?php echo $assertion->comment; ?></div>
  <?php endif; ?>
  <div class="clear"></div>
</div>