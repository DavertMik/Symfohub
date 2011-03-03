<?php $a = new Assertion(); $a->works = $repository['works']; ?>
<a href="#" id="works" <?php if (!$sf_user->isAuthenticated()) echo 'data-disabled="true"' ?> title="Does it work for you? Make your assertion.">
<?php if ($repository['total'] >= 3): ?>
<div class="works">
  Does it work?
  <div class="percent <?php echo $repository['works']; ?>"><?php echo $repository['percent']; ?>%</div>
  of developers say <strong class="<?php echo $repository['works']; ?>"><?php echo $repository['works']; ?></strong>
</div>
  <?php elseif ($repository['works'] == 'unknown'): ?>

<div class="works">
  Does it work?
  <div class="percent <?php echo $repository['works']; ?>">status</div>
  is <strong class="<?php echo $repository['works']; ?>"><?php echo $a->humanizeWorks(); ?></strong>.
</div>
  <?php else: ?>
<div class="works">
  Does it work?
  <div class="percent <?php echo $repository['works']; ?>">owner</div>
  says <strong class="<?php echo $repository['works']; ?>"><?php echo $a->humanizeWorks(); ?></strong>.
</div>
<?php endif; ?>
</a>
<?php if ($sf_user->isAuthenticated()): ?>
<div id="user_assertion" style="display: none">
  <div class="assertion">
  <div>Does it work for you?</div>
  <form action="<?php echo url_for('assertion'); ?>" method="post">
    <input type="hidden" name="repository_id" value="<?php echo $repository['id']; ?>" />
    <textarea name="comment" cols="30" rows="10"></textarea>
  <ul>
  <li class="yes"><a href="#" data-value="yes">Yes</a></li>
  <li class="patch"><a href="#" data-value="patch">With patch</a></li>
  <li class="no"><a href="#" data-value="no">No</a></li>
  <li class="old"><a href="#" data-value="old">Outdated</a></li>
  </ul>
  </form>
  </div>
</div>
  <?php endif; ?>