<?php echo title(array($repository['name'],'Documentation'),$repository->type); ?>



<?php include_partial('repository/menu', array('repository' => $repository, 'page' => 'doc')) ?>

<?php $a = new CamelAnalyzer;
  $parts = $a->analyze($repository->name);
  $parts = array_filter($parts, function ($a) { return (strlen($a) > 2);  } ); ?>

<div class="desc">
	<?php echo keyword_encode($repository->description,array_merge($parts, array('symfony','Symfony2'))); ?>
</div>

<div class="doc">
<p>
<?php echo $sf_data->getRaw('repository')->Documentation->html; ?>
</p>
</div>
