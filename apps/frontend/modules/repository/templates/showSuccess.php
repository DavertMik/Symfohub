<div class="repository_rate">
	<div id="rate" data-url="<?php echo url_for('repository_rate',$repository); ?>" data-value="<?php echo $repository->getRate(); ?>"
	     <?php echo !$sf_user->isAuthenticated() ? 'data-disabled="true" ' : '' ; ?>></div>
	<div id="rate_message" class="small">Rate <strong><?php echo $repository->getFormattedRate(); ?></strong> . Total <?php echo $repository->getRateCount(); ?> votes</div>

</div>     

<?php echo title($repository['name'], $repository['type']) ?>

<?php if (!$sf_user->isAuthenticated()): ?>
<div class="notice">Please <a href="<?php echo url_for('@do_github_login'); ?>">log in</a> using your GitHub account to rate and assert this <?php echo $repository['type']; ?>.</div>
<?php endif; ?>
        

<?php include_partial('repository/menu', array('repository' => $repository, 'page' => 'index')) ?>


<div class="info col">
  <?php if ($sf_user->isAdmin() ): ?>
  <div class="action">
  <?php echo link_to('Edit','repository_edit',$repository); ?>
  </div>
  <?php endif; ?>
    <img class="avatar" src="<?php echo $repository->getOwner()->getAvatar(); ?>" alt="<?php echo $repository['author']; ?>" width="50" height="50" />
  <strong><?php echo $repository['author']; ?></strong>
    <em>author</em>
    <strong>
    <?php echo image_tag('watchers.png'); ?>
<?php echo $repository->watchers; ?>
    <?php echo image_tag('forks.png'); ?>
    <?php echo $repository->forks; ?>
    </strong>
    <div>Updated <?php echo $repository->updated_at; ?></div>
    <div class="small">Created <?php echo $repository->created_at; ?>
	</div>
</div>



<?php if ($repository['works']) include_partial('repository/status', array('repository' => $repository, 'sf_user' => $sf_user)) ?>

<?php $a = new CamelAnalyzer;
  $parts = $a->analyze($repository->name);
  $parts = array_filter($parts, function ($a) { return (strlen($a) > 2);  } ); ?>

<div class="desc">
	<?php echo keyword_encode($repository->description,array_merge($parts, array('symfony','Symfony2'))); ?>
</div>

<h2>Symfony<?php if (strpos($repository->name,'Bundle')) echo '2';  ?> <?php echo ucwords(implode(' ',$parts)); ?></h2>

<table class="props">
    <tfoot>
	<tr>
		<th>Links</th>
		<td>
      <?php if ($repository->has_issues): ?>
            <img src="/images/note_accept.png" alt=""  align="middle" /><a href="<?php echo $repository->url; ?>/issues">Issues</a>
  <?php endif; ?>
  <?php if ($repository->has_wiki): ?>
			<img src="/images/text_page.png" alt="" /><a href="<?php echo $repository->url; ?>/wiki">Wiki</a>
    <?php endif; ?>
			<img src="/images/orange_arrow_up.png" alt="" /><a href="<?php echo $repository->url; ?>/commits/master">Commits</a>
			<img src="/images/chart.png" alt="" /><a href="<?php echo $repository->url; ?>/network">Network</a>
    <?php if ($repository->has_downloads): ?>
			<img src="/images/zip_file_download.png" alt="" /><a href="<?php echo $repository->url; ?>/tarball/master">Download <small>(tar.gz)</small></a>
      <?php endif; ?>
		</td>
	</tr>        
    </tfoot>
	<tr>
		<th>Install</th>
		<td><input type="text" value="<?php echo $repository->git; ?>"></td>
	</tr>
		<th>URL</th>
		<td><a href="<?php echo $repository->url; ?>" target="_blank"><?php echo $repository->url; ?></a> </td>
	</tr>
	<tr>
		<th>Tags</th>
		<td>
<?php foreach ($repository->getTags() as $tag): ?>
      <em><?php echo link_to($tag, '@repository_tag?tag=' . $tag); ?></em>
	<?php endforeach; ?>

<?php if ($sf_user->isAdmin()): ?>
  <form action="<?php echo url_for('repository/addTag'); ?>">
    <input type="text" name="tag" value="" />
    <input type="hidden" name="repository_id" value="<?php echo $repository->id; ?>">
    <a href="#" class="tags_save">Save</a>
  </form>
<?php endif; ?>
		</td>
	</tr>
<?php if (count($requirements)): ?>
	<tr>
		<th>Requirements</th>
		<td class="rq">
            <div class="line">
		<?php $current_type = '' ?>
		<?php foreach ($requirements as $requirement): ?>
		<?php echo ($current_type == $requirement->type) ? ' or ' : '</div><div class="line">' ?>
              <h5><span class="<?php echo $requirement->type; ?> "><?php echo ucfirst($requirement->type); ?> <?php echo $requirement->value; ?>
                </span></h5>
		<?php $current_type = $requirement->type; endforeach; ?></div>
		</td>
	</tr>
<?php endif; ?>
</table>

  <div class="right">
    <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fsymfohub.com%2Frepository%2F<?php echo $repository->id ?>&amp;layout=button_count&amp;show_faces=true&amp;width=80&amp;action=recommend&amp;font=tahoma&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:80px; height:21px;" allowTransparency="true"></iframe>


    <a href="http://twitter.com/share" class="twitter-share-button" data-text="Check out <?php echo $repository->name; ?> on Symfohub!" data-count="horizontal" data-via="symfohub" data-related="symfohub:Symfony repositories on github!">Tweet</a>
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    </div>
    <h2>Mentions</h2>
    <?php include_component('twitter','list', array('name' => $repository->name)) ?>
<div class="notice">
  Tweets with words '<?php echo $repository->name; ?>' are listed here. It's easy to say what you think of <?php echo $repository->name; ?></div>

<h2>Comments</h2>
<?php include_partial('comments', array( 'uid' => 'repository_'.$repository->id ) ) ?>


<a href="<?php echo url_for('repository_show',$repository); ?>#disqus_thread">Comments</a>


