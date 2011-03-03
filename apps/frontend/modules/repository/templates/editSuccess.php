<?php echo title('Edit '.$form->getObject()->getName(),$form->getObject()->type); ?>

<?php if ($form->hasGlobalErrors()): ?>
	<div class="error"><?php echo $form->renderGlobalErrors(); ?></div>
<?php endif; ?>

<?php echo $form->renderFormTag(url_for('repository/update'),array('method' => 'put')); ?>
<input name="id" value="<?php echo $form->getObject()->getId(); ?>" type="hidden" />

<?php $repository = $form->getObject() ?>

<table class="props">
  <tr>
    <th>Owner</th>
    <td><?php echo $repository['author']; ?></td>
  </tr>
	<tr>
		<th>URL</th>
		<td><a href="<?php echo $repository->url; ?>" target="_blank"><?php echo $repository->url; ?></a> </td>
	</tr>
</table>
<?php echo $form['url']; ?>
	<?php include_partial('form', array('form' => $form)) ?>

<strong><?php echo link_to('Delete','repository/delete?id='.$repository->id, array('method' => 'delete', 'confirm' => 'Are you sure?')); ?></strong>

&nbsp;&nbsp;<?php echo link_to('Back to '.$repository,'repository_show',$repository); ?>
</form>