<?php
use_helper('Tags');
// gets the popular tags
$tags = PluginTagTable::getPopulars();

// display the tags cloud. The tags will use the route name "@tag" which tags
// the request parameter "tags". The %s element of the route represents the
// position of the tag
if ($cat == 'plugin') {
  echo tag_cloud($tags, '@plugins_tag?tag=%s');
} elseif ($cat == 'bundle') {
  echo tag_cloud($tags, '@bundles_tag?tag=%s');
} else {
  echo tag_cloud($tags, '@repository_tag?tag=%s');
}