<?php

namespace Vesic\LinkXtractor;

class LinkXtractor {
    public $url;
    
    public function __construct() {
        
    }
    
    public function setUrl($url) {
        $this->url = $url;
    }
    
    public function getPage() {
        if (!isset($this->url)) throw new Exception("URL not set.");
        return file_get_contents($this->url);
    }
    
    public function getLinks($page) {
        $links = [];
        preg_match_all('/<a\s+.*?href=[\"\']?([^\"\' >]*)[\"\']?[^>]*>(.*?)<\/a>/i', $page, $matches, PREG_SET_ORDER);
        foreach ($matches as $link) {
            array_push($links, $link);
        }
        return $links;
    }
    
    public function getResults() {
        return array_map($this->getLinks(), function($link) {
            return urldecode($link);
        });
    }
}
