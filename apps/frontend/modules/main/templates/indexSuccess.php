<?php title('Collection of symfony framework tools','front') ; ?>
<div class="promo">
	<div class="button">
		<a href="<?php echo url_for('repository/new'); ?>" >
			Add Repository
		</a>
		<em>Share your symfony code now</em>
	</div>
	<div class="disclaimer">
		We gather, review, and recomend you tools for <strong>symfony</strong> framework hosted on github.
	</div>
</div>

<div class="col">
	<h2>Updated Repositories</h2>
	<?php include_component('repository', 'list', array('order' => 'updated_at DESC')) ?>

</div>

<div class="col2">
	<h2>Popular Repositories</h2>
	<?php include_component('repository', 'list', array('order' => 'inner_rate DESC')) ?>

</div>
<div class="clear">
  <h2>
    <img src="/images/twitter.png" alt="Twitter" title="Twitter" class="right" />
    Symfohub in Twitter</h2>

  <?php include_component('twitter','list') ?>

  <div class="notice">Tweet to the <strong>#symfohub</strong> channel and see your tweets here.</div>

</div>

