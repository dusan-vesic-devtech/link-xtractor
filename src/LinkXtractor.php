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
    
    public function getLinks() {
        $links = [];
        preg_match_all('/<a\s+.*?href=[\"\']?([^\"\' >]*)[\"\']?[^>]*>(.*?)<\/a>/i', $this->getPage(), $matches, PREG_SET_ORDER);
        foreach($matches as $match) {
            array_push($links, [$match[1],$match[2]]);
        }
        return $links;
    }
    
    public function getResults() {
        return array_map(function($link) {
            return [urldecode($link[0]), $link[1]];
        }, $this->getLinks());
    }
}
