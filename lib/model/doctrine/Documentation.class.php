<?php

/**
 * Documentation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    symfohub
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Documentation extends BaseDocumentation
{
	public function setText($text) {
		if ($this->text_hash != ($text_hash = md5($text))) {
			$text = stripslashes(str_replace('<br/>',"\n",$text));
			$this->_set('text', $text);

			$html = sfMarkdown::doConvert($text);

			$html = str_replace('&gt;','>',$html);
			$html = str_replace('&gt;','>',$html);
			$html = sfGeshi::parse_mixed(str_replace('</code>','[/]</code>',$html));
			$html = str_replace('[/]','',$html);
			$this->setHtml($html);
			$this->text_hash = $text_hash;
		}
	}

}