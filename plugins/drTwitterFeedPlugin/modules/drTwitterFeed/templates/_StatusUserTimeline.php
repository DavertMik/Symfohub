<?php
use_helper('I18N', 'Date');
?>
<div class="tweets">
  <?php
  if (count($tweets)):
    foreach ($tweets as $tweet):
      /* @var $tweet TwitterTweetWrapper */
      ?>
      <div class="tweet">
        <span class="date_time"><?php echo __('%distance_in_time% ago', array('%distance_in_time%' => time_ago_in_words($tweet->getDateTime()->format('U')))); ?></span>
        <span class="tweet_text"><?php echo $tweet->getRawValue()->getParsedText(); ?></span>
      </div>
      <?php
    endforeach;
  else:
    echo __('No tweets were found');
  endif;
  ?>
</div>
