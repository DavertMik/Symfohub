<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/images/favicon.png" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
	  <link href='http://fonts.googleapis.com/css?family=Philosopher&subset=latin' rel='stylesheet' type='text/css'>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1899308-8']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
  </head>
  <body>
  <div id="root">

  <div class="head">

	  <div class="nav">
	  <a class="logo" href="/" alt="symfohub"><img src="/images/logo.png" alt="symfohub" />
	  </a>
      <?php $cat = get_slot('category','repository'); if (!$cat) $cat = 'repository'; ?>
	  <ul>
	  <li><?php echo link_to('REPOSITORIES','repository',array(),array('class' => $cat == 'repository' ? 'active' : '')); ?></li>
      <li><?php echo link_to('PLUGINS','@plugins',array('class' => $cat == 'plugin' ? 'active' : '')); ?></li>
      <li><?php echo link_to('BUNDLES','@bundles',array('class' => $cat == 'bundle' ? 'active' : '')); ?></li>
	  <li><?php echo link_to('APPS','@apps', array('class' => $cat == 'app' ? 'active' : '')); ?></li>
	  <?php /* <li><?php echo link_to('BLOG','blog',array(),array('class' => $cat == 'blog' ? 'active' : '')); ?></li> */ ?>
	  </ul>
  </div>

  </div>

  <div class="layout">
    <div class="content">

      <?php if ($sf_user->hasFlash('notice')): ?>

  <div class="notice" id="notice" ><?php echo $sf_user->getFlash('notice'); ?></div>
        
  <?php endif; ?>
      
      <?php echo $sf_content ?>
    </div>
	  <div class="sidebar">

      <div class="inner">
        <?php if ($cat == 'plugin'): ?>


    <div class="search">
      <form action="<?php echo url_for('@plugins_search') ?>">
        <input type="text" name="q" value="Search for plugins" />
      </form>
    </div>
        <?php elseif ($cat == 'bundle'): ?>
                  <div class="search">
      <form action="<?php echo url_for('@bundles_search') ?>">
        <input type="text" name="q" value="Search for bundles" />
      </form>
    </div>
        <?php else:?>

    <div class="search">
      <form action="<?php echo url_for('@search') ?>">
        <input type="text" name="q" value="Search for repositories" />
      </form>
    </div>              


        <?php endif; ?>


            <?php if (!$sf_user->isAuthenticated()): ?>
              <a class="login" href="<?php echo url_for('@do_github_login'); ?>">Login with <strong>github</strong></a>
              <?php else: ?>

              <div class="member">
                <div class="right"><a href="/logout">Logout</a></div>
                  <img src="<?php echo $sf_user->getAttribute('avatar'); ?>" alt="" class="avatar" />
                  Logged as<br/>
                  <strong>
                      <?php echo $sf_user->getAttribute('username'); ?>
                  </strong>
              </div>


            <?php endif; ?>
<div class="clearfix"></div>

                <?php include_component('blog','last_post'); ?>

        		  <h2>Categories</h2>
	  <?php include_partial('repository/tags',array('cat' => $cat)) ?>




        <h2>Comments</h2>

        <?php include_component('main','comments'); ?>


	  </div>
  </div>
    </div>
      <div id="root_footer"></div>
  </div>

  <div id="footer">
	  <div class="inner">

      <div class="col">
        <div class="footnote">
          <h4>Related links</h4>
          <img src="/images/symfony.png" alt="" />
          <a href="http://www.symfony-project.org/" target="_blank">symfony</a>
          <img src="/images/symfony.png" alt="" />
          <a href="http://www.symfony-reloaded.org/" target="_blank">Symfony2</a>
          <img src="/images/doctrine.png" alt="" />
          <a href="http://www.doctrine-project.org/" target="_blank">Doctrine</a>
          <img src="/images/propel.png" alt="" />
          <a href="http://www.propelorm.org/" target="_blank">Propel</a>
          <a href="https://github.com" class="right"><img src="/images/github.jpeg" alt="GitHub" style="opacity: 0.5"></a>
          <h4>Powered by GitHub</h4>

          <div class="small">
            works on symfony 1.4, Doctrine 1.2, jQuery.
          </div>
          </div>

        </div>
      <div class="col">
        <div class="footnote">

        <h4>Symfohub is...</h4>

          <div class="small">

        Symfohub is collection of all symfony related code stored on GitHub. Owners can add and edit their repositories to share them with community.
          By gathering tweets, comments, blogposts, rates, and assertions we provide powerful social platform on symfony ecosystem.
            <a href="/blog/2">More...</a>
        </div>

        </div>
      </div>
      <div class="col last">
        <div class="footnote">
        <h4>Credits</h4>

          <div class="small">
        Symfohub was created by <a href="https://github.com/DavertMik" target="_blank">Davert</a> and <a href="https://github.com/lividgreen" target="_blank">Livid Green</a>.<br/>
          This project is non-commercial made in purposes of Symfony community.<br/>
          "symfony" is a trademark of Fabien Potencier<br/>
            <a href="http://dryicons.com">DryIcons</a> icons were used in design.
          </div>
        </div>
      </div>

	  </div>
  </div>
<?php echo include_partial('global/comments'); ?>
<script type="text/javascript">
var uservoiceOptions = {
  /* required */
  key: 'symfohub',
  host: 'symfohub.uservoice.com',
  forum: '96525',
  showTab: true,
  /* optional */
  alignment: 'left',
  background_color:'#656270',
  text_color: 'white',
  hover_color: '#06C',
  lang: 'en'
};

function _loadUserVoice() {
  var s = document.createElement('script');
  s.setAttribute('type', 'text/javascript');
  s.setAttribute('src', ("https:" == document.location.protocol ? "https://" : "http://") + "cdn.uservoice.com/javascripts/widgets/tab.js");
  document.getElementsByTagName('head')[0].appendChild(s);
}
_loadSuper = window.onload;
window.onload = (typeof window.onload != 'function') ? _loadUserVoice : function() { _loadSuper(); _loadUserVoice(); };
</script>  

  </body>
</html>
