<?php

class CamelAnalyzer extends Doctrine_Search_Analyzer_Standard {

    public function analyze($text, $encoding = null) {
      if (strpos(' ',$text) === false) {
        $text = sfInflector::humanize(sfInflector::underscore($text));
      }
      return parent::analyze($text);
    }

}
