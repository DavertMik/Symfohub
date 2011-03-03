<table class="form">
	<tr>
		<th>Name</th>
		<td>
				<?php echo $form['name']->renderError() ?>
		<?php echo $form['name']; ?></td>
	</tr>

	<tr class="odd">
		<th>Description</th>
		<td>
		<?php echo $form['description']->renderError() ?>
		<?php echo $form['description']; ?></td>
	</tr>

  	<tr>
		<th>Type</th>
		<td>
		<?php echo $form['type']->renderError() ?>
		<?php echo $form['type']; ?></td>
	</tr>

	<tr class="odd">
		<th>Tags</th>
		<td>
		<?php echo $form['object_tag']->renderError() ?>
		<?php echo $form['object_tag']; ?>
      <div class="small">separate tags with space</div></td>
	</tr>

	<tr>
		<th>
			Symfony version
		</th>
		<td>
		<?php echo $form['symfony']['value']->renderError() ?>
			<?php echo $form['symfony']['value']; ?>
		</td>
	</tr>
	<tr  class="odd">
		<th>License</th>
		<td>
		<?php echo $form['license']['value']->renderError() ?>
		<?php echo $form['license']['value']; ?></td>
	</tr>
	<tr>
		<th>ORM</th>
		<td>
		<?php echo $form['doctrine']['value']->renderError() ?>

    <?php if (isset($form['propel'])): ?>
		<?php echo $form['propel']['value']->renderError() ?>
    <?php endif; ?>

			<div><?php echo image_tag('doctrine.png'); ?>  Doctrine: <?php echo $form['doctrine']['value']; ?></div>

      <?php if (isset($form['propel'])): ?>
			<div><?php echo image_tag('propel.png'); ?> Propel: <?php echo $form['propel']['value']; ?></div>
    <?php endif; ?>
		</td>
	</tr>
	<tr  class="odd">
		<th>NoSQL engines used</th>
		<td>
		<?php echo $form['nosql']['value']->renderError() ?>
			<div><?php echo $form['nosql']['value']; ?></div>
		</td>
	</tr>
  <?php if (isset($form['view'])): ?>
	<tr>
		<th>View</th>
		<td>
		<?php echo $form['view']['value']->renderError() ?>
		<?php echo $form['view']['value']; ?></td>
	</tr>
  <?php endif; ?>
    <?php if (isset($form['assertion'])): ?>
  <tr  class="odd">
    <th>Does it work?</th>
    <td>
    <?php echo $form['assertion']['works']->renderError() ?>
    <?php echo $form['assertion']['works']; ?>
    <div class="small"><em><strong>Works</strong></em> - code works perfectly for you<br/>
      <em><strong>Requires customization</strong></em> - developers will need to extend this code to make it work <br/>
      <em><strong>Not working</strong></em> - this code just stub or skeleton. It's will not work out of the box<br/>
      <em><strong>Deprecated</strong></em> - this code is very old and doesn't match current APIs<br/>
    </div>
    </td>
  </tr>
  <tr>
    <th>Additional comments</th>
    <td>
    <?php echo $form['assertion']['comment']->renderError() ?>
    <?php echo $form['assertion']['comment']; ?>

    <div class="small">Please state the stability of this code. <br/> If there are any configuration options needed to make this code work mention them here</div>
    </td>
  </tr>

  <?php endif; ?>


</table>

<?php echo $form->renderHiddenFields();; ?>

<input type="submit" value="Save" />