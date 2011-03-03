<?php

function title($name, $category = false) {
  if (is_array($name)) {
    $h1 = reset($name);
    $name = implode (' - ',$name);
  } else {
    $h1 = $name;
  }
    sfContext::getInstance()->getResponse()->setTitle($name .' - Symfohub: useful libs for symfony frameworks');
    sfContext::getInstance()->getResponse()->setSlot('category',strtolower($category));
  return content_tag('h1',$h1);
}

function keyword_encode($content, $words, $selector = null)
{
	return SeoKeywordToolkit::getInstance()->parseBlock($content, $words, $selector);
}