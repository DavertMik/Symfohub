<?php
class TwitterTweetWrapper
{
	protected $_id,
	$_user_id,
	$_created_at,
	$_screen_name,
	$_raw_xml,
	$_parsed_text,
	$_dom_document,
	$_dom_css_selector,
	$_is_retweet,
	$_date_time = null;

	/**
	 *
	 * @return DOMDocument
	 */
	public function getDomDocument()
	{
		if ($this->_dom_document === null)
		{
			$this->_dom_document = new DOMDocument();
			$this->_dom_document->validateOnParse = true;
			$this->_dom_document->loadXML($this->getRawXml());
		}
		return $this->_dom_document;
	}

	public function setDomDocument($dom_document)
	{
		$this->_dom_document = $dom_document;
	}

	/**
	 * @return sfDomCssSelector
	 *
	 */
	public function getDomCssSelector()
	{
		if ($this->_dom_css_selector === null)
		{
			$this->_dom_css_selector = new sfDomCssSelector($this->getDomDocument());
		}
		return $this->_dom_css_selector;
	}

	public function getRawXml()
	{
		if (!$this->_raw_xml && $this->getDomDocument())
		{
			$dom_document = new DOMDocument();
			$dom_document->appendChild($dom_document->importNode($this->getDomDocument(), true));

			$this->_raw_xml = $dom_document->saveXML();
		}
		return $this->_raw_xml;
	}

	public function setRawXml($raw_xml)
	{
		$this->_raw_xml = $raw_xml;
	}

	public function getParsedText()
	{
		if ($this->_parsed_text === null)
		{
			$this->_parsed_text = $this->parseText();
		}
		return $this->_parsed_text;
	}

	public function setParsedText($parsed_text)
	{
		$this->_parsed_text = $parsed_text;
	}

	public function parseText()
	{
		$dom = $this->getDomDocument();

		$status = $dom;

		$retweeted_status = $this->getChildNodeWithName($dom, 'retweeted_status');
		if ($retweeted_status)
		{
			$status = $retweeted_status;
		}

		$entities = null;
		$original_text = '';
		$entities_node = null;

		for ($i = 0; $i < $status->childNodes->length; $i++)
		{
			$node = $status->childNodes->item($i);
			switch ($node->nodeName)
			{
				case 'entities':
					$entities_node = $node;
					break;
				case 'text':
					$original_text = $node->nodeValue;
					break;
			}
		}

		if ($entities_node === null)
		{
		  // whenever no "entities" node was provided by Twitter, parse the tweet by using regular expressions
			$parsed_text = preg_replace("/((http)+(s)?:\/\/[^<>\s]+)/i", "<a href=\"\\0\" target=\"_blank\">\\0</a>", $original_text);
			$parsed_text = preg_replace("/[@]+([A-Za-z0-9-_]+)/", "<a href=\"http://twitter.com/\\1\" target=\"_blank\">\\0</a>", $parsed_text);
			return $parsed_text;
		}

		$replacements = array();

		$parsed_text = $original_text;

		/* @var $entities sfDomCssSelector */

		for ($i = 0; $i < $entities_node->childNodes->length; $i++)
		{
			$entity_collection_node = $entities_node->childNodes->item($i);

			for ($a = 0; $a < $entity_collection_node->childNodes->length; $a++)
			{
				$entity_node = $entity_collection_node->childNodes->item($a);

				$start = $entity_node->getAttribute('start');
				$end = $entity_node->getAttribute('end');

				$replace_with = false;

				$entity_type = $entity_node->nodeName;
				if ($entity_type == 'url')
				{
					$url_nodes = $entity_node->getElementsByTagName('url');
					if (!$url_nodes->length)
					{
						throw new Exception('No "url" tag found for "url" entity');
					}

					$url = $url_nodes->item(0)->nodeValue;

					$expanded_url = '';
					$expanded_url_nodes = $entity_node->getElementsByTagName('expanded_url');
					if ($expanded_url_nodes->length)
					{
						$expanded_url = $expanded_url_nodes->item(0)->nodeValue;
					}
					$replace_with = self::getLinkForUrl($url, $expanded_url);
				}
				else if ($entity_type == 'user_mention')
				{
					$screen_name_nodes = $entity_node->getElementsByTagName('screen_name');
					if (!$screen_name_nodes->length)
					{
						throw new Exception('No "screen_name" tag found for "user_mention" entity');
					}

					$screen_name = $screen_name_nodes->item(0)->nodeValue;
					$replace_with = self::getLinkForScreenName($screen_name);
				}
				else if ($entity_type == 'hashtag')
				{
					$text_nodes = $entity_node->getElementsByTagName('text');
					if (!$text_nodes->length)
					{
						throw new Exception('No "text" tag found for "hashtag" entity');
					}

					$text = $text_nodes->item(0)->nodeValue;
					$replace_with = self::getLinkForHashtag($text);
				}

				if ($replace_with)
				{
					$replacements[$start] = array('length' => $end - $start, 'replace_with' => $replace_with);
				}
			}
		}

		krsort($replacements);
		foreach ($replacements as $start => $replacement)
		{
			$length = $replacement['length'];
			$replace_with = $replacement['replace_with'];
			$parsed_text = substr_replace($parsed_text, $replace_with, $start, $length);
		}

		return $parsed_text;
	}

	static public function getLinkForScreenName($screen_name)
	{
		return sprintf('<a href="%s" target="_blank">@%s</a>', self::getUrlForScreenName($screen_name), $screen_name);
	}

	static public function getUrlForScreenName($screen_name)
	{
		return sprintf('http://www.twitter.com/%s', $screen_name);
	}

	static public function getLinkForHashtag($hashtag)
	{
		return sprintf('<a href="%s">#%s</a>', self::getUrlForHashtag($hashtag), $hashtag);
	}

	static public function getUrlForHashtag($hashtag)
	{
		return sprintf('http://www.twitter.com/search?q=#%s', $hashtag);
	}

	static public function getLinkForUrl($url, $expanded_url = '')
	{
		if ($expanded_url == '')
		{
			$expanded_url = $url;
		}
		return sprintf('<a href="%s" target="_blank">%s</a>', $expanded_url, $url);
	}

	/**
	 * @return DateTime
	 *
	 */
	public function getDateTime()
	{
		if (null === $this->_date_time)
		{
			$this->_date_time = new DateTime($this->getCreatedAt());
		}
		return $this->_date_time;
	}

	public function getId()
	{
		if ($this->_id === null)
		{
			$id_node = $this->getChildNodeWithName($this->getDomDocument(), 'id');
			if ($id_node)
			{
				$this->_id = $id_node->nodeValue;
			}
		}
		return $this->_id;
	}

	public function setId($v)
	{
		$this->_id = $v;
	}

	public function getCreatedAt()
	{
		if ($this->_created_at === null)
		{
			$this->_created_at = $this->getDomCssSelector()->matchSingle('created_at')->getValue();
		}
		return $this->_created_at;
	}

	public function setCreatedAt($v)
	{
		$this->_created_at = $v;
	}

	public function getUserId()
	{
		if ($this->_user_id === null)
		{
			$user_node = $this->getUserNode();
			if ($user_node)
			{
				$id_node = $this->getChildNodeWithName($user_node, 'id');
				if ($id_node)
				{
					$this->_user_id = $id_node->nodeValue;
				}
			}
		}
		return $this->_user_id;
	}

	public function setUserId($user_id)
	{
		$this->_user_id = $user_id;
	}

	public function getScreenName()
	{
		if ($this->_screen_name === null)
		{
			$user_node = $this->getUserNode();
			if ($user_node)
			{
				$screen_name_node = $this->getChildNodeWithName($user_node, 'screen_name');
				if ($screen_name_node)
				{
					$this->_screen_name = $screen_name_node->nodeValue;
				}
			}
		}
		return $this->_screen_name;
	}

	public function setScreenName($screen_name)
	{
		$this->_screen_name = $screen_name;
	}

	/**
	 *
	 *
	 * @return DOMNode
	 */
	public function getUserNode()
	{
		return $this->getChildNodeWithName($this->getDomDocument(), 'user');
	}

	public function getChildNodeWithName($node, $name)
	{
		$childNodes = $node->childNodes;
		for ($i = 0; $i < $childNodes->length; $i++)
		{
			$node = $childNodes->item($i);
			if ($node->nodeName == $name)
			{
				return $node;
			}
		}
		return false;
	}

	public function isRetweet($boolean = null)
	{
		if ($boolean !== null)
		{
			// set the value
			$this->_is_retweet = $boolean;
		}
		else
		{
			// get the current value
			if ($this->_is_retweet ===  null)
			{
				$this->_is_retweet = ($this->getChildNodeWithName($this->getDomDocument(), 'retweeted_status') ? true : false);
			}
			return $this->_is_retweet;
		}
	}
}
